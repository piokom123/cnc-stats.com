jQuery(document).ready(function() {
    jQuery('#worldsLanguage').prop('selectedIndex', 0);
    jQuery('#worldsLanguage').on('change', function() {
	if (this.value == '') {
	    jQuery('.tile').css('display', 'block');
	} else {
	    jQuery('.tile').css('display', 'none');
	    jQuery('.tile' + this.value).css('display', 'block');
	}
    });
});