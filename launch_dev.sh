#!/bin/bash

tmux neww "php -S localhost:8080 -t public"
tmux neww "npx tailwindcss -i ./styles/tailwind.css -o ./public/assets/css/styles.css --postcss postcss.config.js --watch"
tmux neww "npx local-ssl-proxy --source 8081 --target 8080"
