{{-- Live Timestamp: auto-refreshes relative time display --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    function updateTimestamps() {
        document.querySelectorAll('[data-timestamp]').forEach(function(el) {
            var ts = parseInt(el.dataset.timestamp);
            if (!ts) return;

            var now = Math.floor(Date.now() / 1000);
            var diff = now - ts;

            var text;
            if (diff < 5) text = 'just now';
            else if (diff < 60) text = diff + ' seconds ago';
            else if (diff < 120) text = '1 minute ago';
            else if (diff < 3600) text = Math.floor(diff / 60) + ' minutes ago';
            else if (diff < 7200) text = '1 hour ago';
            else if (diff < 86400) text = Math.floor(diff / 3600) + ' hours ago';
            else if (diff < 172800) text = '1 day ago';
            else text = Math.floor(diff / 86400) + ' days ago';

            el.textContent = text;
        });
    }

    updateTimestamps();
    setInterval(updateTimestamps, 30000);
});
</script>
