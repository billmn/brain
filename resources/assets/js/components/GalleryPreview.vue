<template>
    <div class="gallery-item" v-if="filePath" data-id="@{{ file }}">
        <div class="image">
            <img :src="filePath">
            <a class="remove-btn" href="javascript:;" v-on:click="removeItem(file)">
                <i class="remove icon"></i>
            </a>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['file'],
        computed: {
            filePath: {
                get: function () {
                    return this.file ? '/' + UPLOADS_BASEPATH + '/' + this.file : false;
                }
            }
        },
        methods: {
            removeItem: function(file) {
                var field = $('input[name=gallery]');
                var newValue = field.val().replace(file, '').replace(',,', ',').replace(/(^,)|(,$)/g, '');

                this.$remove();
                field.val(newValue);
            }
        }
    }
</script>
