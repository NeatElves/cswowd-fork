<?php

function noBorderTalentTable($talentTab, $rank)
{
 global $game_text;
 if ($rank) $spell = getSpell($talentTab["Rank_$rank"]);
 else       $spell = getSpell($talentTab["Rank_1"]);

 if ($spell)
 {
  $maxRank = 0;
       if ($talentTab["Rank_5"]) $maxRank = 5;
  else if ($talentTab["Rank_4"]) $maxRank = 4;
  else if ($talentTab["Rank_3"]) $maxRank = 3;
  else if ($talentTab["Rank_2"]) $maxRank = 2;
  else if ($talentTab["Rank_1"]) $maxRank = 1;

  echo "<TABLE class=spell><TBODY>";
  $name = $spell['SpellName'];
//  if ($spell['Rank']) $name .=" ($spell[Rank])";
  echo "<TR><TD class=Name>".$name."</TD></TR>";
  echo "<TR><TD>".$game_text['talent_rank']." $rank / $maxRank</TD></TR>";
  echo "<TR><TD class=Talent>".getSpellDesc($spell)."</TD></TR>";
  if ($rank!=0 && $rank!=$maxRank)
  {
   echo "<TR><TD><br>".$game_text['talent_next_rank']."</TD></TR>";
   $spell = getSpell($talentTab["Rank_".($rank+1)]);
   echo "<TR><TD class=Talent>".getSpellDesc($spell)."</TD></TR>";
  }
  echo "</TBODY></TABLE>";
 }
 else
 {
  echo "Talent error";
 }
}
function generateTalentTable($talentTab, $rank)
{
 echo "<table class=border cellSpacing=0 cellPadding=0><tbody>";
 echo "<tr><td class=btopl></td><td class=btop></td><td class=btopr></td></tr>";
 echo "<tr><td class=bl></td><td class=bbody>";
 noBorderTalentTable($talentTab, $rank);
 echo "</td><td class=br></td></tr>";
 echo "<tr><td class=bbottoml></td><td class=bbottom></td><td class=bbottomr></td></tr>";
 echo "</tbody></table>";
}
?>