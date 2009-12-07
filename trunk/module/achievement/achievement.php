<?php
include_once("include/functions.php");
include_once("include/achievements.php");

$category = intval(@$_REQUEST['category']);
$faction  = intval(@$_REQUEST['faction']);
$guid     = intval(@$_REQUEST['guid']);

$faction = getAchievementFaction($guid, $faction);

if ($ajaxmode == 0)
{
  renderAchievementData($category, $guid, $faction);
}
else
{
  renderAchievementCategoryList($category, $faction, $guid);
}
?>