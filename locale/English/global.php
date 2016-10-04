<?php

// Locale Settings
setlocale(LC_TIME, "en","GB"); // Linux Server (Windows may differ)
$locale['charset'] = "UTF-8";
$locale['xml_lang'] = "en";
$locale['tinymce'] = "en";
$locale['phpmailer'] = "en";
$locale['fb_lang'] = "en_EN";

// Full & Short Months
$locale['months'] = "&nbsp|January|February|March|April|May|June|July|August|September|October|November|December";
$locale['shortmonths'] = "&nbsp|Jan|Feb|Mar|Apr|May|Jun|Jul|Aug|Sept|Oct|Nov|Dec";

// Standard User Levels
$locale['user0'] = "Public";
$locale['user1'] = "Member";
$locale['user2'] = "Administrator";
$locale['user3'] = "Super Administrator";
$locale['user_na'] = "N/A";
$locale['user_anonymous'] = "Anonymous User";
// Standard User Status
$locale['status0'] = "Active";
$locale['status1'] = "Banned";
$locale['status2'] = "Unactivated";
$locale['status3'] = "Suspended";
$locale['status4'] = "Security Banned";
$locale['status5'] = "Canceled";
$locale['status6'] = "Anonymous";
$locale['status7'] = "Deactivated";
$locale['status8'] = "Inactive";
// Forum Moderator Level(s)
$locale['userf1'] = "Moderator";
// Navigation
$locale['global_001'] = "Navigation";
$locale['global_002'] = "No links defined\n";
// Users Online
$locale['global_010'] = "Users Online";
$locale['global_011'] = "Guests Online";
$locale['global_012'] = "Members Online";
$locale['global_013'] = "No Members Online";
$locale['global_014'] = "Total Members";
$locale['global_015'] = "Unactivated Members";
$locale['global_016'] = "Newest Member";
// Forum Side panel
$locale['global_020'] = "Forum Threads";
$locale['global_021'] = "Newest Threads";
$locale['global_022'] = "Hottest Threads";
$locale['global_023'] = "No Threads created";
// Comments Side panel
$locale['global_025'] = "Latest Comments";
$locale['global_026'] = "No comments available";
// Articles Side panel
$locale['global_030'] = "Latest Articles";
$locale['global_031'] = "No Articles available";
// Downloads Side panel
$locale['global_032'] = "Latest Downloads";
$locale['global_033'] = "No Downloads available";
// Welcome panel
$locale['global_035'] = "Welcome";
// Latest Active Forum Threads panel
$locale['global_040'] = "Latest Active Forum Threads";
$locale['global_041'] = "My Recent Threads";
$locale['global_042'] = "My Recent Posts";
$locale['global_043'] = "New Posts";
$locale['global_044'] = "Thread";
$locale['global_045'] = "Views";
$locale['global_046'] = "Replies";
$locale['global_047'] = "Last Post";
$locale['global_048'] = "Forum";
$locale['global_049'] = "Posted";
$locale['global_050'] = "Author";
$locale['global_051'] = "Poll";
$locale['global_052'] = "Moved";
$locale['global_053'] = "You have not started any forum threads yet.";
$locale['global_054'] = "You have not posted any forum messages yet.";
$locale['global_055'] = "There are %u new posts in %u different threads since your last visit.";
$locale['global_056'] = "My Tracked Threads";
$locale['global_057'] = "Options";
$locale['global_058'] = "Stop";
$locale['global_059'] = "You're not tracking any threads.";
$locale['global_060'] = "Stop tracking this thread?";
// News & Articles
$locale['global_070'] = "Posted by ";
$locale['global_071'] = "on ";
$locale['global_072'] = "Read More";
$locale['global_073'] = " Comments";
$locale['global_073b'] = " Comment";
$locale['global_074'] = " Reads";
$locale['global_075'] = "Print";
$locale['global_076'] = "Edit";
$locale['global_077'] = "News";
$locale['global_078'] = "No News has been posted yet";
$locale['global_079'] = "In ";
$locale['global_080'] = "Uncategorised";
// Page Navigation
$locale['global_090'] = "Prev";
$locale['global_091'] = "Next";
$locale['global_092'] = "Page ";
$locale['global_093'] = " of ";
// Guest User Menu
$locale['global_100'] = "Login";
$locale['global_101'] = "Username";
$locale['global_102'] = "Password";
$locale['global_103'] = "Remember Me";
$locale['global_104'] = "Login";
$locale['global_105'] = "Not a member yet?<br /><a href='".BASEDIR."register.php' class='side'>Click here</a> to register.";
$locale['global_106'] = "Forgotten your password?<br />Request a new one <a href='".BASEDIR."lostpassword.php' class='side'>here</a>.";
$locale['global_107'] = "Register";
$locale['global_108'] = "Lost password";
// Member User Menu
$locale['global_120'] = "Edit Profile";
$locale['global_121'] = "Private Messages";
$locale['global_122'] = "Members List";
$locale['global_123'] = "Admin Panel";
$locale['global_124'] = "Logout";
$locale['global_125'] = "You have %u new ";
$locale['global_126'] = "message";
$locale['global_127'] = "messages";
$locale['global_128'] = "submission";
$locale['global_129'] = "submissions";
// Poll
$locale['global_130'] = "Member Poll";
$locale['global_131'] = "Submit Vote";
$locale['global_132'] = "You must login to vote.";
$locale['global_133'] = "Vote";
$locale['global_134'] = "Votes";
$locale['global_135'] = "Votes: ";
$locale['global_136'] = "Started: ";
$locale['global_137'] = "Ended: ";
$locale['global_138'] = "Polls Archive";
$locale['global_139'] = "Select a Poll to view from the list:";
$locale['global_140'] = "View";
$locale['global_141'] = "View Poll";
$locale['global_142'] = "There are no polls defined.";

