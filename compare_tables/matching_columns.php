<?php
include("config.php");
$query="SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '$dbname'";
?>
<html>
<head>
<title>Matching Columns</title>
<link rel="stylesheet" href="style_compare_tables.css">
</head>
<body>
<h2>Compare Tables</h2>
<form action="" method = "post">
<div class="green-container">

<label for="table1" class="txt form-label">Table 1 :</label>
<select name="table1">
<option value="" selected></option>
<?php 
$tables = mysqli_query($conn,$query);
if ($tables->num_rows > 0) {
    while($table1_row = $tables->fetch_assoc()) {
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
$tables = mysqli_query($conn,$query);
if ($tables->num_rows > 0) {
    while($table2_row = $tables->fetch_assoc()) {
        ?><option><?php echo $table2_row["TABLE_NAME"]; ?></option>
    <?php
    }  
}
?>
</select>

<input type="submit" name="submit" value="Submit" class="btn"/>

</div>
</form>

<?php
if($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $table1 = mysqli_real_escape_string($conn,$_POST['table1']);
    $table2 = mysqli_real_escape_string($conn,$_POST['table2']);
    
    $sql1 = "SELECT DISTINCT COLUMN_NAME, DATA_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '$dbname' AND TABLE_NAME = '$table1' AND COLUMN_NAME IN (SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '$dbname' AND TABLE_NAME = '$table2') ORDER BY COLUMN_NAME ASC";
    $sql2 = "SELECT DISTINCT COLUMN_NAME, DATA_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '$dbname' AND TABLE_NAME = '$table2' AND COLUMN_NAME IN (SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '$dbname' AND TABLE_NAME = '$table1') ORDER BY COLUMN_NAME ASC";
    $sql3 = "SELECT DISTINCT COLUMN_NAME, DATA_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '$dbname' AND TABLE_NAME = '$table1' AND COLUMN_NAME NOT IN (SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '$dbname' AND TABLE_NAME = '$table2') ORDER BY COLUMN_NAME ASC";
    $sql4 = "SELECT DISTINCT COLUMN_NAME, DATA_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '$dbname' AND TABLE_NAME = '$table2' AND COLUMN_NAME NOT IN (SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '$dbname' AND TABLE_NAME = '$table1') ORDER BY COLUMN_NAME ASC";
    
    $result1 = mysqli_query($conn,$sql1);
    $result2 = mysqli_query($conn,$sql2);
    $result3 = mysqli_query($conn,$sql3);
    $result4 = mysqli_query($conn,$sql4);
?>

    <div class="left">
    <h3>Matching Columns</h3>

    <div class="container">
    <div class="tab">

    <div class="grid-container">
    <div class="grid-item tab-heading"></div>
    <div class="grid-item tab-heading"><b><?php echo $table1; ?></b></div>
    <?php 
    if ($result1->num_rows > 0) {
        ?>
        <div class="grid-item green"><b>Column</b></div>
        <div class="grid-item green"><b>DataType</b></div>
        <?php 
        while($row1 = $result1->fetch_assoc()) {?>
            
            <div class="grid-item"><b><?php echo $row1["COLUMN_NAME"];?></b></div>
            <div class="grid-item"><?php echo $row1["DATA_TYPE"]; ?></div>
        <?php }
    } else {
        echo "0 results";
    }
    ?>
    </div><!-- End of grid-container -->
    </div><!-- End of tab -->
    
    <div class="tab">
    
    <div class="grid-container-single">
    <div class="grid-item tab-heading"><b><?php echo $table2; ?></b></div>
    <?php 
    if ($result2->num_rows > 0) {
        ?>
        
        <div class="grid-item green"><b>DataType</b></div>
        <?php 
        while($row2 = $result2->fetch_assoc()) {?>
            
           
            <div class="grid-item"><?php echo $row2["DATA_TYPE"]; ?></div>
       <?php  }
    } else {
        echo "0 results";
    }
    ?>
    </div><!-- End of grid-container -->
    </div><!-- End of tab -->
	</div><!-- End of container -->
    </div>


	<div class="right">
	<h3>Non Matching Columns</h3>
	<div class="container">
    <div class="tab">
    
    <div class="grid-container">
    <div class="grid-item span tab-heading"><b><?php echo $table1; ?></b></div>
    <?php 
    if ($result3->num_rows > 0) {
        ?>
        <div class="grid-item green"><b>Column</b></div>
        <div class="grid-item green"><b>DataType</b></div>
        <?php 
        while($row3 = $result3->fetch_assoc()) {?>
            
            <div class="grid-item"><b><?php echo $row3["COLUMN_NAME"];?></b></div>
            <div class="grid-item"><?php echo $row3["DATA_TYPE"]; ?></div>
        <?php }
    } else {
        echo "0 results";
    }
    ?>
    </div><!-- End of grid-container -->
    </div><!-- End of tab -->
    <div class="tab space">
    
    <div class="grid-container">
    <div class="grid-item span tab-heading"><b><?php echo $table2; ?></b></div>
    <?php 
    if ($result4->num_rows > 0) {
        ?>
        <div class="grid-item green"><b>Column</b></div>
        <div class="grid-item green"><b>DataType</b></div>
        <?php 
        while($row4 = $result4->fetch_assoc()) {?>
            
            <div class="grid-item"><b><?php echo $row4["COLUMN_NAME"]; ?></b></div>
            <div class="grid-item"><?php echo $row4["DATA_TYPE"]; ?></div>
       <?php  }
    } else {
        echo "0 results";
    }
    ?>
    </div><!-- End of grid-container -->
    </div><!-- End of tab -->
	<div><!-- End of container -->
    </div>

    <?php
}
?>


</body>
</html>