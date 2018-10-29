var openTab = function(evt, turbineID) {
    var i, tabcontent, tablinks;
    
    if(typeof turbineID == 'number') {
        dashboardApp.fetchActiveTurbine(turbineID);
    }
    
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

var openTabSD = function(evt, sdID) {
    var i, tabcontent, tablinks;
    
    if(typeof sdID == 'number') {
        dashboardApp.fetchActiveTurbine(sdID);
    }
    
    tabcontent = document.getElementsByClassName("tabcontentSD");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    tablinks = document.getElementsByClassName("tabLinkSD");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    document.getElementById(sdID).style.display = "block";
    evt.currentTarget.className += " active";
}


function onloadDefault() {
    document.getElementById("defaultOpen").click();
}