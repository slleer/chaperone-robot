<?php
  $uname = $first = $last = $phone = $email = $pswd = $pswdMatch = "";


  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uname = test_input($_POST["uname"]);
    $first = test_input($_POST["first"]);
    $last = test_input($_POST["last"]);
    $phone = test_input($_POST["phone"]);
    $email = test_input($_POST["email"]);
    $pswd = test_input($_POST["password"]);
    $json_array = array();

    $servername = "localhost";
    $username = "team26-usr";
    $password = "team26-pass";
    try {
      $conn = new PDO("mysql:host=$servername;dbname=UserInformation", $username, $password);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $stmt = $conn->prepare("SELECT * FROM Users WHERE username = ? OR email = ?");
      $data = array($uname, $email);
      $stmt->execute($data);
      $stmt->setFetchMode(PDO::FETCH_ASSOC);
      $result = $stmt->fetchALL();
      if(!empty($result))
      {
	      echo 0;
        $json_array[] = 0;
        foreach($result as $row){
          if($uname == $row['username']){
            echo "Username was found";
            $json_array[] = "This username is not available.";
          } else if($email == $row['email']) {
            echo "Email was found";
            $json_array[] = "This email is already associated with an account.";
          }

        }
        //header("Location: signup.html");
      } else {
        $utype = "user";
        $consent = 1;
        $insertData = array($uname, $first, $last, $pswd, $email, $phone, $utype, $consent);
        $sql = $conn->prepare( "INSERT INTO Users (username, firstName, lastName, password, email, phoneNum, userType, consent) VALUES(?,?,?,?,?,?,?,?)");
        $sql->execute($insertData);
        echo 1;
        array_push($json_array, 1, $insertData[0]);
        //header("Location: account.html");
      }
    } catch(PDOException $e) {
	    echo 0;
      echo "Connection failed: " . $e->getMessage();
      array_push($json_array, "Connection failed: ", $e->getMessage());
    }
    echo json_encode($json_array);
    print_r($_POST);
    $conn = null;


  } //end if post

  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

?>
