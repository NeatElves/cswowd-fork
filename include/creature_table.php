<?php

define('UNIT_FLAG_UNKNOWN7', 0x00000001);
define('UNIT_FLAG_NON_ATTACKABLE', 0x00000002);
define('UNIT_FLAG_DISABLE_MOVE', 0x00000004);
define('UNIT_FLAG_PVP_ATTACKABLE', 0x00000008);
define('UNIT_FLAG_RENAME', 0x00000010);
define('UNIT_FLAG_RESTING', 0x00000020);
define('UNIT_FLAG_UNKNOWN9', 0x00000040);
define('UNIT_FLAG_NOT_ATTACKABLE_1', 0x00000080);
define('UNIT_FLAG_UNKNOWN2', 0x00000100);
define('UNIT_FLAG_UNKNOWN11', 0x00000200);
define('UNIT_FLAG_LOOTING', 0x00000400);
define('UNIT_FLAG_PET_IN_COMBAT', 0x00000800);
define('UNIT_FLAG_PVP', 0x00001000);
define('UNIT_FLAG_SILENCED', 0x00002000);
define('UNIT_FLAG_UNKNOWN4', 0x00004000);
define('UNIT_FLAG_UNKNOWN13', 0x00008000);
define('UNIT_FLAG_UNKNOWN14', 0x00010000);
define('UNIT_FLAG_PACIFIED', 0x00020000);
define('UNIT_FLAG_DISABLE_ROTATE', 0x00040000);
define('UNIT_FLAG_IN_COMBAT', 0x00080000);
define('UNIT_FLAG_TAXI_FLIGHT', 0x00100000);
define('UNIT_FLAG_DISARMED', 0x00200000);
define('UNIT_FLAG_CONFUSED', 0x00400000);
define('UNIT_FLAG_FLEEING', 0x00800000);
define('UNIT_FLAG_UNKNOWN5', 0x01000000);
define('UNIT_FLAG_NOT_SELECTABLE', 0x02000000);
define('UNIT_FLAG_SKINNABLE', 0x04000000);
define('UNIT_FLAG_MOUNT', 0x08000000);
define('UNIT_FLAG_UNKNOWN17', 0x10000000);
define('UNIT_FLAG_UNKNOWN6', 0x20000000);
define('UNIT_FLAG_SHEATHE', 0x40000000);

define('CREATURE_TYPEFLAGS_HERBLOOT', 0x00000100);
define('CREATURE_TYPEFLAGS_MININGLOOT', 0x00000200);
define('CREATURE_TYPEFLAGS_ENGINEERLOOT', 0x00008000);

define('UNIT_NPC_FLAG_NONE', 0x00000000);
define('UNIT_NPC_FLAG_GOSSIP', 0x00000001);
define('UNIT_NPC_FLAG_QUESTGIVER', 0x00000002);
define('UNIT_NPC_FLAG_UNK2', 0x00000004);
define('UNIT_NPC_FLAG_UNK3', 0x00000008);
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
define('UNIT_NPC_FLAG_UNK24',  0x01000000);
define('UNIT_NPC_FLAG_UNK25', 0x02000000);
define('UNIT_NPC_FLAG_UNK26', 0x04000000);
define('UNIT_NPC_FLAG_UNK27', 0x08000000);
define('UNIT_NPC_FLAG_GUARD', 0x10000000);
define('UNIT_NPC_FLAG_UNK29', 0x20000000);
define('UNIT_NPC_FLAG_UNK30', 0x40000000);
define('UNIT_NPC_FLAG_UNK31', 0x80000000);

