/*
|--------------------------------------------------------------------------
| SEMANTIC UI
|--------------------------------------------------------------------------
*/
$('.ui.accordion').accordion();
$('select, .ui.dropdown').dropdown();

$('.special.cards .image').dimmer({
    on: 'hover'
});

$('.message .close').on('click', function() {
    $(this).closest('.message').transition('fade');
});

if ($('.menu[data-cookie]').length) {
    var currentTab = $('.menu[data-cookie]');
    var tabCookieName = currentTab.data('cookie');
    var tabCurrentName = Cookies.get(tabCookieName) || 'first';

    currentTab.find('.item').tab('change tab', tabCurrentName);
}

$('.menu .item').tab().on('click', function(e) {
    var tabCookieName = $(this).parent().data('cookie');

    if (tabCookieName) {
        Cookies.set(tabCookieName, $(this).data('tab'), { expires: 365, path: '/' });
    }
});

/*
|--------------------------------------------------------------------------
| ALERT
|--------------------------------------------------------------------------
*/
if (message.info) showMessage('info', message.info);
if (message.error) showMessage('error', message.error);
if (message.warning) showMessage('warning', message.warning);
if (message.success) showMessage('success', message.success);

function showMessage(type, text, title) {
    title = title || trans.common.messages.title[type];
    swal({ type: type, text: text, title: title, timer: 2500 });
}

/*
|--------------------------------------------------------------------------
| DATETIME PICKER
|--------------------------------------------------------------------------
*/
$('.datepicker:not([disabled])').pickadate({
    selectYears: true,
    selectMonths: true,
    format: 'dd-mm-yyyy',
    formatSubmit: 'yyyy-mm-dd',
    hiddenSuffix: '_pickadate'
});

$('.timepicker:not([disabled])').pickatime({
    format: 'H:i',
    interval: 30,
    hiddenSuffix: '_pickatime'
});

/*
|--------------------------------------------------------------------------
| MODAL
|--------------------------------------------------------------------------
*/
$(document).on('click', '.modal-iframe', function(e) {
    e.preventDefault();

    var link = $(this).attr('href');

    $.magnificPopup.open({
        items: {
            src: link,
            type: 'iframe',
        },
        enableEscapeKey: false,
        mainClass: 'modal-fullscreen'
    });
});

$(document).on('click', '.modal-files', function(e) {
    e.preventDefault();

    $('.ui.sidebar').sidebar('hide');

    FileManager.open('link', {
        type: $(this).data('type'),
        field: $(this).data('inputid'),
        append: $(this).data('append'),
        multiple: $(this).data('multiple')
    });
});

/*
|--------------------------------------------------------------------------
| DIALOG
|--------------------------------------------------------------------------
*/
$(document).on('click', '[data-confirm]', function(e) {
    e.preventDefault();

    var me      = $(this);
    var title   = $(this).attr('data-confirm-title') ? $(this).attr('data-confirm-title') : trans.dialog.confirm.title;
    var message = $(this).attr('data-confirm');

    if (message == 'generic') {
        message = trans.dialog.confirm.text;
    }

    var swal_config = {
        title: title,
        text: message,
        showCancelButton: true
    }

    if ($(this).is('a')) {
        swal(swal_config, function() {
            window.location = me.attr('href');
        });
    } else if ($(this).attr('type') == 'submit' || $(this).attr('type') == 'button') {
        swal(swal_config, function() {
            me.removeAttr('data-confirm');
            me.click();
        });
    }
});

/*
|--------------------------------------------------------------------------
| EDITOR WYSI
|--------------------------------------------------------------------------
*/
CKEDITOR.timestamp = (new Date()).valueOf();

CKEDITOR.on('dialogDefinition', function(ev)
{
    var editor = ev.editor;
    var dialogName = ev.data.name;
    var dialogDefinition = ev.data.definition;
    var tabCount = dialogDefinition.contents.length;

    for (var i = 0; i < tabCount; i++) {
        var browseButton = dialogDefinition.contents[i].get('browse');

        if (browseButton !== null) {
            browseButton.hidden = false;
            browseButton.onClick = function(dialog, i) {
                FileManager.open('wysi', {
                    type: 'image2' ? 'image' : dialogName
                });
            }
        }
    }

    if (dialogName == 'table') {
        var info = dialogDefinition.getContents('info');
        var advanced = dialogDefinition.getContents('advanced');

        info.get('txtWidth')    ['default'] = '100%';
        info.get('txtBorder')   ['default'] = '0';
        info.get('txtCellPad')  ['default'] = '';
        info.get('txtCellSpace')['default'] = '';

        advanced.get('advCSSClasses')['default'] = 'content-table';
    }
});

var ck_config_full = {
    toolbar: [
        { items: ['Maximize', 'NewPage']},
        { items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'SelectAll', '-', 'Undo', 'Redo']},
        { items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat']},
        { items: ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock']},
        { items: ['Find', 'Replace', '-', 'Scayt']},
        { items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote']},
        '/',
        { items: ['Format', 'FontSize'] },
        { items: ['TextColor', 'BGColor'] },
        { items: ['oembed', 'Image'] },
        { items: ['Link', 'Unlink'] },
        { items: ['Table', 'HorizontalRule', 'SpecialChar'] },
        { items: ['Source'] }
    ],

    language: LOCALE,
    height: 300,
    emailProtection: '',
    toolbarCanCollapse: true,
    toolbarStartupExpanded: true,
    enterMode: CKEDITOR.ENTER_BR,
    filebrowserBrowseUrl: '/elfinder/ckeditor',

    extraPlugins: 'codemirror,oembed,widget',

    wordcount: {
        showWordCount: true,
        showCharCount: true
    },

    image2_alignClasses: ['image-left', 'image-center', 'image-right'],
    image2_captionedClass: 'image-captioned'
};

var ck_config_source = {
    toolbar: [
        { items: ['Maximize']},
        { items: ['NewPage']},
        { items: ['searchCode', 'autoFormat', 'CommentSelectedRange', 'UncommentSelectedRange']},
    ],

    height: 300,
    language: LOCALE,
    startupMode: 'source',
    extraPlugins: 'sourcedialog,codemirror',
    allowedContent: true,

    codemirror: {
        lineNumbers: true,
        lineWrapping: false,
        indentWithTabs: true
    },
    wordcount: {
        showWordCount: false,
        showCharCount: false
    }
};

$('.wysi').ckeditor(ck_config_full);
$('.source').ckeditor(ck_config_source);
