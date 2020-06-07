(function($) {
  'use strict';
  $(function() {
    $('.file-upload-browse').on('click', function() {
      var file = $(this).parent().parent().find('.file-upload-default');
      file.trigger('click');
    });
    $('.file-upload-default').on('change', function() {
      $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
    });
    $(document).on('click', '.js-close-image-preview', function (e) {
        e.preventDefault();
        let previewElement = document.querySelector('span.file-upload-browse');
        let thumbnail = previewElement.dataset.thumbnail;
        previewElement.style.background = "url("+ thumbnail+")";
        this.remove();
        document.getElementById("featured_image").value = "";
    });
      function handleFileSelect(evt) {
          var files = evt.target.files; // FileList object

          // Loop through the FileList and render image files as thumbnails.
          for (var i = 0, f; f = files[i]; i++) {

              // Only process image files.
              if (!f.type.match('image.*')) {
                  continue;
              }

              var reader = new FileReader();

              // Closure to capture the file information.
              reader.onload = (function(theFile) {
                  console.log(theFile)
                  return function(e) {
                      let previewElement = document.querySelector('span.file-upload-browse');
                      previewElement.style.background = "url("+ e.target.result +")";
                      let closeElement = document.createElement('label'), icon = document.createElement('i');
                      icon.className = "mdi mdi-close-octagon";
                      closeElement.className = 'js-close-image-preview';
                      closeElement.append(icon);
                      previewElement.parentNode.append(closeElement);
                  };
              })(f);

              // Read in the image file as a data URL.
              reader.readAsDataURL(f);
          }
      }

      document.getElementById('featured_image').addEventListener('change', handleFileSelect, false);
  });
})(jQuery);
