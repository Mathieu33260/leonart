<canvas id="oeuvreArtisteChart"></canvas>

<script>
    var labels = [];
    var data = [];

    @foreach($tab3 as $t3)
    labels.push('{{$t3}}');
    @endforeach

    @foreach($tab4 as $t4)
    data.push('{{$t4}}');
            @endforeach

    var ctx = document.getElementById("oeuvreArtisteChart");
    var myPieChart = new Chart(ctx,{
        type: 'pie',
        data: {
            labels:labels,
            datasets: [
                {
                    data: data,
                    backgroundColor: [
                        '#66ff33',
                        '#4dd2ff',
                        '#ff9933'
                    ],
                    borderColor: [
                        '#33cc00',
                        '#00bfff',
                        '#ff8000'
                    ],
                    borderWidth: 2
                }
            ]
        },
        options: {
            title: {
                display: true,
                text: 'Oeuvres par artiste',
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
