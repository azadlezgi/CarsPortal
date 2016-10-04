<?php

// Locale Settings
setlocale(LC_TIME, "ru","RU"); // Linux Server (Windows may differ)
$locale['charset'] = "UTF-8";
$locale['xml_lang'] = "ru";
$locale['tinymce'] = "ru";
$locale['phpmailer'] = "ru";
$locale['fb_lang'] = "ru_RU";

// Full & Short Months
$locale['months'] = "&nbsp;|Январь|Февраль|Март|Апрель|Май|Июнь|Июль|Август|Сентябрь|Октябрь|Ноябрь|Декабрь";
$locale['shortmonths'] = "&nbsp|Янв|Фев|Мар|Апр|Май|Июнь|Июль|Авг|Сен|Окт|Ноя|Дек";

// Standard User Levels
$locale['user0'] = "Общий";
$locale['user1'] = "Пользователь";
$locale['user2'] = "Администратор";
$locale['user3'] = "Супер Администратор";
$locale['user_na'] = "Не Доступно";
$locale['user_anonymous'] = "Анонимный пользователь";
// Standard User Status
$locale['status0'] = "Активный";
$locale['status1'] = "Заблокированный";
$locale['status2'] = "Неактивированный";
$locale['status3'] = "Взвешенный";
$locale['status4'] = "Заблокированный по безопасности";
$locale['status5'] = "Отмененный";
$locale['status6'] = "Аноним";
$locale['status7'] = "Деактивированный";
$locale['status8'] = "Неактивный";
// Forum Moderator Level(s)
$locale['userf1'] = "Модератор";
// Navigation
$locale['global_001'] = "Навигация";
$locale['global_002'] = "Нет ссылок\n";
// Users Online
$locale['global_010'] = "Сейчас на сайте";
$locale['global_011'] = "Гостей";
$locale['global_012'] = "Пользователей";
$locale['global_013'] = "Нет пользователей";
$locale['global_014'] = "Всего пользователей";
$locale['global_015'] = "Неактивных пользователей";
$locale['global_016'] = "Новый пользователь";
// Forum Side panel
$locale['global_020'] = "Темы форума";
$locale['global_021'] = "Новые темы";
$locale['global_022'] = "Обсуждаемые темы";
$locale['global_023'] = "Нет тем";
// Comments Side panel
$locale['global_025'] = "Последние комментарии";
$locale['global_026'] = "Нет комментариев";
// Articles Side panel
$locale['global_030'] = "Последние статьи";
$locale['global_031'] = "Нет статей";
// Downloads Side panel
$locale['global_032'] = "Последние загрузки";
$locale['global_033'] = "Нет файлов для загрузки";
// Welcome panel
$locale['global_035'] = "Добро пожаловать";
// Latest Active Forum Threads panel
$locale['global_040'] = "Последние активные темы форума";
$locale['global_041'] = "Мои темы";
$locale['global_042'] = "Мои сообщения";
$locale['global_043'] = "Новые сообщения";
$locale['global_044'] = "Темы";
$locale['global_045'] = "Просмотров";
$locale['global_046'] = "Ответов";
$locale['global_047'] = "Последние сообщения";
$locale['global_048'] = "Форум";
$locale['global_049'] = "Добавлено";
$locale['global_050'] = "Автор";
$locale['global_051'] = "Опрос";
$locale['global_052'] = "Перемещено";
$locale['global_053'] = "У вас нет тем на форумах.";
$locale['global_054'] = "У вас пока нет сообщений на форуме.";
$locale['global_055'] = "Есть %u новое(вых) сообщение(ний) с момента вашего последнего посещения.";
$locale['global_056'] = "Мои подписки на темы";
$locale['global_057'] = "Параметры";
$locale['global_058'] = "Отмена";
$locale['global_059'] = "Вы не подписаны ни на одну тему.";
$locale['global_060'] = "Отменить подписку для этой темы?";
// News & Articles
$locale['global_070'] = "Опубликовал ";
$locale['global_071'] = " ";
$locale['global_072'] = "Читать полностью";
$locale['global_073'] = " Комментариев";
$locale['global_073b'] = " Комментарий";
$locale['global_074'] = " Прочтений";
$locale['global_075'] = "Печать";
$locale['global_076'] = "Редактировать";
$locale['global_077'] = "Новости";
$locale['global_078'] = "Нет новостей";
$locale['global_079'] = "В ";
$locale['global_080'] = "Без категории";
// Page Navigation
$locale['global_090'] = "Предыдущая";
$locale['global_091'] = "Следующая";
$locale['global_092'] = "Страница ";
$locale['global_093'] = " из ";
// Guest User Menu
$locale['global_100'] = "Авторизация";
$locale['global_101'] = "Логин";
$locale['global_102'] = "Пароль";
$locale['global_103'] = "Запомнить меня";
$locale['global_104'] = "Войти";
$locale['global_105'] = "Вы не зарегистрированы?<br /><a href='".BASEDIR."register.php' class='side'>Нажмите здесь</a> для регистрации.";
$locale['global_106'] = "Забыли пароль? <br />Запросите новый <a href='".BASEDIR."lostpassword.php' class='side'>здесь</a>.";
$locale['global_107'] = "Регистрация";
$locale['global_108'] = "Восстановление пароля";
// Member User Menu
$locale['global_120'] = "Редактировать профиль";
$locale['global_121'] = "Личные сообщения";
$locale['global_122'] = "Список пользователей";
$locale['global_123'] = "Панель администратора";
$locale['global_124'] = "Выход";
$locale['global_125'] = "Прислано %u новое ";
$locale['global_126'] = "сообщение";
$locale['global_127'] = "сообщений";
$locale['global_128'] = "на утверждение";
$locale['global_129'] = "присланные";
// Poll
$locale['global_130'] = "Голосование";
$locale['global_131'] = "Голосовать";
$locale['global_132'] = "Вы должны авторизироваться, чтобы голосовать.";
$locale['global_133'] = "Голос";
$locale['global_134'] = "Голосов";
$locale['global_135'] = "Голосов: ";
$locale['global_136'] = "Начат: ";
$locale['global_137'] = "Закончен: ";
$locale['global_138'] = "Архив опросов";
$locale['global_139'] = "Выберите опрос из списка:";
$locale['global_140'] = "Просмотр";
$locale['global_141'] = "Просмотр опроса";
$locale['global_142'] = "Опросы не найдены.";

