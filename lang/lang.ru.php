<?php
/*
 * Потдержка русского языка сайтом
 */
$lang = array(
'search_database' => 'Поиск в базе',
'find' => 'Найти',
'main'=> 'Главная',

# Search
'search_results'    => 'Результаты поиска',
'found'             => 'Найдено',
'not_found'         => 'Не найдено',
'go_not_found'      => 'Обьект не найден',
'creature_not_found'=> 'Существо не найдено',
'item_not_found'    => 'Вещь не найдена',
'quest_not_found'   => 'Квест не найден',
'spell_not_found'   => 'Спелл не найден',
'search_item_req'   => 'Запрос на поиск вещи',
'search_set_req'    => 'Запрос на поиск набора',
'search_faction_req'=> 'Запрос на поиск фракции',
'search_npc_req'    => 'Запрос на поиск НПС',
'search_quest_req'  => 'Запрос на поиск квеста',
'search_go_req'     => 'Запрос на поиск ГО',
'search_spell_req'  => 'Запрос на поиск Спелла',
'search_area_req'   => 'Запрос на поиск Зон',

# Item report
'item_name' => 'Имя вещи',
'item_level' => 'lvl',
'item_req_level' => 'Req lvl',
'item_gem_details' => 'Свойства камня',
'item_armor' => 'Броня',
'item_block' => 'Блок',
'item_dps' => 'DPS',
'item_speed' => 'Скорость',
'item_slot_num' => 'Слотов',
'item_desc' => 'Описание',
'item_type' => 'Тип',
'item_slot' => 'Слот',
'item_spells' => 'Спеллы',
'item_faction_rank'=> 'Требует репутации',

# Vendor report
'item_cost'  => 'Цена',
'item_count' => 'Кол-во',
'item_incrtime' => 'Поставка',

# Quest report
'quest_lvl'=>'lvl',
'quest_reqlvl'=>'Req level',
'quest_name'=>'Название квеста',
'quest_giver'=>'Выдаёт',
'quest_rewards'=>'Награды',

# Spell report
'spell_level' => 'lvl',
'spell_name' => 'Имя спелла',
'spell_skill' => 'Ветка',
'spell_power' => 'Power',
'spell_range' => 'Дальность',
'spell_school' => 'Школа',
'spell_reagent' => 'Реагенты',
'spell_create' => 'Создаёт',

# Trainer report
'trainer_cost' =>'Цена',
'trainer_spell'=>'Спелл',
'trainer_skill'=>'Нужно знать',
'trainer_value'=>'Навык',
'trainer_level'=>'Req lvl',

# GO report
'go_name' => 'Название',
'go_type' => 'Тип',
'map' => 'Карта',

# Creature report
'creature_level' => 'lvl',
'creature_name'  => 'Имя существа',
'creature_react' => 'Отношение',
'creature_role'  => 'Назначение',

# Loot report
'loot_chance' =>'Шанс',
'loot_require'=>'Требования',
'loot_count'=>  'Кол-во',

# On kill reputation
'onkill_rep' => 'Репутация',

# Random suffix report
'rand_enchant_id'     => 'id',
'rand_enchant_name'   => 'Тип',
'rand_enchant_details'=> 'Дополнительно',

# Lock report
'lock_id'   => 'id',
'lock_keys' => 'Ключи',

# Extend cost report
'excost_id'   => 'id',
'excost_cost' => 'Цена',
'excost_items'=> 'Вещи',

# Item set report
'set_id'   => 'id',
'set_name' => 'Название',
'set_items'=> 'Вещи',
'set_spells'=> 'Спеллы',
'set_class' => 'Класс',
'set_level' => 'Уровень',

# Faction report
'faction_id' => 'id',
'faction_name' => 'Название',
'faction_details' => 'Описание',

# Enchants report
'enchant_id'   => 'id',
'enchant_name' => 'Описание',

# Zones report
'zone_id'   => 'id',
'zone_name' => 'Название',

#Area Teleport
'at_id'  => 'id',
'at_name'=> 'Название',
'at_req' => 'Требования',

// Details (spell, go, npc)
'detail_info' => 'Детальная информация',

//Page
'page' => 'Страница',
'back' => 'Назад',
'next' => 'Дальше',
'go' => 'Вперед',
'compressed' => 'На главную',

'sell_price' => 'Цена за продажу',
'buy_price' => 'Цена за покупку',

// GO, NPC info
'show_map' => 'На карте',
'money' => 'Деньги',
'sold'  => 'Продаёт вещи',
'train' => 'Обучает',
'go_locked' => 'Объект заперт',
'go_cast_spell' => 'Кастует спеллы',
'go_summoned_by' => 'Может быть призван спеллом',
'npc_spell_train' => 'Спеллу обучают:',
'quest_spell_train' => 'Спеллу обучают за квест:',
'req_for_quest' => 'Требуется для квеста',
'kill_kredit_group' => 'Группа',
'give_quest' => 'Даёт квесты',
'take_quest' => 'Принимает квесты',
'give_skin'  => 'Можно снять шкуру',
'can_pickpocketing' => 'Можно украсть...',
'can_loot'  => 'Выпадает вещей',
'cast_spells' => 'Кастует спеллы...',
'summoned_by_spell' => 'Призван спеллом',

'id'  => 'id',
'item_list' => 'Вещи',
'reqirement' => 'Требование',
'drop' => 'Дроп',
'level' => 'Уровень',

#Loot info
'loot_details'      => 'Подробнее...',
'contain_prospecting_loot' => 'Очистка этой руды даст:',
'contain_milling_loot'     => 'Растолочь это даст:',
'contain_fishing_loot'     => 'Рыбалка:',
'contain_disenchant_loot'  => 'Дизэнчант вещи даст:',
'item_uses_spell'   => 'Вещи использующие спелл',
'item_use_in_spell' => 'Используется спеллом:',
'create_from_spell' => 'Создана спеллом',
'loot_from_spell'   => 'Получена спеллом',
'prospecting_loot'  => 'Очищено с руды',
'milling_loot'      => 'Размолото из растений',

//'item_loot'         => '(Вещи) Падает с...',
'item_contain_loot' => '(Вещи) Можно извлечь...',
'disenchant_loot'   => '(Вещи) Дизэнчант из:',
'pickpocketing_loot'=> 'Украдено у...',
'skinning_loot'     => 'Ошкурено с...',
'fishing_loot'      => 'Выловить в...',
'quest_reward_loot' => 'Получено за квест',
'quest_req_loot'    => 'Требуется для квеста',
'quest_src_loot'    => 'Выдают с квестом',
'quest_mail_loot'   => 'От квеста',
'npc_sold_loot'     => 'Продают...',
'drop_loot'         => 'Падает с...',
'go_drop_loot'      => 'Получено из ...',
'item_lock_loot'    => 'Извлечь из...',
'locked_item'       => 'Заперто:',
'can_unlock'        => 'Является ключём для:',
'locked_list'       => 'Список',
'no_found'          => 'не найдено',
'recipe_for'        => 'Рецепт для создания',
'random_enchants'   => 'Рандом энчанты',
'random_enc_name'   => 'Расширеное имя',
'random_enc_info'   => 'Подробности',
'random_enc_cnance' => 'Шанс %',
'no_name'           => 'без имени',

'anything' => '- Любая -',
'this_item_part_of_set' => 'Эта вещь часть набора',
'item_is_ex_cost'   => 'Можно обменять на:',

// Quest info
'one_of_this_items' => 'Одна из этих вещей',
'obtained_at_level' => 'Доступен с уровня',
'quest_level' => 'Уровень квеста:',
'provided' => 'Выдается:',
'provided_desc' => 'Эта вещь выдается когда принят квест.',
'this_quest_is_part_of_a_series' => 'Этот квест часть серии',
'start' => 'Начинает квест',
'end_q' => 'Принимает квест',
'q_next' => 'Следующий:',
'q_prev' => 'Предыдущий:',
'players_with_this_quest'=>'Игроков выполняющих квест',
'players_completed_quest'=>'Игроков выполнивших квест',
'kill' => 'Убить:',
'cast' => 'Каст:',
'cast_on' => 'на',
'use'  => 'Исп:',
'collect' => 'Собрать:',
'req_items' => 'Потребуется:',
'Rew_money' => 'Деньги:',
'Rew_XP' => 'Опыт:',
'Rew_reputation' => 'Репутация:',
'cast_spell' => 'Скастуют:',
'learn_spell' => 'Обучат спеллу:',
'Rew_item'  => 'Вещи:',
'item_sel_and' => '&nbsp;+&nbsp;',
'item_sel_or' => '&nbsp;или&nbsp;',
'Rew_select_item'  => 'Вещи на выбор:',
'req_for_quest'    => 'Требуется для:',
'additional_info'  => 'Дополнительная информация',

# Spell info
'spell_casted_by' => 'Кастуют мобы:',
'spell_reagents' => 'Реагенты для спелла:',
'spell_req_focus' => 'Требует: %s',
'spell_req_totem' => 'Инструмент: %s',
'spell_learned_by_recipe' => 'Можно выучить свитком:',
'spell_contain_loot' => 'Получены вещи:',
'spell_trigger' => 'Стартует от спелла:',
'spell_added_by_enchant' => 'Добавляется энчантом:',
'spell_added_by_set' => 'Добавляется коллекцией',
'spell_affected_by' => 'Может быть улучшен спеллом:',
'spell_used_by_glyph' => 'Используется символом:',
'spell_talent' => 'Спелл является талантом',
'spell_go_cast' => 'Кастуется объектом',

#Enchant info
'enchant_by_spell' => 'Зачарован от спелла',
'enchant_by_gems'  => 'Зачарован от Камня',
'enchant_by_socket'=> 'Бонус ячеек',
'enchant_by_rand_prop'=>'Случайное свойство',
'enchant_by_rand_suff'=>'Случайное дополнение',

#Faction info
'faction_contain' =>'Состоит из',
'faction_in'     => 'Входит в состав',
'faction_npc' => 'Входят существа',
'faction_go' => 'Входят ГО',
'faction_item' => 'Вещи требующие репутации',
'faction_quest_rew' => 'Награда за квест',
'faction_kill_rew'=> 'Награда за убийство',
'faction_spell_rew'=>'Получена от спелла',

#Zone info
'zone_parent'=>'Часть зоны',
'zone_subzones'=>'Субзоны',
'zone_npc_in'=>  'Существа в зоне',
'zone_go_in' =>  'ГО в зоне',
'zone_fishing_in' => 'Рыбалка',

#Show map
'map_areas'=>'Зоны',
'map_maps'=>'Карты',
'map_gps'=>'GPS',
'map_no_found'=>'Не найдено',

# TOP 100
'top_money_header' => 'Богатейшие игроки',
'top_honor_header' => 'Сильнейшие игроки',
'top_arena_header' => 'Сильнейшие команды Арены %d',

'arena_team_name' => 'Название',
'arena_rating' => 'Рейтинг',
'arena_team' => 'Состав',

# Item owners
'owner_list'     => 'Владельцев таких вещей: %d',
'owner_no_found' => 'Владельцы не найденно',

# Online list
'online_players'    => ' игроков онлайн',
'online_no_players' => 'Нет игроков онлайн',

# PLAYER list
'player_name'  => 'Имя',
'player_level' => 'lvl',
'player_race'  => 'Раса',
'player_class' => 'Класс',
'player_zone'  => 'Зона',
'player_money' => 'Деньги',
'player_honor' => 'Хонор',
'player_kills' => 'Убил',
'last_login'   => 'Последний визит',
'online'       => 'Онлайн',

# Auction
'auction_seller' => 'Продавец',
'auction_cost'   => 'Стоимость',
'auction_bye'    => 'Выкупили',

# Guilds
'guild_list'   => 'Гильдии - ',
'guild_name'   => 'Название',
'guild_leader' => 'Лидер',
'guild_create' => 'Создана',
'guild_members'=> 'Состав',
'guild_create_at'=> 'Создана:',
'guild_money'  => 'Деньги:',
'guild_rank'   => 'Ранг',
'guild_note'   => 'Инфо',
'guild_noexist'=> 'Гильдий нет',

# Arenateams
'arena_this_week' => 'Эта неделя',
'arena_total_stat'=> 'Общая статистика',
'arena_played'    => 'Сыграно',
'arena_wins'      => 'Выиграли',
'arena_lose'      => 'Проиграли',
'arena_win_pct'   => 'Процент побед',
'arena_week_games'=> 'Игр за неделю',
'arena_season_games' => 'Игр за сезон',
'arena_team_leader'   => 'Капитан команды',
'arena_members_count' => 'Игроков в составе',

# Registration
'reg_name' => 'Имя',
'reg_password' => 'Пароль',
'reg_register' => 'Регистрация',
'reg_ok_register' => 'Регистрация',
'reg_err_db' => '<br>Ошибка базы данных<br>',
'reg_err_one_ip' => '<br>Нельзя создавать больше одной записи с этого IP<br>',
'reg_err_name_pass' => '<br>Укажите имя и пароль<br>',
'reg_err_name_size' => '<br>Имя должно быть от 3 до 16 символов<br>',
'reg_err_pass_size' => '<br>Пароль должен быть от 3 до 16 символов<br>',
'reg_err_charset' => '<br>Недопустимые символы<br>',
'reg_err_name_in_use' => '<br>Имя уже используется<br>',
'reg_err_name_is_pass' => '<br>Пароль не должен быть похож на имя<br>',
'reg_err_mail' => '<br>Введите правильно ваш почтовый адрес<br>',
'reg_success' => '<br>Регистрация успешна<br>',
'reg_err_query' => '<br>Ошибка запроса<br>',

# Armory
'player_reputation'  => 'Репутация персонажа',
'player_skills'      => 'Навыки персонажа',
'player_talents'     => 'Таланты персонажа',
'player_talent_calc' => 'Ссылка в калькулятор талантов',
'player_active_quest'=> 'Активные квесты',
'player_page_base'   =>'Base Stats',
'player_page_defence'=>'Защита',
'player_armor'    => 'Броня:',
'player_defence'  => 'Защита:',
'player_dodge'    => 'Уворот:',
'player_parry'    => 'Парирование:',
'player_block'    => 'Блок:',
'player_recilence'=> 'Устойчивость:',
'player_melee'    => 'Ближний бой',
'player_m_skill'  => 'Weapon skill:',
'player_m_damage' => 'Урон:',
'player_m_speed'  => 'Скорость:',
'player_m_power'  => 'Сила:',
'player_m_hit'    => 'Hit Raiting:',
'player_m_crit'   => 'Шанс крита:',
'player_ranged'   => 'Дальний бой',
'player_r_skill'  => 'Weapon skill:',
'player_r_damage' => 'Урон:',
'player_r_speed'  => 'Скорость:',
'player_r_power'  => 'Сила:',
'player_r_hit'    => 'Hit Raiting:',
'player_r_crit'   => 'Шанс крита:',
'player_spell'    => 'Спеллы',
'player_s_damage' => 'Бонус урона:',
'player_s_healing'=> 'Бонус хила:',
'player_s_hit'    => 'Hit Raiting:',
'player_s_crit'   => 'Шанс крита:',
'player_s_haste'  => 'Ускорение:',
'player_s_regen'  => 'Реген маны:',

# Instance
'inst_no_map_present' => 'Нет карт для ',
'inst_creature_list'  => 'Существа на карте',
'inst_go_list'        => 'Объекты на карте',

# Achievement
'achievment_total'    => 'Обзор',
'achievment_complete' => 'Всего выполнено:',
'achievment_last'     => 'Последние выолненые:',

# Stat
'stat_total'     => 'Общая статистика:',
'stat_online'    => 'Игроков онлайн:',
'stat_maxonline' => 'Максимально игроков онлайн:',
'stat_uptime' 	 => 'Аптайм:',
'stat_maxuptime' => 'Максимальный аптайм:',
'stat_total_acc' => 'Всего создано аккаунтов:',
'stat_total_chr' => 'Всего создано персонажей:',
'stat_sides'     => 'Cтатистика альянса и орды',
'stat_total_pl'  => 'Всего игроков:',
'stat_online'    => 'Онлайн:',
'stat_classes'   => 'Статистика по классам',
'stat_races'     => 'Статистика по расам',

# Main menu
'main'=>'Главная',
'find'=>'Поиск:',
'item_lookup'=>'Поиск вещи',
'quest_lookup'=>'Поиск квеста',
'creature_lookup'=>'Поиск существ',
'creature_by_type'=>'Типы НПС',
'creature_by_family'=>'Подвиды',
'creature_by_role'=>'Назначение',
'spell_lookup'=>'Поиск заклинания',
'object_lookup'=>'Поиск ГО',
'area_lookup'=>'Поиск зоны',
'search_database'=>'Поиск в базе',
'menu_faq'=>'F.A.Q.:',
'menu_5'=>'Скрипты:',
'register'=>'Регистрация',
'open_search'=>'Поисковый модуль',
'menu_6'=>'Дополнительно:',
'talent_calc'=>'Калькулятор талантов',
'cartograph'=>'WoWD: Картограф',
'auction'=>'Аукцион',
'guild'=>'Гильдии',
'zone'=>'Зоны',
'instance'=>'Инстансы',
'statistic'=>'Статистика',
'item_set'=>'Комплекты',
'faction_lookup' =>'Поиск Фракции',
'achievement'=>'Достижения',
'class skills'=>'Классовые умения',

# TOP 100
'top_lookup'=>'TOP:',
'top_money'=>'Toп богатейших игроков',
'top_honor'=>'Top хонор',
'top_arena2'=>'Toп арена 2x2',
'top_arena3'=>'Toп арена 3x3',
'top_arena5'=>'Toп арена 5x5',

#Proffesions
'skills_main'=>'Умения',
'prof_primary'=>'Профессии',
'prof_alchemy'=>'Алхимия',
'prof_blacksmith'=>'Кузнечное дело',
'prof_enchant'=>'Зачарование',
'prof_engineer'=>'Инженерное дело',
'prof_herbalism'=>'Травничество',
'prof_jevelcraft'=>'Ювелирное дело',
'prof_leathwork'=>'Кожевенное дело',
'prof_mining'=>'Горное дело',
'prof_skinning'=>'Снятие шкур',
'prof_taloring'=>'Шитье',
'prof_inscription'=>'Начертание',

'prof_secondary'=>'Вторичные навыки',
'prof_cooking'=>'Приготовление пищи',
'prof_first_aid'=>'Первая помощь',
'prof_fishing'=>'Рыбная ловля',

# FAQ
'faq_list'=>'Содержание',
'faq_classes'=>'Классы',
'faq_races'=>'Расы',
'faq_professions'=>'Профессии',
'faq_slang'=>'Слэнг',
'step_1'=>'Первый шаг',
'about_aggro'=>'Аггро система',
'about_city'=>'Города',
'about_guild'=>'Создание гильдий',
'about_socket'=>'Сокет вещи',
'about_macro'=> 'Макросы',
'about_raid_hill'=>'Лечение в рейде',

# Search player dialog
'player_lookup'=>'Поиск игрока',
'player_name'=>'Имя игрока',
'map'=>'Карта',
'search_results' =>'Результаты поиска',
'found'=>'Найдено',
'not_found'=>'Не найдено',

# Search NPC dialog
'mob_name'=>'Имя моба',
'mob_subname'=>'Subname',
'level' =>'Уровень',
'search'=>'Поиск',
'reset'=>'Сброс',

# Search Quest dialog
'find_quest'=>'Поиск квеста',
'quest_name'=>'Название квеста',
'quest_location'=>'Локация',

# Search Item dialog
'item_name' =>'Название',
'item_class' => 'Класс',
'item_type' => 'Тип',
'item_min_level' => 'Min level',
'item_max_level' => 'Max level',
'find_mob' =>'Поиск мобов',

# Search Spell dialog
'find_spell' =>'Поиск заклинаний',
'spell_name'=>'Название',
'spell_desc'=>'Описание',
'find_item'=>'Поиск вещи',

# Search GO dialog
'go_find'=>'Поиск геймобьекта',
'go_not_found'=>'Обьект не найден',
'go_name'=>'Название',

# Search Itemset dialog
'set_find'=>'Поиск набора',
'set_not_found'=>'Набор не найден',
'set_name'=>'Название',

# Search Area dialog
'area_find'=>'Поиск зоны',
'area_not_found'=>'Зона не найдена',
'area_name'=>'Название',

# Search Faction dialog
'find_faction'=>'Поиск фракции',
'faction_name'=>'Название',

);

?>
