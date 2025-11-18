
20250907
    Get running native on the M4

    Sounds:  https://mixkit.co/free-sound-effects/explosion/
	
===========================================

This version is running native on the M4

    /usr/local/etc/nginx/servers/battleships.test

    sudo vi /etc/hosts

    brew services restart nginx

To run locally in Chrome:

    http://battleships.test

Use GIT

    git clone git@github.com:bee7er/battleships.git

    # undo a changed file
    git checkout -- <file>

Mysql:

		mysql -uroot -psecret

        create database battle_db;

        CREATE USER 'battle'@'localhost' IDENTIFIED BY 'CanstockAble754&';
        GRANT ALL ON `battle_db`.* TO 'battle'@'localhost';

        use battle_db;

PHP:

    php artisan migrate
    php artisan db:seed

    php artisan migrate:reset

    php artisan down        - go offline, creates a file 'down' in storage/framework folder
    php artisan up