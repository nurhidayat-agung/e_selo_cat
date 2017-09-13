
function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
    document.getElementById("main").style.marginLeft = "250px";
    document.getElementById("open").style.display = "none";
    document.getElementById("close").style.display = "inline-block";
    document.getElementById("nav-barbar").style.marginLeft = "250px";
}

/* Set the width of the side navigation to 0 and the left margin of the page content to 0 */
function closeNav() {
    document.getElementById("mySidenav").style.width = "0px";
    document.getElementById("main").style.marginLeft = "0";
    document.getElementById("open").style.display = "inline-block";
    document.getElementById("close").style.display = "none";
    document.getElementById("nav-barbar").style.marginLeft = "0";
}


function startTime() {
    var today = new Date();
    var d = today.toDateString();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('time').innerHTML = d +" - " + h + ":" + m + ":" + s;
    var t = setTimeout(startTime, 500);
}
function checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
}

