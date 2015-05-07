$(document).ready(function () {
    var closeText = "[ok]";
    var donationInfoStatus = readCookie("donationInfoStatus");
    if (donationInfoStatus === null) {
        donationInfoStatus = 0;
    } else {
        donationInfoStatus = parseInt(donationInfoStatus);
    }
    if (donationInfoStatus > 0 && donationInfoStatus % 5 == 0) {
        var donationBoxStyle = {
            position: "fixed",
            left: "10px",
            bottom: "10px",
            width: "200",
            "-webkit-border-radius": "10px",
            "-moz-border-radius": "10px",
            "border-radius": "10px",
            border: "1px solid #ccc",
            padding: "10px",
            "font-family": "Arial",
            "font-size": "12px",
            "background-color": "#AADAEF",
            display: "none",
            'color': 'black'
        };
        $(".donationBox").css(donationBoxStyle);
        $(".donationBox").html("We are happy to provide you informations you are looking for.<br />If you like our website and want to say \"thank you\", consider making donation to help us pay for servers :)<br /><a href=\"/thanks\">Just click here.</a><br />Every, even little, donation is appreciated!" + ' <a style="float:right;" href="#">' + closeText + "</a>");

        $(".donationBox").fadeIn(300);
        $(".donationBox a").click(function () {
            $(".donationBox").fadeOut(300);
        });
    }
    createCookie("donationInfoStatus", donationInfoStatus + 1, 60);
})