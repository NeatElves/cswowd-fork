<?php
include_once("../conf.php");
include_once("zone_tables.php");
mysql_connect($config['hostname'],$config['username'],$config['password']) or die("Unable to connect to the database.".mysql_error());
mysql_select_db($config['dbName']) or die(mysql_error());

echo "<html>";
echo "<head>";
echo "<meta http-equiv=Content-Type content=text/html; charset=utf-8>";
echo "<title></title>";
static $baseImagePath = "img/map_image/";

$id  = intval(@$_REQUEST['id']);
if ($map=="")
$map = intval(@$_REQUEST['map']);
$x = intval(@$_REQUEST['x']);
$y = intval(@$_REQUEST['y']);

$map_info = get_Map($map);
if ($map_info==0)
{
 $name=get_map_name($map);
 echo "<center><table valign=\"bottom\"><tr><td><img src=\"../images/wowd.jpg\"></td></tr><tr><td><center>Отсутствует карта: $name</center></td></tr></table></center>";
}
else
{
$map    = $map_info[0];
$name   = $map_info[1];
$areaX1 = $map_info[2];
$areaX2 = $map_info[3];
$areaY1 = $map_info[4];
$areaY2 = $map_info[5];
$imageX = $map_info[6];
$imageY = $map_info[7];
$background = $baseImagePath.$map_info[8];
?>
<style type="text/css">
<!--
body {
        margin-left: 0px;
        margin-top: 0px;
        margin-right: 0px;
        margin-bottom: 0px;
        color: #EABA28;
        background-color: #000000;
}
-->
</style>
</head>
<body>

<?php
echo "<center>";

$scale=floatval(@$_REQUEST['scale']);
if ($scale==0) $scale=1;
if ($scale<0.25) $scale=0.25;
//if ($imageY>768) $scale = 2;
$imageX/=$scale;
$imageY/=$scale;
$sizeX = $imageY;
$sizeY = $imageX+4;
$tableBorder = 1;
$tableWidth  = $imageY+$tableBorder*2+8;
echo "<table border=$tableBorder width=$tableWidth>";
echo "<tbody><tr><td align = center>$name</td></tr>";
echo "<tr><td width=$sizeX height=$sizeY align=left valign=top>";
echo "<span style=\"position: relative; border: 0px; left: 0; top: 0;\">&nbsp;";
echo "<img src=$background width=$imageY height=$imageX style=\"position: absolute; border: 0px; left: 0; top: 0;\">";
if ($x!=0 && $y!=0)
{
 $x=round($imageX*($x - $areaX1)/($areaX2-$areaX1)-8,0);
 $y=round($imageY*($y - $areaY1)/($areaY2-$areaY1)-8,0);
 echo "<img src=\"img/gps_icon.png\" style=\"position: absolute; border: 0px; left: $y; top: $x;\">\n";
}

$res2 = mysql_query("SELECT * FROM `gameobject` WHERE `map`='$map' ORDER BY `id`") or die(mysql_error());
$lastID = -1;
while ($row2=mysql_fetch_array($res2))
{
 if ($row2['id']!=$lastID)
 {
  $res = mysql_query("SELECT * FROM `gameobject_template` WHERE entry = '$row2[id]' LIMIT 1") or die(mysql_error());
  $row = mysql_fetch_array($res);
  $row['name']=str_replace("'","`",$row['name']);
  $row['name']=str_replace("\"","`",$row['name']);
  mysql_free_result($res);
  $lastID = $row2['id'];
 }
 $mapID= $row2['map'];
 $posx = $row2['position_x'];
 $posy = $row2['position_y'];
 $type = $row['type'];
 $time1 = get_time_text($row2['spawntimesecsmin']);
 $time2 = get_time_text($row2['spawntimesecsmax']);

 if ($row2['id']==$id){$img = "img/gps_icon.png";$centerImage = 8;}
 else                 {$img = "img/iron.gif";    $centerImage = 4;}

 if ($areaX1 > $posx && $areaX2 < $posx &&
     $areaY1 > $posy && $areaY2 < $posy && $map == $mapID)
 {
    $x=$imageX*($posx - $areaX1)/($areaX2-$areaX1)-$centerImage;
    $y=$imageY*($posy - $areaY1)/($areaY2-$areaY1)-$centerImage;
    $name = validateTextForMap($row['name']);
    echo "<img src=\"$img\" style=\"position: absolute; border: 0px; left: $y; top: $x;\"onmouseover=\"this.T_TITLE='<div align=center>$name</div>';return escape('Респавн: $time1 - $time2<br>GUID $row2[guid]<br>$posx $posy $row2[position_z] $row2[map]')\"></a>\n";
 }
}
$res2 = mysql_query("SELECT * FROM `creature` WHERE `map`='$map' ORDER BY `id`") or die(mysql_error());
$lastID = -1;
while ($row2=mysql_fetch_array($res2))
{
 if ($row2['id']!=$lastID)
 {
  $res = mysql_query("SELECT * FROM `creature_template` WHERE Entry = '$row2[id]' LIMIT 1") or die(mysql_error());
  $row = mysql_fetch_array($res);
  $row['name']=str_replace("'","`",$row['name']);
  $row['name']=str_replace("\"","`",$row['name']);
  mysql_free_result($res);
  $lastID = $row2['id'];
 }
 $mapID= $row2['map'];
 $posx = $row2['position_x'];
 $posy = $row2['position_y'];
 $type = $row['type'];
 $time1 = get_time_text($row2['spawntimesecsmin']);
 $time2 = get_time_text($row2['spawntimesecsmax']);

 if ($row2['id']==$id){$img = "img/gps_icon.png";$centerImage = 8;}
 else                 {$img = "img/green.gif";   $centerImage = 2;}

// if ($areaX1 > $posx && $areaX2 < $posx &&
//     $areaY1 > $posy && $areaY2 < $posy && $map == $mapID)
 {
    $x=$imageX*($posx - $areaX1)/($areaX2-$areaX1)-$centerImage;
    $y=$imageY*($posy - $areaY1)/($areaY2-$areaY1)-$centerImage;
    $name = validateTextForMap($row['name']);
    echo "<img src=\"$img\" style=\"position: absolute; border: 0px; left: $y; top: $x;\"onmouseover=\"this.T_TITLE='<div align=center>$name</div>';return escape('Уровень: $row[minlevel]-$row[maxlevel]<br>Ранг $row[rank]<br>Тип: $NPCType[$type]<br>Жизнь: $row2[curhealth]<br>Урон: $row[mindmg] - $row[maxdmg]<br>Респавн: $time1 - $time2<br>GUID $row2[guid]<br>$posx $posy $row2[position_z] $row2[map]')\"></a>\n";
 }
}
echo "</span>";
echo "</td></tr></tbody>";
echo "</table>";
echo "</center>";
?>

<script language="JavaScript" type="text/javascript" src="wz_tooltip.js"></script>
<script language="JavaScript" type="text/javascript"></script>
</body>
</html>
<?php
}
?>