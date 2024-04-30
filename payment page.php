<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['num_name'])) {
        $_SESSION['no'] = $_POST["num_name"];
        $a = 1;
        while ($a <= $_POST["num_name"]) {
            $_SESSION['pname' . $a] = $_POST['col2_' . $a];
            $_SESSION['pconno' . $a] = $_POST['col3_' . $a];
            $_SESSION['page' . $a] = $_POST['col4_' . $a];
            $a++;
        }
    }

    if (isset($_POST['num_name'], $_SESSION['bsnm'])) {
        $z = $_POST['num_name'];
        $_SESSION["hdcunt"] = $_POST['num_name'];
        $x = $_SESSION['bsnm'];

        $db = mysqli_connect('localhost', 'root', '', 'online_bus') or die("Could not connect to Database");

        $query = "UPDATE bus_details SET seats_available = seats_available - ? WHERE bus_name = ?";
        $statement = mysqli_prepare($db, $query);
        mysqli_stmt_bind_param($statement, 'is', $z, $x);
        mysqli_stmt_execute($statement);
        mysqli_stmt_close($statement);
        mysqli_close($db);
    }
}
?>

<script>
    function validate() {
        var a, b, c;
        a = document.getElementById("pin_id").value;
        b = document.getElementById("cardNumber_id").value;
        c = document.getElementById("exDate_id").value;
        d = document.getElementById("cvvPass_id").value;
        if (isNaN(a) || isNaN(b) || isNaN(d)) {
            alert("Please enter a valid number");
            return false;
        }

        var currentDate = new Date();
        var day = ("0" + currentDate.getDate()).slice(-2);
        var month = ("0" + (currentDate.getMonth() + 1)).slice(-2);
        var year = currentDate.getFullYear();
        var z = parseInt(year.toString() + month.toString() + day.toString());

        var ne = parseInt(c.replace(/-/g, ''));
        if (ne < z) {
            alert("Please enter a valid card date");
            return false;
        }
    }
</script>
