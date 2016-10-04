<?php

// Locale Settings
setlocale(LC_TIME, "az","AZ"); // Linux Server (Windows may differ)
$locale['charset'] = "UTF-8";
$locale['xml_lang'] = "az";
$locale['tinymce'] = "az";
$locale['phpmailer'] = "az";
$locale['fb_lang'] = "az_AZ";

// Full & Short Months
$locale['months'] = "&nbsp|Yanvar|Fevral|Mart|Aprel|May|Iyun|Iyul|Avqust|Sentyabr|Oktyabr|Noyabr|Dekabr";
$locale['shortmonths'] = "&nbsp|Yan|Fev|Mar|Apr|May|Iyn|Iyl|Avq|Sent|Okt|Noy|Dek";

// Standard User Levels
$locale['user0'] = "Ümumi";
$locale['user1'] = "İstifadəçi";
$locale['user2'] = "İdarəçi";
$locale['user3'] = "Baş idarəçi";
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
$locale['userf1'] = "Nəzarətçi";
// Navigation
$locale['global_001'] = "Bələdçi";
$locale['global_002'] = "Keçidlər tə`yin edilməyib\n";
// Users Online
$locale['global_010'] = "Xətdəkilər";
$locale['global_011'] = "Xətdəki qonaqlar";
$locale['global_012'] = "Xətdəki istifadəçilər";
$locale['global_013'] = "Xətdə istifadəçi yoxdur";
$locale['global_014'] = "Qeydiyyatlı istifadəçilər:";
$locale['global_015'] = "Aktivləşdirilməmiş istifadəçilər:";
$locale['global_016'] = "Ən yeni istifadəçi:";
// Forum Side panel
$locale['global_020'] = "Forum bölmələri";
$locale['global_021'] = "Ən yeni bölmələr";
$locale['global_022'] = "Ən maraqlı mövzu";
$locale['global_023'] = "Bölmə açılmayıb";
// Articles Side panel
$locale['global_030'] = "Sonuncu məqalələr";
$locale['global_031'] = "Məqalə yoxdur";
// Welcome panel
$locale['global_035'] = "Xəş gəlmişsiniz";
// Latest Active Forum Threads panel
$locale['global_040'] = "Ən son aktiv forum mövzuları";
$locale['global_041'] = "Yeni mövzularım";
$locale['global_042'] = "Son ismarıclarım";
$locale['global_043'] = "Yeni ismarıclar";
$locale['global_044'] = "Mövzu";
$locale['global_045'] = "Baxılıb";
$locale['global_046'] = "Cavablar";
$locale['global_047'] = "Son ismarıc";
$locale['global_048'] = "Forum";
$locale['global_049'] = "Göndərilib";
$locale['global_050'] = "Müəllif";
$locale['global_051'] = "Sorğu";
$locale['global_052'] = "Köçürüldü";
$locale['global_053'] = "Mövzu açmamısınız.";
$locale['global_054'] = "Foruma heç ismarıc yazmamısınız.";
$locale['global_055'] = "Sonuncu dəfə daxil olunandan bəri foruma %u yeni ismarıc yazılıb.";
$locale['global_056'] = "İzlədiyim mövzular";
$locale['global_057'] = "Xüsusiyyətlər";
$locale['global_058'] = "Dayandır";
$locale['global_059'] = "Siz heç bir mövzunu izləmirsiniz.";
$locale['global_060'] = "Bu mövzunun izlənilməsi dayandırılsınmı?";
// News & Articles
$locale['global_070'] = "";
$locale['global_071'] = "tərəfindən yazılıb. Yazılma tarixi ->> ";
$locale['global_072'] = "<b>Davamını oxu</b>";
$locale['global_073'] = " dəfə rəy bildirilib";
$locale['global_073b'] = " Şərh";
$locale['global_074'] = " dəfə oxunulub";
$locale['global_075'] = "Çap et";
$locale['global_076'] = "Dəyiş";
$locale['global_077'] = "Xəbərlər";
$locale['global_078'] = "Hələ ki, xəbər əlavə edilməyib.";
$locale['global_079'] = "В ";
$locale['global_080'] = "Без категории";
// Page Navigation
$locale['global_090'] = "Əvvəlki";
$locale['global_091'] = "Sonrakı";
$locale['global_092'] = "Səhifə ";
$locale['global_093'] = " dən ";
// Guest User Menu
$locale['global_100'] = "Giriş";
$locale['global_101'] = "İstifadəçi adı";
$locale['global_102'] = "Şifrə";
$locale['global_103'] = "Məni xatırla";
$locale['global_104'] = "Daxil ol";
$locale['global_105'] = "<b><a href='".BASEDIR."register.php' class='side'>[ QEYDIYYAT ]</a></b>";
$locale['global_106'] = "<a href='".BASEDIR."lostpassword.php' class='side'> [ Şifrəmi unutmuşam ] </a></b>";
$locale['global_107'] = "Qeydiyyat";
$locale['global_108'] = "Şifrəmi unutmuşam";
// Member User Menu
$locale['global_120'] = "Şəxsi məlumatlar";
$locale['global_121'] = "Şəxsi ismarıclar";
$locale['global_122'] = "İstifadəçi siyahısı";
$locale['global_123'] = "İdarəetmə lövhəsi";
$locale['global_124'] = "Çıxış";
$locale['global_125'] = "Sizin %u yeni ";
$locale['global_126'] = "ismarıcınız var";
$locale['global_127'] = "ismarıcınız var";
$locale['global_128'] = "на утверждение";
$locale['global_129'] = "присланные";
// Poll
$locale['global_130'] = "Sorğu";
$locale['global_131'] = "Səs ver";
$locale['global_132'] = "Səs vermək üçün qeydiyyatlı istifadəçi kimi daxil olmalısınız.";
$locale['global_133'] = "Səs";
$locale['global_134'] = "Səs";
$locale['global_135'] = "Bütün səslərin cəmi: ";
$locale['global_136'] = "Sorğunun başlanma tarixi: ";
$locale['global_137'] = "Sorğunun bitdiyi tarixi: ";
$locale['global_138'] = "Sorğu arxivi";
$locale['global_139'] = "Siyahıdan sorğu seçin:";
$locale['global_140'] = "Baxış";
$locale['global_141'] = "Sorğuya bax";
$locale['global_142'] = "Sorğu yoxdur";

