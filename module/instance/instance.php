<?php
include_once("include/functions.php");
include_once("include/report_generator.php");
include_once("include/map_data.php");

$mapId = @$_REQUEST['instance'] == '' ? -1 : intval(@$_REQUEST['instance']);
if ($mapId==-1)
{
  // Вывод таблицы со списком инстансов
  include("inst_list.php");
}
else
{
 $dungeon = isDungeon($mapId);
 // Вывод карты, мобов и ГО инстанса
 $baseLink = "?instance=$mapId";

 // Если это не ajax подгрузка данных
 if ($ajaxmode == 0)
 {
 //$config['lang']
   $desc_file = 'lang/map_'.'ru'.'/'.$mapId.'.html';
   if (file_exists($desc_file)) include($desc_file);

   // Выводим карту если есть дляэтого данные
   if ($map = getRenderMapData($mapId))
   {
     // Вывод карты делаетсяс помощью java script
     // Необходимо только записать данные для него в $mapdata
     echo "<script type=\"text/javascript\" src=\"js/mapper.js\"></script>";
     $mapdata = array();
     $mapdata['header'] = getMapName($mapId);
     $mapdata['imageX'] = $map[5];
     $mapdata['imageY'] = $map[4];
     $mapdata['image']  = "images/map_image/maps/".$map[6];
     $mapdata['defImg'] = "images/map_points/green.gif";
     $mapdata['defImgX'] = 2;
     $mapdata['defImgY'] = 2;
     $mapdata['selImg'] = "images/map_points/gps_icon.png";
     $mapdata['selImgX'] = 7;
     $mapdata['selImgY'] = 7;
     // Вспомогательные переменные
     $areaX1 = $map[0];
     $areaX2 = $map[1];
     $areaY1 = $map[2];
     $areaY2 = $map[3];
     $i=0;

     //***********************************
     // Обьекты
     //***********************************
     $go_list = $dungeon ? $dDB->selectPage($totalRecords,
     "SELECT
      `guid`,
      `id`,
      `map`,
      `position_x`,
      `position_y`,
      `position_z`,
      `spawntimesecs`
      FROM
      `gameobject`
      WHERE
      `map` = ?d
      ORDER BY `id`", $mapId) : 0;
     if ($go_list)
     foreach ($go_list as $point)
     {
       $posMap= $point['map'];
       $posX  = $point['position_x'];
       $posY  = $point['position_y'];
       $posZ  = $point['position_z'];
       transformWorldCoordinates($posMap, $posX, $posY, $posZ);
       if ($mapId == $posMap AND
           $areaY1 >= $posY AND $areaY2 <= $posY AND
           $areaX1 >= $posX AND $areaX2 <= $posX)
       {
         $x = ($posX-$areaX1)/($areaX2-$areaX1)*100;
         $y = ($posY-$areaY1)/($areaY2-$areaY1)*100;

         $o = getGameobject($point['id']);
         $id= "o".$point['id'];
         $mapdata['points'][$i]['id']=$id;
         $mapdata['points'][$i]['x']=$y;
         $mapdata['points'][$i]['y']=$x;
         $mapdata['points'][$i]['image']="images/map_points/vein.gif";
         $mapdata['points'][$i]['icenterx']=4;
         $mapdata['points'][$i]['icentery']=4;
         $mapdata['points'][$i]['href']="\"?object=".$point['id']."\" onclick=\"return changeSelect('".$id."');\"";
         $tt = "<table class=maptooltip>";
         $tt.= "<tr><td class=name>".getGameobjectType($o['type'])." - ".validateText($o['name'])." (".$point['guid'].")</td></tr>";
         $tt.= "</table>";
         $mapdata['points'][$i]['tooltip']= $tt;
         $i++;
       }
     }
     //***********************************
     // Существа
     //***********************************
     $creatures_list = $dungeon ? $dDB->selectPage($totalRecords,
     "SELECT
      `guid`,
      `id`,
      `map`,
      `position_x`,
      `position_y`,
      `position_z`,
      `spawntimesecs`
      FROM
      `creature`
      WHERE
      `map` = ?d
      ORDER BY `id`", $mapId) : 0;
     if ($creatures_list)
     foreach ($creatures_list as $point)
     {
       $posMap= $point['map'];
       $posX  = $point['position_x'];
       $posY  = $point['position_y'];
       $posZ  = $point['position_z'];
       transformWorldCoordinates($posMap, $posX, $posY, $posZ);
       if ($mapId == $posMap AND
           $areaY1 >= $posY AND $areaY2 <= $posY AND
           $areaX1 >= $posX AND $areaX2 <= $posX)
       {
         $x = ($posX-$areaX1)/($areaX2-$areaX1)*100;
         $y = ($posY-$areaY1)/($areaY2-$areaY1)*100;

         $c = getCreature($point['id']);
         $id= "c".$point['id'];
         $mapdata['points'][$i]['id']=$id;
         $mapdata['points'][$i]['x']=$y;
         $mapdata['points'][$i]['y']=$x;
         $mapdata['points'][$i]['image']=0;
         $mapdata['points'][$i]['icenterx']=0;
         $mapdata['points'][$i]['icentery']=0;
         $mapdata['points'][$i]['href']="\"?npc=".$point['id']."\" onclick=\"return changeSelect('".$id."');\"";
         $tt = "<table class=maptooltip>";
         $tt.= "<tr><td class=name>".validateText($c['name'])." (".$point['guid'].")</td></tr>";
         $tt.= "</table>";
         $mapdata['points'][$i]['tooltip']= $tt;
         $i++;
       }
     }
	 // Portals to area
     $teleport_list = $dDB->selectPage($totalRecords,'SELECT * FROM `areatrigger_teleport` WHERE `target_map` = ?d', $mapId);
     if ($teleport_list)
     foreach ($teleport_list as $point)
     {
       $posMap= $point['target_map'];
       $posX  = $point['target_position_x'];
       $posY  = $point['target_position_y'];
       $posZ  = $point['target_position_z'];
       transformWorldCoordinates($posMap, $posX, $posY, $posZ);
       if ($mapId == $posMap AND
           $areaY1 >= $posY AND $areaY2 <= $posY AND
           $areaX1 >= $posX AND $areaX2 <= $posX)
       {
         $x = ($posX-$areaX1)/($areaX2-$areaX1)*100;
         $y = ($posY-$areaY1)/($areaY2-$areaY1)*100;
         $mapdata['points'][$i]['id']=$point['id'];
         $mapdata['points'][$i]['x']=$y;
         $mapdata['points'][$i]['y']=$x;
         $mapdata['points'][$i]['image']="images/map_points/binder_icon.gif";
         $mapdata['points'][$i]['icenterx']=8;
         $mapdata['points'][$i]['icentery']=8;
		 $mapdata['points'][$i]['href']='';
         $mapdata['points'][$i]['tooltip']= validateText($point['name']);
         $i++;
       }
     }

     // Выбираем лучший масштаб
     if ($mapdata['imageX'])
     {
       $bestScale = 768 / $mapdata['imageX'];
            if ($bestScale > 0.00 && $bestScale < 0.40) $bestScale = 0.25;
       else if ($bestScale > 0.40 && $bestScale < 0.62) $bestScale = 0.50;
       else if ($bestScale > 0.62 && $bestScale < 0.87) $bestScale = 0.75;
       else if ($bestScale > 0.87 && $bestScale < 1.5)  $bestScale = 1.00;
       else                                             $bestScale = 2.00;
       echo "<script type=\"text/javascript\">setScale($bestScale);</script>";
     }
     // Сюда будет создана карта скриптом
     echo "<div id=mapper></div>";
     // Записываем данные о карте в Java Script и запускаем вывод данных
     echo "<script type=\"text/javascript\">var data=".php2js($mapdata).";setMapData(data); renderInstance('mapper',0);</script>";
   }
   else
     echo $lang['inst_no_map_present'].getMapName($mapId);
 }

 createReportTab();
 if ($dungeon)
 {
  //********************************************************************************
  // Creatures on map
  //********************************************************************************
  function r_npcDungeon($data){global $lang; echo '<a href="?map&npc='.$data['entry'].'" onClick="changeSelect(\'c'.$data['entry'].'\'); return false;">'.$lang['map'].'</a>';}

  $creatures =& new CreatureReportGenerator('position');
  $creatures->addColumnConfig('NPC_REPORT_DUNGEON', array('class'=>'small','sort'=>'','text'=>$lang['map'],'draw'=>'r_npcDungeon','sort_str'=>'','fields'=>''));
  $fields = array('NPC_REPORT_RANK', 'NPC_REPORT_RNAME', 'NPC_REPORT_DUNGEON');
  if ($creatures->Init($fields, $baseLink, 'creatureLIST', $config['fade_limit'], 'rank'))
  {
    $creatures->onMap($mapId);
    $creatures->createReport($lang['inst_creature_list']);
  }

  //********************************************************************************
  // Objects on map
  //********************************************************************************
  function r_goDungeon($data){global $lang; echo '<a href="?map&obj='.$data['entry'].'" onClick="changeSelect(\'o'.$data['entry'].'\'); return false;">'.$lang['map'].'</a>';}

  $go =& new GameobjectReportGenerator('position');
  $go->addColumnConfig('GO_REPORT_DUNGEON', array('class'=>'small','sort'=>'','text'=>$lang['map'],'draw'=>'r_goDungeon','sort_str'=>'','fields'=>''));
  $fields = array('GO_REPORT_NAME', 'GO_REPORT_TYPE', 'GO_REPORT_DUNGEON');
  if ($go->Init($fields, $baseLink, 'objectLIST', $config['fade_limit'], 'name'))
  {
    $go->onMap($mapId);
    $go->createReport($lang['inst_go_list']);
  }
 }
}
?>