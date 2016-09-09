"use strict";

class FileManager {
    constructor() {
        console.log("Filemanager is ready!");
    }
    open(from, options) {
        if (typeof options == 'undefined') {
            options = {};
        }

        this.type = options.type || 'all';
        this.field = options.field || null;
        this.append = options.append || false;
        this.multiple = options.multiple || false;
        this.modalUrl = '/elfinder/popup/' + this.field + '?type=' + this.type;

        if (from == 'wysi') {
            this.modalUrl = '/elfinder/ckeditor?type=' + this.type;
        }

        if (this.multiple) {
            this.modalUrl = this.modalUrl + '&multiple=1';
        }

        $.magnificPopup.open({
            items: {
                src: this.modalUrl,
                type: 'iframe',
            },
            enableEscapeKey: false,
            mainClass: 'modal-fullscreen'
        });
    }
    choose(from, fieldName, file) {
        if (! fieldName && file) {
            return false;
        }

        var field = $('[name=' + fieldName + ']', parent.document);
        var regex = new RegExp(UPLOADS_BASEPATH + '/', 'g');

        if (this.multiple) {
            var selected = $.map(file, function(f) {
                return f.path.replace(regex, '');
            }).join(',');
        } else {
            selected = file.path.replace(regex, '');
        }

        if (this.append) {
            field.val(field.val() + ',' + selected);
        } else {
            field.val(selected);
        }

        field.val(field.val().replace(/(^,)|(,$)/g, ''));
        field.trigger('change');
    }
}

module.exports = FileManager;
