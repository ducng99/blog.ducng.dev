@echo off

start "" php -S localhost:8080 -t public
start "" npx tailwindcss -i ./styles/tailwind.css -o ./public/assets/css/styles.css --postcss postcss.config.js --watch
start "" npx local-ssl-proxy --source 8081 --target 8080
