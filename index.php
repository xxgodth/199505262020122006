<!DOCTYPE html>
<html>

<head>
    <title>JSON Data to Table and Pie Chart</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Bootstrap 5 CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <meta name="theme-color" content="#7952b3">


    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        @media (min-width: 992px) {
            .rounded-lg-3 {
                border-radius: .3rem;
            }
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <div class="px-4 py-5 my-5 text-center">
            <h1 class="display-5 fw-bold">Chart Pernah Membuat Mobile Apps</h1>
            <div class="col-lg-6 mx-auto">
                <div style="width: auto;">
                    <canvas id="pieChart"></canvas>
                </div>
                <p class="lead mb-4">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries.</p>
            </div>
        </div>
        <div class="px-4 py-5 my-5 text-center">
            <h1 class="display-5 fw-bold">Data Rekrutmen 2023</h1>
            <p class="lead mb-4">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries.</p>
            <div class="col-lg-12 mx-auto">
                <table id="myDataTable" class="table table-striped table-bordered">
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
    <script>
        // Initialize variables for the pie chart
        var pernah_membuat_mobile_apps_labels = ['Ya', 'Tidak'];
        var pernah_membuat_mobile_apps_data = [0, 0];

        // Count the number of respondents who answered "Ya" and "Tidak"
        <?php
        foreach ($data["Form Responses 1"] as $item) {
            if ($item['pernah_membuat_mobile_apps'] === 'Ya') {
                echo "pernah_membuat_mobile_apps_data[0]++;";
            } else if ($item['pernah_membuat_mobile_apps'] === 'Tidak') {
                echo "pernah_membuat_mobile_apps_data[1]++;";
            }
        }
        ?>

        // Data for the pie chart
        var pieData = {
            labels: pernah_membuat_mobile_apps_labels,
            datasets: [{
                data: pernah_membuat_mobile_apps_data,
                backgroundColor: ['#36A2EB', '#FF6384'],
            }]
        };

        // Pie chart options
        var pieOptions = {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                display: true,
                position: 'right',
            },
        };

        // Create the pie chart
        var ctx = document.getElementById('pieChart').getContext('2d');
        var myPieChart = new Chart(ctx, {
            type: 'pie',
            data: pieData,
            options: pieOptions,
        });

        $(document).ready(function() {
            $('#myDataTable').DataTable();
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.min.js"></script>
</body>

</html>