function createCookie(a, b, c) {
    if (c) {
        var d = new Date;
        d.setTime(d.getTime() + c * 24 * 60 * 60 * 1e3);
        var e = "; expires=" + d.toGMTString()
    } else var e = "";
    document.cookie = a + "=" + b + e + "; path=/"
}

function readCookie(a) {
    var b = a + "=";
    var c = document.cookie.split(";");
    for (var d = 0; d < c.length; d++) {
        var e = c[d];
        while (e.charAt(0) == " ") e = e.substring(1, e.length);
        if (e.indexOf(b) == 0) return e.substring(b.length, e.length)
    }
    return null
}