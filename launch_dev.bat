@echo off

start "" php -S localhost:8080 -t public
start "" npx tailwindcss -i ./app/ThirdParty/tailwind.css -o ./public/assets/css/styles.css --watch --minify
start "" npx local-ssl-proxy --source 8081 --target 8080
