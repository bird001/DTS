<?php
    // session_start();
    include('../db/db3.php');
    include('../Login/session.php');
        $operator = $login_session;
        $idArr = $_POST['checked_id'];
        foreach($idArr as $id){
            mysqli_query($conn,"insert into TIP.DeletedCust(id_val,CustomerName,CustomerAccount,TimeDeleted)
                                select
                                id_val,MemberName,MemberAccount,NOW()
                                from
                                TIP.MasterFile
                                where MasterFile.id_val = $id");
            
            mysqli_query($conn,"update TIP.DeletedCust set Operator = '$operator' where id_val = $id");
            
            mysqli_query($conn,"DELETE FROM MasterFile WHERE id_val=".$id);
        }
        $_SESSION['success_msg'] = 'Users have been deleted successfully.';
        header("Location:../Delete/DeleteDisplay.php");
    
?>