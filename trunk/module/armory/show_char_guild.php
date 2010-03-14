<?php
//==============================================================================
// Скрипт предназначен для вывода вещей гильд банка гильдии
//==============================================================================

define('GUILD_BANK_RIGHT_VIEW_TAB', 0x01);
define('GUILD_BANK_RIGHT_PUT_ITEM', 0x02);
define('GUILD_BANK_RIGHT_UPDATE_TEXT', 0x04);
define('GUILD_BANK_RIGHT_FULL', 0xFF);

define('GUILD_BANK_LOG_DEPOSIT_ITEM',  1);
define('GUILD_BANK_LOG_WITHDRAW_ITEM', 2);
define('GUILD_BANK_LOG_MOVE_ITEM',     3);
define('GUILD_BANK_LOG_DEPOSIT_MONEY', 4);
define('GUILD_BANK_LOG_WITHDRAW_MONEY',5);
define('GUILD_BANK_LOG_REPAIR_MONEY',  6);
define('GUILD_BANK_LOG_MOVE_ITEM2',    7);

// Гильд банк гильдии персонажа
function showPlayerGuild($guid, $char_data)
{
 global $cDB;
 // Получение разрешений на просмотр
 $currentTabRights = array(0x00, 0x00, 0x00, 0x00, 0x00, 0x00);
 $guildid = $char_data[PLAYER_GUILDID];
 $rank    = $char_data[PLAYER_GUILDRANK];
 if ($guildid == 0)
 {
   echo "Not in guild";
   return;
 }
 $gbrights = $cDB->select("SELECT * FROM `guild_bank_right` WHERE `guildid` = ?d AND `rid` = ?d", $guildid, $rank);
 foreach ($gbrights as $r)
   $currentTabRights[$r['TabId']]|=$r['gbright'];

 // Получаем данные о табах
 $tabinfo = $cDB->select(
 "SELECT
  `TabId` AS ARRAY_KEY,
  `TabName`,
  `TabIcon`,
  `TabText`
  FROM `guild_bank_tab`
  WHERE guildid = ?d
  ORDER BY `TabId`", $guildid);

 if ($tabinfo)
 {
   $bank_tabs = $cDB->select(
   "SELECT
    `TabId` AS ARRAY_KEY_1,
    `SlotId` AS ARRAY_KEY_2,
    `item_guid`,
    `item_entry`
    FROM `guild_bank_item`
    WHERE guildid = ?d
    ORDER BY `TabId`, `SlotId`",$guildid);
   // Скрипт смены табов в гильдбанке
   echo
   '<script type="text/javascript" id="guild_script">
     function showTab(tab){
      for(i=0;i<6;i++)
       if (div = document.getElementById("guildtab_" + i))
        div.style.visibility=(i==tab)?"visible":"hidden";
         return false;
     }
    </script>';

   // Отрисовываем гильд банк
   echo '<br><div id=guildbank style="color: #FFFFFF; position: relative; width: 765px; height: 424px;">';
   echo '<img src="images/player_info/bank/guildbank.gif" style="position: absolute; left: 0px; top: 0px;">';
   echo '<div style="position: absolute; left: 0px; top: 2px; width: 725px; text-align: center;"><b>Guild Bank</b></div>';
   $visible = "visible";
   foreach ($tabinfo as $tabid=>$tab)
   {
     // Проверяем права на просмотр
     if ($currentTabRights[$tabid]&GUILD_BANK_RIGHT_VIEW_TAB)
     {
       // Выводим новый таб
       echo '<div id=guildtab_'.$tabid.' style="visibility: '.$visible.';">';
       $visible = "hidden";
       if ($tabinfo)
         echo '<div style="position: absolute; left: 0px; top: 28px; width: 723px;"><b>'.$tab['TabName'].'</b></div>';
       // Вывод вещей в табе
       if(isset($bank_tabs[$tabid]))
       foreach ($bank_tabs[$tabid] as $slot=>$tabslot)
         show_item_by_guid($tabslot['item_guid'], "guildb", 49*(intval($slot/7))+23, 44*(intval($slot%7))+ 61);
       echo '</div>';
       // Иконка таба
       $img = 'images/icons/'.($tab['TabIcon']?strtolower($tab['TabIcon']):'wowunknownitem01').'.jpg';
       // Описание таба
       $tip = $tab['TabName']? addTooltip($tab['TabName']):'';
       echo '<a href=# onclick="return showTab('.$tabid.');">';
       echo '<img src="images/player_info/bank/guildbanktab.gif" style="position: absolute; left: 724px; top: '.(55 + $tabid*50).'px; border: 0px;">';
       echo '<img width=32px src="'.$img.'" '.$tip.' style="position: absolute; left: 727px; top: '.(66 + $tabid*50).'px;border: 0px;">';
       echo '</a>';
     }
     else
       echo '<img src="images/player_info/bank/guildbanktab.gif" '.addTooltip('no rights').' style"position: absolute; left: 724px; top: '.(55 + $tabid*50).'px; border: 0px;">';
   }
   echo '</div>';
 }
 else
   echo "No guild bank present";
}
?>
