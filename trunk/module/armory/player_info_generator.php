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
 $powerType =($char_data[UNIT_FIELD_BYTES_0]>>24)&255;
 if ($powerType==POWER_MANA) return true;
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
 $agi       = $char_data[UNIT_FIELD_STAT1];
 return $base[$class-1] + $agi*$rating[$ratingkey[$class]]*100;
}
function GetSpellCritChanceFromIntellect($rating, $char_data)
{
 $base = Array(0, 3.3355, 3.602, 0, 1.2375, 0, 2.201, 0.9075, 1.7, 20, 1.8515);
 $ratingkey = array_keys($rating);
 $class     = getClassId($char_data);
 $int       = $char_data[UNIT_FIELD_STAT3];
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
 echo "<TABLE class=chartt cellSpacing=0>";
}
function createEndTable($valueClass, $value)
{
 echo "</TABLE>";
 $data = ob_get_contents();
 ob_end_clean();
 echo '<td '.addTooltip($data, 'WIDTH, 400, OFFSETX, 30, OFFSETY, 20, STICKY, false').' class='.$valueClass.'>'.$value.'</td>';
}
function createHeader($name,$base,$posBuff,$negBuff, $valueClass)
{
 createTopTable();
 $real = $base-$posBuff-$negBuff;
 echo "<TR><TD class=head>$name <span class=$valueClass>$base</span>";
 if ($posBuff>0 OR $negBuff<0)
 {
  echo " ($real";
  if ($posBuff>0) echo " + <span class=posStat>$posBuff</span>";
  if ($negBuff<0) echo " - <span class=negStat>$negBuff</span>";
  echo ")";
 }
 echo "</TD></TR>";
}

//=========================================
// Создаём тултип по одному из статов:
// 0 - Броня, 1-9 ... Resistance
function renderResist($statIndex, $char_data)
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
 $class = getClassId($char_data);
 $effective = $char_data[UNIT_FIELD_RESISTANCES+$statIndex];
 $posBuff = getFloatValue($char_data[UNIT_FIELD_RESISTANCEBUFFMODSPOSITIVE+$statIndex],0);
 $negBuff = getFloatValue($char_data[UNIT_FIELD_RESISTANCEBUFFMODSNEGATIVE+$statIndex],0);
 $valueClass = "normStat";
 if      (abs($negBuff)>$posBuff) $valueClass = "negStat";
 else if (abs($negBuff)<$posBuff) $valueClass = "posStat";

 createHeader(getResistance($statIndex),$effective,$posBuff,$negBuff,$valueClass);
 echo "<TR><TD>";
 if ($statIndex==SCHOOL_ARMOR)
 {
	$levelModifier = $char_data[UNIT_FIELD_LEVEL];
	if ($levelModifier > 59 ) $levelModifier = $levelModifier + (4.5 * ($levelModifier-59));
	$armorReduction = 0.1*$effective/(8.5*$levelModifier + 40);
	$armorReduction = $armorReduction/(1+$armorReduction)*100;
	if ($armorReduction > 75) $armorReduction = 75;
	if ($armorReduction <  0) $armorReduction = 0;
    printf("Reduces Physical Damage taken by %0.2f%%",$armorReduction);
    $petBonus = ComputePetBonus(PET_BONUS_ARMOR, $effective, $class);
	if( $petBonus > 0 )
		printf("<br>Increases your pet`s Armor by %d", $petBonus);
    echo "</TD></TR>";
    createEndTable($valueClass, $effective) ;
 }
 else
 {
  $unitLevel = max($char_data[UNIT_FIELD_LEVEL],20);
  $magicResistanceNumber = $effective/$unitLevel;
  if     ($magicResistanceNumber > 5   ) $resistanceLevel = "Excellent";
  elseif ($magicResistanceNumber > 3.75) $resistanceLevel = "Very Good";
  elseif ($magicResistanceNumber > 2.5 ) $resistanceLevel = "Good";
  elseif ($magicResistanceNumber > 1.25) $resistanceLevel = "Fair";
  elseif ($magicResistanceNumber > 0   ) $resistanceLevel = "Poor";
  else                                   $resistanceLevel = "None";
  printf("Increases the ability to resist %s-based attacks, spells and abilities.<br />",getSchool($statIndex));
  printf("Resistance against level %d: %s",$unitLevel,$resistanceLevel);
  $petBonus = ComputePetBonus(PET_BONUS_RES,$effective,$class);
  if($petBonus > 0)
     printf("<br>Increases your pet`s Resistance by %d",$petBonus);
  echo "</TD></TR>";
  createEndTable($ResistType[$statIndex], $effective) ;
 }
}

