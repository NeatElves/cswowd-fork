<?php

define('UNIT_FLAG_UNK_0', 0x00000001);
define('UNIT_FLAG_SPAWNING', 0x00000002);
define('UNIT_FLAG_CLIENT_CONTROL_LOST', 0x00000004);
define('UNIT_FLAG_PLAYER_CONTROLLED', 0x00000008);
define('UNIT_FLAG_RENAME', 0x00000010);
define('UNIT_FLAG_PREPARATION', 0x00000020);
define('UNIT_FLAG_UNK_6', 0x00000040);
define('UNIT_FLAG_NOT_ATTACKABLE_1', 0x00000080);
define('UNIT_FLAG_IMMUNE_TO_PLAYER', 0x00000100);
define('UNIT_FLAG_IMMUNE_TO_NPC', 0x00000200);
define('UNIT_FLAG_LOOTING', 0x00000400);
define('UNIT_FLAG_PET_IN_COMBAT', 0x00000800);
define('UNIT_FLAG_PVP_DEPRECATED', 0x00001000);
define('UNIT_FLAG_SILENCED', 0x00002000);
define('UNIT_FLAG_UNK_14', 0x00004000);
define('UNIT_FLAG_SWIMMING', 0x00008000);
define('UNIT_FLAG_UNTARGETABLE', 0x00010000);
define('UNIT_FLAG_PACIFIED', 0x00020000);
define('UNIT_FLAG_STUNNED', 0x00040000);
define('UNIT_FLAG_IN_COMBAT', 0x00080000);
define('UNIT_FLAG_TAXI_FLIGHT', 0x00100000);
define('UNIT_FLAG_DISARMED', 0x00200000);
define('UNIT_FLAG_CONFUSED', 0x00400000);
define('UNIT_FLAG_FLEEING', 0x00800000);
define('UNIT_FLAG_POSSESSED', 0x01000000);
define('UNIT_FLAG_UNINTERACTIBLE', 0x02000000);
define('UNIT_FLAG_SKINNABLE', 0x04000000);
define('UNIT_FLAG_MOUNT', 0x08000000);
define('UNIT_FLAG_UNK_28', 0x10000000);
define('UNIT_FLAG_PREVENT_ANIM', 0x20000000);
define('UNIT_FLAG_SHEATHE', 0x40000000);
define('UNIT_FLAG_IMMUNE', 0x80000000);

define('CREATURE_TYPEFLAGS_HERBLOOT', 0x00000100);
define('CREATURE_TYPEFLAGS_MININGLOOT', 0x00000200);
define('CREATURE_TYPEFLAGS_ENGINEERLOOT', 0x00008000);

