<script>
    window['trans'] = {!! json_encode(trans('admin')) !!};
    window['message'] = { info: "{{ session('info') }}", error: "{{ session('error') }}", success: "{{ session('success') }}", warning: "{{ session('warning') }}" };

    var UPLOADS_BASEPATH = 'files';
    var VENDORS_BASEPATH = '/assets/vendor';
    var IMAGE_PLACEHOLDER = '/assets/img/image.jpg';
    var CKEDITOR_BASEPATH = VENDORS_BASEPATH + '/ckeditor/';
    var CKEDITOR_PLUGINS_BASEPATH = VENDORS_BASEPATH + '/ckeditor_plugins/';
</script>