//=========================================
// Stats panel
// Создаём тултип по одному из статов:
function renderStatRow($statIndex, $char_data)
{
 $rating = getRating($char_data[UNIT_FIELD_LEVEL]);
 $StatText = getStatTypeName($statIndex);
 $class = getClassId($char_data);
 $effectiveStat = $char_data[UNIT_FIELD_STAT0+$statIndex];
 $posBuff = getFloatValue($char_data[UNIT_FIELD_POSSTAT0+$statIndex],0);
 $negBuff = getFloatValue($char_data[UNIT_FIELD_NEGSTAT0+$statIndex],0);
 $stat = $effectiveStat-$posBuff-$negBuff;
 createHeader($StatText,$effectiveStat,$posBuff,$negBuff,"normStat");
 echo "<TR><TD>";
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
 echo "</TD></TR>";
 $valueClass = "normStat";
 if ($negBuff<0)      $valueClass = "negStat";
 else if ($posBuff>0) $valueClass = "posStat";
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
  $text =$text."<TR valign=center><TD width=1px><img src=images/player_info/characterframe/SpellSchoolIcon$i.gif></TD><TD>&nbsp;".getSchool($i)."</TD><TD align=right>$bonusDamage</TD></TR>";
 }
 echo "<TR><TD class=head colSpan=3>Bonus Damage $minModifier</TD></TR>";
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
    printf("<TR><TD colSpan=3>Your Shadow Damage increases your pet`s Attack Power by %d and Spell Damage by %d</TD></TR>",$petBonusAP,$petBonusDmg);
   else
    printf("<TR><TD colSpan=3>Your Fire Damage increases your pet`s<br>Attack Power by %d and<br>Spell Damage by %d</TD></TR>",$petBonusAP,$petBonusDmg);
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
 printf("<TR><TD class=head>Bonus Healing</TD></TR>");
 printf("<TR><TD>Increases your healing by up to %d</TD></TR>",$bonus);
 createEndTable("normStat", $bonus);
}

function renderSpellHit($char_data)
{
 $rating = getRating($char_data[UNIT_FIELD_LEVEL]);
 $valueRating = $char_data[PLAYER_FIELD_SPELL_HIT_RATING];
 $RatingPct   = $valueRating/GetRatingCoefficient($rating, CR_HIT_SPELL);
 createTopTable();
 printf ("<TR><TD class=head>Hit Rating %d</TD></TR>", $valueRating);
 printf ("<TR><TD>Increases your spell chance to hit a target of level %d by %.2f%%</TD></TR>", $char_data[UNIT_FIELD_LEVEL], $RatingPct);
 $penetration = $char_data[PLAYER_FIELD_MOD_TARGET_RESISTANCE];
 printf ("<TR><TD><br>Spell penetration %d (Reduces enemy resistances by %d)</TD></TR>", $penetration, -$penetration);
 createEndTable("normStat", $valueRating);
}
//=========================================
// Создаём тултип по спелл криту:
function renderSpellCrit($char_data)
{
 $rating = getRating($char_data[UNIT_FIELD_LEVEL]);
 $spellCritRating = $char_data[PLAYER_FIELD_SPELL_CRIT_RATING];
 $minCrit = getFloatValue($char_data[PLAYER_SPELL_CRIT_PERCENTAGE+1],2);
 $critRatingPct =  $spellCritRating/GetRatingCoefficient($rating, CR_CRIT_SPELL);
 createTopTable();
 printf ("<TR><TD class=head colSpan=3>Crit Rating %d (%.2f%%)</TD></TR>",$spellCritRating, $critRatingPct);
 for ($i=1;$i<7;$i++)
 {
  $crit = getFloatValue($char_data[PLAYER_SPELL_CRIT_PERCENTAGE+$i],2);
  $minCrit=min($minCrit,$crit);
  echo "<TR valign=center><TD width=1px><img src=images/player_info/characterframe/SpellSchoolIcon$i.gif></TD>";
  echo                   "<TD>&nbsp;".getSchool($i)."</TD><TD align=right width=80px>$crit%</TD></TR>";
 }
 createEndTable("normStat", $minCrit."%");
}

