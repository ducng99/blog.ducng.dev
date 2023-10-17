#!/bin/bash

tmux neww "php -S localhost:8080 -t public"
tmux neww "bunx tailwindcss -i ./styles/tailwind.css -o ./public/assets/css/styles.css --postcss postcss.config.js --watch"
tmux neww "bunx local-ssl-proxy --source 8081 --target 8080"
