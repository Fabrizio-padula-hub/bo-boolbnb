import Chart from 'chart.js/auto';

document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('apartmentsChart').getContext('2d');
    const apartmentVisits = JSON.parse(document.getElementById('apartmentVisitsData').textContent);
    // Mesi dell'anno
    const months = ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre'];

    // Raggruppare le visite per appartamento e mese
    const groupedVisits = {};
    apartmentVisits.forEach(apartment => {
        groupedVisits[apartment.apartment_slug] = [apartment.apartment, Object.values(apartment.visits), getRandomRGBA()]
        // apartment: apartment.apartment,
        //     visits: Object.values(apartment.visits),
        // };
    });

    // Costruire i datasets
    const datasets = Object.keys(groupedVisits).map(apartment => {
        return {
            label: groupedVisits[apartment][0],
            data: groupedVisits[apartment][1],
            backgroundColor: groupedVisits[apartment][2],
            borderColor: groupedVisits[apartment][2],
            borderWidth: 1
        };
    });

    console.log(datasets);

    // Creare il grafico
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: months,
            datasets: datasets
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
});

function getRandomRGBA() {
    const r = Math.floor(Math.random() * 256); // Red: 0-255
    const g = Math.floor(Math.random() * 256); // Green: 0-255
    const b = Math.floor(Math.random() * 256); // Blue: 0-255
    const a = Math.random().toFixed(2); // Alpha: 0-1 with two decimal points

    return `rgba(${r}, ${g}, ${b}, ${a})`;
}
