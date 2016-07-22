<?php
/* Library session.inc
Contents:

  userId   SessionVerify()
  userId   SessionBegin($user,$pass)
  function SessionEnd()
  function SessionNeeded(&$uid)
  function SessionError()
  string   NormalUser()
  function SetNormalUser($user);
*/

function NormalUser() {
 global $xguse;
 return $xguse;
}

function SessionVerify() {
 global $xgses;
 if ($xgses) {
  CreateQuery("SELECT * from fi_car_session where code='$xgses'",$result);
  if (mysql_num_rows($result)) {
   $idu=mysql_result($result,0,'idu');
  } else {
   $idu=0;
  }
  KillQuery($result);
 } else {
  $idu=0;
 }
 return $idu;
}

function SessionBegin($user,$pass) {
 global $HTTP_SERVER_VARS,$xgses;
 $time=time();
 DoSQLNoReg("DELETE FROM canal_session WHERE code='$xgses' or exptime<$time");
 setcookie("xguse",$user,$time+365*24*60*60);
 CreateQuery("SELECT * from canusuarios where user='$user' and pass='$pass'",$result);
 if (mysql_num_rows($result)) {
  $exptime=$time+2*60*60;
  $ip=$HTTP_SERVER_VARS["REMOTE_ADDR"];
  $idu=mysql_result($result,0,'idu');
  $data=md5("$user:$pass:$ip:$exptime");
  DoSQLNoReg("INSERT INTO canal_session (idu,code,ip,exptime) VALUES ('$idu','$data','$ip',$exptime)");
  setcookie("xgses",$data,$exptime);
 } else {
  setcookie("xgses",'',time()-10000);
  $idu=0;
 }
 KillQuery($result);
 return $idu;
}

function SessionEnd() {
 Global $xgses;
 setcookie("xgses",'',time()-1);
 DoSQLNoReg("DELETE FROM canal_session WHERE code='$xgses'");
}

function SessionNeeded(&$uid) {
 $uid=SessionVerify();
 if (!$uid) {
  redirect('login.php?login=deadsession');
 }
}

function SetNormalUser($user) {
 setcookie("xguse",$user,time()+365*24*60*60);
}
