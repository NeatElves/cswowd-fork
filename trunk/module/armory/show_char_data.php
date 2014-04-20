<?php
//==============================================================================
// Скрипт для вывода поля Data игрока с названиями в режиме hex, int, float
//==============================================================================

function showPlayerData($char_data)
{
  global $gPlayerDataFields, $lang;
  echo "<table class=report border=2><tbody>";
  for ($i=0;$i<PLAYER_END;$i++)
  {
    if (!isset($char_data[$i]))
        break;
    echo "<tr>";
    $fname = @$gPlayerDataFields[$i];
    if (empty($fname)) $fname = $i;
    $float = unpack("f", pack("L",$char_data[$i]));
    echo "<td>$i</td>";
    echo "<td class=left>$fname</td>";
    echo "<td>0x".dechex($char_data[$i])."</td>";
    echo "<td>$char_data[$i]</td>";
    echo "<td>".$float[1]."</td>";
    echo "</tr>";
  }
  echo "</tbody></table>";
}
?>