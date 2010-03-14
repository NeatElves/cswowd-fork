<?php
$NPCType = array(
'0'=>'none',
'1'=>'Beast',
'2'=>'Dragonkin',
'3'=>'Demon',
'4'=>'Elemental',
'5'=>'Giant',
'6'=>'Undead',
'7'=>'Humanoid',
'8'=>'Critter',
'9'=>'Mechanical',
'10'=>'Not specified'
);

$gmapName = array(
'0'=>"Azeroths",
'1'=>"Kalimdor",
'13'=>"Testing",
'25'=>"Scott Test",
'29'=>"CashTest",
'30'=>"Alterac Valley",
'33'=>"Shadowfang Keep",
'34'=>"Stormwind Stockade",
'35'=>"<unused>StormwindPrison",
'36'=>"Deadmines",
'37'=>"Azshara Crater",
'42'=>"Collin's Test",
'43'=>"Wailing Caverns",
'44'=>"<unused> Monastery",
'47'=>"Razorfen Kraul",
'48'=>"Blackfathom Deeps",
'70'=>"Uldaman",
'90'=>"Gnomeregan",
'109'=>"Sunken Temple",
'129'=>"Razorfen Downs",
'169'=>"Emerald Dream",
'189'=>"Scarlet Monastery",
'209'=>"Zul'Farrak",
'229'=>"Blackrock Spire",
'230'=>"Blackrock Depths",
'249'=>"Onyxia's Lair",
'269'=>"Opening of the Dark Portal",
'289'=>"Scholomance",
'309'=>"Zul'Gurub",
'329'=>"Stratholme",
'349'=>"Maraudon",
'369'=>"Deeprun Tram",
'389'=>"Ragefire Chasm",
'409'=>"Molten Core",
'429'=>"Dire Maul",
'449'=>"Alliance PVP Barracks",
'450'=>"Horde PVP Barracks",
'451'=>"Development Land",
'469'=>"Blackwing Lair",
'489'=>"Warsong Gulch",
'509'=>"Ruins of Ahn'Qiraj",
'529'=>"Arathi Basin",
'530'=>"Outland",
'531'=>"Ahn'Qiraj Temple",
'532'=>"Karazhan",
'533'=>"Naxxramas",
'534'=>"The Battle for Mount Hyjal",
'540'=>"Hellfire Citadel: The Shattered Halls",
'542'=>"Hellfire Citadel: The Blood Furnace",
'543'=>"Hellfire Citadel: Ramparts",
'544'=>"Magtheridon's Lair",
'545'=>"Coilfang: The Steamvault",
'546'=>"Coilfang: The Underbog",
'547'=>"Coilfang: The Slave Pens",
'548'=>"Coilfang: Serpentshrine Cavern",
'550'=>"Tempest Keep",
'552'=>"Tempest Keep: The Arcatraz",
'553'=>"Tempest Keep: The Botanica",
'554'=>"Tempest Keep: The Mechanar",
'555'=>"Auchindoun: Shadow Labyrinth",
'556'=>"Auchindoun: Sethekk Halls",
'557'=>"Auchindoun: Mana-Tombs",
'558'=>"Auchindoun: Auchenai Crypts",
'559'=>"Nagrand Arena",
'560'=>"The Escape From Durnholde",
'562'=>"Blade's Edge Arena",
'564'=>"Black Temple",
'565'=>"Gruul's Lair",
'566'=>"Eye of the Storm",
'568'=>"Zul'Aman",
'572'=>"Ruins of Lordaeron",
'580'=>"The Sunwell",
'582'=>"Transport: Rut'theran to Auberdine",
'584'=>"Transport: Menethil to Theramore",
'585'=>"Magister's Terrace",
'586'=>"Transport: Exodar to Auberdine",
'587'=>"Transport: Feathermoon Ferry",
'588'=>"Transport: Menethil to Auberdine",
'589'=>"Transport: Orgrimmar to Grom'Gol",
'590'=>"Transport: Grom'Gol to Undercity",
'591'=>"Transport: Undercity to Orgrimmar",
'593'=>"Transport: Booty Bay to Ratchet",
'598'=>"Sunwell Fix (Unused)"
);

