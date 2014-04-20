<?php
//===========================================================================
// Вспомогательные функции
//===========================================================================

define('PET_BONUS_RAP_TO_AP',0);
define('PET_BONUS_RAP_TO_SPELLDMG',1);
define('PET_BONUS_STAM',2);
define('PET_BONUS_RES',3);
define('PET_BONUS_ARMOR',4);
define('PET_BONUS_SPELLDMG_TO_SPELLDMG',5);
define('PET_BONUS_SPELLDMG_TO_AP',6);
define('PET_BONUS_INT',7);
// Получаем бонус для пета от статов игрока
function ComputePetBonus($stat, $value, $unitClass)
{
  $HUNTER_PET_BONUS =array(0.22,0.1287,0.3,0.4,0.35,0.0,0.0,0.0);
  $WARLOCK_PET_BONUS=array(0.0,0.0,0.3,0.4,0.35,0.15,0.57,0.3);
  if($unitClass == CLASS_WARLOCK )
  {
   if($WARLOCK_PET_BONUS[$stat]) return $value * $WARLOCK_PET_BONUS[$stat];
   else return 0;
  }
  elseif($unitClass == CLASS_HUNTER )
  {
   if($HUNTER_PET_BONUS[$stat])	return $value * $HUNTER_PET_BONUS[$stat];
   else return 0;
  }
  return 0;
}

// Вспомогательные функции получения данных
function getFloatValue($value,$num)
{
 $txt = unpack("f", pack("L",$value));
 return round($txt[1],$num);
}
// Получаем класс игрока
function getClassId($char)
{
 return $char['class'];
}
// Игрок использует ману
function isManaUser($char_data)
{
 switch ($char_data['class'])
 {
	case 2:
	case 3:
	case 5:
	case 7:
	case 8:
	case 9:
	case 11:  	$powerType = 0;   break;
	default: 	$powerType = 1;
 }

 if ($powerType==0) return true;
 return false;
}
// Получаем скилл игрока
function getSkill($id, $char_data)
{
 $skillInfo = array(0,0,0,0,0,0);
 for ($i=0;$i<128;$i++)
 if (($char_data[PLAYER_SKILL_INFO_1_1 + $i*3] & 0x0000FFFF) == $id)
 {
  $data0 = $char_data[PLAYER_SKILL_INFO_1_1 + $i*3];
  $data1 = $char_data[PLAYER_SKILL_INFO_1_1 + $i*3 + 1];
  $data2 = $char_data[PLAYER_SKILL_INFO_1_1 + $i*3 + 2];

  $skillInfo[0]=$data0&0x0000FFFF; // skill id
  $skillInfo[1]=$data0>>16;        // skill flag
  $skillInfo[2]=$data1&0x0000FFFF; // skill
  $skillInfo[3]=$data1>>16;        // max skill
  $skillInfo[4]=$data2&0x0000FFFF; // pos buff
  $skillInfo[5]=$data2>>16;        // neg buff
  break;
 }
 return $skillInfo;
}
// Получаем скилл для вещи (оружия)
function getSkillFromItemID($id)
{
 if ($id==0) return SKILL_UNARMED;
 $item = getItem($id);
 if ($item == 0) return SKILL_UNARMED;
 if ($item['class']!=2) return SKILL_UNARMED;
 switch ($item['subclass'])
 {
  case  0: return SKILL_AXES;
  case  1: return SKILL_TWO_HANDED_AXE;
  case  2: return SKILL_BOWS;
  case  3: return SKILL_GUNS;
  case  4: return SKILL_MACES;
  case  5: return SKILL_TWO_HANDED_MACES;
  case  6: return SKILL_POLEARMS;
  case  7: return SKILL_SWORDS;
  case  8: return SKILL_TWO_HANDED_SWORDS;
  case 10: return SKILL_STAVES;
//  case 11: return ;//One-Handed Exotics
//  case 12: return ;//Two-Handed Exotics
  case 13: return SKILL_FIST_WEAPONS;
//  case 14: return ;//Miscellaneous
  case 15: return SKILL_DAGGERS;
  case 16: return SKILL_THROWN;
//  case 17: return ;//Spears
  case 18: return SKILL_CROSSBOWS;
  case 19: return SKILL_WANDS;
//  case 20: return ;//Fishing Pole
 }
 return SKILL_UNARMED;
}

