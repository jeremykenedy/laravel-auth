<script type="text/javascript">
  $('.btn-change-pw').click(function(event) {
    event.preventDefault();
    $('.pw-change-container').slideToggle(100);
    $(this).find('.fa').toggleClass('fa-times');
    $(this).find('.fa').toggleClass('fa-lock');
    $(this).find('span').toggleText('', '{!! trans("laravelusers::forms.cancel") !!}');
  });
  $("input").keyup(function() {
    checkChanged();
  });
  $("select").change(function() {
    checkChanged();
  });
  function checkChanged() {
    if(!$('input').val()){
      $(".btn-save").hide();
    }
    else {
      $(".btn-save").show();
    }
  }
</script>
