<?php
include_once("functions.php");

$gSpellEffect = array(
'1'=>"Instakill",
'2'=>"School Damage",
'3'=>"Dummy",
'4'=>"Portal Teleport(not used)",
'5'=>"Teleport Unit",
'6'=>"Apply Aura",
'7'=>"Environmental Damage",
'8'=>"Power Drain",
'9'=>"Health Leech",
'10'=>"Heal",
'11'=>"BIND",
'12'=>"PORTAL",
'13'=>"RITUAL_BASE",
'14'=>"RITUAL_SPECIALIZE",
'15'=>"RITUAL_ACTIVATE_PORTAL",
'16'=>"Complete Quest",
'17'=>"WEAPON_DAMAGE_NOSCHOOL",
'18'=>"Resurrect",
'19'=>"ADD_EXTRA_ATTACKS",
'20'=>"Allow Dodge",
'21'=>"Evade",
'22'=>"Allow Parry",
'23'=>"Allow Block",
'24'=>"Create Item",
'25'=>"Weapon",
'26'=>"Defence",
'27'=>"PERSISTENT_AREA_AURA",
'28'=>"Summon",
'29'=>"LEAP",
'30'=>"Energize",
'31'=>"WEAPON_PERCENT_DAMAGE",
'32'=>"Trigger Missle",
'33'=>"Open Lock",
'34'=>"Summon/Change Item",
'35'=>"Apply Area Aura on Party",
'36'=>"Learn Spell",
'37'=>"SPELL_DEFENSE",
'38'=>"Dispel",
'39'=>"Laungage",
'40'=>"DUAL_WIELD",
'41'=>"Summon Wild",
'42'=>"Summon Guardian",
'43'=>"TELEPORT_UNITS_FACE_CASTER",
'44'=>"Skill Step",
'45'=>"UNDEFINED_45",
'46'=>"SPAWN",
'47'=>"Trade Skill",
'48'=>"STEALTH",
'49'=>"DETECT",
'50'=>"Summon Object",
'51'=>"FORCE_CRITICAL_HIT",
'52'=>"GUARANTEE_HIT",
'53'=>"Enchant Item",
'54'=>"Enchant Item Temporary",
'55'=>"TAMECREATURE",
'56'=>"Summon Pet",
'57'=>"Learn Pet Spell",
'58'=>"Weapon Damage +",
'59'=>"OPEN_LOCK_ITEM",
'60'=>"Proficiency",
'61'=>"Send Event",
'62'=>"Power Burn",
'63'=>"Threat",
'64'=>"Trigger Spell",
'65'=>"HEALTH_FUNNEL",
'66'=>"CREATE_MANA_GEM",
'67'=>"HEAL_MAX_HEALTH",
'68'=>"Interrupt Cast",
'69'=>"DISTRACT",
'70'=>"PULL",
'71'=>"Pickpocket",
'72'=>"ADD_FARSIGHT",
'73'=>"UNTRAIN_TALENTS",
'74'=>"Apply Glyph",
'75'=>"Heal Mechanical",
'76'=>"Summon Object Wild",
'77'=>"Script Effect",
'78'=>"ATTACK",
'79'=>"SANCTUARY",
'80'=>"Add Combo Points",
'81'=>"Create House",
'82'=>"BIND_SIGHT",
'83'=>"Duel",
'84'=>"STUCK",
'85'=>"Summon Player",
'86'=>"Activate Object",
'87'=>"Summon Fire Totem",
'88'=>"Summon Earth Totem",
'89'=>"Summon Water Totem",
'90'=>"Summon Air Totem",
'91'=>"THREAT_ALL",
'92'=>"Enchant item in hands",
'93'=>"SUMMON_PHANTASM",
'94'=>"Self Resurrect",
'95'=>"SKINNING",
'96'=>"Charge",
'97'=>"Summon critter",
'98'=>"Knock Back",
'99'=>"Disenchant",
'100'=>"INEBRIATE",
'101'=>"Feed Pet",
'102'=>"Dismiss Pet",
'103'=>"Reputation",
'104'=>"SUMMON_OBJECT_SLOT1",
'105'=>"SUMMON_OBJECT_SLOT2",
'106'=>"SUMMON_OBJECT_SLOT3",
'107'=>"SUMMON_OBJECT_SLOT4",
'108'=>"Dispel Mechanic",
'109'=>"Summon Dead Pet",
'110'=>"Destroy all Totems",
'111'=>"DURABILITY_DAMAGE",
'112'=>"Summon Demon",
'113'=>"Resurrect new",
'114'=>"ATTACK_ME",
'115'=>"DURABILITY_DAMAGE_PCT",
'116'=>"SKIN_PLAYER_CORPSE",
'117'=>"SPIRIT_HEAL",
'118'=>"Set Skill Rank",
'119'=>"Area Aura on Pet",
'120'=>"TELEPORT_GRAVEYARD",
'121'=>"Normalized Weapon Damage +",
'122'=>"122",
'123'=>"Script Fly",
'124'=>"PLAYER_PULL",
'125'=>"REDUCE_THREAT_PERCENT",
'126'=>"STEAL_BENEFICIAL_BUFF",
'127'=>"Prospecting",
'128'=>"Area Aura on Friends",
'129'=>"Area Aura on Enemys",
'130'=>"130",
'131'=>"131",
'132'=>"Play Music",
'133'=>"Unlearn Profession Specialization",
'134'=>"Kill Credit",
'135'=>"Call Pet",
'136'=>"Heal Total %",
'137'=>"Regenerate power %",
'138'=>"Jump",
'139'=>"Clear Quest",
'140'=>"Force Cast",
'141'=>"141",
'142'=>"Trigger Spell With Value",
'143'=>"Area Aura on Owner",
'144'=>"144",
'145'=>"145",
'146'=>"Activate Rune",
'147'=>"Quest Fail",
'148'=>"148",
'149'=>"149",
'150'=>"150",
'151'=>"TRIGGER_SPELL_2",
'152'=>"152",
'153'=>"153",
'154'=>"154",
'155'=>"Titan Grip",
'156'=>"Add Socket",
'157'=>"157",
'158'=>"Milling",
'159'=>"Allow Pet Rename"
);

