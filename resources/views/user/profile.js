<script>
    function previewImage(input) {
        var file = input.files[0];
        var reader = new FileReader();

        reader.onload = function(e) {
            document.getElementById('profile_photo_label').innerText = file.name;
            document.getElementById('preview').src = e.target.result;
            document.getElementById('image_preview').style.display = 'block';
        }

        reader.readAsDataURL(file);
    }
</script>