<?php

require_once 'source/db_connect.php';

if(isset($_POST['signup-btn'])) {

      $fname = $_POST['user-fname'];
      $lname = $_POST['user-lname'];
      $username = $_POST['user-name'];
      $email = $_POST['user-email'];
      $password = $_POST['user-pass'];

      $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    try {
      $SQLInsert = "INSERT INTO users (fname, lname, username, password, email, to_date)
                   VALUES (:fname, :lname, :username, :password, :email, now())";

      $statement = $conn->prepare($SQLInsert);
      $statement->execute(array(':fname' => $fname ,':lname' => $lname, ':username' => $username, ':password' => $hashed_password, ':email' => $email));

      if($statement->rowCount() == 1) {
        header('location: index.html');
      }
    }
    catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
    }

}

?>