$(document).ready(function() {
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
        if(!$(this).parent().find('.reply_content').val()) {
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
        if(!$('#create_article_title').val() || !$('#create_article_content').val()) {
            Materialize.toast('<span>Title and content can not be null!</span>', 5000, 'rounded');
            $('#main #toast-container .toast').addClass('toast-error');
        } else {
            $.ajax({
                url: '/api/article/create',
                type: "POST",
                data: {
                    title: $('#create_article_title').val(),
                    content: $('#create_article_content').val(),
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