// Captcha
$locale['global_150'] = "Проверочный код:";
$locale['global_151'] = "Введите проверочный код:";

// Footer Counter
$locale['global_170'] = "dəfə görüntülənib";
$locale['global_171'] = "dəfə görüntülənib";
$locale['global_172'] = "Səhifə %s saniyəyə hazırlandı.";
// Admin Navigation
$locale['global_180'] = "İdarə etmə lövhəsi";
$locale['global_181'] = "Ana Səhifə";
$locale['global_182'] = "<strong>Diqqət:</strong> İdarəçi şifrəsində xəta var və ya şifrə daxil edilməmişdir.";
// Miscellaneous
$locale['global_190'] = "Sayta giriş məhdudlaşdırılmışdır";
$locale['global_191'] = "Sizin İP ünvanınız qara siyahıdadır..";
$locale['global_192'] = "<b>Saytdan çıxdınız </b> ";
$locale['global_193'] = "Sayta daxil oldunuz ";
$locale['global_194'] = "Sizin sayta girişiniz qadağan olunmuşdur.";
$locale['global_195'] = "Bu istifadəçi hesabı aktivləşdirilməmişdir.";
$locale['global_196'] = "Yanlış istifadəçi adı və ya şifrəsi.";
$locale['global_197'] = "Sizi istiqamətləndiririk...<br /><br />
Əgər gözləmək istəmirsinizsə onda [ <b><a href='index.php'>BURAYA</a></b> ] tıklayın";
$locale['global_198'] = "<strong>Diqqət:</strong> setup.php faylını təcili silin.";
$locale['global_199'] = "<strong>Diqqət:</strong> idarəçi şifrəsini qeyd etməmisiniz. <a href='".BASEDIR."edit_profile.php'>Şəxsi məlumatlar</a>a daxil olaraq şifrəni qeyd edin.";
//Titles
$locale['global_200'] = " - ";
$locale['global_201'] = ": ";
$locale['global_202'] = $locale['global_200']."Axtar";
$locale['global_203'] = $locale['global_200']."MVS";
$locale['global_204'] = $locale['global_200']."Forum";
//Themes
$locale['global_210'] = "Tərkibə get";
// No themes found
$locale['global_300'] = "Sayt görünüşü(theme) tapılmadı";
$locale['global_301'] = "Əfsuslar olsun ki, bəzi səbəblərdən səhifədə problem yaranıb. Əgər bu saytın idarəçisisinizsə PHP-Fusion v7 üçün uyğun olan bir tamaşa yükləyin. <br /><br /> Əgər saytın istifadəçisinizsə o zaman idarəçi ilə ".hide_email($settings['siteemail'])." e-mail ünvanı vasitəsi ilə əlaqə saxlayıb xətanı bildirin.";
$locale['global_302'] = "Seçilmiş sayt görünüşündə problem var.";
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
$locale['global_901'] = "Dil seçimi";

