new Vue({
    el: "#testAccount",

    data: {
        accountData: []
    },

    ready: function () {
        this.getAccount();
    },

    methods: {
        getAccount: function () {
            this.$http.get('/api/getAccount', function (result) {
                console.log(result);
                this.$set('accountData', result);
            });
        }
        /*onClick: function (item) {
            this.$http.post('/api/reset_waitlist_v2', item, function (data) {
                this.email = data.email;
            })
        }*/
    }
});
