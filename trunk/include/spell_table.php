<?php
include_once("spell_data.php");

function noBorderSpellTable($spell)
{
 echo "<TABLE class=spell><TBODY>";
 $name = validateText($spell['SpellName']);
 if ($spell['Rank'])
     echo "<TR><TD class=Name>".$name."</TD><TD class=Rank align=right>".$spell['Rank']."</TD></TR>";
 else
     echo "<TR><TD class=Name colSpan=2>".$name."</TD></TR>";
 $cost = getSpellCostText($spell);
 if ($cost or $spell['rangeIndex']>1)
 {
  echo "<tr><td>";
  if ($cost)
      echo $cost."</td><td align=right>";
  if ($spell['rangeIndex'] > 0 AND $range = getRange($spell['rangeIndex']) AND $range!=0)
      echo $range." yds range";
  echo "</td></tr>";
 }

 // Заполняем поле времени каста
 $cast_time = "";
 if (($spell['Attributes'  ] & 0x404) == 0x404)
     $cast_time = "Next melee";
 else if ($spell['AttributesEx'] & 0x044)
     $cast_time = "Chanelled";
 else
     $cast_time = getCastTimeText($spell);

 // Заполняем поле кулдауна
 $cooldown = getSpellCooldown($spell);
 if ($cooldown)
   $cooldown = getTimeText($cooldown/1000)." cooldown";
 else
   $cooldown = "";

 if ($cast_time OR $cooldown)
     echo "<TR><TD>".$cast_time."</TD><TD align=right>".$cooldown."</TD></TR>";

 // Тотем категория
 if ($spell['TotemCategory_1'] OR $spell['TotemCategory_2'])
 {
     echo "<TR><TD colspan=2 class=tool> Tools: ";
     if ($spell['TotemCategory_1'])
         echo getTotemCategory($spell['TotemCategory_1']);
     if ($spell['TotemCategory_2'])
         echo ", ".getTotemCategory($spell['TotemCategory_2']);
     echo "</TD></TR>";
 }

 $itemClass = $spell['EquippedItemClass'];
 // Требования мили или рангед оружия
 if ($spell['Attributes'] & 0x2)
     echo "<TR><TD colSpan=2>Requires Ranged Weapon</TD></TR>";
 else if ($spell['Attributes'] & 0x4)
     echo "<TR><TD colSpan=2>Requires Melee Weapon</TD></TR>";
 else if ($itemClass == 2)  // Требует оружия
 {
     echo "<tr><td colSpan=2 class=req>";
     if ($itemSubClass = $spell['EquippedItemSubClassMask'])
         echo getSubclassList($itemClass, $itemSubClass);
     else
         echo getClassName($itemClass);
     echo "</td></tr>";
 }
 $reqForm = getAllowableForm($spell['Stances'], 0);
 if ($reqForm)
     echo "<TR><TD colSpan=2>Requires: ".$reqForm."</TD></TR>";

 $notreqForm = getAllowableForm($spell['StancesNot'], 0);
 if ($notreqForm)
     echo "<TR><TD class=SpellErr colSpan=2>Not cast in: ".$notreqForm."</TD></TR>";

 echo "<TR><TD colSpan=2 class=SpellDesc><a href=\"?spell=$spell[id]\">".getSpellDesc($spell)."</a></TD></TR>";
 echo "</TBODY></TABLE>";
}

function generateSpellTable($spell)
{
 echo "<table class=border cellSpacing=0 cellPadding=0><tbody>";
 echo "<tr><td class=btopl></td><td class=btop></td><td class=btopr></td></tr>";
 echo "<tr><td class=bl></td><td class=bbody>";
 noBorderSpellTable($spell);
 echo "</td><td class=br></td></tr>";
 echo "<tr><td class=bbottoml></td><td class=bbottom></td><td class=bbottomr></td></tr>";
 echo "</tbody></table>";
}

// Вывод tooltip спелла (то что выводится в подсказке ауры на игроке)
function generateSpellBuffTable($spell)
{
 echo "<table class=border cellSpacing=0 cellPadding=0><tbody>";
 echo "<tr><td class=btopl></td><td class=btop></td><td class=btopr></td></tr>";
 echo "<tr><td class=bl></td><td class=bbody>";

 echo "<table class=spell><tbody>";
 $name = validateText($spell['SpellName']);
 echo "<tr><td class=Name>".$name."</td></tr>";
 echo "<tr><td colSpan=2 class=SpellDesc><a href=\"?spell=$spell[id]\">".getSpellBuff($spell)."</a></td></tr>";
 echo "</tbody></table>";

 echo "</td><td class=br></td></tr>";
 echo "<tr><td class=bbottoml></td><td class=bbottom></td><td class=bbottomr></td></tr>";
 echo "</tbody></table>";
}
?>