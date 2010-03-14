<?php
//==================================================================
// C.S Wowd config file
//==================================================================
$config =array (
'servername'=>'Your Server name',

// World Database
'hostname' => '127.0.0.1',    // mysql hostname
'username' => 'root',         // mysql username
'password' => 'root',             // mysql password
'dbName' => 'mangos_wotlk',   // mysql data base name (mangos db)

// WowD Database
'whostname' => '127.0.0.1',   // mysql hostname
'wusername' => 'root',        // mysql username
'wpassword' => 'root',        // mysql password
'wdbName' => 'wowd_322_en',   // mysql wowd base name

// Realm Database
'rhostname' => '127.0.0.1',   // mysql hostname
'rusername' => 'root',        // mysql username
'rpassword' => 'root',        // mysql password
'rdbName' =>'realmd',         // mysql data base name (realm db)

// Character database
'chostname' => '127.0.0.1',   // mysql hostname
'cusername' => 'root',        // mysql username
'cpassword' => 'root',            // mysql password
'cdbName' =>'characters_wotlk',     // mysql data base name (characters db)

//Other
'lang'=>'ru',                 // lang ru,en,ua,gb....
'client_charset'=> 'utf8',    // Кодировка клиента (не рекомендую менять - так как родная кодировка сайта utf8)
'use_tab_mode'=>'1',          // Tabbed report mode

// Принудительный выбор кодировки из таблиц locales_...
'locales_lang'=>'8',          // работает только если есть заполнение таблицы locales_xxx
'locales_charset'=>'',        // Символы используемые в локализованых текстах (для определения языка ввода в поиске)

// Выбор скина
'skin_type'=>'wrath',         // default, modern, lofk_skin, dark, wdb

// Show Debug
'show_sql_timings'=>'1',      // Выводить статистику подключения
'show_ajax_sql_timings'=>'0', // Выводить статистику подключения
'show_db_error'=>'1'          // Выводить ошибки баз данных
);

//error_reporting(E_ERROR | E_PARSE | E_WARNING);
error_reporting(E_ALL);
ini_set('display_errors', 1); //disable on production servers!
//==================================================================
// Подключенные модули
//==================================================================
$modules=array();
$ajax_modules=array();

//==================================================================
// дальнейшая настройка в module/module_cfg.php
//==================================================================
include("module/module_cfg.php");

if (isset($_SESSION['lang']))
{
    switch($_SESSION['lang'])
    {
        case "ru":
        case "en":
          $config['lang'] = $_SESSION['lang']; break;
        default:
          unset($_SESSION['lang']); break;
    }
}
switch($config['lang'])
{
    case "ru":
        $config['locales_lang']=8;
        $config['wdbName'] = 'wowd_322_ru';
        break;
    case "en":
        $config['locales_lang']=0;
        $config['wdbName'] = 'wowd_322_en';
        break;
    default:
        break;
}

$modules['debug'] = "module/show/show_debug.php";
?>
