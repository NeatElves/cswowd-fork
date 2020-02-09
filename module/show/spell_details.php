<?php
// Create aura info string
function showAuraInfo($spell, $effect, $aura)
{
  global $gSpellEffect, $gSpellAuraName;
  if ($aura == 0)
     return;
  echo ': '.getSpellAuraName($aura);
  $misc = $spell['EffectMiscValue'.$effect];
  $miscB= $spell['EffectMiscValueB'.$effect];
  switch ($aura)
  {
   // Misc - это школа спеллов
   case  10: // SPELL_AURA_MOD_THREAT
   case  13: // SPELL_AURA_MOD_DAMAGE_DONE
   case  14: // SPELL_AURA_MOD_DAMAGE_TAKEN
   case  39: // SPELL_AURA_SCHOOL_IMMUNITY
   case  40: // SPELL_AURA_DAMAGE_IMMUNITY
   case  69: // SPELL_AURA_SCHOOL_ABSORB
   case  71: // SPELL_AURA_MOD_SPELL_CRIT_CHANCE_SCHOOL
   case  72: // SPELL_AURA_MOD_POWER_COST_SCHOOL_PCT
   case  73: // SPELL_AURA_MOD_POWER_COST_SCHOOL
   case  74: // SPELL_AURA_REFLECT_SPELLS_SCHOOL
   case  79: // SPELL_AURA_MOD_DAMAGE_PERCENT_DONE
   case  81: // SPELL_AURA_SPLIT_DAMAGE_PCT
   case  83: // SPELL_AURA_MOD_BASE_RESISTANCE
   case  87: // SPELL_AURA_MOD_DAMAGE_PERCENT_TAKEN
   case  97: // SPELL_AURA_MANA_SHIELD
   case 115: // SPELL_AURA_MOD_HEALING
   case 118: // SPELL_AURA_MOD_HEALING_PCT
   case 135: // SPELL_AURA_MOD_HEALING_DONE
   case 136: // SPELL_AURA_MOD_HEALING_DONE_PERCENT
   case 149: // SPELL_AURA_RESIST_PUSHBACK
   case 153: // SPELL_AURA_SPLIT_DAMAGE_FLAT
   case 163: // SPELL_AURA_MOD_CRIT_DAMAGE_BONUS_MELEE
   case 174: // SPELL_AURA_MOD_SPELL_DAMAGE_OF_STAT_PERCENT
   case 179: // SPELL_AURA_MOD_ATTACKER_SPELL_CRIT_CHANCE
   case 183: // SPELL_AURA_MOD_CRITICAL_THREAT
   case 186: // SPELL_AURA_MOD_ATTACKER_SPELL_HIT_CHANCE
   case 199: // SPELL_AURA_MOD_INCREASES_SPELL_PCT_TO_HIT
   case 205:
   case 216: // SPELL_AURA_HASTE_SPELLS
   case 229:
   case 237: // SPELL_AURA_MOD_SPELL_DAMAGE_OF_ATTACK_POWER
   case 238: // SPELL_AURA_MOD_SPELL_HEALING_OF_ATTACK_POWER
   case 259:
   {
       if ($misc == 127 || $misc == 0) echo ' (All schools)';
       else if ($misc == 126)          echo ' (All magic)';
       else if ($misc == 1)            echo ' (Physical)';
       else                            echo ' (School: '.getSpellSchool($misc).')';
       break;
   }
   case  22: // SPELL_AURA_MOD_RESISTANCE
   case 101: // SPELL_AURA_MOD_RESISTANCE_PCT
   case 123: // SPELL_AURA_MOD_TARGET_RESISTANCE
   case 142: // SPELL_AURA_MOD_BASE_RESISTANCE_PCT
   case 143: // SPELL_AURA_MOD_RESISTANCE_EXCLUSIVE
   case 182: // SPELL_AURA_MOD_RESISTANCE_OF_INTELLECT_PERCENT
   {
            if ($misc == 126) echo ' (All magic)';
       else if ($misc == 1)   echo ' (Armor)';
       else                   echo ' (School: '.getSpellSchool($misc).')';
       break;
   }
   // Misc - тип энергии
   case  24: // SPELL_AURA_PERIODIC_ENERGIZE
   case  35: // SPELL_AURA_MOD_INCREASE_ENERGY
   case  63: // SPELL_AURA_PERIODIC_POWER_FUNNEL
   case  64: // SPELL_AURA_PERIODIC_POWER_LEECH
   case  85: // SPELL_AURA_MOD_POWER_REGEN
   case 110: // SPELL_AURA_MOD_POWER_REGEN_PERCENT
   case 162: // SPELL_AURA_POWER_BURN_MANA
   {
       echo ' ('.getPowerTypeName($misc).')';
       break;
   }
   // Misc - тип модификатора
   case 107: // SPELL_AURA_ADD_FLAT_MODIFIER
   case 108: // SPELL_AURA_ADD_PCT_MODIFIER
   {
       echo ' ('.getSpellModName($misc).')';
       break;
   }
   // Misc - тип юнита
   case 44: // SPELL_AURA_TRACK_CREATURES
   {
       echo ' ('.getCreatureType($misc).')';
       break;
   }
   // Misc - тип lock
   case 45: // SPELL_AURA_TRACK_RESOURCES
   {
       echo ' ('.getLockType($misc, 2).')';
       break;
   }
   // Misc - маска типа юнита
   case  59: // SPELL_AURA_MOD_DAMAGE_DONE_CREATURE
   case 102: // SPELL_AURA_MOD_MELEE_ATTACK_POWER_VERSUS
   case 131: // SPELL_AURA_MOD_RANGED_ATTACK_POWER_VERSUS
   case 168: // SPELL_AURA_MOD_DAMAGE_DONE_VERSUS
   case 169: // SPELL_AURA_MOD_CRIT_PERCENT_VERSUS
   case 180: // SPELL_AURA_MOD_SPELL_DAMAGE_VS_UNDEAD
   {
       echo ' ('.getCreatureTypeList($misc).')';
       break;
   }
   // Misc - тип стата
   case  29: // SPELL_AURA_MOD_STAT
   case  80: // SPELL_AURA_MOD_PERCENT_STAT
   case 137: // SPELL_AURA_MOD_TOTAL_STAT_PERCENTAGE
   case 175: // SPELL_AURA_MOD_SPELL_HEALING_OF_STAT_PERCENT
   case 212: // SPELL_AURA_MOD_RANGED_ATTACK_POWER_OF_STAT_PERCENT
   case 219: // SPELL_AURA_MOD_MANA_REGEN_OF_STAT
   case 268: // SPELL_AURA_MOD_ATTACK_POWER_OF_STAT_PERCENT
   {
       echo ' ('.getStatTypeName($misc).')';
       break;
   }
   // Misc - тип скила
   case 30: // SPELL_AURA_MOD_SKILL
   case 98: // SPELL_AURA_MOD_SKILL_TALENT
   {
       echo ' ('.getSkillName($misc).')';
       break;
   }
   // Misc - тип формы
   case 36: // SPELL_AURA_MOD_SHAPESHIFT
   {
       echo ' ('.getForm($misc).')';
       break;
   }
   // Misc - тип рейтинга
   case 189: // SPELL_AURA_MOD_RATING
   case 220: // SPELL_AURA_MOD_RATING_FROM_STAT
   {
       echo ' ('.getRatingList($misc).')';
       break;
   }
   // Misc - тип эффекта
   case 37: // SPELL_AURA_EFFECT_IMMUNITY
   {
       echo ' ('.$gSpellEffect[$misc].')';
       break;
   }
   // Misc - тип ауры
   case 38: // SPELL_AURA_STATE_IMMUNITY
   {
       echo ' ('.$gSpellAuraName[$misc].')';
       break;
   }
   // Misc - тип диспелла
   case  41: // SPELL_AURA_DISPEL_IMMUNITY
   case 178: // SPELL_AURA_MOD_DEBUFF_RESISTANCE
   {
       echo ' ('.getDispelName(abs($misc)).')';
       break;
   }
   // Misc - тип механики
   case  77: // SPELL_AURA_MECHANIC_IMMUNITY
   case 117: // SPELL_AURA_MOD_MECHANIC_RESISTANCE
   case 232: // SPELL_AURA_MECHANIC_DURATION_MOD
   case 234: // SPELL_AURA_MECHANIC_DURATION_MOD_NOT_STACK
   case 255: // SPELL_AURA_MOD_MECHANIC_DAMAGE_TAKEN_PERCENT
   {
       echo ' ('.getMechanicName($misc).')';
       break;
   }
   case  56: // SPELL_AURA_TRANSFORM
   case  78: // SPELL_AURA_MOUNTED
   {
       echo ' ('.getCreatureName($misc).')';
       break;
   }
   case 190: // SPELL_AURA_MOD_FACTION_REPUTATION_GAIN
   {
       echo ' ('.getFactionName($misc).')';
       break;
   }
   case 249: // SPELL_AURA_CONVERT_RUNE
   {
       echo ' ('.getRuneName($misc).' => '.getRuneName($miscB).')';
       break;
   }
   default:
   if ($misc || $miscB)
       echo ' ('.$misc.($miscB ? ', '.$miscB : '').')';
   break;
  }
}

