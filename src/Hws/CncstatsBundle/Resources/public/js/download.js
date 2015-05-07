var currentTime = 5;
var timer = null;
function startTimer() {
    currentTime = 5;
    timer = setInterval(changeTimer, 1000);
}
function changeTimer() {
    currentTime--;
    if (currentTime <= 0) {
        jQuery('#timer').html('now');
        clearInterval(timer);
        document.location.href = document.location.href;
        return;
    }

    jQuery('#timer').html('in ' + currentTime + ' ' + (currentTime === 1 ? 'second' : 'seconds'));
}

jQuery(document).ready(function() {
    startTimer();
})