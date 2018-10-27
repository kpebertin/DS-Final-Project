var openTab = function(evt, turbineID) {
    var i, tabcontent, tablinks;
    
    dashboardApp.fetchActiveTurbine(turbineID);
    
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    tablinks = document.getElementsByClassName("tabLink");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    document.getElementById(turbineID).style.display = "block";
    evt.currentTarget.className += " active";
}

function onloadDefault() {
    document.getElementById("defaultOpen").click();
}