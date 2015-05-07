jQuery(document).ready(function() {
    jQuery('#nameInput').autocomplete({
	source: '/api/autocomplete.php?type=bases&worldId=' + jQuery('#worldId').val(),
	select: function(event, ui) {
            if(ui.item) {
              jQuery('#nameInput').val(ui.item.label);
              jQuery('#itemId').val(ui.item.value);
            } else {
              // "Nothing selected, input was " + this.value );
            }
            return false;
	}
    });

    jQuery('#viewButton').on('click', function() {
	var url = '/world/' + jQuery('#worldId').val() + '/base/' + jQuery('#itemId').val();
	document.location.href = url;
    });
});