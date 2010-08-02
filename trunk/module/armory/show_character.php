<?php
include_once("conf.php");
include_once("include/functions.php");
include_once("include/player_data.php");

$guid = intval(@$_REQUEST['player']);
$tab  = @$_REQUEST['tab'];
$char = getCharacter($guid);
$char_stats = getCharacterStats($guid);

if (!$char)
{
}
else
{
 $char_data = explode(' ',$char['equipmentCache']);
 //$powerType =($char_data[UNIT_FIELD_BYTES_0]>>24)&255;
 $genderId  =$char['gender'];
 $class     =$char['class'];
 $race      =$char['race'];

 if (!$ajaxmode){
 echo '
 <ul class=my_tabs>
 <li><a onclick="return uploadFromHref(this, \'reportContainer\');" href=?player='.$guid.'>Персонаж</a></li>
 ';
 if ($config['show_player_3d']) echo '<li><a onclick="return uploadFromHref(this, \'reportContainer\');" href=?player='.$guid.'&tab=3d>Персонаж 3D</a></li>';
 echo '
 <li><a onclick="return uploadFromHref(this, \'reportContainer\');" href=?player='.$guid.'&tab=talents>Таланты</a></li>
 <li><a onclick="return uploadFromHref(this, \'reportContainer\');" href=?player='.$guid.'&tab=skill>Умения</a></li>
 <li><a onclick="return uploadFromHref(this, \'reportContainer\');" href=?player='.$guid.'&tab=achievements>Достижения</a></li>
 <li><a onclick="return uploadFromHref(this, \'reportContainer\');" href=?player='.$guid.'&tab=reputation>Репутация</a></li>
 <li><a onclick="return uploadFromHref(this, \'reportContainer\');" href=?player='.$guid.'&tab=quests>Квесты</a></li>';
 //<li><a onclick="return uploadFromHref(this, \'reportContainer\');" href=?player='.$guid.'&tab=inventory>Инвентарь</a></li>
 //<li><a onclick="return uploadFromHref(this, \'reportContainer\');" href=?player='.$guid.'&tab=guild>Гильдия</a></li>
 echo '</ul>
 <div id=reportContainer>';
 };

 if ($tab == '')
 {
  include ("show_char_equip.php");
  showPlayerEquip($guid, $char, $char_data, $char_stats);
 }

 if ($config['show_player_3d'] &&
 $tab=='3d')
 {
  include("show_char_3d.php");
  showPlayer3d($char, $char_data);
 }

 if (//$config['show_player_fields'] &&
 $tab=='data')
 {
  include("show_char_data.php");
  showPlayerData($char_data);
 }
 /*
 if ($tab == 'inventory')
 {
  include ("show_char_inventory.php");
  showPlayerInventory($guid, $char_data);
 }*/

 if ($tab == 'talents')
 {
  include("show_char_talents.php");
  showPlayerTalents($guid, $class, $char['level'], $char['activespec']);
 }

 if ($tab == 'skill')
 {
  include("show_char_skill.php");
  showPlayerSkills($guid, $char_data);
 }

 if ($tab == 'achievements')
 {
  include("show_char_achievements.php");
  showPlayerAchievements($guid, getPlayerFaction($race));
 }

 if ($tab == 'reputation')
 {
  include("show_char_reputation.php");
  showPlayerReputation($guid, $class, $race);
 }
 /*
 if ($tab == 'guild')
 {
  include("show_char_guild.php");
  $guildid = 0;
  showPlayerGuild($guid, $char_data);
 }*/

 if ($tab == 'quests')
 {
  include("show_char_quest.php");
  showPlayerQuests($guid);
 }

 if (!$ajaxmode)
   echo '</div>';
}
?>
