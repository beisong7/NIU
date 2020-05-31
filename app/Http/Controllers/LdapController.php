<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LdapController extends Controller
{
    public function auth($username, $password){

        $adServer = "52.148.202.249";
        //Test-NetConnection -52.148.202.249 -389
        $adPort = 389;
//        $adPort = 636;



        $ldaprdn = "LEGALMAIL\\$username";

        ini_set('display_errors', 1);
        error_reporting(E_ALL);
        ldap_set_option(NULL, LDAP_OPT_DEBUG_LEVEL, 7);

        putenv('LDAPTLS_REQCERT=never');

        //        $ldap = ldap_connect($adServer, $adPort);

        $ldap = ldap_connect("ldaps://$adServer", $adPort);
//        ldap_start_tls($ldap);

        ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);

        $bind = ldap_bind($ldap, $ldaprdn, $password);
//        $bind = ldap_bind($ldap, $ldaprdn);

        if ($bind) {

            $filter="(sAMAccountName=$username)";

            $result = ldap_search($ldap,"dc=legalmail,dc=test",$filter);

            // dd($result);

            $info = ldap_get_entries($ldap, $result);

            dd($info);

            for ($i=0; $i<$info["count"]; $i++)
            {
                if($info['count'] > 1)
                    break;
                echo "<p>You are accessing <strong> ". $info[$i]["sn"][0] .", " . $info[$i]["givenname"][0] ."</strong><br /> (" . $info[$i]["samaccountname"][0] .")</p>\n";
                echo '<pre>';
                var_dump($info);
                echo '</pre>';
                $userDn = $info[$i]["distinguishedname"][0];
            }
            @ldap_close($ldap);
        } else {
            $msg = "Invalid email address / password";
            return $msg;
        }
    }
}
