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
    class activeUsr {
      public $usrName;

      function set_name($name){
        $this->usrName = $name;
      }
      function get_name(){
        return $this->$usrName;
      }
    }
    $loginStr = "login";
    $registerStr = "register";
    $activeUsr = new activeUsr();
    $unameErr = $firstErr = $lastErr = $phoneErr = $emailErr = $pswdErr = $pswdMatchErr = $loginErr= "";
    $uname = $first = $last = $phone = $email = $pswd = $pswdMatch = "";
    function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $action = ($_POST["action"]);
      if(strcmp($action, $loginStr) == 0)
      {
        $unameErr = $pswdErr = $loginErr = "";
        $uname = $pswd = "";
        $allClear = TRUE;


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
                $activeUsr->set_name($uname);
                echo "<script src='twoForOne.js' type='text/javascript'> DisplayAccountPage();</script>";
                break;
              }
              else{
                $loginErr = "Invalid username/password";

              }
            }
          } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
          }
          $conn = null;
        }
      } elseif(strcmp($action, $registerStr) == 0)
      {
        $unameErr = $firstErr = $lastErr = $phoneErr = $emailErr = $pswdErr = $pswdMatchErr = "";
        $uname = $first = $last = $phone = $email = $pswd = $pswdMatch = "";
        $allClear = TRUE;





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
                if($usrName == $uname)
                {
                  $unameErr = "Username already exists.";
                }
                if($mail == $email)
                {
                  $emailErr = "Email already associated with account.";
                }

           }

              }
              else
              {
                $utype = "user";
                $insertData = array($uname, $first, $last, $pswd, $email, $phone, $utype);
                $sql = $conn->prepare( "INSERT INTO Users (username, firstName, lastName, password, email, phoneNum, userType) VALUES(?,?,?,?,?,?,?)");
                $sql->execute($insertData);
                $activeUsr->set_name($uname);
                echo "<script src='twoForOne.js' type='text/javascript'>DisplayAccountPage()</script>";
              }
            } catch(PDOException $e) {
              echo "Connection failed: " . $e->getMessage();
            }
        $conn = null;
          }

      }

    }

    ?>

<!--                          NAVIGATION BAR
///////////////////////////////////////////////////////////////////// -->

    <div class="heading">
      <h1>Chaperone Robot</h1>
    </div>
    <div class="sub_heading">
      <h3>Team 26</h3>
    </div>

    <div class="nav_bar">
      <hr>
      <a href="#" id="home">Home</a>
      <a href="#" id="about">About Project</a>

      <div class="nav_right">
      <a href="#" id="signup">Sign Up</a>
      <a href="#" id="login">Log in</a>
      <a href="#" id="settings">Settings</a>
      <a href="#" id='account'>Account</a>
      <a href="#" id="logout">Log out</a>
      </div>
    </div>


<!--                          HOME PAGE                             -->
<!-- ///////////////////////////////////////////////////////////////////// -->

<div id="homePage" class="row">
  <h2><a href="signup.html">Create</a> an account with Chaperone Robot</h2>
  <h5>Or <a href="login.html">log in</a> if you already have an account.</h5>
  <div class="cardBack" >
    <div class="card">
      <ul>
        <li>With an account, you will be able to sign into the Chaperone Robot IOS
        App and request a chaperone. You can alternately create an account
        through the Chaperone Robot IOS App directly.</li>
        <li>With an active account, you will also have access to past trips, including video footage
        (if you have opted to allow Chaperone Robot to record trips).</li>
        <li>In the event an incident occured, you will be able to find all details
        about the incident collected by the Chaperone Robot (based on permissions granted).</li>
      </ul>
        <img src="images/piracer.jpg" alt="PiRacer" width="90%" height="90%">
    </div>
  </div>
  <p>

  </p>
</div>