$gSpellAuraName = array(
'0'=>"NONE",
'1'=>"Bind Sight",
'2'=>"Mod Possess",
'3'=>"Periodic Damage",
'4'=>"Dummy",
'5'=>"Confuse",
'6'=>"Charm",
'7'=>"Fear",
'8'=>"Periodic Heal",
'9'=>"Mod Attack Speed",
'10'=>"Mod Threat",
'11'=>"Taunt",
'12'=>"Stun",
'13'=>"Mod Damage Done",
'14'=>"Mod Damage Taken",
'15'=>"DAMAGE_SHIELD",
'16'=>"Stealth",
'17'=>"Stealth Detection",
'18'=>"Invisibilily",
'19'=>"Invisibilily Detection",
'20'=>"Periodic Regenerate % of Total Health",
'21'=>"Periodic Regenerate % of Total Mana",
'22'=>"Mod Resistance",
'23'=>"Periodic Trigger Spell",
'24'=>"Perioic Energize",
'25'=>"Pacify",
'26'=>"Root",
'27'=>"Silence",
'28'=>"Chance to Reflect harmful Spells",
'29'=>"Mod Stat",
'30'=>"Mod Skill",
'31'=>"Increase Speed",
'32'=>"Increase Mounted Speed",
'33'=>"Decrease Speed",
'34'=>"Mod Maximum Health",
'35'=>"Mod Maximum Power",
'36'=>"Snapeshift",
'37'=>"Immune Effect ",
'38'=>"Immune State",
'39'=>"Immune School",
'40'=>"Immune Damage",
'41'=>"Immune Dispel",
'42'=>"Proc Trigger Spell",
'43'=>"Proc Trigger Damage",
'44'=>"Track Creatures",
'45'=>"Track Resources",
'46'=>"Mod Parry Skill",
'47'=>"Mod Parry %",
'48'=>"Mod Dodge Skill",
'49'=>"Mod Dodge %",
'50'=>"Mod Block Skill",
'51'=>"Mod Block %",
'52'=>"Mod Crit %",
'53'=>"Periodic Leech",
'54'=>"Mod Melee/Ranged Hit Chance",
'55'=>"Mod Spell Hit Chance",
'56'=>"Transform",
'57'=>"Mod Spell Crit Chance",
'58'=>"Increase Swim Speed",
'59'=>"Mod Melee/Spell Damage Versus",
'60'=>"Pacify and Silence",
'61'=>"Scale",
'62'=>"Periodic Health Funnel",
'63'=>"Periodic Power Funnel",
'64'=>"Periodic Power Leech",
'65'=>"Haste - Spells",
'66'=>"Feign Death",
'67'=>"Disarm",
'68'=>"Stalked",
'69'=>"Absorbs Damage for School",
'70'=>"EXTRA_ATTACKS",
'71'=>"Mod Spell Crit",
'72'=>"Mod Power Cost %",
'73'=>"Mod Power Cost",
'74'=>"Reflect Spells",
'75'=>"Laungage",
'76'=>"Far Sight",
'77'=>"Mechanic Immunity",
'78'=>"MOUNTED",
'79'=>"Mod Damage Done %",
'80'=>"MOD_PERCENT_STAT",
'81'=>"SPLIT_DAMAGE_PCT",
'82'=>"WATER_BREATHING",
'83'=>"MOD_BASE_RESISTANCE",
'84'=>"MOD_REGEN",
'85'=>"MOD_POWER_REGEN",
'86'=>"Create Item on Victim Death",
'87'=>"Mod Damage Taken %",
'88'=>"MOD_HEALTH_REGEN_PERCENT",
'89'=>"Periodic Damage % Total Health",
'90'=>"Mod Resist Chance",
'91'=>"Mod Detect Range",
'92'=>"PREVENTS_FLEEING",
'93'=>"MOD_UNATTACKABLE",
'94'=>"INTERRUPT_REGEN",
'95'=>"Ghost",
'96'=>"SPELL_MAGNET",
'97'=>"Mana Shield",
'98'=>"MOD_SKILL_TALENT",
'99'=>"Mod Melee Attack Power",
'100'=>"AURAS_VISIBLE",
'101'=>"MOD_RESISTANCE_PCT",
'102'=>"Mod Melee Attack Power Versus",
'103'=>"MOD_TOTAL_THREAT",
'104'=>"Water Walk",
'105'=>"FEATHER_FALL",
'106'=>"Hower",
'107'=>"Add Flat Modifier",
'108'=>"Add % Modifier",
'109'=>"Add Cast on Target Trigger",
'110'=>"Mod Power Regeneration %",
'111'=>"Redirect % Damage to Caster",
'112'=>"Override Class Scripts",
'113'=>"Mod Ranged Damage Taken",
'114'=>"Mod Ranged Damage Taken %",
'115'=>"Mod Healing Taken",                       //  ???
'116'=>"MOD_REGEN_DURING_COMBAT",
'117'=>"MOD_MECHANIC_RESISTANCE",
'118'=>"Mod Healing Taken %",
'119'=>"SHARE_PET_TRACKING",
'120'=>"UNTRACKABLE",
'121'=>"EMPATHY",
'122'=>"Mod Offhand Damage %",
'123'=>"Mod Target Resistance",
'124'=>"Mod Ranged Attack Power",
'125'=>"Mod Melee Damage Taken",
'126'=>"Mod Melee Damage Taken %",
'127'=>"RANGED_ATTACK_POWER_ATTACKER_BONUS",
'128'=>"MOD_POSSESS_PET",
'129'=>"MOD_SPEED_ALWAYS",
'130'=>"MOD_MOUNTED_SPEED_ALWAYS",
'131'=>"Mod Ranged Attack Power Versus",
'132'=>"Mod Maximum Energy %",
'133'=>"Mod Maximum Health %",
'134'=>"MOD_MANA_REGEN_INTERRUPT",
'135'=>"Mod Healing Done",
'136'=>"Mod Healing Done %",
'137'=>"Mod Total Stat %",
'138'=>"Haste Melee/Ranged",
'139'=>"Force Reaction",
'140'=>"Haste Ranged",
'141'=>"Haste Ranged (Ammo)",
'142'=>"MOD_BASE_RESISTANCE_PCT",
'143'=>"MOD_RESISTANCE_EXCLUSIVE",
'144'=>"Safe Fall",
'145'=>"Charisma",
'146'=>"Persuaded",
'147'=>"ADD_CREATURE_IMMUNITY",
'148'=>"Retain Combo Points",
'149'=>"RESIST_PUSHBACK",
'150'=>"MOD_SHIELD_BLOCKVALUE_PCT",
'151'=>"TRACK_STEALTHED",
'152'=>"MOD_DETECTED_RANGE",
'153'=>"SPLIT_DAMAGE_FLAT",
'154'=>"MOD_STEALTH_LEVEL",
'155'=>"MOD_WATER_BREATHING",
'156'=>"Mod Reputation Gained %",
'157'=>"PET_DAMAGE_MULTI",
'158'=>"MOD_SHIELD_BLOCKVALUE",
'159'=>"NO_PVP_CREDIT",
'160'=>"MOD_AOE_AVOIDANCE",
'161'=>"MOD_HEALTH_REGEN_IN_COMBAT",
'162'=>"POWER_BURN_MANA",
'163'=>"MOD_CRIT_DAMAGE_BONUS_MELEE",
'164'=>"164",
'165'=>"MELEE_ATTACK_POWER_ATTACKER_BONUS",
'166'=>"MOD_ATTACK_POWER_PCT",
'167'=>"MOD_RANGED_ATTACK_POWER_PCT",
'168'=>"Mod Damage Done Versus %",
'169'=>"Mod Crit Damage Versus %",
'170'=>"DETECT_AMORE",
'171'=>"MOD_SPEED_NOT_STACK",
'172'=>"MOD_MOUNTED_SPEED_NOT_STACK",
'173'=>"ALLOW_CHAMPION_SPELLS",
'174'=>"MOD_SPELL_DAMAGE_OF_STAT_PERCENT",
'175'=>"MOD_SPELL_HEALING_OF_STAT_PERCENT",
'176'=>"SPIRIT_OF_REDEMPTION",
'177'=>"AOE_CHARM",
'178'=>"Mod Debuff Resistance %",
'179'=>"MOD_ATTACKER_SPELL_CRIT_CHANCE",
'180'=>"Mod Spell Damage Versus",
'181'=>"Mod Spell Crit Damage Versus",
'182'=>"MOD_RESISTANCE_OF_INTELLECT_PERCENT",
'183'=>"MOD_CRITICAL_THREAT",
'184'=>"MOD_ATTACKER_MELEE_HIT_CHANCE",
'185'=>"MOD_ATTACKER_RANGED_HIT_CHANCE",
'186'=>"MOD_ATTACKER_SPELL_HIT_CHANCE",
'187'=>"MOD_ATTACKER_MELEE_CRIT_CHANCE",
'188'=>"MOD_ATTACKER_RANGED_CRIT_CHANCE",
'189'=>"Mod Rating",
'190'=>"Mod Faction Reputation Gain",
'191'=>"Limit Movement Speed",
'192'=>"Melee Haste",
'193'=>"Melee Slow",
'194'=>"MOD_DEPRICATED_1",
'195'=>"MOD_DEPRICATED_2",
'196'=>"Mod Cooldown",
'197'=>"MOD_ATTACKER_SPELL_AND_WEAPON_CRIT_CHANCE",
'198'=>"MOD_ALL_WEAPON_SKILLS",
'199'=>"MOD_INCREASES_SPELL_PCT_TO_HIT",
'200'=>"Mod Experience Earned %",
'201'=>"Fly",
'202'=>"IGNORE_COMBAT_RESULT",
'203'=>"Mod Melee Critical Damage Taken",
'204'=>"Mod Ranged Critical Damage Teken",
'205'=>"205",
'206'=>"MOD_SPEED_MOUNTED",
'207'=>"MOD_INCREASE_FLIGHT_SPEED",
'208'=>"MOD_SPEED_FLIGHT",
'209'=>"MOD_FLIGHT_SPEED_ALWAYS",
'210'=>"210",
'211'=>"MOD_FLIGHT_SPEED_NOT_STACK",
'212'=>"MOD_RANGED_ATTACK_POWER_OF_STAT_PERCENT",
'213'=>"Mod Rage from Damage Dealt %",
'214'=>"214",
'215'=>"ARENA_PREPARATION",
'216'=>"Haste Spells",
'217'=>"Slow Spells ???",
'218'=>"Haste Ranged",
'219'=>"MOD_MANA_REGEN_FROM_STAT",
'220'=>"MOD_RATING_FROM_STAT",
'221'=>"221",
'222'=>"222",
'223'=>"223",
'224'=>"224",
'225'=>"DUMMY_3",
'226'=>"Peridic Dummy",
'227'=>"227",
'228'=>"DETECT_STEALTH",
'229'=>"Mod AOE Damage Taken",
'230'=>"230",
'231'=>"231",
'232'=>"Mod Mechanic Duration",
'233'=>"233",
'234'=>"Mod Mechanic Duration not stack",
'235'=>"Mod Mechanic Dispel Resist",
'236'=>"236",
'237'=>"MOD_SPELL_DAMAGE_OF_ATTACK_POWER",
'238'=>"MOD_SPELL_HEALING_OF_ATTACK_POWER",
'239'=>"MOD_SCALE_2",
'240'=>"Mod Expertise",
'241'=>"FORCE_MOVE_FORWARD",
'242'=>"MOD_SPELL_DAMAGE_FROM_HEALING",
'243'=>"243",
'244'=>"COMPREHEND_LANGUAGE = 244",
'245'=>"MOD_DURATION_OF_MAGIC_EFFECTS",
'246'=>"MOD_DURATION_OF_EFFECTS_BY_DISPEL",
'247'=>"247",
'248'=>"MOD_COMBAT_RESULT_CHANCE",
'249'=>"Convert Rune",
'250'=>"MOD_INCREASE_HEALTH_2",
'251'=>"MOD_ENEMY_DODGE",
'252'=>"252",
'253'=>"MOD_BLOCK_CRIT_CHANCE",
'254'=>"MOD_DISARM_SHIELD",
'255'=>"MOD_MECHANIC_DAMAGE_TAKEN_PERCENT",
'256'=>"NO_REAGENT_USE",
'257'=>"MOD_TARGET_RESIST_BY_SPELL_CLASS",
'258'=>"258",
'259'=>"259",
'260'=>"260",
'261'=>"261",
'262'=>"262",
'263'=>"ALLOW_ONLY_ABILITY",
'264'=>"264",
'265'=>"265",
'266'=>"266",
'267'=>"267",
'268'=>"MOD_ATTACK_POWER_OF_STAT_PERCENT",
'269'=>"269",
'270'=>"270",
'271'=>"271",
'272'=>"272",
'273'=>"273",
'274'=>"274",
'275'=>"275",
'276'=>"276",
'277'=>"277",
'278'=>"MOD_DISARM_RANGED",
'279'=>"279",
'280'=>"MOD_TARGET_ARMOR_PCT",
'281'=>"MOD_HONOR_GAIN",
'282'=>"MOD_BASE_HEALTH_PCT",
'283'=>"MOD_HEALING_RECEIVED"
);

