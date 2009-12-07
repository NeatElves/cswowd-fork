<?php
include_once("include/functions.php");

$guildid = intval(@$_REQUEST['guild']);
$page    = intval(@$_REQUEST['page']);
$sort    = @$_REQUEST['sort'];
if ($guildid)
{
  $FindRefrence = "?guild=$guildid";

  $guild = getGuild($guildid);
  if ($guild)
  {
    // Получаем названия рангов в гильдии
    $rank  = getGuildRankList($guildid);
    // Получаем состав гильдии
    $sortstr = "`rank`";
         if ($sort == 'name') $sortstr = "`name`";
    else if ($sort == 'level')$sortstr = "`level` DESC";
    else if ($sort == 'rank') $sortstr = "`rank`";
    $members = $cDB->selectPage($number,
    "SELECT
     `characters`.`guid`,
     `characters`.`name`,
     `guild_member`.`rank`,
     `guild_member`.`pnote`,
     `guild_member`.`offnote`,
     (SUBSTRING_INDEX( SUBSTRING_INDEX(`characters`.`data` , ' ' , ?d) , ' ' , -1 )+0) AS `level`,
     (SUBSTRING_INDEX( SUBSTRING_INDEX(`characters`.`data` , ' ' , ?d) , ' ' , -1 )+0) AS `byte_0`
     FROM  `guild_member` join `characters`
     ON `guild_member`.`guid` = `characters`.`guid`
     WHERE `guildid` = ?d
     ORDER BY $sortstr
     LIMIT ?d, ?d",
     UNIT_FIELD_LEVEL+1,
     UNIT_FIELD_BYTES_0+1,
     $guildid, getPageOffset($page), $config['fade_limit']);

    $allow_show_all_info = 0;

    $back   = $guild['BackgroundColor'];
    $emblem = $guild['EmblemStyle'];
    $ecolor = $guild['EmblemColor'];
    $border = $guild['BorderStyle'];
    $bcolor = $guild['BorderColor'];
    $emblem_image = "images/player_info/guild_ico.php?back=$back&emblem=$emblem&ecolor=$ecolor&border=$border&bcolor=$bcolor";
    echo "<table class=report width=500>";
    echo "<tbody>";
    echo "<tr><td colspan=2 class=head>".$guild['name']."</td></tr>";
    echo "<tr>";
    echo "<td rowspan=4 class=emblem><img src=$emblem_image></td>";
    echo "<td>".validateText($guild['info'])."&nbsp;</td>";
    echo "</tr>";
    if ($allow_show_all_info)
        echo "<tr><td>".validateText($guild['motd'])."&nbsp;</td></tr>";
    echo "<tr><td>$lang[guild_create_at] ".date("d-m-y", $guild['createdate'])."&nbsp;</td></tr>";
    echo "<tr><td>$lang[guild_money] ".money($guild['BankMoney'])."&nbsp;</td></tr>";
    echo "</tbody>";
    echo "</table>";

    if ($members)
    {
      // Делаем ссылку для сортировки
      $SortRefrence = $FindRefrence;
      if ($page>1) $SortRefrence.="&page=$page";

      echo "<table class=report width=500>";
      echo "<tbody>";
      echo "<tr><td colspan=6 class=head>$lang[guild_members]</td></tr>";
      echo "<tr>";
      echo "<th><a href=$SortRefrence&sort=level>$lang[player_level]</a></th>";
      echo "<th colspan=2></th>";
      echo "<th><a href=$SortRefrence&sort=name>$lang[player_name]</a></th>";
      echo "<th><a href=$SortRefrence>$lang[guild_rank]</a></th>";
      echo "<th>$lang[guild_note]</th>";
      echo "</tr>\n";
      foreach ($members as $member)
      {
  		$imgsize = 32;
        $power_type= ($member['byte_0']>>24)&255;
        $gender    = ($member['byte_0']>>16)&255;
        $class     = ($member['byte_0']>> 8)&255;
        $race      = ($member['byte_0']>> 0)&255;
        echo "<tr>";
        echo "<td align=center>".$member['level']."</td>";
        echo "<td class=prace><img width=$imgsize src=\"".getRaceImage($race,$gender)."\"></td>";
        echo "<td class=pclass><img width=$imgsize src=\"".getClassImage($class)."\"></td>";
            echo "<td class=player><a href=\"?player=$member[guid]\">".$member['name']."</a></td>";
            echo "<td class=rank>".@$rank[$member['rank']]['rname']."</td>";
            echo "<td>".$member['pnote']."<br>".$member['offnote']."</td>";
            echo "</tr>\n";
      }
      $pageRefrence = $FindRefrence;
      if ($sort) $pageRefrence.="&sort=$sort";
      generatePage($number, $page, "<a href=\"$pageRefrence&page=%d\">%d </a>", 6);
      echo "</tbody></table>\n";
    }
    else
        echo "No members present<br>";
  }
}
else
{
	$FindRefrence = "?guild";
	$sortstr = "";

	$rows = $cDB->selectPage($number, "SELECT *
	                                   FROM `guild`
	                                   LIMIT ?d, ?d", getPageOffset($page), $config['fade_limit']);
    if ($rows)
    {
    	echo "<table class=report width=500>";
        echo "<tbody>";
        echo "<tr><td colspan=5 class=head>$lang[guild_list] $number</td></tr>\n";
        // Делаем ссылку для сортировки
        $SortRefrence = $FindRefrence;
        if ($page>1) $SortRefrence.="&page=$page";

        echo "<tr>";
        echo "<th></th>";
        echo "<th width=100%>$lang[guild_name]</th>";
        echo "<th>$lang[guild_create]</th>";
        echo "<th>$lang[guild_leader]</th>";
        echo "<th></th>";
        echo "</tr>\n";
        foreach ($rows as $guild)
        {
            $leader = getCharacter($guild['leaderguid']);
        	if (!$leader)
        	    continue;
            $back   = $guild['BackgroundColor'];
            $emblem = $guild['EmblemStyle'];
            $ecolor = $guild['EmblemColor'];
            $border = $guild['BorderStyle'];
            $bcolor = $guild['BorderColor'];
            $emblem_image = "images/player_info/guild_ico.php?back=$back&emblem=$emblem&ecolor=$ecolor&border=$border&bcolor=$bcolor";

            echo "<tr>";
            echo "<td><img src=$emblem_image width=48></td>";
            echo "<td class=guild>&laquo;<a href=\"?guild=$guild[guildid]\">".$guild['name']."</a>&raquo;</td>";
            echo "<td align=center><font size=-3>".date("d-m-y", $guild['createdate'])."</font></td>";
            echo "<td class=player><a href=\"?player=$leader[guid]\">".$leader['name']."</a></td>";
            echo "<td class=pfaction><img width=48 src=\"".getFactionImage($leader['race'])."\"></td>";
            echo "</tr>\n";
        }
        $pageRefrence = $FindRefrence;
        if ($sort) $pageRefrence.="&sort=$sort";
        generatePage($number, $page, "<a href=\"$pageRefrence&page=%d\">%d </a>", 5);
        echo "</tbody></table>";
    }
    else
        echo $lang['guild_noexist'];
}

?>
