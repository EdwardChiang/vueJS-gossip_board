var accountData;
$(document).ready(function() {
    $.ajax({
        url: '/api/getAccount',
        type: "GET",
        error: function(error){
            alert('伺服器错误(ajax contract data error)');
            return;
        },
        success: function(data)
        {
            accountData = data;
            BindEvent();
        }
    });

    if(STATUS){
        var toastContent;
        if(STATUS == 1) {
            toastContent = "<span>Account or password or name can not be null!</span>";
        } else if(STATUS == 2) {
            toastContent = "<span>Account is exist!</span>";
        } else if(STATUS == 3) {
            toastContent = "<span>Passwords don't match!</span>";
        }
        Materialize.toast(toastContent, 5000, 'rounded');
        $('#main #toast-container .toast').addClass('toast-error');
    }
});

function BindEvent()
{
    $('#register #confirm_password, #register #password').keyup(function(){
        if($(this).val() !== $('#password').val()) {
            $('#confirm_password').addClass('error')
                .parent().find('.material-icons, label').addClass('color-red');
        } else {
            $('#confirm_password').removeClass('error')
                .parent().find('.material-icons, label').removeClass('color-red');
        }
    });

    $('#register #account').keyup(function(){
        if(accountData.indexOf($(this).val()) != -1) {
            $('#account').addClass('error')
                .parent().find('.material-icons, label').addClass('color-red');
        } else {
            $('#account').removeClass('error')
                .parent().find('.material-icons, label').removeClass('color-red');
        }
    });
}