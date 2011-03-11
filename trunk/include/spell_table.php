<?php
include_once("spell_data.php");

function noBorderSpellTable($spell)
{
 echo "<table class=spell><tbody>";
 $name = $spell['SpellName'];
 if ($spell['Rank'])
     echo "<tr><td class=Name>".$name."</td><td class=Rank align=right>".$spell['Rank']."</td></tr>";
 else
     echo "<tr><td class=Name colspan=2>".$name."</td></tr>";
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

 // ��������� ���� ������� �����
 $cast_time = "";
 if (($spell['Attributes'  ] & 0x404) == 0x404)
     $cast_time = "Next melee";
 else if ($spell['AttributesEx'] & 0x044)
     $cast_time = "Chanelled";
 else
     $cast_time = getCastTimeText($spell);

 // ��������� ���� ��������
 $cooldown = getSpellCooldown($spell);
 if ($cooldown)
   $cooldown = getTimeText($cooldown/1000)." cooldown";
 else
   $cooldown = "";

 if ($cast_time OR $cooldown)
     echo "<tr><td>".$cast_time."</td><td align=right>".$cooldown."</td></tr>";

 // ����� ���������
 if ($spell['TotemCategory_1'] OR $spell['TotemCategory_2'])
 {
     echo "<tr><td colspan=2 class=tool> Tools: ";
     if ($spell['TotemCategory_1'])
         echo getTotemCategory($spell['TotemCategory_1']);
     if ($spell['TotemCategory_2'])
         echo ", ".getTotemCategory($spell['TotemCategory_2']);
     echo "</td></tr>";
 }

 $itemClass = $spell['EquippedItemClass'];
 // ���������� ���� ��� ������ ������
 if ($spell['Attributes'] & 0x2)
     echo "<tr><td colspan=2>Requires Ranged Weapon</td></tr>";
 else if ($spell['Attributes'] & 0x4)
     echo "<tr><td colspan=2>Requires Melee Weapon</td></tr>";
 else if ($itemClass == 2)  // ������� ������
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
     echo "<tr><td colspan=2>Requires: ".$reqForm."</td></tr>";

 $notreqForm = getAllowableForm($spell['StancesNot'], 0);
 if ($notreqForm)
     echo "<tr><td class=SpellErr colspan=2>Not cast in: ".$notreqForm."</td></tr>";

 echo "<tr><td colspan=2 class=SpellDesc><a href=\"?spell=$spell[id]\">".getSpellDesc($spell)."</a></td></tr>";
 echo "</tbody></table>";
}

function generateSpellTable($spell)
{
 echo "<table class=border cellspacing=0 cellpadding=0><tbody>";
 echo "<tr><td class=btopl></td><td class=btop></td><td class=btopr></td></tr>";
 echo "<tr><td class=bl></td><td class=bbody>";
 noBorderSpellTable($spell);
 echo "</td><td class=br></td></tr>";
 echo "<tr><td class=bbottoml></td><td class=bbottom></td><td class=bbottomr></td></tr>";
 echo "</tbody></table>";
}

// ����� tooltip ������ (�� ��� ��������� � ��������� ���� �� ������)
function generateSpellBuffTable($spell)
{
 echo "<table class=border cellspacing=0 cellpadding=0><tbody>";
 echo "<tr><td class=btopl></td><td class=btop></td><td class=btopr></td></tr>";
 echo "<tr><td class=bl></td><td class=bbody>";

 echo "<table class=spell><tbody>";
 $name = $spell['SpellName'];
 echo "<tr><td class=Name>".$name."</td></tr>";
 echo "<tr><td colSpan=2 class=SpellDesc><a href=\"?spell=$spell[id]\">".getSpellBuff($spell)."</a></td></tr>";
 echo "</tbody></table>";

 echo "</td><td class=br></td></tr>";
 echo "<tr><td class=bbottoml></td><td class=bbottom></td><td class=bbottomr></td></tr>";
 echo "</tbody></table>";
}
?>