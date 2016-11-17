<?php
	include '../db/db2.php';
        include('../Login/session.php');
           ///update table when comments are made
	if (isset($_GET['edit'])) {

		$column = $_GET['column'];
		$id = $_GET['id'];
		$newValue = $_GET["newValue"];
                $operator = $login_session;
		
                //$prevValue = $_GET["prevValue"]; 
                
                //$sql1 = "insert into test_db.Comments (CommentTime,Comments) values (now(), $prevValue)";
                //$dbh->execute($sql1);
                
		$sql = "UPDATE MasterFile SET $column = :value, TimeOfComment = now(), Operator = '$operator' WHERE id_val = :id";
		$stmt = $dbh->prepare($sql);
		$stmt->bindParam(':value',$newValue);
		$stmt->bindParam(':id',$id);
		$response['success'] = $stmt->execute();
		$response['value'] = $newValue;

		echo json_encode($response);
                //store comments in Comments table for reference
                $sql_update = "insert into test_db.Comments(CommentTime,Comments,Operator,CustomerName,CustomerAccount)
                                select
                                TimeOfComment,Comments,Operator,MemberName,MemberAccount
                                from TIP.MasterFile
                                WHERE TimeOfComment = NOW()";
                $stmt = $dbh->prepare($sql_update);
                $stmt->execute();
                
                

	}
?>