
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

<h1>Demonstratie chart.js</h1>

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

<p>In bovenstaande grafiek is de data 'hardcoded' ingeladen via Javascript. Dit inladen worden gedaan middels het onderstaande script:</p>

<pre>
    <code class="language-javascript">
    const ctx1 = document.getElementById('myChart1');
    const myChart1 = new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: ['Amersfoort', 'Amsterdam', 'Rotterdam', 'Utrecht', 'Almere', 'Haarlem'],
            datasets: [{
                label: 'Aantal stemmen',
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 99, 132, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(255, 99, 132, 1)'
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
    </code>
</pre>

<div class="graph-container">
    <div>Staaf grafiek met data via PHP array</div>
    <canvas id="myChart2"></canvas>
</div>

<p>
    In de grafiek hierboven wordt de data wederom 'hardcoded' via een PHP pagina ingeladen. Het verschil met de vorige grafiek is nu dat de grafiek iedere seconde wordt ge-update.
    Dit updaten vindt plaats middels de <strong>setInterval()</strong> functie binnen Javascript. Deze functie zorgt ervoor dat iedere seconde de
    <strong>fetch()</strong> functie wordt aangeroepen welke verantwoordelijk is voor
    het ophalen van de data.
</p>

<pre>
    <code class="language-javascript">
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
    </code>
</pre>

<div class="graph-container">
    <div>Staaf grafiek met data via PHP array en POST payload</div>
    <canvas id="myChart3"></canvas>
</div>

<button onclick="fetch_with_payload(document.getElementById('title').value);">show</button>
<input type="text" id="title" placeholder="titel hier">


<script>
    const ctx1 = document.getElementById('myChart1');
    const myChart1 = new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: ['Amersfoort', 'Amsterdam', 'Rotterdam', 'Utrecht', 'Almere', 'Haarlem'],
            datasets: [{
                label: 'Aantal stemmen',
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 99, 132, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(255, 99, 132, 1)'
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
},250);



let myGraph2 = null;
function fetch_with_payload(t) {

    let payload = {"action":t,backgroundcolor: "rgba(126, 12, 135, 0.5)"};
    const ctx = document.getElementById("myChart3");

    fetch('http://localhost:8000/chart_data.php', {
        method: 'POST', // or 'PUT'
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(payload)
    })
    .then((response) => response.json())
    .then((data) => {
        if(myGraph2 !== null) {
            myGraph2.destroy();
        }
        myGraph2 = createBarGraph(data,ctx);
    });
}


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