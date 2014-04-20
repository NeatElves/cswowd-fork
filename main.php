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
//*****************************************************************************
// Connect to databases
//*****************************************************************************
$dDB = DbSimple_Generic::connect("mysql://$config[username]:$config[password]@$config[hostname]/$config[dbName]");
$wDB = DbSimple_Generic::connect("mysql://$config[wusername]:$config[wpassword]@$config[whostname]/$config[wdbName]");
$cDB = DbSimple_Generic::connect("mysql://$config[cusername]:$config[cpassword]@$config[chostname]/$config[cdbName]");
$rDB = DbSimple_Generic::connect("mysql://$config[rusername]:$config[rpassword]@$config[rhostname]/$config[rdbName]");

//*****************************************************************************
// Set client codepage
//*****************************************************************************
$dDB->query("SET NAMES ?s", $config['client_charset']);
$wDB->query("SET NAMES ?s", $config['client_charset']);
$cDB->query("SET NAMES ?s", $config['client_charset']);
$rDB->query("SET NAMES ?s", $config['client_charset']);

$db_log='';
//*****************************************************************************
// Error log function
//*****************************************************************************
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
/*
 function databaseLogger($info, $query, $cached)
 {
     global $db_log;
     $db_log.=$query.'<br>';
 }
 $dDB->setLogger('databaseLogger');
 $wDB->setLogger('databaseLogger');
 $cDB->setLogger('databaseLogger');
 $rDB->setLogger('databaseLogger');
/**/
}

//*****************************************************************************
// Include cache functions
//*****************************************************************************
$cacheArray = array();
function databaseCacher($hash, $array)
{
    global $cacheArray;
    if ($array===null)
	    return isset($cacheArray[$hash]) ? $cacheArray[$hash] : null;
	$cacheArray[$hash] = $array;
}
$dDB->setCacher('databaseCacher');
$wDB->setCacher('databaseCacher');
$cDB->setCacher('databaseCacher');
$rDB->setCacher('databaseCacher');

//*****************************************************************************
// Include site module
//*****************************************************************************
$module = isset($modules[$mode]) ? $modules[$mode] : (isset($modules["default"]) ? $modules["default"] : NULL);
// Подключаем модуль если найден
if ($module!=NULL)
    include($module);

echo "<br><div id=debug></div><table class=back>";
echo "<tbody>";
echo "<tr>";
echo "<td align=left width=\"33%\"><a href=\"javascript:history.back(1)\">$lang[back]</a></td>";
echo "<td align=center width=\"34%\"></td>";
echo "<td align=right width=\"33%\"></td>";
echo "</tr>";
echo "</tbody></table>";

//*****************************************************************************
// Show timers (for debug)
//*****************************************************************************
if ($config['show_sql_timings'])
{
 $time = microtime(true) - $time;
 $sqlTime = 0;
 echo "<br><table class = report width=500>";
 echo "<tbody>";
 echo "<tr><td class=left>Total execution time: $time</td></tr>";
 $stat = $dDB->getStatistics();$sqlTime+=$stat['time'];
 echo "<tr><td class=left>SQL dDB: $stat[count] in $stat[time] (cached $stat[cache])</td></tr>";
 $stat = $wDB->getStatistics();$sqlTime+=$stat['time'];
 echo "<tr><td class=left>SQL wDB: $stat[count] in $stat[time] (cached $stat[cache])</td></tr>";
 $stat = $cDB->getStatistics();$sqlTime+=$stat['time'];
 echo "<tr><td class=left>SQL cDB: $stat[count] in $stat[time] (cached $stat[cache])</td></tr>";
 $stat = $rDB->getStatistics();
 echo "<tr><td class=left>SQL rDB: $stat[count] in $stat[time] (cached $stat[cache])</td></tr>";
 $executeTime = $time - $sqlTime;
 echo "<tr><td class=left>PHP time: $executeTime</td></tr>";
 echo "<tr><td class=left>SQL time: $sqlTime</td></tr>";
 echo "</tbody>";
 echo "</table>";

 // Dump sql log
 if ($db_log)
   echo '<div style="text-align:left; font-size: 11px">'.$db_log.'</div>';
}
?>
<script type="text/javascript">parseHref(document);</script>

