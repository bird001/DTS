<?php
//connect to the database
include ('../db/db2.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Receipts Listings</title>

<meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src = "../js/jquery-2.1.4.min.js" type = "text/javascript"></script>
        
        <script src = "../js/jquery.dataTables.js" type = "text/javascript"></script>    
        <script src = "../js/tableTools.js" type = "text/javascript"></script>    
        
        <link rel = "stylesheet" href = "../CSS/datatables.min.css">
        <link rel = "stylesheet" href = "../CSS/tableTools.css">


        <script type = "text/javascript" charset="utf-8">
            $(document).ready(function(){
                var table = $('#datatables').dataTable();//initialize data tables
                var tableTools = new $.fn.dataTable.TableTools(table, {
                  
                    'sSwfPath': '//cdn.datatables.net/tabletools/2.2.4/swf/copy_csv_xls_pdf.swf',//initialize datatable functions
                    'aButtons': ['copy',{
                            'sExtends':'print',
                            'bShowAll': false //only show data being displayed
                        },'pdf',{
                            'sExtends':'xls',
                            'sFileName': '*.xlsx',
                            "oSelectorOpts": { filter: 'applied', order: 'current' }//if filter is applied, only print filter list
                        }]//buttons to display
                });
                $(tableTools.fnContainer()).insertBefore('#datatables_wrapper');
           });
            //window.alert("blah");
        </script>
        <link href="../CSS/bootstrap.min.css" rel="stylesheet">
        
</head>

<body>
    <body>
       <div class = "container-fluid datatables_wrapper">
           <table id = "datatables" class = "table-hover table-bordered" style="width: 100%;">
               <thead>
                   <tr>
                       <!--<th style="display:none">id_val</th>-->
                       <th>Receipt #</th>
                       <th>Customer Name</th>
                       <th>Account #</th>
                       <th>Total Amount Paid</th>
                       <th>Payment Type</th>
                       <th>Payment Date</th>
                       <th>Loan Type</th>
                       <th>Loan Balance</th>
                   </tr>
               </thead>
               <tbody>
                  <?php
                    $sql = 'select 
                    RecieptListings.id_val,RecieptListings.Reciept,RecieptListings.MemberName,RecieptListings.AccountNumber,RecieptListings.TotalValue,
                    RecieptListings.CheckNumber,RecieptListings.TransactionDate,MasterFile.L,MasterFile.LoanBalance
                    from 
                    RecieptListings,MasterFile
                    where
                    RecieptListings.AccountNumber = MasterFile.MemberAccount and
                    RecieptListings.MemberName = MasterFile.MemberName';
                     
                     
                     //$sql = 'select * from MasterFile,RecieptListings';
    				$results = $dbh->query($sql);
    				$rows = $results->fetchAll();
                                //NB... if you want to make all the rows editable, make the class name the same as the row name`
    				foreach ($rows as $row) { 
    					echo '<tr>';
    					echo //'<td class="rec_id" style="display:none">'.$row['id_val'].'</td>'.
                                             '<td class="rec">'.$row['Reciept'].'</td>'.
                                             '<td class="memname">'.$row['MemberName'].'</td>'.
                                             '<td class="accnum">'.$row['AccountNumber'].'</td>'.                                                 
                                             '<td class="val">'.$row['TotalValue'].'</td>'.                                                 
                                             '<td class="checknum">'.$row['CheckNumber'].'</td>'.                                                 
                                             '<td class="transdate">'.$row['TransactionDate'].'</td>'.                                                 
                                             '<td class="type">'.$row['L'].'</td>'.                                                 
                                             '<td class="loanbal">'.$row['LoanBalance'].'</td>';                                                 
    					echo '</tr>';
    				}
                   ?>
               </tbody>                     
           </table>
       </div>
   </body>
</body>
</html> 

