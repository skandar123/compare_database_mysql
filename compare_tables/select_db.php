<?php
include("config.php");
$query_dbs="SHOW DATABASES";
?>
<!DOCKTYPE html>
<head>
<title>Compare Tables</title>
<link rel="stylesheet" href="style_compare_tables.css">
</head>

<body>
<h2>Select Databases</h2>

<form action="" method = "post" name="database_selection">

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

<input type="submit" name="two_tables" value="Select Tables" class="btn" onclick="twoTables();"/>
<input type="submit" name="all_tables" value="All Tables" class="btn" onclick="allTables();"/>
</div>
</form>
<script>
function twoTables()
{
 document.database_selection.action ="select_tables.php";
}
function allTables()
{
document.database_selection.action = "all_tables.php";
}
</script>
</body>
</html>