// Крит от ловкости
function GetCritChanceFromAgility($rating, $char_data)
{
 $base = Array(3.1891, 3.2685, -1.532, -0.295, 3.1765, 3.1890, 2.922, 3.454, 2.6222, 20, 7.4755);
 $ratingkey = array_keys($rating);
 $class     = getClassId($char_data);
 $char_stat = getCharacterStats($char_data['guid']);
 $agi       = $char_stat['agility'];
 return $base[$class-1] + $agi*$rating[$ratingkey[$class]]*100;
}
function GetSpellCritChanceFromIntellect($rating, $char_data)
{
 $base = Array(0, 3.3355, 3.602, 0, 1.2375, 0, 2.201, 0.9075, 1.7, 20, 1.8515);
 $ratingkey = array_keys($rating);
 $class     = getClassId($char_data);
 $char_stat = getCharacterStats($char_data['guid']);
 $int       = $char_stat['intellect'];
 return $base[$class-1] + $int*$rating[$ratingkey[11+$class]]*100;
}
function GetAttackPowerForStat($statIndex, $effectiveStat, $class)
{
 $ap=0;
 if ($statIndex==STAT_STRENGTH)
 {
  switch ($class)
  {
   case CLASS_WARRIOR:
   case CLASS_PALADIN:
   case CLASS_DEATH_KNIGHT:
   case CLASS_DRUID:
    $baseStr=min($effectiveStat,20);
    $moreStr=$effectiveStat-$baseStr;
    $ap=$baseStr + 2*$moreStr;
   break;
   default:
    $ap=$effectiveStat - 10;
   break;
  }
 }
 else if ($statIndex==STAT_AGILITY)
 {
  switch ($class)
  {
   case CLASS_SHAMAN:
   case CLASS_ROGUE:
   case CLASS_HUNTER:
    $ap=$effectiveStat - 10;
  }
 }
 if ($ap<0)$ap=0;
 return $ap;
}
function GetRatingCoefficient($rating, $id)
{
 $ratingkey = array_keys($rating);
 $c = $rating[$ratingkey[44+$id]];if ($c==0) $c=1;
 return $c;
}
function GetHRCoefficient($rating, $class)
{
 $ratingkey = array_keys($rating);
 $c = $rating[$ratingkey[22+$class]];if ($c==0) $c=1;
 return $c;
}
function GetMRCoefficient($rating, $class)
{
 $ratingkey = array_keys($rating);
 $c = $rating[$ratingkey[33+$class]];if ($c==0) $c=1;
 return $c;
}
// Функции генерации таблиц оболочек
function createTopTable()
{
 ob_start();
 echo "<table class=chartt cellSpacing=0>";
}
function createEndTable($valueClass, $value)
{
 echo "</table>";
 $data = ob_get_contents();
 ob_end_clean();
 echo '<td '.addTooltip($data, 'WIDTH, 400, OFFSETX, 30, OFFSETY, 20, STICKY, false').' class='.$valueClass.'>'.$value.'</td>';
}
function createHeader($name,$base,$valueClass)
{
 createTopTable();
 echo "<tr><td class=head>$name <span class=$valueClass>$base</span>";
 echo "</td></tr>";
}

//=========================================
// Создаём тултип по одному из статов:
// 0 - Броня, 1-9 ... Resistance
function renderResist($statIndex, $stat, $char_data)
{
 $ResistType = array(
  0=>"armor",
  1=>"holy",
  2=>"fire",
  3=>"nature",
  4=>"frost",
  5=>"shadow",
  6=>"arcane",
 );
 $class = $char_data['class'];

 $valueClass = "normStat";

 createHeader(getResistance($statIndex),$stat,$valueClass);
 echo "<tr><td>";
 if ($statIndex==SCHOOL_ARMOR)
 {
	$levelModifier = $char_data['level'];
	if ($levelModifier > 59 ) $levelModifier = $levelModifier + (4.5 * ($levelModifier-59));
	$armorReduction = 0.1*$stat/(8.5*$levelModifier + 40);
	$armorReduction = $armorReduction/(1+$armorReduction)*100;
	if ($armorReduction > 75) $armorReduction = 75;
	if ($armorReduction <  0) $armorReduction = 0;
    printf("Reduces Physical Damage taken by %0.2f%%",$armorReduction);
    $petBonus = ComputePetBonus(PET_BONUS_ARMOR, $stat, $class);
	if( $petBonus > 0 )
		printf("<br>Increases your pet`s Armor by %d", $petBonus);
    echo "</td></tr>";
    createEndTable($valueClass, $stat);
 }
 else
 {
  $unitLevel = max($char_data['level'],20);
  $magicResistanceNumber = $stat/$unitLevel;
  if     ($magicResistanceNumber > 5   ) $resistanceLevel = "Excellent";
  elseif ($magicResistanceNumber > 3.75) $resistanceLevel = "Very Good";
  elseif ($magicResistanceNumber > 2.5 ) $resistanceLevel = "Good";
  elseif ($magicResistanceNumber > 1.25) $resistanceLevel = "Fair";
  elseif ($magicResistanceNumber > 0   ) $resistanceLevel = "Poor";
  else                                   $resistanceLevel = "None";
  printf("Increases the ability to resist %s-based attacks, spells and abilities.<br />",getSchool($statIndex));
  printf("Resistance against level %d: %s",$unitLevel,$resistanceLevel);
  $petBonus = ComputePetBonus(PET_BONUS_RES,$stat,$class);
  if($petBonus > 0)
     printf("<br>Increases your pet`s Resistance by %d",$petBonus);
  echo "</td></tr>";
  createEndTable($ResistType[$statIndex], $stat) ;
 }
}

