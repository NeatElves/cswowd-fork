<?php
include_once("include/map_data.php");
$inst_list = array(
array(13,20,389, 1637, "Horde Only"), // Ragefire Chasm
array(16,24, 36,   40, "Mainly Alliance"), // Deadmines
array(16,24, 43,   17, "Mainly Horde"), // Wailing Caverns
array(17,25, 33,  130, ""), // Shadowfang Keep
array(20,28, 48,  331, ""), // Blackfathom Deeps
array(21,29, 34, 1519, "Alliance Only"), // Stormwind Stockade
array(23,31, 47,   17, ""), // Razorfen Kraul
array(24,32, 90,    1, ""), // Gnomeregan
array(28,44,189,   85, ""), // Scarlet Monastery
array(33,41,129,   17, ""), // Razorfen Downs
array(36,44, 70,    3, ""), // Uldaman
array(40,52,349,  405, ""), // Maraudon
array(42,50,209,  440, ""), // Zul'Farrak
array(45,54,109,    8, ""), // Sunken Temple
array(48,60,230,   46, "Located in Blackrock Mountain"), // Blackrock Depths
array(53,61,229,   46, "Located in Blackrock Mountain"), // Blackrock Spire
array(54,61,429,  357, ""), // Dire Maul
array(56,61,289,   28, ""), // Scholomance
array(56,61,329,   28, ""), // Stratholme
array(56,70,309,   33, "20 person raid"), // Zul'Gurub
array(60,70,509, 1377, "20 person raid"), // Ruins of Ahn'Qiraj
array(60,70,531, 1377, "40 person raid"), // Ahn'Qiraj Temple
array(60,70,469, 1583, "40 person raid Located in Blackrock Mountain"), // Blackwing Lair
array(60,70,409, 1584, "40 person raid Located in Blackrock Mountain"), // Molten Core
array(60,67,543, 3483, ""), // Hellfire Citadel: Ramparts
array(60,68,542, 3483, ""), // Hellfire Citadel: The Blood Furnace
array(69,77,540, 3483, ""), // Hellfire Citadel: The Shattered Halls
array(70,77,544, 3483, "25 man raid"), // Magtheridon's Lair
array(61,69,547, 3521, ""), // Coilfang: The Slave Pens
array(62,70,546, 3521, ""), // Coilfang: The Underbog
array(69,77,545, 3521, ""), // Coilfang: The Steamvault
array(70,77,548, 3521, "25 man raid"), // Coilfang: Serpentshrine Cavern
array(63,71,557, 3519, ""), // Auchindoun: Mana-Tombs
array(64,72,558, 3519, ""), // Auchindoun: Auchenai Crypts
array(66,74,556, 3519, ""), // Auchindoun: Sethekk Halls
array(69,77,555, 3519, ""), // Auchindoun: Shadow Labyrinth
array(66,73,560, 2300, ""), // The Escape From Durnholde
array(68,77,269, 2300, ""), // Opening of the Dark Portal
array(70,77,534, 2300, "25 man raid"), // The Battle for Mount Hyjal
array(68,77,554, 3523, ""), // Tempest Keep: The Mechanar
array(69,77,552, 3523, ""), // Tempest Keep: The Arcatraz
array(69,77,553, 3523, ""), // Tempest Keep: The Botanica
array(70,77,550, 3523, "25 man raid"), // Tempest Keep
array(70,77,532,   41, "10 man Riad"), // Karazhan
array(70,77,564, 3520, "25 man raid"), // Black Temple
array(70,77,565, 3522, "25 man raid"), // Gruul's Lair
array(70,77,568, 3433, ""), // Zul'Aman
array(70,77,580, 4080, ""), // The Sunwell
array(70,77,585, 4080, ""), // Magister's Terrace
array(72,74,601, 65, ""), // Azjol-Nerub
array(73,75,619, 65, ""), // Ahn'kahet: The Old Kingdom
array(75,77,608, 4395, ""), // Violet Hold
array(76,78,604, 66, ""), // Gundrak
array(78,80,650, 210, ""), // Trial of the Champion
array(74,76,600, 66, ""), // Drak'Tharon Keep
array(79,80,575, 495, ""), // Utgarde Pinnacle
array(69,72,574, 495, ""), // Utgarde Keep
array(71,73,576, 3537, ""), // The Nexus
array(79,80,578, 3537, ""), // The Oculus
array(79,79,595, 440, ""), // The Culling of Stratholme
array(77,78,599, 67, ""), // Halls of Stone
array(79,80,602, 67, ""), // Halls of Lightning
array(80,80,668, 210, ""), // Halls of Reflection
array(80,80,632, 210, ""), // The Forge of Souls
array(80,80,658, 210, ""), // Pit of Saron
//RAIDS
array(60,70,533,  139, "Most difficult 40 person Raid"), // Naxxramas
array(60,70,249,   15, "40 person raid"), // Onyxia's Lair
array(80,80,649, 210, ""), // Trial of the Crusader
array(80,80,616, 3537, ""), // The Eye of Eternity
array(80,80,624, 4197, ""), // Vault of Archavon
array(80,80,603, 67, ""), // Ulduar
array(80,80,615, 65, ""), // The Obsidian Sanctum
array(80,80,724, 65, ""), // The Ruby Sanctum
array(80,80,631, 210, ""), // Icecrown Citadel
);

function outInstRow($id, $level, $zone, $comment)
{
    echo "<tr>";
    echo "<td align=center><img src=".getMapIcon($id)."></td>";
    echo "<td class=lvl>$level</td>";
    echo "<td>&nbsp;<a href=?instance=".$id.">".getMapName($id)."</a></td>";
    echo "<td>".getAreaName($zone)."</td>";
//    echo "<td>$comment</td>";
    echo "</tr>";
}

$cacheFilename = 'inst_list_'.$config['lang'].'.html';
if (checkUseCacheHtml($cacheFilename, 24*60*60))
{
 global $lang;
 echo "<table class=report width=100%>";
 echo "<td class=head colspan=4>$lang[instance]</td>";
 echo "<tr><th width=1px></th><th>$lang[level]</th><th>$lang[instances]</th><th>$lang[in_zone]</th></tr>";
 foreach($inst_list as $inst)
 {
   $level = $inst[0]==$inst[1] ? $inst[0]:$inst[0]."-".$inst[1];
   outInstRow($inst[2], $level, $inst[3], $inst[4]);
 }
 echo "</table>";
 flushHtmlCache($cacheFilename);
}
?>