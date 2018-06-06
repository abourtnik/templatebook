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

    $('.image-upload-file').on('change', function (e) {

        var media_id = $(this).attr('media-id');
        var files = $(this)[0].files;
        var file = files[0];
        $(this).parent().prev().attr('src', window.URL.createObjectURL(file));
        $('#text-media-'+ media_id).addClass('hidden');
        $('#youtube-link-media-'+ media_id).val('');
    });

    $('.image-upload div').mouseenter(function() {
        $(this).addClass('image-upload-active');
    }).mouseleave(function() {
        $(this).removeClass('image-upload-active');
    });

    $('#youtube-modale').on('show.bs.modal', function (event) {

        var button = $(event.relatedTarget);
        var media_id = button.data('media');
        var modal = $(this);
        modal.find('.add-youtube').attr('media-id' , media_id);
    });

    $('.add-youtube').click(function() {

        var $input = $(this).parent().prev();
        var youtube_id = $input.val().split('=')[1];
        var media_id = $(this).attr('media-id');
        $('#img-media-' + media_id).attr('src' , 'https://img.youtube.com/vi/' + youtube_id + '/0.jpg');
        $('#text-media-'+ media_id).removeClass('hidden');
        $('#youtube-link-media-'+ media_id).val($input.val());
        $('#image-file-media-'+ media_id).val('');
        $input.val('');
        $('#youtube-modale').modal('hide');

    });

    // Votes

    $('.btn-vote').click(function() {

        var $button = $(this);

        var status = $(this).attr('status');
        var template_id = $(this).attr('template_id');
        var count = parseInt($button.find('span').text());

        console.log(template_id);

        $.post("/templates/vote/"+ template_id, {status:status} , function (data) {

            if (data.error)
                console.log(data.error);
            //notification(null , data.message , "error");
            else {
                //notification(null , data.message , "success");

                $button.find('i').css('color' , 'cornflowerblue');
                $button.find('span').text(count + 1);

            }

        } , 'json');
    });

    $(document).on('change', '#avatar-input:file', function () {
        $('#form-avatar').submit();
    });











})(jQuery);