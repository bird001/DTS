<?php 

//connect to the database
include ('../db/db3.php');


if ($_FILES[csv][size] > 0) { 

    //get the csv file 
    $file = $_FILES[csv][tmp_name]; 
    $handle = fopen($file,"r");
    
    //loop through the csv file and insert into database 
    for ($lines = 0; $data = fgetcsv($handle,10000,",",'"'); $lines++) {
        if ($lines == 0) continue;//skip header line
        //if (empty($line)) continue;//skip lines that are empty

        if ($data[0]) { 
            $receipt = addslashes($data[0]);
            $operator = addslashes($data[1]);
            $transdate = addslashes($data[2]);
            $accnum = addslashes($data[3]);
            $membername = addslashes($data[4]);
            $num = addslashes($data[5]);
            $totalval = addslashes($data[6]);
            $checknum = addslashes($data[7]);
            
            $query = "INSERT INTO RecieptListings (Reciept,OPR,TransactionDate,AccountNumber,MemberName,Number,TotalValue,CheckNumber) VALUES 
                ('$receipt','$operator','$transdate','$accnum','$membername','$num','$totalval','$checknum') 
            ";
            mysqli_query($conn, $query); 
        } 
    }

    
    //close pop-up window
    echo "<script>window.close();</script>";
    //reload parent page after child page(pop-up window) is closed
    echo "<script>window.onunload = refreshParent;

    function refreshParent() {
        window . opener . location . reload();
    }
    </script>";

}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Import Receipt Listings</title>
<link href="../CSS/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<div class = "form-group">
<form class = "form-horizontal" action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
  Choose your file: <br />
  <input name="csv" type="file" id="csv" />
  <input type="submit" name="Submit" value="Submit" />
</form>
</div
</body>
</html> 