//=========================================
// Stats panel
// Создаём тултип по одному из статов:
function renderStatRow($statIndex, $char_data, $stat)
{
 $rating = getRating($char_data['level']);
 $StatText = getStatTypeName($statIndex);
 $class = $char_data['class'];
 $effectiveStat = $stat;
 createHeader($StatText,$effectiveStat,"normStat");
 echo "<tr><td>";
 if ($statIndex==STAT_STRENGTH)
 {
  $attpower = GetAttackPowerForStat(STAT_STRENGTH, $effectiveStat, $class);
  printf("Increases Attack Power by %d",$attpower);
  if ($class==CLASS_WARRIOR OR $class==CLASS_PALADIN OR $class==CLASS_SHAMAN)
  {
   $block = max(0, $effectiveStat*BLOCK_PER_STRENGTH - 10);
   printf("<br>Increases Block by %d",$block);
  }
 }
 else if ($statIndex==STAT_AGILITY)
 {
  $crit = GetCritChanceFromAgility($rating,$char_data);
  $attackPower = GetAttackPowerForStat(STAT_AGILITY, $effectiveStat, $class);
  $armor = $effectiveStat * ARMOR_PER_AGILITY;
  if ($attackPower > 0 ) printf("Increases Attack Power by %d<br>", $attackPower);
  printf("Increases Critical Hit chance by %.2f%%<br>Increases Armor by %d",$crit,$armor);
 }
 else if ($statIndex==STAT_STAMINA)
 {
 	$baseStam = min(20, $effectiveStat);
	$moreStam = $effectiveStat - $baseStam;
	$health   = $baseStam + ($moreStam*HEALTH_PER_STAMINA);
    printf("Increases Health by %d",$health);
    $petStam = ComputePetBonus(PET_BONUS_STAM, $effectiveStat, $class);
	if($petStam > 0)
	  printf("<br />Increases your pet`s Stamina by %d",$petStam);

 }
 else if ($statIndex==STAT_INTELLECT)
 {
  $baseInt = min(20, $effectiveStat);
  $moreInt = $effectiveStat - $baseInt;
  $mana = $baseInt + $moreInt*MANA_PER_INTELLECT;
  $spellcrit = GetSpellCritChanceFromIntellect($rating, $char_data);
  if (isManaUser($char_data))
    printf("Increases Mana by %d<br>Increases Spell Critical Hit by %.2f%%",$mana,$spellcrit);
  $petInt = ComputePetBonus(PET_BONUS_INT, $effectiveStat, $class);
  if($petInt > 0 )
   printf("<br />Increases your pet`s Intellect by %d", $petInt);
 }
 else if ($statIndex==STAT_SPIRIT)
 {
  $baseRatio = array(0, 0.625, 0.2631, 0.2, 0.3571, 0.1923, 0.625, 0.1724, 0.1212, 0.1282, 1, 0.1389);
  $regen = $effectiveStat * GetHRCoefficient($rating, $class);
  $baseSpirit = $effectiveStat;
  if ($baseSpirit>50) $baseSpirit = 50;
  $moreSpirit = $effectiveStat - $baseSpirit;
  $regen = $baseSpirit * $baseRatio[$class] + $moreSpirit * GetHRCoefficient($rating, $class);

  printf("Increases Health Regeneration by %d Per Second while not in combat", $regen);
  if (isManaUser($char_data))
  {
   $int = $char_data[UNIT_FIELD_STAT0 + STAT_INTELLECT];
   $regen = sqrt($int) * $effectiveStat * GetMRCoefficient($rating, $class);
   $regen = floor($regen*5);
   printf("<br />Increases Mana Regeneration by %d Per 5 Seconds while not casting", $regen);
  }
 }
 echo "</td></tr>";
 $valueClass = "normStat";
 createEndTable($valueClass, $effectiveStat);
}
//=========================================
// Spell Panel
// Создаём тултип по спелл урону:
function GetSpellBonusDamage($School,$char_data)
{
 $bonus = $char_data[PLAYER_FIELD_MOD_DAMAGE_DONE_POS+$School] +  $char_data[PLAYER_FIELD_MOD_DAMAGE_DONE_NEG+$School];
 $bonus = $bonus*getFloatValue($char_data[PLAYER_FIELD_MOD_DAMAGE_DONE_PCT+$School],5);
 return $bonus;
}
function renderSpellDamage($char_data)
{
 $holySchool = 1;
 $minModifier = GetSpellBonusDamage($holySchool,$char_data);
 createTopTable();
 $text="";
 for ($i=$holySchool;$i<7;$i++)
 {
  $bonusDamage = GetSpellBonusDamage($i, $char_data);
  $minModifier = min($minModifier, $bonusDamage);
  $text =$text."<tr valign=center><td width=1px><img src=images/player_info/characterframe/SpellSchoolIcon$i.gif></td><td>&nbsp;".getSchool($i)."</td><td align=right>$bonusDamage</td></tr>";
 }
 echo "<tr><td class=head colSpan=3>Bonus Damage $minModifier</td></tr>";
 echo $text;
 $class = getClassId($char_data);
 if ($class==CLASS_WARLOCK OR $class==CLASS_HUNTER)
 {
  $shadow = GetSpellBonusDamage(SCHOOL_SHADOW, $char_data);
  $fire   = GetSpellBonusDamage(SCHOOL_FIRE, $char_data);
  $petBonusAP = ComputePetBonus(PET_BONUS_SPELLDMG_TO_AP, max($shadow,$fire),$class);
  $petBonusDmg = ComputePetBonus(PET_BONUS_SPELLDMG_TO_SPELLDMG, max($shadow,$fire),$class);
  if ($petBonusAP OR $petBonusDmg)
  {
   if ($shadow>$fire)
    printf("<tr><td colSpan=3>Your Shadow Damage increases your pet`s Attack Power by %d and Spell Damage by %d</td></tr>",$petBonusAP,$petBonusDmg);
   else
    printf("<tr><td colSpan=3>Your Fire Damage increases your pet`s<br>Attack Power by %d and<br>Spell Damage by %d</td></tr>",$petBonusAP,$petBonusDmg);
  }
 }
 createEndTable("normStat", $minModifier);
}
//=========================================
// Создаём тултип по спелл хилу:
function renderSpellHeal($char_data)
{
 $bonus = $char_data[PLAYER_FIELD_MOD_HEALING_DONE_POS];
 createTopTable();
 printf("<tr><td class=head>Bonus Healing</td></tr>");
 printf("<tr><td>Increases your healing by up to %d</td></tr>",$bonus);
 createEndTable("normStat", $bonus);
}