function renderSpellHaste($char_data)
{
 $rating = getRating($char_data[UNIT_FIELD_LEVEL]);
 $valueRating = $char_data[PLAYER_FIELD_SPELL_HASTE_RATING];
 $RatingPct   = $valueRating/GetRatingCoefficient($rating, CR_HASTE_SPELL);
 createTopTable();
 printf ("<TR><TD class=head>Haste rating %d</TD></TR>", $valueRating);
 printf ("<TR><TD>Increases the speed that you spell cast by %.2f%%</TD></TR>", $RatingPct);
 createEndTable("normStat", $valueRating);
}

function renderManaRegen($char_data)
{
 $value  = getFloatValue($char_data[UNIT_FIELD_POWER_REGEN_FLAT_MODIFIER],2)*5;
 $valueI = getFloatValue($char_data[UNIT_FIELD_POWER_REGEN_INTERRUPTED_FLAT_MODIFIER],2)*5;
 createTopTable();
 printf ("<TR><TD class=head>Mana Regen</TD></TR>");
 printf ("<TR><TD>%d mana regenerated every 5 seconds while not casting<br>%d mana regenerated every 5 seconds while casting</TD></TR>", $value, $valueI);
 createEndTable("normStat", $value);
}

// Render melee panel
function renderMeleeSkill($char_data)
{
 $rating = getRating($char_data[UNIT_FIELD_LEVEL]);
 $skillID = getSkillFromItemID($char_data[PLAYER_VISIBLE_ITEM_MAIN_HAND]);
 $skill   = getSkill($skillID,$char_data);
 $defRating = $char_data[PLAYER_FIELD_MELEE_WEAPON_SKILL_RATING];
 $RatingAdd = $defRating/GetRatingCoefficient($rating, CR_DEFENSE_SKILL);
 $Buff          = $skill[4]+$skill[5]+intval($RatingAdd);
 $effectiveStat = $skill[2]+$Buff;
 createTopTable();
 printf("<TR><TD class=head>Main hand %d</TD></TR>", $effectiveStat);
 printf("<TR><TD>Skill Rating %d (+%d Skill)</TD></TR>", $defRating, $RatingAdd);
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
 echo "<TR><TD class=head>Main Hand</TD></TR>";
 printf ("<TR><TD>Attack Speed (seconds):</TD><TD align=right>%.2f</TD></TR>", $speed);
 printf ("<TR><TD>Damage:</TD><TD align=right>%d - %d</TD></TR>", $minDamage, $maxDamage);
 printf ("<TR><TD>Damage per Second:</TD><TD align=right>%.2f</TD></TR>", $damagePerSecond);
 $skillID = getSkillFromItemID($char_data[PLAYER_VISIBLE_ITEM_OFF_HAND]);
 if ($skillID!=SKILL_UNARMED)
 {
  $minOffHandDamage = getFloatValue($char_data[UNIT_FIELD_MINOFFHANDDAMAGE],0);
  $maxOffHandDamage = getFloatValue($char_data[UNIT_FIELD_MAXOFFHANDDAMAGE],0);
  $offhand_speed    = getFloatValue($char_data[UNIT_FIELD_OFFHANDATTACKTIME],2)/1000;
  $Damage     = ($minOffHandDamage + $maxOffHandDamage) * 0.5;
  $offdamagePerSecond = (max($Damage,1) / $speed);
  echo "<TR><TD class=head>Off Hand</TD></TR>";
  printf ("<TR><TD>Attack Speed (seconds):</TD><TD align=right>%.2f</TD></TR>", $offhand_speed);
  printf ("<TR><TD>Damage:</TD><TD align=right>%d - %d</TD></TR>", $minOffHandDamage, $maxOffHandDamage);
  printf ("<TR><TD>Damage per Second:</TD><TD align=right>%.2f</TD></TR>", $offdamagePerSecond);
 }
 createEndTable("normStat", $minDamage." - ".$maxDamage);
}

