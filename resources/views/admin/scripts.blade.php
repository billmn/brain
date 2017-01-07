<script>
    window['trans'] = {!! json_encode(trans('admin')) !!};
    window['message'] = { info: "{{ session('info') }}", error: "{{ session('error') }}", success: "{{ session('success') }}", warning: "{{ session('warning') }}" };

    var LOCALE = "{{ config('app.locale') }}";
    var UPLOADS_BASEPATH = 'files';
    var PACKAGES_BASEPATH = '/packages';
    var IMAGE_PLACEHOLDER = '/assets/img/image.jpg';
    var CKEDITOR_BASEPATH = PACKAGES_BASEPATH + '/ckeditor/';
    var CKEDITOR_PLUGINS_BASEPATH = PACKAGES_BASEPATH + '/ckeditor_plugins/';
</script>
