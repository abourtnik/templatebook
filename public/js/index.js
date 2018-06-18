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

            if (data.error) console.log(data.message);

            else $('#basket-count').text(data.count);

        } , 'json');
    });

    // Remove product to basket

    $(document).on('click', '.remove-basket', function(e){

        e.preventDefault();

        var id  = $(this).attr('template-id');

        $.get("/basket/delete/"+id, function (data) {

            if (data.error) console.log(data.message);

            else {

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

                    if (data.error) console.log(data.message);

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
        $('#image-file-media-'+ media_id).removeAttr('disabled');
        $('#text-media-'+ media_id).addClass('hidden');
        $('#youtube-link-media-'+ media_id).attr('disabled','disabled');
        $('#type-media-'+ media_id).val('image');
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
        $('#youtube-link-media-'+ media_id).removeAttr('disabled');
        $('#youtube-link-media-'+ media_id).val($input.val());
        $('#type-media-'+ media_id).val('youtube');
        $('#image-file-media-'+ media_id).attr('disabled','disabled');
        $input.val('');
        $('#youtube-modale').modal('hide');

    });

    // Votes

    $('.btn-vote').click(function() {

        var $button = $(this);

        var status = $(this).attr('status');
        var template_id = $(this).attr('template_id');

        $.post("/templates/vote/"+ template_id, {status:status} , function (response) {

            if (response.error) console.log(response.message);

            else {

                $(".btn-vote[template_id='"+ template_id +"'][status=1]").find('span').text(response.like_count);
                $(".btn-vote[template_id='"+ template_id +"'][status=0]").find('span').text(response.unlike_count);

                /* Code :
                    0 -> new
                    1 -> delete
                    2 -> change
                */

                if (response.code == 0)
                    $button.find('i').css('color' , 'blue');
                else if (response.code == 1)
                    $button.find('i').css('color' , 'inherit');
                else {
                    $button.find('i').css('color' , 'blue');
                    $(".btn-vote[template_id='"+ template_id +"'][status=" + (+!parseInt(status)) + "]").find('i').css('color' , 'inherit');
                }
            }

        } , 'json');
    });

    $(document).on('change', '#avatar-input:file', function () {
        $('#form-avatar').submit();
    });

    // Follow

    $(document).on('click', '.follow', function() {

        var $button = $(this);

        var user_id = $(this).attr('user-id');

        $.post("/users/follow/"+ user_id , function (response) {

            if (response.error) console.log(response.message);

            else {

                $button.removeClass('btn-warning').addClass('btn-danger');
                $button.removeClass('follow').addClass('unfollow');
                $button.find('i').removeClass('fa-user-plus').addClass('fa-user-times');
                $button.find('span').text('Ne plus suivre');
            }

        } , 'json');
    });

    // UnFollow

    $(document).on('click', '.unfollow', function() {

        var $button = $(this);

        var user_id = $(this).attr('user-id');

        $.post("/users/unfollow/"+ user_id , function (response) {

            if (response.error) console.log(response.message);

            else {

                $button.removeClass('btn-danger').addClass('btn-warning');
                $button.removeClass('unfollow').addClass('follow');
                $button.find('i').removeClass('fa-user-times').addClass('fa-user-plus');
                $button.find('span').text('Suivre');
            }

        } , 'json');
    });

})(jQuery);