function showEffectInfo($spell, $effect, $eff_id)
{
  global $lang;
  $misc = $spell['EffectMiscValue'.$effect];
  switch ($eff_id)
  {
   // школа
   case  2: // SCHOOL_DAMAGE
   {
       echo ' ('.getSpellSchool($spell['SchoolMask']).')';
       break;
   }
   // Misc - тип энергии
   case  8: // SPELL_EFFECT_POWER_DRAIN
   case 30: // SPELL_EFFECT_ENERGIZE
   case 62: // SPELL_EFFECT_POWER_BURN
   {
       echo ' ('.getPowerTypeName($misc).')';
       break;
   }
   case  16: // SPELL_EFFECT_QUEST_COMPLETE
   case 147: // SPELL_EFFECT_QUEST_FAIL
   case 139: // SPELL_EFFECT_CLEAR_QUEST
   {
      echo ' ('.getQuestName($misc).')';
      break;
   }
   case  28: // SPELL_EFFECT_SUMMON
   case  56: // SPELL_EFFECT_SUMMON_PET
   case  90: // Kill Credit
   case 134: // Kill Credit

   {
      echo ' ('.getCreatureName($misc).')';
      break;
   }
   case  50: // SPELL_EFFECT_SUMMON_OBJECT
   case  76: // SPELL_EFFECT_SUMMON_OBJECT_WILD
   case 104:
   case 105:
   case 106:
   case 107:
   {
      echo ' ('.getGameobjectName($misc).')';
      break;
   }
   case 53: // SPELL_EFFECT_ENCHANT_ITEM
   case 54: // SPELL_EFFECT_ENCHANT_ITEM_TEMPORARY
   case 92: // SPELL_EFFECT_ENCHANT_HELD_ITEM
   {
      echo ' ('.getEnchantmentDesc($misc).')';
      break;
   }
   case 39: // SPELL_EFFECT_LANGUAGE
   {
       echo ' ('.getLaungageName($misc).')';
       break;
   }
   case  44: // SPELL_EFFECT_SKILL_STEP
   case 118: // SPELL_EFFECT_SKILL
   {
       echo ' ('.getSkillName($misc).')';
       break;
   }
   // Misc - тип рейтинга
   case 189: // SPELL_AURA_MOD_RATING
   {
       echo ' ('.getRatingList($misc).')';
       break;
   }
   // Misc - тип диспелла
   case  38: // SPELL_EFFECT_DISPEL
   case 126: // SPELL_EFFECT_STEAL_BENEFICIAL_BUFF
   {
       echo ' ('.getDispelName(abs($misc)).')';
       break;
   }
   // Misc - тип механики
   case 108: // SPELL_EFFECT_DISPEL_MECHANIC
   {
       echo ' ('.getMechanicName($misc).')';
       break;
   }
   case  94: // SPELL_EFFECT_SELF_RESURRECT
   case 113: // SPELL_EFFECT_RESURRECT_NEW
   {
       echo ' (Restore '.$misc.' power)';
       break;
   }
   case 103: // SPELL_EFFECT_REPUTATION
   {
       echo ' ('.getFactionName($misc).')';
       break;
   }
   case 33:  // SPELL_EFFECT_OPEN_LOCK
   {
       echo ' ('.getLockType($misc, 2).')';
       break;
   }
   case 146: // SPELL_EFFECT_ACTIVATE_RUNE
   {
       echo ' ('.getRuneName($misc).')';
       break;
   }
   case 74: // SPELL_EFFECT_APPLY_GLYPH
   {
       echo ' ('.getGlyphName($misc).')';
       break;
   }
   default:
   if ($misc)
       echo ' ('.$misc.')';
   break;
  }
  if ($effect==1)
  {
    // Spell target position on map
    if ($t = getSpellTargetPosition($spell['id']))
      echo '<a style="float: right;" href="?map&point='.$t['target_map'].':'.$t['target_position_x'].':'.$t['target_position_y'].':'.$t['target_position_z'].'">'.$lang['map'].'</a>';
    // Spell target
	if ($s = getSpellScriptTarget($spell['id']))
    foreach ($s as $s1)
    {
      if ($s1['type']==0) echo '<br><a style="float: right;" href="?object='.$s1['targetEntry'].'">'.getGameobjectName($s1['targetEntry'],0).'</a>';
        else if ($s1['type']==1) echo '<br><a style="float: right;" href="?npc='.$s1['targetEntry'].'">'.getCreatureName($s1['targetEntry'],0).'</a>';
          else if ($s1['type']==2) echo '<br><a style="float: right;" href="?npc='.$s1['targetEntry'].'">'.getCreatureName($s1['targetEntry'],0).'</a>';
    }
  }
}

