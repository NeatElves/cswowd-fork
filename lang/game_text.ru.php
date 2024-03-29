<?php
//
// Live search types
//

$ls_type_name = array(
'i'=>'Предмет',
'q'=>'Задание',
'n'=>'НИП',
'g'=>'Объект',
's'=>'Заклинание',
'f'=>'Фракция',
'a'=>'Местность',
'set'=>'Комплект'
);

//*************** Item enums ************************************
$UseorEquip = array(
'0'=>'Исп:',
'1'=>'Одета:',
'2'=>'Эффект при попадании:',
'3'=>'',
'4'=>'Soulstone:',
'5'=>'',
'6'=>'Изучить:'
);

$iBonus = array(
 '0'=>'%d к мане',             // ITEM_MOD_MANA      = 0,
 '1'=>'%d к здоровью',         // ITEM_MOD_HEALTH    = 1,
 '3'=>'%d к ловкости',         // ITEM_MOD_AGILITY   = 3,
 '4'=>'%d к силе',             // ITEM_MOD_STRENGTH  = 4,
 '5'=>'%d к интеллекту',       // ITEM_MOD_INTELLECT = 5,
 '6'=>'%d к духу',             // ITEM_MOD_SPIRIT    = 6,
 '7'=>'%d к выносливости',     // ITEM_MOD_STAMINA   = 7,
'12'=>'Одета: Рейтинг защиты +%d.',                           // ITEM_MOD_DEFENSE_SKILL_RATING     = 12,
'13'=>'Одета: Рейтинг уклонения +%d.',                        // ITEM_MOD_DODGE_RATING             = 13,
'14'=>'Одета: Рейтинг парирования +%d.',                      // ITEM_MOD_PARRY_RATING             = 14,
'15'=>'Одета: Рейтинг блокирования щитом +%d.',               // ITEM_MOD_BLOCK_RATING             = 15,
'16'=>'Одета: Увеличение рейтинга меткости оруж. ближнего боя +%d.',      // ITEM_MOD_HIT_MELEE_RATING         = 16,
'17'=>'Одета: Увеличение рейтинга меткости оруж. дальнего боя +%d.',      // ITEM_MOD_HIT_RANGED_RATING        = 17,
'18'=>'Одета: Увеличение рейтинга меткости (заклинания) +%d.',            // ITEM_MOD_HIT_SPELL_RATING         = 18,
'19'=>'Одета: Рейтинг крит. удара оруж. ближнего боя +%d.',   // ITEM_MOD_CRIT_MELEE_RATING        = 19,
'20'=>'Одета: Рейтинг крит. удара оруж. дальнего боя +%d.',   // ITEM_MOD_CRIT_RANGED_RATING       = 20,
'21'=>'Одета: Рейтинг критического удара (заклинания) +%d.',  // ITEM_MOD_CRIT_SPELL_RATING        = 21,
'22'=>'Одета: Melee hit taken by %d.',                        // ITEM_MOD_HIT_TAKEN_MELEE_RATING   = 22,
'23'=>'Одета: Ranged hit taken by %d.',                       // ITEM_MOD_HIT_TAKEN_RANGED_RATING  = 23,
'24'=>'Одета: Spell hit taken by %d.',                        // ITEM_MOD_HIT_TAKEN_SPELL_RATING   = 24,
'25'=>'Одета: Melee crit taken by %d.',                       // ITEM_MOD_CRIT_TAKEN_MELEE_RATING  = 25,
'26'=>'Одета: Ranged crit taken by %d.',                      // ITEM_MOD_CRIT_TAKEN_RANGED_RATING = 26,
'27'=>'Одета: Spell crit taken by %d.',                       // ITEM_MOD_CRIT_TAKEN_SPELL_RATING  = 27,
'28'=>'Одета: Melee haste by %d.',                            // ITEM_MOD_HASTE_MELEE_RATING       = 28,
'29'=>'Одета: Ranged haste by %d.',                           // ITEM_MOD_HASTE_RANGED_RATING      = 29,
'30'=>'Одета: Увеличивает рейтинг скорости на %d.',           // ITEM_MOD_HASTE_SPELL_RATING       = 30,
'31'=>'Одета: Рейтинг меткости +%d.',                         // ITEM_MOD_HIT_RATING               = 31,
'32'=>'Одета: Рейтинг критического удара +%d.',               // ITEM_MOD_CRIT_RATING              = 32,
'33'=>'Одета: Рейтинг уклонения от удара +%d.',               // ITEM_MOD_HIT_TAKEN_RATING         = 33,
'34'=>'Одета: Рейтинг уклонения от крит. удара +%d.',         // ITEM_MOD_CRIT_TAKEN_RATING        = 34,
'35'=>'Одета: Рейтинг устойчивости +%d.',                     // ITEM_MOD_RESILIENCE_RATING        = 35,
'36'=>'Одета: Рейтинг скорости +%d.',                         // ITEM_MOD_HASTE_RATING             = 36
'37'=>'Одета: Рейтинг мастерства +%d.',                       // ITEM_MOD_EXPERTISE_RATING         = 37
'38'=>'Одета: Увеличивает силу атаки на %d.',                 // ITEM_MOD_ATTACK_POWER             = 38
'39'=>'Одета: Увеличивает силу атаки дальнего боя на %d.',    // ITEM_MOD_RANGED_ATTACK_POWER      = 39
'40'=>'Одета: Increases attack power by %d in Cat, Bear, Dire Bear, and Moonkin forms only.',// ITEM_MOD_FERAL_ATTACK_POWER       = 40
'41'=>'Одета: Increases healing done by magical spells and effects by up to %d.',            // ITEM_MOD_SPELL_HEALING_DONE       = 41
'42'=>'Одета: Increases damage done by magical spells and effects by up to %d.',             // ITEM_MOD_SPELL_DAMAGE_DONE        = 42
'43'=>'Одета: Восполнение %d ед. маны раз в 5 секунд',        // ITEM_MOD_MANA_REGENERATION        = 43
'44'=>'Одета: Повышает рейтинг пробивания брони на %d.',      // ITEM_MOD_ARMOR_PENETRATION_RATING = 44
'45'=>'Одета: Увеличивает силу заклинаний на %d.',            // ITEM_MOD_SPELL_POWER              = 45
'46'=>'Одета: Восполнение %d ед. здоровья раз в 5 секунд',    // ITEM_MOD_HEALTH_REGEN             = 46
'47'=>'Одета: Увеличивает проникающую способность заклинаний на %d.',   // ITEM_MOD_SPELL_PENETRATION        = 47
'48'=>'Одета: Увеличивает показатель блокирования щита на %d.'// ITEM_MOD_BLOCK_VALUE              = 48
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
'10'=>'Кисти рук',
'11'=>'Палец',
'12'=>'Аксессуар',
'13'=>'Одноручное',
'14'=>'Щит',
'15'=>'Дальний бой',
'16'=>'Спина',
'17'=>'Двуручное',
'18'=>'Сумка',
'19'=>'Гербовая накидка',
'20'=>'Грудь',
'21'=>'Правая рука',
'22'=>'Держится в левой руке',
'23'=>'Левая рука',
'24'=>'Боеприпасы',
'25'=>'Метательное',
'26'=>'Дальний бой',
'27'=>'Колчан',
'28'=>'Реликвия',
'29'=>'Inventory types',
);

