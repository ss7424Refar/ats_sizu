#!/bin/bash
# detect for port status when linux starting
cd /home/phpwebsites/ats/script
nohup websocketd --port=8084 php checkPortStatus.php >> log/logDetect_$(date +\%Y\%m\%d).txt 2>&1 &
