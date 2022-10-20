
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Introductie Chart.js</title>
    <style>
        html,body {
            font-family: Arial;
        }

        .graph-container {
            width: 50%;
            margin:0 auto;

        }

    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>

    <link rel="stylesheet"
          href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.6.0/styles/default.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.6.0/highlight.min.js"></script>



</head>
<body>

<h1>chart.js</h1>

<p>
    De nieuwste versie van Chart.js krijgen via npm, de GitHub-releases of door een Chart.js CDN gebruiken.
    Gedetailleerde installatie-instructies zijn te vinden op de <a href="https://www.chartjs.org/docs/latest/getting-started/installation.html" target="_blank">installatiepagina.</a>
    Als je een front-end framework gebruikt (bijv. React, Angular of Vue), controleer dan de beschikbare integraties .
</p>

<p>In deze pagina is de CDN manier gebruikt</p>

<h2>
    Gebruik van chart.js
</h2>

<pre>
    <code class="language-html">
        <?php
            $list1 = '<canvas id="myChart"></canvas>';
            echo htmlspecialchars($list1);

        ?>

    </code>

     <code class="language-javascript">
        <?php
        $list2 = "// Benodigde context voor de grafiek, gebruik een van de volgende methodes
            const ctx = document.getElementById('myChart');
            const ctx = document.getElementById('myChart').getContext('2d');
            const ctx = $('#myChart') // jQuery must be installed;
            const ctx = 'myChart'";
            echo htmlspecialchars($list2);
        ?>

    </code>
</pre>


<div class="graph-container">
    <div>Staaf grafiek met hardcoded data via Javascript</div>
    <canvas id="myChart1"></canvas>
</div>

<div class="graph-container">
    <div>Staaf grafiek met data via PHP array</div>
    <canvas id="myChart2"></canvas>
</div>


<script>
    //const ctx = document.getElementById('myChart');
    const ctx1 = 'myChart1';
    const myChart1 = new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
            datasets: [{
                label: '# of Votes',
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
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




let myChart = null;
const ctx = document.getElementById("myChart2");

setInterval(function() {
    fetch('http://localhost:8000/chart_data.php')
        .then((response) => response.json())
        .then((data) => {
            if (myChart === null) {
                myChart = createBarGraph(data,ctx);
            } else {
                myChart.data.datasets[0].data = data.datasets.data;
                myChart.update();
            }

        });
},1000);




    function createBarGraph(o,ctx) {
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: o.labels,
                datasets: [{
                    label: o.datasets.label,
                    data: o.datasets.data,
                    backgroundColor: o.datasets.backgroundColor,
                    borderColor: o.datasets.borderColor,
                    borderWidth: o.datasets.borderWidth
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        max:20
                    }
                }
            }
        });
        return myChart;
    }
</script>



<script>
        document.addEventListener("DOMContentLoaded", (event) => {
        document.querySelectorAll("pre code").forEach((el) => {
            //
        });

        hljs.highlightAll();
    });

</script>
</body>
</html>