function renderMeleeSpeed($char_data)
{
 $rating = getRating($char_data[UNIT_FIELD_LEVEL]);
 $main_speed = getFloatValue($char_data[UNIT_FIELD_BASEATTACKTIME],2)/1000;
 $offhand_speed = getFloatValue($char_data[UNIT_FIELD_OFFHANDATTACKTIME],2)/1000;
 $speed = round($main_speed,2);
 $skillID = getSkillFromItemID($char_data[PLAYER_VISIBLE_ITEM_OFF_HAND]);
 if ($skillID!=SKILL_UNARMED)
   $speed = $speed." / ". round($offhand_speed,2);
 $valueRating = $char_data[PLAYER_FIELD_MELEE_HASTE_RATING] ;
 $RatingPct   = $valueRating/GetRatingCoefficient($rating, CR_HASTE_RANGED);

 createTopTable();
 echo "<TR><TD class=head>Attack Speed $speed</TD></TR>";
 printf ("<TR><TD>Haste rating %d (%.2f%% haste)</TD></TR>", $valueRating, $RatingPct);
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
 createHeader("Attack Power",$stat,$posBuff,$negBuff,"normStat");
 printf ("<TR><TD>Increases damage with melee weapons by %.1f damage per second.</TD></TR>",max($stat, 0)/ATTACK_POWER_MAGIC_NUMBER);
 createEndTable($valueClass, $stat);
}

function renderMeleeHit($char_data)
{
 $rating = getRating($char_data[UNIT_FIELD_LEVEL]);
 $valueRating = $char_data[PLAYER_FIELD_MELEE_HIT_RATING];
 $RatingPct   = $valueRating/GetRatingCoefficient($rating, CR_HIT_MELEE);
 createTopTable();
 printf ("<TR><TD class=head>Hit Rating %d</TD></TR>", $valueRating);
 printf ("<TR><TD>Increases your melee chance to hit a target of level %d by %.2f%%</TD></TR>", $char_data[UNIT_FIELD_LEVEL], $RatingPct);
 $penetration = $char_data[PLAYER_FIELD_MOD_TARGET_PHYSICAL_RESISTANCE];
 printf ("<TR><TD><br>Enemy Armor reduced by %d</TD></TR>", $penetration);
 createEndTable("normStat", $valueRating);
}

function renderMeleeCrit($char_data)
{
 $rating = getRating($char_data[UNIT_FIELD_LEVEL]);
 $meleeCrit       = getFloatValue($char_data[PLAYER_CRIT_PERCENTAGE],2);
 $meleeCritRating = $char_data[PLAYER_FIELD_MELEE_CRIT_RATING];
 $critRatingPct   = $meleeCritRating/GetRatingCoefficient($rating, CR_CRIT_MELEE);
 createTopTable();
 printf ("<TR><TD class=head>Crit Chance %.2f%%</TD></TR>",$meleeCrit);
 printf ("<TR><TD>Crit Rating %d (%.2f%% crit chance)</TD></TR>", $meleeCritRating, $critRatingPct);
 createEndTable("normStat", $meleeCrit."%");
}
// =================================
// Render ranged panel
function renderRangedSkill($char_data)
{
 $rating = getRating($char_data[UNIT_FIELD_LEVEL]);
 $skillID = getSkillFromItemID($char_data[PLAYER_VISIBLE_ITEM_RANGED]);
 if ($skillID==SKILL_UNARMED)
 {
  createTopTable();
  printf("<TR><TD class=head>Ranged N/A</TD></TR>");
  createEndTable("normStat", "N/A");
  return;
 }
 $skill   = getSkill($skillID,$char_data);
 $defRating = $char_data[PLAYER_FIELD_MELEE_WEAPON_SKILL_RATING];
 $RatingAdd = $defRating/GetRatingCoefficient($rating, CR_DEFENSE_SKILL);
 $Buff          = $skill[4]+$skill[5]+intval($RatingAdd);
 $effectiveStat = $skill[2]+$Buff;
 createTopTable();
 printf("<TR><TD class=head>Main hand %d</TD></TR>", $effectiveStat);
 printf("<TR><TD>Skill Rating %d (+%d Skill)</TD></TR>", $defRating, $RatingAdd);
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
  echo "<TR><TD class=head>Ranged N/A</TD></TR>";
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
  echo "<TR><TD class=head>Ranged</TD></TR>";
  printf ("<TR><TD>Attack Speed (seconds):</TD><TD align=right>%.2f</TD></TR>", $speed);
  printf ("<TR><TD>Damage:</TD><TD align=right>%d - %d</TD></TR>", $minDamage, $maxDamage);
  printf ("<TR><TD>Damage per Second:</TD><TD align=right>%.2f</TD></TR>", $damagePerSecond);
  createEndTable("normStat", $minDamage." - ".$maxDamage);
 }
}
function renderRangedSpeed($char_data)
{
 $rating = getRating($char_data[UNIT_FIELD_LEVEL]);
 $skillID = getSkillFromItemID($char_data[PLAYER_VISIBLE_ITEM_RANGED]);
 if ($skillID==SKILL_UNARMED)
 {
  createTopTable();
  printf("<TR><TD class=head>Attack Speed N/A</TD></TR>");
  createEndTable("normStat", "N/A");
  return;
 }
 $range_speed = getFloatValue($char_data[UNIT_FIELD_RANGEDATTACKTIME],2)/1000;
 $valueRating = $char_data[PLAYER_FIELD_RANGED_HASTE_RATING] ;
 $RatingPct   = $valueRating/GetRatingCoefficient($rating, CR_HASTE_RANGED);
 createTopTable();
 printf ("<TR><TD class=head>Attack Speed %.2f</TD></TR>", $range_speed);
 printf ("<TR><TD>Haste rating %d (%.2f%% haste)</TD></TR>", $valueRating, $RatingPct);
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
 createHeader("Attack Power",$stat,$posBuff,$negBuff,"normStat");
 printf ("<TR><TD>Increases damage with ranged weapons by %.1f damage per second.</TD></TR>",max($stat, 0)/ATTACK_POWER_MAGIC_NUMBER);

 if ($petAp = ComputePetBonus(PET_BONUS_RAP_TO_AP, $stat, $class))
  printf ("<TR><TD>Increases your pet`s Attack Power by %d</TD></TR>", $petAp);
 if ($penSpellDamage = ComputePetBonus(PET_BONUS_RAP_TO_SPELLDMG, $stat, $class))
  printf ("<TR><TD>Increases your pet`s Spell Damage by %d</TD></TR>", $penSpellDamage);

 createEndTable($valueClass, $stat);
}

