


window.onload = function() {
  document.getElementById('switch').addEventListener('click', switchBack, false);
}

function switchBack() {
  var account = document.querySelector('#account');
  var settings = document.querySelector('#settings');
  if(account.style.display === 'none') {
    account.style.display = 'block';
    settings.style.display = 'none';
  }  else {
    account.style.display = 'none';
    settings.style.display = 'block';
  }

}
var pastTrips = document.getElementById('pastTrips');
var accTitle = document.getElementById('accountTitle');
pastTrips.textContent = "You do not have any past trips with Chaperone Robot."
accTitle.textContent = "Welcome User";
