﻿<?php
/*
 * Потдержка русского языка сайтом
 */
$lang = array(
'search_database' => 'Поиск по базе',
'find' => 'Найти',
'main'=> 'Главная',
'error' => 'Ошибка',

# Site
'www_creature'=>'http://ru.wowhead.com/npc=%d',
'www_gameobject'=>'http://ru.wowhead.com/object=%d',
'www_item'=>'http://ru.wowhead.com/item=%d',
'www_spell'=>'http://ru.wowhead.com/spell=%d',
'www_quest'=>'http://ru.wowhead.com/quest=%d',
'www_faction'=>'http://ru.wowhead.com/faction=%d',
'www_zone'=>'http://ru.wowhead.com/zone=%d',

# Search
'search_results'    => 'Результаты поиска',
'found'             => 'Найдено',
'not_found'         => 'Не найдено',
'go_not_found'      => 'Объект не найден',
'creature_not_found'=> 'Существо не найдено',
'item_not_found'    => 'Предмет не найден',
'quest_not_found1'   => 'Задание не найдено',
'spell_not_found'   => 'Заклинание не найдено',
'enchant_not_found'  => 'Наложения чар не найдено',
'faction_not_found'  => 'Фракция не найдена',
'search_item_req'   => 'Запрос на поиск предмета',
'search_set_req'    => 'Запрос на поиск комплекта',
'search_faction_req'=> 'Запрос на поиск фракции',
'search_npc_req'    => 'Запрос на поиск НПС',
'search_quest_req'  => 'Запрос на поиск задания',
'search_go_req'     => 'Запрос на поиск объекта',
'search_spell_req'  => 'Запрос на поиск заклинания',
'search_area_req'   => 'Запрос на поиск зон',

#Time
'days' =>'д.',
'hours' =>'ч.',
'min' =>'мин.',
'sec' =>'сек.',
'minustime' =>'действие',

#Condition
'condition1' => 'Аура ',
'condition2' => 'Есть в сумках(нет в банке) ',
'condition3' => 'Одет ',
'condition4_1' => 'Не в ',
'condition8' => 'Завершено ',
'condition9' => 'Взято ',
'condition10' => 'AD аура',
'condition11' => 'Нет ауры ',
'condition12' => 'В ',
'condition13_1' => 'Флаг у местности ',
'condition13_2' => 'Нет флага у местности ',
'condition15_1' => ' уровень',
'condition15_2' => ' уровень и выше',
'condition15_3' => ' уровень и ниже',
'condition16' => 'Нет в сумках(нет в банке) ',
'condition17_1' => 'Выучен спелл ',
'condition17_2' => 'Не выучен спелл ',
'condition20_1' => 'Выполнено достижение ',
'condition20_2' => 'Не выполнено достижение ',
'condition22' => 'Не бралось и не выполнялось ',
'condition23' => 'Есть в сумках(есть в банке) ',
'condition24' => 'Нет в сумках(есть в банке) ',
'condition25' => 'Не в ',
'condition26' => 'В ',
'condition27' => 'Не в ',
'condition28_1' => 'Нет ',
'condition28_2' => ' и нет ',

# Item report
'item_name' => 'Название предмета',
'item_level' => 'Уровень',
'item_req_level' => 'Треб. уровень',
'item_gem_details' => 'Свойства самоцвета',
'item_armor' => 'Броня',
'item_block' => 'Блок',
'item_dps' => 'УВС',
'item_speed' => 'Скорость',
'item_slot_num' => 'Слотов',
'item_desc' => 'Описание',
'item_type' => 'Тип',
'item_slot' => 'Ячейка',
'item_spells' => 'Заклинания',
'item_faction_rank'=> 'Требует репутации',

# Vendor report
'item_cost'  => 'Цена',
'item_count' => 'Кол-во',
'item_incrtime' => 'Поставка',

# Quest report
'quest_lvl'=>'Уровень',
'quest_reqlvl'=>'Требует уровень',
'quest_name'=>'Название квеста',
'quest_giver'=>'Выдаёт',
'quest_rewards'=>'Награды',

# Spell report
'spell_level' => 'Уровень',
'spell_name' => 'Название заклинания',
'spell_skill' => 'Ветка',
'spell_power' => 'Стоимость',
'spell_range' => 'Дальность',
'spell_school' => 'Школа',
'spell_reagent' => 'Реагенты',
'spell_create' => 'Создаёт',

# Trainer report
'trainer_cost' =>'Цена',
'trainer_spell'=>'Заклинание',
'trainer_skill'=>'Необходимо знать',
'trainer_value'=>'Навык',
'trainer_level'=>'Требует уровень',

# GO report
'go_name' => 'Название',
'go_type' => 'Тип',
'map' => 'Карта',

# Creature report
'creature_level' => 'Уровень',
'creature_name'  => 'Название существа',
'creature_react' => 'Отношение',
'creature_role'  => 'Назначение',

# Loot report
'loot_chance' =>'Шанс',
'loot_require'=>'Требования',
'loot_count'=>  'Кол-во',

# On kill reputation
'onkill_rep' => 'Репутация',

# Glyph report
'glyph_id'     => 'id',
'glyph_name'   => 'Название',

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
'excost_items'=> 'Предметы',

# Item set report
'set_id'   => 'id',
'set_name' => 'Название',
'set_items'=> 'Предметы',
'set_spells'=> 'Заклинания',
'set_class' => 'Класс',
'set_level' => 'Уровень',

# Faction report
'faction_id' => 'id',
'faction_name' => 'Название',
'faction_details' => 'Описание',

# Enchants report
'enchant_id'   => 'id',
'enchant_name' => 'Описание',

# Talent report
'talent_id'   => 'id',
'talent_name' => 'Ветка',

# Zones report
'zone_id'   => 'id',
'zone_name' => 'Название',

#Area Teleport
'at_id'  => 'id',
'at_name'=> 'Название',
'at_req' => 'Требования',

#Players list
'pl_guid'=>'guid',
'pl_name'=>'Имя',
'pl_race'=>'Раса',
'pl_class'=>'Класс',
'pl_level'=>'Уровень',
'pl_pos'=>'Позиция',
'pl_rank'=>'Ранг',
'pl_note'=>'Инфо',

// Details (spell, go, npc)
'detail_info' => 'Подробная информация',

//Page
'page' => 'Страница',
'back' => 'Назад',
'next' => 'Дальше',
'go' => 'Вперед',
'compressed' => 'На главную',
'no_sell_price' => 'Не для продажи',
'sell_price' => 'Цена продажи',
'buy_price' => 'Цена выкупа',

// GO, NPC info
'show_map' => 'На карте',
'money' => 'Деньги',
'sold'  => 'Продаёт предметы',
'train' => 'Обучает',
'go_locked' => 'Объект заперт',
'go_cast_spell' => 'Способности',
'go_summoned_by' => 'Может быть призван заклинанием',
'npc_spell_train' => 'Обучают',
'quest_spell_train' => 'Награда за выполнение задания:',
'req_for_quest' => 'Требуется для задания',
'kill_kredit_group' => 'Группа',
'give_quest' => 'Начинает задания',
'take_quest' => 'Завершает задания',
'give_skin'  => 'Снятие шкур',
'give_mining'  => 'Горное дело',
'give_herb'  => 'Травничество',
'give_engineer'  => 'Инженерное дело',
'can_pickpocketing' => 'Можно украсть',
'can_loot'  => 'Добыча',
'cast_spells' => 'Способности',
'summoned_by_spell' => 'Призван заклинанием',

'id'  => 'id',
'item_list' => 'Предметы',
'reqirement' => 'Требование',
'drop' => 'Шанс',
'level' => 'Уровень',

#Loot info
'loot_details'      => 'Подробнее...',
'contain_prospecting_loot' => 'Просеивание:',
'contain_milling_loot'     => 'Измельчение:',
'contain_fishing_loot'     => 'Рыбалка:',
'contain_disenchant_loot'  => 'Распыление:',
'item_uses_spell'   => 'Вещи, использующие заклинание',
'item_use_in_spell' => 'Используется заклинанием:',
'create_from_spell' => 'Создана заклинанием',
'loot_from_spell'   => 'Получена заклинанием',
'prospecting_loot'  => 'Просеяно из руды',
'milling_loot'      => 'Измельчено из растений',

//'item_loot'         => '(Предметы) Падает с...',
'item_contain_loot' => 'Содержит',
'disenchant_loot'   => 'Распыляется из',
'pickpocketing_loot'=> 'Можно украсть у',
'skinning_loot'     => 'Ошкурено с...',
'fishing_loot'      => 'Выловить в...',
'quest_reward_loot' => 'Награда за задание',
'quest_req_loot'    => 'Требуется для задания',
'quest_src_loot'    => 'Выдают с заданием',
'quest_mail_loot'   => 'С задания',
'npc_sold_loot'     => 'Продают...',
'drop_loot'         => 'Падает с...',
'go_drop_loot'      => 'Получено из ...',
'item_lock_loot'    => 'Извлечь из...',
'locked_item'       => 'Заперто:',
'can_unlock'        => 'Является ключом для:',
'locked_list'       => 'Список',
'no_found'          => 'Не найдено',
'recipe_for'        => 'Рецепт для создания',
'random_enchants'   => 'Случайные энчанты',
'random_enc_name'   => 'Расширенное название',
'random_enc_info'   => 'Подробности',
'random_enc_cnance' => 'Шанс %',
'no_name'           => 'без имени',

'anything' => '- Любая -',
'this_item_part_of_set' => 'Этот предмет часть комплекта',
'item_is_ex_cost'   => 'Обменивается на',

// Quest info
'one_of_this_items' => 'Один из этих предметов',
'obtained_at_level' => 'Доступен с уровня',
'obtained_at_event' => 'Доступен только в событие',
'required_races' => 'Сторона:',
'quest_level' => 'Уровень задания:',
'provided' => 'Выдается:',
'provided_desc' => 'Этот предмет выдается когда принято задание.',
'this_quest_is_part_of_a_series' => 'Это задание часть серии',
'start' => 'Начинает',
'end_q' => 'Завершает',
'q_next' => 'Следующий:',
'q_prev' => 'Предыдущий:',
'players_with_this_quest'=>'Игроков, выполняющих задание',
'players_completed_quest'=>'Игроков, выполнивших задание',
'step' => 'Шаг ',
'suggestedplayers'=>'Рекомендуемое количество игроков:',
'qlimittime'=>'Необходимо выполнить за',
'kill' => 'Убить:',
'cast' => 'Необходимо произнести:',
'cast_on' => 'на',
'use'  => 'Исп:',
'collect' => 'Необходимые предметы:',
'req_items' => 'Потребуется:',
'Rew_money' => 'Деньги:',
'Rew_XP' => 'Опыт:',
'Rew_honor' => 'Дополнительная честь:',
'Rew_reputation' => 'Репутация:',
'cast_spell' => 'Следующее заклинание будет наложено на вас:',
'learn_spell' => 'Обучат заклинанию:',
'Rew_item'  => 'Вы получите предметы:',
'Rew_item_mail'  => 'Предметы в письме:',
'Rew_mail'  => 'Будет отправлено письмо,',
'Mail_item_time'  => ' время доставки: ',
'Mail_time'  => ' час(-а,-ов)',
'item_sel_and' => '&nbsp;+&nbsp;',
'item_sel_or' => '&nbsp;или&nbsp;',
'Rew_select_item'  => 'Предметы на выбор:',
'req_for_quest'    => 'Требуется для:',
'additional_info'  => 'Дополнительная информация',
'quest_completed' => 'По выполнении',
'quest_marked' => 'Blizzard пометили это задание как устаревшее - его нельзя получить или выполнить.',
'quest_not_found' => '----- НЕ НАЙДЕНО! ------',
'quest_type0' => 'Повторяемый',
'quest_type1' => 'Ежедневный',
'quest_type2' => 'Еженедельный',
'quest_type3' => 'Ежемесячный',

# Spell info
'spell_casted_by' => 'Используется:',
'spell_reagents' => 'Реагенты:',
'spell_req_focus' => 'Требует: %s',
'spell_req_totem' => 'Инструмент: %s',
'spell_learned_by_recipe' => 'Можно выучить свитком:',
'spell_contain_loot' => 'Получены предметы:',
'spell_trigger' => 'Срабатывает от заклинания:',
'spell_added_by_enchant' => 'Добавляется зачарованием:',
'spell_added_by_set' => 'Добавляется коллекцией',
'spell_affected_by' => 'Может быть улучшен заклинанием:',
'spell_used_by_glyph' => 'Используется символом:',
'spell_talent' => 'Заклинание является талантом',
'spell_go_cast' => 'Используется объектом',

#Enchant info
'enchant_by_spell' => 'Зачарован от заклинания',
'enchant_by_gems'  => 'Зачарован от камня',
'enchant_by_socket'=> 'Бонус ячеек',
'enchant_by_rand_prop'=>'Случайное свойство',
'enchant_by_rand_suff'=>'Случайное дополнение',

#Faction info
'faction_contain' =>'Состоит из',
'faction_in'     => 'Входит в состав',
'faction_npc' => 'Входят существа',
'faction_go' => 'Входят ГО',
'faction_item' => 'Предметы, требующие репутации',
'faction_quest_rew' => 'Награды за задания',
'faction_kill_rew'=> 'Награды за убийство',
'faction_spell_rew'=>'Получено от заклинания',

#Zone info
'zone_parent'=>'Часть зоны',
'zone_subzones'=>'Подзоны',
'zone_npc_in'=>  'Существа в зоне',
'zone_go_in' =>  'Объекты в зоне',
'zone_fishing_in' => 'Рыбалка',

#Show map
'map_areas'=>'Зоны',
'map_maps'=>'Карты',
'map_gps'=>'GPS',
'map_no_found'=>'Не найдено',
'respawn'=>'Респавн:',
'no_image'=>'Нет изображения местности',

# TOP 100
'top_money_header' => 'Богатейшие игроки',
'top_honor_header' => 'Сильнейшие игроки',
'top_arena_header' => 'Сильнейшие команды арены %d',

'arena_team_name' => 'Название',
'arena_rating' => 'Рейтинг',
'arena_team' => 'Состав',

# Item owners
'owner_list'     => 'Владельцы таких предметов: %d',
'owner_no_found' => 'Владельцев не найдено',

# Online list
'online_players'    => 'онлайн',
'online_no_players' => 'Нет игроков онлайн',

# PLAYER list
'player_name'  => 'Имя',
'player_level' => 'Уровень',
'player_race'  => 'Раса',
'player_class' => 'Класс',
'player_zone'  => 'Зона',
'player_money' => 'Деньги',
'player_honor' => 'Честь',
'player_kills' => 'Убил',
'last_login'   => 'Последний визит',
'online'       => 'Онлайн',

# Auction
'auction_seller' => 'Продавец',
'auction_cost'   => 'Стоимость',
'auction_bye'    => 'Выкуп',
'empty'          => 'Пусто',

# Guilds
'guild_list'   => 'Гильдии - ',
'guild_name'   => 'Название',
'guild_leader' => 'Лидер',
'guild_create' => 'Создана',
'guild_members'=> 'Состав',
'guild_create_at'=> 'Создана:',
'guild_money'  => 'Деньги:',
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
'player_page_base'   =>'Базовые статы',
'player_page_defence'=>'Защита',
'player_armor'    => 'Броня:',
'player_defence'  => 'Защита:',
'player_dodge'    => 'Уклонение:',
'player_parry'    => 'Парирование:',
'player_block'    => 'Блок:',
'player_recilence'=> 'Устойчивость:',
'player_melee'    => 'Ближний бой',
'player_m_skill'  => 'Скилл:',
'player_m_damage' => 'Урон:',
'player_m_speed'  => 'Скорость:',
'player_m_power'  => 'Сила:',
'player_m_hit'    => 'Рейтинг метк.:',
'player_m_crit'   => 'Рейтинг крит.:',
'player_ranged'   => 'Дальний бой',
'player_r_skill'  => 'Скилл:',
'player_r_damage' => 'Урон:',
'player_r_speed'  => 'Скорость:',
'player_r_power'  => 'Сила:',
'player_r_hit'    => 'Рейтинг метк.:',
'player_r_crit'   => 'Рейтинг крит.:',
'player_spell'    => 'Заклинания',
'player_s_damage' => 'Бонус урона:',
'player_s_healing'=> 'Бонус лечен.:',
'player_s_hit'    => 'Рейтинг метк.:',
'player_s_crit'   => 'Рейтинг крит.:',
'player_s_haste'  => 'Ускорение:',
'player_s_regen'  => 'Восстан. маны:',

# Instance
'inst_no_map_present' => 'Нет карты для ',
'inst_creature_list'  => 'Существа на карте',
'inst_go_list'        => 'Объекты на карте',

# Achievement
'achievment_total'    => 'Обзор',
'achievment_complete' => 'Всего выполнено:',
'achievment_last'     => 'Последние выполненные:',

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
'stat_timers'     => 'Таймеры:',
'ap_date'     => 'Дата начисления очков арены:',
'daily_quest_date'     => 'Дата сброса ежедневных квестов:',
'weekly_quest_date'     => 'Дата сброса еженедельных квестов:',
'monthly_quest_date'     => 'Дата сброса ежемесячных квестов:',
'active_event' => 'Активные события:',

# Main menu
'main'=>'Главная',
'find'=>'Поиск:',
'item_lookup'=>'Поиск предметов',
'quest_lookup'=>'Поиск заданий',
'creature_lookup'=>'Поиск НПС',
'creature_by_type'=>'Типы НПС',
'creature_by_family'=>'Подвиды',
'creature_by_role'=>'Назначение',
'spell_lookup'=>'Поиск заклинаний',
'object_lookup'=>'Поиск объектов',
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
'instance'=>'Подземелья',
'instances'=>'Подземелье',
'in_zone'=>'В зоне',
'statistic'=>'Статистика',
'item_set'=>'Комплекты',
'faction_lookup' =>'Поиск фракции',
'achievement'=>'Достижения',
'class skills'=>'Классовые умения',

# TOP 100
'top_lookup'=>'TOП:',
'top_money'=>'Toп богатейших игроков',
'top_honor'=>'Toп чести',
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
'prof_cooking'=>'Кулинария',
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
'about_socket'=>'Предметы с гнездами',
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
'mob_name'=>'Имя',
'mob_subname'=>'Роль',
'level' =>'Уровень',
'search'=>'Поиск',
'reset'=>'Сброс',

# Search Quest dialog
'find_quest'=>'Поиск задания',
'quest_name'=>'Название',
'quest_location'=>'Местность',

# Search Item dialog
'item_name' =>'Название',
'item_class' => 'Класс',
'item_type' => 'Тип',
'item_min_level' => 'Mин. уровень',
'item_max_level' => 'Mакс. уровень',
'find_mob' =>'Поиск существ',

# Search Spell dialog
'find_spell' =>'Поиск заклинаний',
'spell_name'=>'Название',
'spell_desc'=>'Описание',
'find_item'=>'Поиск предмета',

# Search GO dialog
'go_find'=>'Поиск объекта',
'go_not_found'=>'Объект не найден',
'go_name'=>'Название',

# Search Itemset dialog
'set_find'=>'Поиск комплекта',
'set_not_found'=>'Комплект не найден',
'set_name'=>'Название',

# Search Area dialog
'area_find'=>'Поиск зоны',
'area_not_found'=>'Зона не найдена',
'area_name'=>'Название',

# Search Faction dialog
'find_faction'=>'Поиск фракции',
'faction_name'=>'Название',

# Side
'Both'=>'Обе',
'Alliance'=>'Альянс',
'Horde'=>'Орда',
'Blackwater'=>'Нейтральный',
'items'=>'предмет(-а,-ов)',
);
?>