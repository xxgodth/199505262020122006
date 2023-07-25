<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>General Dashboard &mdash; Stisla</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="assets/dist/assets/modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/dist/assets/modules/fontawesome/css/all.min.css">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Template CSS -->
    <link rel="stylesheet" href="assets/dist/assets/css/style.css">
    <link rel="stylesheet" href="assets/dist/assets/css/components.css">
</head>

<body>
    <?php
    // Fetch JSON data from the provided URL
    $json_data = file_get_contents('data_rekrutmen.json');
    $data = json_decode($json_data, true);
    $totalYa = 0;
    $totalTidak = 0;

    // Display the data in the table
    foreach ($data["Form Responses 1"] as $item) {
        if ($item['pernah_membuat_mobile_apps'] === "Ya") {
            $totalYa++;
        } else if ($item['pernah_membuat_mobile_apps'] === "Tidak") {
            $totalTidak++;
        }
    }

    $posisiSums = array();
    foreach ($data["Form Responses 1"] as $item) {
        $posisi = $item['posisi_yang_dipilih'];
        if (isset($posisiSums[$posisi])) {
            $posisiSums[$posisi]++;
        } else {
            $posisiSums[$posisi] = 1;
        }
    }
    ?>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
            </nav>
            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <h1>Data Rekrutmen 2023</h1>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-12 col-12 col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Grafik Pernah Membuat Mobile Apps</h4>
                                </div>
                                <div class="card-body">
                                    <div>
                                        <canvas id="doughnutChart" height="300px"></canvas>
                                    </div>
                                    <div class="statistic-details mt-sm-4">
                                        <div class="statistic-details-item">
                                            <div class="detail-value"><?= $totalYa ?></div>
                                            <div class="detail-name">Total Ya</div>
                                        </div>
                                        <div class="statistic-details-item">
                                            <div class="detail-value"><?= $totalTidak ?></div>
                                            <div class="detail-name">Total Tidak</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-12 col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Grafik Pendaftar Berdasarkan Posisi</h4>
                                </div>
                                <div class="card-body">
                                    <div>
                                        <canvas id="barChart" height="325"></canvas>
                                    </div>
                                    <div id="posisiSummary"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Table Data Rekrutmen 2023</h4>
                                </div>
                                <div class="card-body">
                                    <table id="myDataTable" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Timestamp</th>
                                                <th>Nama</th>
                                                <th>NIP</th>
                                                <th>Satuan Kerja</th>
                                                <th>Posisi yang Dipilih</th>
                                                <th>Bahasa Pemrograman yang Dikuasai</th>
                                                <th>Framework Bahasa Pemrograman yang Dikuasai</th>
                                                <th>Database yang Dikuasai</th>
                                                <th>Tools yang Dikuasai</th>
                                                <th>Pernah Membuat Mobile Apps</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // Fetch JSON data from the provided URL
                                            $json_data = file_get_contents('data_rekrutmen.json');
                                            $data = json_decode($json_data, true);

                                            // Display the data in the table
                                            foreach ($data["Form Responses 1"] as $item) {
                                                echo "<tr>";
                                                echo "<td>{$item['id']}</td>";
                                                echo "<td>{$item['timestamp']}</td>";
                                                echo "<td>{$item['nama']}</td>";
                                                echo "<td>{$item['nip']}</td>";
                                                echo "<td>{$item['satuan_kerja']}</td>";
                                                echo "<td>{$item['posisi_yang_dipilih']}</td>";
                                                echo "<td>{$item['bahasa_pemrograman_yang_dikuasai']}</td>";
                                                echo "<td>" . (isset($item['framework_bahasa_pemrograman_yang_dikuasai']) ? $item['framework_bahasa_pemrograman_yang_dikuasai'] : "") . "</td>";
                                                echo "<td>{$item['database_yang_dikuasai']}</td>";
                                                echo "<td>{$item['tools_yang_dikuasai']}</td>";
                                                echo "<td>{$item['pernah_membuat_mobile_apps']}</td>";
                                                echo "</tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <footer class="main-footer">

            </footer>
        </div>
    </div>

    <script>
        var pernah_membuat_mobile_apps_labels = ['Ya', 'Tidak'];
        var pernah_membuat_mobile_apps_data = [0, 0];
        var posisi_count = {};
        var posisiSumsData = <?php echo json_encode($posisiSums); ?>;

        <?php
        foreach ($data["Form Responses 1"] as $item) {
            if ($item['pernah_membuat_mobile_apps'] === 'Ya') {
                echo "pernah_membuat_mobile_apps_data[0]++;";
            } else if ($item['pernah_membuat_mobile_apps'] === 'Tidak') {
                echo "pernah_membuat_mobile_apps_data[1]++;";
            }

            $posisi = $item['posisi_yang_dipilih'];
            if (isset($posisi_count[$posisi])) {
                $posisi_count[$posisi]++;
            } else {
                $posisi_count[$posisi] = 1;
            }
        }
        ?>

        var doughnutData = {
            labels: pernah_membuat_mobile_apps_labels,
            datasets: [{

                data: pernah_membuat_mobile_apps_data,
                backgroundColor: ['#36A2EB', '#FF6384'],
            }]
        };

        var doughnutOptions = {
            responsive: true,
            maintainAspectRatio: false,
            cutoutPercentage: 70,
            legend: {
                display: true,
                position: 'right',
            },
            tooltips: {
                mode: 'index',
                intersect: false,
                callbacks: {
                    label: function(tooltipItem, data) {
                        var dataset = data.datasets[tooltipItem.datasetIndex];
                        var total = dataset.data.reduce(function(previousValue, currentValue) {
                            return previousValue + currentValue;
                        });
                        var currentValue = dataset.data[tooltipItem.index];
                        var percentage = parseFloat((currentValue / total * 100).toFixed(1));
                        return data.labels[tooltipItem.index] + ': ' + currentValue + ' (' + percentage + '%)';
                    }
                }
            }
        };

        var ctx = document.getElementById('doughnutChart').getContext('2d');
        var myDoughnutChart = new Chart(ctx, {
            type: 'doughnut',
            data: doughnutData,
            options: doughnutOptions,
        });

        var barData = {
            labels: <?php echo json_encode(array_keys($posisi_count)); ?>,
            datasets: [{
                label: 'Total Pendaftar',
                data: <?php echo json_encode(array_values($posisi_count)); ?>,
                backgroundColor: 'rgba(54, 162, 235, 0.7)',
                borderWidth: 1
            }]
        };

        var barOptions = {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    precision: 0
                }
            }
        };

        var ctxBar = document.getElementById('barChart').getContext('2d');
        var myBarChart = new Chart(ctxBar, {
            type: 'bar',
            data: barData,
            options: barOptions
        });

        var posisiSummaryHTML = '<div class="statistic-details">';
        for (var posisi in posisiSumsData) {
            posisiSummaryHTML += '<div class="statistic-details-item">';
            posisiSummaryHTML += '<div class="detail-value">' + posisiSumsData[posisi] + '</div><div class="detail-name">' + posisi + '</div>';
            posisiSummaryHTML += '</div>';
        }
        posisiSummaryHTML += '</div>';

        // Get the posisiSummaryDiv element and set its innerHTML
        var posisiSummaryDiv = document.getElementById('posisiSummary');
        posisiSummaryDiv.innerHTML = posisiSummaryHTML;

        $(document).ready(function() {
            $('#myDataTable').DataTable();
        });
    </script>

    <script src="assets/dist/assets/modules/popper.js"></script>
    <script src="assets/dist/assets/modules/tooltip.js"></script>
    <script src="assets/dist/assets/modules/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/dist/assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
    <script src="assets/dist/assets/js/stisla.js"></script>
    <script src="assets/dist/assets/js/page/index-0.js"></script>
    <script src="assets/dist/assets/js/scripts.js"></script>
    <script src="assets/dist/assets/js/custom.js"></script>
</body>

</html>
