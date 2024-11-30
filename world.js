document.addEventListener('DOMContentLoaded', function () {
    const lookupButton = document.getElementById('lookup');
    const resultDiv = document.getElementById('result');

    lookupButton.addEventListener('click', function () {
        const country = prompt("Enter a country name or leave blank to fetch all:");

        const xhr = new XMLHttpRequest();
        xhr.open('GET', `world.php?country=${encodeURIComponent(country)}`, true);

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
    });
});
