<?php
include_once("include/functions.php");
include_once("include/map_data.php");

// Нужно соеденится с базой (часть менюшек требует названий оттуда
include_once("include/DbSimple/Generic.php");
$wDB = DbSimple_Generic::connect("mysql://$config[wusername]:$config[wpassword]@$config[whostname]/$config[wdbName]");
$wDB->query("SET NAMES ?s", $config['client_charset']);

$menu = array(
  array(
   'ico'=>'icon-news',
   'name'=>$lang['find'],
   'show'=>true,
   'sub'=>array(
    array('link'=>'index.php', 'text'=>$lang['main']),
    array('link'=>'?s=i',
          'text'=>$lang['item_lookup'],
          'sub'=>array(
                 array('link'=>'?s=i&class=0',
                       'text'=>getClassName(0,0),
                       'sub'=>array(
                              array('link'=>'?s=i&class=0.0', 'text'=>getSubclassName(0,0,0)),
                              array('link'=>'?s=i&class=0.1', 'text'=>getSubclassName(0,1,0)),
                              array('link'=>'?s=i&class=0.2', 'text'=>getSubclassName(0,2,0)),
                              array('link'=>'?s=i&class=0.3', 'text'=>getSubclassName(0,3,0)),
                              array('link'=>'?s=i&class=0.4', 'text'=>getSubclassName(0,4,0)),
                              array('link'=>'?s=i&class=0.5', 'text'=>getSubclassName(0,5,0)),
                              array('link'=>'?s=i&class=0.6', 'text'=>getSubclassName(0,6,0)),
                              array('link'=>'?s=i&class=0.7', 'text'=>getSubclassName(0,7,0)),
                              array('link'=>'?s=i&class=0.8', 'text'=>getSubclassName(0,8,0)))
                      ),
                 array('link'=>'?s=i&class=1',
                       'text'=>getClassName(1,0),
                       'sub'=>array(
                              array('link'=>'?s=i&class=1.0', 'text'=>getSubclassName(1,0,0)),
                              array('link'=>'?s=i&class=1.1', 'text'=>getSubclassName(1,1,0)),
                              array('link'=>'?s=i&class=1.2', 'text'=>getSubclassName(1,2,0)),
                              array('link'=>'?s=i&class=1.3', 'text'=>getSubclassName(1,3,0)),
                              array('link'=>'?s=i&class=1.4', 'text'=>getSubclassName(1,4,0)),
                              array('link'=>'?s=i&class=1.5', 'text'=>getSubclassName(1,5,0)),
                              array('link'=>'?s=i&class=1.6', 'text'=>getSubclassName(1,6,0)),
                              array('link'=>'?s=i&class=1.7', 'text'=>getSubclassName(1,7,0)),
                              array('link'=>'?s=i&class=1.8', 'text'=>getSubclassName(1,8,0)))
                      ),
                 array('link'=>'?s=i&class=2',
                       'text'=>getClassName(2,0),
                       'sub'=>array(
                              array('link'=>'?s=i&class=2.0', 'text'=>getSubclassName(2,0,0)),
                              array('link'=>'?s=i&class=2.1', 'text'=>getSubclassName(2,1,0)),
                              array('link'=>'?s=i&class=2.2', 'text'=>getSubclassName(2,2,0)),
                              array('link'=>'?s=i&class=2.3', 'text'=>getSubclassName(2,3,0)),
                              array('link'=>'?s=i&class=2.4', 'text'=>getSubclassName(2,4,0)),
                              array('link'=>'?s=i&class=2.5', 'text'=>getSubclassName(2,5,0)),
                              array('link'=>'?s=i&class=2.6', 'text'=>getSubclassName(2,6,0)),
                              array('link'=>'?s=i&class=2.7', 'text'=>getSubclassName(2,7,0)),
                              array('link'=>'?s=i&class=2.8', 'text'=>getSubclassName(2,8,0)),
                              array('link'=>'?s=i&class=2.9', 'text'=>getSubclassName(2,9,0)),
                              array('link'=>'?s=i&class=2.10', 'text'=>getSubclassName(2,10,0)),
                              array('link'=>'?s=i&class=2.11', 'text'=>getSubclassName(2,11,0)),
                              array('link'=>'?s=i&class=2.12', 'text'=>getSubclassName(2,12,0)),
                              array('link'=>'?s=i&class=2.13', 'text'=>getSubclassName(2,13,0)),
                              array('link'=>'?s=i&class=2.14', 'text'=>getSubclassName(2,14,0)),
                              array('link'=>'?s=i&class=2.15', 'text'=>getSubclassName(2,15,0)),
                              array('link'=>'?s=i&class=2.16', 'text'=>getSubclassName(2,16,0)),
                              array('link'=>'?s=i&class=2.17', 'text'=>getSubclassName(2,17,0)),
                              array('link'=>'?s=i&class=2.18', 'text'=>getSubclassName(2,18,0)),
                              array('link'=>'?s=i&class=2.19', 'text'=>getSubclassName(2,19,0)),
                              array('link'=>'?s=i&class=2.20', 'text'=>getSubclassName(2,20,0)))
                      ),
                 array('link'=>'?s=i&class=3',
                       'text'=>getClassName(3,0),
                       'sub'=>array(
                              array('link'=>'?s=i&class=3.0', 'text'=>getSubclassName(3,0,0)),
                              array('link'=>'?s=i&class=3.1', 'text'=>getSubclassName(3,1,0)),
                              array('link'=>'?s=i&class=3.2', 'text'=>getSubclassName(3,2,0)),
                              array('link'=>'?s=i&class=3.3', 'text'=>getSubclassName(3,3,0)),
                              array('link'=>'?s=i&class=3.4', 'text'=>getSubclassName(3,4,0)),
                              array('link'=>'?s=i&class=3.5', 'text'=>getSubclassName(3,5,0)),
                              array('link'=>'?s=i&class=3.6', 'text'=>getSubclassName(3,6,0)),
                              array('link'=>'?s=i&class=3.7', 'text'=>getSubclassName(3,7,0)),
                              array('link'=>'?s=i&class=3.8', 'text'=>getSubclassName(3,8,0)))
                      ),
                 array('link'=>'?s=i&class=4',
                       'text'=>getClassName(4,0),
                       'sub'=>array(
                              array('link'=>'?s=i&class=4.0', 'text'=>getSubclassName(4,0,0)),
                              array('link'=>'?s=i&class=4.1', 'text'=>getSubclassName(4,1,0)),
                              array('link'=>'?s=i&class=4.2', 'text'=>getSubclassName(4,2,0)),
                              array('link'=>'?s=i&class=4.3', 'text'=>getSubclassName(4,3,0)),
                              array('link'=>'?s=i&class=4.4', 'text'=>getSubclassName(4,4,0)),
                              array('link'=>'?s=i&class=4.5', 'text'=>getSubclassName(4,5,0)),
                              array('link'=>'?s=i&class=4.6', 'text'=>getSubclassName(4,6,0)),
                              array('link'=>'?s=i&class=4.7', 'text'=>getSubclassName(4,7,0)),
                              array('link'=>'?s=i&class=4.8', 'text'=>getSubclassName(4,8,0)),
                              array('link'=>'?s=i&class=4.9', 'text'=>getSubclassName(4,9,0)),
                              array('link'=>'?s=i&class=4.10', 'text'=>getSubclassName(4,10,0)))
                      ),
                 array('link'=>'?s=i&class=5', 'text'=>getClassName(5,0)),
                 array('link'=>'?s=i&class=6',
                       'text'=>getClassName(6,0),
                       'sub'=>array(
                              array('link'=>'?s=i&class=6.2', 'text'=>getSubclassName(6,2,0)),
                              array('link'=>'?s=i&class=6.3', 'text'=>getSubclassName(6,3,0)))
                      ),
                 array('link'=>'?s=i&class=7',
                       'text'=>getClassName(7,0),
                       'sub'=>array(
                              array('link'=>'?s=i&class=7.0', 'text'=>getSubclassName(7,0,0)),
                              array('link'=>'?s=i&class=7.1', 'text'=>getSubclassName(7,1,0)),
                              array('link'=>'?s=i&class=7.2', 'text'=>getSubclassName(7,2,0)),
                              array('link'=>'?s=i&class=7.3', 'text'=>getSubclassName(7,3,0)),
                              array('link'=>'?s=i&class=7.4', 'text'=>getSubclassName(7,4,0)),
                              array('link'=>'?s=i&class=7.5', 'text'=>getSubclassName(7,5,0)),
                              array('link'=>'?s=i&class=7.6', 'text'=>getSubclassName(7,6,0)),
                              array('link'=>'?s=i&class=7.7', 'text'=>getSubclassName(7,7,0)),
                              array('link'=>'?s=i&class=7.8', 'text'=>getSubclassName(7,8,0)),
                              array('link'=>'?s=i&class=7.9', 'text'=>getSubclassName(7,9,0)),
                              array('link'=>'?s=i&class=7.10', 'text'=>getSubclassName(7,10,0)),
                              array('link'=>'?s=i&class=7.11', 'text'=>getSubclassName(7,11,0)),
                              array('link'=>'?s=i&class=7.12', 'text'=>getSubclassName(7,12,0)),
                              array('link'=>'?s=i&class=7.13', 'text'=>getSubclassName(7,13,0)),
                              array('link'=>'?s=i&class=7.14', 'text'=>getSubclassName(7,14,0)),
                              array('link'=>'?s=i&class=7.15', 'text'=>getSubclassName(7,15,0)))
                      ),
                 array('link'=>'?s=i&class=9',
                       'text'=>getClassName(9,0),
                       'sub'=>array(
                              array('link'=>'?s=i&class=9.0', 'text'=>getSubclassName(9,0,0)),
                              array('link'=>'?s=i&class=9.1', 'text'=>getSubclassName(9,1,0)),
                              array('link'=>'?s=i&class=9.2', 'text'=>getSubclassName(9,2,0)),
                              array('link'=>'?s=i&class=9.3', 'text'=>getSubclassName(9,3,0)),
                              array('link'=>'?s=i&class=9.4', 'text'=>getSubclassName(9,4,0)),
                              array('link'=>'?s=i&class=9.5', 'text'=>getSubclassName(9,5,0)),
                              array('link'=>'?s=i&class=9.6', 'text'=>getSubclassName(9,6,0)),
                              array('link'=>'?s=i&class=9.7', 'text'=>getSubclassName(9,7,0)),
                              array('link'=>'?s=i&class=9.8', 'text'=>getSubclassName(9,8,0)),
                              array('link'=>'?s=i&class=9.9', 'text'=>getSubclassName(9,9,0)),
                              array('link'=>'?s=i&class=9.10', 'text'=>getSubclassName(9,10,0)))
                      ),
                 array('link'=>'?s=i&class=11',
                       'text'=>getClassName(11,0),
                       'sub'=>array(
                              array('link'=>'?s=i&class=11.2', 'text'=>getSubclassName(11,2,0)),
                              array('link'=>'?s=i&class=11.3', 'text'=>getSubclassName(11,3,0)))
                      ),
                 array('link'=>'?s=i&class=12', 'text'=>getClassName(12,0)),
                 array('link'=>'?s=i&class=13',
                       'text'=>getClassName(13,0),
                       'sub'=>array(
                              array('link'=>'?s=i&class=13.0', 'text'=>getSubclassName(13,0,0)),
                              array('link'=>'?s=i&class=13.1', 'text'=>getSubclassName(13,1,0)))

                      ),
                 array('link'=>'?s=i&class=15',
                       'text'=>getClassName(15,0),
                       'sub'=>array(
                              array('link'=>'?s=i&class=15.0', 'text'=>getSubclassName(15,0,0)),
                              array('link'=>'?s=i&class=15.1', 'text'=>getSubclassName(15,1,0)),
                              array('link'=>'?s=i&class=15.2', 'text'=>getSubclassName(15,2,0)),
                              array('link'=>'?s=i&class=15.3', 'text'=>getSubclassName(15,3,0)),
                              array('link'=>'?s=i&class=15.4', 'text'=>getSubclassName(15,4,0)),
                              array('link'=>'?s=i&class=15.5', 'text'=>getSubclassName(15,5,0)))
                      ),
                 array('link'=>'?s=i&class=16',
                       'text'=>getClassName(16,0),
                       'sub'=>array(
                              array('link'=>'?s=i&class=16.1', 'text'=>getSubclassName(16,1,0)),
                              array('link'=>'?s=i&class=16.2', 'text'=>getSubclassName(16,2,0)),
                              array('link'=>'?s=i&class=16.3', 'text'=>getSubclassName(16,3,0)),
                              array('link'=>'?s=i&class=16.4', 'text'=>getSubclassName(16,4,0)),
                              array('link'=>'?s=i&class=16.5', 'text'=>getSubclassName(16,5,0)),
                              array('link'=>'?s=i&class=16.6', 'text'=>getSubclassName(16,6,0)),
                              array('link'=>'?s=i&class=16.7', 'text'=>getSubclassName(16,7,0)),
                              array('link'=>'?s=i&class=16.8', 'text'=>getSubclassName(16,8,0)),
                              array('link'=>'?s=i&class=16.9', 'text'=>getSubclassName(16,9,0)),
                              array('link'=>'?s=i&class=16.11', 'text'=>getSubclassName(16,11,0)))
                      )
          )
    ),
    array('link'=>'?s=q',      'text'=>$lang['quest_lookup']),
    array('link'=>'?s=s',      'text'=>$lang['spell_lookup']),
    array('link'=>'?s=n',
          'text'=>$lang['creature_lookup'],
          'sub'=>array(
                 array(//'link'=>'#'
                       'text'=>$lang['creature_by_type'],
                       'sub'=>array(
                              array('link'=>'?s=n&type=1', 'text'=>getCreatureType(1,0)),
                              array('link'=>'?s=n&type=2', 'text'=>getCreatureType(2,0)),
                              array('link'=>'?s=n&type=3', 'text'=>getCreatureType(3,0)),
                              array('link'=>'?s=n&type=4', 'text'=>getCreatureType(4,0)),
                              array('link'=>'?s=n&type=5', 'text'=>getCreatureType(5,0)),
                              array('link'=>'?s=n&type=6', 'text'=>getCreatureType(6,0)),
                              array('link'=>'?s=n&type=7', 'text'=>getCreatureType(7,0)),
                              array('link'=>'?s=n&type=8', 'text'=>getCreatureType(8,0)),
                              array('link'=>'?s=n&type=9', 'text'=>getCreatureType(9,0)),
                              array('link'=>'?s=n&type=10', 'text'=>getCreatureType(10,0)),
                              array('link'=>'?s=n&type=11', 'text'=>getCreatureType(11,0)),
                              array('link'=>'?s=n&type=12', 'text'=>getCreatureType(12,0)),
                              array('link'=>'?s=n&type=13', 'text'=>getCreatureType(13,0)))
                       ),
                 array(//'link'=>'#'
                       'text'=>$lang['creature_by_family'],
                       'sub'=>array(
                              array('link'=>'?s=n&family=1', 'text'=> getCreatureFamily(1,0)),
                              array('link'=>'?s=n&family=2', 'text'=> getCreatureFamily(2,0)),
                              array('link'=>'?s=n&family=3', 'text'=> getCreatureFamily(3,0)),
                              array('link'=>'?s=n&family=4', 'text'=> getCreatureFamily(4,0)),
                              array('link'=>'?s=n&family=5', 'text'=> getCreatureFamily(5,0)),
                              array('link'=>'?s=n&family=6', 'text'=> getCreatureFamily(6,0)),
                              array('link'=>'?s=n&family=7', 'text'=> getCreatureFamily(7,0)),
                              array('link'=>'?s=n&family=8', 'text'=> getCreatureFamily(8,0)),
                              array('link'=>'?s=n&family=9', 'text'=> getCreatureFamily(9,0)),
//                              array('link'=>'?s=n&family=10', 'text'=> getCreatureFamily(10,0)),
                              array('link'=>'?s=n&family=11', 'text'=> getCreatureFamily(11,0)),
                              array('link'=>'?s=n&family=12', 'text'=> getCreatureFamily(12,0)),
//                              array('link'=>'?s=n&family=13', 'text'=> getCreatureFamily(13,0)),
//                              array('link'=>'?s=n&family=14', 'text'=> getCreatureFamily(14,0)),
                              array('link'=>'?s=n&family=15', 'text'=> getCreatureFamily(15,0)),
                              array('link'=>'?s=n&family=16', 'text'=> getCreatureFamily(16,0)),
                              array('link'=>'?s=n&family=17', 'text'=> getCreatureFamily(17,0)),
//                              array('link'=>'?s=n&family=18', 'text'=> getCreatureFamily(18,0)),
                              array('link'=>'?s=n&family=19', 'text'=> getCreatureFamily(19,0)),
                              array('link'=>'?s=n&family=20', 'text'=> getCreatureFamily(20,0)),
                              array('link'=>'?s=n&family=21', 'text'=> getCreatureFamily(21,0)),
//                              array('link'=>'?s=n&family=22', 'text'=> getCreatureFamily(22,0)),
                              array('link'=>'?s=n&family=23', 'text'=> getCreatureFamily(23,0)),
                              array('link'=>'?s=n&family=24', 'text'=> getCreatureFamily(24,0)),
                              array('link'=>'?s=n&family=25', 'text'=> getCreatureFamily(25,0)),
                              array('link'=>'?s=n&family=26', 'text'=> getCreatureFamily(26,0)),
                              array('link'=>'?s=n&family=27', 'text'=> getCreatureFamily(27,0)),
                              array('link'=>'?s=n&family=28', 'text'=> getCreatureFamily(28,0)),
                              array('link'=>'?s=n&family=29', 'text'=> getCreatureFamily(29,0)),
                              array('link'=>'?s=n&family=30', 'text'=> getCreatureFamily(30,0)),
                              array('link'=>'?s=n&family=31', 'text'=> getCreatureFamily(31,0)),
                              array('link'=>'?s=n&family=32', 'text'=> getCreatureFamily(32,0)),
                              array('link'=>'?s=n&family=33', 'text'=> getCreatureFamily(33,0)),
                              array('link'=>'?s=n&family=34', 'text'=> getCreatureFamily(34,0)),
                              array('link'=>'?s=n&family=35', 'text'=> getCreatureFamily(35,0)),
//                              array('link'=>'?s=n&family=36', 'text'=> getCreatureFamily(36,0)),
                              array('link'=>'?s=n&family=37', 'text'=> getCreatureFamily(37,0)),
                              array('link'=>'?s=n&family=38', 'text'=> getCreatureFamily(38,0)),
                              array('link'=>'?s=n&family=39', 'text'=> getCreatureFamily(39,0)),
                              array('link'=>'?s=n&family=40', 'text'=> getCreatureFamily(40,0)),
                              array('link'=>'?s=n&family=41', 'text'=> getCreatureFamily(41,0)),
                              array('link'=>'?s=n&family=42', 'text'=> getCreatureFamily(42,0)),
                              array('link'=>'?s=n&family=43', 'text'=> getCreatureFamily(43,0)),
                              array('link'=>'?s=n&family=44', 'text'=> getCreatureFamily(44,0)),
                              array('link'=>'?s=n&family=45', 'text'=> getCreatureFamily(45,0)),
                              array('link'=>'?s=n&family=46', 'text'=> getCreatureFamily(46,0)))
                       ),
                 array(//'link'=>'#'
                       'text'=>$lang['creature_by_role'],
                       'sub'=>array(
                              array('link'=>'?s=n&flag=0', 'text'=>getCreatureFlagName(0,0)),
                              array('link'=>'?s=n&flag=1', 'text'=>getCreatureFlagName(1,0)),
//                              array('link'=>'?s=n&flag=2', 'text'=>getCreatureFlagName(2,0)),
//                              array('link'=>'?s=n&flag=3', 'text'=>getCreatureFlagName(3,0)),
                              array('link'=>'?s=n&flag=4', 'text'=>getCreatureFlagName(4,0)),
                              array('link'=>'?s=n&flag=5', 'text'=>getCreatureFlagName(5,0)),
                              array('link'=>'?s=n&flag=6', 'text'=>getCreatureFlagName(6,0)),
                              array('link'=>'?s=n&flag=7', 'text'=>getCreatureFlagName(7,0)),
                              array('link'=>'?s=n&flag=8', 'text'=>getCreatureFlagName(8,0)),
                              array('link'=>'?s=n&flag=9', 'text'=>getCreatureFlagName(9,0)),
                              array('link'=>'?s=n&flag=10', 'text'=>getCreatureFlagName(10,0)),
                              array('link'=>'?s=n&flag=11', 'text'=>getCreatureFlagName(11,0)),
                              array('link'=>'?s=n&flag=12', 'text'=>getCreatureFlagName(12,0)),
                              array('link'=>'?s=n&flag=13', 'text'=>getCreatureFlagName(13,0)),
                              array('link'=>'?s=n&flag=14', 'text'=>getCreatureFlagName(14,0)),
                              array('link'=>'?s=n&flag=15', 'text'=>getCreatureFlagName(15,0)),
                              array('link'=>'?s=n&flag=16', 'text'=>getCreatureFlagName(16,0)),
                              array('link'=>'?s=n&flag=17', 'text'=>getCreatureFlagName(17,0)),
                              array('link'=>'?s=n&flag=18', 'text'=>getCreatureFlagName(18,0)),
                              array('link'=>'?s=n&flag=19', 'text'=>getCreatureFlagName(19,0)),
                              array('link'=>'?s=n&flag=20', 'text'=>getCreatureFlagName(20,0)),
                              array('link'=>'?s=n&flag=21', 'text'=>getCreatureFlagName(21,0)),
                              array('link'=>'?s=n&flag=22', 'text'=>getCreatureFlagName(22,0)),
                              array('link'=>'?s=n&flag=23', 'text'=>getCreatureFlagName(23,0)),
                              array('link'=>'?s=n&flag=24', 'text'=>getCreatureFlagName(24,0)),
//                              array('link'=>'?s=n&flag=25', 'text'=>getCreatureFlagName(25,0)),
//                              array('link'=>'?s=n&flag=26', 'text'=>getCreatureFlagName(26,0)),
//                              array('link'=>'?s=n&flag=27', 'text'=>getCreatureFlagName(27,0)),
                              array('link'=>'?s=n&flag=28', 'text'=>getCreatureFlagName(28,0)))
//                              array('link'=>'?s=n&flag=29', 'text'=>getCreatureFlagName(29,0)),
//                              array('link'=>'?s=n&flag=30', 'text'=>getCreatureFlagName(30,0)),
//                              array('link'=>'?s=n&flag=31', 'text'=>getCreatureFlagName(31,0)))
                       )
          )
    ),
    array('link'=>'?s=o',      'text'=>$lang['object_lookup']),
    array('link'=>'?s=f',      'text'=>$lang['faction_lookup']),
    array('link'=>'?s=a',      'text'=>$lang['area_lookup']),
    array('link'=>'?s=set',    'text'=>$lang['item_set']),
    array('link'=>'?s=p',      'text'=>$lang['player_lookup']),
    array('link'=>'',          'text'=>$lang['achievement'],
          'sub'=>array(
                 array('link'=>'?achievement&faction=1',  'text'=>'Alliance'),
                 array('link'=>'?achievement&faction=0',  'text'=>'Horde'))
    ),
    array('link'=>'?auction',
          'text'=>$lang['auction'],
          'sub'=>array(
                 array('link'=>'?auction=Alliance',  'text'=>'Alliance'),
                 array('link'=>'?auction=Horde',     'text'=>'Horde'),
                 array('link'=>'?auction=Blackwater','text'=>'Blackwater'))
    ),
    array('link'=>'?guild',    'text'=>$lang['guild']),
    array('link'=>'?location',
          'text'=>$lang['zone'],
          'sub'=>array(
                 array('link'=>'?location=a14',  'text'=>getAreaNameFromId(14)),
                 array('link'=>'?location=a13',  'text'=>getAreaNameFromId(13)),
                 array('link'=>'?location=a466', 'text'=>getAreaNameFromId(466)),
                 array('link'=>'?location=a485', 'text'=>getAreaNameFromId(485)))
    ),
    array('link'=>'?instance', 'text'=>$lang['instance']),
    array('link'=>'?talent',
          'text'=>$lang['talent_calc'],
          'sub'=>array(
                 array('link'=>'?talent=warrior',     'text'=>getClass(1)),
                 array('link'=>'?talent=paladin',     'text'=>getClass(2)),
                 array('link'=>'?talent=hunter',      'text'=>getClass(3)),
                 array('link'=>'?talent=rogue',       'text'=>getClass(4)),
                 array('link'=>'?talent=priest',      'text'=>getClass(5)),
                 array('link'=>'?talent=death_knight','text'=>getClass(6)),
                 array('link'=>'?talent=shaman',      'text'=>getClass(7)),
                 array('link'=>'?talent=mage',        'text'=>getClass(8)),
                 array('link'=>'?talent=warlock',     'text'=>getClass(9)),
                 array('link'=>'?talent=druid',       'text'=>getClass(11)))
    )
   )
  ),
  array(
   'ico'=>'icon-community',
   'name'=>$lang['top_lookup'],
   'show'=>false,
   'sub'=>array(
    array('link'=>'?top=money',  'text'=>$lang['top_money']),
    array('link'=>'?top=honor',  'text'=>$lang['top_honor']),
    array('link'=>'?top=arena2', 'text'=>$lang['top_arena2']),
    array('link'=>'?top=arena3', 'text'=>$lang['top_arena3']),
    array('link'=>'?top=arena5', 'text'=>$lang['top_arena5']),
   )
  ),
  array(
   'ico'=>'icon-interactive',
   'name'=>$lang['skills_main'],
   'show'=>false,
   'sub'=>array(
    array('text'=>$lang['prof_primary'],
          'sub'=>array(
                 array('link'=>'?skill=Alchemy',       'text'=>$lang['prof_alchemy']),
                 array('link'=>'?skill=Blacksmithing', 'text'=>$lang['prof_blacksmith']),
                 array('link'=>'?skill=Enchanting',    'text'=>$lang['prof_enchant']),
                 array('link'=>'?skill=Engineering',   'text'=>$lang['prof_engineer']),
                 array('link'=>'?skill=Herbalism',     'text'=>$lang['prof_herbalism']),
                 array('link'=>'?skill=Jewelcrafting', 'text'=>$lang['prof_jevelcraft']),
                 array('link'=>'?skill=Leatherworking','text'=>$lang['prof_leathwork']),
                 array('link'=>'?skill=Mining',        'text'=>$lang['prof_mining']),
                 array('link'=>'?skill=Skinning',      'text'=>$lang['prof_skinning']),
                 array('link'=>'?skill=Tailoring',     'text'=>$lang['prof_taloring']),
                 array('link'=>'?skill=Inscription',   'text'=>$lang['prof_inscription']))),
    array('text'=>$lang['prof_secondary'],
          'sub'=>array(
                 array('link'=>'?skill=Cooking',       'text'=>$lang['prof_cooking']),
                 array('link'=>'?skill=First Aid',     'text'=>$lang['prof_first_aid']),
                 array('link'=>'?skill=Fishing',       'text'=>$lang['prof_fishing']))),

    array('text'=>$lang['class skills'],
          'sub'=>array(
                 array('text'=>getClass(1),
                       'sub'=>array(
                              array('link'=>'?skill=26', 'text'=>getSkillName(26,0)),
                              array('link'=>'?skill=256', 'text'=>getSkillName(256,0)),
                              array('link'=>'?skill=257', 'text'=>getSkillName(257,0))
                             )
                      ),
                 array('text'=>getClass(2),
                       'sub'=>array(
                              array('link'=>'?skill=267', 'text'=>getSkillName(267,0)),
                              array('link'=>'?skill=184', 'text'=>getSkillName(184,0)),
                              array('link'=>'?skill=594', 'text'=>getSkillName(594,0))
                             )
                      ),
                 array('text'=>getClass(3),
                       'sub'=>array(
                              array('link'=>'?skill=50', 'text'=>getSkillName(50,0)),
                              array('link'=>'?skill=51', 'text'=>getSkillName(51,0)),
                              array('link'=>'?skill=163', 'text'=>getSkillName(163,0)),
                              array('link'=>'?skill=261', 'text'=>getSkillName(261,0))
                             )
                      ),
                 array('text'=>getClass(4),
                       'sub'=>array(
                              array('link'=>'?skill=253', 'text'=>getSkillName(253,0)),
                              array('link'=>'?skill=38', 'text'=>getSkillName(38,0)),
                              array('link'=>'?skill=39', 'text'=>getSkillName(39,0)),
                              array('link'=>'?skill=40', 'text'=>getSkillName(40,0)),
                              array('link'=>'?skill=633', 'text'=>getSkillName(633,0))
                             )
                      ),
                 array('text'=>getClass(5),
                       'sub'=>array(
                              array('link'=>'?skill=56', 'text'=>getSkillName(56,0)),
                              array('link'=>'?skill=78', 'text'=>getSkillName(78,0)),
                              array('link'=>'?skill=613', 'text'=>getSkillName(613,0))
                             )
                      ),
                 array('text'=>getClass(6),
                       'sub'=>array(
                              array('link'=>'?skill=770', 'text'=>getSkillName(770,0)),
                              array('link'=>'?skill=771', 'text'=>getSkillName(771,0)),
                              array('link'=>'?skill=772', 'text'=>getSkillName(772,0))
                             )
                      ),
                 array('text'=>getClass(7),
                       'sub'=>array(
                              array('link'=>'?skill=373', 'text'=>getSkillName(373,0)),
                              array('link'=>'?skill=375', 'text'=>getSkillName(375,0)),
                              array('link'=>'?skill=374', 'text'=>getSkillName(374,0))
                             )
                      ),
                 array('text'=>getClass(8),
                       'sub'=>array(
                              array('link'=>'?skill=237', 'text'=>getSkillName(237,0)),
                              array('link'=>'?skill=6', 'text'=>getSkillName(6,0)),
                              array('link'=>'?skill=8', 'text'=>getSkillName(8,0))
                             )
                      ),
                 array('text'=>getClass(9),
                       'sub'=>array(
                              array('link'=>'?skill=355', 'text'=>getSkillName(355,0)),
                              array('link'=>'?skill=354', 'text'=>getSkillName(354,0)),
                              array('link'=>'?skill=593', 'text'=>getSkillName(593,0))
                             )
                      ),
                 array('text'=>getClass(11),
                       'sub'=>array(
                              array('link'=>'?skill=134', 'text'=>getSkillName(134,0)),
                              array('link'=>'?skill=573', 'text'=>getSkillName(573,0)),
                              array('link'=>'?skill=574', 'text'=>getSkillName(574,0))
                             )
                      )))
    )
  ),
  array(
   'ico'=>'icon-gameguide',
   'name'=>$lang['menu_faq'],
   'show'=>false,
   'sub'=>array(
    array('link'=>'?faq=list',        'text'=>$lang['faq_list']),
    array('link'=>'?faq=classes',
          'text'=>$lang['faq_classes'],
          'sub'=>array(
                 array('link'=>'?faq=class-warrior',     'text'=>getClass(1)),
                 array('link'=>'?faq=class-paladin',     'text'=>getClass(2)),
                 array('link'=>'?faq=class-hunter',      'text'=>getClass(3)),
                 array('link'=>'?faq=class-rogue',       'text'=>getClass(4)),
                 array('link'=>'?faq=class-priest',      'text'=>getClass(5)),
                 array('link'=>'?faq=class-death_knight','text'=>getClass(6)),
                 array('link'=>'?faq=class-shaman',      'text'=>getClass(7)),
                 array('link'=>'?faq=class-mage',        'text'=>getClass(8)),
                 array('link'=>'?faq=class-warlock',     'text'=>getClass(9)),
                 array('link'=>'?faq=class-druid',       'text'=>getClass(11)))
    ),
    array('text'=>$lang['faq_races'],
          'sub'=>array(
                 array('link'=>'?faq=race-humans',     'text'=>getRace(1)),
                 array('link'=>'?faq=race-orcs',       'text'=>getRace(2)),
                 array('link'=>'?faq=race-dwarves',    'text'=>getRace(3)),
                 array('link'=>'?faq=race-night_elves','text'=>getRace(4)),
                 array('link'=>'?faq=race-undeads',    'text'=>getRace(5)),
                 array('link'=>'?faq=race-taurens',    'text'=>getRace(6)),
                 array('link'=>'?faq=race-gnomes',     'text'=>getRace(7)),
                 array('link'=>'?faq=race-trolls',     'text'=>getRace(8)),
                 array('link'=>'?faq=race-blood_elves','text'=>getRace(10)),
                 array('link'=>'?faq=race-draenei',    'text'=>getRace(11)))
    ),
    array('link'=>'?faq=professions',
          'text'=>$lang['faq_professions'],
          'sub'=>array(
                 array(                                   'text'=>$lang['prof_primary']),
                 array('link'=>'?faq=prof-alchemy',       'text'=>$lang['prof_alchemy']),
                 array('link'=>'?faq=prof-blacksmithing', 'text'=>$lang['prof_blacksmith']),
                 array('link'=>'?faq=prof-enchanting',    'text'=>$lang['prof_enchant']),
                 array('link'=>'?faq=prof-engineering',   'text'=>$lang['prof_engineer']),
                 array('link'=>'?faq=prof-herbalism',     'text'=>$lang['prof_herbalism']),
                 array('link'=>'?faq=prof-jewelcrafting', 'text'=>$lang['prof_jevelcraft']),
                 array('link'=>'?faq=prof-leatherworking','text'=>$lang['prof_leathwork']),
                 array('link'=>'?faq=prof-mining',        'text'=>$lang['prof_mining']),
                 array('link'=>'?faq=prof-skinning',      'text'=>$lang['prof_skinning']),
                 array('link'=>'?faq=prof-tailoring',     'text'=>$lang['prof_taloring']),
                 array(                                   'text'=>$lang['prof_secondary']),
                 array('link'=>'?faq=prof-cooking',       'text'=>$lang['prof_cooking']),
                 array('link'=>'?faq=prof-first_aid',     'text'=>$lang['prof_first_aid']),
                 array('link'=>'?faq=prof-fishing',       'text'=>$lang['prof_fishing']))
    ),
    array('link'=>'?faq=slang',       'text'=>$lang['faq_slang']),
    array('link'=>'?faq=step1',       'text'=>$lang['step_1']),
    array('link'=>'?faq=aggro',       'text'=>$lang['about_aggro']),
    array('link'=>'?faq=city',        'text'=>$lang['about_city']),
    array('link'=>'?faq=guild',       'text'=>$lang['about_guild']),
    array('link'=>'?faq=socket',      'text'=>$lang['about_socket']),
    array('link'=>'?faq=macro',       'text'=>$lang['about_macro']),
    array('link'=>'?faq=raidhill',    'text'=>$lang['about_raid_hill'])
   )
  ),
  array(
   'ico'=>'icon-account',
   'name'=>$lang['menu_5'],
   'show'=>false,
   'sub'=>array(
    array('link'=>'?register',    'text'=>$lang['register']),
    array('link'=>'?open_search', 'text'=>$lang['open_search'])
   )
  ),
  array(
   'ico'=>'icon-support',
   'name'=>$lang['menu_6'],
   'show'=>false,
   'sub'=>array(
    array('link'=>'?stat', 'text'=>$lang['statistic']),
    array('link'=>'map/index.html', 'text'=>$lang['cartograph'], 'target'=>'_blank')
   )
  )
);
?>
