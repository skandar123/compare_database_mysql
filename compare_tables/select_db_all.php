<?php
include("config.php");
$query_dbs="SHOW DATABASES";
?>
<!DOCKTYPE html>
<head>
<title>Select Databases</title>
<link rel="stylesheet" href="style_compare_tables.css">
</head>

<body>
<h2>Select Databases</h2>

<form action="all_tables.php" method = "post">

<div class="green-container">

<label for="db1" class="txt">Database 1 :</label>
<select name="db1">
<option value="" selected></option>
<?php
$dbs = mysqli_query($conn,$query_dbs);
if ($dbs->num_rows > 0) {
    while($db1_row = $dbs->fetch_assoc()) {
        ?><option><?php echo $db1_row["Database"]; ?></option>
    <?php
    }
}
?>
</select>

<label for="db2" class="txt">Database 2 :</label>
<select name="db2">
<option value="" selected></option>
<?php
$dbs = mysqli_query($conn,$query_dbs);
if ($dbs->num_rows > 0) {
    while($db2_row = $dbs->fetch_assoc()) {
        ?><option><?php echo $db2_row["Database"]; ?></option>
    <?php
    }
}
?>
</select>

<input type="submit" name="submit_db" value="Submit" class="btn"/>

</div>
</form>

</body>
</html>
