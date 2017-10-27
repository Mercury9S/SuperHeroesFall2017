<?php
/**
 * Created by PhpStorm.
 * User: Mr B
 * Date: 2017-10-26
 * Time: 9:59 PM
 */

  define('DB_SERVER', "localhost");
  define('DB_USER', "superheroes");
  define('DB_PASSWORD', "superh123");
  define('DB_DATABASE', "superheroes");
  define('DB_DRIVER', "mysql");

  if (isset($_POST['superhero_name_for_PHP'], $_POST['city_of_operation_for_PHP']))
  {
    try {
        $db = new PDO(DB_DRIVER . ":dbname=" . DB_DATABASE . ";host=" . DB_SERVER, DB_USER, DB_PASSWORD);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $db->prepare("INSERT INTO city_of_residence (PublicName, CityName)
                                                 VALUES (:public_name, :city_of_operation)");

        $stmt->bindParam(':public_name', $_POST['superhero_name_for_PHP'], PDO::PARAM_STR, 40);
        $stmt->bindParam(':city_of_operation', $_POST['city_of_operation_for_PHP'], PDO::PARAM_STR, 40);

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
