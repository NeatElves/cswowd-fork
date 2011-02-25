<?php
//
// Live search types
//
$ls_type_name = array(
'i'=>'Item',
'q'=>'Quest',
'n'=>'NPC',
'g'=>'GO',
's'=>'Spell',
'f'=>'Faction',
'a'=>'Area',
'set'=>'Item Set'
);

//*************** Item enums ************************************
$UseorEquip = array(
'0'=>'Use:',
'1'=>'Equip:',
'2'=>'Chance on hit:',
'4'=>'Soulstone:',
'5'=>'',
'6'=>'Use for learn:'
);

$iBonus = array(
 '0'=>'%d Mana',        // ITEM_MOD_MANA      = 0
 '1'=>'%d Health',      // ITEM_MOD_HEALTH    = 1
 '3'=>'%d Agility',     // ITEM_MOD_AGILITY   = 3
 '4'=>'%d Strength',    // ITEM_MOD_STRENGTH  = 4
 '5'=>'%d Intellect',   // ITEM_MOD_INTELLECT = 5
 '6'=>'%d Spirit',      // ITEM_MOD_SPIRIT    = 6
 '7'=>'%d Stamina',     // ITEM_MOD_STAMINA   = 7
'12'=>'Equip: Increases defense raiting by %d.',              // ITEM_MOD_DEFENSE_SKILL_RATING     = 12
'13'=>'Equip: Increases dodge raiting by %d.',                // ITEM_MOD_DODGE_RATING             = 13
'14'=>'Equip: Increases parry raiting by %d.',                // ITEM_MOD_PARRY_RATING             = 14
'15'=>'Equip: Increases block raiting by %d.',                // ITEM_MOD_BLOCK_RATING             = 15
'16'=>'Equip: Increases melee hit raiting by %d.',            // ITEM_MOD_HIT_MELEE_RATING         = 16
'17'=>'Equip: Increases ranged hit raiting by %d.',           // ITEM_MOD_HIT_RANGED_RATING        = 17
'18'=>'Equip: Increases spell hit raiting by %d.',            // ITEM_MOD_HIT_SPELL_RATING         = 18
'19'=>'Equip: Improves melee critical strike rating by %d.',  // ITEM_MOD_CRIT_MELEE_RATING        = 19
'20'=>'Equip: Improves ranged critical strike rating by %d.', // ITEM_MOD_CRIT_RANGED_RATING       = 20
'21'=>'Equip: Improves spell critical strike rating by %d.',  // ITEM_MOD_CRIT_SPELL_RATING        = 21
'22'=>'Equip: Melee hit taken by %d.',                        // ITEM_MOD_HIT_TAKEN_MELEE_RATING   = 22
'23'=>'Equip: Ranged hit taken by %d.',                       // ITEM_MOD_HIT_TAKEN_RANGED_RATING  = 23
'24'=>'Equip: Spell hit taken by %d.',                        // ITEM_MOD_HIT_TAKEN_SPELL_RATING   = 24
'25'=>'Equip: Melee crit taken by %d.',                       // ITEM_MOD_CRIT_TAKEN_MELEE_RATING  = 25
'26'=>'Equip: Ranged crit taken by %d.',                      // ITEM_MOD_CRIT_TAKEN_RANGED_RATING = 26
'27'=>'Equip: Spell crit taken by %d.',                       // ITEM_MOD_CRIT_TAKEN_SPELL_RATING  = 27
'28'=>'Equip: Melee haste by %d.',                            // ITEM_MOD_HASTE_MELEE_RATING       = 28
'29'=>'Equip: Ranged haste by %d.',                           // ITEM_MOD_HASTE_RANGED_RATING      = 29
'30'=>'Equip: Spell haste by %d.',                            // ITEM_MOD_HASTE_SPELL_RATING       = 30
'31'=>'Equip: Improves hit raiting by %d.',                   // ITEM_MOD_HIT_RATING               = 31
'32'=>'Equip: Improves critical strike rating by %d.',        // ITEM_MOD_CRIT_RATING              = 32
'33'=>'Equip: Hit taken by %d.',                              // ITEM_MOD_HIT_TAKEN_RATING         = 33
'34'=>'Equip: Crit taken by %d.',                             // ITEM_MOD_CRIT_TAKEN_RATING        = 34
'35'=>'Equip: Improves your resilience rating by %d.',        // ITEM_MOD_RESILIENCE_RATING        = 35
'36'=>'Equip: Improves haste raiting by %d.',                 // ITEM_MOD_HASTE_RATING             = 36
'37'=>'Equip: Increases your expertise rating by %d.',        // ITEM_MOD_EXPERTISE_RATING         = 37
'38'=>'Equip: Increases attack power by %d.',                 // ITEM_MOD_ATTACK_POWER             = 38
'39'=>'Equip: Increases ranged attack power by %d.',          // ITEM_MOD_RANGED_ATTACK_POWER      = 39
'40'=>'Equip: Increases attack power by %d in Cat, Bear, Dire Bear, and Moonkin forms only.',// ITEM_MOD_FERAL_ATTACK_POWER       = 40
'41'=>'Equip: Increases healing done by magical spells and effects by up to %d.',            // ITEM_MOD_SPELL_HEALING_DONE       = 41
'42'=>'Equip: Increases damage done by magical spells and effects by up to %d.',             // ITEM_MOD_SPELL_DAMAGE_DONE        = 42
'43'=>'Equip: Restores %d mana per 5 sec.',                   // ITEM_MOD_MANA_REGENERATION        = 43
'44'=>'Equip: Increases your armor penetration rating by %d.',// ITEM_MOD_ARMOR_PENETRATION_RATING = 44
'45'=>'Equip: Increases spell power by %d.'                   // ITEM_MOD_SPELL_POWER              = 45
);

