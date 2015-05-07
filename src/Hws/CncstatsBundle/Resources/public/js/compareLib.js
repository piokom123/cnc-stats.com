function showCompareDiv(id) {
    jQuery('.compareDivs').css('display', 'none');

    jQuery('#' + id).css('display', 'block');
}

function generateSlug(string) {
    string = string.toLowerCase();
    return string.replace(/[^a-zA-Z0-9]+/g,'-');
}

function enableAutocomplete(idDiv, nameDiv, type) {
    jQuery('#' + nameDiv).autocomplete({
        source: '/api/autocomplete.php?type=' + type + '&worldId=' + jQuery('#worldId').val(),
        select: function(event, ui) {
            if(ui.item) {
            jQuery('#' + nameDiv).val(ui.item.label);
            jQuery('#' + idDiv).val(ui.item.value);
            } else {
            // "Nothing selected, input was " + this.value );
            }
            return false;
        }
    });
}

function enableCompare(firstId, firstName, secondId, secondName, button, type) {
    jQuery('#' + button).on('click', function() {
	if (type == 'alliances') {
	    itemName = 'alliance';
	} else {
	    itemName = 'player';
	}

	if (jQuery('#' + firstId).val() == '' || jQuery('#' + firstName).val() == '') {
	    alert('You have to select first ' + itemName + ' to compare!');
	    return false;
	}

	if (jQuery('#' + secondId).val() == '' || jQuery('#' + secondName).val() == '') {
	    alert('You have to select second ' + itemName + ' to compare!');
	    return false;
	}
	var url = '/world/' + jQuery('#worldId').val() + '/compare/' + type + '/' + jQuery('#' + firstId).val() + '-' + jQuery('#' + secondId).val() + '/' + generateSlug(jQuery('#' + firstName).val()) + '-vs-' + generateSlug(jQuery('#' + secondName).val());
	document.location.href = url;
    });
}