<?php
include_once("../conf.php");
include_once("zone_tables.php");
echo "<html>";
echo "<head>";
echo "<meta http-equiv=Content-Type content=text/html; charset=utf-8>";
echo "<title></title>";
$id = intval(@$_REQUEST['id']);
$where = @$_REQUEST['where'];

if ($where == "gameobject")
{
 $where = "gameobject";
 $where_template = "gameobject_template";
}
else
{
  $where = "creature";
  $where_template = "creature_template";
}
if ($id == "") { echo "<center><table valign=\"bottom\"><tr><td><img src=\"../images/wowd.jpg\"></td></tr><tr><td><center>Отсутствует запрос</center></td></tr></table></center>"; die(); }

mysql_connect($config['hostname'],$config['username'],$config['password']) or die("Unable to connect to the database. Maybe the server is down.");
mysql_select_db($config['dbName']) or die(mysql_error());

// Предварительный выбор карты берётся 1 моб и определяем его местоположение
$res2 = mysql_query("SELECT * FROM `$where` WHERE id = '$id'") or die(mysql_error());
$count= mysql_num_rows($res2);
if ($count==0)
{
 echo "<center><table valign=\"bottom\"><tr><td><img src=\"../images/wowd.jpg\"></td></tr><tr><td><center>Никого не найдено</center></td></tr></table></center>";
 die();
}
$row2=mysql_fetch_array($res2);mysql_data_seek($res2,0);

$imageMAP = $row2['map'];
$background = "no_map";

$scale=2; // Масштаб карты
// Моб находится на Азероте или Калимдоре
// Карта Азерота и Калимдора на одной картинке
if ($row2['map']==0 OR $row2['map']==1)
{
 $background = "img/map_image/map.jpg";
 $imageX = 2300;
 $imageY = 1600;
 // Коэффициенты перевода координат для Азерота
 if ($row2['map']==0)
 {
  $image_DX = 472;
  $image_SX = -1180/18000;
  $image_DY = 1838;
  $image_SY = -340/5350;
 }
 // Коэффициенты перевода координат для Калимдора
 else
 {
  $image_DX = 795;
  $image_SX = -1270/19100;
  $image_DY = 318;
  $image_SY = -570/8850;
 }
}
// Карта Аутлэнда на ней также находятся Острова дреней и блудэльфов
else if ($row2['map']==530)
{
 // Весь Аутланд находится в этих координатах
 if ($row2['position_x']< 5333.3333333 AND $row2['position_x'] > -5866.666666 AND
     $row2['position_y']<10133.3333333 AND $row2['position_y'] > -1066.666666)
 {
  $background = "img/map_image/Outland_".$scale."x.jpg";
  $imageX = 5376/$scale;
  $imageY = 5376/$scale;
  $image_DX = 2560/$scale;
  $image_SX = -0.48/$scale;
  $image_DY = 4864/$scale;
  $image_SY = -0.48/$scale;
 }
 // Острова Дреней находятся тут
 else if ($row2['position_y']<-10075 AND $row2['position_y'] > -14570 AND
          $row2['position_x']<  -758 AND $row2['position_x'] > -5508)
 {
  $background = "img/map_image/Isle1.jpg";
  $imageX = 2272;
  $imageY = 2444;
  $image_DX = -256;
  $image_SX = -0.48;
  $image_DY = -4718;
  $image_SY = -0.48;
 }
 // Острова блудэльфов тут
 else if ($row2['position_y']<-4487 AND $row2['position_y'] > -9412 AND
          $row2['position_x']<11041 AND $row2['position_x'] >  6067)
 {
  $background = "img/map_image/Isle2.jpg";
  $imageX = 1746;
  $imageY = 2511;
  $image_DX = 5324;
  $image_SX = -0.48;
  $image_DY = -2345;
  $image_SY = -0.48;
 }
}
// Карты не найденна
if ($background == "no_map")
{
// echo "<center><table valign=\"bottom\"><tr><td><img src=\"../images/wowd.jpg\"></td></tr><tr><td><center>Нет этой карты</center></td></tr></table></center>";
 $map=$row2['map'];
 include("instance.php");
}
else
{
// Показ карты
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
#world {
    position: absolute;
<?php  echo "    width:  $imageX"."px".";\n"?>
<?php  echo "    height: $imageY"."px".";\n"?>
    left: 0;
    margin-left: 0px;
<?php  echo "    background-image: url($background);\n"?>
    z-index: 2;
}
-->
</style>
</head>
<body>
<div id="world">
<?php
$dx=0;$dy=0;
$sx=0;
$sy=0;
$n=0;
$res = mysql_query("SELECT * FROM `$where_template` WHERE entry = '$id'") or die(mysql_error());
$row = mysql_fetch_array($res);
$row['name']=validateTextForMap($row['name']);