$gInventoryType = array(
'0'=>'All type',
'1'=>'Head',
'2'=>'Neck',
'3'=>'Shoulders',
'4'=>'Shirt',
'5'=>'Chest',
'6'=>'Waist',
'7'=>'Legs',
'8'=>'Feet',
'9'=>'Wrist',
'10'=>'Hands',
'11'=>'Finger',
'12'=>'Trinket',
'13'=>'One-Hand',
'14'=>'Shield',
'15'=>'Ranged',
'16'=>'Back',
'17'=>'Two-Hand',
'18'=>'Bag',
'19'=>'Tabard',
'20'=>'Robe',
'21'=>'Main Hand',
'22'=>'Off Hand',
'23'=>'Holdable',
'24'=>'Ammo',
'25'=>'Thrown',
'26'=>'Ranged',
'27'=>'Quiver',
'28'=>'Relic',
'29'=>'Inventory types',
);

$itemClassSubclass = array(
'-1'=>'All items',
'0'=>'Consumable',
'0.0'=>'Consumable',
'0.1'=>'Potion',
'0.2'=>'Elixir',
'0.3'=>'Flask',
'0.4'=>'Scroll',
'0.5'=>'Food & Drink',
'0.6'=>'Item Enhancement',
'0.7'=>'Bandage',
'0.8'=>'Other',

'1'=>'Container',
'1.0'=>'Bag',
'1.1'=>'Soul Bag',
'1.2'=>'Herb Bag',
'1.3'=>'Enchanting Bag',
'1.4'=>'Engineering Bag',
'1.5'=>'Gem Bag',
'1.6'=>'Mining Bag',
'1.7'=>'Leatherworking Bag',
'1.8'=>'Inscription Bag',

'2'=>'Weapon',
'2.0'=>'Axe:One-Handed Axes',
'2.1'=>'Axe:Two-Handed Axes',
'2.2'=>'Bow:Bows',
'2.3'=>'Gun:Guns',
'2.4'=>'Mace:One-Handed Maces',
'2.5'=>'Mace:Two-Handed Maces',
'2.6'=>'Polearm:Polearms',
'2.7'=>'Sword:One-Handed Swords',
'2.8'=>'Sword:Two-Handed Swords',
'2.9'=>'Obsolete',
'2.10'=>'Staff:Staves',
'2.11'=>'Exotic:One-Handed Exotics',
'2.12'=>'Exotic:Two-Handed Exotics',
'2.13'=>'Fist Weapon:Fist Weapons',
'2.14'=>'Miscellaneous',
'2.15'=>'Dagger:Daggers',
'2.16'=>'Thrown:Thrown',
'2.17'=>'Spear:Spears',
'2.18'=>'Crossbow:Crossbows',
'2.19'=>'Wand:Wands',
'2.20'=>'Fishing Pole:Fishing Poles',

'3'=>'Gem',
'3.0'=>'Red',
'3.1'=>'Blue',
'3.2'=>'Yellow',
'3.3'=>'Purple',
'3.4'=>'Green',
'3.5'=>'Orange',
'3.6'=>'Meta',
'3.7'=>'Simple',
'3.8'=>'Prismatic',

'4'=>'Armor',
'4.0'=>'Miscellaneous',
'4.1'=>'Cloth:Cloth',
'4.2'=>'Leather:Leather',
'4.3'=>'Mail:Mail',
'4.4'=>'Plate:Plate',
'4.5'=>'Buckler(OBSOLETE):Bucklers',
'4.6'=>'Shield:Shields',
'4.7'=>'Libram:Librams',
'4.8'=>'Idol:Idols',
'4.9'=>'Totem:Totems',
'4.10'=>'Sigil:Sigils',

'5'=>'Reagent',
'5.0'=>'Reagent',

'6'=>'Projectile',
'6.0'=>'Wand(OBSOLETE)',
'6.1'=>'Bolt(OBSOLETE)',
'6.2'=>'Arrow',
'6.3'=>'Bullet',
'6.4'=>'Thrown(OBSOLETE)',

'7'=>'Trade Goods',
'7.0'=>'Trade Goods',
'7.1'=>'Parts',
'7.2'=>'Explosives',
'7.3'=>'Devices',
'7.4'=>'Jewelcrafting',
'7.5'=>'Cloth',
'7.6'=>'Leather',
'7.7'=>'Metal & Stone',
'7.8'=>'Meat',
'7.9'=>'Herb',
'7.10'=>'Elemental',
'7.11'=>'Other',
'7.12'=>'Enchanting',
'7.13'=>'Materials',
'7.14'=>'Armor Enchantment:Armor Enchantment',
'7.15'=>'Weapon Enchantment:Weapon Enchantment',

'8'=>'Generic',
'8.0'=>'Generic',

'9'=>'Recipe',
'8.0'=>'Generic(OBSOLETE)',
'9.0'=>'Book',
'9.1'=>'Leatherworking',
'9.2'=>'Tailoring',
'9.3'=>'Engineering',
'9.4'=>'Blacksmithing',
'9.5'=>'Cooking',
'9.6'=>'Alchemy',
'9.7'=>'First Aid',
'9.8'=>'Enchanting',
'9.9'=>'Fishing',
'9.10'=>'Jewelcrafting',

'10'=>'Money',
'10.0'=>'Money(OBSOLETE)',

'11'=>'Quiver',
'11.0'=>'Quiver(OBSOLETE)',
'11.1'=>'Quiver(OBSOLETE)',
'11.2'=>'Quiver',
'11.3'=>'Ammo Pouch',

'12'=>'Quest',
'12.0'=>'Quest',

'13'=>'Key & Lockpick',
'13.0'=>'Key',
'13.1'=>'Lockpick',

'14'=>'Permanent',
'14.0'=>'Permanent',

'15'=>'Misc',
'15.0'=>'Junk',
'15.1'=>'Reagent',
'15.2'=>'Pet',
'15.3'=>'Holiday',
'15.4'=>'Other',
'15.5'=>'Mount:Mount',

'16'=>'Glyph',
'16.1'=>'Warrior:Warrior',
'16.2'=>'Paladin:Paladin',
'16.3'=>'Hunter:Hunter',
'16.4'=>'Rogue:Rogue',
'16.5'=>'Priest:Priest',
'16.6'=>'Death Knight:Death Knight',
'16.7'=>'Shaman:Shaman',
'16.8'=>'Mage:Mage',
'16.9'=>'Warlock:Warlock',
'16.11'=>'Druid:Druid',
);

