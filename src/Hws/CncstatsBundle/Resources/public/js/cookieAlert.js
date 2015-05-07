$(document).ready(function () {
    var privacyUrl = "http://www.google.com/privacy.html";
    var closeText = "[ok]";
    var cookieStatus = readCookie("cookieStatus");
    if (cookieStatus != 1) {
        var cookieBoxStyle = {
            position: "fixed",
            right: "10px",
            bottom: "10px",
            width: "200",
            "-webkit-border-radius": "10px",
            "-moz-border-radius": "10px",
            "border-radius": "10px",
            border: "1px solid #ccc",
            padding: "10px",
            "font-family": "Arial",
            "font-size": "12px",
            "background-color": "#efefef",
            display: "none",
	    'color': 'black'
        };
        $(".cookieWarningBox").css(cookieBoxStyle);
        $(".cookieWarningBox").html("This website uses 'cookies' to give you the best, most relevant experience. Using this website means you're happy with this. If not, you can disable cookies in your browser" + '. <a style="float:right;" href="#">' + closeText + "</a>");

        $(".cookieWarningBox").fadeIn(300);
        $(".cookieWarningBox a").click(function () {
            $(".cookieWarningBox").fadeOut(300);
            createCookie("cookieStatus", 1, 60)
        })
    }
})