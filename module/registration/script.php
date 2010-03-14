<?php
if (@$config == NULL) die ("");

function checkAddress($ip)
{
    global $rDB, $config;
    // Не проверяем IP если не требуется
    if ($config['limit_account_from_one_ip'] == 0)
        return 0;
    $list = $rDB->selectCell("SELECT `last_ip` FROM `account` WHERE `last_ip` = ?", $ip);
    if ($list == "")
        return 0;
    return 1;
}

function checkName($username)
{
    global $rDB;
    $list = $rDB->selectCell("SELECT `username` FROM `account` WHERE `username` = ?", $username);
    if ($list == "")
        return 0;
    return 1;
}
//==============================================================
// Скрипт регистрации
//==============================================================
{
 $show = true;
 $ip = @$_SERVER['REMOTE_ADDR'];

 if ($rDB == NULL)
 {
     echo $lang['reg_err_db'];
     $show = false;
 }
 else if (checkAddress($ip))
 {
     echo $lang['reg_err_one_ip'];
     $show = false;
 }
 else if(@$_POST['script'] == 'reg')
 {
	$name = @$_POST['account_name'];
    $username = strtoupper(@$_POST['account_name']);
	$password = strtoupper(@$_POST['account_pass']);
    $email    = @$_POST['account_email'];
    $nameLen  = strlen($name);
    $passLen  = strlen($password);

    if (empty($username) OR empty($password))
        echo $lang['reg_err_name_pass'];
    else if ($nameLen < 3 OR $nameLen > 16)
        echo $lang['reg_err_name_size'];
    else if ($passLen < 3 OR $passLen > 16)
        echo $lang['reg_err_pass_size'];
    else if (!preg_match("/^\w*$/","$username$password"))
        echo $lang['reg_err_charset'];
    else if (preg_match("/[(а-я)|(А-Я)]/","$username$password"))
        echo $lang['reg_err_charset'];
    else if ($username == $password)
        echo $lang['reg_err_name_is_pass'];
    else if (!eregi("^[a-z0-9\._-]+@[a-z0-9\._-]+\.[a-z]{2,4}$", $email))
        echo $lang['reg_err_mail'];
    else if (checkName($username))
        echo $lang['reg_err_name_in_use'];
    else
    {
	    $res = $rDB->query("INSERT INTO `account` (`username`, `sha_pass_hash`, `email`, `last_ip`, `expansion`) VALUES (?, SHA1(?), ?, ?, '2')", $username, $username.":".$password, $email, $ip);
        if ($res)
        {
            echo $lang['reg_success'];
            $show = false;
        }
        else
            echo $lang['reg_err_query'];
    }
 }
 if ($show == true)
 {
  echo '<br>';
  echo '<form method="post" action="?register" name="acc">';
  echo '<input type="hidden" name="script" value="reg">';
  echo '<table class=find>';
  echo '<tr><td class=top colspan=2>';
  echo '<table class=findtop><tr><td class=topleft>&nbsp;</td><td class=top>'.$lang['reg_register'].'</td><td class=topright>&nbsp;</td></tr></table>';
  echo '</td></tr>';
  echo '<tr><td>'.$lang['reg_name'].'</td><td><input type="text" name="account_name" maxlength="16" size="30" value="'.@$name.'"></td></tr>';
  echo '<tr><td>'.$lang['reg_password'].'</td><td><input type="password" name="account_pass" maxlength="16" size="30"></td></tr>';
  echo '<tr><td>E-Mail</td><td><input type="text" name="account_email" size="30" maxlength="32" value="'.@$email.'"></td></tr>';
  echo '<tr><td class=bottom colspan=2><input type=submit value="'.$lang['reg_ok_register'].'"></td></tr>';
  echo '</table>';
  echo '</form>';
  echo "<br>";
 }
}
?>
