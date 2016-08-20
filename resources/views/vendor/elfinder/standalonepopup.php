<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>elFinder 2.0</title>

    <!-- jQuery and jQuery UI (REQUIRED) -->
    <link rel="stylesheet" type="text/css" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/themes/smoothness/jquery-ui.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>

    <!-- elFinder CSS (REQUIRED) -->
    <link rel="stylesheet" type="text/css" href="<?= asset($dir . '/css/elfinder.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= asset($dir . '/css/theme.css') ?>">

    <style>
        body { margin: 0; }
        #elfinder { border: none; }
        .elfinder-toolbar, .elfinder-statusbar { border-radius: 0 !important; }
    </style>

    <!-- elFinder JS (REQUIRED) -->
    <script src="<?= asset($dir . '/js/elfinder.min.js') ?>"></script>

    <?php if ($locale)
    { ?>
        <!-- elFinder translation (OPTIONAL) -->
        <script src="<?= asset($dir . "/js/i18n/elfinder.$locale.js") ?>"></script>
    <?php } ?>
    <!-- Include jQuery, jQuery UI, elFinder (REQUIRED) -->

    <script type="text/javascript">
        $().ready(function () {
            <?php $type = Request::get('type', 'all'); ?>

            var type = '<?= $type ?>';
            var multiple = '<?= Request::get('multiple'); ?>' == '1';

            var elf = $('#elfinder').elfinder({
                // set your elFinder options here
                <?php if ($locale){ ?>
                    lang: '<?= $locale ?>', // locale
                <?php } ?>
                <?php if ($type !== 'all') { ?>
                    onlyMimes: [type],
                <?php } ?>
                customData: {
                    _token: '<?= csrf_token() ?>'
                },
                url: '<?= route("elfinder.connector") ?>',  // connector URL
                resizable: false,
                commandsOptions: {
                    getfile: {
                        multiple : multiple,
                        oncomplete: 'destroy'
                    }
                },
                getFileCallback: function (file) {
                    parent.FileManager.choose('input', '<?= $input_id?>', file);
                    parent.jQuery.magnificPopup.close();
                }
            }).elfinder('instance');
        });

        $(window).resize(function() {
            var h = $(window).height();
            if ($('#elfinder').height() != h) {
                $('#elfinder').height(h).resize();
            }
        });
    </script>
</head>
<body>
    <!-- Element where elFinder will be created (REQUIRED) -->
    <div id="elfinder"></div>
</body>
</html>
