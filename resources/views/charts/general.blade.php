<canvas id="generalChart" style="min-height: 200px;"></canvas>
<script>
    var ctx = document.getElementById("generalChart");
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [],
            datasets: [{
                label: 'Types',
                data: [{{count($type)}}],
                backgroundColor: [
                    '#66ff33',
                ],
                borderColor: [
                    '#33cc00',
                ],
                borderWidth: 2
            },
                {
                    label: 'Oeuvres',
                    data: [{{count($oeuvres)}}],
                    backgroundColor: [
                        '#4dd2ff',
                    ],
                    borderColor: [
                        '#00bfff',
                    ],
                    borderWidth: 2
                },
                {
                    label: 'Artistes',
                    data: [{{count($artiste)}}],
                    backgroundColor: [
                        '#ff9933',
                    ],
                    borderColor: [
                        '#ff8000',
                    ],
                    borderWidth: 2
                }]
        },
        options: {
            title: {
                display: true,
                text: 'Nombre par catégorie',
                position: 'top'
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        }
    });
</script>