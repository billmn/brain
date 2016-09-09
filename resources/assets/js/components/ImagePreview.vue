<template>
    <img class="ui centered fluid image" v-if="filePath" :src="filePath">
</template>

<script>
    export default {
        props: ['file'],
        computed: {
            filePath: {
                get: function () {
                    return this.file ? '/' + UPLOADS_BASEPATH + '/' + this.file : IMAGE_PLACEHOLDER;
                }
            }
        }
    }
</script>