$gBonding = array(
'-1'=>'Soulbound',
'0'=>'',
'1'=>'Binds when picked up',
'2'=>'Binds when equipped',
'3'=>'Binds when used',
'4'=>'Quest Item',
'5'=>'Quest Item 1',
);

$gStatType = array(
'-1'=>'All stats',
'0'=>'Strength',
'1'=>'Agility',
'2'=>'Stamina',
'3'=>'Intellect',
'4'=>'Spirit'
);

$gResistance = array(
'0'=>'Armor',
'1'=>'Holy Resistance',
'2'=>'Fire Resistance',
'3'=>'Nature Resistance',
'4'=>'Frost Resistance',
'5'=>'Shadow Resistance',
'6'=>'Arcane Resistance'
);

$gResistanceType = array(
'0'=>'%d Armor',
'1'=>'%d Holy Resistance',
'2'=>'%d Fire Resistance',
'3'=>'%d Nature Resistance',
'4'=>'%d Frost Resistance',
'5'=>'%d Shadow Resistance',
'6'=>'%d Arcane Resistance'
);

//***************** Gameobject enums ***********************************
$gameobjectType = array(
'0'=>'Door',
'1'=>'Button',
'2'=>'Questgiver',
'3'=>'Chest',
'4'=>'Binder',
'5'=>'Generic',
'6'=>'Trap',
'7'=>'Chair',
'8'=>'Spellfocus',
'9'=>'Text',
'10'=>'Gobber',
'11'=>'Transport',
'12'=>'Areadamage',
'13'=>'Camera',
'14'=>'Map Object',
'15'=>'Map Object Transport',
'16'=>'Duel Arbiter',
'17'=>'Fishing Node',
'18'=>'Summoning portal',
'19'=>'Mailbox',
'20'=>'Auction House',
'21'=>'Guardpost',
'22'=>'Spellcaster',
'23'=>'Meetingstone',
'24'=>'Flag Stand',
'25'=>'Fishing hole',
'26'=>'Flag drop',
'27'=>'Minigame',
'28'=>'Lottery Kiosk',
'29'=>'Capture point',
'30'=>'Aura Generator',
'31'=>'Dungeon Difficulty',
'32'=>'Barbershop Chair',
'33'=>'Destructable building',
'34'=>'Guild Bank'
);

