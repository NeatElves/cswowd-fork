<?php
include_once("include/functions.php");

$page = intval(@$_REQUEST['page']);

// Создаём SQL запрос исходя из заданых пользователем параметров
$filter = "";
// Создаём ссылку на страницу, игнорируем дефолтные значения
$FindRefrence = "?set";

// Name filter
if ($name = mysql_real_escape_string(@$_REQUEST['name']))
{
  $filter.= " AND `name` like '%$name%'";
  $FindRefrence.="&name=$name";
}

$filter.=" AND 1=1";

// Убираем ненужный AND в начале строки
$filter = substr($filter, 5);

// Sort method
$sort = @$_REQUEST['sort'];
$sort_str = " order by `name`";
if     ($sort == "name")  $sort_str = " order by `name`";
else if($sort == "id")    $sort_str = " order by `id`";
else                      $sort_str = " order by `name`";

$rows = 0;
if ($filter!="")
$rows = $wDB->selectPage($number, "SELECT * FROM `wowd_itemset` WHERE
$filter
$sort_str LIMIT ?d, ?d", getPageOffset($page), $config['fade_limit']);

if (!$rows || $number == 0)
{
    echo $lang['not_found'];
}
else
{
 echo "<table class=report width=500>\n";
 echo "<tbody>\n";
 echo "<tr><td colspan=4 class=head>Наборы</td></tr>\n";

 // Делаем ссылку для сортировки
 $SortRefrence = $FindRefrence;
 if ($page>1) $SortRefrence.="&page=$page";

 echo "<tr>";
 echo "<TH><a href=\"$SortRefrence\">Set name</a></TH>";
 echo "<TH width=260px>Items</TH>";
 echo "<TH>Info</TH>";
 echo "</tr>\n";
 foreach ($rows as $set)
 {
   $items = array();
   $item  = 0;
   if ($set['item_1'])
       $item = getItem($set['item_1']);
   else
   {
       $items = $dDB->select("SELECT `entry`, `AllowableClass`, `displayid`  FROM `item_template` WHERE `itemset` = ?d", $set['id']);
       if ($items)
           $item = $items[0];
   }
   echo "<tr>";
   echo "<td>$set[name]</td>";
   echo "<td>";
   if ($set['item_1'])
   {
     for ($i=1;$i<18;$i++)
       if ($itemid = $set['item_'.$i])
           show_item($itemid, 0, 'set');
   }
   else
   {
     foreach($items as $item)
        show_item($item['entry'], $item['displayid'], 'set');
   }
   if ($item)
       $classreq = getAllowableClass($item['AllowableClass']);
   else
       $classreq = 0;
   if (!$classreq) $classreq = "";
   echo "</td>";
   echo "<td align=center>".$classreq."</td>";
   echo "</tr>\n";
 }
 $pageRefrence = $FindRefrence;
 if ($sort) $pageRefrence.="&sort=$sort";
 generatePage($number, $page, "<a href=\"$pageRefrence&page=%d\">%d </a>", 4);
 echo "</TBODY></TABLE>";
}
?>