// Captcha
$locale['global_150'] = "Проверочный код:";
$locale['global_151'] = "Введите проверочный код:";

// Footer Counter
$locale['global_170'] = "уникальный посетитель";
$locale['global_171'] = "уникальных посетителей";
$locale['global_172'] = "Время загрузки: %s секунд";
$locale['global_173'] = "Запросов";
// Admin Navigation
$locale['global_180'] = "Панель администратора";
$locale['global_181'] = "Вернуться на сайт";
$locale['global_182'] = "<strong>Примечание:</strong> Пароль администратора введен некорректно";
// Miscellaneous
$locale['global_190'] = "Включен режим обслуживания";
$locale['global_191'] = "Ваш IP адрес заблокирован.";
$locale['global_192'] = "Ваш пользовательские cookie истекли. Пожалуйста, авторизуйтесь снова.";
$locale['global_193'] = "Не удалось установить cookie. Пожалуйста, убедитесь, что у Вас включены cookie, чтобы авторизоваться.";
$locale['global_194'] = "Этот аккаунт в настоящее время приостановлен.";
$locale['global_195'] = "Этот аккаунт еще не активизирован.";
$locale['global_196'] = "Неправильное имя или пароль.";
$locale['global_197'] = "Пожалуйста, подождите, сейчас вы будете перемещены...<br /><br />
[ <a href='index.php'>или нажмите сюда, если не хотите ждать</a> ]";
$locale['global_198'] = "<strong>Внимание:</strong> Обнаружен файл setup.php, пожалуйста, удалите его немедленно!";
$locale['global_199'] = "<strong>Внимание:</strong> Не введен пароль администратора, нажмите <a href='".BASEDIR."edit_profile.php'>Редактировать профиль</a> и введите его.";
//Titles
$locale['global_200'] = " - ";
$locale['global_201'] = ": ";
$locale['global_202'] = $locale['global_200']."Поиск";
$locale['global_203'] = $locale['global_200']."FAQ";
$locale['global_204'] = $locale['global_200']."Форум";
//Themes
$locale['global_210'] = "Перейти к содержанию";
// No themes found
$locale['global_300'] = "Тема сайта не найдена";
$locale['global_301'] = "Извините, невозможно отобразить страницу. Из-за некоторых обстоятельств, не может быть найдена ни одна тема сайта. Если вы администратор сайта, используйте менеджер FTP для загрузки схемы, которая совместима с <em>PHP-Fusion v7</em> в каталог <em>themes/</em>. После загрузки темы, проверьте в разделе <em>Главные настройки</em>, что выбранна загруженная тема в директории <em>themes/</em>. Имейте в виду, что загруженная тема, должна имееть тоже название (включая регистр символов; важно для Unix-серверов), что и выбранная тема в разделе <em>Главные настройки</em>.<br /><br />Если вы пользователь, пожалуйста, свяжитесь с администратором сайта через e-mail: ".hide_email($settings['siteemail'])." и сообщите о этой проблеме.";
$locale['global_302'] = "Выбранная тема в разделе Главные настройки, не существует или повреждена!";
// JavaScript Not Enabled
$locale['global_303'] = "О нет! Где <strong>JavaScript</strong>?<br />У Вашего браузера отключен JavaScript или он просто не поддерживает JavaScript. Пожалуйста <strong>включите JavaScript</strong> на Вашем веб-браузере для нормального просмотра данного веб-сайта,<br /> или <strong>обновите</strong> свой браузер на поддерживаемый JavaScript; <a href='http://firefox.com' rel='nofollow' title='Mozilla Firefox'>Firefox</a>, <a href='http://apple.com/safari/' rel='nofollow' title='Safari'>Safari</a>, <a href='http://opera.com' rel='nofollow' title='Opera Web Browser'>Opera</a>, <a href='http://www.google.com/chrome' rel='nofollow' title='Google Chrome'>Chrome</a> или <a href='http://www.microsoft.com/windows/internet-explorer/' rel='nofollow' title='Internet Explorer'>Internet Explorer</a> не ниже, чем версия 6.";
// User Management
// Member status
$locale['global_400'] = "приостановлено";
$locale['global_401'] = "заблокировано";
$locale['global_402'] = "отключено";
$locale['global_403'] = "аккаунт удален";
$locale['global_404'] = "анонимный аккаунт";
$locale['global_405'] = "анонимный пользователь";
$locale['global_406'] = "Эта учетная запись была запрещена по следующим причинам:";
$locale['global_407'] = "Эта учетная запись была приостановлена ";
$locale['global_408'] = " по следующей причине:";
$locale['global_409'] = "Эта учетная запись была заблокирована по соображениям безопасности.";
$locale['global_410'] = "Причина в следующем: ";
$locale['global_411'] = "Эта учетная запись была отключена из-за неактивности";
$locale['global_412'] = "Эта учетная запись была переведена в анонимные, так как неактивна.";
// Banning due to flooding
$locale['global_440'] = "Автоматический бан при флудконтроле";
$locale['global_441'] = "Ваш аккаунт ".$settings['sitename']."забанен";
$locale['global_442'] = "Hello [USER_NAME],\n
Ваш аккаунт ".$settings['sitename']." замечен в посылке большого количества запросов за короткое время с одного IP ".USER_IP.", и поэтому он забанен. Это защита от спам ботов.\n
Пожалуйста, свяжитесь с администратором сайта ".$settings['siteemail']." для восстановления учетной записи и снятия бана.\n
".$settings['siteusername'];
// Lifting of suspension
$locale['global_450'] = "Автоматическая отмена отсрочки";
$locale['global_451'] = "Отмена отсрочки ".$settings['sitename'];
$locale['global_452'] = "Привет USER_NAME,\n
Приостановления Вашей учетной записи ".$settings['siteurl']." отменено. Подробнее о Вашей учетной записи:\n
Имя ползователя: USER_NAME
Пароль: Скрыт в целях безопасности
Если Вы забыли свой пароль, Вы можете восстановить его кликнув по ссылке: LOST_PASSWORD\n\n
С уважением,\n
".$settings['siteusername'];
$locale['global_453'] = "Привет USER_NAME,\n
Приостановление Вашего аккаунта ".$settings['siteurl']." отменено.\n\n
С уважением,\n
".$settings['siteusername'];
$locale['global_454'] = "Счет активирован ".$settings['sitename'];
$locale['global_455'] = "Привет USER_NAME,\n
В последнее Ваше посещение Ваш аккаунт реактивирован ".$settings['siteurl']." и учетная запись уже не помечена как неактивная.\n\n
С уважением,\n
".$settings['siteusername'];
// Function parsebytesize()
$locale['global_460'] = "Пусто";
$locale['global_461'] = "Байтов";
$locale['global_462'] = "кБ";
$locale['global_463'] = "МБ";
$locale['global_464'] = "ГБ";
$locale['global_465'] = "ТБ";
//Safe Redirect
$locale['global_500'] = "Вы будете перенаправлены %s, пожалуйста, ждите. Если вы не перенаправлены, нажмите здесь.";