function renderSpellHit($char_data)
{
 $rating = getRating($char_data['level']);
 $valueRating = $char_data[PLAYER_FIELD_SPELL_HIT_RATING];
 $RatingPct   = $valueRating/GetRatingCoefficient($rating, CR_HIT_SPELL);
 createTopTable();
 printf ("<tr><td class=head>Hit Rating %d</td></tr>", $valueRating);
 printf ("<tr><td>Increases your spell chance to hit a target of level %d by %.2f%%</td></tr>", $char_data['level'], $RatingPct);
 $penetration = $char_data[PLAYER_FIELD_MOD_TARGET_RESISTANCE];
 printf ("<tr><td><br>Spell penetration %d (Reduces enemy resistances by %d)</td></tr>", $penetration, -$penetration);
 createEndTable("normStat", $valueRating);
}
//=========================================
// Создаём тултип по спелл криту:
function renderSpellCrit($char_data)
{
 $rating = getRating($char_data['level']);
 $spellCritRating = $char_data[PLAYER_FIELD_SPELL_CRIT_RATING];
 $minCrit = getFloatValue($char_data[PLAYER_SPELL_CRIT_PERCENTAGE+1],2);
 $critRatingPct =  $spellCritRating/GetRatingCoefficient($rating, CR_CRIT_SPELL);
 createTopTable();
 printf ("<tr><td class=head colSpan=3>Crit Rating %d (%.2f%%)</td></tr>",$spellCritRating, $critRatingPct);
 for ($i=1;$i<7;$i++)
 {
  $crit = getFloatValue($char_data[PLAYER_SPELL_CRIT_PERCENTAGE+$i],2);
  $minCrit=min($minCrit,$crit);
  echo "<tr valign=center><td width=1px><img src=images/player_info/characterframe/SpellSchoolIcon$i.gif></td>";
  echo                   "<td>&nbsp;".getSchool($i)."</td><td align=right width=80px>$crit%</td></tr>";
 }
 createEndTable("normStat", $minCrit."%");
}

function renderSpellHaste($char_data)
{
 $rating = getRating($char_data['level']);
 $valueRating = $char_data[PLAYER_FIELD_SPELL_HASTE_RATING];
 $RatingPct   = $valueRating/GetRatingCoefficient($rating, CR_HASTE_SPELL);
 createTopTable();
 printf ("<tr><td class=head>Haste rating %d</td></tr>", $valueRating);
 printf ("<tr><td>Increases the speed that you spell cast by %.2f%%</td></tr>", $RatingPct);
 createEndTable("normStat", $valueRating);
}

