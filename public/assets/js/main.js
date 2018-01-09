requirejs.config({

    paths: {
        'app': "app",

        'underscore': 'lib/underscore/underscore-1.8.3.min',

        'vue': 'lib/vue/vue-amd',
        'v': 'lib/vue/require-vuejs.min', // for use .vue files
        'vue.vue-resource': 'lib/vue/plugins/vue-resource.min',
        'vue.vue-dom-portal': 'lib/vue/plugins/vue-dom-portal.min', //перемещение по DOM

        'text': "lib/require/text"
    },

    shim: {
    },

    map: {
        '*': { 'css': 'lib/require/require-css/css.min' }
    }


});