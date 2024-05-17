<?php
include("config.php");
include("db_query.php");
?>
<!DOCKTYPE html>
<head>
<title>Compare Tables</title>
<link rel="stylesheet" href="style_compare_tables.css">
</head>

<body>
<h2>Comparing all Tables of 2 Databases</h2>
<div>
<p>
<a href="select_db.php">Select Databases</a>
>
All Tables
</p>
</div>
<?php
    $sql1 = "SELECT A.TABLE_NAME AS TB, A.COLUMN_NAME AS CN, A.DATA_TYPE AS D1, B.DATA_TYPE AS D2
     FROM INFORMATION_SCHEMA.COLUMNS A, INFORMATION_SCHEMA.COLUMNS B
     WHERE A.TABLE_SCHEMA = '$db1' AND B.TABLE_SCHEMA = '$db2'
     AND A.TABLE_NAME=B.TABLE_NAME AND A.COLUMN_NAME=B.COLUMN_NAME
     ORDER BY A.TABLE_NAME, A.COLUMN_NAME";
    
    $sql2 = "SELECT Z.TABLE_NAME AS TB, Z.COLUMN_NAME AS CN, Z.DATA_TYPE AS D
    FROM INFORMATION_SCHEMA.COLUMNS AS Z
    WHERE Z.TABLE_SCHEMA = '$db1' AND Z.COLUMN_NAME NOT IN
    (SELECT temp.COLUMN_NAME FROM
    (SELECT A.TABLE_NAME, A.COLUMN_NAME, A.DATA_TYPE
    FROM INFORMATION_SCHEMA.COLUMNS A, INFORMATION_SCHEMA.COLUMNS B
    WHERE A.TABLE_SCHEMA = '$db1' AND B.TABLE_SCHEMA = '$db2'
    AND A.TABLE_NAME=B.TABLE_NAME AND A.COLUMN_NAME=B.COLUMN_NAME
    ORDER BY A.TABLE_NAME, A.COLUMN_NAME) AS temp)";
    
    $sql3="SELECT Z.TABLE_NAME AS TB, Z.COLUMN_NAME AS CN, Z.DATA_TYPE AS D
    FROM INFORMATION_SCHEMA.COLUMNS AS Z
    WHERE Z.TABLE_SCHEMA = '$db2' AND Z.COLUMN_NAME NOT IN
    (SELECT temp.COLUMN_NAME FROM
    (SELECT A.TABLE_NAME, A.COLUMN_NAME, A.DATA_TYPE
    FROM INFORMATION_SCHEMA.COLUMNS A, INFORMATION_SCHEMA.COLUMNS B
    WHERE A.TABLE_SCHEMA = '$db1' AND B.TABLE_SCHEMA = '$db2'
    AND A.TABLE_NAME=B.TABLE_NAME AND A.COLUMN_NAME=B.COLUMN_NAME
    ORDER BY A.TABLE_NAME, A.COLUMN_NAME) AS temp)";

    $result1 = mysqli_query($conn1,$sql1);
    $result2 = mysqli_query($conn2,$sql2);
    $result3 = mysqli_query($conn2,$sql3);
?>

    <div class="left">
    <h3>Matching Tables and Columns</h3>

    <div class="container">
    <div class="tab">

    <div class="grid-container-4">
   
    <?php
    if ($result1->num_rows > 0) {
        ?>
        <div class="grid-item tab-heading"><b>Table</b></div>
        <div class="grid-item tab-heading"><b>Column</b></div>
        <div class="grid-item tab-heading"><b>DataType of <?php echo $db1; ?></b></div>
        <div class="grid-item tab-heading"><b>DataType of <?php echo $db2; ?></b></div>
        <?php
        while($row1 = $result1->fetch_assoc()) {?>
            <div class="grid-item-green"><b><?php echo $row1["TB"];?></b></div>
            <div class="grid-item"><b><?php echo $row1["CN"];?></b></div>
            <div class="grid-item"><?php echo $row1["D1"]; ?></div>
            <div class="grid-item"><?php echo $row1["D2"]; ?></div>
        <?php }
    } else {
        echo "0 results";
    }
    ?>
    </div><!-- End of grid-container -->
    </div><!-- End of tab -->
    
	</div><!-- End of container -->
    </div>

    <div class="right">
    <h3>Non Matching Tables or Columns</h3>

    <div class="container">
    <div class="tab">

    <div class="grid-container-3">
    
    <div class="grid-item tab-heading span-3"><b><?php echo $db1; ?></b></div>
    <?php
    if ($result2->num_rows > 0) {
        ?>
        <div class="grid-item green"><b>Table</b></div>
        <div class="grid-item green"><b>Column</b></div>
        <div class="grid-item green"><b>DataType</b></div>
        
        <?php
        while($row2 = $result2->fetch_assoc()) {?>
            <div class="grid-item-green"><b><?php echo $row2["TB"];?></b></div>
            <div class="grid-item"><b><?php echo $row2["CN"];?></b></div>
            <div class="grid-item"><?php echo $row2["D"]; ?></div>
            
        <?php }
    } else {
        echo "0 results";
    }
    ?>
    </div><!-- End of grid-container -->
    </div><!-- End of tab -->
    
    <div class="tab space">

    <div class="grid-container-3">
    
    <div class="grid-item tab-heading span-3"><b><?php echo $db2; ?></b></div>
    <?php
    if ($result3->num_rows > 0) {
        ?>
        <div class="grid-item green"><b>Table</b></div>
        <div class="grid-item green"><b>Column</b></div>
        <div class="grid-item green"><b>DataType</b></div>
        
        <?php
        while($row3 = $result3->fetch_assoc()) {?>
            <div class="grid-item-green"><b><?php echo $row3["TB"];?></b></div>
            <div class="grid-item"><b><?php echo $row3["CN"];?></b></div>
            <div class="grid-item"><?php echo $row3["D"]; ?></div>
            
        <?php }
    } else {
        echo "0 results";
    }
    ?>
    </div><!-- End of grid-container -->
    </div><!-- End of tab -->

	</div><!-- End of container -->
    </div>

</body>
</html>