function renderManaRegen($char_data)
{
 $value  = getFloatValue($char_data[UNIT_FIELD_POWER_REGEN_FLAT_MODIFIER],2)*5;
 $valueI = getFloatValue($char_data[UNIT_FIELD_POWER_REGEN_INTERRUPTED_FLAT_MODIFIER],2)*5;
 createTopTable();
 printf ("<tr><td class=head>Mana Regen</td></tr>");
 printf ("<tr><td>%d mana regenerated every 5 seconds while not casting<br>%d mana regenerated every 5 seconds while casting</td></tr>", $value, $valueI);
 createEndTable("normStat", $value);
}

// Render melee panel
function renderMeleeSkill($char_data)
{
 $rating = getRating($char_data['level']);
 $skillID = getSkillFromItemID($char_data[PLAYER_VISIBLE_ITEM_MAIN_HAND]);
 $skill   = getSkill($skillID,$char_data);
 $defRating = $char_data[PLAYER_FIELD_MELEE_WEAPON_SKILL_RATING];
 $RatingAdd = $defRating/GetRatingCoefficient($rating, CR_DEFENSE_SKILL);
 $Buff          = $skill[4]+$skill[5]+intval($RatingAdd);
 $effectiveStat = $skill[2]+$Buff;
 createTopTable();
 printf("<tr><td class=head>Main hand %d</td></tr>", $effectiveStat);
 printf("<tr><td>Skill Rating %d (+%d Skill)</td></tr>", $defRating, $RatingAdd);
 $valueClass = "normStat";
      if ($Buff<0) $valueClass = "negStat";
 else if ($Buff>0) $valueClass = "posStat";
 createEndTable($valueClass, $effectiveStat);
}

function renderMeleeDamage($char_data)
{
 $minDamage  = getFloatValue($char_data[UNIT_FIELD_MINDAMAGE],0);
 $maxDamage  = getFloatValue($char_data[UNIT_FIELD_MAXDAMAGE],0);
 $speed      = getFloatValue($char_data[UNIT_FIELD_BASEATTACKTIME],2)/1000;
 $Damage     = ($minDamage + $maxDamage) * 0.5;
 if ($speed < 0.1) $speed = 0.1;
 $damagePerSecond = (max($Damage,1) / $speed);
 createTopTable();
 echo "<tr><td class=head>Main Hand</td></tr>";
 printf ("<tr><td>Attack Speed (seconds):</td><td align=right>%.2f</td></tr>", $speed);
 printf ("<tr><td>Damage:</td><td align=right>%d - %d</td></tr>", $minDamage, $maxDamage);
 printf ("<tr><td>Damage per Second:</td><td align=right>%.2f</td></tr>", $damagePerSecond);
 $skillID = getSkillFromItemID($char_data[PLAYER_VISIBLE_ITEM_OFF_HAND]);
 if ($skillID!=SKILL_UNARMED)
 {
  $minOffHandDamage = getFloatValue($char_data[UNIT_FIELD_MINOFFHANDDAMAGE],0);
  $maxOffHandDamage = getFloatValue($char_data[UNIT_FIELD_MAXOFFHANDDAMAGE],0);
  $offhand_speed    = getFloatValue($char_data[UNIT_FIELD_OFFHANDATTACKTIME],2)/1000;
  $Damage     = ($minOffHandDamage + $maxOffHandDamage) * 0.5;
  $offdamagePerSecond = (max($Damage,1) / $speed);
  echo "<tr><td class=head>Off Hand</td></tr>";
  printf ("<tr><td>Attack Speed (seconds):</td><td align=right>%.2f</td></tr>", $offhand_speed);
  printf ("<tr><td>Damage:</td><td align=right>%d - %d</td></tr>", $minOffHandDamage, $maxOffHandDamage);
  printf ("<tr><td>Damage per Second:</td><td align=right>%.2f</td></tr>", $offdamagePerSecond);
 }
 createEndTable("normStat", $minDamage." - ".$maxDamage);
}

function renderMeleeSpeed($char_data)
{
 $rating = getRating($char_data['level']);
 $main_speed = getFloatValue($char_data[UNIT_FIELD_BASEATTACKTIME],2)/1000;
 $offhand_speed = getFloatValue($char_data[UNIT_FIELD_OFFHANDATTACKTIME],2)/1000;
 $speed = round($main_speed,2);
 $skillID = getSkillFromItemID($char_data[PLAYER_VISIBLE_ITEM_OFF_HAND]);
 if ($skillID!=SKILL_UNARMED)
   $speed = $speed." / ". round($offhand_speed,2);
 $valueRating = $char_data[PLAYER_FIELD_MELEE_HASTE_RATING] ;
 $RatingPct   = $valueRating/GetRatingCoefficient($rating, CR_HASTE_RANGED);

 createTopTable();
 echo "<tr><td class=head>Attack Speed $speed</td></tr>";
 printf ("<tr><td>Haste rating %d (%.2f%% haste)</td></tr>", $valueRating, $RatingPct);
 createEndTable("normStat", $speed);
}