function noBorderCreatureTable($npc)
{
 global $game_text;
 $loyality= getLoyality($npc['faction_A']);
 $type = $npc['type'];
 $rank =  $npc['rank'];
 $family =$npc['family'];
 $npcdmgmin = ROUND(($npc['mindmg']+$npc['attackpower'])*$npc['dmg_multiplier']);
 $npcdmgmax = ROUND(($npc['maxdmg']+$npc['attackpower'])*$npc['dmg_multiplier']);

 if ($npc['ScriptName']=="" && $npc['AIName']=="") {$npcscr='No script';}
 else if ($npc['AIName']=="EventAI" && $npc['ScriptName']=="") {$npcscr='EventAI';}
 else if ($npc['AIName']=="NullAI" && $npc['ScriptName']=="") {$npcscr='NullAI';}
 else if ($npc['AIName']=="AggressorAI" && $npc['ScriptName']=="") {$npcscr='AggressorAI';}
 else if ($npc['AIName']=="ReactorAI" && $npc['ScriptName']=="") {$npcscr='ReactorAI';}
 else if ($npc['AIName']=="GuardAI" && $npc['ScriptName']=="") {$npcscr='GuardAI';}
 else if ($npc['AIName']=="PetAI" && $npc['ScriptName']=="") {$npcscr='PetAI';}
 else if ($npc['AIName']=="TotemAI" && $npc['ScriptName']=="") {$npcscr='TotemAI';}
 else if ($npc['ScriptName']=="generic_creature") {$npcscr='Caster';}
 else if ($npc['ScriptName']<>"" && $npc['AIName']=="EventAI") {$npcscr='EventAI + SD2';}
 else {$npcscr='SD2';}
 
 $npc['name'] = str_replace('(1)', '(difficulty_1)', $npc['name']);
 $npc['name'] = str_replace('(2)', '(difficulty_2)', $npc['name']);
 $npc['name'] = str_replace('(3)', '(difficulty_3)', $npc['name']);

 echo "<table class=creature cellspacing=0>";
 echo "<tbody>";
 echo "<tr><td colspan=2><b>$npc[name] ($loyality)</b>";
 if ($npc['subname']!="")
     echo "<br><FONT color=#008800 size=-3>&lt;$npc[subname]&gt;</FONT>";
 echo "</td></tr>";

 if ($rank)
     echo "<td>".$game_text['npc_rank']."</td><td align=right>".getCreatureRank($rank)."</td></tr>";

 echo "<tr><td>".$game_text['npc_type']."</td><td align=right>".getCreatureType($type)."</td></tr>";
 if ($npc['family']!=0)
 echo "<tr><td>".$game_text['npc_family']."</td><td align=right>".getCreatureFamily($family)."</td></tr>";

 echo "<tr><td>".$game_text['npc_level']."</td><td align=right>$npc[maxlevel]</td></tr>";
 if ($npc['minhealth']==$npc['maxhealth'])
     echo "<tr><td>".$game_text['npc_health']."</td><td align=right>$npc[maxhealth]</td></tr>";
 else
     echo "<tr><td>".$game_text['npc_health']."</td><td align=right>$npc[minhealth]-$npc[maxhealth]</td></tr>";
 if ($npc['minmana']!=0)
 {
     if ($npc['minmana']!=$npc['maxmana'])
         echo "<tr><td>".$game_text['npc_mana']."</td><td align=right>$npc[minmana]-$npc[maxmana]</td></tr>";
     else
         echo "<tr><td>".$game_text['npc_mana']."</td><td align=right>$npc[minmana]</td></tr>";
 }
 if ($npc['armor']!=0)
     echo "<tr><td>".$game_text['npc_armor']."</td><td align=right>$npc[armor]</td></tr>";

 echo "<tr><td>".$game_text['npc_damage']."</td><td align=right>$npcdmgmin - $npcdmgmax</td></tr>";
 echo "<tr><td>".$game_text['npc_ap']."</td><td align=right>$npc[attackpower]</td></tr>";
 $attackTime = $npc['baseattacktime']/1000;
 echo "<tr><td>".$game_text['npc_attack']."</td><td align=right>$attackTime сек</td></tr>";

 echo "<tr><td>".$game_text['faction']."</td><td align=right>".getFactionTemplateName($npc['faction_A'])."</td></tr>";
// echo "<tr><td>Радиус аггро</td><td align=right>$npc[combat_reach]</td></tr>";
// echo "<tr><td>".$game_text['entry']."</td><td align=right>$npc[entry]</td></tr>";
 if ($npc['modelid_1'])
  echo "<tr><td>".$game_text['display1']."</td><td align=right>$npc[modelid_1]</td></tr>";
 if ($npc['modelid_2'])
  echo "<tr><td>".$game_text['display2']."</td><td align=right>$npc[modelid_2]</td></tr>";
 if ($npc['modelid_3'])
  echo "<tr><td>".$game_text['display3']."</td><td align=right>$npc[modelid_3]</td></tr>";
 if ($npc['modelid_4'])
  echo "<tr><td>".$game_text['display4']."</td><td align=right>$npc[modelid_4]</td></tr>";

 echo "<tr><td>".$game_text['npc_script']."</td><td align=right>$npcscr</td></tr>";
 if ($npc['npcflag'])
     echo "<tr><td colspan=2>".getCreatureFlagsList($npc['npcflag'])."</td></tr>";

// echo "<tr><td colspan=2 class=bottom>This is from MaNGOS database!</td></tr>";
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