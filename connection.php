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
    $conn = new PDO("oci:dbname=".$tns, 'cafe', 'cafe');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage() . PHP_EOL;
    echo $e->getLine();
}
