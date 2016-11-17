<?php
   include('../Login/session.php');
   include('../db/db2.php');
   
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
                $('#datatables').dataTable();
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
        </script>