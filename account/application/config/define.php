<?php


    define('ROOT_DIR', dirname(dirname(dirname(__FILE__))));
    define('DS', DIRECTORY_SEPARATOR);
    define('PUBLIC_DIR', ROOT_DIR . DS . 'public' . DS);

    require_once ROOT_DIR . '/settings.php';
    require_once ROOT_DIR . '/application/libraries/T_ENV.php';

    // ini config file
    $fileName = ROOT_DIR . '/config.ini';

    $env = new T_ENV();
    $dataConf = $env->readFile($fileName);

    if (empty($dataConf) && count($dataConf) <= 0) die('Thiết lập cấu hình lỗi. Vui lòng liên hệ CSKH');

    // Define DB config
    define('DB_HOST', $dataConf['DB']['DB_HOST']);
    define('DB_USER', $dataConf['DB']['DB_USER']);
    define('DB_PASS', $dataConf['DB']['DB_PASS']);
    define('DB_NAME', $dataConf['DB']['DB_NAME']);

    define('APP_NAME', $settings['siteTitle']);
    define('APP_EMAIL', $settings['email']);
    define('APP_FACEBOOK', $settings['facebook']);
    define('APP_DESCRIPTION', $settings['description']);
    define('APP_KEYWORDS', $settings['keywords']);
    define('APP_AUTHOR', $settings['author']);

    define('MAIL_PROTOCOL', $dataConf['mail']['MAIL_PROTOCOL']);
    define('MAIL_TYPE', $settings['mailtype']);
    define('MAIL_WORDWRAP', $settings['wordwrap']);
    define('MAIL_CHARSET', $settings['charset']);

    define('MAIL_SMTP_HOST', $dataConf['mail']['MAIL_SMTP_HOST']);
    define('MAIL_SMTP_USER', $dataConf['mail']['MAIL_SMTP_USER']);
    define('MAIL_SMTP_PASS', $dataConf['mail']['MAIL_SMTP_PASS']);

    // Define Vippay API config
    define('MERCHANT_ID', $dataConf['vippay']['MERCHANT_ID']);
    define('API_USER', $dataConf['vippay']['API_USER']);
    define('API_PASS', $dataConf['vippay']['API_PASS']);

//    define('MERCHANT_ID_2', $dataConf['vippay']['MERCHANT_ID_2']);
//    define('API_USER_2', $dataConf['vippay']['API_USER_2']);
//    define('API_PASS_2', $dataConf['vippay']['API_PASS_2']);

    // Define Event constant
    define('BONUS', $dataConf['Event']['BONUS']);
    define('ITEMID', $dataConf['Event']['ITEMID']);
    define('DailyGiftITEMID', $dataConf['Event']['DailyGiftITEMID']);
    define('ItemType', $dataConf['Event']['ItemType']);
    define('ItemName', $dataConf['Event']['ItemName']);
    define('Quality', $dataConf['Event']['Quality']);

    // Online Gift Point
    define('ONLINE_GIFT_POINT', $dataConf['OnlineGift']['Point']);

    // Define Special Gift
    define('SG_ENABLE', $dataConf['SpecialGift']['SG_ENABLE']);
    define('SG_CALENDAR', $dataConf['SpecialGift']['SG_CALENDAR']);
    define('SG_ITEMID', $dataConf['SpecialGift']['SG_ITEMID']);
    define('SG_ITEMNAME', $dataConf['SpecialGift']['SG_ITEMNAME']);
    define('SG_ITEMTYPE', $dataConf['SpecialGift']['SG_ITEMTYPE']);
    define('SG_RATE', $dataConf['SpecialGift']['SG_RATE']);
    define('RECORD_RATE', $dataConf['SpecialGift']['RECORD_RATE']);
