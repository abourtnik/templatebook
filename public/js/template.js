$(document).ready(function() {

    $(".dropdown-menu li a").click(function() {
        var selText = $(this).text();
        $(this).parents('.input-group-btn').find('button[data-toggle="dropdown"]').html(selText+' <span class="caret"></span>');
        $('#searchType').val($(this).attr('data-value'));

        var type = $(this).attr("data-input");
        var id = $(this).attr("data-id");

        var $input =  $('#media'+id);
        var $type_input =  $('#type'+id);

        if (type == 'image-file') {

            $input.attr('type' , 'file');
            $input.attr('accept' , 'image/*');
            $type_input.val('');
        }

        else if(type == 'image-url') {
            $input.attr('type' , 'text');
            $input.removeAttr('accept');
            $input.attr('maxlenght' , '255');
            $type_input.val('image_url');
        }

        else if(type == 'video-file') {
            $input.attr('type' , 'file');
            $input.attr('accept' , 'video/*');
            $type_input.val('');
        }

        else if(type == 'video-url') {
            $input.attr('type' , 'text');
            $input.removeAttr('accept');
            $input.attr('maxlenght' , '255');
            $type_input.val('video_url');
        }

    });

});