<!--                          ABOUT PAGE                            -->
<!-- ///////////////////////////////////////////////////////////// -->

    <div id="aboutPage" class="row">
      <h1>
        About Team 26's project.
      </h1>
      <div class="leftcolumn" >
        <div class="card">
          <h2>The Chaperone Robot Project</h2>
          <h3>Abstract</h3>
            <p>
              The Chaperone Robot will chaperone a user upon request from any point on the University of Nevada, Reno (UNR) campus. The robot will follow the user at close proximity while monitoring their trip to their car and will use visual and audio clues to identify potential threats to the user. In case of a threat, the robot will activate an audible and visual alarm, and contact emergency services via text message to report the incident. The text will include the location and a brief description of the incident. The text message may also include a link to a video (recording and/or live feed) of the incident, which enables the authorities to monitor the incident and identify the attacker.
            </p>
          <h3>Introduction</h3>
          <p>
            Team 26 is developing a security-focused chaperone robot with the intent of providing a safer and more dependable route for users on the University of Nevada, Reno (UNR) campus grounds.  The project is intended to feature autonomous image tracking and object recognition, offer a quick response alarm system, and the ability to alert emergency services through text message.  The goal is to provide UNR students and staff a method by which to use a chaperone robot and have it accompany them to their destination in order to feel more comfortable and secure walking campus grounds at any time of the day.
            <br><br>
            The user needs to create an account on the free Chaperone Robot iOS mobile application in order to request the robot to accompany them. Video and audio monitoring will be enabled for the duration of the trip, however, the user can choose whether the trip will be recorded and uploaded to the Chaperone Robot???s server. The user then will follow a series of instructions on the mobile application that will enable the robot to identify and recognize them as the object to be followed for that trip.
            <br><br>
            There haven???t been any significant changes in the project???s requirements since the completion of Project Part 2. Team 26 is still committed to designing a method for the robot to follow a user autonomously while providing the aforementioned security suite in order to deter an emergency situation and contact emergency services in the event of a security incident.
            <br><br>
            The team had made progress in the area of budgeting. A detailed document of required hardware with the links to purchase them has been created and shared with Computer Science personnel at UNR who are responsible for funding projects. The document helped Team 26 identify the components that will be used in the project and the various libraries, software, compilers, and techniques required to complete this project, such as OpenCV, Python, C++, and ROS & ROS2.
            <br><br>
            Team 26 has two advisors: Dr. Emily Hand and Dr. Keith Lancaster
          </p>
          <h3>Chaperone Robot's Components</h3>
          <h5>PiRacer</h5>
          <p>
            <img src="images/piracer.jpg" alt="PiRacer">
            The base of the Chaperone Robot will be a PiRacer, which is shown in figure 6. This will allow us to build and attach components on top of using IO_Pins and RasberryPi compatible sensors. When attaching components, we will use Fusion 360 to design and 3d print mounts for the sensors.
          </p>
          <h5>Raspberri Pi 4</h5>
          <p>
            <img src="images/rpi.jpg" alt="Raspberry Pi 4">
            The Chaperone Robot will have multiple Raspberry Pi???s, which is shown in Figure 2, to process the amount of data gathered from different sensors and to communicate with a master Raspberry Pi only when needed.
          </p>
          <h5>GPS, Accelerometer, Gryoscope, Altitude Sensor</h5>
          <p>
            <img src="images/GPS.jpg" alt="gps">
            The Chaperone Robot will be equipped with the hardware shown in figure 1 to provide the data such as GPS, Accelerometer, Gyroscope, and altitude information. The robot will need to keep track of GPS coordinates to help find a pathway back to a home location or when meeting up with a new client. The Accelerometer will keep track if the robot is stuck or the path was altered by an unknown object. The Gyroscope will allow us to keep track of information like the robot is currently going up a hill to allow for speed and digitally mapping of areas. The Altitude Sensor will provide information if the robot is currently on the right floor level.
          </p>
          <h5>Audio DAC HAT Sound Card</h5>
          <p>
            <img src="images/audiodevice.jpg" alt="audio card">
            The chaperone robot will use the Audio Sound card shown in Figure 5 to communicate. This will allow it to hear when there is a need for help by yelling the word help. This will also allow us to set off alarms to hopefully prevent incidents from happening when the chaperone robot is following.
          </p>
          <h5>Camera Module with 222 FOV Fisheyes wide Angle 5MP Webcam</h5>
          <p>
            <img src="images/camera.jpg" alt="Camera Module">
            In Figure 3 there is another camera shown which will be aimed towards a higher altitude direction to see and keep data of the target being followed by the chaperone robot. This one will be the one shown on the application while the other one is for path detection and is already a part of the base robot PiRacer.
          </p>
          <h5>Lidar</h5>
          <p>
            <img src="images/lidar.jpg" alt="Lidar">
            In figure 4 there is a lidar encoder which will be used by the Chaperone Robot. The lidar will be used to detect objects which are under the range of 12 meters in     360 degrees.
          </p>

        </div>
      </div>
      <div class="rightcolumn">
        <div class="card">
          <h2>Team 26's Members</h2>
          <h3>Chris Collum:</h3>
            <p>
              Database
            </p>
          <h3>Kevin Kurashewich:</h3>
            <p>
              IOS App
            </p>
          <h3>Omar Zerba:</h3>
            <p>
              IOS App
            </p>
          <h3>Stephen Leer:</h3>
            <p>
              Website/server
            </p>
        </div>
        <div class = "card">
            <h2>Class Info</h2>
            <h3>University of Nevada Reno, CSE Department</h3>
            <h3>Senior Project for CS 426</h3>
            <h3>Spring 2021</h3>
        </div>
        <div class = "card">
            <h2>Teachers</h2>
            <h3>Dr. David Feil-Seifer</h3>
            <h3>Dr. Devrin Lee</h3>
            <h2>Advisors</h2>
            <h3>Dr. Emily Hand</h3>
            <h3>Dr. Keith Lancaster</h3>
        </div>
        <div class = "card">
            <h2>Project Resources</h2>
            <a href=https://www.theconstructsim.com/robotigniteacademy_learnros/ros-courses-library/ros-courses-ros-basics-in-5-days-c/><h3>ROS learning</h3></a>
            <a href=https://www.ros.org><h3>ROS</h3></a>
            <a href=https://opencv.org><h3>OpenCV</h3></a>
            <a href=https://www.autodesk.com/campaigns/education/student-design><h3>Fusion 360</h3></a>
            <h2>Google Scholar Journals, etc.</h2>
            <a href=http://www.cim.mcgill.ca/~dudek/417/Papers/quigley-icra2009-ros.pdf><h3>ROS overview</h3></a>
            <a href=http://roswiki.autolabor.com.cn/attachments/Events(2f)ICRA2010Tutorial/ICRA_2010_OpenCV_Tutorial.pdf><h3>OpenCV PowerPoint with Important Links</h3></a>
            <a href=https://books.google.com/books?hl=en&lr=&id=_5sQAwAAQBAJ&oi=fnd&pg=PA2&dq=opencv&ots=8UkO6SS99U&sig=e_drlnqtQ4aDT-N3yE8rXj7UI9A#v=onepage&q=opencv&f=false><h3></h3>OpenCV Book</h3></a>
        </div>
      </div>
      <p>

      </p>
    </div>

