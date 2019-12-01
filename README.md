# TP-PHP

Authors: Somveille Quentin - Billot Romain

* A basic php course project * 

## REQUIRMENTS:
  - PHP 7.1+

## INSTALLATION:

  - In order to start the project, make sure you're running mysql 5.7+ locally.
  - copy the `config/db.dist.php` to `config/db.php`: `cp config/db.dist.php config/db.php`
  - change the credentials to your mysql configuration in `config/db.php`
  - copy the `config/base_path.dist.php` to `config/base_path.php`
  - change the `BASE_PATH` to whatever base path you're using. This allow you to run multiple instance of apache2
  and have the app running.