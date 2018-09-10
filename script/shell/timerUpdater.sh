#!/bin/bash
# update expired and send mail
# 00 1 * * * ~/mysqlbk.sh (凌晨1点执行)
cd /home/phpwebsites/ats/script
#cd /home/refar/Phpproject/ats_sizu/script
nohup php update4Task_timer.php >> log/timerUpdate_$(date +\%Y\%m\%d).txt 2>&1 &