// Captcha
$locale['global_150'] = "Validation Code:";
$locale['global_151'] = "Enter Validation Code:";

// Footer Counter
$locale['global_170'] = "unique visit";
$locale['global_171'] = "unique visits";
$locale['global_172'] = "Render time: %s seconds";
$locale['global_173'] = "Queries";
// Admin Navigation
$locale['global_180'] = "Admin Home";
$locale['global_181'] = "Return to Site";
$locale['global_182'] = "<strong>Notice:</strong> Admin Password not entered or incorrect.";
// Miscellaneous
$locale['global_190'] = "Maintenance Mode Activated";
$locale['global_191'] = "Your IP address is currently blacklisted.";
$locale['global_192'] = "Your user cookie has expired. Please log in again to proceed.";
$locale['global_193'] = "Could not set user cookie. Please make sure you have cookies enabled to be able to log in properly.";
$locale['global_194'] = "This account is currently suspended.";
$locale['global_195'] = "This account has not been activated.";
$locale['global_196'] = "Invalid username or password.";
$locale['global_197'] = "Please wait while we transfer you...<br /><br />
[ <a href='index.php'>Or click here if you do not wish to wait</a> ]";
$locale['global_198'] = "<strong>Warning:</strong> setup.php detected, please delete it immediately.";
$locale['global_199'] = "<strong>Warning:</strong> admin password not set, click <a href='".BASEDIR."edit_profile.php'>Edit Profile</a> to set it.";
//Titles
$locale['global_200'] = " - ";
$locale['global_201'] = ": ";
$locale['global_202'] = $locale['global_200']."Search";
$locale['global_203'] = $locale['global_200']."FAQ";
$locale['global_204'] = $locale['global_200']."Forum";
//Themes
$locale['global_210'] = "Skip to content";
// No themes found
$locale['global_300'] = "no theme found";
$locale['global_301'] = "We are really sorry but this page cannot be displayed. Due to some circumstances no site theme can be found. If you are a Site Administrator, please use your FTP client to upload any theme designed for <em>PHP-Fusion v7</em> to the <em>themes/</em> folder. After upload check in <em>Main Settings</em> to see if the selected theme was correctly uploaded to your <em>themes/</em> directory. Please note that the uploaded theme folder has to have the exact same name (including character case, which is important on Unix based servers) as chosen in <em>Main Settings</em> page.<br /><br />If you are regular member of this site, please contact the site\'s administrator via ".hide_email($settings['siteemail'])." e-mail and report this issue.";
$locale['global_302'] = "The Theme chosen in Main Settings does not exist or is incomplete!";
// JavaScript Not Enabled
$locale['global_303'] = "Oh no! Where's the <strong>JavaScript</strong>?<br />Your Web browser does not have JavaScript enabled or does not support JavaScript. Please <strong>enable JavaScript</strong> on your Web browser to properly view this Web site,<br /> or <strong>upgrade</strong> to a Web browser that does support JavaScript; <a href='http://firefox.com' rel='nofollow' title='Mozilla Firefox'>Firefox</a>, <a href='http://apple.com/safari/' rel='nofollow' title='Safari'>Safari</a>, <a href='http://opera.com' rel='nofollow' title='Opera Web Browser'>Opera</a>, <a href='http://www.google.com/chrome' rel='nofollow' title='Google Chrome'>Chrome</a> or a version of <a href='http://www.microsoft.com/windows/internet-explorer/' rel='nofollow' title='Internet Explorer'>Internet Explorer</a> newer then version 6.";
// User Management
// Member status
$locale['global_400'] = "suspended";
$locale['global_401'] = "banned";
$locale['global_402'] = "deactivated";
$locale['global_403'] = "account terminated";
$locale['global_404'] = "account anonymised";
$locale['global_405'] = "anonymous user";
$locale['global_406'] = "This account has been banned for the following reason:";
$locale['global_407'] = "This account has been suspended until ";
$locale['global_408'] = " for the following reason:";
$locale['global_409'] = "This account has been banned for security reasons.";
$locale['global_410'] = "The reason for this is: ";
$locale['global_411'] = "This account has been cancelled.";
$locale['global_412'] = "This account has been anonymized, probably becuase of inactivity.";
// Banning due to flooding
$locale['global_440'] = "Automatic Ban by Flood Control";
$locale['global_441'] = "Your account on ".$settings['sitename']."has been banned";
$locale['global_442'] = "Hello [USER_NAME],\n
Your account on ".$settings['sitename']." was caught posting too many items to the system in very short time from the IP ".USER_IP.", and have therefor been banned. This is done to prevent bots from submitting spam messages in rapid succession.\n
Please contact the site administrator at ".$settings['siteemail']." to have your account restored or report if this was not you causing this security ban.\n
".$settings['siteusername'];
// Lifting of suspension
$locale['global_450'] = "Suspension automatically lifted by system";
$locale['global_451'] = "Suspension lifted at ".$settings['sitename'];
$locale['global_452'] = "Hello USER_NAME,\n
The suspension of your account at ".$settings['siteurl']." has been lifted. Here are your login details:\n
Username: USER_NAME
Password: Hidden for security reasons\n
If you have forgot your password you can reset it via the following link: LOST_PASSWORD\n\n
Regards,\n
".$settings['siteusername'];
$locale['global_453'] = "Hello USER_NAME,\n
The suspension of your account at ".$settings['siteurl']." has been lifted.\n\n
Regards,\n
".$settings['siteusername'];
$locale['global_454'] = "Account reactivated at ".$settings['sitename'];
$locale['global_455'] = "Hello USER_NAME,\n
Last time you logged in your account was reactivated at ".$settings['siteurl']." and your account is no longer marked as inactive.\n\n
Regards,\n
".$settings['siteusername'];
// Function parsebytesize()
$locale['global_460'] = "Empty";
$locale['global_461'] = "Bytes";
$locale['global_462'] = "kB";
$locale['global_463'] = "MB";
$locale['global_464'] = "GB";
$locale['global_465'] = "TB";
//Safe Redirect
$locale['global_500'] = "You are being redirected to %s, please wait. If you're not redirected, click here.";

