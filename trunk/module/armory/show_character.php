<?php
include_once("conf.php");
include_once("include/functions.php");
include_once("include/player_data.php");

$guid = intval(@$_REQUEST['player']);

$char=getCharacter($guid);
if (!$char)
{
}
else
{
 $char_data = explode(' ',$char['data']);
 $powerType =($char_data[UNIT_FIELD_BYTES_0]>>24)&255;
 $genderId  =($char_data[UNIT_FIELD_BYTES_0]>>16)&255;
 $class     =($char_data[UNIT_FIELD_BYTES_0]>> 8)&255;
 $race      =($char_data[UNIT_FIELD_BYTES_0]>> 0)&255;

 if ($config['show_player_fields'])
 {
  include("show_char_data.php");
  showPlayerData($char_data);
 }

 include ("show_char_equip.php");
 showPlayerEquip($guid, $char, $char_data);

 if ($config['show_player_skill'])
 {
  include("show_char_talents.php");
  showPlayerTalents($guid, $class, $char_data[UNIT_FIELD_LEVEL]);
  echo "<br>";

  include("show_char_skill.php");
  showPlayerSkills($guid, $char_data);
  echo "<br>";

  include("show_char_achievements.php");
  showPlayerAchievements($guid, getPlayerFaction($race));
  echo "<br>";

  include("show_char_reputation.php");
  showPlayerReputation($guid, $class, $race);
  echo "<br>";

  include("show_char_quest.php");
  showPlayerQuests($guid, $char_data);
 }

}
?>
