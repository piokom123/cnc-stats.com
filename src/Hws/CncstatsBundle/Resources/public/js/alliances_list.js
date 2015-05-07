jQuery(document).ready(function() {
    enableAutocomplete('itemId', 'nameInput', 'alliances');

    jQuery('#viewButton').on('click', function() {
        if (jQuery('#itemId').val() == '') {
            alert('Write name of selected alliance in left field first.')
            return;
        }

        var url = '/world/' + jQuery('#worldId').val() + '/alliance/' + jQuery('#itemId').val();
        document.location.href = url;
    });
});