// Captcha Locales
$locale['global_600'] = "Validation Code";
$locale['recaptcha'] = "en";

//Miscellaneous
$locale['global_900'] = "Unable to convert HEX to DEC";


//My

$locale['global_901'] = "Locale";

$locale['global_910'] = "Please tell me that you found this ad at Cars-Az.Com.";


$locale['global_950'] = "Menu";
$locale['global_951'] = "Navigation";
$locale['global_952'] = "Social networks";
$locale['global_953'] = "Information";


$locale['adress'] = "AZ0001, Azerbaijan, Baku";
$locale['email'] = "<a href='mailto:info@cars-az.com'>info@cars-az.com</a>";
$locale['phone'] = "<a href='tel:+994506702484'>(+994 50) 670-24-84</a>";
$locale['skype'] = "<a href='skype:cars-az?chat' rel='nofollow'>cars-az</a>";




//All rights reserved.
$locale['copy'] = "&copy; <a href='http://cars-az.com/' target='_blank'>Cars-Az</a>  2015-". date("Y") ."<br />All rights reserved.";


$locale['veziyyet_1'] = "New car";
$locale['veziyyet_2'] = "Used cars";
$locale['veziyyet_3'] = "Retro car";
$locale['veziyyet_4'] = "Broken car";

$locale['oiltip_1'] = "Gasoline";
$locale['oiltip_2'] = "Diesel";
$locale['oiltip_3'] = "Gas";
$locale['oiltip_4'] = "Hybrid";