// Captcha Locales
$locale['global_600'] = "Проверочный код";
$locale['recaptcha'] = "en";

//Miscellaneous
$locale['global_900'] = "Unable to convert HEX to DEC";


//My

$locale['global_901'] = "Языки";

$locale['global_910'] = "Пожалуйста, скажите что вы звоните поповоду объявление, с сайта Cars-Az.Com.";


$locale['global_950'] = "Меню";
$locale['global_951'] = "Навигация";
$locale['global_952'] = "Социальных сетях";
$locale['global_953'] = "Информация";


$locale['adress'] = "AZ0001, Азербайджан, Баку";
$locale['email'] = "<a href='mailto:info@cars-az.com'>info@cars-az.com</a>";
$locale['phone'] = "<a href='tel:+994506702484'>(+994 50) 670-24-84</a>";
$locale['skype'] = "<a href='skype:cars-az?chat' rel='nofollow'>cars-az</a>";


//All rights reserved.
$locale['copy'] = "&copy; <a href='http://cars-az.com/' target='_blank'><b>Cars-Az</b></a>  2015-". date("Y") ."<br />Все права защищены";


$locale['veziyyet_1'] = "Новое";
$locale['veziyyet_2'] = "Подержанное";
$locale['veziyyet_3'] = "Ретро";
$locale['veziyyet_4'] = "Битое";

