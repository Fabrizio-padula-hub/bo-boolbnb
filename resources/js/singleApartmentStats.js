import Chart from 'chart.js/auto';

document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('visitsChart').getContext('2d');
    const weeklyData = JSON.parse(document.getElementById('weeklyData').textContent);
    console.log(weeklyData);

    // Giorni della settimana in italiano
    const days = ['Domenica', 'Lunedì', 'Martedì', 'Mercoledì', 'Giovedì', 'Venerdì', 'Sabato'];

    // Organizzare i dati per il grafico
    const data = {
        labels: days,
        datasets: [{
            label: 'Visite',
            data: Object.values(weeklyData),
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        }]
    };

    // Creare il grafico
    new Chart(ctx, {
        type: 'bar',
        data: data,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
});