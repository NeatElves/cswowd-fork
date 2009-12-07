<?php
include_once("include/map_data.php");
$inst_list = array(
array(13,20,389, "Orgrimmar", "Horde Only"), // Ragefire Chasm
array(16,24, 36, "Westfall", "Mainly Alliance"), // Deadmines
array(16,24, 43, "The Barrens", "Mainly Horde"), // Wailing Caverns
array(17,25, 33, "Silverpine Forest", ""), // Shadowfang Keep
array(20,28, 48, "Ashenvale", ""), // Blackfathom Deeps
array(21,29, 34, "Stormwind", "Alliance Only"), // Stormwind Stockade
array(23,31, 47, "The Barrens", ""), // Razorfen Kraul
array(24,32, 90, "Dun Morogh", ""), // Gnomeregan
array(28,44,189, "Tirisfal Glades", ""), // Scarlet Monastery
array(33,41,129, "The Barrens", ""), // Razorfen Downs
array(36,44, 70, "The Badlands", ""), // Uldaman
array(40,52,349, "Desolace", ""), // Maraudon
array(42,50,209, "Tanaris", ""), // Zul'Farrak
array(45,54,109, "Swamp of Sorrows", ""), // Sunken Temple
array(48,60,230, "Searing Gorge / Burning Steppes", "Located in Blackrock Mountain"), // Blackrock Depths
array(53,61,229, "Searing Gorge / Burning Steppes", "Located in Blackrock Mountain"), // Blackrock Spire
array(54,61,429, "Feralas", ""), // Dire Maul
array(56,61,289, "Western Plaguelands", ""), // Scholomance
array(56,61,329, "Western Plaguelands", ""), // Stratholme
array(56,70,309, "Stranglethorn Vale", "20 person raid"), // Zul'Gurub
array(60,70,509, "Silithus", "20 person raid"), // Ruins of Ahn'Qiraj
array(60,70,531, "Silithus", "40 person raid"), // Ahn'Qiraj Temple
array(60,70,469, "Searing Gorge / Burning Steppes", "40 person raid Located in Blackrock Mountain"), // Blackwing Lair
array(60,70,409, "Searing Gorge / Burning Steppes", "40 person raid Located in Blackrock Mountain"), // Molten Core
array(60,70,533, "Eastern Plaguelands", "Most difficult 40 person Raid"), // Naxxramas
array(60,70,249, "Dustwallow Marsh", "40 person raid"), // Onyxia's Lair
array(60,67,543, "Hellfire Peninsula", ""), // Hellfire Citadel: Ramparts
array(60,68,542, "Hellfire Peninusla", ""), // Hellfire Citadel: The Blood Furnace
array(69,77,540, "Hellfire Peninsula", ""), // Hellfire Citadel: The Shattered Halls
array(70,77,544, "Hellfire Peninsula", "25 man raid"), // Magtheridon's Lair
array(61,69,547, "Zangarmarsh", ""), // Coilfang: The Slave Pens
array(62,70,546, "Zangarmarsh", ""), // Coilfang: The Underbog
array(69,77,545, "Zangarmarsh", ""), // Coilfang: The Steamvault
array(70,77,548, "Zangarmarsh", "25 man raid"), // Coilfang: Serpentshrine Cavern
array(63,71,557, "Terokkar Forest", ""), // Auchindoun: Mana-Tombs
array(64,72,558, "Terokkar Forest", ""), // Auchindoun: Auchenai Crypts
array(66,74,556, "Terokkar Forest", ""), // Auchindoun: Sethekk Halls
array(69,77,555, "Terokkar Forest", ""), // Auchindoun: Shadow Labyrinth
array(66,73,560, "Caverns of Time / Tanaris", ""), // The Escape From Durnholde
array(68,77,269, "Caverns of Time / Tanaris", ""), // Opening of the Dark Portal
array(70,77,534, "Caverns of Time / Tanaris", "25 man raid"), // The Battle for Mount Hyjal
array(68,77,554, "Netherstorm", ""), // Tempest Keep: The Mechanar
array(69,77,552, "Netherstorm", ""), // Tempest Keep: The Arcatraz
array(69,77,553, "Netherstorm", ""), // Tempest Keep: The Botanica
array(70,77,550, "Netherstorm", "25 man raid"), // Tempest Keep
array(70,77,532, "Deadwind Pass", "10 man Riad"), // Karazhan
array(70,77,564, "Shadowmoon Valley", "25 man raid"), // Black Temple
array(70,77,565, "Blade's Edge Mountains", "25 man raid"), // Gruul's Lair
array(70,77,568, "Ghostlands", ""), // Zul'Aman
array(70,77,580, "Isle of Quel'Danas", ""), // The Sunwell
array(70,77,585, "Isle of Quel'Danas", ""), // Magister's Terrace
);

function outInstRow($id, $level, $zone, $comment)
{
    echo "<tr>";
    echo "<td align=center><img src=".getMapIcon($id)."></td>";
    echo "<td class=lvl>$level</td>";
    echo "<td>&nbsp;<a href=?instance=".$id.">".getMapName($id)."</a></td>";
    echo "<td>$zone</td>";
//    echo "<td>$comment</td>";
    echo "</tr>";
}

echo "<table class=report width=100%>";
echo "<td class=head colspan=4>Instances</td>";
echo "<tr><th width=1px></th><th>Уровень</th><th>Подземелье</th><th>В зоне</th></tr>";
foreach($inst_list as $inst)
{
   $level = $inst[0]==$inst[1] ? $inst[0]:$inst[0]."-".$inst[1];
   outInstRow($inst[2], $level, $inst[3], $inst[4]);
}
echo "</table>";
?>