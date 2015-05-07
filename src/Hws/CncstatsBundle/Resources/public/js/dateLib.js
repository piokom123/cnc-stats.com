function enableNewDateChange() {
    jQuery('#selectedDate').datepicker({
        dateFormat: 'yy-mm-dd',
        defaultDate: new Date('now'),
        firstDay: 1
    });
    
    if (jQuery('#selectedDate').val().length === 0) {
        jQuery('#selectedDate').datepicker('setDate', new Date());
    } else {
        jQuery('#selectedDate').datepicker('setDate', jQuery('#selectedDate').val());
    }
    
    jQuery('#selectedDateButton').on('click', function() {
        document.location.href = jQuery('#baseUrl').val().replace('{date}', jQuery('#selectedDate').val());
    });
}

function enableDateChange(fieldId, buttonId, type, showWorld, changeCallback) {
    jQuery('#' + fieldId).datepicker({
	dateFormat: 'yy-mm-dd',
	defaultDate: new Date('now'),
        firstDay: 1
    });

    if (jQuery('#' + fieldId).val().length == 0) {
	jQuery('#' + fieldId).datepicker('setDate', new Date());
    } else {
	jQuery('#' + fieldId).datepicker('setDate', jQuery('#' + fieldId).val());
    }

    jQuery('#' + buttonId).on('click', function() {
        if (typeof changeCallback === 'function') {
            changeCallback(fieldId, type, showWorld);
        } else {
            changeRankingDate(fieldId, type, showWorld);
        }
    });
}

function changeRankingDate(dateFieldId, type, showWorld) {
    if (typeof showWorld === 'undefined') {
        showWorld = true;
    }

    var url = '/' + type + '/date/' + jQuery('#' + dateFieldId).val();
    
    if (showWorld) {
        url = '/world/' + jQuery('#worldId').val() + url;
    }

    if (jQuery('#rankingType').val().length > 0) {
        url = url + '/';
    }

    url = url + jQuery('#rankingType').val();

    document.location.href = url;
}

function changeChartsDate(dateFieldId, basicUrl, showWorld) {
    var url = basicUrl + "date/" + jQuery('#' + dateFieldId).val();
    document.location.href = url;
}