static $MapCoord =Array(
//=========================== Not used maps =============================================================
// Array(  0,"Eastern Kingdoms",,,,,1950,2564,"Instance/Azeroth.jpg"), // Use in GPS
// Array(  1,"Kalimdor",,,,,1950,2564,"Instance/Kalimdor.jpg"),        // Use in GPS
// Array( 13,"Testing",,,,,1950,2564,"Instance/SerpentshrineCavern.jpg"),
// Array( 25,"Scott Test",,,,,1950,2564,"Instance/SerpentshrineCavern.jpg"),
// Array( 29,"CashTest",,,,,1950,2564,"Instance/SerpentshrineCavern.jpg"),
// Array( 35,"<unused>StormwindPrison",,,,,1950,2564,"Instance/SerpentshrineCavern.jpg"),
// Array( 37,"Azshara Crater",,,,,1950,2564,"Instance/SerpentshrineCavern.jpg"),
// Array( 42,"Collin's Test",,,,,1950,2564,"Instance/SerpentshrineCavern.jpg"),
// Array( 44,"<unused> Monastery",,,,,1950,2564,"Instance/SerpentshrineCavern.jpg"),
// Array(169,"Emerald Dream",,,,,1950,2564,"Instance/SerpentshrineCavern.jpg"),
// Array(369,"Deeprun Tram",,,,,1950,2564,"Instance/SerpentshrineCavern.jpg"),  это карта железной дороги между стормом и айроном
// Array(451,"Development Land",,,,,1950,2564,"Instance/SerpentshrineCavern.jpg"),
// Array(530,"Outland",,,,,1950,2564,"Instance/SerpentshrineCavern.jpg"),      // Use in GPS
//Array(568,"Zul'Aman"),
//Array(572,"Ruins of Lordaeron"),
//=======================================================================================================
 Array( 30,"Alterac Valley",1032,-1676,296,-754,1300,504,"Instance/AlteracValley.jpg"),
// Array( 33,"Shadowfang Keep",,,,,1950,2564,"Instance/SerpentshrineCavern.jpg"),    // have many level -> passed
 Array( 34,"Stormwind Stockade",201,-11,158,-158,424,632,"Instance/Stockade.jpg"),
 Array( 36,"Deadmines",128,-321,-339,-1151,898,1623,"Instance/Deadmines.jpg"),
 Array( 43,"Wailing Caverns",192,-399,560,-388,1182,1896,"Instance/WailingCaverns.jpg"),
// Array( 47,"Razorfen Kraul",,,,,1950,2564,"Instance/SerpentshrineCavern.jpg"),
 Array( 48,"Blackfathom Deeps",-72,-900,429,-507,1656,1872,"Instance/BlackfathomDeeps.jpg"),
 Array( 70,"Uldaman",189,-375,472,-75,1128,1094,"Instance/Uldaman.jpg"),
 Array( 90,"Gnomeregan",-196,-920,762,-146,1448,1816,"Instance/Gnomeregan.jpg"),
 Array(109,"Sunken Temple",-241,-718,329,-141,954,940,"Instance/SunkenTemple.jpg"),
// Array(129,"Razorfen Downs",,,,,1950,2564,"Instance/SerpentshrineCavern.jpg"),
// Array(189,"Scarlet Monastery",,,,,1950,2564,"Instance/SerpentshrineCavern.jpg"),
 Array(209,"Zul'Farrak",2062,1143,1433,604,441,398,"Instance/ZulFarrak.jpg"),
// Array(229,"Blackrock Spire",,,,,1950,2564,"Instance/SerpentshrineCavern.jpg"),
 Array(230,"Blackrock Depths",1491,252,271,-855,2478,2252,"Instance/BlackrockDepths.jpg"),
 Array(249,"Onyxia's Lair",67,-225,-8,-292,583,568,"Instance/OnyxiasLair.jpg"),
// Array(269,"Opening of the Dark Portal",,,,,1950,2564,"Instance/SerpentshrineCavern.jpg"),
// Array(289,"Scholomance",,,,,1950,2564,"Instance/SerpentshrineCavern.jpg"),
 Array(309,"Zul'Gurub",-11335,-12568,-1106,-2137,592,495,"Instance/ZulGurub.jpg"),
 Array(329,"Stratholme",4155,3373,-2923,-3809,1564,1772,"Instance/Stratholme.jpg"),
 Array(349,"Maraudon",1172,-174,300,-819,2692,2238,"Instance/Maraudon.jpg"),
// Array(389,"Ragefire Chasm",,,,,1950,2564,"Instance/SerpentshrineCavern.jpg"),
 Array(409,"Molten Core",1338,483,-267,-1260,1710,1986,"Instance/MoltenCore.jpg"),
// Array(429,"Dire Maul",,,,,1950,2564,"Instance/SerpentshrineCavern.jpg"),
// Array(449,"Alliance PVP Barracks",,,,,1950,2564,"Instance/SerpentshrineCavern.jpg"),
// Array(450,"Horde PVP Barracks",,,,,1950,2564,"Instance/SerpentshrineCavern.jpg"),
// Array(469,"Blackwing Lair",,,,,1950,2564,"Instance/SerpentshrineCavern.jpg"),
 Array(489,"Warsong Gulch",1698,827,1864,994,418,418,"Instance/WarsongGulch.jpg"),
 Array(509,"Ruins of Ahn'Qiraj",-8070,-10257,2470,950,1050,730,"Instance/RuinsofAhnQiraj.jpg"),
// Array(529,"Arathi Basin",,,,,1950,2564,"Instance/SerpentshrineCavern.jpg"),
 Array(531,"Ahn'Qiraj Temple",-7840,-9372,2255,782,3064,2947,"Instance/AhnQirajTemple.jpg"),  // Поворот исходника на 21.5 град
// Array(532,"Karazhan",,,,,1950,2564,"Instance/SerpentshrineCavern.jpg"),
 Array(533,"Naxxramas",3569,2428,-2862,-4080,2282,2436,"Instance/Naxxramas.jpg"),
 Array(534,"The Battle for Mount Hyjal",5958,4075,-1104,-4123,904,1449,"Instance/TheBattleforMountHyjal.jpg"),
 Array(540,"Hellfire Citadel: The Shattered Halls",582,-46,357,-168,1256,1050,"Instance/TheShatteredHalls.jpg"),
 Array(542,"Hellfire Citadel: The Blood Furnace",558,-49,219,-229,1214,896,"Instance/TheBloodFurnace.jpg"),
 Array(543,"Hellfire Citadel: Ramparts",-508,-2176,2376,900,834,738,"Instance/Ramparts.jpg"),
 Array(544,"Magtheridon's Lair",242,-127,122,-111,738,466,"Instance/MagtheridonsLair.jpg"),

 Array(545,"Coilfang: The Steamvault",132,-406,35,-622,1076,1314,"Instance/TheSteamvault.jpg"),
 Array(546,"Coilfang: The Underbog",427,-189,191,-610,1232,1602,"Instance/TheUnderbog.jpg"),
 Array(547,"Coilfang: The Slave Pens",157.5,-357.5,44.5,-829.5,1030,1748,"Instance/TheSlavePens.jpg"),
 Array(548,"Coilfang: Serpentshrine Cavern",579,-396,121,-1161,1950,2564,"Instance/SerpentshrineCavern.jpg"),
 Array(550,"Tempest Keep: The Eye",883,-78,501,-509,1923,2021,"Instance/TheEye.jpg"),
 Array(552,"Tempest Keep: The Arcatraz",547,-56,247,-306,1206,1106,"Instance/TheArcatraz.jpg"),
 Array(553,"Tempest Keep: The Botanica",232,-266,641,-104,996,1490,"Instance/TheBotanica.jpg"),
 Array(554,"Tempest Keep: The Mechanar",354,-104,212,-221,916,866,"Instance/TheMechanar.jpg"),
 Array(555,"Auchindoun: Shadow Labyrinth",86,-588.5,83.5,-575.5,1349,1318,"Instance/ShadowLabyrinth.jpg"),
 Array(556,"Auchindoun: Sethekk Halls",124,-295.5,385,-70,839,910,"Instance/SethekkHalls.jpg"),
 Array(557,"Auchindoun: Mana-Tombs",84.5,-438,65.5,-306.5,1045,744,"Instance/ManaTombs.jpg"),
 Array(558,"Auchindoun: Auchenai Crypts",298.75,-187.25,56,-448.5,972,1009,"Instance/AuchenaiCrypts.jpg"),
// Array(559,"Nagrand Arena"),//bg
 Array(560,"The Escape From Durnholde",3730,530,2667,-533,1536,1536,"Instance/TheEscapeFromDurnholde.jpg"),
//Array(562,"Blade's Edge Arena"),//bg
//Array(564,"Black Temple"),
 Array(565,"Gruul's Lair",304,-37,445,-32,682,954,"Instance/GruulsLair.jpg"),
 Array(566,"Eye of the Storm",2873,1433,2118,942,891,565,"Instance/EyeoftheStorm.jpg"), //bg
);

