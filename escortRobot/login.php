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
  $unameErr = $pswdErr = $loginErr = "";
  $uname = $pswd = "";
  $allClear = TRUE;

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["uname"])) {
      $unameErr = "Username is required";
      $allClear = FALSE;
    } else {
      $uname = test_input($_POST["uname"]);

    }

    if (empty($_POST["pswd"])) {
      $pswdErr = "Password is required";
      $allClear = FALSE;
    } else {
      $pswd = test_input($_POST["pswd"]);

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
        $stmt = $conn->prepare("SELECT * FROM Users WHERE username = ?");
        $data = array($uname);
        $stmt->execute($data);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchALL();
        if(!empty($result))
        {
          if($pswd == $result['password'])
          {
            header("Location: account.html");
          }
          else{
            $loginErr = "Invalid username/password";
            header("Location: login.php");
          }
        }
        else
        {
          header("Location: login.php");
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
        <a href="signup.php">Sign up</a>
      </div>

    </div>

    <div class="signUpcard loginPIC">
      <h2>Log in to your Chaperone Robot Account</h2>
      <h5>Don't have an account? Sign up for an account <a href="signup.php">here</a></h5>
      <div class="login" >
        <div class="signUpBox">
          <form class="form" method="post" target="_self" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <label for="uname">User Name:</label>
            <input type="text" name="uname" placeholder="Enter User Name" value="" autofocus>
            <span class="error">*<?php echo $unameErr;?></span>

            <br><br>
            <label for="pswd">Password:</label>
            <input type="password" name="pswd" placeholder="Enter Password">
            <span class="error">*<?php echo $pswdErr;?></span>

            <input type="submit" id="sub" name="submit" value="Log In!">
            <span class="error"><?php echo "*" . $loginErr;?></span>

          </form>
        </div>
      </div>
      <p>

      </p>
    </div>
    <script src="login.js" charset="utf-8"></script>
  </body>
</html>
