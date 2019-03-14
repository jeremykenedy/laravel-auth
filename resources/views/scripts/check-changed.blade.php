<script type="text/javascript">
  $('.btn-change-pw').click(function(event) {
    var pwInput = $('#password');
    var pwInputConf = $('#password_confirmation');
    pwInput.val('').prop('disabled', true);
    pwInputConf.val('').prop('disabled', true);
    $('.pw-change-container').slideToggle(100, function() {
      pwInput.prop('disabled', function () {
         return ! pwInput.prop('disabled');
      });
      pwInputConf.prop('disabled', function () {
         return ! pwInputConf.prop('disabled');
      });
    });
  });
  $("input").keyup(function() {
    checkChanged();
  });
  $("select").change(function() {
    checkChanged();
  });
  function checkChanged() {
    var saveBtn = $(".btn-save");
    if(!$('input').val()){
      saveBtn.hide();
    }
    else {
      saveBtn.show();
    }
  }
</script>