function get_Map($map_id)
{
 global $MapCoord;
 for($i=0; $i<count($MapCoord); $i++)
 if ($MapCoord[$i][0]==$map_id)
     return $MapCoord[$i];
 return 0;
};

static $baseIconPath="img/map_icon";

function get_map_name($map_id)
{
  global $gmapName;
  $mapname = @$gmapName[$map_id];
  if ($mapname != "")
      return $mapname;
  return "Unknown $map_id";
}

// Таблица преобразования глобальных координат в координаты на картинке карты
// формат id, Map, MapID, X1, X2, Y1, Y2, NotDef
// Расчёт координат идёт по формулам:
//    y=Ширина картинки*(posy - Y1)/(Y2-Y1);
//    x=Высота картинки*(posx - X1)/(X2-X1);
// y - горизонтальная координата
// x - вертикальная координата
$AreaCoord =Array(
//******************************************************************************
//************************ Azeroth Areas ***************************************
//******************************************************************************
Array(14,	0,	  0, "Azeroth",            17051.83594, -20599.61719,	9194.25,	   -15906.71875,	-1),
Array(15,	0,	 36, "Alterac",             783.333313,	-2016.666626,	1500,	       -366.6666565,	-1),
Array(16,	0,	 45, "Arathi",             -866.666626,	-4466.666504,	-133.3333282,  -2533.333252,	-1),
Array(17,	0,	  3, "Badlands",          -2079.166504,	-4566.666504,	-5889.583008,  -7547.916504,	-1),
Array(19,	0,	  4, "BlastedLands",      -1241.666626,	-4591.666504,	-10566.66602,  -12800,	-1),
Array(20,	0,	 85, "Tirisfal",           3033.333252, -1485.416626,     3837.499756, 824.999939,	-1),
Array(21,	0,	130, "Silverpine",         3449.999756,	-750,             1666.666626, -1133.333252,	-1),
Array(22,	0,	 28, "WesternPlaguelands",	416.6666565,	-3883.333252,	3366.666504,	499.9999695,	-1),
Array(23,	0,	139, "EasternPlaguelands",	-2185.416504,	-6056.25,	3799.999756,	1218.75,	-1),
Array(24,	0,	267, "Hilsbrad",	1066.666626,	-2133.333252,	400,	-1733.333252,	-1),
Array(26,	0,	 47, "Hinterlands",	-1575,	-5425,	1466.666626,	-1100,	-1),
Array(27,	0,	  1, "DunMorogh",	1802.083252,	-3122.916504,	-3877.083252,	-7160.416504,	-1),
Array(28,	0,	 51, "SearingGorge",	-322.9166565,	-2554.166504,	-6100,	-7587.499512,	-1),
Array(29,	0,	 46, "BurningSteppes",	-266.6666565,	-3195.833252,	-7031.249512,	-8983.333008,	-1),
Array(30,	0,	 12, "Elwynn",	1535.416626,	-1935.416626,	-7939.583008,	-10254.16602,	-1),
Array(32,	0,	 41, "DeadwindPass",	-833.333313,	-3333.333252,	-9866.666016,	-11533.33301,	-1),
Array(34,	0,	 10, "Duskwood",	833.333313,	-1866.666626,	-9716.666016,	-11516.66602,	-1),
Array(35,	0,	 38, "LochModan",	-1993.749878,	-4752.083008,	-4487.5,	-6327.083008,	-1),
Array(36,	0,	 44, "Redridge",	-1570.833252,	-3741.666504,	-8575,	-10022.91602,	-1),
Array(37,	0,	 33, "Stranglethorn",	2220.833252,	-4160.416504,	-11168.75,	-15422.91602,	-1),
Array(38,	0,	  8, "SwampOfSorrows",	-2222.916504,	-4516.666504,	-9620.833008,	-11150,	-1),
Array(39,	0,	 40, "Westfall",	3016.666504,	-483.333313,	-9400,	-11733.33301,	-1),
Array(40,	0,	 11, "Wetlands",	-389.583313,	-4525,	-2147.916504,	-4904.166504,	-1),
Array(301,	0, 1519, "Stormwind",	1380.971436,	36.70063019,	-8278.850586,	-9175.205078,	-1),
Array(341,	0, 1537, "Ironforge",	-713.5913696,	-1504.216431,	-4569.241211,	-5096.845703,	-1),
Array(382,	0, 1497, "Undercity",	873.192627,	-86.18240356,	1877.945313,	1237.841187,	-1),
//******************************************************************************
//************************ Kalimdor Areas **************************************
//******************************************************************************
Array(13,	1,    0, "Kalimdor",	17066.59961	,	-19733.21094	,	12799.90039	,	-11733.2998	,	-1),
Array(4,	1,   14, "Durotar",	-1962.499878	,	-7249.999512	,	1808.333252	,	-1716.666626	,	-1),
Array(9,	1,  215, "Mulgore",	2047.916626	,	-3089.583252	,	-272.9166565	,	-3697.916504	,	-1),
Array(11,	1,   17, "Barrens",	2622.916504	,	-7510.416504	,	1612.499878	,	-5143.75	,	-1),
Array(41,	1,  141, "Teldrassil",	3814.583252	,	-1277.083252	,	11831.25	,	8437.5	,	-1),
Array(42,	1,  148, "Darkshore",	2941.666504	,	-3608.333252	,	8333.333008	,	3966.666504	,	-1),
Array(43,	1,  331, "Ashenvale",	1699.999878	,	-4066.666504	,	4672.916504	,	829.166626	,	-1),
Array(61,	1,  400, "ThousandNeedles",	-433.333313	,	-4833.333008	,	-3966.666504	,	-6899.999512	,	-1),
Array(81,	1,  406, "StonetalonMountains",	3245.833252	,	-1637.499878	,	2916.666504	,	-339.583313	,	-1),
Array(101,	1,  405, "Desolace",	4233.333008	,	-262.5	,	452.083313	,	-2545.833252	,	-1),
Array(121,	1,  357, "Feralas",	5441.666504	,	-1508.333252	,	-2366.666504	,	-6999.999512	,	-1),
Array(141,	1,   15, "Dustwallow",	-974.999939	,	-6225	,	-2033.333252	,	-5533.333008	,	-1),
Array(161,	1,  440, "Tanaris",	-218.7499847	,	-7118.749512	,	-5875	,	-10475	,	-1),
Array(181,	1,   16, "Aszhara",	-3277.083252	,	-8347.916016	,	5341.666504	,	1960.416626	,	-1),
Array(182,	1,  361, "Felwood",	1641.666626	,	-4108.333008	,	7133.333008	,	3299.999756	,	-1),
Array(201,	1,  490, "UngoroCrater",	533.333313	,	-3166.666504	,	-5966.666504	,	-8433.333008	,	-1),
Array(241,	1,  493, "Moonglade",	-1381.25	,	-3689.583252	,	8491.666016	,	6952.083008	,	-1),
Array(261,	1, 1377, "Silithus",	2537.5	,	-945.8339844	,	-5958.333984	,	-8281.25	,	-1),
Array(281,	1,	618, "Winterspring",	-316.6666565	,	-7416.666504	,	8533.333008	,	3799.999756	,	-1),
Array(321,	1, 1637, "Ogrimmar",	-3680.601074	,	-5083.205566	,	2273.877197	,	1338.460571	,	-1),
Array(362,	1, 1638, "ThunderBluff",	516.666626	,	-527.083313	,	-849.999939	,	-1545.833252	,	-1),
Array(381,	1, 1657, "Darnassis",	2938.362793	,	1880.029541	,	10238.31641	,	9532.586914	,	-1),

//******************************************************************************
//********************** Battleground Areas ************************************
//******************************************************************************
Array(401,	 30, 2597, "AlteracValley",	1781.249878	,	-2456.25	,	1085.416626	,	-1739.583252	,	-1),
Array(443,	489, 3277, "WarsongGulch",	2041.666626	,	895.833313	,	1627.083252	,	862.499939	,	-1),
Array(461,	529, 3358, "ArathiBasin",	1858.333252	,	102.0833282	,	1508.333252	,	337.5	,	-1),
Array(482,	566, 3820, "NetherstormArena",	2660.416504	,	389.583313	,	2918.75	,	1404.166626	,	-1),

//******************************************************************************
//************************* Island  Areas **************************************
//******************************************************************************
Array(480, 530, 3487, "SilvermoonCity",	-6400.75	,	-7612.208496	,	10153.70898	,	9346.938477	,	0),
Array(462, 530, 3430, "EversongWoods",	-4487.5	,	-9412.5	,	11041.66602	,	7758.333008	,	0),
Array(463, 530, 3433, "Ghostlands",	-5283.333008	,	-8583.333008	,	8266.666016	,	6066.666504	,	0),

Array(471, 530, 3557, "TheExodar"    ,	-11066.36719	,	-12123.1377	,	-3609.68335	,	-4314.371094	,	1),
Array(464, 530, 3524, "AzuremystIsle",	-10500	        ,	-14570.83301,	-2793.75	,	-5508.333008	,	1),
Array(476, 530, 3525, "BloodmystIsle",	-10075	        ,	-13337.49902,	-758.333313	,	-2933.333252	,	1),
//******************************************************************************
//************************* Outland Areas **************************************
//******************************************************************************
Array(466, 530,    0, "Expansion01",         12996.03906,-4468.039063, 5821.359375, -5821.359375,-1),
Array(465, 530, 3483, "Hellfire",            5539.583008, 375,         1481.25,     -1962.499878,-1),
Array(467, 530, 3521, "Zangarmarsh",         9475,        4447.916504, 1935.416626, -1416.666626,-1),
Array(473, 530, 3520, "ShadowmoonValley",	 4225,       -1275,       -1947.916626, -5614.583008,-1),
Array(475, 530, 3522, "BladesEdgeMountains", 8845.833008, 3420.833252,	4408.333008,  791.666626,-1),
Array(477, 530, 3518, "Nagrand",             10295.83301, 4770.833008,	41.66666412,-3641.666504,-1),
Array(478, 530, 3519, "TerokkarForest",      7083.333008, 1683.333252,	-999.999939,-4600,       -1),
Array(479, 530, 3523, "Netherstorm",         5483.333008,  -91.666664, 5456.25,	     1739.583252,-1),
Array(481, 530, 3703, "ShattrathCity",       6135.258789, 4829.008789,-1473.954468,	-2344.787842,-1),
Array(499, 530, 4080, "Sunwell",            -5302.083008,-8629.166016,13568.74902,   11350,       0),
);
function get_Area($area_id)
{
 global $AreaCoord;
 for($i=0; $i<count($AreaCoord); $i++)
 if ($AreaCoord[$i][2]==$area_id)
     return $AreaCoord[$i];
 return 0;
};
// Таблицы зон определяющих в какой карте находится обьект и позволяющие выбрать
// наилучшую карту
$zone_0 = Array(
		Array(700,10,1244,1873,"Undercity",1497),
		Array(-840,-1330,-5050,-4560,"Ironforge",1537),
		Array(1190,200,-9074,-8280,"Stormwind City",1519),
		Array(-2170,-4400,-7348,-6006,"Badlands",3),
		Array(-500,-4400,-4485,-2367,"Wetlands",11),
		Array(2220,-2250,-15422,-11299,"Stranglethorn Vale",33),
		Array(-1724,-3540,-9918,-8667,"Redridge Mountains",44),
		Array(-2480,-4400,-6006,-4485,"Loch Modan",38),
		Array(662,-1638,-11299,-9990,"Duskwood",10),
		Array(-1638,-2344,-11299,-9918,"Deadwind Pass",41),
		Array(834,-1724,-9990,-8526,"Elwynn Forest",12),
		Array(-500,-3100,-8667,-7348,"Burning Steppes",46),
		Array(-608,-2170,-7348,-6285,"Searing Gorge",51),
		Array(2000,-2480,-6612,-4485,"Dun Morogh",1),
		Array(-1575,-5425,-432,805,"The Hinterlands",47),
		Array(3016,662,-11299,-9400,"Westfall",40),
		Array(600,-1575,-1874,220,"Hillsbrad Foothills",267),
		Array(-2725,-6056,805,3800,"Eastern Plaguelands",139),
		Array(-850,-2725,805,3400,"Western Plaguelands",28),
		Array(2200,600,-900,1525,"Silverpine Forest",130),
		Array(2200,-850,1525,3400,"Tirisfal Glades",85),
		Array(-2250,-3520,-12800,-10666,"Blasted Lands",4),
		Array(-2344,-4516,-11070,-9600,"Swamp of Sorrows",8),
		Array(-1575,-3900,-2367,-432,"Arathi Highlands",45),
		Array(600,-1575,220,1525,"Alterac Mountains",36),
 		);