/*
$img = "img/red_soft.gif";
$x = $image_DY+$image_SY*$posy;
$y = $image_DX+$image_SX*$posx;
echo "<a href=\"map.php?id=$id&where=$where&x=$posx&y=$posy&map=$row2[map]\">";
echo "<img src=\"$img\" style=\"position: absolute; border: 0px; left: $x; top: $y;
     \"onmouseover=\"this.T_TITLE='<div align=center>$row[name]</div>';
    return escape('Респавн: $time<br>GUID $row2[guid]<br>$posy $posx $row2[position_z] $row2[map]')\"
     ></a>\n";
*/



while ($row2=mysql_fetch_array($res2))
{
   if ($where == "gameobject")
   {
    $posx = $row2['position_x'];
    $posy = $row2['position_y'];
    $type = $row['type'];
    $time1 = get_time_text($row2['spawntimesecsmin']);
    $time2 = get_time_text($row2['spawntimesecsmax']);
    if ($type == "3") {$img = "img/iron.gif";    $centerImage = 4;}
    else              {$img = "img/gps_icon.png";$centerImage = 8;}
   }
   else
   {
    $posx = $row2['position_x'];
    $posy = $row2['position_y'];
    $type = $row['type'];
    $time1 = get_time_text($row2['spawntimesecsmin']);
    $time2 = get_time_text($row2['spawntimesecsmax']);

    $img = "img/gps_icon.png";$centerImage = 8;

   }
   $currentMap = $row2['map'];
   if (($currentMap==0 AND $imageMAP==1) OR ($currentMap==1 AND $imageMAP==0) OR $currentMap==$imageMAP)
   {
    if ($currentMap==0)
    {
     $image_DX = 472;
     $image_SX = -1180/18000;
     $image_DY = 1838;
     $image_SY = -340/5350;
    }
    // Коэффициенты перевода координат для Калимдора
    else if ($currentMap==1)
    {
     $image_DX = 795;
     $image_SX = -1270/19100;
     $image_DY = 318;
     $image_SY = -570/8850;
    }
    $x = $image_DY+$image_SY*$posy+0.5-$centerImage;
    $y = $image_DX+$image_SX*$posx+0.5-$centerImage;
    $sx+= $x;
    $sy+= $y;
    $n++;     
   }
   else
   {

    $x = 10+$dx;
    $y = 10+$dy;
    $dx+=8;if ($dx>160){$dx=0;$dy+=8;}
    $sx+=$x;
    $sy+=$y;
    $n++;
   }
   if ($where == "gameobject")
   {
     echo "<a href=\"map.php?id=$id&where=$where&x=$posx&y=$posy&map=$row2[map]\">";
     echo "<img src=\"$img\" style=\"position: absolute; border: 0px; left: $x; top: $y;
     \"onmouseover=\"this.T_TITLE='<div align=center>$row[name]</div>';
    return escape('Респавн: $time1 - $time2<br>GUID $row2[guid]<br>$posy $posx $row2[position_z] $row2[map]')\"
     ></a>\n";
   }
   else
   {
     echo "<a href=\"map.php?id=$id&where=$where&x=$posx&y=$posy&map=$row2[map]\">";
     echo "<img src=\"$img\" style=\"position: absolute; border: 0px; left: $x; top: $y;
     \"onmouseover=\"this.T_TITLE='<div align=center>$row[name]</div>';
    return escape('Уровень: $row[maxlevel]<br>Тип:  $NPCType[$type]<br>Жизнь:   $row2[curhealth]<br>Урон:   $row[mindmg] - $row[maxdmg]<br>Респавн: $time1 - $time2<br>GUID $row2[guid]<br>$posy $posx $row2[position_z] $row2[map]')\"
    ></a>\n";
   }
}
$sx=$sx/$n-512;
$sy=$sy/$n-384;
?>
</div>
<script language="JavaScript" type="text/javascript" src="wz_tooltip.js"></script>
<script language="JavaScript" type="text/javascript">
<?php
 echo "javascript:scroll($sx,$sy)";
?>
</script>
</body>
</html>
<?php
}
?>