$locale['oiltip_1'] = "Бензин";
$locale['oiltip_2'] = "Дизель";
$locale['oiltip_3'] = "Газ";
$locale['oiltip_4'] = "Гибрид";

$locale['gedenteker_1'] = "Задний";
$locale['gedenteker_2'] = "Передний";
$locale['gedenteker_3'] = "Полный";

$locale['karopka_1'] = "Автомат";
$locale['karopka_2'] = "Механическая";
$locale['karopka_3'] = "Роботизированная";

$locale['kuzareng_2'] = "Белый";
$locale['kuzareng_12'] = "Бежевый";
$locale['kuzareng_11'] = "Фиолетовый";
$locale['kuzareng_7'] = "Синий";
$locale['kuzareng_21'] = "Розовый";
$locale['kuzareng_3'] = "Серый";
$locale['kuzareng_8'] = "Серебристый";
$locale['kuzareng_9'] = "Голубой";
$locale['kuzareng_15'] = "Оранжевый";
$locale['kuzareng_5'] = "Черный";
$locale['kuzareng_10'] = "Коричневый";
$locale['kuzareng_1'] = "Красный";
$locale['kuzareng_14'] = "Золотистый";
$locale['kuzareng_6'] = "Желтый";
$locale['kuzareng_35'] = "Бордовый";
$locale['kuzareng_27'] = "Мокрый асфальт";
$locale['kuzareng_4'] = "Зеленый";

$locale['salonreng_2'] = "Белый";
$locale['salonreng_12'] = "Бежевый";
$locale['salonreng_11'] = "Фиолетовый";
$locale['salonreng_7'] = "Синий";
$locale['salonreng_21'] = "Розовый";
$locale['salonreng_3'] = "Серый";
$locale['salonreng_8'] = "Серебристый";
$locale['salonreng_9'] = "Голубой";
$locale['salonreng_15'] = "Оранжевый";
$locale['salonreng_5'] = "Черный";
$locale['salonreng_10'] = "Коричневый";
$locale['salonreng_1'] = "Красный";
$locale['salonreng_14'] = "Золотистый";
$locale['salonreng_6'] = "Желтый";
$locale['salonreng_35'] = "Бордовый";
$locale['salonreng_27'] = "Мокрый асфальт";
$locale['salonreng_4'] = "Зеленый";

