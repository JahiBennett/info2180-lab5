document.addEventListener('DOMContentLoaded', function () {
    const lookupCountryButton = document.getElementById('lookup-country');
    const lookupCitiesButton = document.getElementById('lookup-cities');
    const countryInput = document.getElementById('country');
    const resultDiv = document.getElementById('result');

    function fetchData(lookupType) {
        const country = countryInput.value.trim();
        if (!country) {
            resultDiv.innerHTML = 'Please enter a country name.';
            return;
        }

        const xhr = new XMLHttpRequest();
        xhr.open('GET', `world.php?country=${encodeURIComponent(country)}&lookup=${lookupType}`, true);

        xhr.onload = function () {
            if (xhr.status === 200) {
                resultDiv.innerHTML = xhr.responseText;
            } else {
                resultDiv.innerHTML = `Error: ${xhr.status}`;
            }
        };

        xhr.onerror = function () {
            resultDiv.innerHTML = 'Request failed. Please check your connection.';
        };

        xhr.send();
    }

    lookupCountryButton.addEventListener('click', function () {
        fetchData('countries');
    });

    lookupCitiesButton.addEventListener('click', function () {
        fetchData('cities');
    });
});

