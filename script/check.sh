cd /home/refar/Phpproject/ats_sizu/script
nohup websocketd --port=8084 php checkPortStatus.php >> logDetect_$(date +\%Y\%m\%d).txt 2>&1 &