$zone_1 = Array(
		Array(2698,2030,9575,10267,"Darnassus",1657),
		Array(326,-360,-1490,-910,"Thunder Bluff",1638),
		Array(-3849,-4809,1387,2222,"Orgrimmar",1637),
		Array(-1300,-3250,7142,8500,"Moonglade",493),
		Array(2021,-300,-9000,-6016,"Silithus",1377),
		Array(-2259,-7000,4150,8500,"Winterspring",618),
		Array(-300,-2494,-8221,-6016,"Un'Goro Crater",490),
		Array(-590,-2259,3580,7142,"Felwood",361),
		Array(-3787,-8000,1370,6000,"Azshara",16),
		Array(-1900,-5500,-10475,-6825,"Tanaris",440),
		Array(-2478,-5500,-5135,-2330,"Dustwallow Marsh",15),
		Array(360,-1536,-3474,-412,"Mulgore",215),
		Array(4000,-804,-6828,-2477,"Feralas",357),
		Array(3500,360,-2477,372,"Desolace",405),
		Array(-804,-5500,-6828,-4566,"Thousand Needles",400),
		Array(-3758,-5500,-1300,1370,"Durotar",14),
		Array(1000,-3787,1370,4150,"Ashenvale",331),
		Array(2500,-1300,4150,8500,"Darkshore",148),
		Array(3814,-1100,8600,11831,"Teldrassil",141),
		Array(3500,-804,-412,3580,"Stonetalon Mountains",406),
		Array(-804,-4200,-4566,1370,"The Barrens",17),
		);
