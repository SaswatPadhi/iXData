<?php
    $ldapconfig['port'] = NULL;
    $ldapconfig['host'] = 'ldap.iitb.ac.in';
    $ldapconfig['basedn'] = 'ou=people,dc=iitb,dc=ac,dc=in';

    function ldap_find($LDROLL) {
        global $ldapconfig;

       $ds = @ldap_connect($ldapconfig['host'], $ldapconfig['port']);
       $r = @ldap_search($ds, $ldapconfig['basedn'], 'employeenumber=' . $LDROLL);
       if ($r) {
           $result = @ldap_get_entries($ds, $r);
            if($result[0])
                return $result[0];
        }
       return false;
    }

    function ldap_authenticate($LDUSER, $LDPASS) {
        global $ldapconfig;

       $ds = @ldap_connect($ldapconfig['host'], $ldapconfig['port']);
       $r = @ldap_search($ds, $ldapconfig['basedn'], 'uid=' . $LDUSER);
       if ($r) {
           $result = @ldap_get_entries($ds, $r);
           if ($result[0]) {
               if (@ldap_bind( $ds, $result[0]['dn'], $LDPASS) ) {
                   return $result[0];
               }
           }
       }
       return false;
    }
