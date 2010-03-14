<?php
$item_all        = array('ITEM_REPORT_LEVEL','ITEM_REPORT_ICON','ITEM_REPORT_NAME','ITEM_REPORT_REQLEVEL','ITEM_REPORT_ARMOR','ITEM_REPORT_DPS','ITEM_REPORT_SPEED','ITEM_REPORT_SUBCLASS','ITEM_REPORT_SLOTTYPE');
$item_consumable = array('ITEM_REPORT_LEVEL','ITEM_REPORT_ICON','ITEM_REPORT_NAME','ITEM_REPORT_REQLEVEL','ITEM_REPORT_SPELL');
$item_bag        = array('ITEM_REPORT_LEVEL','ITEM_REPORT_ICON','ITEM_REPORT_NAME','ITEM_REPORT_REQLEVEL','ITEM_REPORT_NUM_SLOTS','ITEM_REPORT_SUBCLASS');
$item_weapon     = array('ITEM_REPORT_LEVEL','ITEM_REPORT_ICON','ITEM_REPORT_NAME','ITEM_REPORT_REQLEVEL','ITEM_REPORT_DPS','ITEM_REPORT_SPEED','ITEM_REPORT_SLOTTYPE','ITEM_REPORT_SUBCLASS');
$item_2hweapon   = array('ITEM_REPORT_LEVEL','ITEM_REPORT_ICON','ITEM_REPORT_NAME','ITEM_REPORT_REQLEVEL','ITEM_REPORT_DPS','ITEM_REPORT_SPEED','ITEM_REPORT_SUBCLASS');
$item_holdable   = array('ITEM_REPORT_LEVEL','ITEM_REPORT_ICON','ITEM_REPORT_NAME','ITEM_REPORT_SPELL');
$item_jevelry    = array('ITEM_REPORT_LEVEL','ITEM_REPORT_ICON','ITEM_REPORT_NAME','ITEM_REPORT_REQLEVEL','ITEM_REPORT_GEMPROPETY','ITEM_REPORT_DESCRIPTION');
$item_gem        = array('ITEM_REPORT_LEVEL','ITEM_REPORT_ICON','ITEM_REPORT_NAME','ITEM_REPORT_REQLEVEL','ITEM_REPORT_GEMPROPETY');
$item_simple_gem = array('ITEM_REPORT_LEVEL','ITEM_REPORT_ICON','ITEM_REPORT_NAME');
$item_armor      = array('ITEM_REPORT_LEVEL','ITEM_REPORT_ICON','ITEM_REPORT_NAME','ITEM_REPORT_REQLEVEL','ITEM_REPORT_ARMOR','ITEM_REPORT_SLOTTYPE','ITEM_REPORT_SUBCLASS');
$item_shield     = array('ITEM_REPORT_LEVEL','ITEM_REPORT_ICON','ITEM_REPORT_NAME','ITEM_REPORT_REQLEVEL','ITEM_REPORT_ARMOR','ITEM_REPORT_BLOCK');
$item_trinket    = array('ITEM_REPORT_LEVEL','ITEM_REPORT_ICON','ITEM_REPORT_NAME','ITEM_REPORT_REQLEVEL','ITEM_REPORT_SPELL','ITEM_REPORT_SUBCLASS');
$item_shirt      = array('ITEM_REPORT_LEVEL','ITEM_REPORT_ICON','ITEM_REPORT_NAME');
$item_reagent    = array('ITEM_REPORT_LEVEL','ITEM_REPORT_ICON','ITEM_REPORT_NAME');
$item_projectile = array('ITEM_REPORT_LEVEL','ITEM_REPORT_ICON','ITEM_REPORT_NAME','ITEM_REPORT_REQLEVEL','ITEM_REPORT_AMMO_DPS','ITEM_REPORT_SUBCLASS');
$item_tradegoods = array('ITEM_REPORT_LEVEL','ITEM_REPORT_ICON','ITEM_REPORT_NAME','ITEM_REPORT_REQLEVEL','ITEM_REPORT_SUBCLASS');
$item_book       = array('ITEM_REPORT_LEVEL','ITEM_REPORT_ICON','ITEM_REPORT_NAME','ITEM_REPORT_SPELL');
$item_recipe     = array('ITEM_REPORT_LEVEL','ITEM_REPORT_ICON','ITEM_REPORT_NAME','ITEM_REPORT_SUBCLASS','ITEM_REPORT_RECIPE_ITEM');
$item_quiver     = array('ITEM_REPORT_LEVEL','ITEM_REPORT_ICON','ITEM_REPORT_NAME','ITEM_REPORT_REQLEVEL','ITEM_REPORT_NUM_SLOTS','ITEM_REPORT_SUBCLASS');
$item_quest      = array('ITEM_REPORT_LEVEL','ITEM_REPORT_ICON','ITEM_REPORT_NAME');
$item_key        = array('ITEM_REPORT_LEVEL','ITEM_REPORT_ICON','ITEM_REPORT_NAME');
$item_permanent  = array('ITEM_REPORT_LEVEL','ITEM_REPORT_ICON','ITEM_REPORT_NAME','ITEM_REPORT_REQLEVEL','ITEM_REPORT_SUBCLASS');
$item_junk       = array('ITEM_REPORT_LEVEL','ITEM_REPORT_ICON','ITEM_REPORT_NAME','ITEM_REPORT_REQLEVEL','ITEM_REPORT_SUBCLASS');
$item_glyph      = array('ITEM_REPORT_LEVEL','ITEM_REPORT_ICON','ITEM_REPORT_NAME','ITEM_REPORT_REQLEVEL','ITEM_REPORT_SPELL');

