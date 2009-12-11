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
 else if ($npc['ScriptName']=="generic_creature") {$npcscr='Caster';}
 else if ($npc['ScriptName']<>"" && $npc['AIName']=="EventAI") {$npcscr='EventAI + SD2';}
 else {$npcscr='SD2';}

 echo "<TABLE class=creature cellSpacing=0>";
 echo "<TBODY>";
 echo "<TR><TD colSpan=2><b>$npc[name] ($loyality)</b>";
 if ($npc['subname']!="")
     echo "<br><FONT color=#008800 size=-3>&lt;$npc[subname]&gt;</FONT>";
 echo "</td></tr>";

 if ($rank)
     echo "<td>".$game_text['npc_rank']."</td><td align=right>".getCreatureRank($rank)."</TD></TR>";

 echo "<TR><TD>".$game_text['npc_type']."</TD><TD align=right>".getCreatureType($type)."</TD></TR>";
 if ($npc['family']!=0)
 echo "<TR><TD>".$game_text['npc_family']."</TD><TD align=right>".getCreatureFamily($family)."</TD></TR>";

 echo "<TR><TD>".$game_text['npc_level']."</TD><TD align=right>$npc[maxlevel]</TD></TR>";
 if ($npc['minhealth']==$npc['maxhealth'])
     echo "<TR><TD>".$game_text['npc_health']."</TD><TD align=right>$npc[maxhealth]</TD></TR>";
 else
     echo "<TR><TD>".$game_text['npc_health']."</TD><TD align=right>$npc[minhealth]-$npc[maxhealth]</TD></TR>";
 if ($npc['minmana']!=0)
 {
     if ($npc['minmana']!=$npc['maxmana'])
         echo "<TR><TD>".$game_text['npc_mana']."</TD><TD align=right>$npc[minmana]-$npc[maxmana]</TD></TR>";
     else
         echo "<TR><TD>".$game_text['npc_mana']."</TD><TD align=right>$npc[minmana]</TD></TR>";
 }
 if ($npc['armor']!=0)
     echo "<TR><TD>".$game_text['npc_armor']."</TD><TD align=right>$npc[armor]</TD></TR>";

 echo "<TR><TD>".$game_text['npc_damage']."</TD><TD align=right>$npcdmgmin - $npcdmgmax</TD></TR>";
 echo "<TR><TD>".$game_text['npc_ap']."</TD><TD align=right>$npc[attackpower]</TD></TR>";
 echo "<TR><TD>".$game_text['dmg_mult']."</TD><TD align=right>$npc[dmg_multiplier]</TD></TR>";
 $attackTime = $npc['baseattacktime']/1000;
 echo "<TR><TD>".$game_text['npc_attack']."</TD><TD align=right>$attackTime сек</TD></TR>";

 echo "<TR><TD>".$game_text['faction']."</TD><TD align=right>".getFactionTemplateName($npc['faction_A'])."</TD></TR>";
// echo "<TR><TD>Радиус аггро</TD><TD align=right>$npc[combat_reach]</TD></TR>";
// echo "<TR><TD>".$game_text['entry']."</TD><TD align=right>$npc[entry]</TD></TR>";
/*
 if ($npc['modelid_A']!=$npc['modelid_H'])
 {
  echo "<TR><TD>".$game_text['displayA']."</TD><TD align=right>$npc[modelid_A]</TD></TR>";
  echo "<TR><TD>".$game_text['displayH']."</TD><TD align=right>$npc[modelid_H]</TD></TR>";
 }
 else
  echo "<TR><TD>".$game_text['display']."</TD><TD align=right>$npc[modelid_A]</TD></TR>";
*/
 echo "<TR><TD>".$game_text['npc_script']."</TD><TD align=right>$npcscr</TD></TR>";
 if ($npc['npcflag'])
     echo "<TR><TD colspan=2>".getCreatureFlagsList($npc['npcflag'])."</TD></TR>";

// echo "<TR><TD colSpan=2 class=bottom>This is from MaNGOS database!</TD></TR>";
 echo "</TBODY></TABLE>";
}
function generateCreatureTable($npc)
{
 echo "<table class=border cellSpacing=0 cellPadding=0><tbody>";
 echo "<tr><td class=btopl></td><td class=btop></td><td class=btopr></td></tr>";
 echo "<tr><td class=bl></td><td class=bbody>";
 noBorderCreatureTable($npc);
 echo "</td><td class=br></td></tr>";
 echo "<tr><td class=bbottoml></td><td class=bbottom></td><td class=bbottomr></td></tr>";
 echo "</tbody></table>";
}
?>