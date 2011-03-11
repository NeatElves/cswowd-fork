<?php

function noBorderFactionTable($faction)
{
 global $game_text;
 echo '<table class=factiontip cellspacing=0>';
 echo '<tbody>';
 echo '<tr><td class=name>'.$faction['name'].'</td></tr>';
 if ($faction['team'])
   echo '<tr><td>'.getFactionName($faction['team']).'</td></tr>';
 if ($faction['details'])
   echo '<tr><td>'.$faction['details'].'</td></tr>';
 echo '</tbody></table>';
}
function generateFactionTable($faction)
{
 echo "<table class=border cellspacing=0 cellpadding=0><tbody>";
 echo "<tr><td class=btopl></td><td class=btop></td><td class=btopr></td></tr>";
 echo "<tr><td class=bl></td><td class=bbody>";
 noBorderFactionTable($faction);
 echo "</td><td class=br></td></tr>";
 echo "<tr><td class=bbottoml></td><td class=bbottom></td><td class=bbottomr></td></tr>";
 echo "</tbody></table>";
}
?>