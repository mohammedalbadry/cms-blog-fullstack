$(document).ready(function() {
    $('.tags').select2({
      theme: "classic"
    });
});

$(document).ready(function() {
    $('.categories').select2({
      theme: "classic"
    });
});

$(document).on('change', ".input_live_img", function() {

    if (this.files && this.files[0]) {

      
      var reader = new FileReader();

      
      var src = $(this).parents('.form-group').find(".live_img");
      
      reader.onload = function(e) {
        src.attr('src', e.target.result);
      }
      
      reader.readAsDataURL(this.files[0]); // convert to base64 string
    }
});