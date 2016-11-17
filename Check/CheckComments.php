<?php
//connect to the database
include ('../db/db2.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Previous Comments</title>

<meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src = "../js/jquery-2.1.4.min.js" type = "text/javascript"></script>
        <script src = "../js/jquery.dataTables.js" type = "text/javascript"></script>    
        <script src = "../js/tableTools.js" type = "text/javascript"></script>    
        
        <link rel = "stylesheet" href = "../CSS/datatables.min.css">
        <link rel = "stylesheet" href = "../CSS/tableTools.css">
        <script type = "text/javascript" charset="utf-8">
        
            $(document).ready(function(){
                $('#datatables').dataTable();
           });
            //window.alert("blah");
        </script>
        <link href="../CSS/bootstrap.min.css" rel="stylesheet">
        <!--<style>
                table, th, td {
                border: 1px solid black;
            }
        </style>-->
        
</head>

<body>
    <body>
       <div class = "container-fluid">
           <table id = "datatables" class = "table-hover table-bordered" style="width: 100%;">
               <thead>
                   <tr>
                       <th>Comment Time</th>
                       <th>Comments</th>
                       <th>Operator</th>
                       <th>Customer Name</th>
                       <th>Customer Account</th>
                   </tr>
               </thead>
               <tbody>
                  <?php
                    $sql = 'SELECT * FROM test_db.Comments';
    				$results = $dbh->query($sql);
    				$rows = $results->fetchAll();
                                //NB... if you want to make all the rows editable, make the class name the same as the row name`
    				foreach ($rows as $row) { 
    					echo '<tr>';
    					echo '<td class="comtime">'.$row['CommentTime'].'</td>'.
                                             '<td class="com">'.$row['Comments'].'</td>'.
                                             '<td class="oper">'.$row['Operator'].'</td>'.
                                             '<td class="custname">'.$row['CustomerName'].'</td>'.                                                 
                                             '<td class="custacc">'.$row['CustomerAccount'].'</td>';                                                 
    					echo '</tr>';
    				}
                   ?>
               </tbody>                     
           </table>
       </div>
   </body>
</body>
</html> 

