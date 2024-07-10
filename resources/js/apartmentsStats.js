import Chart from 'chart.js/auto';

document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('apartmentsChart').getContext('2d');
    const apartmentVisits = JSON.parse(document.getElementById('apartmentVisitsData').textContent);

    // Mesi dell'anno da luglio 2023 a luglio 2024
    const months = ['Luglio 2023', 'Agosto 2023', 'Settembre 2023', 'Ottobre 2023', 'Novembre 2023', 'Dicembre 2023', 'Gennaio 2024', 'Febbraio 2024', 'Marzo 2024', 'Aprile 2024', 'Maggio 2024', 'Giugno 2024', 'Luglio 2024'];

    // Raggruppare le visite per appartamento e mese
    const groupedVisits = {};
    apartmentVisits.forEach(apartment => {
        const visits = Object.values(apartment.visits);
        groupedVisits[apartment.apartment_slug] = [apartment.apartment, visits, getRandomRGBA()];
    });

    // Costruire i datasets
    const datasets = Object.keys(groupedVisits).map(apartment => {
        return {
            label: groupedVisits[apartment][0],
            data: groupedVisits[apartment][1],
            backgroundColor: groupedVisits[apartment][2],
            borderColor: groupedVisits[apartment][2],
            borderWidth: 1,
            fill: false,
        };
    });

    // Creare il grafico
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: months,
            datasets: datasets
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    grace: '5%'  // Aggiungi un po' di spazio sopra il valore massimo per una migliore visualizzazione
                }
            },
            resizeDelay: 0,
        }
    });
});

function getRandomRGBA() {
    const r = Math.floor(Math.random() * 256); // Rosso: 0-255
    const g = Math.floor(Math.random() * 256); // Verde: 0-255
    const b = Math.floor(Math.random() * 256); // Blu: 0-255
    const a = (Math.random() * 0.5 + 0.5).toFixed(2); // Alfa: 0.5-1 con due decimali

    return `rgba(${r}, ${g}, ${b}, ${a})`;
}