function renderMeleeAP($char_data)
{
 $multipler = getFloatValue($char_data[UNIT_FIELD_ATTACK_POWER_MULTIPLIER], 8);
 if   ($multipler<0) $multipler = 0;
 else $multipler+=1;
 $effectiveStat = $char_data[UNIT_FIELD_ATTACK_POWER]*$multipler;
 $Buff     = $char_data[UNIT_FIELD_ATTACK_POWER_MODS]*$multipler;
 $posBuff = 0;
 $negBuff = 0;
 $valueClass = "normStat";
      if ($Buff>0) {$posBuff=$Buff;$valueClass = "posStat";}
 else if ($Buff<0) {$negBuff=$Buff;$valueClass = "negStat";}
 $stat = $effectiveStat+$Buff;
 createHeader("Attack Power",$stat,"normStat");
 printf ("<tr><td>Increases damage with melee weapons by %.1f damage per second.</td></tr>",max($stat, 0)/ATTACK_POWER_MAGIC_NUMBER);
 createEndTable($valueClass, $stat);
}

function renderMeleeHit($char_data)
{
 $rating = getRating($char_data['level']);
 $valueRating = $char_data[PLAYER_FIELD_MELEE_HIT_RATING];
 $RatingPct   = $valueRating/GetRatingCoefficient($rating, CR_HIT_MELEE);
 createTopTable();
 printf ("<tr><td class=head>Hit Rating %d</td></tr>", $valueRating);
 printf ("<tr><td>Increases your melee chance to hit a target of level %d by %.2f%%</td></tr>", $char_data['level'], $RatingPct);
 $penetration = $char_data[PLAYER_FIELD_MOD_TARGET_PHYSICAL_RESISTANCE];
 printf ("<tr><td><br>Enemy Armor reduced by %d</td></tr>", $penetration);
 createEndTable("normStat", $valueRating);
}

function renderMeleeCrit($char_data)
{
 $rating = getRating($char_data['level']);
 $meleeCrit       = getFloatValue($char_data[PLAYER_CRIT_PERCENTAGE],2);
 $meleeCritRating = $char_data[PLAYER_FIELD_MELEE_CRIT_RATING];
 $critRatingPct   = $meleeCritRating/GetRatingCoefficient($rating, CR_CRIT_MELEE);
 createTopTable();
 printf ("<tr><td class=head>Crit Chance %.2f%%</td></tr>",$meleeCrit);
 printf ("<tr><td>Crit Rating %d (%.2f%% crit chance)</td></tr>", $meleeCritRating, $critRatingPct);
 createEndTable("normStat", $meleeCrit."%");
}
// =================================
// Render ranged panel
function renderRangedSkill($char_data)
{
 $rating = getRating($char_data['level']);
 $skillID = getSkillFromItemID($char_data[PLAYER_VISIBLE_ITEM_RANGED]);
 if ($skillID==SKILL_UNARMED)
 {
  createTopTable();
  printf("<tr><td class=head>Ranged N/A</td></tr>");
  createEndTable("normStat", "N/A");
  return;
 }
 $skill   = getSkill($skillID,$char_data);
 $defRating = $char_data[PLAYER_FIELD_MELEE_WEAPON_SKILL_RATING];
 $RatingAdd = $defRating/GetRatingCoefficient($rating, CR_DEFENSE_SKILL);
 $Buff          = $skill[4]+$skill[5]+intval($RatingAdd);
 $effectiveStat = $skill[2]+$Buff;
 createTopTable();
 printf("<tr><td class=head>Main hand %d</td></tr>", $effectiveStat);
 printf("<tr><td>Skill Rating %d (+%d Skill)</td></tr>", $defRating, $RatingAdd);
 $valueClass = "normStat";
      if ($Buff<0) $valueClass = "negStat";
 else if ($Buff>0) $valueClass = "posStat";
 createEndTable($valueClass, $effectiveStat);
}
function renderRangedDamage($char_data)
{
 createTopTable();
 $skillID = getSkillFromItemID($char_data[PLAYER_VISIBLE_ITEM_RANGED]);
 if ($skillID==SKILL_UNARMED)
 {
  echo "<tr><td class=head>Ranged N/A</td></tr>";
  createEndTable("normStat", "N/A");
 }
 else
 {
  $minDamage  = getFloatValue($char_data[UNIT_FIELD_MINRANGEDDAMAGE],0);
  $maxDamage  = getFloatValue($char_data[UNIT_FIELD_MAXRANGEDDAMAGE],0);
  $speed      = getFloatValue($char_data[UNIT_FIELD_RANGEDATTACKTIME],2)/1000;
  $Damage     = ($minDamage + $maxDamage) * 0.5;
  if ($speed < 0.1) $speed = 0.1;
  $damagePerSecond = (max($Damage,1) / $speed);
  echo "<tr><td class=head>Ranged</td></tr>";
  printf ("<tr><td>Attack Speed (seconds):</td><td align=right>%.2f</td></tr>", $speed);
  printf ("<tr><td>Damage:</td><td align=right>%d - %d</td></tr>", $minDamage, $maxDamage);
  printf ("<tr><td>Damage per Second:</td><td align=right>%.2f</td></tr>", $damagePerSecond);
  createEndTable("normStat", $minDamage." - ".$maxDamage);
 }
}
function renderRangedSpeed($char_data)
{
 $rating = getRating($char_data['level']);
 $skillID = getSkillFromItemID($char_data[PLAYER_VISIBLE_ITEM_RANGED]);
 if ($skillID==SKILL_UNARMED)
 {
  createTopTable();
  printf("<tr><td class=head>Attack Speed N/A</td></tr>");
  createEndTable("normStat", "N/A");
  return;
 }
 $range_speed = getFloatValue($char_data[UNIT_FIELD_RANGEDATTACKTIME],2)/1000;
 $valueRating = $char_data[PLAYER_FIELD_RANGED_HASTE_RATING] ;
 $RatingPct   = $valueRating/GetRatingCoefficient($rating, CR_HASTE_RANGED);
 createTopTable();
 printf ("<tr><td class=head>Attack Speed %.2f</td></tr>", $range_speed);
 printf ("<tr><td>Haste rating %d (%.2f%% haste)</td></tr>", $valueRating, $RatingPct);
 createEndTable("normStat", $range_speed);
}

