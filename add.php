<html>

<head>
    <title>Add new risk</title>
</head>

<body>
    <a href="index.php">Home</a>
    <br /><br />
    <h1>Add a new risk</h1>
    <p><strong>Enter the risk information: </strong></p>
    <form action="addRisk.php" method="post">
        <table width="50%">
            <tr>
                <td>Risk Event</td>
                <td><input type="text" name="riskevent" placeholder="Risk event name"></td>
            </tr>
            <tr>
                <td>Likelihood</td>
                <td><input type="text" name="likelihood"></td>
            </tr>
            <tr>
                <td>Impact</td>
                <td><input type="text" name="impact" id="impactInput"></td>
            </tr>
            <tr>
                <td>Risk Response</td>
                <td><input type="text" name="riskresponse"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="Submit" value="Add Risk"></td>
            </tr>
        </table>
    </form>

    <ul>
        <li>The likelihood rating scale: 1 (Least likely), 2 (Unlikely), 3 (Possible), 4 (Likely), 5 (Most Likely)</li>
        <li>The Impact rating scale: 1 (No impact), 2 (Low), 3 (Moderate), 4 (High), 5 (Very High Impact)</li>
        <li>4 Risk Response Strategies: Mitigate, Avoid, Transfer, Accept</li>
    </ul>

</body>

</html>