<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 24/05/2020
 * Time: 4:27 PM
 */

namespace App\Services\Ldap;


class LdapProcess
{

    public function connect($username=null, $password=null){
        $status = false;


        try{
            $adServer = "52.148.202.249";
            //Test-NetConnection -52.148.202.249 -389
            $adPort = 389;
//            $adPort = 636;

            if(empty($username)){
                $username='njcadmin';
            }

            if(empty($password)){
                $password='Word_pass1';
            }


            $ldaprdn = "LEGALMAIL\\$username";

//            ini_set('display_errors', 1);
//            error_reporting(E_ALL);
//            ldap_set_option(NULL, LDAP_OPT_DEBUG_LEVEL, 7);

            putenv('LDAPTLS_REQCERT=never');

            $ldap = ldap_connect("ldaps://$adServer", $adPort);

            ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
            ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);

            $bind = ldap_bind($ldap, $ldaprdn, $password);
//        $bind = ldap_bind($ldap, $ldaprdn);

            if ($bind) {
                return [true, $ldap];
            }
            return [false, 0];
        }catch (\Exception $e){
            return [false, $e->getMessage()];
        }
    }

    public function find( $using, $value, $key, $ldap){

//        $filter="(sAMAccountName=$username)";

        $filter="($using=$value)";



        $result = ldap_search($ldap,"dc=legalmail,dc=test",$filter);

        $info = ldap_get_entries($ldap, $result);
        $lawyer = null;
//        dd($info);

        if($info['count'] === 1){

            try{

                for ($i=0; $i<$info["count"]; $i++)
                {
                    $lawyer = $info[$i][$key][0];
                    break;
                }

                return [true, $lawyer];

            }catch (\Exception $e){
                return [false, "You do not have a phone No records"];
            }
//        dd($info[0]);

        }

        return [false, "No records found"];


    }

    public function changePassword($username, $password, $ldapConn){
        $status = true;
        $message = "";

        try{


        $newpassword = "\"" . $password . "\"";
        $len = strlen($newpassword);
        $newPass = "";
        for ($i = 0; $i < $len; $i++) $newPass .= "{$newpassword{$i}}\000";
//        $entry["unicodePwd"] = $newPass;



//            $encoded_newPassword = "{SHA}" . base64_encode( pack( "H*", sha1( $password ) ) );

//            $encoded_newPassword = base64_encode($newPass);
            $encoded_newPassword = $newPass;

//            $encoded_newPassword = mb_convert_encoding($newpassword, "UTF-16LE");


            $filter="(sAMAccountName=$username)";
            $user_search  = ldap_search($ldapConn,"dc=legalmail,dc=test",$filter);

            $user_get = ldap_get_entries($ldapConn, $user_search);
            $user_entry = ldap_first_entry($ldapConn, $user_search);
            $user_dn = ldap_get_dn($ldapConn, $user_entry);

            $entry["unicodePwd"] = "$encoded_newPassword";
//            $entry["userPassword"] = "$encoded_newPassword";



            if (ldap_mod_replace($ldapConn,$user_dn,$entry) === false){ //secondary 1st approach
//            if (ldap_mod_add($ldapConn,$user_dn,$entry) === false){ //secondary 2nd approach
//            if (ldap_modify($ldapConn,$user_dn,$entry) === false){ //primary approach
                $status = false;
                $message = "Your password cannot be changed, please contact the support.";

                return [$status, $message];
            }
            ldap_mod_replace($ldapConn,$user_dn,$entry);
            /**strange  but ldap_mod_replace() may be applied twice cos once does not completely replace the password,
             * once kinda just adds a new password to the existing one
             * the second time though it totally changes
             */


            return [$status, 'Password changed successfully.'];
        }catch (\Exception $e){

            $status = false;
            $message = "Your password could not be changed, please contact the administrator. ".$e->getMessage();
            return [$status, $message];
        }
    }

}