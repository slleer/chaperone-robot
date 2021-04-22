<?php


  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uname = test_input($_POST["uname"]);
    $result;

    $servername = "localhost";
    $username = "team26-usr";
    $password = "team26-pass";
    try {
      $conn = new PDO("mysql:host=$servername;dbname=UserInformation", $username, $password);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $stmt = $conn->prepare("SELECT * FROM EventInfo WHERE username = ?");
      $data = array($uname);
      $stmt->execute($data);
      $stmt->setFetchMode(PDO::FETCH_ASSOC);
      $result = $stmt->fetchALL();
      echo "{ \"trips\" : " . json_encode($result) . "}";
    } catch(PDOException $e) {
      echo "0" . " Connection failed: " . $e->getMessage();

    }
    echo json_encode($result);
  } //end if post

  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

?>
