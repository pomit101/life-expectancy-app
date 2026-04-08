<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Metrics Display</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Life Expectancy Metrics</h1>
        <div class="row">
            <div class="col-md-12">
                <canvas id="lifeExpectancyChart"></canvas>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h2>Data Table</h2>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Year</th>
                            <th>Life Expectancy</th>
                            <th>HALE</th>
                            <th>YLL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data rows will be inserted here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        // Sample data for the charts
        const labels = ['2017', '2018', '2019', '2020', '2021'];
        const lifeExpectancyData = [72.6, 73.2, 73.5, 73.8, 74.0];
        const haleData = [65.0, 65.5, 66.0, 66.5, 67.0];
        const yllData = [8.0, 7.8, 7.5, 7.2, 7.0];

        const ctx = document.getElementById('lifeExpectancyChart').getContext('2d');
        const lifeExpectancyChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Life Expectancy',
                        data: lifeExpectancyData,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        fill: false
                    },
                    {
                        label: 'HALE',
                        data: haleData,
                        borderColor: 'rgba(153, 102, 255, 1)',
                        fill: false
                    },
                    {
                        label: 'YLL',
                        data: yllData,
                        borderColor: 'rgba(255, 99, 132, 1)',
                        fill: false
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Year'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Value'
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>