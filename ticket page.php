<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Page</title>
    <link href="ticket_page.css" rel="stylesheet">
</head>
<body>
    <script>
        function prnt() {
            window.print();
        }
    </script>
    <div class="container_ticket">
        <h1 class="mainhead"><b><u>TICKET</u></b></h1>

        <?php
        session_start();
        // Check if the required session variables are set
        if(isset($_SESSION['hdcunt'], $_SESSION['dt'], $_SESSION['bsnm'], $_SESSION['frm'], $_SESSION['to'], $_SESSION['fph'])) {
            ?>
            <table>
                <tr>
                    <td><center>Sl no.</center></td>
                    <td><center>Passenger name</center></td>
                    <td><center>Contact Number</center></td>
                    <td><center>Age</center></td>
                </tr>
                <?php
                $a = 1;
                while ($a <= $_SESSION['hdcunt']) {
                    echo "<tr>";
                    echo "<td><center>" . $a . "</center></td>";
                    echo "<td><center>" . $_SESSION['pname' . $a] . "</center></td>";
                    echo "<td><center>" . $_SESSION['pconno' . $a] . "</center></td>";
                    echo "<td><center>" . $_SESSION['page' . $a] . "</center></td>";
                    $a++;
                    echo "</tr>";
                }
                ?>
            </table>
            <br><br>
            Date of Journey: <input type="text" value="<?= $_SESSION['dt'] ?>" readonly>
            <br><br>
            Head Count: <input type="text" value="<?= $_SESSION['hdcunt'] ?>" readonly>
            <br><br>
            Bus Name: <input type="text" value="<?= $_SESSION['bsnm'] ?>" readonly>
            <br><br>
            From: <input type="text" value="<?= $_SESSION['frm'] ?>" readonly>
            <br><br>
            To: <input type="text" value="<?= $_SESSION['to'] ?>" readonly>
            <br><br>
            Fare: <input type="number" value="<?= ($_SESSION['fph']) * ($_SESSION['hdcunt']) ?>" readonly>
            <br><br>
            <?php
        } else {
            echo "<p>Session data is not set. Please ensure all required session variables are set.</p>";
        }
        ?>
    </div>
    <input type="button" value="Print" onclick="prnt()">
</body>
</html>
