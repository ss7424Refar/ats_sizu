<?php
//  DB
define('DB_TYPE', 'mysql');
define('DB_USER', 'root');
define('DB_PASS', '123456');
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'tpms');
define('DB_PORT', '3306');
// add by refar
define('DB_TABLE_PREFIX', '');
define('DB_CHARSET', 'utf8');

define('JRDB_USER', 'root');
define('JRDB_PASS', 'root');
define('JRDB_HOST', '172.30.52.29');
define('JRDB_NAME', 'jiradb');
define('PMDB_NAME', 'pm'); // pm db name

// ats image path
//define('ATS_IMAGES_PATH', 'D:\download');
//define('ATS_IMAGES_PATH', '/mnt/atsShare/Image');
define('ATS_IMAGES_PATH', '/home/refar');

// ats task path
define('ATS_FILE_UNDERLINE', '_');
define('ATS_FILE_suffix', '.csv');
//define('ATS_PREPARE_PATH', 'D:/wnmp/www/ATS/ats/resource/prepare/');
//define('ATS_PREPARE_PATH', '/mnt/atsShare/TestPCs/');
//define('ATS_PREPARE_PATH', '/home/refar/Phpproject/ats_sizu/resource/prepare/');
define('ATS_PREPARE_PATH', '/home/refar/PhpstormProjects/ats_sizu/resource/prepare/');
define('ATS_PREPARE_FILE', 'TestPC');

//define('ATS_TMP_TASKS_PATH', 'D:/wnmp/www/ATS/ats/resource/tmp/');
//define('ATS_TMP_TASKS_PATH', '/home/refar/Phpproject/ats_sizu/resource/tmp/');
define('ATS_TMP_TASKS_PATH', '/home/refar/PhpstormProjects/ats_sizu/resource/tmp/');
define('ATS_TMP_TASKS_HEADER', 'Task'. ATS_FILE_UNDERLINE);
//define('ATS_TASKS_PATH', 'D:/wnmp/www/ATS/ats/resource/tasks/');
//define('ATS_TASKS_PATH', '/mnt/atsShare/Tasks/');
//define('ATS_TASKS_PATH', '/home/refar/Phpproject/ats_sizu/resource/tasks/');
define('ATS_TASKS_PATH', '/home/refar/PhpstormProjects/ats_sizu/resource/tasks/');
//define('ATS_FINISH_PATH', 'D:/wnmp/www/ATS/ats/resource/finish/');
define('ATS_FINISH_PATH', '/mnt/atsShare/Finished/');

/*
 * mail info
 */

define('SMTP_HOST', '172.30.52.43');
define('SMTP_PORT', 25);
define('MAIL_CC', json_encode(array('wanliang.xu@toshiba-tih.com', 'lin.zhu@toshiba-tih.com', 'lin.qiu@toshiba-tih.com', 'bin.yan@toshiba-tih.com', 'xiaoyan.ding@toshiba-tih.com')));
define('Mail_FROM', 'ats_swv@toshiba-tih.com');

/*
 * other
 */
define('EXPIRED', 'Expired');