function renderRangedAP($char_data)
{
 $class = getClassId($char_data);
 $multipler = getFloatValue($char_data[UNIT_FIELD_RANGED_ATTACK_POWER_MULTIPLIER], 8);
 if   ($multipler<0) $multipler = 0;
 else $multipler+=1;
 $effectiveStat = $char_data[UNIT_FIELD_RANGED_ATTACK_POWER]*$multipler;
 $Buff      = $char_data[UNIT_FIELD_RANGED_ATTACK_POWER_MODS]*$multipler;

 $multiple = getFloatValue($char_data[UNIT_FIELD_RANGED_ATTACK_POWER_MULTIPLIER],2);
 $posBuff = 0;
 $negBuff = 0;
 $valueClass = "normStat";
      if ($Buff>0) {$posBuff=$Buff;$valueClass = "posStat";}
 else if ($Buff<0) {$negBuff=$Buff;$valueClass = "negStat";}
 $stat = $effectiveStat+$Buff;
 createHeader("Attack Power",$stat,"normStat");
 printf ("<tr><td>Increases damage with ranged weapons by %.1f damage per second.</td></tr>",max($stat, 0)/ATTACK_POWER_MAGIC_NUMBER);

 if ($petAp = ComputePetBonus(PET_BONUS_RAP_TO_AP, $stat, $class))
  printf ("<tr><td>Increases your pet`s Attack Power by %d</td></tr>", $petAp);
 if ($penSpellDamage = ComputePetBonus(PET_BONUS_RAP_TO_SPELLDMG, $stat, $class))
  printf ("<tr><td>Increases your pet`s Spell Damage by %d</td></tr>", $penSpellDamage);

 createEndTable($valueClass, $stat);
}

function renderRangedHit($char_data)
{
 $rating = getRating($char_data['level']);
 $valueRating = $char_data[PLAYER_FIELD_RANGED_HIT_RATING];
 $RatingPct   = $valueRating/GetRatingCoefficient($rating, CR_HIT_RANGED);
 createTopTable();
 printf ("<tr><td class=head>Hit Rating %d</td></tr>", $valueRating);
 printf ("<tr><td>Increases your ranged chance to hit a target of level %d by %.2f%%</td></tr>", $char_data['level'], $RatingPct);
 $penetration = $char_data[PLAYER_FIELD_MOD_TARGET_PHYSICAL_RESISTANCE];
 printf ("<tr><td><br>Enemy Armor reduced by %d</td></tr>", $penetration);
 createEndTable("normStat", $valueRating);
}

