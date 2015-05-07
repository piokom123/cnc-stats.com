jQuery(document).ready(function() {
    enableDateChange('rankingDate', 'rankingDateButton', '', typeof jQuery('#worldId').val() === 'undefined' || jQuery('#worldId').val() == '' ? false : true);
});

function changeRankingDate(dateFieldId, type, showWorld) {
    if (typeof showWorld === 'undefined') {
        showWorld = true;
    }

    var url = '/ranking/' + jQuery('#rankingType').val() + '/date/' + jQuery('#' + dateFieldId).val() + '/' + jQuery('#periodType').val();
    
    if (showWorld) {
        url = '/world/' + jQuery('#worldId').val() + url;
    }

    document.location.href = url;
}