var nowUrl = window.location.href;
var str = nowUrl.split("/");
var aid = str[str.length - 1];

$(document).ready(function() {
    $('.modal-trigger').leanModal();
    $('.drawImgDiv').fadeOut();
    genReplyPicture();

    var isDraw = false;
    $('#drawBtn').on('click', function() {
        $(this).fadeOut();
        $('.drawImgDiv').fadeIn();
        isDraw = true;
    });

   $('#article_container .card-content .check_reply').on('click', function(){
       $('#outputImg').html(
           $("<img />", {
               src: $('#userReplyImgCanvas')[0].toDataURL(),
               "class": "output"
           })
       );
       if(!$(this).parent().find('.reply_content').val()) {
           Materialize.toast('<span>content can not be null!</span>', 5000, 'rounded');
           $('#main #toast-container .toast').addClass('toast-error');
       } else {
           var ele = $(this);
           var data = {
               'content_img': isDraw? $('#userReplyImgCanvas')[0].toDataURL() : null,
               aid: ele.data('aid'),
               content: $(this).parent().find('.reply_content').val(),
               _token: $("meta[name='csrf-token']").attr("content")
           };
           $.ajax({
               url: '/api/reply/create',
               type: "POST",
               data: data,
               error: function (error) {
                   Materialize.toast('<span>server error!</span>', 5000, 'rounded');
                   return;
               },
               success: function (result) {
                   console.log(result);
                   /*if (result != 0) Materialize.toast('<span>fail!</span>', 5000, 'rounded');
                   else window.location = "./" + ele.data('aid');*/
                   if (!result) Materialize.toast('<span>Create fail!</span>', 5000, 'rounded');
                   else {
                       window.location = "./" + aid;
                       /*var str = '<p class="row"><span class="author s2 col right-align">';
                       str += result[1]['name'] + '</span><span class="reply_content s7 col left-align"><span>';
                       str += result[0]['content'] + '</span></span><span class="s3 col right-align">';
                       str += result[0]['created_at'] + '</span></p>';
                       ele.parent().parent().find('.reply_record p:first').before(str);*/
                   }
                   $('#main #toast-container .toast').addClass('toast-error');
               }
           });
       }
   });

    $('#editArticleModal #check_edit_article').on('click', function(){
        var title = $('#edit_article_title').val();

        var iframe = $('#editArticleModal #editArticleContentDiv').find('iframe').contents();
        var content = iframe.find('body').html();

        //var content = $('#edit_article_content').val();
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
                $('#main #toast-container .toast').addClass('toast-error');
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

function genReplyPicture() {
    $.ajax({
        url: '/api/reply/get?aid=' + aid,
        type: "GET",
        error: function (error) {
            Materialize.toast('<span>server error!</span>', 5000, 'rounded');
            return;
        },
        success: function (result) {
            console.log(result);
            var i;
            for(i=0; i<result.length; i++) {
                if(result[i]['content_img']) {
                    $('#rid_' + result[i]['id']).find('img').attr('src', result[i]['content_img']);
                }
            }
        }
    });

}