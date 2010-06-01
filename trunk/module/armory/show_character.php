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

 if (!$ajaxmode)
 echo '
 <ul class=my_tabs>
 <li><a onclick="return uploadFromHref(this, \'reportContainer\');" href=?player='.$guid.'>Персонаж</a></li>
 <li><a onclick="return uploadFromHref(this, \'reportContainer\');" href=?player='.$guid.'&tab=talents>Таланты</a></li>
 <li><a onclick="return uploadFromHref(this, \'reportContainer\');" href=?player='.$guid.'&tab=skill>Умения</a></li>
 <li><a onclick="return uploadFromHref(this, \'reportContainer\');" href=?player='.$guid.'&tab=achievements>Достижения</a></li>
 <li><a onclick="return uploadFromHref(this, \'reportContainer\');" href=?player='.$guid.'&tab=reputation>Репутация</a></li>
 <li><a onclick="return uploadFromHref(this, \'reportContainer\');" href=?player='.$guid.'&tab=quests>Квесты</a></li>';
 //<li><a onclick="return uploadFromHref(this, \'reportContainer\');" href=?player='.$guid.'&tab=inventory>Инвентарь</a></li>
 //<li><a onclick="return uploadFromHref(this, \'reportContainer\');" href=?player='.$guid.'&tab=guild>Гильдия</a></li>
 echo '</ul>
 <div id=reportContainer>';

 if ($tab == '')
 {
  include ("show_char_equip.php");
  showPlayerEquip($guid, $char, $char_data, $char_stats);
// 3D модель
// получаем displayid вещи
function wowhead_did($item)
{
    global $dDB;
    $displayid = $dDB->selectCell("SELECT displayid FROM item_template WHERE entry = ?d", $item);
    echo $displayid;
}
// получаем расу и класс в виде, пригодном для WH 3D просмотрщика
function char_racegender($race, $gender)
{
    $char_race = array(
        1 => 'human',
        2 => 'orc',
        3 => 'dwarf',
        4 => 'nightelf',
        5 => 'scourge',
        6 => 'tauren',
        7 => 'gnome',
        8 => 'troll',
        10 => 'bloodelf',
        11 => 'draenei');

    $char_gender = array(
        0 => 'male',
        1 => 'female');

    echo $char_race[$race].$char_gender[$gender];
}
?>
<div id="model_scene" align="center">
<object id="wowhead" type="application/x-shockwave-flash" data="http://static.wowhead.com/modelviewer/ModelView.swf" height="640px" width="480px"> 
<param name="quality" value="high">
<param name="allowscriptaccess" value="always">
<param name="menu" value="false">
<param value="transparent" name="wmode">
<param name="flashvars" value="model=<?php char_racegender($char['race'], $char['gender']); ?>&amp;modelType=16&amp;ha=0&amp;hc=0&amp;fa=0&amp;sk=0&amp;fh=0&amp;fc=0&amp;contentPath=http://static.wowhead.com/modelviewer/&amp;blur=1&amp;equipList=1,<?php wowhead_did($char_data[PLAYER_SLOT_ITEM_HEAD]); ?>,3,<?php wowhead_did($char_data[PLAYER_SLOT_ITEM_SHOULDER]); ?>,16,<?php wowhead_did($char_data[PLAYER_SLOT_ITEM_BACK]); ?>,5,<?php wowhead_did($char_data[PLAYER_SLOT_ITEM_CHEST]); ?>,9,<?php wowhead_did($char_data[PLAYER_SLOT_ITEM_WRIST]); ?>,10,<?php wowhead_did($char_data[PLAYER_SLOT_ITEM_GLOVES]); ?>,6,<?php wowhead_did($char_data[PLAYER_SLOT_ITEM_BELT]); ?>,7,<?php wowhead_did($char_data[PLAYER_SLOT_ITEM_LEGS]); ?>,8,<?php wowhead_did($char_data[PLAYER_SLOT_ITEM_FEET]); ?>,14,<?php wowhead_did($char_data[PLAYER_SLOT_ITEM_OFF_HAND]); ?>,21,<?php wowhead_did($char_data[PLAYER_SLOT_ITEM_MAIN_HAND]); ?>">
<param name="movie" value="http://static.wowhead.com/modelviewer/ModelView.swf">
</object>
</div>
<?php
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
  showPlayerTalents($guid, $class, $char['level']);
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