$gSpellRadiusIndex = array(
 '7'=>array(2,0,2),
 '8'=>array(5,0,5),
 '9'=>array(20,0,20),
'10'=>array(30,0,30),
'11'=>array(45,0,45),
'12'=>array(100,0,100),
'13'=>array(10,0,10),
'14'=>array(8,0,8),
'15'=>array(3,0,3),
'16'=>array(1,0,1),
'17'=>array(13,0,13),
'18'=>array(15,0,15),
'19'=>array(18,0,18),
'20'=>array(25,0,25),
'21'=>array(35,0,35),
'22'=>array(200,0,200),
'23'=>array(40,0,40),
'24'=>array(65,0,65),
'25'=>array(70,0,70),
'26'=>array(4,0,4),
'27'=>array(50,0,50),
'28'=>array(50000,0,50000),
'29'=>array(6,0,6),
'30'=>array(500,0,500),
'31'=>array(80,0,80),
'32'=>array(12,0,12),
'33'=>array(99,0,99),
'35'=>array(55,0,55),
'36'=>array(0,0,0),
'37'=>array(7,0,7),
'38'=>array(21,0,21),
'39'=>array(34,0,34),
'40'=>array(9,0,9),
'41'=>array(150,0,150),
'42'=>array(11,0,11),
'43'=>array(16,0,16),
'44'=>array(0.5,0,0.5),
'45'=>array(10,0,10),
'46'=>array(5,0,10),
'47'=>array(15,0,15),
'48'=>array(60,0,60),
'49'=>array(90,0,90)
);

