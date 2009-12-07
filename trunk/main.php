<?php
include_once("conf.php");
include_once("include/DbSimple/Generic.php");
// Режим запроса
$ajaxmode = 0;

// Получаем что строку запроса
$_SESSION['last_page'] = $_SERVER["QUERY_STRING"];
$mode = $_SERVER["QUERY_STRING"];
$pos  = strpos($mode, "=");
$pos1 = strpos($mode, "&");

if ($pos > $pos1 AND $pos1!=NULL) $pos = $pos1;
if ($pos != NULL)
    $mode = substr($mode, 0, $pos);

$time = microtime(true);
// Connect to databases
$dDB = DbSimple_Generic::connect("mysql://$config[username]:$config[password]@$config[hostname]/$config[dbName]");
$wDB = DbSimple_Generic::connect("mysql://$config[wusername]:$config[wpassword]@$config[whostname]/$config[wdbName]");
$cDB = DbSimple_Generic::connect("mysql://$config[cusername]:$config[cpassword]@$config[chostname]/$config[cdbName]");
$rDB = DbSimple_Generic::connect("mysql://$config[rusername]:$config[rpassword]@$config[rhostname]/$config[rdbName]");
// Выставляем кодировку клиента
$dDB->query("SET NAMES ?s", $config['client_charset']);
$wDB->query("SET NAMES ?s", $config['client_charset']);
$cDB->query("SET NAMES ?s", $config['client_charset']);
$rDB->query("SET NAMES ?s", $config['client_charset']);

// Устанавливаем вывод ошибок если нужно
if ($config['show_db_error'])
{
 function databaseErrorHandler($message, $info)
 {
	if (!error_reporting())
        return;
	echo "<table class = report>";
    echo "<tbody>";
    echo "<tr><td>SQL Error: $message<br><pre>".print_r($info, true)."</pre></td></tr>";
    echo "</tbody>";
    echo "</table>";
 }
 $dDB->setErrorHandler('databaseErrorHandler');
 $wDB->setErrorHandler('databaseErrorHandler');
 $cDB->setErrorHandler('databaseErrorHandler');
 $rDB->setErrorHandler('databaseErrorHandler');
}

// Определяем что нужно подключить
$module = isset($modules[$mode]) ? $modules[$mode] : (isset($modules["default"]) ? $modules["default"] : NULL);
// Подключаем модуль если найден
if ($module!=NULL)
    include($module);

echo "<br><TABLE class=back>";
echo "<TBODY>";
echo "<TR>";
echo "<TD align=left width=\"33%\"><A href=\"javascript:history.back(1)\">$lang[back]</A></TD>";
echo "<TD align=center width=\"34%\"></TD>";
echo "<TD align=right width=\"33%\"></TD>";
echo "</TR>";
echo "</TBODY></TABLE>";

if ($config['show_sql_timings'])
{
 $time = microtime(true) - $time;
 $sqlTime = 0;
 echo "<br><table class = report width=500>";
 echo "<tbody>";
 echo "<tr><td class=left>Total execution time: $time</td></tr>";
 $stat = $dDB->getStatistics();$sqlTime+=$stat['time'];
 echo "<tr><td class=left>SQL dDB: $stat[count] in $stat[time]</td></tr>";
 $stat = $wDB->getStatistics();$sqlTime+=$stat['time'];
 echo "<tr><td class=left>SQL wDB: $stat[count] in $stat[time]</td></tr>";
 $stat = $cDB->getStatistics();$sqlTime+=$stat['time'];
 echo "<tr><td class=left>SQL cDB: $stat[count] in $stat[time]</td></tr>";
 $stat = $rDB->getStatistics();
 echo "<tr><td class=left>SQL rDB: $stat[count] in $stat[time]</td></tr>";
 $executeTime = $time - $sqlTime;
 echo "<tr><td class=left>PHP time: $executeTime</td></tr>";
 echo "<tr><td class=left>SQL time: $sqlTime</td></tr>";
 echo "</tbody>";
 echo "</table>";
}
?>
<script type="text/javascript">enableHrefTip(document);</script>