$locale['ban_1'] = "Легковые";
$locale['ban_2'] = "Мото";
$locale['ban_3'] = "Водный транспорт";
$locale['ban_4'] = "Спецтехника";
$locale['ban_5'] = "Воздушный транспорт";
$locale['ban_6'] = "Автобусы";
$locale['ban_7'] = "Грузовики";
$locale['ban_8'] = "Прицепы";
$locale['ban_9'] = "Автодома";

$locale['kuza_1'] = "Универсал";
$locale['kuza_2'] = "Седан";
$locale['kuza_3'] = "Хетчбек";
$locale['kuza_4'] = "Внедорожник / Кроссовер";
$locale['kuza_5'] = "Купе";
$locale['kuza_6'] = "Кабриолет";
$locale['kuza_7'] = "Минивен";
$locale['kuza_8'] = "Пикап";
$locale['kuza_9'] = "Лимузин";
$locale['kuza_10'] = "Скутер / Мотороллер";
$locale['kuza_11'] = "Макси-скутер";
$locale['kuza_12'] = "Спорт";
$locale['kuza_13'] = "Мотоцикл";
$locale['kuza_14'] = "Мотоцикл Без обтекателей (Naked bike)";
$locale['kuza_15'] = "Мотоцикл Туризм";
$locale['kuza_16'] = "Мотоцикл Спорт-туризм";
$locale['kuza_17'] = "Спортбайк";
$locale['kuza_18'] = "Мотоцикл Кросс";
$locale['kuza_19'] = "Мотоцикл Триал";
$locale['kuza_20'] = "Мотоцикл Внедорожный (Enduro)";
$locale['kuza_21'] = "Мотоцикл Супермото (Motard)";
$locale['kuza_22'] = "Мотоцикл Чоппер";
$locale['kuza_23'] = "Мотоцикл Круизер";
$locale['kuza_24'] = "Мотоцикл с коляской";
$locale['kuza_25'] = "Мотоцикл Кастом";
$locale['kuza_26'] = "Мини мотоциклы";
$locale['kuza_27'] = "Мини спорт";
$locale['kuza_28'] = "Мини крос (Питбайк)";
$locale['kuza_29'] = "Трицикл";
$locale['kuza_30'] = "Квадроциклы";
$locale['kuza_31'] = "Квадроцикл детский";
$locale['kuza_32'] = "Квадроцикл спортивный";
$locale['kuza_33'] = "Квадроцикл  утилитарный";
$locale['kuza_34'] = "Мотовездеход";
$locale['kuza_35'] = "Вездеход-амфибия";
$locale['kuza_36'] = "Гольф-кар";
$locale['kuza_37'] = "Картинг";
$locale['kuza_38'] = "Street";
$locale['kuza_39'] = "Мопеды";
$locale['kuza_40'] = "Мотоцикл Многоцелевой (All-round)";
$locale['kuza_41'] = "Мопеды";
$locale['kuza_42'] = "Гидроциклы";
$locale['kuza_43'] = "Гидроцикл спортивный";
$locale['kuza_44'] = "Гидроцикл туристический";
$locale['kuza_45'] = "Лодка";
$locale['kuza_46'] = "Лодочный мотор";
$locale['kuza_47'] = "Катер";
$locale['kuza_48'] = "Моторная яхта";
$locale['kuza_49'] = "Парусная яхта";
$locale['kuza_50'] = "Сельхозтехника";
$locale['kuza_51'] = "Трактор";
$locale['kuza_52'] = "Traktor";
$locale['kuza_53'] = "Минитрактор";
$locale['kuza_54'] = "Мотоблок / Мотокультиватор";
$locale['kuza_55'] = "Комбайн";
$locale['kuza_56'] = "Сеялка";
$locale['kuza_57'] = "Плуг";
$locale['kuza_58'] = "Опрыскиватель";
$locale['kuza_59'] = "Почвообрабатывающая техника";
$locale['kuza_60'] = "Кормоуборочная техника";
$locale['kuza_61'] = "Садовая техника";
$locale['kuza_62'] = "Строительная техника";
$locale['kuza_63'] = "Экскаватор";
$locale['kuza_64'] = "Миниэкскаватор";
$locale['kuza_65'] = "Бульдозер";
$locale['kuza_66'] = "Кран / Автокран";
$locale['kuza_67'] = "Башенный кран";
$locale['kuza_68'] = "Автогрейдер";
$locale['kuza_69'] = "Аварийно-ремонтные машины";
$locale['kuza_70'] = "Асфальтозавод";
$locale['kuza_71'] = "Асфальтоукладчик";
$locale['kuza_72'] = "Бетононасос";
$locale['kuza_73'] = "Бетоноукладчик";
$locale['kuza_74'] = "Буровая установка";
$locale['kuza_75'] = "Сваебой / Дизельный молот";
$locale['kuza_76'] = "Каток";
$locale['kuza_77'] = "Компрессор";
$locale['kuza_78'] = "Мотопомпа / Насос";
$locale['kuza_79'] = "Ресайклер";
$locale['kuza_80'] = "Фреза дорожная";
$locale['kuza_81'] = "Электростанция / Генератор";
$locale['kuza_82'] = "Вилочный погрузчик / Штабелер";
$locale['kuza_83'] = "Подьемник";
$locale['kuza_84'] = "Погрузчики";
$locale['kuza_85'] = "Фронтальный погрузчик";
$locale['kuza_86'] = "Минипогрузчик";
$locale['kuza_87'] = "Телескопический погрузчик";
$locale['kuza_88'] = "Контейнерный погрузчик";
$locale['kuza_89'] = "Коммунальная техника";
$locale['kuza_90'] = "Уборочно-поливочные автомобили";
$locale['kuza_91'] = "Автовышка комунальная";
$locale['kuza_92'] = "Ассенизатор / Вакуумная машина";
$locale['kuza_93'] = "Илососная машина";
$locale['kuza_94'] = "Мусоровоз";
$locale['kuza_95'] = "Каналопромывочная машина";
$locale['kuza_96'] = "Пескоразбрасывающая машина";
$locale['kuza_97'] = "Уборочная машина";
$locale['kuza_98'] = "Снегоуборочная машина";
$locale['kuza_99'] = "Спецтранспорт";
$locale['kuza_100'] = "Вездеход";
$locale['kuza_101'] = "Харвестер / форвардер";
$locale['kuza_102'] = "Багги / Гоночный автомобиль";
$locale['kuza_103'] = "Автомобиль скорой помощи";
$locale['kuza_104'] = "Бронированный автомобиль";
$locale['kuza_105'] = "Оборудование / Навесное оборудование";
$locale['kuza_106'] = "Пожарная машина";
$locale['kuza_107'] = "Бетономеситель (Миксер)";
$locale['kuza_108'] = "Скрепер";
$locale['kuza_109'] = "Экскаватор погрузчик";
$locale['kuza_110'] = "Самолёт";
$locale['kuza_111'] = "Вертолёт";
$locale['kuza_112'] = "Микроавтобус (от 10 до 22 пас.)";
$locale['kuza_113'] = "Автобус";
$locale['kuza_114'] = "Городской автобус";
$locale['kuza_115'] = "Пригородный автобус";
$locale['kuza_116'] = "Туристический / Междугородний";
$locale['kuza_117'] = "Грузовик";
$locale['kuza_118'] = "Шасси";
$locale['kuza_119'] = "Платформа";
$locale['kuza_120'] = "Бортовой";
$locale['kuza_121'] = "Тентованый";
$locale['kuza_122'] = "Самосвал";
$locale['kuza_123'] = "Фургон";
$locale['kuza_124'] = "Рефрижератор";
$locale['kuza_125'] = "Контейнеровоз";
$locale['kuza_126'] = "Цистерна";
$locale['kuza_127'] = "Бетономешалка (Миксер)";
$locale['kuza_128'] = "Для перевозки животных";
$locale['kuza_129'] = "Лесовоз / Сортиментовоз";
$locale['kuza_130'] = "Мультилифт";
$locale['kuza_131'] = "Стекловоз";
$locale['kuza_132'] = "Автовоз";
$locale['kuza_133'] = "Эвакуатор";
$locale['kuza_134'] = "До 1,5т";
$locale['kuza_135'] = "До 3,5т";
$locale['kuza_136'] = "Больше  3,5т";
$locale['kuza_137'] = "Вахтовый автобус / Кунг";
$locale['kuza_138'] = "Легковий фургон (до 1,5 т)";
$locale['kuza_139'] = "Прицеп";
$locale['kuza_140'] = "Шасси";
$locale['kuza_141'] = "Платформа";
$locale['kuza_142'] = "Борт";
$locale['kuza_143'] = "Тентованный борт (штора)";
$locale['kuza_144'] = "Самосвал прицеп";
$locale['kuza_145'] = "Фургон до 1.5";
$locale['kuza_146'] = "Контейнеровоз";
$locale['kuza_147'] = "Цистерна";
$locale['kuza_148'] = "Рефрижератор";
$locale['kuza_149'] = "Для перевозки животных";
$locale['kuza_150'] = "Лесовоз / Сортиментовоз";
$locale['kuza_151'] = "Полуприцеп";
$locale['kuza_152'] = "Шасси полуприцеп";
$locale['kuza_153'] = "Платформа полуприцеп";
$locale['kuza_154'] = "Низкорамная платформа";
$locale['kuza_155'] = "Бортовой полуприцеп";
$locale['kuza_156'] = "Тентованный борт (штора)";
$locale['kuza_157'] = "Самосвал полуприцеп";
$locale['kuza_158'] = "Контейнеровоз полуприцеп";
$locale['kuza_159'] = "Фургон полуприцеп";
$locale['kuza_160'] = "Цистерна полуприцеп";
$locale['kuza_161'] = "Бетономешалка (Миксер) полуприцеп";
$locale['kuza_162'] = "Рефрижератор полуприцеп";
$locale['kuza_163'] = "Лесовоз / Сортиментовоз";
$locale['kuza_164'] = "Для перевозки животных";
$locale['kuza_165'] = "Плитовоз";
$locale['kuza_166'] = "Автовоз";
$locale['kuza_167'] = "Легковой прицеп";
$locale['kuza_168'] = "Прицеп дача";
$locale['kuza_169'] = "Лафет";
$locale['kuza_170'] = "Дом на колесах";
$locale['kuza_171'] = "Мобильный дом";
$locale['kuza_172'] = "Внедорожник / SUV";

