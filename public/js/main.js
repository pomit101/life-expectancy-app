// main.js

// Import Chart.js library here if needed
// <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

// Initialize Chart.js
const ctx = document.getElementById('myChart').getContext('2d');
const myChart = new Chart(ctx, {
    type: 'line', // Change as needed
    data: {
        labels: [],
        datasets: [{
            label: 'Metric Data',
            data: [],
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

// Event handler for form submission
document.querySelector('form').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the default form submission
    const formData = new FormData(event.target);
    const apiUrl = formData.get('apiUrl'); // Assuming you have an input named 'apiUrl'
    fetchMetricsData(apiUrl);
});

// Function to fetch metrics data
function fetchMetricsData(url) {
    fetch(url)
        .then(response => response.json())
        .then(data => {
            updateChart(data);
        })
        .catch(error => console.error('Error fetching data:', error));
}

// Function to update chart with new data
function updateChart(data) {
    myChart.data.labels = data.labels; // Assuming the data has 'labels'
    myChart.data.datasets[0].data = data.values; // Assuming the data has 'values'
    myChart.update(); // Refresh the chart
}