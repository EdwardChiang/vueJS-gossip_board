$(document).ready(function() {
    if(STATUS){
        var toastContent;
        if(STATUS == 1) {
            toastContent = '<span>Account or password can not be null!</span>';
        } else if(STATUS == 2) {
            toastContent = '<span>Account is not exist!</span>';
        } else if(STATUS == 3) {
            toastContent = '<span>Error account or password!</span>';
        }
        Materialize.toast(toastContent, 5000, 'rounded');
        $('#main #toast-container .toast').addClass('toast-error');
    }

});