<?php

namespace App\Http\Controllers;

use App\Services\Ldap\LdapProcess;
use App\Services\Ldap\Validate;
use App\Session\Authenticated;
use App\Traits\Auth\Password;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use Password;
    private $validate;
    private $ldapProcess;
    private $auth;

    public function __construct(Validate $validate, Authenticated $auth, LdapProcess $ldapProcess)
    {
        $this->validate = $validate;
        $this->auth = $auth;
        $this->ldapProcess = $ldapProcess;
    }

    public function validateSystemAdmin(Request $request){

        $request->validate([
            'user_name' => 'required|string',
            'pass_word' => 'required|string',
        ]);

        $username = $request->input('user_name');
        $password = $request->input('pass_word');

        $credentials = ['username'=>$username, 'password'=>$password];

        $user = $this->validate->userWithAD($credentials);

//        dd($user);
        if($user->valid){
            $this->auth->login($user);
//            return view('pages.dashboard.index')->with('user', $user);
            if($user->admin){
                return redirect()->route('admin.dashboard');
            }
            return redirect()->route('dashboard');
        }else{
            return back()->withErrors($user->message)->withInput($request->input());
        }

    }

    public function passwordResetStart(Request $request){
        $username = $request->input('user_name');
        $last_four = $request->input('last_four');
        if(!empty($username) && !empty($last_four)){

            $res = $this->ldapProcess->connect();
            if($res[0]){
                $search = $this->ldapProcess->find('sAMAccountName', $username, "telephonenumber", $res[1]);

                if($search[0]){
                    $last4digit = substr($search[1], -4);
                    if($last4digit===$last_four){
                        return redirect()->route('password.reset.page', encrypt($username));
                    }
                    return back()->withErrors(['The last four digits did not match. Contact support to Update your record and try again.'])->withInput($request->input());
                }else{
                    return back()->withErrors(['Please provide a valid username with useful record.'])->withInput($request->input());
                }


            }else{
                return back()->withErrors([$res[1]])->withInput($request->input());
            }
        }
        return back()->withErrors(['Please provide a valid username.'])->withInput($request->input());
    }

    public function passwordResetUpdate(Request $request){
        $password = $request->input('pass_word');
        $confirm_password = $request->input('confirm_pass_word');
        $username = $request->input('secret');

        try{
            $username = decrypt($username);
        }catch (\Exception $e){
            return redirect()->route('home')->withErrors(['Unknown subscriber']);
        }

        if($password===$confirm_password){
            $result = $this->checkPassword($password);

            if($result[0]){
                $success =  $this->updatePassword($password, $username);
                if($success[0]){
                    return redirect()->route('home')->withMessage('Password Reset Successful');
                }else{
                    return back()->withErrors([$success[1]])->withInput($request->input());
                }
            }else{
                return back()->withErrors([$result[1]])->withInput($request->input());
            }
        }

        return back()->withErrors(['Password Mismatch.'])->withInput($request->input());
    }

    public function updatePassword($password, $username){

        $res = $this->ldapProcess->connect();
        if($res[0]) {
            $results = $this->ldapProcess->changePassword($username, $password, $res[1]);
            if($results[0]){
                return [true, $results[1]];
            }else{
                return [false, $results[1]];
            }

        }else{
            return [false, $res[1]];
        }
    }

    public function resetPasswordPage($secret){
        return view('auth.change_password')->with('secret', $secret);
    }

    public function updateMyPassword(Request $request){

        $current = $request->input('current');

        $newPass = $request->input('new_password');

        $newPassCheck = $request->input('new_password_confirm');

        if($newPass!==$newPassCheck){
            return back()->withInput($request->input())->withErrors(['New Password miss-match']);
        }

        return back()->withMessage('updates not pushed from dev');


    }
}
