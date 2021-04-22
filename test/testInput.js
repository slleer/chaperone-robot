function input(event){
  event.preventDefault();
  updateAccont("slleer");


}


function updateAccont(username){
  if(username == null){

  } else {
    var uname = username;

    var xhttp = new XMLHttpRequest();
    xhttp.open("POST",'accountInfo.php', true);
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200){
        response = JSON.parse(this.responseText);
        alert(response)
	console.log(response);
        //print_r(response);
        for(i in response)  {
          document.getElementById("pastTrips").innerHTML += "<tr>" + "<td>" +  response[i].dateTime + "<\/td><td> " +
	  response[i].gpsLong + " " +  response[i].gpsLat + "</\td><td> " + "<a href=\"" + response[i].filePath + "\">Download<\/a><\/td></\tr>";
	  console.log(String(response[i].filePath));
         }




      }
    };
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    var data = "uname=" + uname;
    xhttp.send(data);
  }
}
