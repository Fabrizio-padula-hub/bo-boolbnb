import axios from "axios";

document.addEventListener('DOMContentLoaded', function () {
    const addressInput = document.getElementById('address');
    const suggestions = document.getElementById('suggestions');

    addressInput.addEventListener('input', function () {
        const query = addressInput.value;

        if (query.length > 2) {
            fetchSuggestions(query);
        } else {
            suggestions.innerHTML = '';
        }
    });

    function fetchSuggestions(query) {
        axios.get('/admin/autocomplete', {
            params: { query: query },
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
            .then(response => {
                displaySuggestions(response.data.results);
            })
            .catch(error => {
                console.error('Error fetching suggestions:', error);
            });
    }

    function displaySuggestions(results) {
        suggestions.innerHTML = '';
        results.forEach(result => {
            const li = document.createElement('li');
            li.textContent = result.address.freeformAddress;
            li.addEventListener('click', function () {
                addressInput.value = result.address.freeformAddress;
                suggestions.innerHTML = '';
            });
            li.classList.add('cursor-pointer')
            suggestions.appendChild(li);
        });
    }
});