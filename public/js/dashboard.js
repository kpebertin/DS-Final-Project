var openTurbineTab = function(evt, turbineID) {
    var i, tabcontentTurbine, tablinksTurbine;

    tabcontentTurbine = document.getElementsByClassName("tabcontentTurbine");
    for (i = 0; i < tabcontentTurbine.length; i++) {
        tabcontentTurbine[i].style.display = "none";
    }

    tablinksTurbine = document.getElementsByClassName("tabLinkTurbine");
    for (i = 0; i < tablinksTurbine.length; i++) {
        tablinksTurbine[i].className = tablinksTurbine[i].className.replace(" active", "");
    }

    document.getElementById(turbineID).style.display = "block";
    evt.currentTarget.className += " active";
}

var openSiteTab = function(evt, siteID) {
    var i, tabcontentSite, tablinksSite;

    tabcontentSite = document.getElementsByClassName("tabcontentSite");
    for (i = 0; i < tabcontentSite.length; i++) {
        tabcontentSite[i].style.display = "none";
    }

    tablinksSite = document.getElementsByClassName("tabLinkSite");
    for (i = 0; i < tablinksSite.length; i++) {
        tablinksSite[i].className = tablinksSite[i].className.replace(" active", "");
    }

    document.getElementById(siteID).style.display = "block";
    evt.currentTarget.className += " active";
}

function onloadDefault() {
    document.getElementById("defaultOpenSite").click();
    document.getElementById("defaultOpenTurbine").click();
}