// Players enums
$gReputationRank = array(
'0'=>'Hated',
'1'=>'Hostile',
'2'=>'Unfriendly',
'3'=>'Neutral',
'4'=>'Friendly',
'5'=>'Honored',
'6'=>'Revered',
'7'=>'Exalted',
);

$gGenderType = array(
'0'=>'Male',
'1'=>'Female',
);

$gFactionType = array(
'0'=>'Alliance',
'1'=>'Horde',
);

$gSkillRank = array(
 '1'=>'Apprentice',
 '2'=>'Journeyman',
 '3'=>'Expert',
 '4'=>'Artisan',
 '5'=>'Master',
 '6'=>'Grand Master'
);

$gCreatureRank=array(
'0'=>'Normal',
'1'=>'Rare',
'2'=>'Elite',
'3'=>'Boss',
'4'=>'World Boss',
);

$gCreatureFlags = array(
 '0'=>'Gossip',
 '1'=>'QuestGiver',
 '2'=>'Unk2',
 '3'=>'Unk3',
 '4'=>'Trainer',
 '5'=>'Class Trainer',
 '6'=>'Profession Trainer',
 '7'=>'Vendor',
 '8'=>'Vendor Ammo',
 '9'=>'Vendor Food',
'10'=>'Vendor Poison',
'11'=>'Vendor Reagent',
'12'=>'Repair',
'13'=>'Flightmaster',
'14'=>'Spirit Healer',
'15'=>'Spirit Guide',
'16'=>'Innkeeper',
'17'=>'Banker',
'18'=>'Petitioner',
'19'=>'Tabard Designer',
'20'=>'Battlemaster',
'21'=>'Auctioneer',
'22'=>'Stablemaster',
'23'=>'Guild Banker',
'24'=>'Spell Click',
'25'=>'Unk25',
'26'=>'Unk26',
'27'=>'Unk27',
'28'=>'Guard',
'29'=>'Unk29',
'30'=>'Unk30',
'31'=>'Unk31',
);

