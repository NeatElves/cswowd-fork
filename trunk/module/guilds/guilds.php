<?php
include_once("include/functions.php");
include_once("include/report_generator.php");

function getGuildEmblem($guild)
{
  $back   = $guild['BackgroundColor'];
  $emblem = $guild['EmblemStyle'];
  $ecolor = $guild['EmblemColor'];
  $border = $guild['BorderStyle'];
  $bcolor = $guild['BorderColor'];
  return "images/player_info/guild_ico.php?back=$back&emblem=$emblem&ecolor=$ecolor&border=$border&bcolor=$bcolor";
}

$guildid = intval(@$_REQUEST['guild']);
if ($guildid)
{
  $FindRefrence = "?guild=$guildid";

  $guild = getGuild($guildid);
  if ($guild)
  {
    // Create guild info table
    if ($ajaxmode==0)
	{
      $allow_show_all_info = 0;
      echo '<table class=report width=500>';
      echo '<tbody>';
      echo '<tr><td colspan=2 class=head>'.$guild['name'].'</td></tr>';
      echo '<tr>';
      echo '<td rowspan=4 class=emblem><img src='.getGuildEmblem($guild).'></td>';
      echo '<td>'.$guild['info'].'&nbsp;</td>';
      echo '</tr>';
      if ($allow_show_all_info)
        echo '<tr><td>'.$guild['motd'].'&nbsp;</td></tr>';
      echo '<tr><td>'.$lang['guild_create_at'].'&nbsp;'.date('d-m-y', $guild['createdate']).'&nbsp;</td></tr>';
      echo '<tr><td>'.$lang['guild_money'].'&nbsp;'.money($guild['BankMoney']).'&nbsp;</td></tr>';
      echo '</tbody>';
      echo '</table>';
    }
	// Create guild members list report
    $show_fields= array('PL_REPORT_LEVEL', 'PL_REPORT_RACE', 'PL_REPORT_CLASS', 'PL_REPORT_NAME', 'PL_REPORT_GRANK', 'PL_REPORT_NOTE');
    $members =& new PlayerReportGenerator('guild');
    $members->disableMark();
    $members->Init($show_fields, $FindRefrence, 'guildMembers', $config['fade_limit'], 'name');
    $members->guildMembers($guildid);
    $members->createReport($lang['guild_members']);
  }
}
else
{
    $page    = intval(@$_REQUEST['page']);
    $sort    = @$_REQUEST['sort'];

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
            $leader = getCharacter($guild['leaderguid'], '`name`, `race`');
        	if (!$leader)
        	    continue;
            echo "<tr>";
			echo "<td><img src=".getGuildEmblem($guild)." width=48></td>";
            echo "<td class=guild>&laquo;<a href=\"?guild=$guild[guildid]\">".$guild['name']."</a>&raquo;</td>";
            echo "<td align=center><font size=-3>".date("d-m-y", $guild['createdate'])."</font></td>";
            echo "<td class=player><a href=\"?player=$guild[leaderguid]\">".$leader['name']."</a></td>";
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
