<?php
include_once("player_info_generator.php");

function showPlayerEquip($guid, $char, $char_data)
{
 global $lang;
 $char_name = $char['name'];
 $powerType =($char_data[UNIT_FIELD_BYTES_0]>>24)&255;
 $genderId  =($char_data[UNIT_FIELD_BYTES_0]>>16)&255;
 $class     =($char_data[UNIT_FIELD_BYTES_0]>> 8)&255;
 $race      =($char_data[UNIT_FIELD_BYTES_0]>> 0)&255;
 $money     = $char_data[PLAYER_FIELD_COINAGE];
 $level     = $char_data[UNIT_FIELD_LEVEL];
 $health    = $char_data[UNIT_FIELD_HEALTH];
 $maxhealth = $char_data[UNIT_FIELD_MAXHEALTH];
 $power     = $char_data[UNIT_FIELD_POWER1+$powerType];
 $maxpower  = $char_data[UNIT_FIELD_MAXPOWER1+$powerType];
 // Ярость надо делить на 10
 if ($powerType == POWER_RAGE)
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
 renderResist(SCHOOL_FIRE  ,$char_data); echo "\n";
 renderResist(SCHOOL_NATURE,$char_data); echo "\n";
 renderResist(SCHOOL_FROST ,$char_data); echo "\n";
 renderResist(SCHOOL_SHADOW,$char_data); echo "\n";
 renderResist(SCHOOL_ARCANE,$char_data); echo "\n";
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
 echo "<tr>";renderStatRow(STAT_STRENGTH,$char_data);echo "</tr>\n";
 echo "<tr>";renderStatRow(STAT_AGILITY,$char_data);echo "</tr>\n";
 echo "<tr>";renderStatRow(STAT_STAMINA,$char_data);echo "</tr>\n";
 echo "<tr>";renderStatRow(STAT_INTELLECT,$char_data);echo "</tr>\n";
 echo "<tr>";renderStatRow(STAT_SPIRIT,$char_data);echo "</tr>\n";
 echo "<tr>";renderResist(SCHOOL_ARMOR,$char_data); echo "</tr>\n";
 echo '</table>';
 echo '</div>';
 echo '</td>';
 // Defence render
 echo '<td>';
 echo '<div style="position: relative; left: 0px; top: 0px;">';
 echo '<table class=stattext cellSpacing=0>';
 echo '<tr><td>'.$lang['player_armor'].'</td></tr>';
 echo '<tr><td>'.$lang['player_defence'].'</td></tr>';
 echo '<tr><td>'.$lang['player_dodge'].'</td></tr>';
 echo '<tr><td>'.$lang['player_parry'].'</td></tr>';
 echo '<tr><td>'.$lang['player_block'].'</td></tr>';
 echo '<tr><td>'.$lang['player_recilence'].'</td></tr>';
 echo '</table>';
 echo '<table class=statvalue cellSpacing=0 style="position: absolute; left: 0px; top: 0px;">';
 echo "<tr>";@renderResist(SCHOOL_ARMOR,$char_data);echo "</tr>\n";
 echo "<tr>";@renderDefence($char_data);echo "</tr>\n";
 echo "<tr>";@renderDodge($char_data);echo "</tr>\n";
 echo "<tr>";@renderParry($char_data);echo "</tr>\n";
 echo "<tr>";@renderBlock($char_data);echo "</tr>\n";
 echo "<tr>";@renderRecilence($char_data);echo "</tr>\n";
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
 show_item_by_guid($char_data[PLAYER_SLOT_ITEM_HEAD],$imgsize,22,73);
 show_item_by_guid($char_data[PLAYER_SLOT_ITEM_NECK],$imgsize,22,114);
 show_item_by_guid($char_data[PLAYER_SLOT_ITEM_SHOULDER],$imgsize,22,155);
 show_item_by_guid($char_data[PLAYER_SLOT_ITEM_BACK],$imgsize,22,196);
 show_item_by_guid($char_data[PLAYER_SLOT_ITEM_CHEST],$imgsize,22,237);
 show_item_by_guid($char_data[PLAYER_SLOT_ITEM_SHIRT],$imgsize,22,278);
 show_item_by_guid($char_data[PLAYER_SLOT_ITEM_TABARD],$imgsize,22,319);
 show_item_by_guid($char_data[PLAYER_SLOT_ITEM_WRIST],$imgsize,22,360);

 show_item_by_guid($char_data[PLAYER_SLOT_ITEM_GLOVES],$imgsize,306,73);
 show_item_by_guid($char_data[PLAYER_SLOT_ITEM_BELT],$imgsize,306,114);
 show_item_by_guid($char_data[PLAYER_SLOT_ITEM_LEGS],$imgsize,306,155);
 show_item_by_guid($char_data[PLAYER_SLOT_ITEM_FEET],$imgsize,306,196);
 show_item_by_guid($char_data[PLAYER_SLOT_ITEM_FINGER1],$imgsize,306,237);
 show_item_by_guid($char_data[PLAYER_SLOT_ITEM_FINGER2],$imgsize,306,278);
 show_item_by_guid($char_data[PLAYER_SLOT_ITEM_TRINKET1],$imgsize,306,319);
 show_item_by_guid($char_data[PLAYER_SLOT_ITEM_TRINKET2],$imgsize,306,360);

 show_item_by_guid($char_data[PLAYER_SLOT_ITEM_MAIN_HAND],$imgsize,122,384);
 show_item_by_guid($char_data[PLAYER_SLOT_ITEM_OFF_HAND],$imgsize,164,384);
 show_item_by_guid($char_data[PLAYER_SLOT_ITEM_RANGED],$imgsize,206,384);
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