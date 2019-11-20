# TP-PHP

* A basic php course project * 

## INSTALLATION:

  - In order to start the project, make sure you're running mysql 5.7+ locally.
  - create a file named `pdo.php` in `/model` directory : `touch model/pdo.php`
  - paste this content into it: 

```php
<?php
$server = 'localhost';
$dbname = '';
$user = 'root';
$password = '';

try{
    $pdo = new PDO('mysql:host='.$server.';dbname='.$dbname.';charset=utf8', $user, $password);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(Exception $e){
	die('Erreur :'.$e->getMessage());
}
```
  - change the mysql auth informations into your own.
