<?php
@session_start();
include_once("conf.php");
include_once("include/DbSimple/Generic.php");
include("lang/lang.".$config['lang'].".php");
include("lang/game_text.".$config['lang'].".php");
// Режим запроса
$ajaxmode = 1;

// Получаем имя первой переменной запроса
$mode = $_SERVER["QUERY_STRING"];
$pos  = strpos($mode, "=");
$pos1 = strpos($mode, "&");
if ($pos > $pos1 AND $pos1!=NULL) $pos = $pos1;
if ($pos != NULL)
    $mode = substr($mode, 0, $pos);

$time = microtime(true);
// Соединяемся к базам
$dDB = DbSimple_Generic::connect("mysql://$config[username]:$config[password]@$config[hostname]/$config[dbName]");
$wDB = DbSimple_Generic::connect("mysql://$config[wusername]:$config[wpassword]@$config[whostname]/$config[wdbName]");
$cDB = DbSimple_Generic::connect("mysql://$config[cusername]:$config[cpassword]@$config[chostname]/$config[cdbName]");
// Выставляем кодировку клиента
$dDB->query("SET NAMES ?s", $config['client_charset']);
$wDB->query("SET NAMES ?s", $config['client_charset']);
$cDB->query("SET NAMES ?s", $config['client_charset']);

$ajax_module = @$ajax_modules[$mode];
$module = @$modules[$mode];

// Подключаем модуль если найден
if ($ajax_module)
  include($ajax_module);
else if ($module)
  include($module);
else
  echo "Module ($mode) error";

if ($config['show_ajax_sql_timings'])
{
 $time = microtime(true) - $time;
 $sqlTime = 0;
 echo "<br><table class=report width=100%>";
 echo "<tbody>";
 echo "<tr><td>Total execution time: $time</td></tr>";
 $stat = $dDB->getStatistics();$sqlTime+=$stat['time'];
 echo "<tr><td>SQL dDB: $stat[count] in $stat[time]</td></tr>";
 $stat = $wDB->getStatistics();$sqlTime+=$stat['time'];
 echo "<tr><td>SQL wDB: $stat[count] in $stat[time]</td></tr>";
 $stat = $cDB->getStatistics();$sqlTime+=$stat['time'];
 echo "<tr><td>SQL cDB: $stat[count] in $stat[time]</td></tr>";
// $stat = $rDB->getStatistics();
// echo "<tr><td>SQL rDB: $stat[count] in $stat[time]</td></tr>";
 $executeTime = $time - $sqlTime;
 echo "<tr><td>PHP time: $executeTime</td></tr>";
 echo "<tr><td>SQL time: $sqlTime</td></tr>";
 echo "</tbody>";
 echo "</table>";
}