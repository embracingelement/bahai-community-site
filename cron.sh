#!/usr/bin/env bash

/usr/local/bin/php -q $(dirname $0)/public/index.php break_cache debug_off > public/index.html
echo "success" > cronsuccess.txt
