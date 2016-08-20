<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>elFinder 2.0</title>

    <!-- jQuery and jQuery UI (REQUIRED) -->
    <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>

    <!-- elFinder CSS (REQUIRED) -->
    <link rel="stylesheet" type="text/css" href="<?= asset($dir.'/css/elfinder.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= asset($dir.'/css/theme.css') ?>">

    <style>
        body { margin: 0; }
        #elfinder { border: none; }
        .elfinder-toolbar, .elfinder-statusbar { border-radius: 0 !important; }
    </style>

    <!-- elFinder JS (REQUIRED) -->
    <script src="<?= asset($dir.'/js/elfinder.min.js') ?>"></script>

    <?php if($locale){ ?>
        <!-- elFinder translation (OPTIONAL) -->
        <script src="<?= asset($dir."/js/i18n/elfinder.$locale.js") ?>"></script>
    <?php } ?>

    <!-- elFinder initialization (REQUIRED) -->
    <script type="text/javascript" charset="utf-8">
        // Helper function to get parameters from the query string.
        function getUrlParam(paramName) {
            var reParam = new RegExp('(?:[\?&]|&amp;)' + paramName + '=([^&]+)', 'i') ;
            var match = window.location.search.match(reParam) ;

            return (match && match.length > 1) ? match[1] : '' ;
        }

        $().ready(function() {
            <?php $type = Request::get('type', 'all'); ?>

            var type = '<?= $type ?>';
            var editor = parent.CKEDITOR;
            var dialog = editor.dialog.getCurrent();

            // Github issue: https://github.com/Studio-42/elFinder/issues/1178
            var elf = $('#elfinder').elfinder({
                // set your elFinder options here
                <?php if($locale){ ?>
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
                getFileCallback : function(file) {
                    var filePath = '/' + file.path;

                    if (dialog._.name == 'image2') {
                        dialog.setValueOf(dialog._.currentTabId, 'src', filePath);
                    } else {
                        dialog.setValueOf(dialog._.currentTabId, 'url', filePath);
                    }

                    parent.$.magnificPopup.close();
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
