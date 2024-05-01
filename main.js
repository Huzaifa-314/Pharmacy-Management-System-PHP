//tab in user.php

function openTab(evt, tabName) {
  // Declare all variables
  var i, tabcontent, tablinks;

  // Get all elements with class="tabcontent" and hide them
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  // Get all elements with class="tablinks" and remove the class "active"
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }

  // Show the current tab, and add an "active" class to the button that opened the tab
  document.getElementById(tabName).style.display = "block";
  evt.currentTarget.className += " active";
}



// sign in & up tab
logintab = document.getElementsByClassName("logintab");
signuptab = document.getElementsByClassName("signuptab");
inbtn=document.getElementsByClassName("sign-in-b");
upbtn=document.getElementsByClassName("sign-up-b");
upbtn.addEventListener("click", function(){
  logintab.style.display="none";
  signuptab.style.display="block";
});
inbtn.addEventListener("click", function(){
  logintab.style.display="block";
  signuptab.style.display="none";
});
