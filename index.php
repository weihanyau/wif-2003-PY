<!DOCTYPE html>

<head>
    <title>Risk Register</title>
    <style>
        table,
        th,
        td,
        tr {
            border: 1px solid black;
        }
    </style>
    </style>
</head>

<body>
    <h1>Risk Register</h1>
    <a href="add.php" target="_blank">Add New Risk</a><br /><br />

    <table>

        <tr>
            <td>Risk Event</td>
            <td>Likelihood</td>
            <td>Impact</td>
            <td>Risk Score</td>
            <td>Risk Severity Level</td>
            <td>Risk Response</td>
        </tr>
        <?php
        //Q2-Write PHP and PHP data objects (PDOs) statements to select all the risk records from the “projectrisks” table and display all the risk records retrieved from database in an HTML table format (refer to Figure 1). The risk records need to be sorted into the following order: Major, Moderate and Minor.
        include 'config.php';

        $sql = "SELECT * FROM projectrisks ORDER BY CASE risklevel WHEN 'Major' THEN 1 WHEN 'Moderate' THEN 2 WHEN 'Minor' THEN 3 ELSE 4 END";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $risk_records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <tbody>
            <?php foreach ($risk_records as $risk) : ?>
                <tr>
                    <td><?php echo $risk['riskevent']; ?></td>
                    <td><?php echo $risk['likelihood']; ?></td>
                    <td><?php echo $risk['impact']; ?></td>
                    <td><?php echo $risk['riskscore']; ?></td>
                    <td><?php echo $risk['risklevel']; ?></td>
                    <td><?php echo $risk['riskresponse']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>