$itemClassSubclass = array(
'-1'=>'Все предметы',
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

'10'=>'Деньги',
'10.0'=>'Деньги (НЕ ИСП.)',

'11'=>'Амуниция',
'11.0'=>'Колчан(НЕ ИСП.)',
'11.1'=>'Колчан(НЕ ИСП.)',
'11.2'=>'Колчан',
'11.3'=>'Подсумок',

'12'=>'Задания',
'12.0'=>'Задания',

'13'=>'Ключи',
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
'-1'=>'Становится персональным при получении',
'0'=>'',
'1'=>'Становится персональным при получении',
'2'=>'Становится персональным при надевании',
'3'=>'Становится персональным при использовании',
'4'=>'Предмет, необходимый для задания',
'5'=>'Предмет, необходимый для задания',
);

$gStatType = array(
'-1'=>'Все',
'0'=>'Сила',
'1'=>'Ловкость',
'2'=>'Вынослив.',
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
'1'=>'%d к сопротивлению (Свет)',
'2'=>'%d к сопротивлению (Огонь)',
'3'=>'%d к сопротивлению (Природа)',
'4'=>'%d к сопротивлению (Лед)',
'5'=>'%d к сопротивлению (Тьма)',
'6'=>'%d к сопротивлению (Тайная магия)'
);