$gSpellCastTime = array(
 '1'=>array(0,0,0),
 '2'=>array(250,0,250),
 '3'=>array(500,0,500),
 '4'=>array(1000,0,1000),
 '5'=>array(2000,0,2000),
 '6'=>array(5000,0,5000),
 '7'=>array(10000,0,10000),
 '8'=>array(20000,0,20000),
' 9'=>array(30000,0,30000),
'10'=>array(1000,-100,500),
'11'=>array(2000,-100,1000),
'12'=>array(5000,-100,2500),
'13'=>array(30000,-1000,10000),
'14'=>array(3000,0,3000),
'15'=>array(4000,0,4000),
'16'=>array(1500,0,1500),
'18'=>array(0,0,0),
'19'=>array(2500,0,2500),
'20'=>array(2500,0,2500),
'21'=>array(2600,0,2600),
'22'=>array(3500,0,3500),
'23'=>array(1800,0,1800),
'24'=>array(2200,0,2200),
'25'=>array(2900,0,2900),
'26'=>array(3700,0,3700),
'27'=>array(4100,0,4100),
'28'=>array(3200,0,3200),
'29'=>array(4700,0,4700),
'30'=>array(4500,0,4500),
'31'=>array(2300,0,2300),
'32'=>array(7000,0,7000),
'33'=>array(5125,-125,3000),
'34'=>array(8000,-175,4000),
'35'=>array(12500,-250,5000),
'36'=>array(600,0,600),
'37'=>array(25000,-400,8000),
'38'=>array(45000,-500,15000),
'39'=>array(50000,-500,25000),
'50'=>array(1300,0,1300),
'70'=>array(300000,0,300000),
'90'=>array(1700,0,1700),
'91'=>array(2800,0,2800),
'110'=>array(750,0,750),
'130'=>array(1600,0,1600),
'150'=>array(3800,0,3800),
'151'=>array(2700,0,2700),
'152'=>array(3100,0,3100),
'153'=>array(3400,0,3400),
'170'=>array(8000,0,8000),
'171'=>array(6000,0,6000),
'190'=>array(100,0,100),
'191'=>array(0,0,0),
'192'=>array(15000,0,15000),
'193'=>array(12000,0,12000),
'194'=>array(-1000000,0,1500),
'195'=>array(1100,0,0),
'196'=>array(750,0,0),
'197'=>array(850,0,0),
'198'=>array(900,0,0),
'199'=>array(333,0,333),
'200'=>array(0,0,0),
'201'=>array(19000,0,19000),
'202'=>array(1400,0,1400)
);

