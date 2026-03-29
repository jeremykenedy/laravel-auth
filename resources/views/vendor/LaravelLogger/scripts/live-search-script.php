<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.3.3/axios.min.js" integrity="sha512-wS6VWtjvRcylhyoArkahZUkzZFeKB7ch/MHukprGSh1XIidNvHG1rxPhyFnL73M0FC1YXPIXLRDAoOyRJNni/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://code.jquery.com/jquery-3.6.3.slim.js" integrity="sha256-DKU1CmJ8kBuEwumaLuh9Tl/6ZB6jzGOBV/5YpNE2BWc=" crossorigin="anonymous"></script>
<script type="text/javascript">
    // Script for submitting the livesearch via axios
  $( "#live_search_button" ).on( "click", function() {
    axios.post('/activity/live-search', {
      userid: document.getElementById('live_search_userid').value,
      email: document.getElementById('live_search_email').value
    })
    .then(function (response) {
        var newOptions = response.data;
        // console.log(newOptions)
        var $el = $("#user_select");
        $el.empty(); // remove old options
        $.each(newOptions, function(key,value) {
          $el.append($("<option></option>")
             .attr("value", key).text(value));
        });
        // console.log(response);
    })
    .catch(function (error) {
        console.log(error);
    });
});

</script>

