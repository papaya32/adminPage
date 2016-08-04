document.getElementById("papFoot").innerHTML = 
"<p>&copy; " + new Date().getFullYear() + " PapI. All rights reserved.</p>";

document.getElementById("nav01").innerHTML =
"<ul id='menu'>" +
"<li><a href='tester.php'>Home</a></li>" +
"<li><a href='devices.php'>Devices</a></li>" +
"<li><a href='locations.php'>Locations</a></li>" +
"<li><a href='rules.php'>Rules</a></li>" +
"<li><a href='access/logout.php'><font color='red'>Logout</font></a></li>" +
"</ul>";

var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