//Обьекты
$gameobjectType = array(
'0'=>'Дверь',
'1'=>'Кнопка',
'2'=>'Задание',
'3'=>'Контейнер',
'4'=>'Binder',
'5'=>'Общее',
'6'=>'Ловушка',
'7'=>'Мебель',
'8'=>'Спеллфокус',
'9'=>'Книга',
'10'=>'Общее',
'11'=>'Транспорт',
'12'=>'Areadamage',
'13'=>'Камера',
'14'=>'Объект карты',
'15'=>'Транспорт карты',
'16'=>'Арбитр дуэли',
'17'=>'Рыбалка, поплавок',
'18'=>'Summoning portal',
'19'=>'Почтовый ящик',
'20'=>'Аукционный дом',
'21'=>'Guardpost',
'22'=>'Spellcaster',
'23'=>'Камень встреч',
'24'=>'Flag Stand',
'25'=>'Рыбалка, лунка',
'26'=>'Flag drop',
'27'=>'Миниигра',
'28'=>'Киоск лотереи',
'29'=>'Capture point',
'30'=>'Генератор ауры',
'31'=>'Сложность подземелья',
'32'=>'Парикмахерская',
'33'=>'Разрушаемый объект',
'34'=>'Хранилище гильдии'
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
'0'=>'Муж.',
'1'=>'Жен.',
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
'0'=>'Обычный',
'1'=>'Элитный',
'2'=>'Редкий, элитный',
'3'=>'Босс',
'4'=>'Редкий',
);

$gCreatureFlags = array(
 '0'=>'Текст',
 '1'=>'Дает/Завершает задание',
 '2'=>'Unk1',
 '3'=>'Unk2',
 '4'=>'Тренер',
 '5'=>'Тренер класcа',
 '6'=>'Тренер профессии',
 '7'=>'Продавец',
 '8'=>'Продавец боеприпасов',
 '9'=>'Продавец еды',
'10'=>'Продавец ядов',
'11'=>'Продавец реагентов',
'12'=>'Ремонт',
'13'=>'Мастер полетов',
'14'=>'Целитель душ',
'15'=>'Хранитель душ',
'16'=>'Хозяин таверны',
'17'=>'Банкир',
'18'=>'Податель петиции',
'19'=>'Мастер накидок',
'20'=>'Распорядитель сражений',
'21'=>'Аукционер',
'22'=>'Хозяин стойл',
'23'=>'Guild Banker',
'24'=>'Spell Click',
'25'=>'Unk25',
'26'=>'Unk26',
'27'=>'Unk27',
'28'=>'Unk28',
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
'0'=>'Кровь',
'1'=>'Нечестивость',
'2'=>'Лед',
'3'=>'Смерть'
);

$gSpellMechanic = array(
'0'=>'н/а',
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
'0'=>'Нет',
'1'=>'Магический',
'2'=>'Ближний',
'3'=>'Дальний'
);

$gSpellSchool = array(
'0'=>'Физ. урон',
'1'=>'Света',
'2'=>'Огня',
'3'=>'Природы',
'4'=>'Льда',
'5'=>'Тёмная',
'6'=>'Тайная'
);

$gSpellPowerType = array(
'-1'=>'Здоровье',
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
'meta_socket'=>'особое гнездо',
'red_socket'=>'красное гнездо',
'yellow_socket'=>'желтое гнездо',
'blue_socket'=>'синее гнездо',
'charges'=>'%d Зарядов',
'min'=>'мин.',
'iarmor'=>'Броня: %d',
'iblock'=>'Блокирование: %d',
'conjured_item'=>'Сотворенный предмет',
'right_click'=>'<Щелкните правой кнопкой мыши, чтобы открыть.>',
'unique'=>'Уникальный',
'slot'=>'%d Слотов %s',
'weapon_damage'=>'Урон: %d - %d',
'weapon_speed'=>'Скорость %2.2f',
'weapon_dps'=>'(%2.2f ед. урона в секунду)',
'ammo_dps'=>'Добавляет %2.2f урона в секунду',
'ilevel'=>'Уровень предмета: %d',
'iduration'=>'Исчезнет через %s',
'idurationr'=>'Исчезнет через %s (реальном времени)',
'socket_bonus'=>'При соответствии цвета: %s',
'random_enchant'=>'&lt;Случайный бонус&gt;',
'prospectable'=>'Просеиваемое',
'millable'=>'Можно растолочь',
'ssd_req_level'=>'Требуемый уровень: 1 - %d (%d)',
'durability'=>'Прочность %d / %d',
'allowable_race'=>'Раса:',
'allowable_class'=>'Класс:',
'req_level'=>'Требуется уровень: %d',
'req_skill'=>'Требует %s (%d)',
'req_spell'=>'Требует',
'req_reputation'=>'Требуется: %s - %s',
'req_ingridients'=>'Необходимо:',
'made_by'=>'Сделано %s',
'start_quest'=>'Этот предмет позволяет получить задание.',

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
'display1'=>'Модель 1',
'display2'=>'Модель 2',
'display3'=>'Модель 3',
'display4'=>'Модель 4',
'npc_script'=>'Скрипт',

'talent_rank'=>'Ранг',
'talent_next_rank'=>'Следующий ранг:',
'talent_req_points'=>'Требует <num> талант(ов) в ветке <name>',

'other_faction'=>'Остальные',
'item_heroic'=>'Героический',
);
?>
