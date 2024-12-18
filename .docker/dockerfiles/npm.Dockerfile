FROM node:latest

WORKDIR /var/www/laravel

ENTRYPOINT ["npm", "--ignore-platform-reqs"]
