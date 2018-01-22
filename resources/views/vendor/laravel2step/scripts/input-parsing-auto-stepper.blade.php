<script>
    $(function() {

        // Check for on keypress
        $("input").on("keydown", function(event){

            var self = $(this);

            // Keyboard Controls
            var controls = [8,16,18,17,20,35,36,37,38,39,40,45,46,9,91,93,224,13,127,27,32];

            // Special Chars
            var specialChars = [43,61,186,187,188,189,190,191,192, 219,220,221,222];

            // Numbers
            var numbers = [48,49,50,51,52,53,54,55,56,57];

            var preCombined = controls.concat(numbers);
            var combined = preCombined;

            // Allow Letter
            for(var i = 65; i <= 90; i++){
                combined.push(i);
            }

            // handle Input
            if($.inArray(event.which, combined) === -1){
                event.preventDefault();
            }

            // Handle Autostepper
            if($.inArray(event.which, controls.concat(specialChars)) === -1){
                setTimeout(function(){
                    if (self.hasClass('last-input')) {
                        $('#submit_verification').focus();
                    } else {
                        self.parent().parent().next().find('input').focus();
                    }
                }, 1);
            }

        });
        // Check for cop and paste
        $("input").on("input", function(){
            var regexp = /[^a-zA-Z0-9]/g;
            if($(this).val().match(regexp)){
                $(this).val( $(this).val().replace(regexp,'') );
            }
        });

    });
</script>
