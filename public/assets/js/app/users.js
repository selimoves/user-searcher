define(function (require) {
    require('css!./styles');

    let Vue = require('vue');
    let _ = require('underscore');
    Vue.use(require('vue.vue-resource'));

    return new Vue({
        data() {
            return {
                errors: [],
                users: [],
                filters: {
                    country: 'Russian Federation'
                }
            };
        },

        created() {
            this.fetchUsers(this.filters);
        },

        computed: {
            getUsers() {
                return this.users;
            }
        },

        methods: {
            fetchUsers(params=[]) {
                this.$http.get("/users", {params: params})
                        .then(function (response) {
                            this.users = response.data;
                        }, function (response) {
                            this.errors = response.data;
                        });
            },
            
            filter() {
                this.fetchUsers(this.filters);
            }
        }
    });
});