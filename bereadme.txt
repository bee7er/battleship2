
20251118
    Copied from version 1, battleships-game

    Get running native on the M4

    Sounds:  https://mixkit.co/free-sound-effects/explosion/
	
===========================================

This version is running native on the M4

    /usr/local/etc/nginx/servers/battleship2.test

    sudo vi /etc/hosts

    brew services restart nginx

To run locally in Chrome:

    http://battleship2.test

LIVE ENVIRONMENT

    https://www.namecheap.com/

    bee7er /

    From the Domain List seelct the middle Products Icon to Go to CPanel

Use GIT

    git refused to use 'battleships'.  Something went wrong when I originally tried to use it and
    even though I deleted the folder from here and at github, it still would not work.  So
    had to switch it to a new name, battleships-game, and subsequently battleship2

    git clone git@github.com:bee7er/battleship2.git

    # undo a changed file
    git checkout -- <file>

Mysql:

		mysql -uroot -psecret

        create database battle2_db;

        CREATE USER 'battle2'@'localhost' IDENTIFIED BY 'CanstockAble754&';
        GRANT ALL ON `battle2_db`.* TO 'battle2'@'localhost';

        use battle2_db;

PHP:

    php artisan migrate
    php artisan db:seed

    php artisan migrate:reset

    php artisan down        - go offline, creates a file 'down' in storage/framework folder
    php artisan up


FTP:

    FTP Username: battle@sinkmyboats.co.uk
    FTP server: ftp.sinkmyboats.co.uk
    FTP & explicit FTPS port:  21
    PAth:  /home/sinkmyyr

    Pwd: eOHI1nXUM6My



Special FTP accounts:
    FTP Username: sinkmyyr
    FTP server: ftp.sinkmyboats.co.uk
    FTP & explicit FTPS port:  21


    FTP Username: sinkmyyr_logs
    FTP server: ftp.sinkmyboats.co.uk
    FTP & explicit FTPS port:  21

