$(document).ready(function () {
    var blocked = false;
    jQuery('.cncAdvert').each(function() {
        if (jQuery(this).height() === 0) {
            blocked = true;
        }
    });

    if (blocked) {
        var boxStyle = {
            position: "fixed",
            left: "10px",
            top: "50%",
            width: "200",
            "-webkit-border-radius": "10px",
            "-moz-border-radius": "10px",
            "border-radius": "10px",
            border: "1px solid #ccc",
            padding: "10px",
            "font-family": "Arial",
            "font-size": "12px",
            "background-color": "#A52A2A",
            display: "none",
            'color': '#FDDFFF'
        };
        $(".advertWarningBox").css(boxStyle);
        $(".advertWarningBox").html("You're using software to block adverts on our website.<br />"
                + "Our adverts are not annoying and will not disturb you while using website.<br />"
                + "Clicks from that adverts gives us money to constantly work on this project and provide you more and more useful informations so please don't block them here<br /><br />"
                + "<a href=\"/adverts\">Click here if you want to know more</a>");

        $(".advertWarningBox").fadeIn(300);
    }
})