#!/bin/bash

cd "$(dirname "$0")"
php -S localhost:65010 index.php &
sleep 1
open http://localhost:65010/