$locale['global_910'] = "Zəhmət olmasa deyin ki, Cars-Az.Com saytında olan elana görə zeng edirsiz.";

$locale['global_950'] = "Bələdçi";
$locale['global_951'] = "Navigasiya";
$locale['global_952'] = "Sosial şəbəkələrdə";
$locale['global_953'] = "İnformasiya";


$locale['adress'] = "AZ0001, Azərbaycan, Bakı";
$locale['email'] = "<a href='mailto:info@cars-az.com'>info@cars-az.com</a>";
$locale['phone'] = "<a href='tel:+994506702484'>(+994 50) 670-24-84</a>";
$locale['skype'] = "<a href='skype:cars-az?chat' rel='nofollow'>cars-az</a>";


//All rights reserved.
$locale['copy'] = "&copy; <a href='http://cars-az.com/' target='_blank'>Cars-Az</a>  2015-". date("Y") ."<br />Bütün haqlar qorunur.";

$locale['veziyyet_1'] = "Yeni";
$locale['veziyyet_2'] = "İşlənmiş";
$locale['veziyyet_3'] = "Retro";
$locale['veziyyet_4'] = "Vurulmuş";

$locale['oiltip_1'] = "Benzin";
$locale['oiltip_2'] = "Disel";
$locale['oiltip_3'] = "Qaz";
$locale['oiltip_4'] = "Qibrid";

$locale['gedenteker_1'] = "Arxa";
$locale['gedenteker_2'] = "Ön";
$locale['gedenteker_3'] = "Hamısı";

$locale['karopka_1'] = "Auto";
$locale['karopka_2'] = "Manual";
$locale['karopka_3'] = "Robot";

$locale['kuzareng_2'] = "Ağ";
$locale['kuzareng_12'] = "Bej";
$locale['kuzareng_11'] = "Bənövşəyi";
$locale['kuzareng_7'] = "Göy";
$locale['kuzareng_21'] = "Çəhrayı";
$locale['kuzareng_3'] = "Boz";
$locale['kuzareng_8'] = "Gümüşü";
$locale['kuzareng_9'] = "Mavi";
$locale['kuzareng_15'] = "Narıncı";
$locale['kuzareng_5'] = "Qara";
$locale['kuzareng_10'] = "Qəhvəyi";
$locale['kuzareng_1'] = "Qırmızı";
$locale['kuzareng_14'] = "Qızılı";
$locale['kuzareng_6'] = "Sarı";
$locale['kuzareng_35'] = "Tünd qırmızı";
$locale['kuzareng_27'] = "Yaş Asfalt";
$locale['kuzareng_4'] = "Yaşıl";

$locale['salonreng_2'] = "Ağ";
$locale['salonreng_12'] = "Bej";
$locale['salonreng_11'] = "Bənövşəyi";
$locale['salonreng_7'] = "Göy";
$locale['salonreng_21'] = "Çəhrayı";
$locale['salonreng_3'] = "Boz";
$locale['salonreng_8'] = "Gümüşü";
$locale['salonreng_9'] = "Mavi";
$locale['salonreng_15'] = "Narıncı";
$locale['salonreng_5'] = "Qara";
$locale['salonreng_10'] = "Qəhvəyi";
$locale['salonreng_1'] = "Qırmızı";
$locale['salonreng_14'] = "Qızılı";
$locale['salonreng_6'] = "Sarı";
$locale['salonreng_35'] = "Tünd qırmızı";
$locale['salonreng_27'] = "Yaş Asfalt";
$locale['salonreng_4'] = "Yaşıl";

