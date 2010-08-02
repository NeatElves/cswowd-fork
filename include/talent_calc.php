<?php
include_once("include/simple_cacher.php");

function generateCharacterBild($guid, $class, $spec)
{
  global $talentTabId, $cDB, $wDB;
  $tab_set = $wDB->selectCol('SELECT `id` FROM `wowd_talent_tab` WHERE `class_mask` & ?d ORDER BY `tab` ', 1<<($class-1));
  if (!$tab_set)
      return;
  $bild = '';
  $tinfo = $wDB->select(
  'SELECT
   `TalentID`,
   `TalentTab` AS ARRAY_KEY_1,
   `Row` AS ARRAY_KEY_2,
   `Col` AS ARRAY_KEY_3,
   `Rank_1`,
   `Rank_2`,
   `Rank_3`,
   `Rank_4`,
   `Rank_5`
  FROM `wowd_talents` WHERE `TalentTab` IN (?a) ORDER BY `TalentTab`, `Row`, `Col`', $tab_set);
  $points = array(0, 0, 0);
  $total  = 0;
  $max = 0;
  $name = "Undefined";
  foreach($tab_set as $i=>$tab)
  {
    foreach($tinfo[$tab] as $row=>$rows)
        foreach($rows as $col=>$data)
        {
		  $rank = $cDB->selectCell('SELECT `current_rank`  FROM `character_talent` WHERE `guid` = ?d and `spec` = ?d AND `talent_id`=?d', $guid, $spec, $data['TalentID']);
		  if (isset($rank)) ++$rank;
			else $rank = 0;
          $bild.= $rank;
          $points[$i]+=$rank;
          $total+=$rank;
        }
    if ($points[$i] > $max) {$max = $points[$i]; $name = getTalentName($tab);}
  }
  return array('calc_bild'=>$bild, 'points'=>$points, 'total'=>$total, 'name'=>$name);
}

function includeTalentScript($class, $petId, $maxLevel, $header, $ver = "322")
{
 global $wDB, $game_text, $config;
 $tab_set = 0;
 // Create tabs list
 if ($class)
 {
   // For players
   $tab_set = $wDB->selectCol('SELECT `id` FROM `wowd_talent_tab` WHERE `class_mask` & ?d ORDER BY `tab` ', 1<<($class-1));
 }
 else if ($petId>=0)
 {
   // For pets (need get pet_talent_type from creature_family)
   $talent_type = $wDB->selectCell('SELECT `pet_talent_type` FROM `wowd_creature_family` WHERE `category` = ?d', $petId);
   if (isset($talent_type) && $talent_type>=0)
       $tab_set = $wDB->selectCol('SELECT `id` FROM `wowd_talent_tab` WHERE `pet_mask` & ?d ORDER BY `tab`', 1<<$talent_type);
 }
 if (!$tab_set)
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
   $ppr = 5;
   $talents = $wDB->select(
   'SELECT
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
    WHERE `TalentTab` IN (?a)', $tab_set);
  }
  else if ($petId >= 0)
  {
   $ppr = 3;
   $petMask1=0;
   $petMask2=0;
     if ($petId < 32) $petMask1=1<<($petId   );
   else               $petMask2=1<<($petId-32);
   $talents = $wDB->select(
   'SELECT
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
    `TalentTab` IN (?a) AND ((`petflag1`=0 AND `petflag2`=0) OR (`petflag1`& ?d) OR (`petflag2`& ?d))', $tab_set, $petMask1, $petMask2);
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
  var tc_showclass ="'.($class?$class:$tab_set[0]).'";
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
 <script type="text/javascript" id = "talent_calc">
 var tc_maxlevel = '.$maxLevel.';
 var lang_header = \''.$header.'\';
 </script>
 <script type="text/javascript" src="js/talent_calc_base.js"></script>';
}
?>
