// making variables to represent the two divs

window.onload = function() {
  document.getElementById('home').addEventListener('click', DisplayHomePage, false);
  document.getElementById('about').addEventListener('click', DisplayAboutPage, false);
  document.getElementById('signup').addEventListener('click', DisplaySignupPage, false);
  document.getElementById('login').addEventListener('click', DisplayLoginPage, false);
  document.getElementById('account').addEventListener('click', DisplayAccountPage, false);
  document.getElementById('settings').addEventListener('click', DisplaySettingsPage, false);
  document.getElementById('logout').addEventListener('click', DisplayLogoutPage, false);
  document.querySelector("div.signUpfakeimg input[name='uname']").addEventListener('input', TestUsername);
  document.querySelector("div.signUpfakeimg input[name='first']").addEventListener('input', TestFirst);
  document.querySelector("div.signUpfakeimg input[name='last']").addEventListener('input', TestLast);
  document.querySelector("div.signUpfakeimg input[name='phone']").addEventListener('input', TestPhone);
  document.querySelector("div.signUpfakeimg input[name='email']").addEventListener('input', TestEmail);
  document.querySelector("div.signUpfakeimg input[name='pswd']").addEventListener('input', TestPassword);
  document.querySelector("div.signUpfakeimg input[name='pswdMatch']").addEventListener('input', MatchPassword);

}
document.getElementById('account').style.display = 'none';
document.getElementById('settings').style.display = 'none';
document.getElementById('logout').style.display = 'none';

document.getElementById('aboutPage').style.display = 'none';
document.getElementById('signUpPage').style.display = 'none';
document.getElementById('loginPage').style.display = 'none';
document.getElementById('accountPage').style.display = 'none';
document.getElementById('settingsPage').style.display = 'none';

