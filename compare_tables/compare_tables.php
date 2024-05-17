<html>
<head>
<title>Compare Tables</title>
<link rel="stylesheet" href="style_compare_tables.css">
</head>
<body>

<form action="#" method = "post">
<div class="green-container">

<label for="table1" class="txt">Table 1 :</label>
<input type="text" name="table1" required/>

<label for="table2" class="txt">Table 2 :</label>
<input type="text" name="table2" required/>

<input type="submit" name="submit" value="Submit" class="btn"/>

</div>
</form>

<?php
include("config.php");
if($_SERVER["REQUEST_METHOD"] == "POST") {

    $table1 = mysqli_real_escape_string($conn,$_POST['table1']);
    $table2 = mysqli_real_escape_string($conn,$_POST['table2']);
    
    $sql1 = "SELECT COLUMN_NAME, DATA_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '$dbname' AND TABLE_NAME = '$table1'";
    $sql2 = "SELECT COLUMN_NAME, DATA_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '$dbname' AND TABLE_NAME = '$table2'";
    
    $result1 = mysqli_query($conn,$sql1);
    $result2 = mysqli_query($conn,$sql2);
    ?>
    <div class="center">
    <div class="tab">
    
    <div class="grid-container">
    <div class="grid-item span"><h3><?php echo $table1; ?></h3></div>
    <?php 
    if ($result1->num_rows > 0) {
        ?>
        <div class="grid-item"><h4>Column</h4></div>
        <div class="grid-item"><h4>DataType</h4></div>
        <?php 
        while($row1 = $result1->fetch_assoc()) {?>           
            <div class="grid-item"><b><?php echo $row1["COLUMN_NAME"];?></b></div>
            <div class="grid-item"><?php echo $row1["DATA_TYPE"]; ?></div>
        <?php }
    } else {
        echo "0 results";
    }
    ?>
    </div>
    </div>
    <div class="tab">
    
    <div class="grid-container">
    <div class="grid-item span"><h3><?php echo $table2; ?></h3></div>
    <?php 
    if ($result2->num_rows > 0) {
        ?>
        <div class="grid-item"><h4>Column</h4></div>
        <div class="grid-item"><h4>DataType</h4></div>
        <?php 
        while($row2 = $result2->fetch_assoc()) {?>          
            <div class="grid-item"><b><?php echo $row2["COLUMN_NAME"]; ?></b></div>
            <div class="grid-item"><?php echo $row2["DATA_TYPE"]; ?></div>
       <?php  }
    } else {
        echo "0 results";
    }
    ?>
    </div>
    </div>
	</div>
    <?php
}
?>

</body>
</html>