<?php
  $uname = $pswd = "";


  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uname = test_input($_POST["uname"]);
    $pswd = test_input($_POST["pswd"]);
    $json_array = array();

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
          if($pswd == $result['password'])
          {
            echo 1;
            array_push($json_array, 1, $uname);
            //header("Location: account.html");
          }
          else{
            echo 0;
            array_push($json_array, 0, "Invalid username/password");
            //header("Location: login.php");
          }
	      }
      }
      else
      {
        echo 0;
        array_push($json_array, 0, "Invalid username/password");
        //header("Location: login.php");
      }
    } catch(PDOException $e) {
      array_push($json_array, "Connection failed: ", $e->getMessage());
      echo "Connection failed: " . $e->getMessage();
    }
    echo json_encode($json_array);
    $conn = null;
  }

  function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
  }

?>
