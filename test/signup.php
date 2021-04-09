<!DOCTYPE html>
<html lang="en">

  <head>

    <link rel="stylesheet" type="text/css" href="stylesheet26.css">

    <title>Team 26</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Stephen Leer, Team 26">

  </head>

  <body>
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
        echo "we got the all clear";
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



    <div class="heading">
      <h1>Chaperone Robot</h1>
    </div>
    <div class="sub_heading">
      <h3>Team 26</h3>
    </div>

    <div class="nav_bar">
      <hr>
      <a href="index.html" target="_self">Home</a>
      <a href="about.html">About Project</a>

      <div class="nav_right">
        <a href="login.php">Log in</a>
      </div>

    </div>


    <div class="signUpcard">
      <h2>Create Chaperone Robot Account</h2>
      <h5>Or <a href="login.php">log in</a> if you already have an account.</h5>
      <div style="background-image: url('images/loading_screen.png');" class="signUpfakeimg" >
        <div class="signUpBox">
          <form class="form" method="post" target="_self" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <label for="uname">User Name:</label>
            <input type="text" name="uname" placeholder="Enter User Name" value="<?php echo $uname;?>" autofocus>
            <span class="error">* <?php echo $unameErr;?></span>
            <h6>User name must contain only letters/numbers</h6>
            <br>
	    <label for="first">First Name</lable>
            <input type="text" name="first" placeholder="Enter First Name" value="<?php echo $first;?>">
            <span class="error">* <?php echo $firstErr;?></span>
            <br>
            <label for="last">Last Name</lable>
            <input type="text" name="last" placeholder="Enter Last Name" value="<?php echo $last;?>">
            <span class="error">* <?php echo $lastErr;?></span>
            <br>
            <label for="phone">Phone Number</lable>
            <input type="text" name="phone" placeholder="Enter Phone Number" value="<?php echo $phone;?>">
            <span class="error">* <?php echo $phoneErr;?></span>
            <br>
            <label for="email">Email address:</label>
            <input type="email" name="email" placeholder="Enter Email Address" value="<?php echo $email;?>">
            <span class="error">* <?php echo $emailErr;?></span>
            <br><br>
            <label for="pswd">Password:</label>
            <input type="password" name="pswd" placeholder="Enter Password">
            <span class="error">* <?php echo $pswdErr;?></span>
            <h6>Password must be between 8 and 20 characters long<br>
              Password must contain at least one number and at least one letter<br>
              Password must contain at least one uppercase and one lowercase letter<br>
              Password must contatin at least one speacial character (!@#$%^*)</h6>
            <br>
            <label for="pswdMatch"> Retype Password: </label>
            <input type="password" name="pswdMatch" placeholder="Retype Password">
            <span class="error">* <?php echo $pswdMatchErr;?></span>
            <input type="submit" name="submit" value="Sign Up!">

          </form>
        </div>
      </div>
      <p>

      </p>
    </div>

  </body>
</html>
