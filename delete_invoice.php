<?php
	session_start();
	include('database connection.php');
	
	
        $in_no = $_GET['id'];

	

		$query = pg_query($con, "DELETE FROM invoice
        WHERE invoice_no={$in_no}");
		if($query){	
			echo " data deleted succesfully";
			header('location: invoice.php');
		}
		else{
			echo "Some thing Went Wrong";
			
		}
		
		
	
?>
