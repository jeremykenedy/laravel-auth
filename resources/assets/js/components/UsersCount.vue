<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Current Users Online
                    </div>
                    <div class="panel-body">
                        <canvas id="myChart" height="100"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Chart from 'chart.js'
    export default {
        data() {
            return {
                count: 0,
                labels: ['Online']
            }
        },
        mounted() {
            this.update();
            this.drawChart();
        },
        methods: {
            drawChart() {
                let ctx = document.getElementById("myChart");
                let myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: this.labels,
                        datasets: [{
                            label: 'Number of users online',
                            data: [this.count],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero:true
                                }
                            }]
                        }
                    }
                });
            },
            update() {
                Echo.join('chart')
                    .here((users) => {
                        this.count = users.length;
                        this.drawChart();
                    })
                    .joining((user) => {
                        this.count++;
                        this.drawChart();
                    })
                    .leaving((user) => {
                        this.count--;
                        this.drawChart();
                    });
            }
        }
    }
</script>