function renderRangedHit($char_data)
{
 $rating = getRating($char_data[UNIT_FIELD_LEVEL]);
 $valueRating = $char_data[PLAYER_FIELD_RANGED_HIT_RATING];
 $RatingPct   = $valueRating/GetRatingCoefficient($rating, CR_HIT_RANGED);
 createTopTable();
 printf ("<TR><TD class=head>Hit Rating %d</TD></TR>", $valueRating);
 printf ("<TR><TD>Increases your ranged chance to hit a target of level %d by %.2f%%</TD></TR>", $char_data[UNIT_FIELD_LEVEL], $RatingPct);
 $penetration = $char_data[PLAYER_FIELD_MOD_TARGET_PHYSICAL_RESISTANCE];
 printf ("<TR><TD><br>Enemy Armor reduced by %d</TD></TR>", $penetration);
 createEndTable("normStat", $valueRating);
}

function renderRangedCrit($char_data)
{
 $rating = getRating($char_data[UNIT_FIELD_LEVEL]);
 $rangedCrit       = getFloatValue($char_data[PLAYER_RANGED_CRIT_PERCENTAGE],2);
 $rangedCritRating = $char_data[PLAYER_FIELD_RANGED_CRIT_RATING];
 $critRatingPct    = $rangedCritRating/GetRatingCoefficient($rating, CR_CRIT_RANGED);
 createTopTable();
 printf ("<TR><TD class=head>Crit Chance %.2f%%</TD></TR>",$rangedCrit);
 printf ("<TR><TD>Crit Rating %d (%.2f%% crit chance)</TD></TR>", $rangedCritRating, $critRatingPct);
 createEndTable("normStat", $rangedCrit."%");
}
// ================================================
// Defense panel
//
function renderDefence($char_data)
{
 $rating = getRating($char_data[UNIT_FIELD_LEVEL]);
 $skill = getSkill(SKILL_DEFENCE,$char_data);

 $defRating = $char_data[PLAYER_FIELD_DEFENCE_RATING];
 $RatingAdd = $defRating/GetRatingCoefficient($rating, CR_DEFENSE_SKILL);
 $Buff          = $skill[4]+$skill[5]+intval($RatingAdd);
 $effectiveStat = $skill[2]+$Buff;

 $defensePercent = DODGE_PARRY_BLOCK_PERCENT_PER_DEFENSE * ($effectiveStat - $char_data[UNIT_FIELD_LEVEL]*5);
 $defensePercent = max($defensePercent, 0);
 createTopTable();
 printf("<TR><TD class=head>Defense %d</TD></TR>", $effectiveStat);
 printf("<TR><TD>Defense Rating %d (+%d Defense)<br>", $defRating, $RatingAdd);
 printf("Increases chance to Dodge, Block and Parry by %.2f%%<br>",$defensePercent);
 printf("Decreases chance to be hit and critically hit by %.2f%%</TD></TR>",$defensePercent);
 $valueClass = "normStat";
      if ($Buff<0) $valueClass = "negStat";
 else if ($Buff>0) $valueClass = "posStat";
 createEndTable($valueClass, $effectiveStat);
}

