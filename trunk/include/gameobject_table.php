<?php

// Gameobject type enums
define('GAMEOBJECT_TYPE_DOOR', 0);
define('GAMEOBJECT_TYPE_BUTTON', 1);
define('GAMEOBJECT_TYPE_QUESTGIVER', 2);
define('GAMEOBJECT_TYPE_CHEST', 3);
define('GAMEOBJECT_TYPE_BINDER', 4);
define('GAMEOBJECT_TYPE_GENERIC', 5);
define('GAMEOBJECT_TYPE_TRAP', 6);
define('GAMEOBJECT_TYPE_CHAIR', 7);
define('GAMEOBJECT_TYPE_SPELL_FOCUS', 8);
define('GAMEOBJECT_TYPE_TEXT', 9);
define('GAMEOBJECT_TYPE_GOOBER', 10);
define('GAMEOBJECT_TYPE_TRANSPORT', 11);
define('GAMEOBJECT_TYPE_AREADAMAGE', 12);
define('GAMEOBJECT_TYPE_CAMERA', 13);
define('GAMEOBJECT_TYPE_MAP_OBJECT', 14);
define('GAMEOBJECT_TYPE_MO_TRANSPORT', 15);
define('GAMEOBJECT_TYPE_DUEL_ARBITER', 16);
define('GAMEOBJECT_TYPE_FISHINGNODE', 17);
define('GAMEOBJECT_TYPE_SUMMONING_RITUAL', 18);
define('GAMEOBJECT_TYPE_MAILBOX', 19);
define('GAMEOBJECT_TYPE_AUCTIONHOUSE', 20);
define('GAMEOBJECT_TYPE_GUARDPOST', 21);
define('GAMEOBJECT_TYPE_SPELLCASTER', 22);
define('GAMEOBJECT_TYPE_MEETINGSTONE', 23);
define('GAMEOBJECT_TYPE_FLAGSTAND', 24);
define('GAMEOBJECT_TYPE_FISHINGHOLE', 25);
define('GAMEOBJECT_TYPE_FLAGDROP', 26);
define('GAMEOBJECT_TYPE_MINI_GAME', 27);
define('GAMEOBJECT_TYPE_LOTTERY_KIOSK', 28);
define('GAMEOBJECT_TYPE_CAPTURE_POINT', 29);
define('GAMEOBJECT_TYPE_AURA_GENERATOR', 30);
define('GAMEOBJECT_TYPE_DUNGEON_DIFFICULTY', 31);
define('GAMEOBJECT_TYPE_BARBER_CHAIR', 32);
define('GAMEOBJECT_TYPE_DESTRUCTIBLE_BUILDING', 33);
define('GAMEOBJECT_TYPE_GUILDBANK', 34);
define('GAMEOBJECT_TYPE_TRAPDOOR', 35);

// Gameobject flag enum
define('GO_FLAG_IN_USE', 0x01);
define('GO_FLAG_LOCKED', 0x02);
define('GO_FLAG_INTERACT_COND', 0x04);
define('GO_FLAG_TRANSPORT', 0x08);
define('GO_FLAG_UNK1', 0x10);
define('GO_FLAG_NODESPAWN', 0x20);
define('GO_FLAG_TRIGGERED', 0x40);
define('GO_FLAG_UNK2', 0x80);

function noBorderGameobjectTable($obj)
{
 global $game_text;
 echo "<table class=gameobject cellspacing=0>";
 echo "<tbody>";
 echo "<tr><td colspan=2><b>$obj[name]</b></td></tr>";
 if ($obj['flags'] & GO_FLAG_LOCKED)
     echo "<tr><td colspan=2>".$game_text['locked']."</td></tr>";
 echo "<tr width=1%><td>".$game_text['go_type']."</td><td align=right>".getGameobjectType($obj['type'])."</td></tr>";
 if ($obj['faction'])
    echo "<tr><td>".$game_text['faction']."</td><td align=right>".getFactionTemplateName($obj['faction'])."</td></tr>";
 echo "<tr><td>".$game_text['entry']."</td><td align=right>$obj[entry]</td></tr>";`
 echo "</tbody></table>";
}

function generateGameobjectTable($obj)
{
 echo "<table class=border cellspacing=0 cellpadding=0><tbody>";
 echo "<tr><td class=btopl></td><td class=btop></td><td class=btopr></td></tr>";
 echo "<tr><td class=bl></td><td class=bbody>";
 noBorderGameobjectTable($obj);
 echo "</td><td class=br></td></tr>";
 echo "<tr><td class=bbottoml></td><td class=bbottom></td><td class=bbottomr></td></tr>";
 echo "</tbody></table>";
}
?>