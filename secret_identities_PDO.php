<?php
/**
 * Created by PhpStorm.
 * User: Mr B
 * Date: 2017-10-26
 * Time: 6:00 PM
 */
  define('DB_SERVER', "localhost");
  define('DB_USER', "superheroes");
  define('DB_PASSWORD', "superh123");
  define('DB_DATABASE', "superheroes");
  define('DB_DRIVER', "mysql");

  if (isset($_POST['public_name_for_PHP'], $_POST['real_first_name_for_PHP'], $_POST['real_last_name_for_PHP']))
  {
    try {
        $db = new PDO(DB_DRIVER . ":dbname=" . DB_DATABASE . ";host=" . DB_SERVER, DB_USER, DB_PASSWORD);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $db->prepare("INSERT INTO secret_identities(PublicName, RealFirstName, RealLastName)
                                                 VALUES (:public_name, :real_first_name, :real_last_name)");

        $stmt->bindParam(':public_name', $_POST['public_name_for_PHP'], PDO::PARAM_STR, 40);
        $stmt->bindParam(':real_first_name', $_POST['real_first_name_for_PHP'], PDO::PARAM_STR, 40);
        $stmt->bindParam(':real_last_name', $_POST['real_last_name_for_PHP'], PDO::PARAM_STR, 40);

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
