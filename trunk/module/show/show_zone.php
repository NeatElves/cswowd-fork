<?php
##########
/*
 Скрипт показывает Зону по $entry
 Показывает:
  - Карту зоны (или карту той зоны в частью которой является)
  - В состав какой зоны входит (если есть)
  - Какие зоны входят в состав
  - Какие НИП находятся в зоне
  - Какие объекты находятся в зоне
  - Лут с рыбалки в зоне
*/

include_once("include/map_data.php");
include_once("include/report_generator.php");
include_once("include/info_table_generator.php");

$entry = intval(@$_REQUEST['zone']);
$npc_id = intval(@$_REQUEST['npc']);
$obj_id = intval(@$_REQUEST['obj']);
$width  = intval(@$_REQUEST['width']) ? intval(@$_REQUEST['width']) : 900;

$page  = intval(@$_REQUEST['page']);
$mark  = @$_REQUEST['mark'];

$area = getArea($entry);
if (!$area)
{
   RenderError($lang['area_not_found']);
}
else
{
  $baseLink='?zone='.$entry;
  if (@$_REQUEST['npc']) $baseLink.="&npc=$npc_id";
  if (@$_REQUEST['obj']) $baseLink.="&obj=$obj_id";
  if (@$_REQUEST['width'])  $baseLink.="&width=$width";

  $zentry = $area['zone_id'] ? $area['zone_id'] : $entry;
  $map = $area['map_id'];
  $zone = getArea($zentry);

  $area_data = @getRenderAreaData($gZoneToAreaImage[$zentry]);

  if ($area_data && !isset($_REQUEST['mark']))
  {
     if ($ajaxmode==0)
     {
  if ($lang['www_zone'])
    echo "<a href=\"".sprintf($lang['www_zone'], $entry)."\" target=\"_blank\"\">".sprintf($lang['www_zone'], $entry)."</a><br>"; 
       if ($zentry!=$entry)
           echo $area['name'].'<br>';
       echo "<div id=mapper>";
     }
     $pointsList = new mapPoints();
     if ($npc_id) $pointsList->addNpc($npc_id, $map);
     if ($obj_id) $pointsList->addGo($obj_id, $map);
     renderArea($gZoneToAreaImage[$zentry], $width, $pointsList->points);
     if ($ajaxmode==0)
     {
       echo "</div>";
       echo "<script type=\"text/javascript\" src=\"js/mapper.js\"></script>";
       echo "<script type=\"text/javascript\">cacheMap('$baseLink')</script>";
     }
  }
  else if ($map && !isset($_REQUEST['mark']))
  {
  if ($ajaxmode==0)
     echo "<div id=mapper>";
  if ($npc_id || $obj_id)
     renderMap($map, $width, createPointsList($npc_id, $obj_id));
     if ($ajaxmode==0)
     {
       echo "</div>";
       echo "<script type=\"text/javascript\" src=\"js/mapper.js\"></script>";
       echo "<script type=\"text/javascript\">cacheMap('$baseLink')</script>";
     }
  }
  createReportTab();
  function r_npcDungeon($data){global $lang; echo '<a href="?zone='.@$_REQUEST['zone'].'&npc='.$data['Entry'].'" onClick="return uploadFromHref(this, \'mapper\');">'.$lang['show_map'].'&nbsp;('.getCreatureCount($data['Entry']).')</a>';}
  function r_objDungeon($data){global $lang; echo '<a href="?zone='.@$_REQUEST['zone'].'&obj='.$data['entry'].'" onClick="return uploadFromHref(this, \'mapper\');">'.$lang['show_map'].'&nbsp;('.getGameobjectCount($data['entry']).')</a>';}
  //********************************************************************************
  // Parent zones
  //********************************************************************************
  if ($zentry!=$entry)
  {
   $parent =& new ZoneReportGenerator();
   $fields = array('ZONE_REPORT_ID', 'ZONE_REPORT_NAME');
   if ($parent->Init($fields, $baseLink, 'zoneLIST', $config['fade_limit'], 'name'))
   {
    $parent->parentZone($zentry);
    $parent->createReport($lang['zone_parent']);
   }
  }
  //********************************************************************************
  // Sub zones
  //********************************************************************************
  $sub =& new ZoneReportGenerator();
  $fields = array('ZONE_REPORT_ID', 'ZONE_REPORT_NAME');
  if ($sub->Init($fields, $baseLink, 'subzoneLIST', $config['fade_limit'], 'name'))
  {
    $sub->subZones($entry);
    $sub->createReport($lang['zone_subzones']);
  }
  //********************************************************************************
  // НИП в зоне
  //********************************************************************************
  $npc =& new CreatureReportGenerator('position');
  $fields = array('NPC_REPORT_LEVEL', 'NPC_REPORT_RNAME', 'NPC_REPORT_ROLE', 'NPC_REPORT_DUNGEON');
  if ($npc->Init($fields, $baseLink, 'npcLIST', $config['fade_limit'], 'name'))
  {
    $npc->addColumnConfig('NPC_REPORT_DUNGEON', array('class'=>'small','sort'=>'','text'=>$lang['map'],'draw'=>'r_npcDungeon','sort_str'=>'','fields'=>''));
    if (!$area_data)
      	$npc->onMap($map);
	else
        $npc->onArea($area_data);
    $npc->createReport($lang['zone_npc_in']);
  }
  //********************************************************************************
  // GO в зоне
  //********************************************************************************
  $go =& new GameobjectReportGenerator('position');
  $fields = array('GO_REPORT_NAME', 'GO_REPORT_TYPE', 'GO_REPORT_DUNGEON');
  if ($go->Init($fields, $baseLink, 'goLIST', $config['fade_limit'], 'name'))
  {
    $go->addColumnConfig('GO_REPORT_DUNGEON', array('class'=>'small','sort'=>'','text'=>$lang['map'],'draw'=>'r_objDungeon','sort_str'=>'','fields'=>''));
    if (!$area_data)
      	$go->onMap($map);
	else
        $go->onArea($area_data);
    $go->createReport($lang['zone_go_in']);
  }
  //********************************************************************************
  // Fishing in area
  //********************************************************************************
  if ($ajaxmode==0)
  {
    $page_seek = init_pagePerMark($mark, "fishing_lootLIST", $page);
    $rows = getLootList($entry, "fishing_loot_template", $totalRecords, $page_seek, $config['fade_limit']);
    renderLootTableList($rows, $lang['contain_fishing_loot'], $page_seek, $totalRecords, $baseLink, "fishing_lootLIST");
  }
}

?>