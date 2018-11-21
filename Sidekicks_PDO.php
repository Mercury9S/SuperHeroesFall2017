<?php
/**
 * Created by PhpStorm.
 * User: Mr B
 * Date: 2017-10-26
 * Time: 9:47 PM
 */

  define('DB_SERVER', "localhost");
  define('DB_USER', "superheroes");
  define('DB_PASSWORD', "superh123");
  define('DB_DATABASE', "superheroes");
  define('DB_DRIVER', "mysql");

  if (isset($_POST['sidekick_name_for_PHP'], $_POST['associated_superhero_for_PHP']))
  {
    try {
        $db = new PDO(DB_DRIVER . ":dbname=" . DB_DATABASE . ";host=" . DB_SERVER, DB_USER, DB_PASSWORD);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $db->prepare("INSERT INTO Sidekicks (Sidekick, PublicName)
                                                 VALUES (:sidekick_name, :associated_superhero)");

        $stmt->bindParam(':sidekick_name', $_POST['sidekick_name_for_PHP'], PDO::PARAM_STR, 40);
        $stmt->bindParam(':associated_superhero', $_POST['associated_superhero_for_PHP'], PDO::PARAM_STR, 40);

        if($stmt->execute()) {
            echo '1 row has been inserted';
        }

        $db = null;
    }
    catch(PDOException $e) {
        trigger_error('Error occured while trying to insert into the DB:' . $e->getMessage(), E_USER_ERROR);
    }
  }
?>