function renderRangedCrit($char_data)
{
 $rating = getRating($char_data['level']);
 $rangedCrit       = getFloatValue($char_data[PLAYER_RANGED_CRIT_PERCENTAGE],2);
 $rangedCritRating = $char_data[PLAYER_FIELD_RANGED_CRIT_RATING];
 $critRatingPct    = $rangedCritRating/GetRatingCoefficient($rating, CR_CRIT_RANGED);
 createTopTable();
 printf ("<tr><td class=head>Crit Chance %.2f%%</td></tr>",$rangedCrit);
 printf ("<tr><td>Crit Rating %d (%.2f%% crit chance)</td></tr>", $rangedCritRating, $critRatingPct);
 createEndTable("normStat", $rangedCrit."%");
}
// ================================================
// Defense panel
//
function renderDefence($char_data)
{
 $rating = getRating($char_data['level']);
 $skill = getSkill(SKILL_DEFENCE,$char_data);

 $defRating = $char_data[PLAYER_FIELD_DEFENCE_RATING];
 $RatingAdd = $defRating/GetRatingCoefficient($rating, CR_DEFENSE_SKILL);
 $Buff          = $skill[4]+$skill[5]+intval($RatingAdd);
 $effectiveStat = $skill[2]+$Buff;

 $defensePercent = DODGE_PARRY_BLOCK_PERCENT_PER_DEFENSE * ($effectiveStat - $char_data['level']*5);
 $defensePercent = max($defensePercent, 0);
 createTopTable();
 printf("<tr><td class=head>Defense %d</td></tr>", $effectiveStat);
 printf("<tr><td>Defense Rating %d (+%d Defense)<br>", $defRating, $RatingAdd);
 printf("Increases chance to Dodge, Block and Parry by %.2f%%<br>",$defensePercent);
 printf("Decreases chance to be hit and critically hit by %.2f%%</td></tr>",$defensePercent);
 $valueClass = "normStat";
      if ($Buff<0) $valueClass = "negStat";
 else if ($Buff>0) $valueClass = "posStat";
 createEndTable($valueClass, $effectiveStat);
}

function renderDodge($char_data)
{
 $rating = getRating($char_data['level']);
 $value       = getFloatValue($char_data[PLAYER_DODGE_PERCENTAGE],2);
 $valueRating = $char_data[PLAYER_FIELD_DODGE_RATING];
 $RatingPct   = $valueRating/GetRatingCoefficient($rating, CR_DODGE);
 createTopTable();
 printf ("<tr><td class=head>Dodge Chance %.2f%%</td></tr>", $value);
 printf ("<tr><td>Dodge rating of %d adds %.2f%% Dodge</td></tr>",$valueRating, $RatingPct);
 createEndTable("normStat", $value."%");
}

function renderParry($char_data)
{
 $rating = getRating($char_data['level']);
 $value       = getFloatValue($char_data[PLAYER_PARRY_PERCENTAGE],2);
 $valueRating = $char_data[PLAYER_FIELD_PARRY_RATING];
 $RatingPct   = $valueRating/GetRatingCoefficient($rating, CR_PARRY);
 createTopTable();
 printf ("<tr><td class=head>Parry Chance %.2f%%</td></tr>", $value);
 printf ("<tr><td>Parry rating of %d adds %.2f%% Parry</td></tr>", $valueRating, $RatingPct);
 createEndTable("normStat", $value."%");
}

function renderBlock($char_data)
{
 $rating = getRating($char_data['level']);
 $value       = getFloatValue($char_data[PLAYER_BLOCK_PERCENTAGE],2);
 $valueRating = $char_data[PLAYER_FIELD_BLOCK_RATING];
 $RatingPct   = $valueRating/GetRatingCoefficient($rating, CR_BLOCK);
 $block_damage = $char_data[PLAYER_SHIELD_BLOCK];
 createTopTable();
 printf ("<tr><td class=head>Block Chance %.2f%%</td></tr>", $value);
 printf ("<tr><td>Block rating of %d adds  Block</td></tr>", $valueRating, $RatingPct);
 printf ("<tr><td>You block stops %d damage</td></tr>", $block_damage);
 createEndTable("normStat", $value."%");
}

function renderRecilence($char_data)
{
 $rating = getRating($char_data['level']);
 $melee  = $char_data[PLAYER_FIELD_CRIT_TAKEN_MELEE_RATING];
 $ranged = $char_data[PLAYER_FIELD_CRIT_TAKEN_RANGED_RATING];
 $spell  = $char_data[PLAYER_FIELD_CRIT_TAKEN_SPELL_RATING];
 $minResilience = min($melee, $ranged, $spell);
 createTopTable();
 printf("<tr><td class=head>Resilience %d</td></tr>", $minResilience);
 printf("<tr><td>Melee Resilience %d (%.2f%%)</td></tr>", $melee, $melee/GetRatingCoefficient($rating,CR_CRIT_TAKEN_MELEE));
 printf("<tr><td>Ranged Resilience %d (%.2f%%)</td></tr>", $ranged, $ranged/GetRatingCoefficient($rating,CR_CRIT_TAKEN_RANGED));
 printf("<tr><td>Spell Resilience %d (%.2f%%)</td></tr>", $spell, $spell/GetRatingCoefficient($rating,CR_CRIT_TAKEN_SPELL));
 createEndTable("normStat", $minResilience);
}

// Данная функция показывает ауры из базы
function show_player_auras_from_db($guid)
{
 global $cDB;
 $buffs  = $cDB->selectCol("SELECT `spell` FROM `character_aura` WHERE `guid` = ?d GROUP BY `spell`", $guid);
 foreach ($buffs as $aura)
 {
	 echo "<br>";
     show_spell($aura, 0, 'aura');
 }
}
?>
