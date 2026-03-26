{{-- User search AJAX script - modernized --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchForm = document.getElementById('search_users');
    const searchInput = document.getElementById('user_search_box');
    const usersTable = document.getElementById('users_table');
    const searchResults = document.getElementById('search_results');

    if (!searchForm || !searchInput) return;

    let debounceTimer;

    searchInput.addEventListener('input', function() {
        clearTimeout(debounceTimer);
        const query = this.value.trim();

        if (query.length < 2) {
            if (searchResults) searchResults.innerHTML = '';
            if (usersTable) usersTable.style.display = '';
            return;
        }

        debounceTimer = setTimeout(function() {
            fetch('{{ route("search-users") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ user_search_box: query })
            })
            .then(response => response.json())
            .then(data => {
                if (usersTable) usersTable.style.display = 'none';
                if (searchResults) {
                    searchResults.innerHTML = data.html || '<tr><td colspan="8" class="text-center py-4 text-gray-500">No results found.</td></tr>';
                }
            })
            .catch(() => {});
        }, 300);
    });
});
</script>
