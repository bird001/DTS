<?php
//connect to the database
include ('../db/db2.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Previous Comments</title>
        <meta charset="UTF-8"></meta>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"></meta>



        <meta name="viewport" content="width=device-width, initial-scale=1.0"></meta>
        <script src = "../js/jquery-2.1.4.min.js" type = "text/javascript"></script>
        <script src = "../js/jquery.dataTables.js" type = "text/javascript"></script>    
        <script src = "../js/tableTools.js" type = "text/javascript"></script>    

        <link rel="stylesheet" href="../CSS/datatables.min.css"></link>
        <link rel = "stylesheet" href = "../CSS/tableTools.css"></link>

        <link href="../CSS/bootstrap.min.css" rel="stylesheet"></link>
        <script type = "text/javascript" charset="utf-8">

            $(document).ready(function () {
                $('#datatables').dataTable();
            });
        </script>

    </head>

    <body>

        <div class = "container-fluid datatables_wrapper">
            <table id = "datatables" class = "table-hover table-bordered" style="width:180%">
                <thead>
                    <tr>
                        <th style="display:none">id_val</th><!--needed for sorting-->
                        <th>Member Account</th>
                        <th>PASBook</th>
                        <th>BR</th>
                        <th>Groups</th>
                        <th>Group Name</th>
                        <th>MemberName</th>
                        <th>M</th>
                        <th>DateMailed</th>
                        <th>L</th> 
                        <th>S</th>
                        <th>New Refinanced Amount</th>
                        <th>Loan Balance</th>
                        <th>Interest Balance</th>
                        <th>Repayment Amount</th>
                        <th>Date Last Paid</th>
                        <th>Arrears Age</th>
                        <th>Installment Arrears</th>
                        <th>OPR</th>
                        <th>APV</th>
                        <th>MON</th>
                        <th>PID</th>
                        <th>Month</th>
                        <th>Last Loan Amount</th>
                        <th>Date</th>
                        <th>Rate</th>
                        <th>Total Assets</th>
                        <th>All Loan Balances</th>
                        <th>Net Liability</th>
                        <th>Comments</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = 'SELECT * FROM MasterFileArchive';
                    $results = $dbh->query($sql);
                    $rows = $results->fetchAll();
                    //NB... if you want to make all the rows editable, make the class name the same as the row name`
                    foreach ($rows as $row) {
                        echo '<tr id="' . $row['id_val'] . '">';
                        echo '<td class="if" style="display:none">' . $row['id_val'] . '</td>' .
                        '<td class="memacc">' . $row['MemberAccount'] . '</td>' .
                        '<td class="psbk">' . $row['PASBook'] . '</td>' .
                        '<td class="b">' . $row['BR'] . '</td>' .
                        '<td class="grp">' . $row['Groups'] . '</td>' .
                        '<td class="grpnm">' . $row['GroupName'] . '</td>' .
                        '<td class="memnme">' . $row['MemberName'] . '</td>' .
                        '<td class="mm">' . $row['M'] . '</td>' .
                        '<td class="datmal">' . $row['DateMailed'] . '</td>' .
                        '<td class="ll">' . $row['L'] . '</td>' .
                        '<td class="ss">' . $row['S'] . '</td>' .
                        '<td class="newRefAm">' . $row['NewRefinancedAmount'] . '</td>' .
                        '<td class="LnBal">' . $row['LoanBalance'] . '</td>' .
                        '<td class="intBal">' . $row['InterestBalance'] . '</td>' .
                        '<td class="repAmt">' . $row['RepaymentAmount'] . '</td>' .
                        '<td class="datLaPd">' . $row['DateLastPaid'] . '</td>' .
                        '<td class="ArrAge">' . $row['ArrearsAge'] . '</td>' .
                        '<td class="instArr">' . $row['InstallmentArrears'] . '</td>' .
                        '<td class="op">' . $row['OPR'] . '</td>' .
                        '<td class="ap">' . $row['APV'] . '</td>' .
                        '<td class="mo">' . $row['MON'] . '</td>' .
                        '<td class="pi">' . $row['PID'] . '</td>' .
                        '<td class="mon">' . $row['Month'] . '</td>' .
                        '<td class="lLAmt">' . $row['LastLoanAmount'] . '</td>' .
                        '<td class="dat">' . $row['Date'] . '</td>' .
                        '<td class="rat">' . $row['Rate'] . '</td>' .
                        '<td class="totAss">' . $row['TotalAssets'] . '</td>' .
                        '<td class="aLoaBal">' . $row['AllLoanBalance'] . '</td>' .
                        '<td class="NetLiab">' . $row['NetLiability'] . '</td>' .
                        '<td class="comm" style="word-wrap: break-word">' . $row['Comments'] . '</td>';

                        echo '</tr>';
                    }
                    ?>


                </tbody>                     
            </table>
        </div>
    </body>
</html> 

