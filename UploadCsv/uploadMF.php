<?php 

//connect to the database
include ('../db/db.php');
//$connect = mysql_connect("localhost","root","toor");
//mysql_select_db("TIP",$connect); //select the table
//mysql_select_db("Tip",$connect); //select the table


if ($_FILES[csv][size] > 0) { 

    //get the csv file 
    $file = $_FILES[csv][tmp_name]; 
    
    $handle = fopen($file,"r");
    //$delete_db = "truncate table MasterFile";//for testing, used to empty table data
    //mysql_query($delete_db);//for testing, used to empty table data 
    //loop through the csv file and insert into database 
    mysql_query("INSERT INTO 
                TIP.MasterFileArchive 
                (MemberAccount,PASBook,BR,Groups,GroupName,MemberName,LoanReference,Employer,M,DateMailed,L,IssuedDate,MaturityDate,PID,S,
                LoanBalance,InterestBalance,RepaymentAmount,PayFrequency,DateLastPaid,PaymentNextDue,DelinquencyAge,ArrearsAge,InstallmentArrears,OPR,APV,MON,
                LastLoanAmount,Date,Rate,TotalAssets,AllLoansBalance,
                NetLiability,Comments,TimeOfComment,Operator) 
                select 
                MemberAccount,PASBook,BR,Groups,GroupName,MemberName,LoanReference,Employer,M,DateMailed,L,IssuedDate,MaturityDate,PID,S,
                LoanBalance,InterestBalance,RepaymentAmount,PayFrequency,DateLastPaid,PaymentNextDue,DelinquencyAge,ArrearsAge,InstallmentArrears,OPR,APV,MON,
                LastLoanAmount,Date,Rate,TotalAssets,AllLoansBalance,
                NetLiability,Comments,TimeOfComment,Operator 
                from 
                TIP.MasterFile");
    
    mysql_query("truncate table TIP.MasterFile");
        for ($lines = 0; $data = fgetcsv($handle,10000,",",'"'); $lines++) {//read csv file line by line
       if ($lines < 12) continue;//skip staring lines
  
        if ($data[0]) {//insert data from csv file into Database
            mysql_query("INSERT INTO TIP.MasterFile (MemberAccount,PASBook,BR,Groups,MemberName,LoanReference,Employer,M,DateMailed,L,IssuedDate,MaturityDate,PID,S,
                LoanBalance,InterestBalance,RepaymentAmount,PayFrequency,DateLastPaid,PaymentNextDue,DelinquencyAge,ArrearsAge,InstallmentArrears,OPR,APV,MON,
                LastLoanAmount,Date,Rate,TotalAssets,AllLoansBalance,
                NetLiability) VALUES 
                (
                '".addslashes($data[0])."', 
                '".addslashes($data[1])."', 
                '".addslashes($data[2])."', 
                '".addslashes($data[3])."', 
                '".addslashes($data[4])."', 
                '".addslashes($data[5])."',
                '".addslashes($data[6])."',
                '".addslashes($data[7])."',
                '".addslashes($data[8])."',
                '".addslashes($data[9])."',
                '".addslashes($data[10])."',
                '".addslashes($data[11])."',
                '".addslashes($data[12])."',
                '".addslashes($data[13])."',
                '".addslashes($data[14])."',
                '".addslashes($data[15])."',
                '".addslashes($data[16])."',
                '".addslashes($data[17])."',
                '".addslashes($data[18])."',
                '".addslashes($data[19])."',
                '".addslashes($data[20])."',
                '".addslashes($data[21])."',
                '".addslashes($data[22])."',
                '".addslashes($data[23])."',
                '".addslashes($data[24])."',
                '".addslashes($data[25])."',
                '".addslashes($data[26])."',
                '".addslashes($data[27])."',
                '".addslashes($data[28])."',
                '".addslashes($data[29])."',
                '".addslashes($data[30])."',
                '".addslashes($data[31])."'
            )"); 
        }
        
        //update DB MasterFile
        $cust_acc = $data[0];
        $cust_name = $data[4];
        $updateDB_MF = "update TIP.MasterFile 
                    set MasterFile.Comments =
                    (select Comments 
                    from 
                    test_db.Comments 
                    where 
                    CustomerName = '$cust_name' and
                    CustomerAccount = '$cust_acc' and    
                    CommentTime < now() order by CommentTime desc limit 1) 
                    where 
                    MasterFile.MemberName = '$cust_name' and 
                    MasterFile.MemberAccount = '$cust_acc' order by MasterFile.id_val desc limit 1";
        mysql_query($updateDB_MF);
       
        
    } 
    //update DB School Listings
    $updateDB_SL = "UPDATE MasterFile
                inner join SchoolListings on MasterFile.MemberName = SchoolListings.Contact
                SET MasterFile.GroupName = SchoolListings.CompanyName
                WHERE MasterFile.MemberName = SchoolListings.Contact";
    mysql_query($updateDB_SL);
    
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
<title>Import MasterFile</title>
<link href="../CSS/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<div class = form-group>
<form class = "form-horizontal" action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
  Choose your file: <br />
  <input name="csv" type="file" id="csv" />
  <input type="submit" name="Submit" value="Submit" />
</form>
</div>
</body>
</html> 