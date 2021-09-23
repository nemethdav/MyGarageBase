<template>
    <input type="file" name="image"
           id="image"
           value="{{ old('image') }}"
           @change="previewImage"
    />
    <img src="" alt="Fotó a bizonylatról" height="100" id="preview"
         style="display: none;"/>
</template>

<script>
export default {
    name: "MotorwayVignettePreviewImage",

    methods: {
        previewImage: function (e) {
            var file = e.target.files[0];
            var imgURL = URL.createObjectURL(file);
            document.getElementById("preview").src = imgURL;
            document.getElementById("preview").style.display = "inline";
        }
    }
}
</script>

<style scoped>

</style>