$locale['gedenteker_1'] = "Back";
$locale['gedenteker_2'] = "Front";
$locale['gedenteker_3'] = "Full";

$locale['karopka_1'] = "Automatic";
$locale['karopka_2'] = "Mechanical";
$locale['karopka_3'] = "Robotized";

$locale['kuzareng_2'] = "White";
$locale['kuzareng_12'] = "Beige";
$locale['kuzareng_11'] = "Purple";
$locale['kuzareng_7'] = "Blue";
$locale['kuzareng_21'] = "Pink";
$locale['kuzareng_3'] = "Gray";
$locale['kuzareng_8'] = "Silver";
$locale['kuzareng_9'] = "Light-blue";
$locale['kuzareng_15'] = "Orange";
$locale['kuzareng_5'] = "Black";
$locale['kuzareng_10'] = "Brown";
$locale['kuzareng_1'] = "Red";
$locale['kuzareng_14'] = "Golden";
$locale['kuzareng_6'] = "Yellow";
$locale['kuzareng_35'] = "Vinous";
$locale['kuzareng_27'] = "Wet asphalt";
$locale['kuzareng_4'] = "Green";

$locale['salonreng_2'] = "White";
$locale['salonreng_12'] = "Beige";
$locale['salonreng_11'] = "Purple";
$locale['salonreng_7'] = "Blue";
$locale['salonreng_21'] = "Pink";
$locale['salonreng_3'] = "Gray";
$locale['salonreng_8'] = "Silver";
$locale['salonreng_9'] = "Light-blue";
$locale['salonreng_15'] = "Orange";
$locale['salonreng_5'] = "Black";
$locale['salonreng_10'] = "Brown";
$locale['salonreng_1'] = "Red";
$locale['salonreng_14'] = "Golden";
$locale['salonreng_6'] = "Yellow";
$locale['salonreng_35'] = "Vinous";
$locale['salonreng_27'] = "Wet asphalt";
$locale['salonreng_4'] = "Green";