// То что будет выводится в запросе поиска типа вещи (и то какие поля бвдут выводится)
$itemType_list = array(
'1'=>&$item_armor,      // Шлемы
'2'=>&$item_trinket,    // Ожерелья
'3'=>&$item_armor,      // Наплечники
'4'=>&$item_shirt,      // Рубашки
'5'=>&$item_armor,      // Броня
'6'=>&$item_armor,      // Пояс
'7'=>&$item_armor,      // Штаны
'8'=>&$item_armor,      // Обувь
'9'=>&$item_armor,      // На запястье
'10'=>&$item_armor,     // На руки
'11'=>&$item_trinket,   // Кольца
'12'=>&$item_trinket,   // Trinket
'13'=>&$item_weapon,    // Оружие
'14'=>&$item_shield,    // Щиты
'15'=>&$item_weapon,    // Ranged
'16'=>&$item_armor,     // Плащь
'17'=>&$item_2hweapon,  // 2 ручное оружие
'18'=>&$item_bag,       // Сумки
'19'=>&$item_shirt,     // Накидка
'20'=>&$item_armor,     // Халат
'21'=>&$item_weapon,    // Основная рука
'22'=>&$item_weapon,    // Off Hand
'23'=>&$item_holdable,  // Holdable
'24'=>&$item_projectile,// Ammo
'25'=>&$item_weapon,    // Thrown
'26'=>&$item_weapon,    // Ranged right
'27'=>&$item_bag,       // Quiver
'28'=>&$item_trinket,   // Relic
'29'=>&$item_all,       // Inventory types
);

