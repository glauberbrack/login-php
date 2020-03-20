<?php
  session_start();

  if(isset($_POST['email']) && empty($_POST['email']) == false){
    $email = addslashes($_POST['email']);
    $password = md5(addslashes($_POST['password']));

    $dns = "mysql:dbname=login_php;host=localhost";
    $dbuser= "root";
    $dbpass = "";

    try{
      $db = new PDO($dns, $dbuser, $dbpass);

      $sql = $db->query("SELECT * FROM users WHERE email = '$email' AND password = '$password'");

      if($sql->rowCount() > 0){
        $data = $sql->fetch();

        $_SESSION['id'] = $data['id'];

        header("Location: index.php");
      }


    }catch(PDOException $e){
      echo "Fail: ".$e->getMessage();
    }
  }
?>

<form method="POST">

  Email:<br/>
  <input type="email" name="email"><br/>

  Password:<br/>
  <input type="password" name="password"><br/>

  <br/>
  <input type="submit">Logar</input>

</form>