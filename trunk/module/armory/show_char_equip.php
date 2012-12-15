<?php
include_once("player_info_generator.php");

function showPlayerEquip($guid, $char, $char_data, $char_stat)
{

 global $lang;
 $char_name = $char['name'];
 $genderId  = $char['gender'];
 $class     = $char['class'];
 $race      = $char['race'];
 $money     = $char['money'];
 $level     = $char['level'];
 $health    = $char['health'];
 $maxhealth = $char_stat['maxhealth'];
 switch ($char['class']): 
	case 1:  	$powerType = 1;   break;
	case 2:
	case 3:
	case 5:
	case 7:
	case 8:
	case 9:
	case 11:  	$powerType = 0;   break;
	case 4: 	$powerType = 3;   break;
	case 6:  	$powerType = 6;   break;
 endswitch;
 switch ($powerType): 
	case 0:  $power = $char['power1'];  $maxpower = $char_stat['maxpower1']; break;
	case 1:  $power = $char['power2'];  $maxpower = $char_stat['maxpower2']; break;
	case 3:  $power = $char['power4'];  $maxpower = $char_stat['maxpower4']; break;  
	case 6:  $power = $char['power7'];  $maxpower = $char_stat['maxpower7']; break;
 endswitch;
 // Ярость надо делить на 10
 if ($powerType == POWER_RAGE || $powerType == POWER_RUNIC_POWER)
 {
  $power = intval($power/10);
  $maxpower = intval($maxpower/10);
 }
 echo "<table cellSpacing=0 border=0>";
 echo "<tr><td>";

 echo "<table cellSpacing=0 cellPadding=0 border=0px>";
 echo "<tbody><tr><td width=356px height=468px align=left valign=top>";
 echo "<div style=\"position: relative; border: 0px; left: 0px; top: 0px;\">";
 if (getRace($race)) $frame = $genderId."_".$race.".gif";
 else                $frame="TempPortrait.gif";
 echo "<img src=images/player_info/characterframe/$frame style=\"position: absolute; border: 0px; left: 9px; top: 6px;\">";
 echo "<img src=images/player_info/characterframe/characterframe.png style=\"position: absolute; border: 0px; left: 0px; top: 0px;\">";

 echo "<table cellspacing=0 class=playerName style='position: absolute; left: 73px; top: 15px;'>";
 echo "<tbody>";
 echo "<tr><td class=name>$char_name - ".getClass($class)." $level lvl</td></tr>";
 echo "</tbody>";
 echo "</table>";

 // Вычисление и генерация переменных $health и $maxhealth для создания изменяемой полоски
 if ($health > $maxhealth){ $health = $maxhealth; }
 $maxhealth !=   0 ? $h_percent = round($health/$maxhealth*100,0) : $h_percent = 0;
 $h_percent ==   0 ? $h_l_on_off = "left-off" : $h_l_on_off = "left-on";
 $h_percent == 100 ? $h_r_on_off = "right-on" : $h_r_on_off = "right-off";
 echo "<table cellpadding='0' cellspacing='0' width=275px style='position:absolute; top:37px; left:73px;'>";
 echo "<tbody>";
 echo "<tr>";
 echo "<td style='position:absolute; width: 275px; font-size:10px;' align = center><font color=white><b>$health / $maxhealth</b></font></td>";
 echo "<td style='width: 6px; background: url(images/bar/$h_l_on_off.gif) left no-repeat;'></td>";
 echo "<td style='width: ".($h_percent*2.75)."px; height:13px; background: url(images/bar/bar-on.gif) repeat-x;'></td>";
 echo "<td style='width: ".(275-$h_percent*2.75)."px; height:13px; background: url(images/bar/bar-off.gif) repeat-x;'></td>";
 echo "<td style='width: 6px;background: url(images/bar/$h_r_on_off.gif) right no-repeat;'></td>";
 echo "</tr>";
 echo "</tbody>";
 echo "</table>";

 // Вычисление и генерация переменных $power и $maxpower для создания изменяемой полоски
 if ($power > $maxpower){ $power = $maxpower; }

 //Цвет полоски
     if ($powerType == 3) $typeSlid="energy"; //Энергия
 elseif ($powerType == 1) $typeSlid="rage";   //Ярость
 else                     $typeSlid="mana";   //Мана

 $m_percent  = $maxpower  !=   0 ? round($power/$maxpower*100,0) : 0;
 $m_l_on_off = $m_percent ==   0 ? "left-off" : "$typeSlid-left-on";
 $m_r_on_off = $m_percent == 100 ? "$typeSlid-right-on" : "right-off";

 echo "<table cellpadding='0' cellspacing='0' width=275px style='position:absolute; top:55px; left:73px'>";
 echo "<tbody>";
 echo "<tr>";
 echo "<td style='position:absolute; width: 275px; font-size:10px;' align = center><font color=white><b>$power / $maxpower</b></font></td>";
 echo "<td style='width: 6px; height:13px; background: url(images/bar/$m_l_on_off.gif) left no-repeat;'></td>";
 echo "<td style='width: ".($m_percent*2.75)."px; height:13px; background: url(images/bar/$typeSlid-bar-on.gif) repeat-x;'></td>";
 echo "<td style='width: ".(275-$m_percent*2.75)."px; height:13px; background: url(images/bar/bar-off.gif) repeat-x;'></td>";
 echo "<td style='width: 6px; height:13px; background: url(images/bar/$m_r_on_off.gif) right no-repeat;'></td>";
 echo "</tr>";
 echo "</tbody>";
 echo "</table>";

 // Player stats render
 echo '<table class=playerstats cellSpacing=0 style="width: 230px; position: absolute; left: 68px; top: 78px;">';
 echo '<tbody>';

 // Resistances render
 echo '<tr><td colspan=2 align=center>';
 echo '<table class=resistances cellSpacing=0>';
 echo '<tbody>';
 echo "<tr>\n";
 renderResist(SCHOOL_FIRE,$char_stat['resFire'],$char); echo "\n";
 renderResist(SCHOOL_NATURE,$char_stat['resNature'],$char); echo "\n";
 renderResist(SCHOOL_FROST,$char_stat['resFrost'],$char); echo "\n";
 renderResist(SCHOOL_SHADOW,$char_stat['resShadow'],$char); echo "\n";
 renderResist(SCHOOL_ARCANE,$char_stat['resArcane'],$char); echo "\n";
 echo "</tr>\n";
 echo '</tbody>';
 echo '</table>';
 echo '</td></tr>';

 echo '<tr><td class=head width=50%>'.$lang['player_page_base'].'</td><td class=head width=50%>'.$lang['player_page_defence'].'</td></tr>';
 echo '<tr>';
 // Base Stats render
 echo '<td>';
 echo '<div style="position: relative; left: 0px; top: 0px;">';
 echo '<table class=stattext cellSpacing=0>';
 echo "<tr><td>".getStatTypeName(STAT_STRENGTH).":</td></tr>\n";
 echo "<tr><td>".getStatTypeName(STAT_AGILITY).":</td></tr>\n";
 echo "<tr><td>".getStatTypeName(STAT_STAMINA).":</td></tr>\n";
 echo "<tr><td>".getStatTypeName(STAT_INTELLECT).":</td></tr>\n";
 echo "<tr><td>".getStatTypeName(STAT_SPIRIT).":</td></tr>\n";
 echo "<tr><td>".getResistance(SCHOOL_ARMOR).":</td></tr>\n";
 echo "</table>\n";
 echo "<table class=statvalue cellSpacing=0 style=\"position: absolute; left: 0px; top: 0px;\">\n";
 echo "<tr>";renderStatRow(STAT_STRENGTH,$char,$char_stat['strength']);echo "</tr>\n";
 echo "<tr>";renderStatRow(STAT_AGILITY,$char,$char_stat['agility']);echo "</tr>\n";
 echo "<tr>";renderStatRow(STAT_STAMINA,$char,$char_stat['stamina']);echo "</tr>\n";
 echo "<tr>";renderStatRow(STAT_INTELLECT,$char,$char_stat['intellect']);echo "</tr>\n";
 echo "<tr>";renderStatRow(STAT_SPIRIT,$char,$char_stat['spirit']);echo "</tr>\n";
 echo "<tr>";renderResist(SCHOOL_ARMOR,$char_stat['armor'],$char);echo "</tr>\n";
 echo '</table>';
 echo '</div>';
 echo '</td>';
 // Defence render
 echo '<td>';
 echo '<div style="position: relative; left: 0px; top: 0px;">';
 echo '<table class=stattext cellSpacing=0>';
 echo '<tr><td>'.$lang['player_armor'].'</td></tr>';
// echo '<tr><td>'.$lang['player_defence'].'</td></tr>';
 echo '<tr><td>'.$lang['player_dodge'].'</td></tr>';
 echo '<tr><td>'.$lang['player_parry'].'</td></tr>';
 echo '<tr><td>'.$lang['player_block'].'</td></tr>';
// echo '<tr><td>'.$lang['player_recilence'].'</td></tr>';
 echo '</table>';
 echo '<table class=statvalue cellSpacing=0 style="position: absolute; left: 0px; top: 0px;">';
 echo "<tr>";@renderResist(SCHOOL_ARMOR,$char_stat['armor'],$char);echo "</tr>\n";
// echo "<tr>";@renderDefence($char_data);echo "</tr>\n";
 echo "<tr>";@renderDodge($char_data);echo "</tr>\n"; // dodgePct
 echo "<tr>";@renderParry($char_data);echo "</tr>\n"; // parryPct
 echo "<tr>";@renderBlock($char_data);echo "</tr>\n"; // blockPct
// echo "<tr>";@renderRecilence($char_data);echo "</tr>\n";
 echo '</table>';
 echo '</div>';
 echo '</td>';
 echo '</tr>';

 echo '<tr><td class=head width=50%>'.$lang['player_melee'].'</td><td class=head width=50%>'.$lang['player_ranged'].'</td></tr>';
 echo '<tr>';
 // Melee render
 echo '<td>';
 echo '<div style="position: relative; left: 0px; top: 0px;">';

 echo '<table class=stattext cellSpacing=0>';
 echo '<tr><td>'.$lang['player_m_skill'].'</td></tr>';
 echo '<tr><td>'.$lang['player_m_damage'].'</td></tr>';
 echo '<tr><td>'.$lang['player_m_speed'].'</td></tr>';
 echo '<tr><td>'.$lang['player_m_power'].'</td></tr>';
 echo '<tr><td>'.$lang['player_m_hit'].'</td></tr>';
 echo '<tr><td>'.$lang['player_m_crit'].'</td></tr>';
 echo '</table>';
 echo '<table class=statvalue cellSpacing=0 style="position: absolute; left: 0px; top: 0px;">';
 echo "<tr>";@renderMeleeSkill($char_data);echo "</tr>\n";
 echo "<tr>";@renderMeleeDamage($char_data);echo "</tr>\n";
 echo "<tr>";@renderMeleeSpeed($char_data);echo "</tr>\n";
 echo "<tr>";@renderMeleeAP($char_data);echo "</tr>\n";
 echo "<tr>";@renderMeleeHit($char_data);echo "</tr>\n";
 echo "<tr>";@renderMeleeCrit($char_data);echo "</tr>\n";
 echo '</table>';
 echo '</div>';
 echo '</td>';
 // Ranged render
 echo '<td>';
 echo '<div style="position: relative; left: 0px; top: 0px;">';
 echo '<table class=stattext cellSpacing=0>';
 echo '<tr><td>'.$lang['player_r_skill'].'</td></tr>';
 echo '<tr><td>'.$lang['player_r_damage'].'</td></tr>';
 echo '<tr><td>'.$lang['player_r_speed'].'</td></tr>';
 echo '<tr><td>'.$lang['player_r_power'].'</td></tr>';
 echo '<tr><td>'.$lang['player_r_hit'].'</td></tr>';
 echo '<tr><td>'.$lang['player_r_crit'].'</td></tr>';
 echo '</table>';
 echo '<table class=statvalue cellSpacing=0 style="position: absolute; left: 0px; top: 0px;">';
 echo "<tr>";@renderRangedSkill($char_data);echo "</tr>\n";
 echo "<tr>";@renderRangedDamage($char_data) ;echo "</tr>\n";
 echo "<tr>";@renderRangedSpeed($char_data);echo "</tr>\n";
 echo "<tr>";@renderRangedAP($char_data);echo "</tr>\n";
 echo "<tr>";@renderRangedHit($char_data);echo "</tr>\n";
 echo "<tr>";@renderRangedCrit($char_data);echo "</tr>\n";
 echo '</table>';
 echo '</div>';
 echo '</td>';
 echo '</tr>';

 echo '<tr><td class=head colspan=2>'.$lang['player_spell'].'</td></tr>';
 echo '<tr>';
 echo '<td>';
 // 1 part Spell render
 echo '<div style="position: relative; left: 0px; top: 0px;">';
 echo '<table class=stattext cellSpacing=0>';
 echo '<tr><td>'.$lang['player_s_damage'].'</td></tr>';
 echo '<tr><td>'.$lang['player_s_healing'].'</td></tr>';
 echo '<tr><td>'.$lang['player_s_hit'].'</td></tr>';
 echo '</table>';
 echo '<table class=statvalue cellSpacing=0 style="position: absolute; left: 0px; top: 0px;">';
 echo "<tr>";@renderSpellDamage($char_data);echo "</tr>\n";
 echo "<tr>";@renderSpellHeal($char_data);echo "</tr>\n";
 echo "<tr>";@renderSpellHit($char_data);echo "</tr>\n";
 echo '</table>';
 echo '</div>';
 echo '</td>';
 // 2 part Spell render
 echo '<td>';
 echo '<div style="position: relative; left: 0px; top: 0px;">';
 echo '<table class=stattext cellSpacing=0>';
 echo '<tr><td>'.$lang['player_s_crit'].'</td></tr>';
 echo '<tr><td>'.$lang['player_s_haste'].'</td></tr>';
 echo '<tr><td>'.$lang['player_s_regen'].'</td></tr>';
 echo '</table>';
 echo '<table class=statvalue cellSpacing=0 style="position: absolute; left: 0px; top: 0px;">';

 echo "<tr>";@renderSpellCrit($char_data);echo "</tr>\n";
 echo "<tr>";@renderSpellHaste($char_data);echo "</tr>\n";
 echo "<tr>";@renderManaRegen($char_data);echo "</td></tr>\n";

 echo '</table>';
 echo '</div>';
 echo '</td>';
 echo '</tr>';
 echo '</tbody>';
 echo '</table>';

 $imgsize="armory";
 show_item_from_char($char_data[PLAYER_SLOT_ITEM_HEAD],$guid,$imgsize,22,73,"head");
 show_item_from_char($char_data[PLAYER_SLOT_ITEM_NECK],$guid,$imgsize,22,114,"neck");
 show_item_from_char($char_data[PLAYER_SLOT_ITEM_SHOULDER],$guid,$imgsize,22,155,"shoulder");
 show_item_from_char($char_data[PLAYER_SLOT_ITEM_BACK],$guid,$imgsize,22,196,"back");
 show_item_from_char($char_data[PLAYER_SLOT_ITEM_CHEST],$guid,$imgsize,22,237,"chest");
 show_item_from_char($char_data[PLAYER_SLOT_ITEM_SHIRT],$guid,$imgsize,22,278,"shirt");
 show_item_from_char($char_data[PLAYER_SLOT_ITEM_TABARD],$guid,$imgsize,22,319,"tabard");
 show_item_from_char($char_data[PLAYER_SLOT_ITEM_WRIST],$guid,$imgsize,22,360,"wrist");

 show_item_from_char($char_data[PLAYER_SLOT_ITEM_GLOVES],$guid,$imgsize,306,73,"gloves");
 show_item_from_char($char_data[PLAYER_SLOT_ITEM_BELT],$guid,$imgsize,306,114,"belt");
 show_item_from_char($char_data[PLAYER_SLOT_ITEM_LEGS],$guid,$imgsize,306,155,"legs");
 show_item_from_char($char_data[PLAYER_SLOT_ITEM_FEET],$guid,$imgsize,306,196,"feet");
 show_item_from_char($char_data[PLAYER_SLOT_ITEM_FINGER1],$guid,$imgsize,306,237,"finger");
 show_item_from_char($char_data[PLAYER_SLOT_ITEM_FINGER2],$guid,$imgsize,306,278,"finger");
 show_item_from_char($char_data[PLAYER_SLOT_ITEM_TRINKET1],$guid,$imgsize,306,319,"trinket");
 show_item_from_char($char_data[PLAYER_SLOT_ITEM_TRINKET2],$guid,$imgsize,306,360,"trinket");

 show_item_from_char($char_data[PLAYER_SLOT_ITEM_MAIN_HAND],$guid,$imgsize,122,384,"main");
 show_item_from_char($char_data[PLAYER_SLOT_ITEM_OFF_HAND],$guid,$imgsize,164,384,"off");
 show_item_from_char($char_data[PLAYER_SLOT_ITEM_RANGED],$guid,$imgsize,206,384,"ranged");
// Bags
// show_item_by_guid($char_data[PLAYER_SLOT_ITEM_TABARD+2],$imgsize,0,400);
// show_item_by_guid($char_data[PLAYER_SLOT_ITEM_TABARD+4],$imgsize,40,400);
// show_item_by_guid($char_data[PLAYER_SLOT_ITEM_TABARD+6],$imgsize,80,400);
// show_item_by_guid($char_data[PLAYER_SLOT_ITEM_TABARD+8],$imgsize,120,400);

 //show_item_by_guid($char_data[OFFSET_EQU_RANGED+32],$imgsize,50,50);
 echo "</div>";
 echo "</td></tr></tbody>";
 echo "</table></td>\n";
 echo "<td valign=top>";
 show_player_auras_from_db($guid);
 echo "</td>";
 echo "</tr>";
 echo "</table>";
}
?>