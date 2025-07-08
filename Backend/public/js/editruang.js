function previewFoto() {
      const fileInput = document.getElementById('foto');
      const previewImg = document.getElementById('preview-img');

      if (fileInput.files && fileInput.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
          previewImg.src = e.target.result;
        }
        reader.readAsDataURL(fileInput.files[0]);
      }
    }

    function resetPreview() {
      const fileInput = document.getElementById('foto');
      const previewImg = document.getElementById('preview-img');
      fileInput.value = "";
      previewImg.src = "{{ asset('img/placeholder.jpg') }}";
    }
