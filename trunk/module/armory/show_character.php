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

// 3D Char start
if ($config['3d_model'])
{
$item_head = $char_data[258]; 
$item_neck = $char_data[260]; 
$item_shoulder = $char_data[262]; 
$item_shirt = $char_data[264]; 
$item_chest = $char_data[266]; 
$item_belt = $char_data[268]; 
$item_legs = $char_data[270]; 
$item_feet = $char_data[272]; 
$item_wrist = $char_data[274]; 
$item_gloves = $char_data[276]; 
$item_finger1 = $char_data[278]; 
$item_finger2 = $char_data[280]; 
$item_trinket1 = $char_data[282]; 
$item_trinket2 = $char_data[284]; 
$item_back = $char_data[286]; 
$item_main_hand = $char_data[288]; 
$item_off_hand = $char_data[290]; 
$item_ranged_slot = $char_data[292]; 

function wowhead_did($item)
	{ 
	$test['ip'] = "localhost"; 
	$test['user'] = "user"; 
	$test['pass'] = "password"; 
	$test['world_db'] = "ytdb"; 
	mysql_connect($test['ip'], $test['user'], $test['pass']); 
	mysql_select_db($test['world_db']); 

		$it = mysql_query("SELECT displayid FROM item_template WHERE entry = '$item'"); 
		$displayid = mysql_result($it, 0);   
     
		echo $displayid; 

	}   

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
}
// 3D char end
 
 if ($config['show_player_fields'])
 {
  include("show_char_data.php");
  showPlayerData($char_data);
 }

 include ("show_char_equip.php");
 showPlayerEquip($guid, $char, $char_data);

 // 3D char start
if ($config['3d_model'])
{
global $output;

echo "<div id='model_scene' align='center'>";
echo "<object id='wowhead' type='application/x-shockwave-flash' data='http://static.wowhead.com/modelviewer/ModelView.swf' height='640px' width='480px'>";
echo "<param name='quality' value='high'>";
echo "<param name='allowscriptaccess' value='always'>";
echo "<param name='menu' value='false'>";
echo "<param value='transparent' name='wmode'>";
echo '<param name="flashvars" value="model=';
$output .= char_racegender($race, $genderId);
echo '&amp;modelType=16&amp;ha=0&amp;hc=0&amp;fa=0&amp;sk=0&amp;fh=0&amp;fc=0&amp;contentPath=http://static.wowhead.com/modelviewer/&amp;blur=1&amp;equipList=1,';
$output .= wowhead_did($item_head);
echo ',3,';
$output .= wowhead_did($item_shoulder);
echo ',16,';
$output .= wowhead_did($item_back);
echo ',5,';
$output .= wowhead_did($item_chest);
echo ',9,';
$output .= wowhead_did($item_wrist);
echo ',10,';
$output .= wowhead_did($item_gloves);
echo ',6,';
$output .= wowhead_did($item_belt);
echo ',7,';
$output .= wowhead_did($item_legs);
echo ',8,';
$output .= wowhead_did($item_feet);
echo ',14,';
$output .= wowhead_did($item_off_hand);
echo ',21,';
$output .= wowhead_did($item_main_hand);
echo '">';
echo "<param name='movie' value='http://static.wowhead.com/modelviewer/ModelView.swf'>";
echo "</object>";
echo "</div>";
}
// 3D char end

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