define('UNIT_NPC_FLAG_NONE', 0x00000000);
define('UNIT_NPC_FLAG_GOSSIP', 0x00000001);
define('UNIT_NPC_FLAG_QUESTGIVER', 0x00000002);
define('UNIT_NPC_FLAG_UNK1', 0x00000004);
define('UNIT_NPC_FLAG_UNK2', 0x00000008);
define('UNIT_NPC_FLAG_TRAINER', 0x00000010);
define('UNIT_NPC_FLAG_TRAINER_CLASS', 0x00000020);
define('UNIT_NPC_FLAG_TRAINER_PROFESSION', 0x00000040);
define('UNIT_NPC_FLAG_VENDOR', 0x00000080);
define('UNIT_NPC_FLAG_VENDOR_AMMO', 0x00000100);
define('UNIT_NPC_FLAG_VENDOR_FOOD', 0x00000200);
define('UNIT_NPC_FLAG_VENDOR_POISON', 0x00000400);
define('UNIT_NPC_FLAG_VENDOR_REAGENT', 0x00000800);
define('UNIT_NPC_FLAG_REPAIR', 0x00001000);
define('UNIT_NPC_FLAG_FLIGHTMASTER', 0x00002000);
define('UNIT_NPC_FLAG_SPIRITHEALER', 0x00004000);
define('UNIT_NPC_FLAG_SPIRITGUIDE', 0x00008000);
define('UNIT_NPC_FLAG_INNKEEPER', 0x00010000);
define('UNIT_NPC_FLAG_BANKER', 0x00020000);
define('UNIT_NPC_FLAG_PETITIONER', 0x00040000);
define('UNIT_NPC_FLAG_TABARDDESIGNER', 0x00080000);
define('UNIT_NPC_FLAG_BATTLEMASTER', 0x00100000);
define('UNIT_NPC_FLAG_AUCTIONEER', 0x00200000);
define('UNIT_NPC_FLAG_STABLEMASTER', 0x00400000);
define('UNIT_NPC_FLAG_GUILD_BANKER', 0x00800000);
define('UNIT_NPC_FLAG_SPELLCLIC',  0x01000000);
define('UNIT_NPC_FLAG_PLAYER_VEHICLE', 0x02000000);
define('UNIT_NPC_FLAG_UNK26', 0x04000000);
define('UNIT_NPC_FLAG_UNK27', 0x08000000);
define('UNIT_NPC_FLAG_UNK28', 0x10000000);
define('UNIT_NPC_FLAG_UNK29', 0x20000000);
define('UNIT_NPC_FLAG_UNK30', 0x40000000);
define('UNIT_NPC_FLAG_UNK31', 0x80000000);

