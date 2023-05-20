<?php
include_once("include/map_data.php");
include_once("lang/game_text.".$config['lang'].".php");
include_once("include/functions.php");

$area = @$_REQUEST['area'];
$map  = @$_REQUEST['map'];
if ($area)
{
   $mob_id = @$_REQUEST['npc'];
   $obj_id = @$_REQUEST['obj'];
   $list = 0;
   if ($mob_id)
    $list = $dDB->select("SELECT * FROM `creature` WHERE `id` = ?d", $mob_id);
   else if ($obj_id)
    $list = $dDB->select("SELECT * FROM `gameobject` WHERE `id` = ?d", $obj_id);
   if ($area == 0 && $list)
      $area = getAreaIdFromPoint($list[0]['map'], $list[0]['position_x'], $list[0]['position_y'], $list[0]['position_z']);
   renderArea($area, @$_REQUEST['width'], $list);
}
else if ($map)
{
   $mob_id = @$_REQUEST['npc'];
   $obj_id = @$_REQUEST['obj'];
   $list = 0;
   if ($mob_id)
    $list = $dDB->select("SELECT * FROM `creature` WHERE `id` = ?d", $mob_id);
   else if ($obj_id)
    $list = $dDB->select("SELECT * FROM `gameobject` WHERE `id` = ?d", $obj_id);
   renderMap($map, @$_REQUEST['width'], $list);
}
?>