function showEffectData($spell, $effect)
{
  echo '<tr>';
  echo '<th>Effect '.($effect-1).':</th>';
  echo '<td colspan=3>';

  if ($spell['Effect'.$effect]==0)
  {
      echo 'No Effect';
      return;
  }
  else
  {
      $eff_id    = $spell['Effect'.$effect];
      $aura      = $spell['EffectApplyAuraName'.$effect];
      $itemId    = $spell['EffectItemType'.$effect];
      $triggerId = $spell['EffectTriggerSpell'.$effect];
      $radius    = $spell['EffectRadiusIndex'.$effect];
      $amount    = getBasePointDesc($spell, $effect);
      if ($aura == 107 OR $aura == 108 OR $aura == 109 OR $aura == 112)
      {
          $spellFamilyMask = $itemId;
          $itemId = 0;
      }

      echo "($eff_id) ".getSpellEffectName($eff_id);
      if ($aura)
          showAuraInfo($spell, $effect, $aura);
      else
          showEffectInfo($spell, $effect, $eff_id);

      if ($spell['EffectAmplitude'.$effect])
         echo '<br>Interval: '.($spell['EffectAmplitude'.$effect]/1000).' sec';
      // Спелл
      if ($triggerId)
      {
          $trigger = getSpell($triggerId);
          if ($trigger)
          {
             echo '<table class=no_border><tbody><tr>';
             echo '<td>';
             show_spell($trigger['id'], $trigger['SpellIconID'], 'spellinfo');
             echo '</td>';
             echo '<td><a href="?spell='.$trigger['id'].'">'.$trigger['SpellName'].'</a><br>Value: '.$amount.'</td>';
             echo '</tr></tbody></table>';
          }
          else
              echo '<br>Err trigger spell id '.$triggerId;
      }
      // Вещь
      else if ($itemId)
      {
          $item = getItem($itemId);
          if ($item)
          {
             global $Quality;
             $colorname = $item['Quality'];
             echo "<table class=no_border><tbody><tr>";
             echo "<td>";show_item($item['entry'], $item['displayid'], 'spellinfo');echo "</td>";
             echo "<td><a class=$Quality[$colorname] href=\"?item=$item[entry]\">$item[name]</a>";
             if ($amount > 1)
                 echo " x".$amount;
             echo "</td>";
             echo "</tr></tbody></table>";
          }
          else
             echo "<br>Err item id ".$itemId;
      }
      else
      {
        if ($radius)
           echo "<br>Radius: ".getRadiusText($radius);
        if ($amount != 0)
           echo "<br>Value: ".$amount;
      }
  }
  echo "</td>";
  echo "</tr>";
}