$locale['ban_1'] = "Minik maşını";
$locale['ban_2'] = "Motosklet";
$locale['ban_3'] = "Qayiq";
$locale['ban_4'] = "Traktor";
$locale['ban_5'] = "Təyyarə";
$locale['ban_6'] = "Avtobus";
$locale['ban_7'] = "Yük maşını";
$locale['ban_8'] = "Qoşqu";
$locale['ban_9'] = "Avto ev";

$locale['kuza_1'] = "Universal";
$locale['kuza_2'] = "Sedan";
$locale['kuza_3'] = "Hatchback";
$locale['kuza_4'] = "Krossover";
$locale['kuza_5'] = "Kupe";
$locale['kuza_6'] = "Kabriolet";
$locale['kuza_7'] = "Miniven";
$locale['kuza_8'] = "Pikap";
$locale['kuza_9'] = "Limuzin";
$locale['kuza_10'] = "Scooter";
$locale['kuza_11'] = "Maxi scooter";
$locale['kuza_12'] = "Sport";
$locale['kuza_13'] = "Motorcycle classic";
$locale['kuza_14'] = "Motorcycle naked bike";
$locale['kuza_15'] = "Motorcycle tourism";
$locale['kuza_16'] = "Motorcycle sport tourism";
$locale['kuza_17'] = "Motorcycle sport";
$locale['kuza_18'] = "Motorcycle cross";
$locale['kuza_19'] = "Motorcycle trial";
$locale['kuza_20'] = "Motorcycle off road";
$locale['kuza_21'] = "Motorcycle supermoto";
$locale['kuza_22'] = "Motorcycle chopper";
$locale['kuza_23'] = "Motorcycle cruiser";
$locale['kuza_24'] = "Motorcycle sidecar";
$locale['kuza_25'] = "Motorcycle castom";
$locale['kuza_26'] = "Minimoto";
$locale['kuza_27'] = "Minimoto sport";
$locale['kuza_28'] = "Minimoto cross";
$locale['kuza_29'] = "Tricycle";
$locale['kuza_30'] = "Kvadrocycle";
$locale['kuza_31'] = "Kvadrocycle childrens";
$locale['kuza_32'] = "Kvadrocycle sports";
$locale['kuza_33'] = "Kvadrocycle utilitarian";
$locale['kuza_34'] = "Baggi";
$locale['kuza_35'] = "Vehicle amphibian";
$locale['kuza_36'] = "Golf car";
$locale['kuza_37'] = "Carting";
$locale['kuza_38'] = "Street";
$locale['kuza_39'] = "Trike";
$locale['kuza_40'] = "Motorcycle all round";
$locale['kuza_41'] = "Mopeds";
$locale['kuza_42'] = "Hydrocycle";
$locale['kuza_43'] = "Hydrocycle sports";
$locale['kuza_44'] = "Hydrocycle tourist";
$locale['kuza_45'] = "Boat";
$locale['kuza_46'] = "Boatmotors";
$locale['kuza_47'] = "Kateraandmotorsboat";
$locale['kuza_48'] = "Motorsyaxt";
$locale['kuza_49'] = "Sailingyaxt";
$locale['kuza_50'] = "Agriculture";
$locale['kuza_51'] = "Traktor";
$locale['kuza_52'] = "Traktor";
$locale['kuza_53'] = "Minitraktor";
$locale['kuza_54'] = "Motoblok";
$locale['kuza_55'] = "Combine";
$locale['kuza_56'] = "Seeder";
$locale['kuza_57'] = "Plug";
$locale['kuza_58'] = "Sprayer";
$locale['kuza_59'] = "Pochvoobrabatyvayuschaya";
$locale['kuza_60'] = "Kormouborochnaya";
$locale['kuza_61'] = "Sadovaya";
$locale['kuza_62'] = "Civil engineering";
$locale['kuza_63'] = "Excavator";
$locale['kuza_64'] = "Miniexcavator";
$locale['kuza_65'] = "Bulldozer";
$locale['kuza_66'] = "Avtokran";
$locale['kuza_67'] = "Tower crane";
$locale['kuza_68'] = "Motor grader";
$locale['kuza_69'] = "Recovery trucks";
$locale['kuza_70'] = "Asfaltozavod";
$locale['kuza_71'] = "Asphalt";
$locale['kuza_72'] = "Concrete";
$locale['kuza_73'] = "Betonoukladchik";
$locale['kuza_74'] = "Burovaya ustanovka";
$locale['kuza_75'] = "Diesel molot";
$locale['kuza_76'] = "Katok";
$locale['kuza_77'] = "Kompressor";
$locale['kuza_78'] = "Nasos";
$locale['kuza_79'] = "Recycler";
$locale['kuza_80'] = "Dorojnaya freza";
$locale['kuza_81'] = "Generator";
$locale['kuza_82'] = "Stacker";
$locale['kuza_83'] = "Lift table";
$locale['kuza_84'] = "Pogruzchiki";
$locale['kuza_85'] = "Frontalnye pogruzchiki";
$locale['kuza_86'] = "Minipogruzchiki";
$locale['kuza_87'] = "Teleskopicheskie pogruzchiki";
$locale['kuza_88'] = "Konteynernyy pogruzchik";
$locale['kuza_89'] = "Communal equipment";
$locale['kuza_90'] = "Cleaning cars";
$locale['kuza_91'] = "Truck communal";
$locale['kuza_92'] = "Assenizator";
$locale['kuza_93'] = "Ilososnaya mashina";
$locale['kuza_94'] = "Musorovoz";
$locale['kuza_95'] = "Sewer machine";
$locale['kuza_96'] = "Peskorazbrasyvayuschaya machine";
$locale['kuza_97'] = "Harvester";
$locale['kuza_98'] = "Snow machine";
$locale['kuza_99'] = "Spectransport";
$locale['kuza_100'] = "Vezdehod";
$locale['kuza_101'] = "Forvarder";
$locale['kuza_102'] = "Baggi";
$locale['kuza_103'] = "Ambulance";
$locale['kuza_104'] = "Armored car";
$locale['kuza_105'] = "Oborudovanie";
$locale['kuza_106'] = "Firetruck";
$locale['kuza_107'] = "Betonomesitel";
$locale['kuza_108'] = "Skreper";
$locale['kuza_109'] = "Excavator pogruzchik";
$locale['kuza_110'] = "Samolet";
$locale['kuza_111'] = "Vertolet";
$locale['kuza_112'] = "Mikrobus";
$locale['kuza_113'] = "Buses";
$locale['kuza_114'] = "City buses";
$locale['kuza_115'] = "Junction buses";
$locale['kuza_116'] = "Travel buses";
$locale['kuza_117'] = "Gruzovik";
$locale['kuza_118'] = "Truck shassi";
$locale['kuza_119'] = "Truck platforma";
$locale['kuza_120'] = "Truck bort";
$locale['kuza_121'] = "Truck tent";
$locale['kuza_122'] = "Samosval";
$locale['kuza_123'] = "Truck furgon";
$locale['kuza_124'] = "Refrejerator";
$locale['kuza_125'] = "Truck container";
$locale['kuza_126'] = "Truck tank";
$locale['kuza_127'] = "Truck betonomeshalka";
$locale['kuza_128'] = "Truck animal";
$locale['kuza_129'] = "Truck lesovoz";
$locale['kuza_130'] = "Multilift";
$locale['kuza_131'] = "Truck steklovoz";
$locale['kuza_132'] = "Truck avtovoz";
$locale['kuza_133'] = "Evakuator";
$locale['kuza_134'] = "1,5 t. qədər";
$locale['kuza_135'] = "3,5 t. qədər";
$locale['kuza_136'] = "3,5 t. çox";
$locale['kuza_137'] = "Kung";
$locale['kuza_138'] = "Legkovoy furgon";
$locale['kuza_139'] = "Pricep";
$locale['kuza_140'] = "Trailer shassi";
$locale['kuza_141'] = "Trailer platforma";
$locale['kuza_142'] = "Trailer bort";
$locale['kuza_143'] = "Trailer tent";
$locale['kuza_144'] = "Trailer tipper";
$locale['kuza_145'] = "Fuqon 1.5 t. qədər";
$locale['kuza_146'] = "Trailer container";
$locale['kuza_147'] = "Trailer tank";
$locale['kuza_148'] = "Trailer refrigerator";
$locale['kuza_149'] = "Trailer animal";
$locale['kuza_150'] = "Trailer lesovoz";
$locale['kuza_151'] = "Polupricep";
$locale['kuza_152'] = "Polupricep shassi";
$locale['kuza_153'] = "Polupricep platforma";
$locale['kuza_154'] = "Nyzkoramnaya platforma";
$locale['kuza_155'] = "Polupricep bort";
$locale['kuza_156'] = "Polupricep tent";
$locale['kuza_157'] = "Polupricep tipper";
$locale['kuza_158'] = "Polupricep container";
$locale['kuza_159'] = "Polupricep furgon";
$locale['kuza_160'] = "Polupricep tank";
$locale['kuza_161'] = "Polupricep betonomeshalka";
$locale['kuza_162'] = "Polupricep refrigerator";
$locale['kuza_163'] = "Polupricep lesovoz";
$locale['kuza_164'] = "Polupricep animal";
$locale['kuza_165'] = "Polupricep plitovoz";
$locale['kuza_166'] = "Polupricep avtovoz";
$locale['kuza_167'] = "Polupricep trailer";
$locale['kuza_168'] = "Pricep dacha";
$locale['kuza_169'] = "Lafet";
$locale['kuza_170'] = "Dom na kolesah";
$locale['kuza_171'] = "Mobile house";
$locale['kuza_172'] = "Offroader / SUV";