$locale['valyuta_1'] = "AZN";
$locale['valyuta_2'] = "USD";
$locale['valyuta_3'] = "EUR";

$locale['kredit_0'] = "Нет";
$locale['kredit_1'] = "Есть";

$locale['bank_1'] = "AccessBank";
$locale['bank_2'] = "AFB Bank";
$locale['bank_3'] = "AGBank";
$locale['bank_4'] = "Amrahbank";
$locale['bank_5'] = "ASB";
$locale['bank_6'] = "AtaBank";
$locale['bank_7'] = "Atrabank";
$locale['bank_8'] = "Azer-Turk Bank";
$locale['bank_9'] = "Azərbaycan Kredit Bankı";
$locale['bank_10'] = "Bank Avrasiya";
$locale['bank_11'] = "Bank BTB";
$locale['bank_12'] = "Bank Melli Iran";
$locale['bank_13'] = "Bank of Azerbaijan";
$locale['bank_14'] = "Bank of Baku";
$locale['bank_15'] = "Bank Respublika";
$locale['bank_16'] = "Bank Silk Way";
$locale['bank_17'] = "Bank Standard";
$locale['bank_18'] = "Bank VTB (Azerbaijan)";
$locale['bank_19'] = "Central Bank";
$locale['bank_20'] = "DekaBank";
$locale['bank_21'] = "DemirBank";
$locale['bank_22'] = "EBRD";
$locale['bank_23'] = "Evrobank";
$locale['bank_24'] = "Expressbank";
$locale['bank_25'] = "Ganjabank";
$locale['bank_26'] = "Gunay Bank";
$locale['bank_27'] = "ABB (Beynəlxalq Bank)";
$locale['bank_28'] = "Kapital Bank";
$locale['bank_29'] = "KredoBank";
$locale['bank_30'] = "MuganBank";
$locale['bank_31'] = "Naxçıvanbank";
$locale['bank_32'] = "NBC Bank";
$locale['bank_33'] = "NBP";
$locale['bank_34'] = "Nikoil Bank";
$locale['bank_35'] = "Parabank";
$locale['bank_36'] = "PASHA Bank";
$locale['bank_37'] = "Rabitabank";
$locale['bank_38'] = "Royal Bank";
$locale['bank_39'] = "Texnikabank";
$locale['bank_40'] = "Transcaucasus Development";
$locale['bank_41'] = "TuranBank";
$locale['bank_42'] = "Unibank";
$locale['bank_43'] = "United Credit Bank";
$locale['bank_44'] = "Xalq Bank";
$locale['bank_45'] = "YapiKredi Azerbaycan";
$locale['bank_46'] = "Zaminbank";

