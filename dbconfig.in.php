

<?php

define('DBHOST', 'localhost'); 
define('DBNAME', 'web1212179_db');
define('DBUSER', 'web1212179_dbuser'); 
define('DBPASS', 'dania1212179'); 

try {
  
    $pdo = new PDO("mysql:host=" . DBHOST . ";dbname=" . DBNAME, DBUSER, DBPASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo 'Error connecting to the database: ' . $e->getMessage();
    die();
}


?>

