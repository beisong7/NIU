<?php

namespace App\Services\Ldap;
use App\Lawyer;
use App\User;

/**
 * Created by PhpStorm.
 * User: hp
 * Date: 22/05/2020
 * Time: 4:55 PM
 */
class Validate
{

    public function userWithAD($credentials){

//        dd($credentials);
        $username = $credentials['username'];
        $password = $credentials['password'];

        $adServer = "52.148.202.249";
        //Test-NetConnection -52.148.202.249 -389
        $adPort = 389;



        $ldaprdn = "LEGALMAIL\\$username";

//        ini_set('display_errors', 1);
//        error_reporting(E_ALL);
//        ldap_set_option(NULL, LDAP_OPT_DEBUG_LEVEL, 7);

//        putenv('LDAPTLS_REQCERT=never');
        $ldap = ldap_connect($adServer, $adPort);

        ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);

        $user = new User();
        try{

            $bind = ldap_bind($ldap, $ldaprdn, $password);

            if ($bind) {

                $filter="(sAMAccountName=$username)";

                $result = ldap_search($ldap,"dc=legalmail,dc=test",$filter);

                // dd($result);

                $info = ldap_get_entries($ldap, $result);

                $user['valid'] = false;


                for ($i=0; $i < $info["count"]; $i++)
                {
                    if($info['count'] > 1)
                        break;

                    $user_entry = ldap_first_entry($ldap, $result);
                    $user_dn = ldap_get_dn($ldap, $user_entry);

                    $items = explode(",",$user_dn);
                    $fimuser = false;
                    foreach($items as $item){
                        $obj = explode("=",$item);
                        if($obj[1]==="FIM"){
                            $fimuser = true;
                            break;
                        }
                    }

                    $user->admin = $fimuser?false:true;
                    $user->fim_user = $fimuser?true:false;

                    @ldap_close($ldap);
                    $userDn = $info[$i]["name"][0];
                    $firstname = $info[$i]["givenname"][0];

                    $user->name = $userDn;
                    $user->first_name = $firstname;
                    $user->valid = true;
                    $user->username = $username;

                    //ensure user is active
                    if($user->fim_user){
                        $lawyer = Lawyer::where('Username', $username)->where('Status', 'active')->first();
                        if(!empty($lawyer)){
                            $user->valid = true;
                        }else{
                            $user->valid = false;
                        }
                    }


                    return $user;

                }

            }else{
                $user->valid = false;
                $user->message = "Bind fail";
                return $user;

            }

        }catch (\Exception $e) {
            $user->valid = false;
            $user->message = "Invalid Credentials Given";
            return $user;
        }
    }

}