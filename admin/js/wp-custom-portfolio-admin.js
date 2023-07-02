jQuery(document).ready(function($) {
    $('#custom_image_button').click(function() {
        var mediaUploader = wp.media({
            title: 'Select Image',
            button: {
                text: 'Select'
            },
            multiple: false
        });

        mediaUploader.on('select', function() {
            var attachment = mediaUploader.state().get('selection').first().toJSON();
            $('#custom_image_upload').val(attachment.url);
            $('#custom_image_preview').html('<img src="' + attachment.url + '" alt="Custom Image">');
        });

        mediaUploader.open();
    });
});
