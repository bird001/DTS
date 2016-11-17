<?php
   include('../Login/session.php');
   include('../db/db2.php');
   include('../db/db.php');
   
   //$q = $dbh -> prepare("UPDATE UserLog SET Active = NOW() WHERE Operator = '$user_check'");
   //$q -> execute(array($_SESSION['login_user']));
?>

<html>
   
   <head>
       <title>TIP DTS</title>
      <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src = "../js/jquery-2.1.4.min.js" type = "text/javascript"></script>
        <script src = "../js/jquery.dataTables.js" type = "text/javascript"></script>    
        <script src = "../js/tableTools.js" type = "text/javascript"></script>    
        <script type="text/javascript" src="../Editable/edit.js"></script>
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
                            'sFileName': '*.xls',
                            "oSelectorOpts": { filter: 'applied', order: 'current' } //if filter is applied, only print filter list
                        }]//buttons to display
                });
                $(tableTools.fnContainer()).insertBefore('#datatables_wrapper');
           });
            //window.alert("blah");
        </script>
        <script>
            function SubmitBtnSL(){
                //pop up window for uploading SchoolListinngs csv files
                window.open("../UploadCsv/uploadSL.php","Upload SL CSV","location=1,status=1,scrollbars=1,width=400,height=400");
            }
            function SubmitBtnMF(){
                //pop up window for uploading MasterFile csv files
                window.open("../UploadCsv/uploadMF.php","Upload MF CSV","location=1,status=1,scrollbars=1,width=400,height=400");
            }
            function SubmitBtnRL(){
                //pop up window for uploading MasterFile csv files
                window.open("../UploadCsv/uploadRL.php","Upload RL CSV","location=1,status=1,scrollbars=1,width=800,height=400");
            }
            function CheckRL(){
                //pop up window for uploading MasterFile csv files
                window.open("../Check/CheckReceipts.php","Check Receipt Listings","location=1,status=1,scrollbars=1,width=800,height=400");
            }
            function CheckComments(){
                //pop up window for uploading MasterFile csv files
                window.open("../Check/CheckComments.php","Check Comments","location=1,status=1,scrollbars=1,width=800,height=400");
            }
            function CheckArchives(){
                //pop up window for uploading MasterFile csv files
                window.open("../Check/CheckArchives.php","Check Archives","location=1,status=1,scrollbars=1,width=800,height=400");
            }
            
            function DeleteEntries(){
                //pop up window for uploading MasterFile csv files
                window.open("../Delete/DeleteDisplay.php","Delete Entries","location=1,status=1,scrollbars=1,width=800,height=400");
            }
            
        </script>
        <script type = "text/javascript" src = "ColumnHidden.js"></script>
        
        <link href="../CSS/bootstrap.min.css" rel="stylesheet">
        <link href="../CSS/tableTools.css" rel="stylesheet">
        <link href="../CSS/datatables.min.css" rel="stylesheet">
        <!--<style>
                table, th, td {
                border: 1px solid black;
            }
        </style>-->
   </head>
   
   <body>
       <div align = "right" class = "container-fluid">
           <h4>Welcome <?php echo $login_session; ?></h4> 
           <h4><a href="../Login/Logout.php">Sign Out</a></h4>
       </div>
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
                       <th>Loan Reference</th>
                       <th>Employer</th>
                       <th>M</th>
                       <th>DateMailed</th>
                       <th>L</th> 
                       <th>DateIssued</th> 
                       <th>MaturityDate</th> 
                       <th>PID</th>
                       <th>S</th>
                       <th>Loan Balance</th>
                       <th>Interest Balance</th>
                       <th>Repayment Amount</th>
                       <th>Payment Frequency</th>
                       <th>Date Last Paid</th>
                       <th>Next Payment Due</th>
                       <th>Delinquency Age</th>
                       <th>Arrears Age</th>
                       <th>Installment Arrears</th>
                       <th>OPR</th>
                       <th>APV</th>
                       <th>MON</th>
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
                    $sql = 'SELECT * FROM MasterFile';
    				$results = $dbh->query($sql);
    				$rows = $results->fetchAll();
                                //NB... if you want to make all the rows editable, make the class name the same as the row name`
    				foreach ($rows as $row) { 
    					echo '<tr id="'.$row['id_val'].'">';
    					echo '<td class="if" style="display:none">'.$row['id_val'].'</td>'.
                                             '<td class="memacc">'.$row['MemberAccount'].'</td>'.
                                             '<td class="psbk">'.$row['PASBook'].'</td>'.
                                             '<td class="b">'.$row['BR'].'</td>'.
                                             '<td class="grp">'.$row['Groups'].'</td>'.
                                             '<td class="grpnm">'.$row['GroupName'].'</td>'.
                                             '<td class="memnme">'.$row['MemberName'].'</td>'.
                                             '<td class="memnme">'.$row['LoanReference'].'</td>'.
                                             '<td class="emp">'.$row['Employer'].'</td>'.
                                             '<td class="mm">'.$row['M'].'</td>'.
                                             '<td class="datmal">'.$row['DateMailed'].'</td>'.
                                             '<td class="ll">'.$row['L'].'</td>'.
                                             '<td class="issda">'.$row['IssuedDate'].'</td>'.
                                             '<td class="matda">'.$row['MaturityDate'].'</td>'.
                                             '<td class="pi">'.$row['PID'].'</td>'.
                                             '<td class="ss">'.$row['S'].'</td>'.
                                             '<td class="LnBal">'.$row['LoanBalance'].'</td>'.
                                             '<td class="intBal">'.$row['InterestBalance'].'</td>'.
                                             '<td class="repAmt">'.$row['RepaymentAmount'].'</td>'.
                                             '<td class="repAmt">'.$row['PayFrequency'].'</td>'.
                                             '<td class="datLaPd">'.$row['DateLastPaid'].'</td>'.
                                             '<td class="datLaPd">'.$row['PaymentNextDue'].'</td>'.
                                             '<td class="datLaPd">'.$row['DelinquencyAge'].'</td>'.
                                             '<td class="ArrAge">'.$row['ArrearsAge'].'</td>'.
                                             '<td class="instArr">'.$row['InstallmentArrears'].'</td>'.
                                             '<td class="op">'.$row['OPR'].'</td>'.
                                             '<td class="ap">'.$row['APV'].'</td>'.
                                             '<td class="mo">'.$row['MON'].'</td>'.
                                             '<td class="lLAmt">'.$row['LastLoanAmount'].'</td>'.
                                             '<td class="dat">'.$row['Date'].'</td>'.
                                             '<td class="rat">'.$row['Rate'].'</td>'.
                                             '<td class="totAss">'.$row['TotalAssets'].'</td>'.
                                             '<td class="aLoaBal">'.$row['AllLoansBalance'].'</td>'.
                                             '<td class="NetLiab">'.$row['NetLiability'].'</td>'.
                                             '<td class="comments" style="word-wrap: break-word">'.$row['Comments'].'</td>';
                                       
    					echo '</tr>';
    				}
                   ?>
                   

               </tbody>                     
           </table>
           <?php
           if ($login_session == 'bird' || $login_session == 'nomnom'){
           ?>
           <button class="btn btn-primary" onclick='SubmitBtnSL();'>Upload School Listings</button>
           <button class="btn btn-primary" onclick='SubmitBtnMF();'>Upload Master File</button>
           <button class="btn btn-primary" onclick='SubmitBtnRL();'>Upload Receipt Listings</button>
           <?php
           }
           ?>
           <button class="btn btn-primary" onclick='CheckRL();'>View Receipt Listings</button>
           <button class="btn btn-primary" onclick="CheckComments();">Previous Comments</button>
           <?php
           if ($login_session == 'bird' || $login_session == 'nomnom'){
           ?>
           <button class="btn btn-danger" onclick="DeleteEntries();">Delete Entries</button>
           <button class="btn btn-primary" onclick="CheckArchives();">Check Archives</button>
           <?php
           }
           ?>
       </div>
       <div><!--hide columns-->
           <select multiple="multiple">
               <option id = "toggle2">Member Account</option>
               <option id = "toggle3">PASBook</option>
               <option id = "toggle4">BR</option>
               <option id = "toggle5">Groups</option>
               <option id = "toggle6">Group Name</option>
               <option id = "toggle7">MemberName</option>
               <option id = "toggle8">M</option>
               <option id = "toggle9">DateMailed</option>
               <option id = "toggle10">L</option>
               <option id = "toggle11">S</option>
               <option id = "toggle12">New Refinanced Amount</option>
               <option id = "toggle13">Loan Balance</option>
               <option id = "toggle14">Interest Balance</option>
               <option id = "toggle15">Repayment Amount</option>
               <option id = "toggle16">Date Last Paid</option>
               <option id = "toggle17">Arrears Age</option>
               <option id = "toggle18">Installment Arrears</option>
               <option id = "toggle19">OPR</option>
               <option id = "toggle20">APV</option>
               <option id = "toggle21">MON</option>
               <option id = "toggle22">PID</option>
               <option id = "toggle23">Month</option>
               <option id = "toggle24">Last Loan Amount</option>
               <option id = "toggle25">Date</option>
               <option id = "toggle26">Rate</option>
               <option id = "toggle27">Total Assets</option>
               <option id = "toggle28">All Loan Balances</option>
               <option id = "toggle29">Net Liability</option>
               <option id = "toggle30">Comments</option>
           </select>  
       </div>
   </body>
   
</html>
