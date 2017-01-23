<?php
include ('../db/db3.php');


if ($_FILES[csv][size] > 0) {

    //get the csv file 
    $file = $_FILES[csv][tmp_name];

    $handle = fopen($file, "r");
    //archive the data set from the last month
    mysqli_query($conn, "INSERT INTO 
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

    //delete the data set from last month to freshly insert the current month
    mysqli_query($conn, "truncate table TIP.MasterFile");
    for ($lines = 0; $data = fgetcsv($handle, 10000, ",", '"'); $lines++) {//read csv file line by line
        if ($lines < 8)
            continue; //skip staring lines

        if ($data[0]) {//insert data from csv file into Database
            $memberaccount = addslashes($data[0]);
            $pasbook = addslashes($data[1]);
            $br = addslashes($data[2]);
            $groups = addslashes($data[3]);
            $membername = addslashes($data[4]);
            $loanref = addslashes($data[5]);
            $employer = addslashes($data[6]);
            $m = addslashes($data[7]);
            $datemailed = addslashes($data[8]);
            $l = addslashes($data[9]);
            $issuedate = addslashes($data[10]);
            $matdate = addslashes($data[11]);
            $pid = addslashes($data[12]);
            $s = addslashes($data[13]);
            $loanbal = addslashes($data[14]);
            $intbal = addslashes($data[15]);
            $repamount = addslashes($data[16]);
            $payfreq = addslashes($data[17]);
            $datelast = addslashes($data[18]);
            $paynextdue = addslashes($data[19]);
            $delage = addslashes($data[20]);
            $arrage = addslashes($data[21]);
            $intsarr = addslashes($data[22]);
            $opr = addslashes($data[23]);
            $apv = addslashes($data[24]);
            $mon = addslashes($data[25]);
            $lastloanamount = addslashes($data[26]);
            $date = addslashes($data[27]);
            $rate = addslashes($data[28]);
            $totalassets = addslashes($data[29]);
            $allloans = addslashes($data[30]);
            $netliability = addslashes($data[31]);
            
            $query = "INSERT INTO TIP.MasterFile (MemberAccount,PASBook,BR,Groups,MemberName,LoanReference,Employer,M,DateMailed,L,IssuedDate,MaturityDate,PID,S,
                LoanBalance,InterestBalance,RepaymentAmount,PayFrequency,DateLastPaid,PaymentNextDue,DelinquencyAge,ArrearsAge,InstallmentArrears,OPR,APV,MON,
                LastLoanAmount,Date,Rate,TotalAssets,AllLoansBalance,
                NetLiability) VALUES 
                ('$memberaccount','$pasbook','$br','$groups','$membername','$loanref','$employer','$m','$datemailed','$l','$issuedate','$matdate',"
                    . "'$pid','$s','$loanbal','$intbal','$repamount','$payfreq','$datelast','$paynextdue','$delage','$arrage','$intsarr','$opr',"
                    . "'$apv','$mon','$lastloanamount','$date','$rate','$totalassets','$allloans','$netliability')";
            mysqli_query($conn, $query);
        }

        //update DB MasterFile
        $cust_acc = $data[0];
        $cust_name = $data[3];
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
        mysqli_query($conn, $updateDB_MF);
    }
    //update DB School Listings
    $updateDB_SL = "UPDATE MasterFile
                inner join SchoolListings on MasterFile.MemberName = SchoolListings.Contact
                SET MasterFile.GroupName = SchoolListings.CompanyName
                WHERE MasterFile.MemberName = SchoolListings.Contact";
    mysqli_query($conn, $updateDB_SL);

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