//********************************************************************************
// Детальная информация
//********************************************************************************
function createSpellDetails($spell)
{
   global $lang;
   echo '<table class=details width=600><tbody>';
   echo '<tr><td colspan=4 class=head>'.$lang['detail_info'].'</td></tr>';
   echo '<tr><th>Name</th><td colspan=2>'.$spell['SpellName'].'</td><td align=right>'.$spell['Rank1'].'</td></tr>';

   if ($spell['Description'])
      echo '<tr><th width=60>Info:</th><td colspan=3>'.getSpellDesc($spell).'</td></tr>';

   if ($spell['ToolTip'])
      echo '<tr><th>Buff:</th><td colspan=3>'.getSpellBuff($spell).'</td></tr>';
   // Стоимость и длительность
   $cost = getSpellCostText($spell);
   $duration = getSpellDurationText($spell);
   if ($cost OR $duration)
      echo '<tr><th>Cost</th><td>'.($cost?$cost:'No Cost').'</td><th>Duration</th><td>'.$duration.'</td></tr>';

   echo '<tr>';
   echo '<th width=13%>Level</th>';
   echo '<td width=37%>Base '.$spell['BaseLevel'].', Max '.$spell['MaxLevel'].', Spell '.$spell['SpellLevel'].'</td>';
   echo '<th width=20%>Range</th>';
   echo '<td width=30%>'.getRangeText($spell['RangeIndex']).'</td>';
   echo '</tr>';

   // Время квста и школа (выводятся всегда)
   echo '<tr><th>Cast time</th><td>'.getCastTimeText($spell).'</td><th>School</th><td>'.getSpellSchool($spell['SchoolMask']).'</td></tr>';

   $skillAbility = getSkillLineAbility($spell['id']);
   if ($skillAbility OR $spell['Category'])
   {
    echo '<tr>';
    echo '<th>Skill</th>';
    if ($skillAbility)
      echo '<td>'.getSkillName($skillAbility['skillId']).'</td>';
    else
      echo '<td>n/a</td>';

    echo '<th>Category</th>';
    if ($spell['Category'])
      echo '<td>'.getCategoryName($spell['Category']).'</td>';
    else
      echo '<td>n/a</td>';
    echo '</tr>';
   }
   // Вывод механики и диспелла
   if ($spell['Mechanic'] OR $spell['Dispel'])
   {
     echo '<tr>';
     echo '<th>Mechanic</th><td>'.getMechanicName($spell['Mechanic']).'</td>';
     echo '<th>Dispel type</th><td>'.getDispelName($spell['Dispel']).'</td>';
     echo '</tr>';
   }
   // Вывод кулдаунов
   $cooldown = getSpellCooldown($spell);
   if ($cooldown OR $spell['StartRecoveryCategory'] OR $spell['StartRecoveryTime'])
   {
     echo '<tr>';
     echo '<th>Cooldown</th>';
     if ($cooldown)
        echo '<td>'.getTimeText($cooldown/1000).'</td>';
     else
        echo '<td>No cooldown</td>';

     echo '<th>Global cooldown</th>';
     if ($spell['StartRecoveryCategory'] OR $spell['StartRecoveryTime'])
     {
        echo '<td>';
        echo 'Affected';
        if ($spell['StartRecoveryTime'])
            echo ', '.getTimeText($spell['StartRecoveryTime']/1000);
        else
            echo ', Not start';
        echo '</td>';
     }
     else
        echo '<td>n/a</td>';
     echo '</tr>';
   }
   // Вывод требований форм
   $stances    = $spell['Stances'];
   $stancesNot = $spell['StancesNot'];
   if ($stances OR $stancesNot)
   {
     echo '<tr>';
     echo '<th>Req form</th>';
     if ($stances)
        echo '<td>'.getAllowableForm($stances).'</td>';
     else
        echo '<td>n/a</td>';

     echo '<th>Not in form</th>';
     if ($stancesNot)
        echo '<td>'.getAllowableForm($stancesNot).'</td>';

     else
        echo '<td>n/a</td>';
     echo '</tr>';
   }
   // Вывод требований одетого снаряжения
   $itemClass = $spell['EquippedItemClass'];
   $itemSubClass = $spell['EquippedItemSubClassMask'];
   $inventoryTypeMask = $spell['EquippedItemInventoryTypeMask'];
   if ($itemClass >= 0 OR $inventoryTypeMask)
   {
     echo '<tr>';
     echo '<th>Req item</th>';
     if ($itemClass >=0)
     {
        echo '<td>';
        if ($itemSubClass)
          echo getClassName($itemClass,0).': '.getSubclassList($itemClass, $itemSubClass);
        else
          echo getClassName($itemClass);
        echo '</td>';
     }
     else
        echo '<td>n/a</td>';
     echo '<th>Inv type</th>';
     if ($inventoryTypeMask)
        echo '<td>'.getInventoryTypeList($inventoryTypeMask).'</td>';
     else
        echo '<td>n/a</td>';
    echo '</tr>';
   }
   // Вывод тотм категорий и спеллфокуса
   $totem1=$spell['TotemCategory1'];
   $totem2=$spell['TotemCategory2'];
   $focus =$spell['RequiresSpellFocus'];
   if ($totem1 OR $totem2 OR $focus)
   {
     echo '<tr>';
     echo '<th>Tools</th>';
     if ($totem1 OR $totem2)
     {
        echo '<td>';
        if ($totem1) echo getTotemCategory($totem1);
        if ($totem2) echo ', '.getTotemCategory($totem2);
        echo '</td>';
     }
     else
        echo '<td>n/a</td>';
     echo '<th>Spell Focus</th>';
     if ($focus)
        echo '<td>'.getSpellFocusName($focus, 2).'</td>';
     else
        echo '<td>n/a</td>';
     echo '</tr>';
   }
   $area=$spell['AreaId'];
   if ($area)
   {
     echo '<tr>';
     echo '<th>Area</th>';
     if ($area)
         echo '<td>'.$area.'</td>';
     else
         echo '<td>n/a</td>';
     echo '</tr>';
   }
   // Вывод требований целей
   $targets    = $spell['Targets'];
   $targetCreature = $spell['TargetCreatureType'];
   if ($targets OR $targetCreature)
   {
     echo '<tr>';
     echo '<th>Targets</th>';
     if ($targets)
        echo '<td>'.getTargetsList($targets).'</td>';
     else
        echo '<td>n/a</td>';
     echo '<th>Creature type</th>';
     if ($targetCreature)
        echo '<td>'.getCreatureTypeList($targetCreature).'</td>';
     else
         echo '<td>n/a</td>';
     echo '</tr>';
   }
   if ($spell['Reagent1'] OR $spell['Reagent2'] OR $spell['Reagent3'] OR $spell['Reagent4'] OR
       $spell['Reagent5'] OR $spell['Reagent6'] OR $spell['Reagent7'] OR $spell['Reagent8'])
   {
     echo '<tr>';
     echo '<th>Reagents</th>';
     echo '<td colspan=3>'; r_spellReagents($spell); echo '</td>';
     echo '</tr>';
   }
   // Вывод эффектов
   showEffectData($spell, 1);
   showEffectData($spell, 2);
   showEffectData($spell, 3);
   echo '</tbody></table>';
}
?>