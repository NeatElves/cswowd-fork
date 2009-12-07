<?php
include_once("include/simple_cacher.php");

//===================================================
// Данные скилов по классам (взяты из TalentTab.dbc)
//===================================================
$talentTabId = array(
   '1' => array(161,164,163), // Warior
   '2' => array(382,383,381), // Paladin
   '3' => array(361,363,362), // Hunter
   '4' => array(182,181,183), // Rogue
   '5' => array(201,202,203), // Priest
   '6' => array(398,399,400), // Death knight
   '7' => array(261,263,262), // Shaman
   '8' => array( 81, 41, 61), // Mage
   '9' => array(302,303,301), // Warlock
   '11'=> array(283,281,282), // Druid
);

$petFamilyToTalentTab = array(
// Pet Ferocity
 4=>410,
 5=>410,
10=>410,
11=>410,
13=>410,
19=>410,
23=>410,
25=>410,
58=>410,
59=>410,
60=>410,
// Pet Tenacity
1=>409,
3=>409,
6=>409,
7=>409,
9=>409,
15=>409,
21=>409,
21=>409,
61=>409,
62=>409,
// Pet Cunning
0=>411,
2=>411,
8=>411,
12=>411,
14=>411,
16=>411,
17=>411,
18=>411,
22=>411,
24=>411,
63=>411);

$gHunterPetType=array(
0=>24,
1=>4,
2=>26,
3=>5,
4=>7,
5=>2,
6=>8,
7=>6,
8=>30,
9=>9,
10=>25,
11=>37,
12=>34,
13=>11,
14=>31,
15=>20,
16=>35,
17=>3,
18=>33,
19=>12,
21=>21,
21=>32,
22=>27,
23=>1,
24=>38,
25=>39,
58=>46,
59=>45,
60=>44,
61=>43,
62=>42,
63=>41
);