// Spells
$gSpellModsType = array(
'Damage/Healing',              // 0,
'Duration',                    // 1,
'Threat',                      // 2,
'Effect 1',                    // 3,
'Charges',                     // 4,
'Range',                       // 5,
'Radius',                      // 6,
'Critical Chance',             // 7,
'All Effects',                 // 8,
'Not Lose Casting Time',       // 9,
'Casting Time',                // 10,
'Cooldown',                    // 11,
'Effect 2',                    // 12,
'13',                          // spellmod 13 unused
'Power Cost',                  // 14,
'Crit Damage Bonus',           // 15,
'Resist/Miss Chance',          // 16,
'Extra Targets',               // 17,
'Chance of Success',           // 18,
'Activation Time',             // 19,
'Mod Damage Multipler',        // 20,
'Casting Time new',            // 21,
'DOT',                         // 22,
'Effect 3',                    // 23,
'Spell Damage/Healing bonus',  // 24,
'25',                          //
'26',                          // spellmod 25, 26 unused
'Multiple Value',              // 27,
'Resist Dispell'               // 28
);

$gRuneName = array(
'0'=>'Blood',
'1'=>'Unholy',
'2'=>'Frost',
'3'=>'Death'
);

$gSpellMechanic = array(
'0'=>'n/a',
'1'=>'Charmed',
'2'=>'Disoriented',
'3'=>'Disarmed',
'4'=>'Distracted',
'5'=>'Fleeing',
'6'=>'Clumsy',
'7'=>'Rooted',
'8'=>'Pacified',
'9'=>'Silenced',
'10'=>'Asleep',
'11'=>'Ensnared',
'12'=>'Stunned',
'13'=>'Frozen',
'14'=>'Incapacitated',
'15'=>'Bleeding',
'16'=>'Healing',
'17'=>'Polymorphed',
'18'=>'Banished',
'19'=>'Shielded',
'20'=>'Shackled',
'21'=>'Mounted',
'22'=>'Seduced',
'23'=>'Turned',
'24'=>'Horrified',
'25'=>'Invulnerable',
'26'=>'Interrupted',
'27'=>'Dazed',
'28'=>'Discovery',
'29'=>'Invulnerable',
'30'=>'Sapped',
'31'=>'Enraged'
);

$gDmgClass = array(
'0'=>'None',
'1'=>'Magic',
'2'=>'Melee',
'3'=>'Ranged'
);

$gSpellSchool = array(
'0'=>'Physical',
'1'=>'Holy',
'2'=>'Fire',
'3'=>'Nature',
'4'=>'Frost',
'5'=>'Shadow',
'6'=>'Arcane'
);

$gSpellPowerType = array(
'-1'=>'Health',
'0'=>'Mana',
'1'=>'Rage',
'2'=>'Focus',
'3'=>'Energy',
'4'=>'Happyness',
'6'=>'Runic power'
);

