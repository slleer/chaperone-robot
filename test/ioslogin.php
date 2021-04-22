<?php
  $uname = $pswd = "";


  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uname = test_input($_POST["uname"]);
    $pswd = test_input($_POST["password"]);
    $json_str = "";
    $servername = "localhost";
    $username = "team26-usr";
    $password = "team26-pass";
    try {
      $conn = new PDO("mysql:host=$servername;dbname=UserInformation", $username, $password);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $stmt = $conn->prepare("SELECT * FROM Users WHERE username = ?");
      $data = array($uname);
      $stmt->execute($data);
      $stmt->setFetchMode(PDO::FETCH_ASSOC);
      $result = $stmt->fetchALL();
      if(!empty($result))
      {
	      if(isset($result)){
          if($pswd == $result[0]['password'])
          {
            $json_str = "1username:" . $uname . "&consent:" . $result[0]['consent'];
            //header("Location: account.html");
          }
          else{
            $json_str =  "0";
            //header("Location: login.php");
          }
	      }
      }
      else
      {
        $json_str =  "0";
        //header("Location: login.php");
      }
    } catch(PDOException $e) {
      $json_str = "0 " . "Connection failed: " . $e->getMessage();
    }
    echo $json_str;
    $conn = null;
  }

  function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
  }

?>
