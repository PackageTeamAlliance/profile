var elixir = require('laravel-elixir');

elixir(function(mix) {

    mix
        .browserify([
            'components/content-datatable.js',

        ], './resources/assets/js/bundle/bundle.js')
        .scripts([
            '../../../node_modules/vue/dist/vue.js',
            '../../../node_modules/vue-resource/dist/vue-resource.js',
            '../../../node_modules/x-editable/dist/bootstrap3-editable/js/bootstrap-editable.js',
            '../../../node_modules/bootbox/bootbox.js',
            '../../../node_modules/selectize/dist/js/standalone/selectize.js',
            'theme/x-editable-buttons.js',
            'redactor.js',
            'slugify.js',
            'bundle/bundle.js'

        ], './resources/assets/modules/content/content.js')
        .styles([
            '../../../node_modules/x-editable/dist/bootstrap3-editable/css/bootstrap-editable.css',
            '../../../node_modules/selectize/dist/css/selectize.bootstrap3.css',
            'redactor.css',
        ], './resources/assets/modules/content/content.css')
});
