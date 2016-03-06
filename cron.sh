#!/usr/bin/env bash

echo "thing" > tester.txt
/usr/local/bin/php -q $(dirname $0)/public/index.php break_cache
