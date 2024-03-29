jQuery( document ).ready(function() {

    jQuery('.deleted').on('click', function(e) {

        e.stopPropagation();
        e.preventDefault();

        var _this = jQuery(this);

        let formData = new FormData();
        formData.append('action', 'remove');
        formData.append('security', inssetscript.security);
        formData.append('id',_this.data('id'));

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
            success: function(response) {
                _this.closest('tr').fadeOut('slow');
                jQuery('.delete-confirmation').removeClass('hide');
                console.log(response);
                return false;
            }
        });

        return;
    });

    jQuery('input[type="checkbox"]').on('click', function(e) {

        let formData = new FormData();

        // Empêche le reload de la page
        e.stopPropagation();
       //e.preventDefault();

        var _this = jQuery(this);
        formData.append('action', 'voyagesmajeur');
        formData.append('majeur', _this.val());
        formData.append('security', adminscript.security);


        // Requête ajax qui utilise les données de la variable 'formData'
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

            success: function(rs) {
                console.log(rs);
                return false;

            },

        });

    });

    jQuery('.slider').on('change', function(e) {

        let formData = new FormData();

        // Empêche le reload de la page
        e.stopPropagation();
        //e.preventDefault();

        formData.append('action', 'updateetoiles');
        formData.append('security', adminscript.security);

        let id = jQuery(this).attr('id');
        let value = jQuery(this).val();
        formData.append('etoiles', value);
        formData.append('id', id);

        jQuery('.valEtoiles-'+id).html(value);

        let thisItem = jQuery(this).closest('tr');

        // Requête ajax qui utilise les données de la variable 'formData'
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

            success: function(rs) {

                thisItem.fadeOut();
                thisItem.fadeIn();

                return false;
            },

        });

    });
});