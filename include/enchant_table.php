<?php
include_once("functions.php");
include_once("spell_data.php");

function noBorderEnchantTable($enc)
{
 global $UseorEquip, $game_text;
 echo "<table class=spell><tbody>";
 echo "<tr><td class=Name>".$enc['description']."</td></tr>";
 // Вывод требования скила
 if ($enc['requiredSkill'])
    echo '<tr><td class=req>'.sprintf($game_text['req_skill'], getSkillName($enc['requiredSkill']), $enc['requiredSkillRank']).'</td></tr>';

 for ($i=1;$i<4;$i++)
 {
   if ($type   = $enc['display_type_'.$i])
   {
     $amount  = $enc['amount_'.$i];
     $spellid = $enc['spellid_'.$i];
     switch ($type)
     {
       case 1: // ITEM_ENCHANTMENT_TYPE_COMBAT_SPELL
           if ($spell = getSpell($spellid))
           {
               if ($desc = getSpellDesc($spell))
                   $text = $desc;
               else if ($buff = getSpellBuff($spell))
                   $text = $buff;
               else
                   $text = $spell['SpellName'];
               echo "<tr><td class=SpellEnch>".$UseorEquip[2]." <a href=\"?spell=$spellid\">".$text."</a></td></tr>";
           }
           else
               echo "<tr><td class=SpellEnch>".$UseorEquip[2]." cast ?? $spellid</td></tr>";
       break;
       case 2: // ITEM_ENCHANTMENT_TYPE_DAMAGE
           echo "<tr><td class=SpellEnch>+ $amount damage</td></tr>";
       break;
       case 3: // ITEM_ENCHANTMENT_TYPE_EQUIP_SPELL
           if ($spell = getSpell($spellid))
           {
               if ($desc = getSpellDesc($spell))
                   $text = $desc;
               else if ($buff = getSpellBuff($spell))
                   $text = $buff;
               else
                   $text = $spell['SpellName'];
               echo "<tr><td class=SpellEnch>".$UseorEquip[1]." <a href=\"?spell=$spellid\">".$text."</a></td></tr>";
           }
           else
               echo "<tr><td class=SpellDesc>".$UseorEquip[1]." cast ?? $spellid</td></tr>";
       break;
       case 4: // ITEM_ENCHANTMENT_TYPE_RESISTANCE
           echo "<tr><td> ".getResistanceText($spellid, $amount)."</td></tr>";
       break;
       case 5: // ITEM_ENCHANTMENT_TYPE_STAT
           if ($spellid >=0 && $spellid < 8)
               echo "<tr><td class=SpellEnch> ".getItemBonusText($spellid, $amount)."</td></tr>";
           else
               echo "<tr><td class=SpellEnch> ".getItemBonusText($spellid, $amount)."</td></tr>";
       break;
       case 6: // ITEM_ENCHANTMENT_TYPE_TOTEM
           echo "<tr><td class=SpellEnch>+ $amount damage (Rockbiter)</td></tr>";
       break;
       case 7: // On Use
           if ($spell = getSpell($spellid))
           {
               if ($desc = getSpellDesc($spell))
                   $text = $desc;
               else if ($buff = getSpellBuff($spell))
                   $text = $buff;
               else
                   $text = $spell['SpellName'];
               echo "<tr><td class=SpellEnch>".$UseorEquip[0]." <a href=\"?spell=$spellid\">".$text."</a></td></tr>";
           }
           else
               echo "<tr><td class=SpellDesc>".$UseorEquip[0]." cast ?? $spellid</td></tr>";
       break;
       case 8: // Add Sockets Enchant
           echo "<tr><td class=SpellEnch>Add Socket Enchant</td></tr>";
       break;
       default:
           echo "<tr><td>Err type $type</td></tr>";
       break;
     }
   }
 }
 echo "</tbody></table>";
}

function generateEnchantTable($enc)
{
 echo "<table class=border cellspacing=0 cellpadding=0><tbody>";
 echo "<tr><td class=btopl></td><td class=btop></td><td class=btopr></td></tr>";
 echo "<tr><td class=bl></td><td class=bbody>";
 noBorderEnchantTable($enc);
 echo "</td><td class=br></td></tr>";
 echo "<tr><td class=bbottoml></td><td class=bbottom></td><td class=bbottomr></td></tr>";
 echo "</tbody></table>";
}
?>