<?php
include("config.php");
include("db_query.php");
$query1="SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$db1'";
$query2="SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$db2'";
?>
<!DOCKTYPE html>
<head>
<title>Compare Tables</title>
<link rel="stylesheet" href="style_compare_tables.css">
</head>

<body>
<h2>Select Tables</h2>
<div>
<p>
<a href="select_db.php">Select Databases</a>
>
Select Tables
</p>
</div>
<form action="two_tables.php" method = "post">
<input type="hidden" id="db1" name="db1" value="<?php echo $db1; ?>">
<input type="hidden" id="db2" name="db2" value="<?php echo $db2; ?>">

<div class="green-container">

<label for="table1" class="txt form-label">Table 1 :</label>
<select name="table1">
<option value="" selected></option>
<?php 
$tables1 = mysqli_query($conn1,$query1);
if ($tables1->num_rows > 0) {
    while($table1_row = $tables1->fetch_assoc()) {
        ?><option><?php echo $table1_row["TABLE_NAME"]; ?></option>
    <?php
    }  
}
?>
</select>

<label for="table2" class="txt form-label">Table 2 :</label>
<select name="table2">
<option value="" selected></option>
<?php 
$tables2 = mysqli_query($conn2,$query2);
if ($tables2->num_rows > 0) {
    while($table2_row = $tables2->fetch_assoc()) {
        ?><option><?php echo $table2_row["TABLE_NAME"]; ?></option>
    <?php
    }  
}
?>
</select>

<input type="submit" name="submit" value="Submit" class="btn"/>

</div>
</form>

</body>
</html>