<canvas id="oeuvreChart" style="min-height: 200px;"></canvas>

<script>
    var labels = [];
    var data = [];

    @foreach($tab1 as $t1)
        labels.push('{{$t1}}');
    @endforeach

    @foreach($tab2 as $t2)
        data.push('{{$t2}}');
    @endforeach

    var ctx = document.getElementById("oeuvreChart");
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
                text: 'Oeuvres par type',
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