$zone_530 = Array(
        Array( 6135, 4829, -1474, -2345, "Shattrath City",3703),

        Array( 5100,  375,  1481, -1400, "Hellfire Peninsula", 3483),//!
        Array( 4225,-1275, -1948, -5615, "Shadowmoon Valley",3520),
        Array( 7700, 4460,  4408,  1070, "Blades Edge Mountains",3522),//!
        Array( 9475, 4448,  1935, -600,  "Zangarmarsh", 3521),
        Array(10296, 6100,  -600, -3300, "Nagrand",3518),//!
        Array( 7083, 1683, -1000, -4600, "Terokkar Forest",3519),
        Array( 4460,  -92,  5456,  1740, "Netherstorm",3523),

        Array( -6401, -7612, 10154,  9347, "Silvermoon City",3487),
        Array(-11066,-12123, -3610,	-4314, "The Exodar",3557),

        Array( -4488, -9413, 11042,  7758, "Eversong Woods",3430),
        Array( -5283, -8583,  8267,  6067, "Ghostlands",3433),
        Array(-10500,-14571, -2794,	-5508, "Azuremyst Isle",3524),
        Array(-10075,-13337,  -758,	-2933, "Bloodmyst Isle",3525),
        Array( -5302, -8629,166016, 13569, "Sunwell", 4080),
        );

