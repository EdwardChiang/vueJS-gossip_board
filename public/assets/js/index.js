$(document).ready(function() {
    tinymce.init({
        //selector: '#create_article_content',
        selector: '.tinyMCE',
        height: 200,
        plugins: [
            'advlist autolink lists link image charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table contextmenu paste code'
        ],
        toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        content_css: [
            '//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',
            '//www.tinymce.com/css/codepen.min.css'
        ]
    });

    $('.modal-trigger').leanModal();

    $('.button-collapse').sideNav({
            menuWidth: 300, // Default is 240
            edge: 'right', // Choose the horizontal origin
            closeOnClick: true // Closes side-nav on <a> clicks, useful for Angular/Meteor
        }
    );

    $('#show_side_nav').on('click', function(){
        console.log('here');
        $('#side_nav').animate({
            marginLeft: 0
        }, 500 );

        $('#hide_side_nav').css('display', 'block');
    });

    $('#hide_side_nav').on('click', function(){
        $('#side_nav').animate({
            marginLeft: "-240px"
        }, 500 );
        $('#hide_side_nav').css('display', 'none');
    });

    $('#index_container .collapsible-body .check_reply ').on('click', function(){
        var ele = $(this);
        if(!$(this).parent().find('.reply_content').val()) {
        //if(!replyContent) {
            Materialize.toast('<span>content can not be null!</span>', 5000, 'rounded');
            $('#main #toast-container .toast').addClass('toast-error');
        } else {
            $.ajax({
                url: '/api/reply/create',
                type: "POST",
                data: {
                    content: $(this).parent().find('.reply_content').val(),
                    aid: $(this).data('aid'),
                    _token: $("meta[name='csrf-token']").attr("content")
                },
                error: function (error) {
                    Materialize.toast('<span>server error!</span>', 5000, 'rounded');
                    $('#main #toast-container .toast').addClass('toast-error');
                    return;
                },
                success: function (result) {
                    console.log(result);
                    if (!result) Materialize.toast('<span>Create fail!</span>', 5000, 'rounded');
                    else {
                        //window.location = "./";
                        var str = '<p class="row"><span class="author s2 col left-align">';
                        str += result[1]['name'] + '</span><span class="reply_content s7 col left-align"><span>';
                        str += result[0]['content'] + '</span></span><span class="s3 col right-align">';
                        str += result[0]['created_at'] + '</span></p>';
                        ele.parent().parent().find('.reply_record p:first').before(str);
                    }
                    $('#main #toast-container .toast').addClass('toast-error');
                }
            });
        }
    });

    //upload file
    var fileInputTextDiv = $('#file_input_text_div');
    var fileInput = $('#file_input_file');
    var fileInputText = $('#file_input_text');
    var unityFile;
    fileInput.on('change', function(){
        console.log(this.files[0]);
        var str = fileInput.val();
        var i;
        if (str.lastIndexOf('\\')) {
            i = str.lastIndexOf('\\') + 1;
        } else if (str.lastIndexOf('/')) {
            i = str.lastIndexOf('/') + 1;
        }
        fileInputText.val( str.slice(i, str.length));

        if (fileInputText.val().length != 0) {
            if (!fileInputTextDiv.hasClass("is-focused")) {
                fileInputTextDiv.addClass('is-focused');
            }
        } else {
            if (fileInputTextDiv.hasClass("is-focused")) {
                fileInputTextDiv.addClass('is-focused');
            }
        }
    });

    //$('#create_article_modal #check_create_article').on('click', function(){
    $('#createArticleForm').on('submit', function(event){
        //event.preventDefault();
        var iframe = $('#create_article_modal #createArticleContentDiv').find('iframe').contents();
        var articleContent = iframe.find('body').html();
        //if(!$('#create_article_title').val() || !$('#create_article_content').val()) {
        if(!$('#create_article_title').val() || !articleContent ) {
            Materialize.toast('<span>Title and content can not be null!</span>', 5000, 'rounded');
            $('#main #toast-container .toast').addClass('toast-error');
        } else {
            $('#createArticleContent').val(articleContent);
        }
    });



    $("#submitbutton").on("submit", function(event){
        event.preventDefault();
        var form_url = '/api/article/create';
        var CSRF_TOKEN = $('input[name="_token"]').val();

        //Use the 'FormData' Class
        var uploadfile = new FormData($("#upload_media_form")[0]);

        $.ajax({
            url:  form_url,
            type: 'GET',
            data: {
                _token: CSRF_TOKEN,
                file: uploadfile
            },
            contentType: false,
            processData: false,
            dataType: 'JSON',
            success: function (result) {
                console.log(result);
            }
        });
    });

});