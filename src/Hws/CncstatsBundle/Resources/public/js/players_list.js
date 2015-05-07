jQuery(document).ready(function() {
    enableAutocomplete('itemId', 'nameInput', 'players')

    jQuery('#viewButton').on('click', function() {
        if (jQuery('#itemId').val() == '') {
            alert('Write name of selected player in left field first.')
            return;
        }

        var url = '/world/' + jQuery('#worldId').val() + '/player/' + jQuery('#itemId').val();
        document.location.href = url;
    });
});