$locale['valyuta_1'] = "AZN";
$locale['valyuta_2'] = "USD";
$locale['valyuta_3'] = "EUR";

$locale['kredit_0'] = "Yox";
$locale['kredit_1'] = "Var";

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

$locale['zona_1'] = "Azərbaycan";
$locale['zona_2'] = "Xaric";

$locale['qorod_1'] = "Bakı";
$locale['qorod_2'] = "Qazax";
$locale['qorod_3'] = "Quba";
$locale['qorod_4'] = "Qusar";
$locale['qorod_5'] = "Gəncə";
$locale['qorod_6'] = "Yevlax";
$locale['qorod_7'] = "Zaqatala";
$locale['qorod_8'] = "İsmayıllı";
$locale['qorod_9'] = "Lənkəran";
$locale['qorod_10'] = "Masallı";
$locale['qorod_11'] = "Mingəçevir";
$locale['qorod_12'] = "Naftalan";
$locale['qorod_13'] = "Naxçıvan";
$locale['qorod_14'] = "Sumqayıt";
$locale['qorod_15'] = "Tovuz";
$locale['qorod_16'] = "Xaçmaz";
$locale['qorod_17'] = "Şamaxı";
$locale['qorod_18'] = "Şəmkir";
$locale['qorod_19'] = "Şəki";
$locale['qorod_20'] = "Şirvan";
$locale['qorod_21'] = "Ağdam";

