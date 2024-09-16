#!/bin/bash
cd /var/www/microservice
npm install
npm run build
tail -f /dev/null 