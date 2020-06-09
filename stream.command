#!/bin/bash

cd "$(dirname "$0")"
php -S localhost:65010 index.php &
open http://localhost:65010/