// То какие поля будут выводится ри запросе класса и субкласса вещи (и то какие поля бвдут выводится)
$ItemClass_list = array(
'0'  =>&$item_consumable, // Consumable
'0.0'=>&$item_consumable, // Consumable
'0.1'=>&$item_consumable, // Potion
'0.2'=>&$item_consumable, // Elixir
'0.3'=>&$item_consumable, // Flack
'0.4'=>&$item_consumable, // Scroll
'0.5'=>&$item_consumable, // Food & Drink
'0.6'=>&$item_consumable, // Item Enhancement
'0.7'=>&$item_consumable, // Bandage
'0.8'=>&$item_consumable, // Other

'1'  =>&$item_bag,        // Container
'1.0'=>&$item_bag,        // Bag
'1.1'=>&$item_bag,        // Soul Bag
'1.2'=>&$item_bag,        // Herb Bag
'1.3'=>&$item_bag,        // Enchanting Bag
'1.4'=>&$item_bag,        // Engineering Bag
'1.5'=>&$item_bag,        // Gem Bag
'1.6'=>&$item_bag,        // Mining Bag
'1.7'=>&$item_bag,        // Leatherworking Bag
'1.8'=>&$item_bag,        // Inscription Bag

'2'  =>&$item_weapon,      // Weapon
'2.0'=>&$item_weapon,      // One-Handed Axes
'2.1'=>&$item_2hweapon,    // Two-Handed Axes
'2.2'=>&$item_weapon,      // Bows
'2.3'=>&$item_weapon,      // Guns
'2.4'=>&$item_weapon,      // One-Handed Maces
'2.5'=>&$item_2hweapon,    // Two-Handed Maces
'2.6'=>&$item_weapon,      // Polearms
'2.7'=>&$item_weapon,      // One-Handed Swords
'2.8'=>&$item_2hweapon,    // Two-Handed Swords
'2.9'=>&$item_weapon,      // Obsolete
'2.10'=>&$item_weapon,     // Staves
'2.11'=>&$item_weapon,     // One-Handed Exotics
'2.12'=>&$item_2hweapon,   // Two-Handed Exotics
'2.13'=>&$item_weapon,     // Fist Weapons
'2.14'=>&$item_weapon,     // Miscellaneous
'2.15'=>&$item_weapon,     // Daggers
'2.16'=>&$item_weapon,     // Thrown
'2.17'=>&$item_weapon,     // Spears
'2.18'=>&$item_weapon,     // Crossbows
'2.19'=>&$item_weapon,     // Wands
'2.20'=>&$item_weapon,     // Fishing Pole

'3'=>&$item_jevelry,       // Jewelry
'3.0'=>&$item_gem,         // Red
'3.1'=>&$item_gem,         // Blue
'3.2'=>&$item_gem,         // Yellow
'3.3'=>&$item_gem,         // Purple
'3.4'=>&$item_gem,         // Green
'3.5'=>&$item_gem,         // Orange
'3.6'=>&$item_gem,         // Meta
'3.7'=>&$item_simple_gem,  // Simple
'3.8'=>&$item_jevelry,     // Prismatic

'4'=>&$item_armor,        // Armor
'4.0'=>&$item_armor,      // Miscellaneous
'4.1'=>&$item_armor,      // Cloth
'4.2'=>&$item_armor,      // Leather
'4.3'=>&$item_armor,      // Mail
'4.4'=>&$item_armor,      // Plate
'4.5'=>&$item_armor,      // Bucklers
'4.6'=>&$item_shield,     // Shields
'4.7'=>&$item_trinket,    // Librams
'4.8'=>&$item_trinket,    // Idols
'4.9'=>&$item_trinket,    // Totems
'4.10'=>&$item_trinket,   // Sigils

'5'=>&$item_reagent,      // Reagent

'6'=>&$item_projectile,     // Projectile
//'6.0'=>&$item_projectile, // Wand -OBSOLETE-
//'6.1'=>&$item_projectile, // Bolt -OBSOLETE-
'6.2'=>&$item_projectile,   // Arrow
'6.3'=>&$item_projectile,   // Bullet
//'6.4'=>&$item_projectile, // Thrown -OBSOLETE-

'7'=>&$item_tradegoods,     // Trade Goods
'7.0'=>&$item_tradegoods,   // Trade Goods
'7.1'=>&$item_tradegoods,   // Parts
'7.2'=>&$item_tradegoods,   // Explosives
'7.3'=>&$item_tradegoods,   // Devices
'7.4'=>&$item_tradegoods,   // Jewelry
'7.5'=>&$item_tradegoods,   // Cloth
'7.6'=>&$item_tradegoods,   // Leather
'7.7'=>&$item_tradegoods,   // Metal & Stone
'7.8'=>&$item_tradegoods,   // Meat
'7.9'=>&$item_tradegoods,   // Herb
'7.10'=>&$item_tradegoods,  // Elemental
'7.11'=>&$item_tradegoods,  // Other
'7.12'=>&$item_tradegoods,  // Enchanting
'7.13'=>&$item_tradegoods,  // Materials
'7.14'=>&$item_tradegoods,  // Enchanting
'7.15'=>&$item_tradegoods,  // Materials

//'8'=>&$item_all,          // Generic -OBSOLETE-

'9'=>&$item_recipe,           // Recipe
'9.0'=>&$item_book,           // Book
'9.1'=>&$item_recipe,         // Leatherworking
'9.2'=>&$item_recipe,         // Tailoring
'9.3'=>&$item_recipe,         // Engineering
'9.4'=>&$item_recipe,         // Blacksmithing
'9.5'=>&$item_recipe,         // Cooking
'9.6'=>&$item_recipe,         // Alchemy
'9.7'=>&$item_recipe,         // First Aid
'9.8'=>&$item_recipe,         // Enchanting
'9.9'=>&$item_book,           // Fishing
'9.10'=>&$item_recipe,        // Jewelcrafting

//'10'=>&$item_all,           // Money -OBSOLETE-

'11'=>&$item_quiver,         // Quiver
//'11.0'=>&$item_quiver,     // Quiver -OBSOLETE-
//'11.1'=>&$item_quiver,     // Quiver -OBSOLETE-
'11.2'=>&$item_quiver,       // Quiver
'11.3'=>&$item_quiver,       // Ammo Pouch

'12'=>&$item_quest,          // Quest
'13'=>&$item_key,            // Key & Lockpick
'14'=>&$item_permanent,      // Permanent

'15'=>&$item_junk,           // Miscellaneous
'15.0'=>&$item_junk,         // Junk
'15.1'=>&$item_junk,         // Reagent
'15.2'=>&$item_junk,         // Pet
'15.3'=>&$item_junk,         // Holiday
'15.4'=>&$item_junk,         // Other
'15.5'=>&$item_junk,         // Mount

'16'=>&$item_glyph,
'16.1'=>&$item_glyph,
'16.2'=>&$item_glyph,
'16.3'=>&$item_glyph,
'16.4'=>&$item_glyph,
'16.5'=>&$item_glyph,
'16.6'=>&$item_glyph,
'16.7'=>&$item_glyph,
'16.8'=>&$item_glyph,
'16.9'=>&$item_glyph,
'16.11'=>&$item_glyph,
);
?>
