// making variables to represent the two divs

window.onload = function() {
  document.getElementById('home').addEventListener('click', DisplayHomePage, false);
  document.getElementById('about').addEventListener('click', DisplayAboutPage, false);
  document.getElementById('signup').addEventListener('click', DisplaySignupPage, false);
  document.getElementById('login').addEventListener('click', DisplayLoginPage, false);
  document.getElementById('account').addEventListener('click', DisplayAccountPage, false);
  document.getElementById('settings').addEventListener('click', DisplaySettingsPage, false);
  document.getElementById('logout').addEventListener('click', DisplayLogoutPage, false);

}
document.getElementById('account').style.display = 'none';
document.getElementById('settings').style.display = 'none';
document.getElementById('logout').style.display = 'none';

document.getElementById('aboutPage').style.display = 'none';
document.getElementById('signUpPage').style.display = 'none';
document.getElementById('loginPage').style.display = 'none';
document.getElementById('accountPage').style.display = 'none';
document.getElementById('settingsPage').style.display = 'none';



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
