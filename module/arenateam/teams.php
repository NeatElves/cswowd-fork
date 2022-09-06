<?php
include_once("include/functions.php");

function count_days( $a, $b ) {
    $gd_a = getdate( $a );
    $gd_b = getdate( $b );
    $a_new = mktime( 12, 0, 0, $gd_a['mon'], $gd_a['mday'], $gd_a['year'] );
    $b_new = mktime( 12, 0, 0, $gd_b['mon'], $gd_b['mday'], $gd_b['year'] );
    return round( abs( $a_new - $b_new ) / 86400 );
}

$id= intval(@$_REQUEST['arenateam']);

$arenateam_data   = $cDB->selectRow("SELECT * FROM `arena_team` WHERE arenateamid = ?d", $id);
$arenateam_stats  = $cDB->selectRow("SELECT * FROM `arena_team_stats` WHERE arenateamid = ?d", $id);
$arenateam_member = $cDB->selectPage($total_members, "SELECT * FROM `arena_team_member` WHERE arenateamid = ?d", $id);
if (!$arenateam_data)
{
   echo "$lang[not_found]";
}

if ($arenateam_data AND $arenateam_stats AND $arenateam_member)
{
 $losses_week    = $arenateam_stats['games_week'] - $arenateam_stats['wins_week'];
 $winperc_week   = $arenateam_stats['games_week'] ? round(($arenateam_stats['wins_week']/$arenateam_stats['games_week']) * 100) : 0;
 $losses_season  = $arenateam_stats['games_season'] - $arenateam_stats['wins_season'];
 $winperc_season = $arenateam_stats['games_season'] ? round(($arenateam_stats['wins_season']/$arenateam_stats['games_season']) * 100) : 0;

 $type   = $arenateam_data['type'];
 $back   = ($arenateam_data['BackgroundColor']+0)&0xFFFFFF;
 $emblem = $arenateam_data['EmblemStyle'];
 $ecolor = ($arenateam_data['EmblemColor']+0)&0xFFFFFF;
 $border = $arenateam_data['BorderStyle'];
 $bcolor = ($arenateam_data['BorderColor']+0)&0xFFFFFF;
 $emblem_image = "images/player_info/arena_ico.php?type=$type&back=$back&emblem=$emblem&ecolor=$ecolor&border=$border&bcolor=$bcolor";
 echo "
 <table class=report width=100%>
  <tr>
    <td colspan=10 class=head>$arenateam_data[name] - $arenateam_stats[rating]</td>
  </tr>
  <tr>
    <td colspan=2>".$lang['arena_this_week']."</td>
    <td colspan=2>".$lang['arena_played'].": $arenateam_stats[games_week]</td>
    <td colspan=2>".$lang['arena_wins'].": $arenateam_stats[wins_week]</td>
    <td colspan=2>".$lang['arena_lose'].": $losses_week</td>
    <td colspan=2>".$lang['arena_win_pct'].": $winperc_week %</td>
  </tr>
  <tr>
    <td colspan=2>".$lang['arena_total_stat']."</td>
    <td colspan=2>".$lang['arena_played'].": $arenateam_stats[games_season]</td>
    <td colspan=2>".$lang['arena_wins'].": $arenateam_stats[wins_season]</td>
    <td colspan=2>".$lang['arena_lose'].": $losses_season</td>
    <td colspan=2>".$lang['arena_win_pct'].": $winperc_season %</td>
  </tr>
  <tr>
    <td colspan=5 align=center>".$lang['arena_team_leader'].": ".getCharacterName($arenateam_data['captainguid'])."</td>
    <td colspan=5 align=center>".$lang['arena_members_count'].": $total_members</td>
  </tr>
  <tr>
    <th>".$lang['player_level']."</th>
    <th>".$lang['player_name']."</th>
    <th>".$lang['player_race']."</th>
    <th>".$lang['player_class']."</th>
    <th>".$lang['last_login']."</th>
    <th>".$lang['online']."</th>
    <th>".$lang['arena_week_games']."</th>
    <th>".$lang['arena_wins']."</th>
    <th>".$lang['arena_season_games']."</th>
    <th>".$lang['arena_wins']."</th>
  </tr>
  ";
 foreach ($arenateam_member as $player)
 {
    $fields = "`name`,
               `race`,
               `class`,
               `online`,
               `account`,
               `logout_time`,
                SUBSTRING_INDEX(SUBSTRING_INDEX(`data`, ' ', ".(UNIT_FIELD_LEVEL+1)."), ' ', -1) AS level,
               (SUBSTRING_INDEX(SUBSTRING_INDEX(`data`, ' ', ".(UNIT_FIELD_BYTES_0+1)."),' ',-1)/(256*256)) & 255 AS gender";
    if ($char = getCharacter($player['guid'], $fields))
    {
        $llogin = count_days($char['logout_time'], time());
        echo "
        <tr>
         <td align=center>$char[level]</td>
         <td><a href=\"?player=$player[guid]\">$char[name]</a></td>
         <td class=prace><img width=32 src='".getRaceImage($char['race'], $char['gender'])."'/></td>
         <td class=pclass><img width=32 src='".getClassImage($char['class'])."'/></td>
         <td align=center>$llogin</td>
         <td align=center>".(($char['online'] > 0) ? "+" : "-")."</td>
         <td align=center>$player[played_week]</td>
         <td align=center>$player[wons_week]</td>
         <td align=center>$player[played_season]</td>
         <td align=center>$player[wons_season]</td>
        </tr>";
    }
 }
 echo "</table>";
 echo "
 <table width=100% border=0 cellspacing=0 cellpadding=0>
  <tr>
   <td>&nbsp;&nbsp;&nbsp;<img src=$emblem_image></td>
   <td align=right><img src=$emblem_image>&nbsp;</td>
  </tr>
 </table>";
}
?>
