(function ($) {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(window).on('load',function(){
        $('#download-templates-modale').modal('show');
    });

    // Carousel

    $(".owl-carousel").owlCarousel({
        items:1,
        loop:true,
        animateOut: 'slideOutLeft',
        animateIn: 'slideInRight',
        navigation : false,
        slideSpeed : 500,
        paginationSpeed : 800
    });

    // Add product to basket

    $(document).on('click', '.add-basket', function(){

        var id  = $(this).attr('template_id');

        $.get("/basket/add/"+id, function (data) {

            if (data.error)
                console.log("d");
            //notification(null , data.message , "error");
            else {
                //notification(null , data.message , "success");
                $('#basket-count').text(data.count);
            }


        } , 'json');
    });

    // Remove product to basket

    $(document).on('click', '.remove-basket', function(e){

        e.preventDefault();

        var id  = $(this).attr('template-id');

        $.get("/basket/delete/"+id, function (data) {

            if (data.error)
                console.log("f");
            //notification(null , data.message , "error");
            else {

                //notification(null , data.message , "success");

                $('tr[template-id="' + id + '"]').remove();
                $('#basket-count').text(data.count);
                $('#basket-total').text(data.total);
            }


        } , 'json');

    });

    // plugin bootstrap minus and plus

    $(document).on('click', '.btn-number', function(e){

        e.preventDefault();

        var fieldName = $(this).attr('data-field');
        var type      = $(this).attr('data-type');
        var input = $("input[template-id='"+fieldName+"']");
        var currentVal = parseInt(input.val());

        var id = input.attr('template-id');

        if (!isNaN(currentVal)) {

            if(type == 'minus' && currentVal > 1)
                input.val(currentVal - 1);
            else if(type == 'plus')
                input.val(currentVal + 1);

            if (parseInt(input.val()) >= 1) {

                $.post("/basket/recalculate/"+id, {quantity:input.val()} , function (data) {

                    if (data.error)
                        console.log("f");
                    //notification('Modification' , data.message , "error");
                    else {

                        $('#basket-count').text(data.count);
                        $('#basket-total').text(data.total);
                        $('#basket-subtotal[template-id="' + id + '"]').text(data.subtotal);
                    }

                } , 'json');
            }

        } else {
            input.val(1);
        }
    });



})(jQuery);