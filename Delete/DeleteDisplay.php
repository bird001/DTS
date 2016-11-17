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
        <script type="text/javascript" src="../Delete/DeleteRow.js"></script>
        <script type = "text/javascript" charset="utf-8">
        
            $(document).ready(function(){
                $('#datatables').dataTable();
           });
        </script>
        
        <link href="../CSS/bootstrap.min.css" rel="stylesheet">
        <link href="../CSS/tableTools.css" rel="stylesheet">
        <link href="../CSS/datatables.min.css" rel="stylesheet">
   </head>
   
   <body>
       <div align = "right" class = "container-fluid">
       </div>
       <div class = "container-fluid datatables_wrapper">
           <form name="bulk_action_form" action="../Delete/Delete.php" method="post">
           <table id = "datatables" class = "table-hover table-bordered" style="width:100%">
               <thead>
                   <tr>
                       <th style="display:none">id_val</th><!--needed for sorting-->
                       <th align = "center">
                           <div>
                               <input type="submit" class="btn btn-danger" name="bulk_delete_submit" value="Delete" onclick = "deleteConfirm();"/>
                           </div>
                           <div align = "center">
                               <input type="checkbox" name="select_all" id="select_all" value=""/>
                           </div>
                               
                       </th>                       
                       <th>Member Account</th>
                       <th>MemberName</th>
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
                                             '<td align = "center"><input type="checkbox" name = "checked_id[]" class = "checkbox" value= "'.$row['id_val'].'" >'.'</td>'.
                                             '</form>'.
                                             '<td class="memacc">'.$row['MemberAccount'].'</td>'.
                                             '<td class="memnme">'.$row['MemberName'].'</td>'.
                                             '<td class="comments" style="word-wrap: break-word">'.$row['Comments'].'</td>';
                                       
    					echo '</tr>';
    				}
                   ?>
                   

               </tbody>                     
           </table>
           </form>
       </div>
   </body>
   
</html>
