<!DOCTYPE html>

<head>
    <title>Add a new risk</title>
    <style>
        .response {
            color: green
        }

        .error {
            color: red
        }
    </style>
</head>

<body>
    <p class="error">
        <?php
        //Q3(a)(b)(c)(d)-In the “addRisk.php” file, write PHP codes to store the new risk record, calculate the risk score, and assess the risk severity level based on the risk matrix.
        addRisk();

        function addRisk()
        {
            include "config.php";
            $riskevent = $_POST['riskevent'];
            $likelihood = $_POST['likelihood'];
            $impact = $_POST['impact'];
            $riskresponse = $_POST['riskresponse'];

            if (empty($riskevent) || empty($likelihood) || empty($impact) || empty($riskresponse)) {
                echo "All of the field must not be empty or contains 0 value.";
                return;
            }
            if ($riskresponse !== "Mitigate" &&  $riskresponse && "Avoid" && $riskresponse && "Transfer" && $riskresponse !== "Accept") {
                echo "Risk response field has to be one of the following: <br>
            Mitigate, Avoid, Transfer, Accept";
                return;
            }

            try {
                $risklevel = assessRiskLevel($likelihood, $impact);
            } catch (ErrorException $e) {
                echo $e->getMessage();
                return;
            }

            $riskscore = $likelihood * $impact;


            try {
                $sql = "INSERT INTO projectrisks VALUES (0, ?, ?, ?, ?, ?, ?)";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(1, $riskevent, PDO::PARAM_STR);
                $stmt->bindParam(2, $likelihood, PDO::PARAM_INT);
                $stmt->bindParam(3, $impact, PDO::PARAM_INT);
                $stmt->bindParam(4, $riskscore, PDO::PARAM_INT);
                $stmt->bindParam(5, $risklevel, PDO::PARAM_STR);
                $stmt->bindParam(6, $riskresponse, PDO::PARAM_STR);
                if ($stmt->execute() === true) {
                    echo "<p class=\"response\">New risk added successfully <br>
                        Risk Event: " . $riskevent . "<br>
                        Likelihood: " . $likelihood . "<br>
                        Impact: " . $impact . "<br>
                        Risk Response: " . $riskresponse . "<br>
                        Risk Score: " . $riskscore . "<br>
                        Risk Severity Level: " . $risklevel . "<br></p>";
                } else {
                    echo "Error inserting risk data into database.";
                }
            } catch (PDOException $e) {
                echo "Error inserting risk data into database.";
            }
        }


        // echo implode(", ", [$riskevent, $likelihood, $impact, $riskscore, $riskresponse]);


        function assessRiskLevel($likelihood, $impact)
        {
            $likelihoodNum = (int) $likelihood;
            $impactNum = (int) $impact;
            if (!($likelihoodNum >= 1 && $likelihoodNum <= 5)) {
                throw new ErrorException("Invalid likelihood. Make sure it is a number from 1-5.");
            }
            if (!($impactNum >= 1 && $impactNum <= 5)) {
                throw new ErrorException("Invalid impact. Make sure it is a number from 1-5.");
            }
            $matrix = [
                [0, 0, 0, 1, 1],
                [0, 0, 1, 1, 2],
                [0, 0, 1, 1, 2],
                [0, 1, 1, 2, 2],
                [0, 1, 1, 2, 2]
            ];

            $level = $matrix[$likelihood - 1][$impact - 1];

            switch ($level) {
                case 0:
                    return "Minor";
                case 1:
                    return "Moderate";
                case 2:
                    return "Major";
                default:
                    throw new ErrorException("Invalid level number.");
            }
        }
        ?>
    </p>
    <a href="/PY2022/">View risk register</a>
    <br>
    <br>
    <a href="/PY2022/add.php">Add risk</a>
</body>

</html>