function renderDodge($char_data)
{
 $rating = getRating($char_data[UNIT_FIELD_LEVEL]);
 $value       = getFloatValue($char_data[PLAYER_DODGE_PERCENTAGE],2);
 $valueRating = $char_data[PLAYER_FIELD_DODGE_RATING];
 $RatingPct   = $valueRating/GetRatingCoefficient($rating, CR_DODGE);
 createTopTable();
 printf ("<TR><TD class=head>Dodge Chance %.2f%%</TD></TR>", $value);
 printf ("<TR><TD>Dodge rating of %d adds %.2f%% Dodge</TD></TR>",$valueRating, $RatingPct);
 createEndTable("normStat", $value."%");
}

function renderParry($char_data)
{
 $rating = getRating($char_data[UNIT_FIELD_LEVEL]);
 $value       = getFloatValue($char_data[PLAYER_PARRY_PERCENTAGE],2);
 $valueRating = $char_data[PLAYER_FIELD_PARRY_RATING];
 $RatingPct   = $valueRating/GetRatingCoefficient($rating, CR_PARRY);
 createTopTable();
 printf ("<TR><TD class=head>Parry Chance %.2f%%</TD></TR>", $value);
 printf ("<TR><TD>Parry rating of %d adds %.2f%% Parry</TD></TR>", $valueRating, $RatingPct);
 createEndTable("normStat", $value."%");
}

function renderBlock($char_data)
{
 $rating = getRating($char_data[UNIT_FIELD_LEVEL]);
 $value       = getFloatValue($char_data[PLAYER_BLOCK_PERCENTAGE],2);
 $valueRating = $char_data[PLAYER_FIELD_BLOCK_RATING];
 $RatingPct   = $valueRating/GetRatingCoefficient($rating, CR_BLOCK);
 $block_damage = $char_data[PLAYER_SHIELD_BLOCK];
 createTopTable();
 printf ("<TR><TD class=head>Block Chance %.2f%%</TD></TR>", $value);
 printf ("<TR><TD>Block rating of %d adds  Block</TD></TR>", $valueRating, $RatingPct);
 printf ("<TR><TD>You block stops %d damage</TD></TR>", $block_damage);
 createEndTable("normStat", $value."%");
}

function renderRecilence($char_data)
{
 $rating = getRating($char_data[UNIT_FIELD_LEVEL]);
 $melee  = $char_data[PLAYER_FIELD_CRIT_TAKEN_MELEE_RATING];
 $ranged = $char_data[PLAYER_FIELD_CRIT_TAKEN_RANGED_RATING];
 $spell  = $char_data[PLAYER_FIELD_CRIT_TAKEN_SPELL_RATING];
 $minResilience = min($melee, $ranged, $spell);
 createTopTable();
 printf("<TR><TD class=head>Resilience %d</TD></TR>", $minResilience);
 printf("<TR><TD>Melee Resilience %d (%.2f%%)</TD></TR>", $melee, $melee/GetRatingCoefficient($rating,CR_CRIT_TAKEN_MELEE));
 printf("<TR><TD>Ranged Resilience %d (%.2f%%)</TD></TR>", $ranged, $ranged/GetRatingCoefficient($rating,CR_CRIT_TAKEN_RANGED));
 printf("<TR><TD>Spell Resilience %d (%.2f%%)</TD></TR>", $spell, $spell/GetRatingCoefficient($rating,CR_CRIT_TAKEN_SPELL));
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
