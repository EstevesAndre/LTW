function myFunction(x)
{
  x.classList.toggle("fa-thumbs-down");
}

function burguer_menu() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
      x.className += " responsive";
  } else {
      x.className = "topnav";
  }
}