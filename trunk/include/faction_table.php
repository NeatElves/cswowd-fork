<?php

function noBorderFactionTable($faction)
{
 global $game_text;
 $l = array("'", ";"  );
 $v = array("`", ",");
 $name    = str_replace($l, $v, $faction['name']);
 $details = str_replace($l, $v, $faction['details']);
 echo '<table class=factiontip cellSpacing=0>';
 echo '<tbody>';
 echo '<tr><td class=name>'.$name.'</td></tr>';
 if ($faction['team'])
   echo '<tr><td>'.str_replace($l, $v, getFactionName($faction['team'])).'</td></tr>';
 if ($details)
   echo '<tr><td>'.$details.'</td></tr>';
 echo '</tbody></table>';
}
function generateFactionTable($faction)
{
 echo "<table class=border cellSpacing=0 cellPadding=0><tbody>";
 echo "<tr><td class=btopl></td><td class=btop></td><td class=btopr></td></tr>";
 echo "<tr><td class=bl></td><td class=bbody>";
 noBorderFactionTable($faction);
 echo "</td><td class=br></td></tr>";
 echo "<tr><td class=bbottoml></td><td class=bbottom></td><td class=bbottomr></td></tr>";
 echo "</tbody></table>";
}
?>