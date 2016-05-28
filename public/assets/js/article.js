$(document).ready(function() {
    $('.modal-trigger').leanModal();

   $('#article_container .card-content .check_reply').on('click', function(){
       if(!$(this).parent().find('.reply_content').val()) {
           Materialize.toast('<span>content can not be null!</span>', 5000, 'rounded');
           $('#main #toast-container .toast').addClass('toast-error');
       } else {
           var ele = $(this);
           $.ajax({
               url: '/api/reply/create',
               type: "POST",
               data: {
                   content: $(this).parent().find('.reply_content').val(),
                   aid: ele.data('aid'),
                   _token: $("meta[name='csrf-token']").attr("content")
               },
               error: function (error) {
                   Materialize.toast('<span>server error!</span>', 5000, 'rounded');
                   return;
               },
               success: function (result) {
                   console.log(result);
                   if (result != 0) Materialize.toast('<span>fail!</span>', 5000, 'rounded');
                   else window.location = "./" + ele.data('aid');
               }
           });
       }
   });

    $('#editArticleModal #check_edit_article').on('click', function(){
        var title = $('#edit_article_title').val();
        var content = $('#edit_article_content').val();
        if(!title || !content) {
            Materialize.toast('<span>content can not be null!</span>', 5000, 'rounded');
            return;
        }

        var ele = $(this);
        $.ajax({
            url: '/api/article/update',
            type: "POST",
            data: {
                title: title,
                content: content,
                aid: ele.data('aid'),
                _token: $("meta[name='csrf-token']").attr("content")
            },
            error: function (error) {
                Materialize.toast('<span>server error!</span>', 5000, 'rounded');
                return;
            },
            success: function (result) {
                if (result != 0) Materialize.toast('<span>fail!</span>', 5000, 'rounded');
                else window.location = "./" + ele.data('aid');
            }
        });
    });



    $('#deleteArticleModal #check_delete_article').on('click', function(){
        var ele = $(this);
        $.ajax({
            url: '/api/article/delete',
            type: "POST",
            data: {
                aid: ele.data('aid'),
                _token: $("meta[name='csrf-token']").attr("content")
            },
            error: function (error) {
                Materialize.toast('<span>server error!</span>', 5000, 'rounded');
                $('#main #toast-container .toast').addClass('toast-error');
                return;
            },
            success: function (result) {
                if (result != 0) Materialize.toast('<span>Delete fail!</span>', 5000, 'rounded');
                else window.location = "/";
                $('#main #toast-container .toast').addClass('toast-error');
            }
        });
    });
});