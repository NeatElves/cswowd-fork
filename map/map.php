<?php
include_once("../conf.php");
include_once("zone_tables.php");

mysql_connect($config['hostname'],$config['username'],$config['password']) or die("Unable to connect to the database.".mysql_error());
mysql_select_db($config['dbName']) or die(mysql_error());

$id = intval(@$_REQUEST['id']);
$where = @$_REQUEST['where'];
$map = intval(@$_REQUEST['map']);
$x = intval(@$_REQUEST['x']);
$y = intval(@$_REQUEST['y']);
if ($map!=0 AND $map!=1 AND $map != 530)
{
 include("instance.php");
}
else
{
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">";
$areaName=get_map_name($map);
$zone    =get_zone($map,$x,$y);
if ($zone==0)
{
 echo "<center><table valign=\"bottom\"><tr><td><img src=\"../images/wowd.jpg\"></td></tr><tr><td><center>Неизвестная зона</center></td></tr></table></center>";
 die();
}
$area = get_Area($zone[5]);
if ($area==0)
{
  echo "<center><table valign=\"bottom\"><tr><td><img src=\"../images/wowd.jpg\"></td></tr><tr><td><center>Карта не найдена(</center></td></tr></table></center>";
  die();
}
$background = "img/map_image/$areaName/$area[3].jpg";

$mapID  = $area[1];
$areaY1 = $area[4];
$areaY2 = $area[5];
$areaX1 = $area[6];
$areaX2 = $area[7];

$imageX = 668;
$imageY = 1002;

?>
<html>
<head>
<meta http-equiv=Content-Type content=text/html; charset=utf-8>
<title></title>
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
//$imageX/=1.5;
//$imageY/=1.5;
$sizeX = $imageY;
$sizeY = $imageX+4;
$tableBorder = 1;
$tableWidth  = $imageY+$tableBorder*2+8;
echo "<table border=$tableBorder width=$tableWidth>";
echo "<tbody><tr><td align = center>$areaName - $zone[4]</td></tr>";
echo "<tr><td width=$sizeX height=$sizeY align=left valign=top>";
echo "<span style=\"position: relative; border: 0px; left: 0; top: 0;\">&nbsp;";
echo "<img src=$background width=$imageY height=$imageX style=\"position: absolute; border: 0px; left: 0; top: 0;\">";
if ($x!=0 && $y!=0)
{
 $x=round($imageX*($x - $areaX1)/($areaX2-$areaX1)-8,0);
 $y=round($imageY*($y - $areaY1)/($areaY2-$areaY1)-8,0);
 echo "<img src=\"img/gps_icon.png\" style=\"position: absolute; border: 0px; left: $y; top: $x;\">\n";
}
if ($id)
{
 if ($where == "gameobject")
 {
  $res = mysql_query("SELECT * FROM `gameobject_template` WHERE entry = '$id' LIMIT 1") or die(mysql_error());
  $row = mysql_fetch_array($res);
  mysql_free_result($res);
  $res2 = mysql_query("SELECT * FROM `gameobject` WHERE id = '$id'") or die(mysql_error());
  while ($row2=mysql_fetch_array($res2))
  {
   $map  = $row2['map'];
   $posx = $row2['position_x'];
   $posy = $row2['position_y'];
   $type = $row['type'];
   if ($areaX1 > $posx && $areaX2 < $posx &&
       $areaY1 > $posy && $areaY2 < $posy && $mapID == $map)
   {
     if ($type == 3) {$img = "img/iron.gif"; $centerImage = 4; }
     else            {$img = "img/gps_icon.png"; $centerImage = 8; }
     $type = $row['type'];
     if ($row2['spawntimesecsmax'] > $row2['spawntimesecsmin']) $time = get_time_text($row2['spawntimesecsmin'])."&nbsp;-&nbsp;".get_time_text($row2['spawntimesecsmax']);
     else $time = get_time_text($row2['spawntimesecsmax']);

     $x=round($imageX*($posx - $areaX1)/($areaX2-$areaX1)-$centerImage,0);
     $y=round($imageY*($posy - $areaY1)/($areaY2-$areaY1)-$centerImage,0);
     $name = validateTextForMap($row['name']);
     echo "<a href=\"map.php?id=$id&where=$where&x=$posx&y=$posy&map=$row2[map]\">";
     echo "<img src=\"$img\" style=\"position: absolute; border: 0px; left: $y; top: $x;\"onmouseover=\"this.T_TITLE='<div align=center>$name</div>';return escape('Респавн: $time<br>GUID $row2[guid]<br>$posy $posx $row2[position_z] $row2[map]')\"></a>\n";
   }
  }
 }
 else
 {
  $res = mysql_query("SELECT * FROM `creature_template` WHERE Entry = '$id' LIMIT 1") or die(mysql_error());
  $row = mysql_fetch_array($res);
  mysql_free_result($res);

  $res2 = mysql_query("SELECT * FROM `creature` WHERE id = '$id'") or die(mysql_error());
  while ($row2=mysql_fetch_array($res2))
  {
   $map  = $row2['map'];
   $posx = $row2['position_x'];
   $posy = $row2['position_y'];

   if ($areaX1 > $posx && $areaX2 < $posx &&
       $areaY1 > $posy && $areaY2 < $posy && $mapID == $map)
   {
      if ($row2['id']==$id){$img = "img/gps_icon.png"; $centerImage = 8;}
      else                 {$img = "img/green.gif";    $centerImage = 2;}

      $row['name']=str_replace("'","`",$row['name']);
      $row['name']=str_replace("\"","`",$row['name']);
      $type = $row['type'];
      if ($row2['spawntimesecsmax'] > $row2['spawntimesecsmin']) $time = get_time_text($row2['spawntimesecsmin'])."&nbsp;-&nbsp;".get_time_text($row2['spawntimesecsmax']);
      else $time = get_time_text($row2['spawntimesecsmax']);

      $x=round($imageX*($posx - $areaX1)/($areaX2-$areaX1)-$centerImage,0);
      $y=round($imageY*($posy - $areaY1)/($areaY2-$areaY1)-$centerImage,0);

      $name = validateTextForMap($row['name']);
      echo "<a href=\"map.php?id=$id&where=$where&x=$posx&y=$posy&map=$row2[map]\">";
      echo "<img src=\"$img\" style=\"position: absolute; border: 0px; left: $y; top: $x;\"onmouseover=\"this.T_TITLE='<div align=center>$name</div>';return escape('Уровень: $row[maxlevel]<br>Тип: $NPCType[$type]<br>Жизнь: $row2[curhealth]<br>Урон: $row[mindmg] - $row[maxdmg]<br>Респавн: $time<br>GUID $row2[guid]<br>$posy $posx $row2[position_z] $row2[map]')\"></a>\n";
   }
  }
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