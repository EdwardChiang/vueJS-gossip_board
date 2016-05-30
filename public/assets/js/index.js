$(document).ready(function() {
    tinymce.init({
        selector: '#create_article_content',
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

    /*$('#index_container .collapsible-header').on('click', function(){
        //tinymce
        $('.replyDiv .Editor').empty();
        $(this).parent().find('.replyDiv .Editor').append('<textarea class="reply_content"></textarea>');
        tinymce.init({
            selector: 'textarea',
            height: 500,
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

        //Froala
        //$('#editor').remove();
        //$(this).parent().find('.replyDiv .Editor').append('<div id="editor"><div id="edit"></div></div>');
        //$('#edit').froalaEditor({
        //    iframe: true
        //});
        //$('#edit div:last').remove();
    });*/

    $('#index_container .collapsible-body .check_reply ').on('click', function(){

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
                    if (result != 0) Materialize.toast('<span>Create fail!</span>', 5000, 'rounded');
                    else window.location = "./";
                    $('#main #toast-container .toast').addClass('toast-error');
                }
            });
        }
    });

    $('#create_article_modal #check_create_article').on('click', function(){
        var iframe = $('#mceu_15').find('iframe').contents();
        var articleContent = iframe.find('body').html();
        //if(!$('#create_article_title').val() || !$('#create_article_content').val()) {
        if(!$('#create_article_title').val() || !articleContent ) {
            Materialize.toast('<span>Title and content can not be null!</span>', 5000, 'rounded');
            $('#main #toast-container .toast').addClass('toast-error');
        } else {
            $.ajax({
                url: '/api/article/create',
                type: "POST",
                data: {
                    title: $('#create_article_title').val(),
                    content: articleContent,
                    _token: $("meta[name='csrf-token']").attr("content")
                },
                error: function (error) {
                    Materialize.toast('<span>server error!</span>', 5000, 'rounded');
                    return;
                },
                success: function (result) {
                    if (result != 0) Materialize.toast('<span>Create fail!</span>', 5000, 'rounded');
                    else window.location = "./";
                    $('#main #toast-container .toast').addClass('toast-error');
                }
            });
        }
    });
});