function getSpellFamilyName($i)
{
  global $gSpellFamilyName;
  $name = @$gSpellFamilyName[$i];
  if ($name == "") $name = "Family_$i";
  return $name;
}

function getRatingList($mask)
{
  global $gRatingNames;
  return getListFromArray_1($gRatingNames, $mask);
}

function getRange($index)
{
  global $gSpellRangeIndex;
  $range = @$gSpellRangeIndex[$index];
  if ($range == 0)
    return "Err index $index";

  if ($range[0]==0 OR $range[0]==$range[1])
    return $range[1];
  return $range[0]." - ".$range[1];
}

function getRangeText($index)
{
  global $gSpellRangeIndex;
  $range = @$gSpellRangeIndex[$index];
  if ($range == 0)
    return "Err index $index";

  if ($range[0]==0 OR $range[0]==$range[1])
    return $range[1]." yds (".$range[2].")";
  return $range[0]." - ".$range[1]." yds (".$range[2].")";
}

function getRadius($index)
{
  global $gSpellRadiusIndex;
  $radius = @$gSpellRadiusIndex[$index];
  if ($radius == 0)
    return "Err index $index";

  if ($radius[0]==0 OR $radius[0]==$radius[2])
    return $radius[2];
  return $radius[0]." - ".$radius[2];
}

