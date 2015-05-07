var signatureSelectedType = 0;
var signatureUploadedCode = null;

function loadImagePreview(input) {
    var files = input.files ? input.files : input.currentTarget.files;
    if (files && files[0]) {
	var reader = new FileReader();
	reader.onload = function (e) {
	    jQuery('#signatureUploadFilePreview img').attr('src', e.target.result);
	    jQuery('#signatureUploadFilePreview').css('display', 'block');
	}
	reader.readAsDataURL(files[0]);
    }
}

function handleDraggableChange(element) {
    var relativeElementX = jQuery(element).offset().left - jQuery('#signatureUploadedFilePreview img').offset().left;
    var relativeElementY = jQuery(element).offset().top - jQuery('#signatureUploadedFilePreview img').offset().top;

    if (relativeElementX < 0 || relativeElementY < 0) {
	alert('Incorrect position! You must place data box on image preview.');
	return false;
    }

    return true;
}

function goToStep(step) {
    jQuery('.signatureSteps').css('display', 'none');

    switch (step) {
	case 2:
	    jQuery('#signatureUploadedFilePreview img').attr('src', '/api/signature.php?sig=' + signatureUploadedCode + '&preview=1');
	    jQuery('#signatureUploadedFileBoxes span').draggable({
		stop: function() {
		    handleDraggableChange(this)
		},
		revert: 'invalid'
	    });
	    jQuery('#signatureUploadedFilePreview img').droppable({ accept: '#signatureUploadedFileBoxes span' });
	    jQuery('#signatureStep2').css('display', 'block');
	break;
	case 3:
	    jQuery('#signatureStep3').css('display', 'block');
	break;
	case 1:
	default:
	    jQuery('#signatureStep1').css('display', 'block');
	break;
    }
}

jQuery(document).ready(function() {
    jQuery('.signatureUploadSelectButton').on('click', function() {
	jQuery('#signatureUploadInput').click();
    });

    jQuery('.signatureUploadSubmitButton').on('click', function() {
	signatureSelectedType = jQuery('#signatureUploadForm select').val();
	jQuery('#signatureUploadForm').submit();
	return false;
    });

    jQuery('#signatureUploadInput').on('change', function() {
	loadImagePreview(this);
    });

    jQuery('#signatureUploadForm').ajaxForm({
	dataType: 'json',
	beforeSend: function() {
	    var percentVal = '0%';
	    jQuery('#signatureUploadBar').width(percentVal)
	    jQuery('#signatureUploadPercent').html(percentVal);
	},
	uploadProgress: function(event, position, total, percentComplete) {
	    var percentVal = percentComplete + '%';
	    jQuery('#signatureUploadBar').width(percentVal)
	    jQuery('#signatureUploadPercent').html(percentVal);
	},
	success: function() {
	    var percentVal = '100%';
	    jQuery('#signatureUploadBar').width(percentVal)
	    jQuery('#signatureUploadPercent').html(percentVal);
	},
	complete: function(xhr) {
	    var response = jQuery.parseJSON(xhr.responseText);
	    var text = '';
	    if (typeof response.code !== 'undefined' && response.code === 'ok') {
		text = '<span style="color: green">File uploaded.</span>';
		signatureUploadedCode = response.message;

		goToStep(2);
	    } else {
		if (typeof response.message === 'undefined') {
		    text = '<span style="color: red">Unknown error!</span>';
		} else {
		    text = '<span style="color: red">' + response.message + '</span>';
		}
	    }
	    jQuery('#signatureUploadStatus').html(text);
	}
    });
});