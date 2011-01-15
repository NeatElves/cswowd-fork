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
'0'=>'Исп:',
'1'=>'Одета:',
'2'=>'Шанс при ударе:',
'4'=>'Soulstone:',
'5'=>'',
'6'=>'Изучить:'
);

$iBonus = array(
 '0'=>'%d Маны',             // ITEM_MOD_MANA      = 0,
 '1'=>'%d Здоровья',         // ITEM_MOD_HEALTH    = 1,
 '3'=>'%d Ловкости',         // ITEM_MOD_AGILITY   = 3,
 '4'=>'%d Силы',             // ITEM_MOD_STRENGTH  = 4,
 '5'=>'%d Интеллекта',       // ITEM_MOD_INTELLECT = 5,
 '6'=>'%d Духа',             // ITEM_MOD_SPIRIT    = 6,
 '7'=>'%d Выносливости',     // ITEM_MOD_STAMINA   = 7,
'12'=>'Одета: Увеличение рейтинга защиты на %d.',             // ITEM_MOD_DEFENSE_SKILL_RATING     = 12,
'13'=>'Одета: Увеличение рейтинга уворачивания на %d.',       // ITEM_MOD_DODGE_RATING             = 13,
'14'=>'Одета: Увеличение рейтинга парирования на %d.',        // ITEM_MOD_PARRY_RATING             = 14,
'15'=>'Одета: Увеличение рейтинга блокирования на %d.',       // ITEM_MOD_BLOCK_RATING             = 15,
'16'=>'Одета: Increases melee hit raiting by %d.',            // ITEM_MOD_HIT_MELEE_RATING         = 16,
'17'=>'Одета: Increases ranged hit raiting by %d.',           // ITEM_MOD_HIT_RANGED_RATING        = 17,
'18'=>'Одета: Increases spell hit raiting by %d.',            // ITEM_MOD_HIT_SPELL_RATING         = 18,
'19'=>'Одета: Improves melee critical strike rating by %d.',  // ITEM_MOD_CRIT_MELEE_RATING        = 19,
'20'=>'Одета: Improves ranged critical strike rating by %d.', // ITEM_MOD_CRIT_RANGED_RATING       = 20,
'21'=>'Одета: Improves spell critical strike rating by %d.',  // ITEM_MOD_CRIT_SPELL_RATING        = 21,
'22'=>'Одета: Melee hit taken by %d.',                        // ITEM_MOD_HIT_TAKEN_MELEE_RATING   = 22,
'23'=>'Одета: Ranged hit taken by %d.',                       // ITEM_MOD_HIT_TAKEN_RANGED_RATING  = 23,
'24'=>'Одета: Spell hit taken by %d.',                        // ITEM_MOD_HIT_TAKEN_SPELL_RATING   = 24,
'25'=>'Одета: Melee crit taken by %d.',                       // ITEM_MOD_CRIT_TAKEN_MELEE_RATING  = 25,
'26'=>'Одета: Ranged crit taken by %d.',                      // ITEM_MOD_CRIT_TAKEN_RANGED_RATING = 26,
'27'=>'Одета: Spell crit taken by %d.',                       // ITEM_MOD_CRIT_TAKEN_SPELL_RATING  = 27,
'28'=>'Одета: Melee haste by %d.',                            // ITEM_MOD_HASTE_MELEE_RATING       = 28,
'29'=>'Одета: Ranged haste by %d.',                           // ITEM_MOD_HASTE_RANGED_RATING      = 29,
'30'=>'Одета: Spell haste by %d.',                            // ITEM_MOD_HASTE_SPELL_RATING       = 30,
'31'=>'Одета: Рейтинг меткости +%d.',                         // ITEM_MOD_HIT_RATING               = 31,
'32'=>'Одета: Рейтинг критического удара +%d.',               // ITEM_MOD_CRIT_RATING              = 32,
'33'=>'Одета: Hit taken by %d.',                              // ITEM_MOD_HIT_TAKEN_RATING         = 33,
'34'=>'Одета: Crit taken by %d.',                             // ITEM_MOD_CRIT_TAKEN_RATING        = 34,
'35'=>'Одета: Рейтинг устойчивости %d.',                      // ITEM_MOD_RESILIENCE_RATING        = 35,
'36'=>'Одета: Рейтинг скорости +%d.',                         // ITEM_MOD_HASTE_RATING             = 36
'37'=>'Одета: Increases your expertise rating by %d.',        // ITEM_MOD_EXPERTISE_RATING         = 37
'38'=>'Одета: Сила атаки увеличена на %d.',                   // ITEM_MOD_ATTACK_POWER             = 38
'39'=>'Одета: Increases ranged attack power by %d.',          // ITEM_MOD_RANGED_ATTACK_POWER      = 39
'40'=>'Одета: Increases attack power by %d in Cat, Bear, Dire Bear, and Moonkin forms only.',// ITEM_MOD_FERAL_ATTACK_POWER       = 40
'41'=>'Одета: Increases healing done by magical spells and effects by up to %d.',            // ITEM_MOD_SPELL_HEALING_DONE       = 41
'42'=>'Одета: Increases damage done by magical spells and effects by up to %d.',             // ITEM_MOD_SPELL_DAMAGE_DONE        = 42
'43'=>'Одета: Восполнение %d ед. маны в 5 секунд',            // ITEM_MOD_MANA_REGENERATION        = 43
'44'=>'Одета: Increases your armor penetration rating by %d.',// ITEM_MOD_ARMOR_PENETRATION_RATING = 44
'45'=>'Одета: Увеличивает силу заклинаний на %d.'             // ITEM_MOD_SPELL_POWER              = 45
);