function getRadiusText($index)
{
  global $gSpellRadiusIndex;
  $radius = @$gSpellRadiusIndex[$index];
  if ($radius == 0)
    return "Err index $index";

  if ($radius[0]==0 OR $radius[0]==$radius[2])
    return $radius[2]." yds";
  return $radius[0]." - ".$radius[2]." yds";
}

function getTotemCategory($i, $as_ref=1)
{
  global $gTotemCategory;
  $name = @$gTotemCategory[$i];
  if ($name == "")
      $name = "Category_$i";
  if ($as_ref)
      return "<a href=\"?s=i&totem=$i\">".$name."</a>";
  return $name;
}

function getRuneName($i)
{
  global $gRuneName;
  if (empty($gRuneName[$i]))
    return "Rune_".$i;
  return $gRuneName[$i];
}

function getTargetsList($mask)
{
  global $gTargetsList;
  return getListFromArray_1($gTargetsList, $mask);
}

function getForm($i, $as_ref=1)
{
  global $gSpellSnapeshiftForm;
  $name = @$gSpellSnapeshiftForm[$i];
  if ($name == "") $name = "Form_$i";
  if ($as_ref)
      return "<a href=\"?s=s&form=$i\">".$name."</a>";
  return $name;
}

function getAllowableForm($mask, $as_ref=1)
{
  global $gSpellSnapeshiftForm;
  if ($as_ref)
      return getListFromArray_1($gSpellSnapeshiftForm, $mask, "?s=s&form=%d");
  return getListFromArray_1($gSpellSnapeshiftForm, $mask);
}

function getCategoryName($i, $as_ref=1)
{
  if ($as_ref)
    return "<a href=\"?s=s&cat=$i\">".$i."</a>";
  return "$i";
}

function getPowerTypeName($index)
{
  global $gSpellPowerType;
  if ($index >= 0 && $index < 5)
    return $gSpellPowerType[$index];
  return $gSpellPowerType[-1];
}

function getSpellEffectName($i)
{
  global $gSpellEffect;
  return $gSpellEffect[$i];
}

function getSpellAuraName($i)
{
  global $gSpellAuraName;
  return $gSpellAuraName[$i];
}

function getSpellModName($i)
{
  global $gSpellModsType;
  return $gSpellModsType[$i];
}

function getDispelName($i, $as_ref=1)
{
  global $gSpellDispelType;
  $name = @$gSpellDispelType[$i];
  if (!$name) $name = "Dispell_$i";
  if ($as_ref && $i)
      return "<a href=\"?s=s&dispel=$i\">$name</a>";
  return $name;
}

function getMechanicName($i, $as_ref=1)
{
  global $gSpellMechanic;
  $name = @$gSpellMechanic[$i];
  if (!$name) $name = "Mechanic_$i";
  if ($as_ref && $i)
      return "<a href=\"?s=s&mech=$i\">$name</a>";
  return $name;
}

function getLaungageName($i)
{
  global $gLaungage;
  $name = @$gLaungage[$i];
  if ($name == "") $name = "Laungage_$i";
  return $name;
}

function getSchool($i)
{
  global $gSpellSchool;
  $name = @$gSpellSchool[$i];
  if ($name == "") $name = "School_$i";
  return $name;

}

function getSpellSchool($mask)
{
  global $gSpellSchool;
  return getListFromArray_0($gSpellSchool, $mask);
}

function getSpellDamageClass($i)
{
  global $gDmgClass;
  return $gDmgClass[$i];
}

function getSpell($spell_id, $fields="*")
{
  global $wDB;
  return $wDB->selectRow("SELECT ".$fields." FROM `wowd_spell` WHERE `id` = ?d", $spell_id);
}

function getSpellName($spell, $as_ref=1)
{
  if ($spell)
  {
    $name = validateText($spell['SpellName']);
    if ($as_ref)
        $name = "<a href=\"?spell=$spell[id]\">".$name."</a>";
    if ($spell['Rank']!="")
        $name.="<br><div class=srank>".$spell['Rank']."</div>";
    return $name;
  }
  return "No spell";
}

function getSpellNameFromId($spellId, $as_ref=1)
{
  if ($spell = getSpell($spellId))
    return getSpellName($spell, $as_ref);
  return "Err spell $spellId";
}

function getSpellDurationData($durationIndex)
{
  global $wDB;
  return $wDB->selectRow("SELECT * FROM `wowd_spell_duration` WHERE `id` = ?d", $durationIndex);
}

function getSpellDuration($spell)
{
  if ($spell['DurationIndex'])
  {
   if ($spell_duration = getSpellDurationData($spell['DurationIndex']))
     return  $spell_duration['duration_1']/1000;
  }
  return "";
}

