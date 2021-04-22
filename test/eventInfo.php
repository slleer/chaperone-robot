<?php
  $uname = $gps_lat = $gps_lon = $dateTime = $filePath = "";


  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uname = test_input($_POST["uname"]);
    $gps_lat = test_input($_POST["lat"]);
    $gps_lon = test_input($_POST["lon"]);
    $dateTime = test_input($_POST["dateTime"]);
    $filePath = "/var/www/html/userVideos/" . $uname ."/";
    $response_str = "";

    $currentFilePath = '/var/www/html/videos/';
    $foundVidName = findVideoName($dateTime, $currentFilePath);
    $currentFilePath .= $foundVidName;
    echo $currentFilePath;
    if(!is_dir($filePath) && file_exists($currentFilePath))
    {
      mkdir($filePath);
    }
    $filePath .= $foundVidName;
    echo $filePath;
    $fileMoved = rename($currentFilePath, $filePath);

    $servername = "localhost";
    $username = "team26-usr";
    $password = "team26-pass";
    try {
      $conn = new PDO("mysql:host=$servername;dbname=UserInformation", $username, $password);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $insertData = array($uname, $dateTime, $gps_lon, $gps_lat, $filePath);
      $sql = $conn->prepare( "INSERT INTO EventInfo (username, dateTime, gpsLong, gpsLat, filePath) VALUES(?,?,?,?,?)");
      $sql->execute($insertData);
      $response_str = "1";
    } catch(PDOException $e) {
      $response_str = "0" . " Connection failed: " . $e->getMessage();
    }
    echo $response_str;
    echo $filePath;
    $conn = null;
    // if($fileMoved){
	  //   echo 'success!';
    // }

  } //end if post
  function findVideoName($time, $currentFilePath){
    $vids = array_diff(scandir($currentFilePath), array('..', '.'));
    print_r($vids);
    foreach($vids as $key => $value)
    {
      $vidTime = strtotime(chop($value, ".h264"));
      //echo $vidTime . " " . $time . " " . ($vidTime+30);
      if(strtotime($time) < ($vidTime + 15) && strtotime($time) > ($vidTime - 15))
      {
        echo "we got to the return value";
        return $value;
      }
    }
    return false;

  }
  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

?>
