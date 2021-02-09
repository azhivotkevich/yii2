```BASH
docker-compose exec webserver /bin/bash
cd /var/www/html
composer install
```

to view nginx logs
```BASH
docker-compose exec nginx /bin/bash
tail -f /var/log/nginx/yii2_error.log
```