<!--                          REGISTER PAGE                             -->
<!-- ///////////////////////////////////////////////////////////////////// -->

    <div id="signUpPage" class="signUpcard">
      <h2>Create Chaperone Robot Account</h2>
      <h5>Or <a href="login.html">log in</a> if you already have an account.</h5>
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
            <input type="hidden" name="action" value="register">
            <input type="submit" name="submit" value="Sign Up!">

          </form>
        </div>
      </div>
      <p>

      </p>
    </div>

<!--                        LOGIN PAGE                        -->
<!-- ////////////////////////////////////////////////////////////////////// -->

    <div id="loginPage" class="signUpcard loginPIC">
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
            <input type="hidden" name="action" value="login">
            <input type="submit" id="sub" name="submit" value="Log In!">
            <span class="error"><?php echo "*" . $loginErr;?></span>

          </form>
        </div>
      </div>
      <p>

      </p>
    </div>

<!--                           ACCOUNT PAGE                             -->
<!-- //////////////////////////////////////////////////////////////////////// -->

<div id="accountPage" class="row">
  <div class="cardBack" >
    <div class="card">
      <h3 id="accountTitle"></h3>
      <p id="pastTrips"></p>
    </div>
  </div>
  <p>

  </p>
</div>

<!--                        SETTINGS PAGE                        -->
<!-- ///////////////////////////////////////////////////////////////////////////// -->

<div id="settingsPage" class="row">
  <div class="cardBack" >
    <div class="card">
      <h2>Account Settings</h2>
      <h4>Make chanes to your account here:</h4>
      <form class="settingForm" action="" method="post">
        <label for="videoConsent">Consent to video recording: <input type="checkbox" name="videoConsent" value=""></label>
        <br>
        <p><small>By checking the box above, you consent to allow Chaperone Robot record video in the event of an incident. Any recording of an incident will be available from your account and will be kept private.</small></p>
        <br>
        <label for="audioConsent">Consent to audio recording: <input type="checkbox" name="videoConsent" value=""></label>
        <p><small>By checking the box above, you consent to allow Chaperone Robot record audio in the event of an incident. Any recording of an incident will be available from your account and will be kept private.</small></p>
        <br>
      </form>
    </div>
  </div>
  <p>

  </p>
</div>

    <script src="twoForOne.js" charset="utf-8"></script>
  </body>
</html>
