<?php

header('Access-Control-Allow-Origin: *');
$tns = "
(DESCRIPTION =
    (ADDRESS_LIST =
      (ADDRESS = (PROTOCOL = TCP)(HOST = localhost)(PORT = 1521))
    )
    (CONNECT_DATA =
      (SERVICE_NAME = xe)
    )
  )
       ";
try {
  $pdo = new PDO("oci:dbname=" . $tns . ";charset=AL32UTF8", 'cafe', 'cafe');
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
} catch (PDOException $e) {
  echo 'ERROR AT LINE ' . $e->getLine() . PHP_EOL . $e->getMessage() . PHP_EOL;
}