function getSpellDurationText($spell)
{
  if ($spell['DurationIndex'])
  {
   if ($spell_duration = getSpellDurationData($spell['DurationIndex']))
   {
     if ($spell_duration['duration_1'] == -1)
         return "Unlimited";
//     if ($spell_duration['duration_1'] == ($spell_duration['duration_3'])
//         return getTimeText($spell_duration['duration_1']/1000);
     // TODO fix it
     return  getTimeText($spell_duration['duration_1']/1000);
   }
   else
     return "Err index ".$spell['DurationIndex'];
  }
  return "";
}

function getSpellCooldown($spell)
{
  if ($spell['RecoveryTime'] > $spell['CategoryRecoveryTime'])
    return $spell['RecoveryTime'];
  else
    return $spell['CategoryRecoveryTime'];
}

function getCastTimeText($spell)
{
  global $gSpellCastTime;
  $cast_time = @$gSpellCastTime[$spell['CastingTimeIndex']][0]/1000;
  if ($cast_time)
    return $cast_time." sec cast";
  else
    return "Instant Cast";
}

function getBasePointDesc($spell, $index)
{
  if (empty($spell))
      return;
  $s = $spell['EffectBasePoints_'.$index]+$spell['EffectBaseDice_'.$index];
  if ($spell['EffectDieSides_'.$index] > $spell['EffectBaseDice_'.$index])
    $s.=" - ".abs($spell['EffectBasePoints_'.$index]+$spell['EffectDieSides_'.$index]);

  if ($spell['EffectRealPointsPerLevel_'.$index])
    $s.=" + lvl*".$spell['EffectRealPointsPerLevel_'.$index];
// ”величивает только макс рандомное значение
// if ($spell['EffectDicePerLevel_'.$index])
//   $s.=" + lvl*".$spell['EffectDicePerLevel_'.$index];
  if ($spell['EffectPointsPerComboPoint_'.$index])
    $s." + combo*".$spell['EffectPointsPerComboPoint_'.$index];
  return $s;
}

function getSpellData($spell)
{
  // Basepoints
  $s1 = abs($spell['EffectBasePoints_1']+$spell['EffectBaseDice_1']);
  $s2 = abs($spell['EffectBasePoints_2']+$spell['EffectBaseDice_2']);
  $s3 = abs($spell['EffectBasePoints_3']+$spell['EffectBaseDice_3']);
  if ($spell['EffectDieSides_1']>$spell['EffectBaseDice_1']) $s1.=" - ".abs($spell['EffectBasePoints_1']+$spell['EffectDieSides_1']);
  if ($spell['EffectDieSides_2']>$spell['EffectBaseDice_2']) $s2.=" - ".abs($spell['EffectBasePoints_2']+$spell['EffectDieSides_2']);
  if ($spell['EffectDieSides_3']>$spell['EffectBaseDice_3']) $s3.=" - ".abs($spell['EffectBasePoints_3']+$spell['EffectDieSides_3']);

  $d  = 0;
  if ($spell['DurationIndex'])
   if ($spell_duration = getSpellDurationData($spell['DurationIndex']))
     $d = $spell_duration['duration_1']/1000;

  // Tick duration
  $t1 = $spell['EffectAmplitude_1'] ? $spell['EffectAmplitude_1']/1000 : 5;
  $t2 = $spell['EffectAmplitude_1'] ? $spell['EffectAmplitude_2']/1000 : 5;
  $t3 = $spell['EffectAmplitude_1'] ? $spell['EffectAmplitude_3']/1000 : 5;

  // Points per tick
  $o1 = @intval($s1*$d/$t1);
  $o2 = @intval($s2*$d/$t2);
  $o3 = @intval($s3*$d/$t3);

  $spellData['t1']=$t1;
  $spellData['t2']=$t2;
  $spellData['t3']=$t3;
  $spellData['o1']=$o1;
  $spellData['o2']=$o2;
  $spellData['o3']=$o3;
  $spellData['s1']=$s1;
  $spellData['s2']=$s2;
  $spellData['s3']=$s3;
  $spellData['m1']=$s1;
  $spellData['m2']=$s2;
  $spellData['m3']=$s3;
  $spellData['x1']= $spell['EffectChainTarget_1'];
  $spellData['x2']= $spell['EffectChainTarget_2'];
  $spellData['x3']= $spell['EffectChainTarget_3'];
  $spellData['i'] = $spell['MaxAffectedTargets'];
  $spellData['d'] = $d;
  $spellData['d1']= getTimeText($d);
  $spellData['d2']= getTimeText($d);
  $spellData['d3']= getTimeText($d);
  $spellData['v'] = $spell['AffectedTargetLevel'];
  $spellData['u'] = $spell['StackAmount'];
  $spellData['a1']= getRadius($spell['EffectRadiusIndex_1']);
  $spellData['a2']= getRadius($spell['EffectRadiusIndex_2']);
  $spellData['a3']= getRadius($spell['EffectRadiusIndex_3']);
  $spellData['b1']= $spell['EffectPointsPerComboPoint_1'];
  $spellData['b2']= $spell['EffectPointsPerComboPoint_2'];
  $spellData['b3']= $spell['EffectPointsPerComboPoint_3'];
  $spellData['e'] = $spell['EffectMultipleValue_1'];
  $spellData['e1']= $spell['EffectMultipleValue_1'];
  $spellData['e2']= $spell['EffectMultipleValue_2'];
  $spellData['e3']= $spell['EffectMultipleValue_3'];
  $spellData['f1']= $spell['DmgMultiplier_1'];
  $spellData['f2']= $spell['DmgMultiplier_2'];
  $spellData['f3']= $spell['DmgMultiplier_3'];
  $spellData['q1']= $spell['EffectMiscValue_1'];
  $spellData['q2']= $spell['EffectMiscValue_2'];
  $spellData['q3']= $spell['EffectMiscValue_3'];
  $spellData['h'] = $spell['procChance'];
  $spellData['n'] = $spell['procCharges'];
  $spellData['z'] = "<home>";
  return $spellData;
}