$gInventoryType = array(
'0'=>'Все типы',
'1'=>'Голова',
'2'=>'Шея',
'3'=>'Плечи',
'4'=>'Рубашка',
'5'=>'Грудь',
'6'=>'Пояс',
'7'=>'Ноги',
'8'=>'Ступни',
'9'=>'Запястья',
'10'=>'Кисть руки',
'11'=>'Кольца',
'12'=>'Ожерелья',
'13'=>'Одноручный',
'14'=>'Щиты',
'15'=>'Ranged',
'16'=>'Спина',
'17'=>'Двуручный',
'18'=>'Сумки',
'19'=>'Гербовая накидка',
'20'=>'Robe',
'21'=>'Основная рука',
'22'=>'Держится в левой руке',
'23'=>'Левая рука',
'24'=>'Снаряды',
'25'=>'Метательное оружие',
'26'=>'Ranged',
'27'=>'Колчан',
'28'=>'Реликвия',
'29'=>'Inventory types',
);

$itemClassSubclass = array(
'-1'=>'Все вещи',
'0'=>'Расходуемые',
'0.0'=>'Расходуемые',
'0.1'=>'Зелье',
'0.2'=>'Эликсир',
'0.3'=>'Фляга',
'0.4'=>'Свиток',
'0.5'=>'Еда и напитки',
'0.6'=>'Улучшения',
'0.7'=>'Бинты',
'0.8'=>'Другое',

'1'=>'Сумки',
'1.0'=>'Сумка',
'1.1'=>'Сумка душ',
'1.2'=>'Сумка травника',
'1.3'=>'Сумка зачаровывателя',
'1.4'=>'Сумка инженера',
'1.5'=>'Сумка ювелира',
'1.6'=>'Шахтерская сумка',
'1.7'=>'Сумка кожевника',
'1.8'=>'Сумка начертателя',

'2'=>'Оружие',
'2.0'=>'Топор:Одноручные топоры',
'2.1'=>'Топор:Двуручные топоры',
'2.2'=>'Лук:Луки',
'2.3'=>'Огнестрельное:Огнестрельное',
'2.4'=>'Ударное:Одноручное ударное',
'2.5'=>'Ударное:Двуручное ударное',
'2.6'=>'Древковое:Древковое',
'2.7'=>'Меч:Одноручные мечи',
'2.8'=>'Меч:Двуручные мечи',
'2.9'=>'Устаревшие',
'2.10'=>'Посох:Посохи',
'2.11'=>'Экзотическое:Одноручное экзотическое',
'2.12'=>'Экзотическое:Двуручное экзотическое',
'2.13'=>'Кистевое:Кистевое',
'2.14'=>'Разное',
'2.15'=>'Кинжал:Кинжалы',
'2.16'=>'Метательное:Метательное',
'2.17'=>'Копье:Копья',
'2.18'=>'Арбалет:Арбалеты',
'2.19'=>'Жезл:Жезлы',
'2.20'=>'Удочка:Удочки',

'3'=>'Самоцветы',
'3.0'=>'Красные',
'3.1'=>'Синие',
'3.2'=>'Желтые',
'3.3'=>'Фиолетовые',
'3.4'=>'Зеленые',
'3.5'=>'Оранжевые',
'3.6'=>'Особые',
'3.7'=>'Простые',
'3.8'=>'Радужные',

'4'=>'Доспехи',
'4.0'=>'Разное',
'4.1'=>'Ткань:Тканевые',
'4.2'=>'Кожа:Кожаные',
'4.3'=>'Кольчуга:Кольчужные',
'4.4'=>'Латы:Латные',
'4.5'=>'Кулачный щит(НЕ ИСП.)_:Кулачные щиты',
'4.6'=>'Щит:Щиты',
'4.7'=>'Манускрипт:Манускрипты',
'4.8'=>'Идол:Идолы',
'4.9'=>'Тотем:Тотемы',
'4.10'=>'Печать:Печать',

'5'=>'Реагенты',
'5.0'=>'Реагент',

'6'=>'Боеприпасы',
'6.0'=>'Жезл(НЕ ИСП.)',
'6.1'=>'Болт(НЕ ИСП.)',
'6.2'=>'Стрелы',
'6.3'=>'Пули',
'6.4'=>'Метательное(НЕ ИСП.)',

'7'=>'Хозяйственные товары',
'7.0'=>'Хозяйственные товары',
'7.1'=>'Детали',
'7.2'=>'Взрывчатка',
'7.3'=>'Устройства',
'7.4'=>'Ювелирное дело',
'7.5'=>'Ткань',
'7.6'=>'Кожа',
'7.7'=>'Металл и камень',
'7.8'=>'Мясо',
'7.9'=>'Трава',
'7.10'=>'Стихии',
'7.11'=>'Другое',
'7.12'=>'Зачаровывание',
'7.13'=>'Материалы',
'7.14'=>'Чары для доспехов:Чары для доспехов',
'7.15'=>'Чары для оружия:Чары для оружия',

'8'=>'Стандартные(НЕ ИСП.)',
'8.0'=>'Стандартный(НЕ ИСП.)',

'9'=>'Рецепты',
'9.0'=>'Книга',
'9.1'=>'Кожевничество',
'9.2'=>'Портняжное дело',
'9.3'=>'Инженерное дело',
'9.4'=>'Кузнечное дело',
'9.5'=>'Кулинария',
'9.6'=>'Алхимия',
'9.7'=>'Первая помощь',
'9.8'=>'Зачаровывание',
'9.9'=>'Рыбная ловля',
'9.10'=>'Ювелирное дело',

'10'=>'Деньги(НЕ ИСП.)',
'10.0'=>'Деньги (НЕ ИСП.)',

'11'=>'Амуниция',
'11.0'=>'Колчан(НЕ ИСП.)',
'11.1'=>'Колчан(НЕ ИСП.)',
'11.2'=>'Колчан',
'11.3'=>'Подсумок',

'12'=>'Задания',
'12.0'=>'Задания',

'13'=>'Ключи и Отмычки',
'13.0'=>'Ключ',
'13.1'=>'Отмычка',

'14'=>'Постоянные(НЕ ИСП.)',
'14.0'=>'Постоянные',

'15'=>'Разное',
'15.0'=>'Хлам',
'15.1'=>'Реагенты',
'15.2'=>'Питомцы',
'15.3'=>'Праздничные предметы',
'15.4'=>'Другое',
'15.5'=>'Верховые животные:Верховые животные',

'16'=>'Символы',
'16.1'=>'Воин',
'16.2'=>'Паладин',
'16.3'=>'Охотник',
'16.4'=>'Разбойник',
'16.5'=>'Жрец',
'16.6'=>'Рыцарь смерти',
'16.7'=>'Шаман',
'16.8'=>'Маг',
'16.9'=>'Чернокнижник',
'16.11'=>'Друид'
);

