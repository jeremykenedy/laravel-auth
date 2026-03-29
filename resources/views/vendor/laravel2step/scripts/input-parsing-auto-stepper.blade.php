<script>
    $(function() {

        // Special check for copy and paste because of maxlength="1" on inputs
        $("input").on("paste", function(event){
            var clipboard = event.originalEvent.clipboardData || window.clipboardData;

            if (!clipboard) {
                return;
            }

            event.preventDefault();

            // get and sanitize value
            var regexp = /[^a-zA-Z0-9]/g;
            var chars = (clipboard.getData('text') || '').replace(regexp, '').split('');

            if (!chars.length) {
                return;
            }

            var current = $(this);
            var lastFilled = current;

            // fill each inputs with one char
            while (current.length && chars.length) {
                current.val(chars.shift());
                lastFilled = current;

                if (!chars.length) {
                    break;
                }

                // find next input
                var nextContainer = current.parent().parent().next();
                if (!nextContainer.length) {
                    break;
                }
                var nextInput = nextContainer.find('input');
                if (!nextInput.length) {
                    break;
                }
                current = nextInput;
            }

            // focus on the last empty input or on the submit button if none left
            var nextContainer = lastFilled.parent().parent().next();
            if (nextContainer.length) {
                var nextInput = nextContainer.find('input');
                if (nextInput.length) {
                    nextInput.focus();
                    return;
                }
            }

            $('#submit_verification').focus();
        });

        $("input").on("input", function(){
            
            // get and sanitize value
            var self = $(this);
            var regexp = /[^a-zA-Z0-9]/g;
            var val = (self.val() || '').replace(regexp, '').slice(0, 1);

            self.val(val);

            // focus on the next empty input or on the submit button if none left
            if (val.length === 1) {
                var nextContainer = self.parent().parent().next();
                if (nextContainer.length) {
                    var nextInput = nextContainer.find('input');
                    if (nextInput.length) {
                        nextInput.focus();
                        return;
                    }
                }

                $('#submit_verification').focus();
            }
        });

    });
</script>
