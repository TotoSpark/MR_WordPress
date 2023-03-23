jQuery( document ).ready(function() {

    jQuery('#robert').on('submit', function(e) {

        e.stopPropagation();
        e.preventDefault();

        let formData = new FormData();
        formData.append('action', "inssetnews");
        formData.append('security', adminscript.security);

        jQuery('#robert').find('input, textarea, select').each( function(i){
            let id = jQuery(this).attr('id');
            if (typeof id !== 'undefined')
                formData.append(id, jQuery(this).val());
        });

        jQuery('#loading').show();

        jQuery.ajax({
            url: ajaxurl,
            xhrFields: {
                withCredentials: true
            },
            cache: false,
            contentType: false,
            processData: false,
            data: formData,
            type: 'post',
            success: function(rs, textStatus, jqXHR) {
                jQuery('#loading').hide();

                return false;
            }
        });
        return false;

    });

});