$gTargetsList = array(
'0'=>'Spell depend',     // 0x00000      0
'1'=>'Target 1',         // 0x00001      1
'2'=>'Target 2',         // 0x00002      2
'3'=>'Target 3',         // 0x00004      4
'4'=>'Target 4',         // 0x00008      8
'5'=>'Item',             // 0x00010     16
'6'=>'Source Location',  // 0x00020     32
'7'=>'Dest Location',    // 0x00040     64
'8'=>'Object unk',       // 0x00080    128
'9'=>'Target 9',         // 0x00100    256
'10'=>'PVP Corpse',      // 0x00200    512
'11'=>'Target 11',       // 0x00400   1024
'12'=>'Object',          // 0x00800   2048
'13'=>'Trade Item',      // 0x01000   4096
'14'=>'String',          // 0x02000   8192
'15'=>'Object',          // 0x04000  16384
'16'=>'Dead body',       // 0x08000  32768
'17'=>'Target 17'        // 0x10000  65536
);

$gRatingNames = array(
'1'=>'Weapon skill',
'2'=>'Defence skill',
'3'=>'Dodge',
'4'=>'Parry',
'5'=>'Block',
'6'=>'Melee hit',
'7'=>'Ranged hit',
'8'=>'Spell hit',
'9'=>'Melee crit',
'10'=>'Ranged crit',
'11'=>'Spell crit',
'12'=>'Melee hit taken',
'13'=>'Ranged hit taken',
'14'=>'Spell hit taken',
'15'=>'Melee crit taken',
'16'=>'Ranged crit taken',
'17'=>'Spell crit taken',
'18'=>'Melee haste',
'19'=>'Ranged haste',
'20'=>'Spell haste',
'18'=>'Weapon skill',
'19'=>'Ranged haste',
'20'=>'Spell haste',
'21'=>'Weapon skill mainhand',
'22'=>'Ranged skill offhand',
'23'=>'Spell skill renged',
'24'=>'Expertise',
'25'=>'Armor Penetration'
);

$game_text = array(
// Item tooltip
'meta_socket'=>'Meta Socket',
'red_socket'=>'Red Socket',
'yellow_socket'=>'Yellow Socket',
'blue_socket'=>'Blue Socket',
'charges'=>'%d Charges',
'min'=>'min',
'iarmor'=>' %d Armor',
'iblock'=>'%d Block',
'conjured_item'=>'Conjured Item',
'right_click'=>'Right Click to Open',
'unique'=>'Unique',
'slot'=>'%d Slot %s',
'weapon_damage'=>'%d - %d Damage',
'weapon_speed'=>'Speed %2.2f',
'weapon_dps'=>'(%2.2f damage per second)',
'ammo_dps'=>'Adds %2.2f damage per second',
'ilevel'=>'Item level: %d',
'iduration'=>'Duration: %s',
'idurationr'=>'Duration: %s (real time)',
'socket_bonus'=>'Socket Bonus: %s',
'random_enchant'=>'&lt;Random enchantment&gt;',
'prospectable'=>'Prospectable',
'millable'=>'Millable',
'ssd_req_level'=>'Requires level 1 to %d (%d)',
'durability'=>'Durability %d / %d',
'allowable_race'=>'Races:',
'allowable_class'=>'Classes:',
'req_level'=>'Requires Level %d',
'req_skill'=>'Requires %s (%d)',
'req_spell'=>'Requires',
'req_reputation'=>'Requires: %s - %s',
'req_ingridients'=>'Requires:',
'made_by'=>'Made by %s',
'start_quest'=>'This item start quest',

'entry'=>'Entry',
'locked'=>'Locked',
'faction'=>'Faction',
'go_type'=>'Type',

'npc_type'=>'Type',
'npc_rank'=>'Rank',
'npc_family'=>'Family',
'npc_level'=>'Level',
'npc_health'=>'Health',
'npc_mana'=>'Mana',
'npc_armor'=>'Armor',
'npc_damage'=>'Damage',
'npc_ap'=>'Attack Power',
'npc_attack'=>'Attack Time',
'display'=>'Display',
'displayA'=>'Display A',
'displayH'=>'Display H',
'npc_script'=>'Script',

'talent_rank'=>'Rank',
'talent_next_rank'=>'Next rank:',
'talent_req_points'=>'Require <num> points in <name> tree',

'other_faction'=>'Other',
'item_heroic'=>'Heroic',
);
?>