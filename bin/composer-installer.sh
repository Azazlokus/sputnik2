#!/bin/bash

cd ../server/app

if [ -d "vendor" ]; then
    echo "Vendor directory already exists. Skipping composer install..."
else
    composer install --ignore-platform-reqs
fi