function RegistrationValidation(){
  var valid = true;
  var errorMsg = "* Please enter a valid ";
  var uname = document.forms["regForm"]["uname"].value;
  var first = document.forms["regForm"]["first"].value;
  var last = document.forms["regForm"]["last"].value;
  var phone = document.forms["regForm"]["phone"].value;
  var email = document.forms["regForm"]["email"].value;
  var password = document.forms["regForm"]["pswd"].value;
  var passMatch = document.forms["regForm"]["pswdMatch"].value;
  if(!(/^[0-9a-zA-Z\']{1,20}$/.test(uname))){
    valid = false;
    document.querySelector("div.signUpfakeimg span[class='error uname']").textContent = errorMsg.concat("username. *");
  }
  if (!(/^[a-zA-Z]{1,20}$/.test(first))) {
    valid = false;
    document.querySelector("div.signUpfakeimg span[class='error first']").textContent = errorMsg.concat("first name. *");
  }
  if (!( /^[a-zA-Z]{1,20}$/.test(last))){
    valid = false;
    document.querySelector("div.signUpfakeimg span[class='error last']").textContent = errorMsg.concat("last name. *");
  }
  if (!(/^[0-9]{10}$/.test(phone))){
    valid = false;
    document.querySelector("div.signUpfakeimg span[class='error phone']").textContent = errorMsg.concat("phone number. *");
  }
  if (!(/[a-z0-9!#$%\&\'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%\&\'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/.test(email))){
    valid = false;
    document.querySelector("div.signUpfakeimg span[class='error email']").textContent = errorMsg.concat("email address. *");
  }
  if (!(/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[\!\@\#\(\)\$\%\^\+\&\=\*\-\_]).{8,20}$/.test(password))){
    valid = false;
    document.querySelector("div.signUpfakeimg span[class='error password']").textContent = errorMsg.concat("password. *");
  }
  if (password.localeCompare(passMatch) != 0) {
    valid = false;
    document.querySelector("div.signUpfakeimg span[class='error passMatch']").textContent = "* Passwords do not match. *";
  }
  return valid;


}

function TestUsername(e) {
  var errorMsg = "* Please enter a valid username *";
  var usrNameRegEx = new RegExp('^[0-9a-zA-Z\']{1,20}$');
  if(!usrNameRegEx.test(e.target.value)){
    document.querySelector("div.signUpfakeimg span[class='error uname']").textContent = errorMsg;
  } else {
    errorMsg = "";
    document.querySelector("div.signUpfakeimg span[class='error uname']").textContent = errorMsg;
  }
}
function TestFirst(e) {
  var errorMsg = "* Please enter your first name *";
  var nameRegEx = new RegExp('^[a-zA-Z]{1,20}$');
  if(!nameRegEx.test(e.target.value)){
    document.querySelector("div.signUpfakeimg span[class='error first']").textContent = errorMsg;
  } else {
    errorMsg = "";
    document.querySelector("div.signUpfakeimg span[class='error first']").textContent = errorMsg;
  }
}
function TestLast(e) {
  var errorMsg = "* Please enter your last name *";
  var nameRegEx = new RegExp('^[a-zA-Z]{1,20}$');
  if(!nameRegEx.test(e.target.value)){
    document.querySelector("div.signUpfakeimg span[class='error last']").textContent = errorMsg;
  } else {
    errorMsg = "";
    document.querySelector("div.signUpfakeimg span[class='error last']").textContent = errorMsg;
  }
}
function TestPhone(e) {
  var errorMsg = "* Please enter a valid phone number *";
  var phoneRegEx = new RegExp('^[0-9]{10}$')
  if(!phoneRegEx.test(e.target.value)){
    document.querySelector("div.signUpfakeimg span[class='error phone']").textContent = errorMsg;
  } else {
    errorMsg = "";
    document.querySelector("div.signUpfakeimg span[class='error phone']").textContent = errorMsg;
  }
}
// not the best email regEx but works for now
function TestEmail(e) {
  var errorMsg = "* Please enter a valid email *";
  var emailRegEx = new RegExp('[a-z0-9!#$%\&\'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%\&\'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?');
  if(!emailRegEx.test(e.target.value)){
    document.querySelector("div.signUpfakeimg span[class='error email']").textContent = errorMsg;
  } else {
    errorMsg = "";
    document.querySelector("div.signUpfakeimg span[class='error email']").textContent = errorMsg;
  }
}
function TestPassword(e) {
  var errorMsg = "* Please enter a valid password *";
  var passwordRegEx = new RegExp('^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[\!\@\#\(\)\$\%\^\+\&\=\*\-\_]).{8,20}$');
  if(!passwordRegEx.test(e.target.value)){
    document.querySelector("div.signUpfakeimg span[class='error password']").textContent = errorMsg;
  } else {
    errorMsg = "";
    document.querySelector("div.signUpfakeimg span[class='error password']").textContent = errorMsg;
  }
}
function MatchPassword(e) {
  var errorMsg = "* Password does not match *";
  var pass = document.querySelector("div.signUpfakeimg input[name='pswd']").value;
  if(pass.localeCompare(e.target.value)){
    document.querySelector("div.signUpfakeimg span[class='error passMatch']").textContent = errorMsg;
  } else {
    errorMsg = "";
    document.querySelector("div.signUpfakeimg span[class='error passMatch']").textContent = errorMsg;
  }
}


function DisplayHomePage() {
  document.getElementById('aboutPage').style.display = 'none';
  document.getElementById('signUpPage').style.display = 'none';
  document.getElementById('loginPage').style.display = 'none';
  document.getElementById('accountPage').style.display = 'none';
  document.getElementById('settingsPage').style.display = 'none';
  document.getElementById('homePage').style.display = 'block';

  document.getElementById('account').style.display = 'none';
  document.getElementById('settings').style.display = 'none';
  document.getElementById('logout').style.display = 'none';
  document.getElementById('signup').style.display = 'block';
  document.getElementById('login').style.display = 'block';
}
function DisplayAboutPage() {
  document.getElementById('signUpPage').style.display = 'none';
  document.getElementById('loginPage').style.display = 'none';
  document.getElementById('accountPage').style.display = 'none';
  document.getElementById('homePage').style.display = 'none';
  document.getElementById('settingsPage').style.display = 'none';
  document.getElementById('aboutPage').style.display = 'block';

  document.getElementById('account').style.display = 'none';
  document.getElementById('settings').style.display = 'none';
  document.getElementById('logout').style.display = 'none';
  document.getElementById('signup').style.display = 'block';
  document.getElementById('login').style.display = 'block';
}

function DisplaySignupPage() {
  document.getElementById('aboutPage').style.display = 'none';
  document.getElementById('loginPage').style.display = 'none';
  document.getElementById('accountPage').style.display = 'none';
  document.getElementById('settingsPage').style.display = 'none';
  document.getElementById('homePage').style.display = 'none';
  document.getElementById('signUpPage').style.display = 'block';

  document.getElementById('account').style.display = 'none';
  document.getElementById('settings').style.display = 'none';
  document.getElementById('logout').style.display = 'none';
  document.getElementById('signup').style.display = 'none';
  document.getElementById('login').style.display = 'block';
}
function DisplayLoginPage() {
  document.getElementById('aboutPage').style.display = 'none';
  document.getElementById('signUpPage').style.display = 'none';
  document.getElementById('accountPage').style.display = 'none';
  document.getElementById('settingsPage').style.display = 'none';
  document.getElementById('homePage').style.display = 'none';
  document.getElementById('loginPage').style.display = 'block';

  document.getElementById('account').style.display = 'none';
  document.getElementById('settings').style.display = 'none';
  document.getElementById('logout').style.display = 'none';
  document.getElementById('login').style.display = 'none';
  document.getElementById('signup').style.display = 'block';
}
function DisplayAccountPage() {
  document.getElementById('aboutPage').style.display = 'none';
  document.getElementById('signUpPage').style.display = 'none';
  document.getElementById('loginPage').style.display = 'none';
  document.getElementById('settingsPage').style.display = 'none';
  document.getElementById('homePage').style.display = 'none';
  document.getElementById('accountPage').style.display = 'block';

  document.getElementById('account').style.display = 'none';
  document.getElementById('signup').style.display = 'none';
  document.getElementById('login').style.display = 'none';
  document.getElementById('logout').style.display = 'block';
  document.getElementById('settings').style.display = 'block';
}

function DisplaySettingsPage() {
  document.getElementById('aboutPage').style.display = 'none';
  document.getElementById('signUpPage').style.display = 'none';
  document.getElementById('loginPage').style.display = 'none';
  document.getElementById('accountPage').style.display = 'none';
  document.getElementById('homePage').style.display = 'none';
  document.getElementById('settingsPage').style.display = 'block';

  document.getElementById('settings').style.display = 'none';
  document.getElementById('signup').style.display = 'none';
  document.getElementById('login').style.display = 'none';
  document.getElementById('account').style.display = 'block';
  document.getElementById('logout').style.display = 'block';
}
function DisplayLogoutPage() {
  document.getElementById('aboutPage').style.display = 'none';
  document.getElementById('signUpPage').style.display = 'none';
  document.getElementById('loginPage').style.display = 'none';
  document.getElementById('accountPage').style.display = 'none';
  document.getElementById('settingsPage').style.display = 'none';
  document.getElementById('homePage').style.display = 'block';

  document.getElementById('account').style.display = 'none';
  document.getElementById('settings').style.display = 'none';
  document.getElementById('logout').style.display = 'none';
  document.getElementById('signup').style.display = 'block';
  document.getElementById('login').style.display = 'block';
}