$locale['qorod_51'] = "Gürcüstan";
$locale['qorod_52'] = "Aziya";
$locale['qorod_53'] = "Amerika";
$locale['qorod_54'] = "Yevropa";



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


$locale['davam_-62208000'] = "-2 il";
$locale['davam_-31104000'] = "-1 il";
$locale['davam_-15552000'] = "-6 ay";
$locale['davam_-12960000'] = "-5 ay";
$locale['davam_-10368000'] = "-4 ay";
$locale['davam_-7776000'] = "-3 ay";
$locale['davam_-5184000'] = "-2 ay";
$locale['davam_-2592000'] = "-1 ay";
$locale['davam_0'] = "Yox";
$locale['davam_2592000'] = "+1 ay";
$locale['davam_5184000'] = "+2 ay";
$locale['davam_7776000'] = "+3 ay";
$locale['davam_10368000'] = "+4 ay";
$locale['davam_12960000'] = "+5 ay";
$locale['davam_15552000'] = "+6 ay";
$locale['davam_31104000'] = "+1 il";
$locale['davam_62208000'] = "+2 il";


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


$locale['description_1'] = "buraxılış ili";
$locale['description_2'] = "vəziyyəti";
$locale['description_3'] = "yürüş %s km";
$locale['description_4'] = "yanacağın növü";
$locale['description_5'] = "mühərrikin həcmi %s sm3";
$locale['description_6'] = "mühərrikin gücü %s a.g.";


$locale['satilib_001'] = "Satılıb!";

?>