<?php
$ldapconfig['host'] = 'ldap.iitb.ac.in';
$ldapconfig['port'] = NULL;
$ldapconfig['basedn'] = 'ou=people,dc=iitb,dc=ac,dc=in';

function ldap_authenticate($LDUSER, $LDPASS) {
    global $ldapconfig;

   $ds = @ldap_connect($ldapconfig['host'],$ldapconfig['port']);
   $r = @ldap_search( $ds, $ldapconfig['basedn'], 'uid=' . $LDUSER);
   if ($r) {
       $result = @ldap_get_entries( $ds, $r);
       if ($result[0]) {
           if (@ldap_bind( $ds, $result[0]['dn'], $LDPASS) ) {
               return $result[0];
           }
       }
   }
   return false;
}

function ldap_values($LDROLL) {
    global $ldapconfig;
    global $UID,$fullName,$mail;

   $ds = @ldap_connect($ldapconfig['host'],$ldapconfig['port']);
   $r = @ldap_search( $ds, $ldapconfig['basedn'], 'employeenumber=' . $LDROLL);
   if ($r) {
       $result = @ldap_get_entries( $ds, $r);
       $UID = $result['0']['uid']['0'];
       $mail = $result['0']['mail']['0'];
       $fullName = $result['0']['cn']['0'];
	}
}