function get_zone($map_id,$player_x,$player_y)
{
 global $zone_0,$zone_1,$zone_530;
 switch ($map_id)
 {
   case 0:
   for ($i=0; $i<count($zone_0); $i++)
	if (($zone_0[$i][2] < $player_x) && ($zone_0[$i][3] > $player_x) &&
        ($zone_0[$i][1] < $player_y) && ($zone_0[$i][0] > $player_y))
     return $zone_0[$i];
   break;
   case 1:
   for ($i=0; $i<count($zone_1); $i++)
	if (($zone_1[$i][2] < $player_x) && ($zone_1[$i][3] > $player_x) &&
        ($zone_1[$i][1] < $player_y) && ($zone_1[$i][0] > $player_y))
     return $zone_1[$i];
   break;
   case 530:
   for ($i=0; $i<count($zone_530); $i++)
	if (($zone_530[$i][3] < $player_x) && ($zone_530[$i][2] > $player_x) &&
        ($zone_530[$i][1] < $player_y) && ($zone_530[$i][0] > $player_y))
     return $zone_530[$i];
   break;
 default:
    return(0);
 }
}
function get_zone_name($map_id,$player_x,$player_y)
{
 $zone = get_zone($map_id,$player_x,$player_y);
 return $zone[4];
}

function get_time_text($time)
{
    $day = floor($time/(60*60*24));$time-=$day*60*60*24;
    $hour= floor($time/(60*60));$time-=$hour*60*60;
    $min = floor($time/(60));$time-=$min*60;
    $sec = $time;
    $t="";
    if ($day!=0)
    {
     $a=$day - floor($day/10)*10;
          if ($a==0) $t=$t."$day дней ";
     else if ($a==1) $t=$t."$day день ";
     else if ($a <5) $t=$t."$day дня ";
     else            $t=$t."$day дней ";
    }
    if ($hour!=0)
    {
     $a=$hour - floor($hour/10)*10;
          if ($a==0) $t=$t."$hour часов ";
     else if ($a==1) $t=$t."$hour час ";
     else if ($a <5) $t=$t."$hour часа ";
     else            $t=$t."$hour часов ";
    }
    if ($min!=0)
    {
     $a=$min - floor($min/10)*10;
          if ($a==0) $t=$t."$min минут ";
     else if ($a==1) $t=$t."$min минута ";
     else if ($a <5) $t=$t."$min минуты ";
     else            $t=$t."$min минут ";
    }
    if ($sec!=0)
    {
      $a=$sec - floor($sec/10)*10;
          if ($a==0) $t=$t."$sec секунд";
     else if ($a==1) $t=$t."$sec секунда";
     else if ($a <5) $t=$t."$sec секунды";
     else            $t=$t."$sec секунд";
    }
    return $t;
}

function validateTextForMap($text)
{
  $letter = array("'",'"'     ,"<"   ,">"   ,">"   ,"\r","\n"  );
  $values = array("`",'&quot;',"&lt;","&gt;","&gt;",""  ,"<br>");
  return str_replace($letter, $values, $text);
}
?>
