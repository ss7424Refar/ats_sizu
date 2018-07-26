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

// ats image path
//define('ATS_IMAGES_PATH', 'D:\download');
define('ATS_IMAGES_PATH', '/home/refar');

// ats task path
define('ATS_FILE_UNDERLINE', '_');
define('ATS_FILE_suffix', '.csv');
//define('ATS_PREPARE_PATH', 'D:/wnmp/www/ATS/ats/resource/prepare/');
define('ATS_PREPARE_PATH', '/home/refar/Phpproject/ats_sizu/resource/prepare/');
define('ATS_PREPARE_FILE', 'TestPC');

//define('ATS_TMP_TASKS_PATH', 'D:/wnmp/www/ATS/ats/resource/tmp/');
define('ATS_TMP_TASKS_PATH', '/home/refar/Phpproject/ATS/ats/resource/tmp/');
define('ATS_TMP_TASKS_HEADER', 'Task'. ATS_FILE_UNDERLINE);
//define('ATS_TASKS_PATH', 'D:/wnmp/www/ATS/ats/resource/tasks/');
define('ATS_TASKS_PATH', '/mnt/atsShare/Tasks/');
//define('ATS_FINISH_PATH', 'D:/wnmp/www/ATS/ats/resource/finish/');
define('ATS_FINISH_PATH', '/mnt/atsShare/Finished/');

