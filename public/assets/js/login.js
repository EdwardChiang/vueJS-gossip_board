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
    $('.modal-trigger').leanModal();
});


var signUpName = $('#signUpName');
var signUpAccount = $('#signUpAccount');
var signUpPassword = $('#signUpPassword');
var signUpConfirmPassword = $('#signUpConfirmPassword');

new Vue({
    el: "#signUpDiv",

    data: {
        inputAccount: "",
        accountData: []
    },

    created: function () {
        signUpAccount.keyup(this.isAccountExist),
        signUpPassword.keyup(this.isPasswordTheSame),
        signUpConfirmPassword.keyup(this.isPasswordTheSame),
        //$('#createAccount').click(this.insertAccount),
        this.getAccount()
    },

    methods: {
        getAccount: function () {
            this.$http.get('/api/getAccount', function (result) {
                this.$set('accountData', result);
            });
        },
        isPasswordTheSame: function(ele) {
            var id = '#' + ele.target.id;
            if($(id).val() !== signUpPassword.val()) {
                signUpConfirmPassword.addClass('error')
                    .parent().find('.material-icons, label').addClass('color-red');
            } else {
                signUpConfirmPassword.removeClass('error')
                    .parent().find('.material-icons, label').removeClass('color-red');
            }
        },
        isAccountExist: function() {
            var account = signUpAccount.val();//accountInput.value;
            var temp = this.accountData.indexOf(account);
            if( temp!=-1 ) {
                Materialize.toast('<span>Account is exist!</span>', 3000, 'rounded');
                $('#main #toast-container .toast').addClass('toast-error');
                signUpAccount.addClass('error')
                    .parent().find('.material-icons, label').addClass('color-red');
            } else {
                signUpAccount.removeClass('error')
                    .parent().find('.material-icons, label').removeClass('color-red');
            }
        },
        insertAccount: function() {
            var data = {
                name: signUpName.val(),
                account: signUpAccount.val(),
                password: signUpPassword.val(),
                confirm_password: signUpConfirmPassword.val(),
                _token: $("meta[name='csrf-token']").attr("content")
            };

            this.$http.post('/auth/register', data, function (result) {
                if(result['status'] == 0) {
                    Materialize.toast('<span>Create account success!</span>', 3000, 'rounded');
                    $('#main #toast-container .toast').addClass('toast-success');
                } else if(result['status'] == 1) {
                    Materialize.toast('<span>Account or password or name can not be null!</span>', 3000, 'rounded');
                    $('#main #toast-container .toast').addClass('toast-error');
                } else if(result['status'] == 2) {
                    Materialize.toast('<span>Account is exist!</span>', 3000, 'rounded');
                    $('#main #toast-container .toast').addClass('toast-error');
                } else if(result['status'] == 3) {
                    Materialize.toast('<span>Passwords don\'t match!</span>', 3000, 'rounded');
                    $('#main #toast-container .toast').addClass('toast-error');
                }
            });
        }
    }
});
