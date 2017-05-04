(function( $ ) {
    'use strict';

    /**
     * All of the code for your admin-facing JavaScript source
     * should reside in this file.
     *
     * Note: It has been assumed you will write jQuery code here, so the
     * $ function reference has been prepared for usage within the scope
     * of this function.
     *
     * This enables you to define handlers, for when the DOM is ready:
     *
     * $(function() {
	 *
	 * });
     *
     * When the window is loaded:
     *
     * $( window ).load(function() {
	 *
	 * });
     *
     * ...and/or other possibilities.
     *
     * Ideally, it is not considered best practise to attach more than a
     * single DOM-ready or window-load handler for a particular page.
     * Although scripts in the WordPress core, Plugins and Themes may be
     * practising this, we should strive to set a better example in our own work.
     */

    $(window).load(function ()
    {
        protect_messages();

        $('body').on('submit', '.container form', function(e)
        {
            e.preventDefault();

            var spinner  = $(this).children(".spinner");
            spinner.addClass("is-active");


            var data = $(this).serialize();

            console.log(data);

            var div = "#response";
            if($(this).data("target")!=undefined){
                div = $(this).data("target");
            }

            $.post(ajaxurl, data, function (response)
            {
                $(div).html(response);
                $(div).show( "slow" );
                spinner.removeClass("is-active");
            });

        });


        $('body').on('click', '.container div.form button', function(e)
        {

            e.preventDefault();

            var spinner  = $(this).next(".spinner");
            spinner.addClass("is-active");

            var inputs = $(this).parent().find(":input");
            var action = $(this).parent().find(":input[name='config[action]']").val();

            var data=inputs.serialize()+"&action="+action;

            //console.log(data);

            var div = "#response";
            var target = $(this).parent().data("target");
            if(target!=undefined){
                div = target;
            }

            $.post(ajaxurl, data, function (response)
            {
                $(div).html(response);
                $(div).show( "slow" );
                spinner.removeClass("is-active");
            });

        });




        $('body').on('click', '.ajax-button', function(e)
        {
            e.preventDefault();
            $(".ajax-button + .spinner").addClass("is-active");

            var data=$(this).data();

            var div = "#response";
            if($(this).data("target")!=undefined){
                div = $(this).data("target");
            }

            $.post(ajaxurl, data, function (response)
            {
                $(div).html(response);
                $(div).show( "slow" );
                $(".ajax-button + .spinner").removeClass("is-active");
            });

        });

        $('body').on('click', '.schematize .unhide-button', function(e)
        {
            e.preventDefault();

            var element = $(this).data("element");
            $(element).show( "slow" );

            var element_hide = $(this).data("element-hide");
            if(element_hide!=undefined){
                $(element_hide).hide( "fast" );
            }

        });

    });

    function protect_messages(){
        /*
        var fullHtml;
        jQuery(".se").each(function() {
            fullHtml += jQuery(this).clone();
            jQuery(this).remove();
        });
        jQuery(".seresponse").append(fullHtml);
        */
    }


})( jQuery );

