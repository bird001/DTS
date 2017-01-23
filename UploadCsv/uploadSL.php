<?php
//connect to the database
include ('../db/db3.php');
//$connect = mysql_connect("localhost","root","toor");
//mysql_select_db("TIP",$connect); //select the table
//mysql_select_db("Tip",$connect); //select the table


if ($_FILES[csv][size] > 0) {

    //get the csv file 
    $file = $_FILES[csv][tmp_name];
    $handle = fopen($file, "r");
    //$delete_db = "truncate table SchoolListings";
    //mysql_query($delete_db);
    //
    //loop through the csv file and insert into database
    $truncate = "truncate table TIP.SchoolListings";
    mysqli_query($conn, $truncate);
    for ($lines = 0; $data = fgetcsv($handle, 10000, ",", '"'); $lines++) {
        if ($lines == 0)
            continue; //skip header line


            
//if (empty($line)) continue;//skip lines that are empty

        if ($data[0]) {

            $company = addslashes($data[0]);
            $companyname = addslashes($data[1]);
            $contact = addslashes($data[2]);

            $query = "INSERT INTO SchoolListings (Company,CompanyName,Contact) VALUES 
                ('$company','$companyname','$contact' 
            )";
            mysqli_query($conn, $query);
        }
    }
    //update Masterfile Table with matching schools depending on the group id
    $updateDB = "UPDATE MasterFile
                inner join SchoolListings on MasterFile.MemberName = SchoolListings.Contact
                SET MasterFile.GroupName = SchoolListings.CompanyName
                WHERE MasterFile.MemberName = SchoolListings.Contact";

    mysqli_query($conn, $updateDB);

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
        <title>Import Student Listings</title>
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