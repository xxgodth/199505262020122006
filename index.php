<!DOCTYPE html>
<html>

<head>
    <title>JSON Data to Table</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>

    <div style="width: 400px;">
        <canvas id="pieChart"></canvas>
    </div>

    <table border="1">
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

        <script>
            // Initialize variables for the pie chart
            $pernah_membuat_mobile_apps_labels = ['Ya', 'Tidak'];
            $pernah_membuat_mobile_apps_data = [0, 0];

            // Count the number of respondents who answered "Ya" and "Tidak"
            foreach($data["Form Responses 1"] as $item2) {
                if ($item2['pernah_membuat_mobile_apps'] === 'Ya') {
                    $pernah_membuat_mobile_apps_data[0]++;
                } else if ($item2['pernah_membuat_mobile_apps'] === 'Tidak') {
                    $pernah_membuat_mobile_apps_data[1]++;
                }
            }

            // Data for the pie chart
            var pieData = {
                labels: <?php echo json_encode($pernah_membuat_mobile_apps_labels); ?>,
                datasets: [{
                    data: <?php echo json_encode($pernah_membuat_mobile_apps_data); ?>,
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
        </script>
    </table>
</body>

</html>