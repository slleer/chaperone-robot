<?php
  $unameErr = $firstErr = $lastErr = $phoneErr = $emailErr = $pswdErr = $pswdMatchErr = "";
  $uname = $first = $last = $phone = $email = $pswd = $pswdMatch = "";
  $allClear = TRUE;

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["uname"])) {
      $unameErr = "Username is required";
      $allClear = FALSE;
    } else {
      $uname = test_input($_POST["uname"]);
      // check if username only contains letters and numbers
      if (!preg_match("/^[0-9a-zA-Z-']*$/",$uname)) {
        $unameErr = "Only letters and numbers are allowed";
        $allClear = FALSE;
      }
    }

    if (empty($_POST["first"])) {
      $firstErr = "First name is required";
      $allClear = FALSE;
    } else {
      $first = test_input($_POST["first"]);
      // check if username only contains letters
      if (!preg_match("/^[a-zA-Z-']*$/",$first)) {
        $firstErr = "Only letters are allowed";
        $allClear = FALSE;
      }
    }
    if (empty($_POST["last"])) {
      $lastErr = "Last name is required";
      $allClear = FALSE;
    } else {
      $last = test_input($_POST["last"]);
      // check if username only contains letters
      if (!preg_match("/^[a-zA-Z-']*$/",$last)) {
        $lastErr = "Only letters are allowed";
        $allClear = FALSE;
      }
    }
    if (empty($_POST["phone"])) {
      $phoneErr = "Phone number is required";
      $allClear = FALSE;
    } else {
      $phone = test_input($_POST["phone"]);
      // check if username only contains numbers
      if (!preg_match("/^[0-9-']*$/",$phone)) {
        $phoneErr = "Only numbers are allowed";
        $allClear = FALSE;
      }
    }

    if (empty($_POST["email"])) {
      $emailErr = "Email is required";
      $allClear = FALSE;
    } else {
      $email = test_input($_POST["email"]);
      // check if e-mail address is well-formed
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
        $allClear = FALSE;
      }
    }

    if (empty($_POST["pswd"])) {
      $pswdErr = "Password is required";
      $allClear = FALSE;
    } else {
      $pswd = test_input($_POST["pswd"]);
      $pswdMatch = test_input($_POST["pswdMatch"]);
      // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
      $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*-_]).{8,20}$/';
      if (!preg_match($pattern,$pswd)) {
        $pswdErr =  "Invalid password";
        $allClear = FALSE;
      } else {
        if($pswd != $pswdMatch) {
          $pswdMatchErr = "Passwords do not match";
          $allClear = FALSE;
        }
      }
    }
if ($allClear) {
    $servername = "localhost";
    $username = "team26-usr";
    $password = "team26-pass";
    $usrError = "";
    $emailError = "";
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
	 foreach($result as $row){
	    $usrName = $row['username'];
	    $mail = $row['email'];
	    echo $usrName . " was found ". $mail;
            $emailErr = "Email already exists";
            header("Location: signup.html");
	 }

      }
      else
      {
	$utype = "user";
	$insertData = array($uname, $first, $last, $pswd, $email, $phone, $utype);
        $sql = $conn->prepare( "INSERT INTO Users (username, firstName, lastName, password, email, phoneNum, userType) VALUES(?,?,?,?,?,?,?)");
        $sql->execute($insertData);
	echo "success";
	header("Location: account.html");
      }
    } catch(PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
    }
$conn = null;
  }

 }

  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

?>
