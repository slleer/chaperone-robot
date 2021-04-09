<?php
// Create connection to database
$con = mysqli_connect("localhost","team26-usr","team26-pass","UserInformation");

// Check connection
if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

// month value sent from the client with a POST request
$uname = $con->real_escape_string($_POST['$uname']);
$email = $con->real_escape_string($_POST['$email']);
$ustmt = $con->prepare("SELECT * FROM Users WHERE username = ?");
$ustmt->bind_param("s", $uname);
$ustmt->execute();
$uresult = $ustmt->get_result();
$estmt = $con->prepare("SELECT * FROM Users WHERE email = ?");
$estmt->bind_param("s", $email);
$estmt->execute();
$eresult = $estmt->get_result();
$json_array = array();

// Prepares all the results to be encoded in a JSON
if ($uresult->num_rows > 0)
{
  while($row = $uresult->fetch_assoc())
  {
    $user = $row['username'];
    $user_email = $row['email'];
    $thisUser = array("uname" => $user, "emai" => $user_email);
    array_push($json_array, $thisUser);
  }

}
elseif($eresult->num_rows > 0)
{
  while($row = euresult->fetch_assoc())
  {
    $user = $row['username'];
    $user_email = $row['email'];
    $thisUser = array("uname" => $user, "email" => $user_email);
    array_push($json_array, $thisUser);
  }
}
else {
  $first = $con->real_escape_string($_POST['$first']);
  $last = $con->real_escape_string($_POST['$last']);
  $phone = $con->real_escape_string($_POST['$phone']);
  $pswd = $con->real_escape_string($_POST['$pswd']);
  $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*-_]).{8,20}$/';
  if(!preg_match($pattern, $pswd)){
    $passError = array("pswd" => "Invalid Password");
  }
  else
  {
    $sql = "INSERT INTO Users (username, firstName, lastName, password, email, phoneNum, userType) VALUES ($uname, $first, $last, $pswd, $email, $phone, 'user')";
    if($conn->query($sql) == TRUE) {
      $result_message = array("message" => "successfully created new user!");
      array_push(json_array, $result_message);
    }
    else{
      $result_message = array("message" => "failed to create new user!");
      array_push(json_array, $result_message);
    }
  }
}
// encodes array with results from database
echo json_encode($json_array);

mysqli_close($con);
?>
