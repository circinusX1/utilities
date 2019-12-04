#!/bin/bash
#
# watched over /dev/sda mounted drive. assuming this is a mechanical HDD
# it stops the drive from spinning assuring  longer live
# Run this form crontab as 'sudo crontab -e'
# */15 * * * *    /home/pi/RUN/watchsda.sh > /dev/null
#

echo "running: $(date)" >> ./running.txt
sfile="./sda-state.txt"
prevstate="*"
if [[ -f "$sfile" ]];then
	prevstate=$(cat "$sfile")
	echo "prevstate=$prevstate"
fi

cat /proc/diskstats | grep sda1 > "$sfile.cur"
curstate=$(cat "$sfile.cur")

echo "curstate = $curstate"

if [[ $prevstate == $curstate ]];then
	echo "state ! changed. stopping"
#	sdparm --flexible --command=sync /dev/sda &>/dev/null
#	sleep 2
#	sdparm --flexible --command=stop /dev/sda &>/dev/null
	sudo hdparm -y /dev/sda
else
	echo "state changed"
	mv  "$sfile.cur" "$sfile"
fi
