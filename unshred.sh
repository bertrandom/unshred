#!/bin/bash

if [ -z "$1" ]
then
  echo "Usage: $0 file_to_process"
  exit
fi

for i in {0..19}
do
	offset=$[$i*32]
	index=$[$i+1]
	convert -crop "32x359+$offset" "$1" "$index.jpg"
done

FILE=out/order.txt

rm -f $FILE
rm -f unshredded.jpg

START=$(date +%s)

cd /var/www/recollect/unshred.recollect.com/mturk/aws-mturk-clt-1.3.0/hits/unshred/
./run.sh

cd /var/www/recollect/unshred.recollect.com/

echo "Waiting for someone to solve the puzzzle..."

while [ ! -f "$FILE" ]
do
    inotifywait -t 86400 -e create -e move_to "$(dirname $FILE)" &>/dev/null
done

END=$(date +%s)
DIFF=$(( $END - $START ))
echo "Puzzle solved in $DIFF seconds."

sleep 2

params=`cat $FILE`
convert +append $params unshredded.jpg