$locale['krvalyuta_1'] = "AZN";
$locale['krvalyuta_2'] = "USD";
$locale['krvalyuta_3'] = "EUR";
$locale['krvalyuta_4'] = "%";

$locale['muddet_1'] = "месяцев";

$locale['ayliqodenish_1'] = "AZN";

$locale['qodovoy_1'] = "%";

$locale['zona_1'] = "Азербайджан";
$locale['zona_2'] = "За границей";

$locale['qorod_1'] = "Баку";
$locale['qorod_2'] = "Газах";
$locale['qorod_3'] = "Губа";
$locale['qorod_4'] = "Гусар";
$locale['qorod_5'] = "Гянджа";
$locale['qorod_6'] = "Евлах";
$locale['qorod_7'] = "Загатала";
$locale['qorod_8'] = "Исмаиллы";
$locale['qorod_9'] = "Лянкяран";
$locale['qorod_10'] = "Масаллы";
$locale['qorod_11'] = "Мингячевир";
$locale['qorod_12'] = "Нафталан";
$locale['qorod_13'] = "Нахчыван";
$locale['qorod_14'] = "Сумгаит";
$locale['qorod_15'] = "Товуз";
$locale['qorod_16'] = "Хачмаз";
$locale['qorod_17'] = "Шамахы";
$locale['qorod_18'] = "Шамкир";
$locale['qorod_19'] = "Шеки";
$locale['qorod_20'] = "Али-Байрамлы";
$locale['qorod_21'] = "Агдам";