function noBorderCreatureTable($npc)
{
 global $game_text, $lang;
 $loyality= getLoyality($npc['Faction']);
 $type = $npc['CreatureType'];
 $rank =  $npc['Rank'];
 $family =$npc['Family'];
 $npcdmgmin = ROUND((getCreatureClasslevelstats($npc['MinLevel'], $npc['UnitClass'], $npc['Expansion'], $npc['DamageVariance'], 3)+(getCreatureClasslevelstats($npc['MinLevel'], $npc['UnitClass'], $npc['Expansion'], 1, 4)/14)*($npc['MeleeBaseAttackTime']/1000))*$npc['DamageMultiplier']);
 $npcdmgmax = ROUND($npcdmgmin*1.5);

 if ($npc['ScriptName']=="" && $npc['AIName']=="") {$npcscr='No script';}
 else if ($npc['AIName']<>"" && $npc['ScriptName']=="") {$npcscr=$npc['AIName'];}
 else if ($npc['ScriptName']=="generic_creature") {$npcscr='Caster';}
 else if ($npc['ScriptName']<>"" && $npc['AIName']<>"") {$npcscr='AI&nbsp;+&nbsp;SD2';}
 else {$npcscr='SD2';}
 
 $npc['Name'] = str_replace('(1)', '(Difficulty1)', $npc['Name']);
 $npc['Name'] = str_replace('(2)', '(Difficulty2)', $npc['Name']);
 $npc['Name'] = str_replace('(3)', '(Difficulty3)', $npc['Name']);
 
 echo "<table class=creature cellspacing=0>";
 echo "<tbody>";
 echo "<tr><td colspan=2><b>$npc[Name]&nbsp;($loyality)</b>";
 if ($npc['SubName']!="")
     echo "<br><font color=#008800 size=-3>&lt;$npc[SubName]&gt;</font>";
 echo "</td></tr>";
 if ($rank)
     echo "<td>".$game_text['npc_rank']."</td><td align=right>".getCreatureRank($rank)."</td></tr>";

 echo "<tr><td>".$game_text['npc_type']."</td><td align=right>".getCreatureType($type)."</td></tr>";
 if ($npc['Family']!=0)
 echo "<tr><td>".$game_text['npc_family']."</td><td align=right>".getCreatureFamily($family)."</td></tr>";
 echo "<tr><td>".$game_text['npc_level']."</td><td align=right>$npc[MaxLevel]</td></tr>";
 if ($npc['MinLevelHealth']==$npc['MaxLevelHealth'])
     echo "<tr><td>".$game_text['npc_health']."</td><td align=right>".getCreatureClasslevelstats($npc['MaxLevel'], $npc['UnitClass'], $npc['Expansion'], $npc['HealthMultiplier'], 1)."</td></tr>";
 else
     echo "<tr><td>".$game_text['npc_health']."</td><td align=right>".getCreatureClasslevelstats($npc['MinLevel'], $npc['UnitClass'], $npc['Expansion'], $npc['HealthMultiplier'], 1)." - ".getCreatureClasslevelstats($npc['MaxLevel'], $npc['UnitClass'], $npc['Expansion'], $npc['HealthMultiplier'], 1)."</td></tr>";
 if ($npc['MinLevelMana']!=0)
 {
     if ($npc['MinLevelMana']!=$npc['MaxLevelMana'])
         echo "<tr><td>".$game_text['npc_mana']."</td><td align=right>".getCreatureClasslevelstats($npc['MinLevel'], $npc['UnitClass'], $npc['Expansion'], $npc['PowerMultiplier'], 2)." - ".getCreatureClasslevelstats($npc['MaxLevel'], $npc['UnitClass'], $npc['Expansion'], $npc['PowerMultiplier'], 2)."</td></tr>";
     else
         echo "<tr><td>".$game_text['npc_mana']."</td><td align=right>".getCreatureClasslevelstats($npc['MinLevel'], $npc['UnitClass'], $npc['Expansion'], $npc['PowerMultiplier'], 2)."</td></tr>";
 }
 if ($npc['Armor']!=0)
     echo "<tr><td>".$game_text['npc_armor']."</td><td align=right>".getCreatureClasslevelstats($npc['MinLevel'], $npc['UnitClass'], $npc['Expansion'], $npc['ArmorMultiplier'], 6)."</td></tr>";
 echo "<tr><td>".$game_text['npc_damage']."</td><td align=right>$npcdmgmin&nbsp;-&nbsp;$npcdmgmax</td></tr>";
 echo "<tr><td>".$game_text['npc_ap']."</td><td align=right>".getCreatureClasslevelstats($npc['MinLevel'], $npc['UnitClass'], $npc['Expansion'], 1, 4)."</td></tr>";
 $attackTime = $npc['MeleeBaseAttackTime']/1000;
 echo "<tr><td>".$game_text['npc_attack']."</td><td align=right>$attackTime&nbsp;$lang[sec]</td></tr>";
 echo "<tr><td>".$game_text['faction']."</td><td align=right>".getFactionTemplateName($npc['Faction'])."</td></tr>";
 if ($npc['ModelId1'])
  echo "<tr><td>".$game_text['display1']."</td><td align=right>$npc[ModelId1]</td></tr>";
 if ($npc['ModelId2'])
  echo "<tr><td>".$game_text['display2']."</td><td align=right>$npc[ModelId2]</td></tr>";
 if ($npc['ModelId3'])
  echo "<tr><td>".$game_text['display3']."</td><td align=right>$npc[ModelId3]</td></tr>";
 if ($npc['ModelId4'])
  echo "<tr><td>".$game_text['display4']."</td><td align=right>$npc[ModelId4]</td></tr>";
 echo "<tr><td>".$game_text['npc_script']."</td><td align=right>$npcscr</td></tr>";
 if ($npc['NpcFlags'])
  echo "<tr><td colspan=2>".getCreatureFlagsList($npc['NpcFlags'])."</td></tr>";
 echo "</tbody></table>";
}
function generateCreatureTable($npc)
{
 echo "<table class=border cellspacing=0 cellpadding=0><tbody>";
 echo "<tr><td class=btopl></td><td class=btop></td><td class=btopr></td></tr>";
 echo "<tr><td class=bl></td><td class=bbody>";
 noBorderCreatureTable($npc);
 echo "</td><td class=br></td></tr>";
 echo "<tr><td class=bbottoml></td><td class=bbottom></td><td class=bbottomr></td></tr>";
 echo "</tbody></table>";
}
?>