$gBonding = array(
'-1'=>'Именная',
'0'=>'',
'1'=>'Становится персональным при поднятии',
'2'=>'Становится персональным при надевании',
'3'=>'Становится персональным при использовании',
'4'=>'Предмет, необходимый для задания',
'5'=>'Предмет, необходимый для задания 1',
);

$gStatType = array(
'-1'=>'Все',
'0'=>'Сила',
'1'=>'Ловкость',
'2'=>'Выносливость',
'3'=>'Интеллект',
'4'=>'Дух'
);

$gResistance = array(
'0'=>'Броня',
'1'=>'Сопротивление святой магии',
'2'=>'Сопротивление огненной магии',
'3'=>'Сопротивление природной магии',
'4'=>'Сопротивление ледяной магии',
'5'=>'Сопротивление тёмной магии',
'6'=>'Сопротивление тайной магии'
);

$gResistanceType = array(
'0'=>'%d Брони',
'1'=>'%d Holy Resistance',
'2'=>'%d Fire Resistance',
'3'=>'%d Nature Resistance',
'4'=>'%d Frost Resistance',
'5'=>'%d Shadow Resistance',
'6'=>'%d Arcane Resistance'
);

//Обьекты
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

// Игроки
$gReputationRank = array(
'0'=>'Ненависть',
'1'=>'Враждебность',
'2'=>'Неприязнь',
'3'=>'Равнодушие',
'4'=>'Дружелюбие',
'5'=>'Уважение',
'6'=>'Почтение',
'7'=>'Превознесение',
);

$GenderType = array(
'0'=>'Male',
'1'=>'Female',
);

