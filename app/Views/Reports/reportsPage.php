    <?php
    ?>

    <?= $this->extend('/template/template.php') ?>
    <?= $this->section('content') ?>

    <body>
    <?= $this->include('template/sidebar') ?>
    <?= $this->include('template/headerNav'); ?>
    <?= $this->include('template/header'); ?>

        <!-- Main content -->
        <script src="/plugins/chart.js/Chart.min.js"></script>
        <div class="content">
            <div class="container-fluid">
                <div class="card">
                    <canvas id="myChart"></canvas>
                    <script>
                    var ctx = document.getElementById('myChart').getContext('2d');

                    var chartData = {
                        labels: [],
                        datasets: [
                            {
                                label: "Products In",
                                backgroundColor: "rgba(75, 192, 192, 0.2)",
                                borderColor: "rgba(75, 192, 192, 1)",
                                borderWidth: 1,
                                data: [],
                            },
                            {
                                label: "Products Out",
                                backgroundColor: "rgba(255, 99, 132, 0.2)",
                                borderColor: "rgba(255, 99, 132, 1)",
                                borderWidth: 1,
                                data: [],
                            },
                        ],
                    }

                    <?php foreach ($logs as $result): ?>
                        chartData.labels.push("<?php echo $result->year . '-' . $result->month; ?>");
                        chartData.datasets[0].data.push(<?php echo $result->products_in ?>);
                        chartData.datasets[1].data.push(<?php echo $result->products_out ?>);
                    <?php endforeach; ?>

                    var myChart = new Chart(ctx, {
                        type: "bar",
                        data: chartData,
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true,
                                },
                            },
                        },
                    });
                </script>
                </div>    
            </div>
        </div>

    <script>
    </script>


    <?= $this->endSection() ?>