$locale['ban_1'] = "Cars";
$locale['ban_2'] = "Motorcycles";
$locale['ban_3'] = "Water transport";
$locale['ban_4'] = "Special";
$locale['ban_5'] = "Air transport";
$locale['ban_6'] = "Busses";
$locale['ban_7'] = "Trucks";
$locale['ban_8'] = "Trailers";
$locale['ban_9'] = "Motorhomes";


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
$locale['kuza_112'] = "Microbus (from 10 to 20 passengers)";
$locale['kuza_113'] = "Buses";
$locale['kuza_114'] = "City buses";
$locale['kuza_115'] = "Junction buses";
$locale['kuza_116'] = "Travel buses";
$locale['kuza_117'] = "Gruzovik";
$locale['kuza_118'] = "Truck shassi";
$locale['kuza_119'] = "Truck platforma";
$locale['kuza_120'] = "Truck bort";
$locale['kuza_121'] = "Truck tent";
$locale['kuza_122'] = "Truck tipper";
$locale['kuza_123'] = "Truck furgon";
$locale['kuza_124'] = "Truck refrigerator";
$locale['kuza_125'] = "Truck container";
$locale['kuza_126'] = "Truck tank";
$locale['kuza_127'] = "Truck betonomeshalka";
$locale['kuza_128'] = "Truck animal";
$locale['kuza_129'] = "Truck lesovoz";
$locale['kuza_130'] = "Multilift";
$locale['kuza_131'] = "Truck steklovoz";
$locale['kuza_132'] = "Truck avtovoz";
$locale['kuza_133'] = "Evakuator";
$locale['kuza_134'] = "Truck up to 1.5 t.";
$locale['kuza_135'] = "Truck up to 3.5 t.";
$locale['kuza_136'] = "Truck more 3.5 t.";
$locale['kuza_137'] = "Kung";
$locale['kuza_138'] = "Legkovoy furgon";
$locale['kuza_139'] = "Pricep";
$locale['kuza_140'] = "Trailer shassi";
$locale['kuza_141'] = "Trailer platforma";
$locale['kuza_142'] = "Trailer bort";
$locale['kuza_143'] = "Trailer tent";
$locale['kuza_144'] = "Trailer tipper";
$locale['kuza_145'] = "Trailer furgon up to 1.5";
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

$locale['kredit_0'] = "No";
$locale['kredit_1'] = "Yes";

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

$locale['muddet_1'] = "months";

$locale['ayliqodenish_1'] = "AZN";

$locale['qodovoy_1'] = "%";

$locale['zona_1'] = "Azerbaijan";
$locale['zona_2'] = "Abroad";

$locale['qorod_1'] = "Baky";
$locale['qorod_2'] = "Qazax";
$locale['qorod_3'] = "Quba";
$locale['qorod_4'] = "Qusar";
$locale['qorod_5'] = "Ganje";
$locale['qorod_6'] = "Yevlax";
$locale['qorod_7'] = "Zakatala";
$locale['qorod_8'] = "Ismaylly";
$locale['qorod_9'] = "Lankeran";
$locale['qorod_10'] = "Massally";
$locale['qorod_11'] = "Mingechevir";
$locale['qorod_12'] = "Naftalan";
$locale['qorod_13'] = "Naxchivan";
$locale['qorod_14'] = "Sumgait";
$locale['qorod_15'] = "Tovuz";
$locale['qorod_16'] = "Xachmas";
$locale['qorod_17'] = "Shamaxy";
$locale['qorod_18'] = "Shamkir";
$locale['qorod_19'] = "Shaky";
$locale['qorod_20'] = "Ali bayramly";
$locale['qorod_21'] = "Agdam";

$locale['qorod_51'] = "Georgia";
$locale['qorod_52'] = "Asia";
$locale['qorod_53'] = "America";
$locale['qorod_54'] = "Europe";



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


$locale['description_1'] = "year of production";
$locale['description_2'] = "condition";
$locale['description_3'] = "Haul  %s km";
$locale['description_4'] = "fuel type";
$locale['description_5'] = "Engine size %s sm3";
$locale['description_6'] = "capacity  %s a.g.";


$locale['satilib_001'] = "Sold!";
?>