$locale['qorod_51'] = "Грузия";
$locale['qorod_52'] = "Азия";
$locale['qorod_53'] = "Америка";
$locale['qorod_54'] = "Европа";



$locale['status_0'] = "Неактивные";
$locale['status_1'] = "Активные";
$locale['status_4'] = "Скрыть";

$locale['vip_0'] = "Нет";
$locale['vip_1'] = "Главная";
$locale['vip_2'] = "Поиск";
$locale['vip_3'] = "Левый панель";
$locale['vip_4'] = "Везде";
$locale['vip_5'] = "Партнёр";
$locale['vip_6'] = "Партнёр/Главная";


$locale['davam_-62208000'] = "-2 года";
$locale['davam_-31104000'] = "-1 год";
$locale['davam_-15552000'] = "-6 мес.";
$locale['davam_-12960000'] = "-5 мес.";
$locale['davam_-10368000'] = "-4 мес.";
$locale['davam_-7776000'] = "-3 мес.";
$locale['davam_-5184000'] = "-2 мес.";
$locale['davam_-2592000'] = "-1 мес.";
$locale['davam_0'] = "Нет";
$locale['davam_2592000'] = "+1 мес.";
$locale['davam_5184000'] = "+2 мес.";
$locale['davam_7776000'] = "+3 мес.";
$locale['davam_10368000'] = "+4 мес.";
$locale['davam_12960000'] = "+5 мес.";
$locale['davam_15552000'] = "+6 мес.";
$locale['davam_31104000'] = "+1 год";
$locale['davam_62208000'] = "+2 года";


$locale['srokmail_001'] = "Автоматическая удаления объявлений!";
$locale['srokmail_002'] = "шт.";
$locale['srokmail_010'] = "Общая количества:";
$locale['srokmail_011'] = "Автомобили:";
$locale['srokmail_012'] = "Куплю автомобиль:";
$locale['srokmail_013'] = "Автосалоны:";
$locale['srokmail_014'] = "Автомагазины:";
$locale['srokmail_015'] = "Автосервисы:";
$locale['srokmail_016'] = "Аренда авто:";
$locale['srokmail_017'] = "Автозапчасти:";


$locale['sort_desc'] = "По убыванию";
$locale['sort_asc'] = "По возрастанию";


$locale['description_1'] = "год выпуска";
$locale['description_2'] = "состояние";
$locale['description_3'] = "пробег %s км";
$locale['description_4'] = "тип топлива";
$locale['description_5'] = "объём двигателя %s см3";
$locale['description_6'] = "мощность %s л.с.";


$locale['satilib_001'] = "Продано!";

?>