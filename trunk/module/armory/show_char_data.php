<?php
//==============================================================================
// Скрипт для вывода поля Data игрока с названиями в режиме hex, int, float
//==============================================================================

function showPlayerData($char_data)
{
  global $gPlayerDataFields, $lang;
  echo "<TABLE class=report border=2><TBODY>";
  for ($i=0;$i<PLAYER_END;$i++)
  {
    if (!isset($char_data[$i]))
        break;
    echo "<TR>";
    $fname = @$gPlayerDataFields[$i];
    if (empty($fname)) $fname = $i;
    $float = unpack("f", pack("L",$char_data[$i]));
    echo "<TD>$i</TD>";
    echo "<TD class=left>$fname</TD>";
    echo "<TD>0x".dechex($char_data[$i])."</TD>";
    echo "<TD>$char_data[$i]</TD>";
    echo "<TD>".$float[1]."</TD>";
    echo "</TR>";
  }
  echo "</TBODY></TABLE>";
}
?>