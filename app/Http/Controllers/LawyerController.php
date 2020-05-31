<?php

namespace App\Http\Controllers;

use App\Lawyer;
use App\Session\Authenticated;
use App\Traits\Auth\Auth;
use Illuminate\Http\Request;

class LawyerController extends Controller
{
    use Auth;
    private $auth;
    function __construct(Authenticated $auth)
    {
        $this->auth = $auth;
    }

    //
    public function dashboard(){
        $username = session('current_user_name');

        $user = $this->guard($username);

        if($user->admin){
            $lawyer = Lawyer::select([

                'AlternativeEmail',
                'EnrollmentNumber',
                'Username',
                'Created',
                'CreatedBy',
                'Status',
                'FirstName',
                'LastName',
                'Initials',

            ])->where('Status', '!=', 'rejected')->where('Status', '!=', 'inactive')->take(50)->get();

            $approved = Lawyer::select(['Id'])->where('Status', 'approved')->get()->count();
            $total = Lawyer::select(['Id'])->get()->count();
            $active = Lawyer::select(['Id'])->where('Status', 'active')->get()->count();
            $rejected = Lawyer::select(['Id'])->where('Status', 'rejected')->get()->count();
            $approvedCourt = Lawyer::select(['Id'])->where('Status', 'approved-court')->get()->count();
            $inactive = Lawyer::select(['Id'])->where('Status', 'inactive')->get()->count();
            $submitted = Lawyer::select(['Id'])->where('Status', 'submitted')->get()->count();


            return view('pages.admin.dashboard.index')
                ->with([
                    'lawyers'=> $lawyer,
                    'approved'=>$approved,
                    'total'=>$total,
                    'active'=>$active,
                    'rejected'=>$rejected,
                    'approvedCourt'=>$approvedCourt,
                    'submitted'=>$submitted,
                    'inactive'=>$inactive,
                ]);
        }else{
            $lawyer = Lawyer::select([

                'AlternativeEmail',
                'EnrollmentNumber',
                'Username',
                'Created',
                'Status',
                'CreatedBy',
                'FirstName',
                'LastName',
                'Initials',

            ])->where('Username', $username)->first();

            return view('pages.lawyer.dashboard.index')->with('lawyer', $lawyer);
        }
    }

    public function submittedRequests(){

        $lawyer = Lawyer::select([
            'AlternativeEmail',
            'EnrollmentNumber',
            'Username',
            'Created',
            'Status',
            'CreatedBy',
            'FirstName',
            'LastName',
            'Initials',

        ])->where('Status', 'Submitted')->get();
        return view('pages.admin.lawyers.submitted')->with('lawyers', $lawyer);
    }

    public function lawyerSecurity(){
        return view('pages.lawyer.security.index');
    }

    public function logoutUser(){
        $this->logout();
        return back();
    }
}