function generateCharacterBild($guid, $class)
{
  global $talentTabId, $cDB, $wDB;
  $tab_set  = @$talentTabId[$class];    // Какие таланты ищем
  if (!$tab_set)
      return;
  $spellList = $cDB->select("SELECT `spell` AS ARRAY_KEY  FROM `character_spell` WHERE `guid` = ?d and `disabled` = 0", $guid);
  $bild = '';
  $tinfo = $wDB->select(
  "SELECT
   `TalentTab` AS ARRAY_KEY_1,
   `Row` AS ARRAY_KEY_2,
   `Col` AS ARRAY_KEY_3,
   `Rank_1`,
   `Rank_2`,
   `Rank_3`,
   `Rank_4`,
   `Rank_5`
  FROM `wowd_talents` WHERE `TalentTab` IN (?a) ORDER BY `TalentTab`, `Row`, `Col`", $tab_set);
  $points = array(0, 0, 0);
  $total  = 0;
  $max = 0;
  $name = "Undefined";
  foreach($tab_set as $i=>$tab)
  {
    foreach($tinfo[$tab] as $row=>$rows)
        foreach($rows as $col=>$data)
        {
         $rank = 0;
               if (isset($spellList[$data['Rank_5']])) $rank = 5;
          else if (isset($spellList[$data['Rank_4']])) $rank = 4;
          else if (isset($spellList[$data['Rank_3']])) $rank = 3;
          else if (isset($spellList[$data['Rank_2']])) $rank = 2;
          else if (isset($spellList[$data['Rank_1']])) $rank = 1;
          $bild.= $rank;
          $points[$i]+=$rank;
          $total+=$rank;
        }
    if ($points[$i] > $max) {$max = $points[$i]; $name = getTalentName($tab);}
  }
  return array('calc_bild'=>$bild, 'points'=>$points, 'total'=>$total, 'name'=>$name);
}

function includeTalentScript($class, $petId, $maxLevel, $header, $ver = "313")
{
 global $wDB, $game_text, $talentTabId, $petFamilyToTalentTab, $config;
 if (!isset($petFamilyToTalentTab[$petId]) AND !isset($talentTabId[$class]))
     return;

 // Создаём кэш для калькулятора (если его нет или устарел)
 $data_file = "tc_".$class.$petId."_".$config['lang']."_".$ver.".js";
 if (checkUseCacheJs($data_file, 60*60*24))
 {
  // Подготаливаем данные для скрипта
  $tab_name = array();                  // Имена веток талантов
  $tid_to_tab = array();                // Преборазователь TalentId => TabId
  $tabs = array();                      // Тут уже будут данные для JS скрипта
  $spell_desc = array();                // Тут хранятся описания спеллов
  $t_row  = 0;                          // Максимум строк
  $t_col  = 0;                          // Максимум колонок

  // Стрелки зависимосей описаны тут
  $arrows = array(
   '0_1' =>array('img'=>'right',     'x'=>-14,'y'=>12),
   '0_-1'=>array('img'=>'left',      'x'=> 40,'y'=>12),
   '1_-1'=>array('img'=>'down-left', 'x'=> 14,'y'=>-40),
   '1_0' =>array('img'=>'down-1',    'x'=> 13,'y'=>-12),
   '2_0' =>array('img'=>'down-2',    'x'=> 13,'y'=>-70),
   '2_1' =>array('img'=>'down2-right','x'=>-13,'y'=>-94),
   '2_-1'=>array('img'=>'down2-left','x'=>14,'y'=>-94),
   '3_0' =>array('img'=>'down-3',    'x'=> 13,'y'=>-128),
   '4_0' =>array('img'=>'down-4',    'x'=> 13,'y'=>-188),
   '1_1' =>array('img'=>'down-right','x'=>-13,'y'=>-40)
  );
  // Получаем данные о ветках из базы и переводим их в нужный формат
  if ($class)
  {
   $tab_set = $talentTabId[$class];                  // Какие таланты ищем (игроки)
   $ppr = 5;
   $talents = $wDB->select(
   "SELECT
    `TalentID` AS ARRAY_KEY,
    `TalentTab`,
    `Row`,
    `Col`,
    `Rank_1`,
    `Rank_2`,
    `Rank_3`,
    `Rank_4`,
    `Rank_5`,
    `DependsOn`,
    `DependsOnRank`
    FROM
    `wowd_talents`
    WHERE `TalentTab` IN (?a)", $tab_set);
  }
  else
  {
   $tab = $petFamilyToTalentTab[$petId];
   $tab_set = array($tab);  // Какие таланты ищем (петы)
   $ppr = 3;

   $petMask1=0;
   $petMask2=0;
     if ($petId < 32) $petMask1=1<<($petId   );
   else               $petMask2=1<<($petId-32);
   $talents = $wDB->select(
   "SELECT
    `TalentID` AS ARRAY_KEY,
    `TalentTab`,
    `Row`,
    `Col`,
    `Rank_1`,
    `Rank_2`,
    `Rank_3`,
    `Rank_4`,
    `Rank_5`,
    `DependsOn`,
    `DependsOnRank`
    FROM
    `wowd_talents`
    WHERE
    `TalentTab` = ?d AND ((`petflag1`=0 AND `petflag2`=0) OR (`petflag1`& ?d) OR (`petflag2`& ?d))", $tab, $petMask1, $petMask2);
  }

  // Заполняем преборазователь TalentId => TabId и Имена веток талантов
  foreach ($tab_set as $id=>$tid)
  {
    $tid_to_tab[$tid]=$id;
    $tab_name[$id] = getTalentName($tid);
  }

  foreach($talents as $id=>$t)
  {
    $tabId  = $tid_to_tab[$t['TalentTab']];
    $row    = $t['Row'];
    $col    = $t['Col'];
    $spells = array();
    $icon   = 0;
    $max    = 0;

    if ($t_row <= $row) $t_row = $row+1;
    if ($t_col <= $col) $t_col = $col+1;

    for ($i=1;$i<6;$i++)
    {
     $spellid = $t['Rank_'.$i];
     if ($spellid == 0)
         continue;
     $max = $i;
     $spells[$i-1] = $spellid;
     $spell  = getSpell($spellid);
     if ($icon==0) $icon = getSpellIconName($spell['SpellIconID']);
     $name = $spell['SpellName'];
     $spell_desc[$spellid]=array('name'=>$name, 'desc'=>getSpellDesc($spell));
    }
    $tabs[$tabId.'_'.$row.'_'.$col]=array('id'=>$id, 'spells'=>$spells, 'icon'=>$icon, 'max'=>$max);

    if ($t['DependsOn'] && isset($talents[$t['DependsOn']]))
    {
      $d = $talents[$t['DependsOn']];
      $dx = $t['Row']-$d['Row'];
      $dy = $t['Col']-$d['Col'];
      $a = $arrows[$dx."_".$dy];
      $tabs[$tabId.'_'.$row.'_'.$col]['depend'] = array(
        'id'=>$tid_to_tab[$d['TalentTab']]."_".$d['Row']."_".$d['Col'],
        'rank'=>$t['DependsOnRank'],
        'img'=>$a['img'],
        'x'=>intval($a['x']),
        'y'=>intval($a['y']));
    }
    else
        $depend = 0;
  }
  echo'
  var tc_showclass ="'.($class?$class:$tab).'";
  var tc_name = '.php2js($tab_name).';
  var tc_tabs = '.count($tab_set).';
  var tc_row = '.$t_row.';
  var tc_col = '.$t_col.';
  var tc_tab = '.php2js($tabs).';
  var tc_point_per_row = '.$ppr.';
  var tc_spell_desc = '.php2js($spell_desc).';
  var lang_rank = "'.$game_text['talent_rank'].'";
  var lang_next_rank = "'.$game_text['talent_next_rank'].'";
  var lang_req_points = "'.$game_text['talent_req_points'].'";';
  flushJsCache($data_file);
 }
 echo'
 <script type="text/javascript">
 var tc_maxlevel = '.$maxLevel.';
 var lang_header = \''.$header.'\';
 </script>
 <script type="text/javascript" src="js/talent_calc_base.js"></script>';
}
?>