function spellReplace($spell, $text)
{
    $letter = array('${','}');
    $values = array( '[',']');
    $text = str_replace($letter, $values, $text);

	$signs = array('+', '-', '/', '*', '%', '^');
    $data = $text;
	$pos = 0;
    $npos = 0;
	$str = '';
    $cacheSpellData=array(); // Spell data for spell
    $lastCount = 1;
	while (false!==($npos=strpos($data, '$', $pos)))
	{
		if ($npos!=$pos)
			$str .= substr($data, $pos, $npos-$pos);
		$pos = $npos+1;
		if ('$' == substr($data, $pos, 1))
		{
			$str .= '$';
			$pos++;
			continue;
		}

		if (!preg_match('/^((([+\-\/*])(\d+);)?(\d*)(?:([lg].*?:.*?);|(\w\d*)))/', substr($data, $pos), $result))
			continue;
		$pos += strlen($result[0]);
		$op = $result[3];
		$oparg = $result[4];
		$lookup = $result[5]? $result[5]:$spell['id'];
		$var = $result[6] ? $result[6]:$result[7];
		if (!$var)
			continue;
        // l - размер последней величины == 1 ? 0 : 1
        if ($var[0]=='l')
        {
            $select = explode(':', substr($var, 1));
            $str.=@$select[$lastCount==1 ? 0:1];
        }
        // g - пол персонжа
        else if ($var[0]=='g')
        {
            $select = explode(':', substr($var, 1));
            $str.=$select[0];
        }
        else
        {
            $spellData = @$cacheSpellData[$lookup];
            if ($spellData == 0)
            {
                if ($lookup == $spell['id']) $cacheSpellData[$lookup] = getSpellData($spell);
                else                         $cacheSpellData[$lookup] = getSpellData(getSpell($lookup));
                $spellData = @$cacheSpellData[$lookup];
            }
            if ($spellData && $base = @$spellData[strtolower($var)])
            {
                if ($op && is_numeric($oparg) && is_numeric($base))
                {
                     $equation = $base.$op.$oparg;
                     eval("\$base = $equation;");
		        }
                if (is_numeric($base)) $lastCount = $base;
            }
            else
                $base = $var;
            $str.=$base;
        }
	}
	$str.= substr($data, $pos);
	$str = @preg_replace_callback("/\[.+[+\-\/*\d]\]/", 'my_relpace', $str);
//    $letter = array('*','/','+','-');
//    $values = array(' * ', ' / ',' + ',' - ');
//    $str = str_replace($letter, $values, $str);

	return($str);//."<br /><br />".$text;
}

function my_relpace($matches)
{
    $text = str_replace( array('[',']'), array('', ''), $matches[0]);
    eval("\$text = abs(".$text.");");
    return intval($text);
}

function getSpellDesc($spell)
{
  if ($spell['Description']=="") return $spell['SpellName'];
  return spellReplace($spell, validateText($spell['Description']));
}

function getSpellBuff($spell)
{
  if ($spell['ToolTip']=="") return "";
  return spellReplace($spell, validateText($spell['ToolTip']));
}

function get_spell_details($spell_id)
{
  $spell=getSpell($spell_id);
  if ($spell)
    return getSpellDesc($spell);
  return "Spell id - $spell_id";
}

function getSpellCostText($spell)
{
  // «аполн€ем стоимость заклинани€
  $powerType = getPowerTypeName($spell['powerType']);
  $powerCost = "";
  if ($spell['AttributesEx'] & 2)
    $powerCost = "Uses 100% ".$powerType;
  else
  {
    if ($spell['ManaCostPercentage'])
      $powerCost = $spell['ManaCostPercentage']."% of base";
    else if ($spell['manaCost'])
      $powerCost = $spell['manaCost'];
    if ($powerCost)
    {
      $powerCost.= " ".$powerType;
      if ($spell['manaPerSecond'])
        $powerCost.= " plus ".$spell['manaPerSecond']." per sec";
    }
  }
  return $powerCost;
}
?>