$FactionType = array(
'0'=>'Альянс',
'1'=>'Орда',
);

$gSkillRank = array(
 '1'=>'Ученик',
 '2'=>'Подмастерье',
 '3'=>'Умелец',
 '4'=>'Искусник',
 '5'=>'Мастер',
 '6'=>'Гранд Мастер'
);

$gCreatureRank=array(
'0'=>'Normal',
'1'=>'Элитный',
'2'=>'Редкий, элитный',
'3'=>'Мировой босс',
'4'=>'Редкий',
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
'1'=>'Подчинение',
'2'=>'Дезориентация',
'3'=>'Без оружия',
'4'=>'Отвлечение',
'5'=>'Паника',
'6'=>'Неуклюжесть',
'7'=>'Оплетение',
'8'=>'Покой',
'9'=>'Немота',
'10'=>'Сон',
'11'=>'В ловушке',
'12'=>'Оглушение',
'13'=>'Заморозка',
'14'=>'Паралич',
'15'=>'Кровотечение',
'16'=>'Лечение',
'17'=>'Превращение',
'18'=>'Изгнание',
'19'=>'Защита',
'20'=>'Оковы',
'21'=>'Верхом',
'22'=>'Обольщение',
'23'=>'Обращение',
'24'=>'Ужас',
'25'=>'Неуязвимость',
'26'=>'Прерывание',
'27'=>'Замедление',
'28'=>'Открытие',
'29'=>'Неуязвимость',
'30'=>'Ошеломление',
'31'=>'Исступление'
);

$gDmgClass = array(
'0'=>'None',
'1'=>'Magic',
'2'=>'Melee',
'3'=>'Ranged'
);

$gSpellSchool = array(
'0'=>'Physical',
'1'=>'Света',
'2'=>'Огня',
'3'=>'Природы',
'4'=>'Льда',
'5'=>'Тёмная',
'6'=>'Тайная'
);

$gSpellPowerType = array(
'-1'=>'Health',
'0'=>'Мана',
'1'=>'Ярость',
'2'=>'Тонус',
'3'=>'Энергия',
'4'=>'Настроение',
'6'=>'Руны'
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
'meta_socket'=>'Мета оправа',
'red_socket'=>'Красная оправа',
'yellow_socket'=>'Жёлтая оправа',
'blue_socket'=>'Синяя оправа',
'charges'=>'%d Зарядов',
'min'=>'мин.',
'conjured_item'=>'Сотворенный предмет',
'right_click'=>'<Щелкните правой кнопкой мыши, чтобы открыть.>',
'unique'=>'Уникальный',
'slot'=>'%d Слотов %s',
'weapon_damage'=>'%d - %d Урона',
'weapon_speed'=>'Скорость %2.2f',
'weapon_dps'=>'(%2.2f Единиц урона в секунду)',
'ammo_dps'=>'Добавляет %2.2f урона в секунду',
'ilevel'=>'Уровень предмета: %d',
'iduration'=>'Исчезнет через %s',
'idurationr'=>'Исчезнет через %s (реального времени)',
'socket_bonus'=>'Бонус оправы: %s',
'random_enchant'=>'&lt;Случайный бонус&gt;',
'prospectable'=>'Prospectable',
'millable'=>'Millable',
'ssd_req_level'=>'Необходим уровень 1 - %d (%d)',
'durability'=>'Прочность %d / %d',
'allowable_race'=>'Раса:',
'allowable_class'=>'Класс:',
'req_level'=>'Необходим %d уровень',
'req_skill'=>'Требует %s (%d)',
'req_spell'=>'Требует',
'req_reputation'=>'Требует: %s - %s',
'req_ingridients'=>'Нужно:',
'made_by'=>'Сделано %s',
'start_quest'=>'Вещь начинает квест',

'entry'=>'Номер',
'locked'=>'Заперто',
'faction'=>'Фракция',
'go_type'=>'Тип объекта',

'npc_type'=>'Тип',
'npc_rank'=>'Ранг',
'npc_family'=>'Подвид',
'npc_level'=>'Уровень',
'npc_health'=>'Здоровье',
'npc_mana'=>'Мана',
'npc_armor'=>'Броня',
'npc_damage'=>'Урон',
'npc_ap'=>'Сила атаки',
'npc_attack'=>'Задержка атаки',
'display'=>'Модель',
'displayA'=>'Модель A',
'displayH'=>'Модель H',
'npc_script'=>'Скрипт',

'talent_rank'=>'Ранг',
'talent_next_rank'=>'Следующий ранг:',
'talent_req_points'=>'Требует <num> талант(ов) в ветке <name>',

'other_faction'=>'Остальные',
'item_heroic'=>'Героический',
);
?>
