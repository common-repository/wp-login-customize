/**
 *
 * admin/js/wp-cbf-admin.js
 *
 **/
(function( $ ) {
    'use strict';

    /**
     * All of the code for your admin-specific JavaScript source
     */

    $(function(){




        // ///tst new upload
        // var mediaUploader;
        //
        // $('#upload_login_logo_button').click(function(e) {
        //     e.preventDefault();
        //     // If the uploader object has already been created, reopen the dialog
        //     if (mediaUploader) {
        //         mediaUploader.open();
        //         return;
        //     }
        //     // Extend the wp.media object
        //     mediaUploader = wp.media.frames.file_frame = wp.media({
        //         title: 'Choose Image',
        //         button: {
        //             text: 'Choose Image'
        //         }, multiple: false });
        //
        //     // When a file is selected, grab the URL and set it as the text field's value
        //     mediaUploader.on('select', function() {
        //         var attachment = mediaUploader.state().get('selection').first().toJSON();
        //         $('#upload_logo_preview').val(attachment.url);
        //     });
        //     // Open the uploader dialog
        //     mediaUploader.open();
        // });


        //tst new uload


        //set image upload current div

        // $('#anr_bg, #anr_logo').mouseleave(function () {
        //
        //     var frame,
        //         imgUploadButton = '',
        //         imgContainer = '',
        //         imgIdInput = '',
        //         imgPreview = '',
        //         imgDelButton = '';
        //     // Color Pickers Inputs
        //
        // });
// WordPress specific plugins - color picker and image upload
        $( '.wp-login-customize-color-picker' ).wpColorPicker();

        //logo image

        var frame;





        $('#upload_login_logo_button').click(function (event) {




            event.preventDefault();

            // If the media frame already exists, reopen it.
            if ( frame ) {
                frame.open();
                return;
            }

            // Create a new media frame
            frame = wp.media({
                title: 'Select or Upload Media for your Login Logo',
                button: {
                    text: 'Use as my Login page Logo'
                },
                multiple: false  // Set to true to allow multiple files to be selected
            });
            // When an image is selected in the media frame...
            frame.on( 'select', function() {

                // Get media attachment details from the frame state
                var attachment = frame.state().get('selection').first().toJSON();

                // Send the attachment URL to our custom image input field.
                $('#upload_logo_preview').find( 'img' ).attr( 'src', attachment.sizes.thumbnail.url );

                // Send the attachment id to our hidden input
                $('#login_logo_id').val( attachment.id );

                // Unhide the remove image link
                $('#upload_logo_preview').removeClass( 'hidden' );
                frame.close();
            });

            // Finally, open the modal on click
            frame.open();
});


        $('#wp_login-delete_logo_button').on('click', function(e){
        e.preventDefault();
            $('#login_logo_id').val('');
            $('#upload_logo_preview').find( 'img' ).attr( 'src', '' );
            $('#upload_logo_preview').addClass('hidden');
        });


        /**********************************/
        /*******upload form background function*******/
        /**********************************/


var formBg;
        $('#upload_login_form_bg_button').click(function (event) {


                // Color Pickers Inputs

            event.preventDefault();

            // If the media frame already exists, reopen it.
            if ( formBg ) {
                formBg.open();
                return;
            }

            // Create a new media frame
            formBg = wp.media({
                title: 'Select or Upload Media for your Login form background',
                button: {
                    text: 'Use as my Login form background'
                },
                multiple: false  // Set to true to allow multiple files to be selected
            });
            // When an image is selected in the media frame...
            formBg.on( 'select', function() {

                // Get media attachment details from the frame state
                var attachment = formBg.state().get('selection').first().toJSON();

                // Send the attachment URL to our custom image input field.
                $('#upload_form_bg_preview').find( 'img' ).attr( 'src', attachment.sizes.thumbnail.url );

                // Send the attachment id to our hidden input
                $('#login_form_bg_id').val( attachment.id );

                // Unhide the remove image link
                $('#upload_form_bg_preview').removeClass( 'hidden' );
                formBg.close();
            });

            // Finally, open the modal on click
            formBg.open();
        });

        // Erase image url and age preview
        $('#wp_login-delete_form_bg_button').on('click', function(e){
            e.preventDefault();
            $('#login_form_bg_id').val('');
            $('#upload_form_bg_preview').find( 'img' ).attr( 'src', '' );
            $('#upload_form_bg_preview').addClass('hidden');
        });



        /**********************************/
        /*******upload logo function*******/
        /**********************************/


        var mediaUploader;
        $('#upload_login_bg_button').click(function (event) {


                // Color Pickers Inputs

            event.preventDefault();

            // If the media frame already exists, reopen it.
            if ( mediaUploader ) {
                mediaUploader.open();
                return;
            }

            // Create a new media frame
            mediaUploader = wp.media({
                title: 'Select or Upload Media for your Login background',
                button: {
                    text: 'Use as my Login page background'
                },
                multiple: false  // Set to true to allow multiple files to be selected
            });
            // When an image is selected in the media frame...
            mediaUploader.on( 'select', function() {

                // Get media attachment details from the frame state
                var attachment = mediaUploader.state().get('selection').first().toJSON();

                // Send the attachment URL to our custom image input field.
                $('#upload_bg_preview').find( 'img' ).attr( 'src', attachment.sizes.thumbnail.url );

                // Send the attachment id to our hidden input
                $('#login_bg_id').val( attachment.id );

                // Unhide the remove image link
                $('#upload_bg_preview').removeClass( 'hidden' );
                mediaUploader.close();
            });

            // Finally, open the modal on click
            mediaUploader.open();
        });

        // Erase image url and age preview
        $('#wp_login-delete_bg_button').on('click', function(e){
            e.preventDefault();
            $('#login_bg_id').val('');
            $('#upload_bg_preview').find( 'img' ).attr( 'src', '' );
            $('#upload_bg_preview').addClass('hidden');
        });




        //background image
// Let's set up some variables for the image upload and removing the image

        // $( '#upload_login_bg_button' ).mouseenter(function () {
        // var frame,
        //     imgUploadButton = $( '#upload_login_bg_button' ),
        //     imgContainer = $( '#upload_bg_preview' ),
        //     imgIdInput = $( '#login_bg_id' ),
        //     imgPreview = $('#upload_bg_preview'),
        //     imgDelButton = $('#wp_login-delete_bg_button');



    }); // End of DOM Ready

})( jQuery );