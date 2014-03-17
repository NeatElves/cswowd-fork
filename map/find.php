<?php
include("../conf.php");
include ("zone_tables.php");
mysql_connect($config['hostname'],$config['username'],$config['password']) or die("Unable to connect to the database. Maybe the server is down.");
mysql_select_db($config['dbName']) or die(mysql_error());

?>
<style type="text/css">
<!--
body {
        background-color: #808080;
}
body,td,th {
        color: #FFFFFF;
        font-size: 12px;
}
a:link {
        color: #FFFFFF;
}
a:visited {
        color: #FFFFFF;
}
a:hover {
        color: #FFFFFF;
}
a:active {
        color: #FF0000;
}
-->
</style>
<?php
$name  = @$_REQUEST['name'];
$name = mysql_real_escape_string($name);
$entry = intval(@$_REQUEST['entry']);

if ($name == "" and $entry=="") { die(); }
$background = "map.jpg";

echo "<table width=\"100%\" border=\"0\">";
echo "<tr>Поиск существ</tr>";
     if ($name !="") $res = mysql_query("SELECT * FROM `creature_template` WHERE name like '%$name%' ORDER BY `name`") or die(mysql_error());
else if ($entry!="") $res = mysql_query("SELECT * FROM `creature_template` WHERE entry = '$entry' ORDER BY `name`") or die(mysql_error());

while ($row=mysql_fetch_array($res))
{
 $res2 = mysql_query("SELECT * FROM `creature` WHERE id = '$row[entry]'") or die(mysql_error());
 $count= mysql_num_rows($res2);
 $row2=mysql_fetch_array($res2);

 if ($row2['map']==0 OR $row2['map']==1 OR $row2['map']==530)
  $map  = get_zone_name($row2['map'],$row2['position_x'],$row2['position_y']);
 else
  $map  = get_map_name($row2['map']);
 echo "<tr>";
 echo "<td><img src=img/human.gif></td>";
 echo "<td><$row[minlevel]-$row[maxlevel]></td>";
 if ($count==0) echo "<td>$row[name]</td>";
 else           echo "<td><a href=\"gps2.php?id=$row[entry]\" target=\"zzz\">$row[name]";
 if ($map!="")  echo "<br><FONT color=#F0F00F size=-2>&lt;$map&gt;</FONT>";
 echo "</a></td>";
 echo "<td>$count</td>";
 echo "</tr>";
}
echo "</table>";

echo "<table width=\"100%\" border=\"0\">";
echo "<tr>Поиск обьектов</tr>";
if ($name!="")
$res = mysql_query("SELECT * FROM `gameobject_template` WHERE name like '%$name%' ORDER BY `name`") or die(mysql_error());
else if ($entry!="")
$res = mysql_query("SELECT * FROM `gameobject_template` WHERE entry = '$entry' ORDER BY `name`") or die(mysql_error());
while ($row=mysql_fetch_array($res))
{
 $row['name']=str_replace("'","",$row['name']);
 $res2 = mysql_query("SELECT * FROM `gameobject` WHERE id = '$row[entry]'") or die(mysql_error());
 $count= mysql_num_rows($res2);
 echo "<tr>";
 echo "<td><img src=img/iron.gif></td>";
 if ($count==0) echo "<td>$row[name]</td>";
 else           echo "<td><a href=\"gps2.php?id=$row[entry]&where=gameobject\" target=\"zzz\">$row[name]</a></td>";
 echo "<td>($count)</td>";
 echo "</tr>";
}
echo "</table>";

?>
