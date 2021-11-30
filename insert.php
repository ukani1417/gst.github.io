<?php
	session_start();
	include('database connection.php');
	if(isset($_POST['Upload']));
	{
	
		$b = $_POST['d'];
		$c = $_POST['bg'];
		$d = $_POST['pos'];
		$e = $_POST['pi'];
		$f = $_POST['q'];
		// $g = $_POST['ta'];
		// $h = $_POST['toa'];
		$j = $_POST['ss'];


		$query2 = pg_query($con, "select CAST((select invoice_no from invoice order by invoice_no desc limit 1) as integer)+1 as data");
		$row = pg_fetch_array($query2);
		$new_invoice_no = $row['data'];

		$sg=$_SESSION['username'];

		$q1 = (pg_query($con,"select CAST((select gettax($e,$f)) as numeric) as data;"));
		$q2 = (pg_query($con,"select CAST((select getta($e,$f)) as numeric) as data;"));

		$r1 = pg_fetch_array($q1);
		$r2 = pg_fetch_array($q2);

		$g = $r1['data'];
		$h = $r2['data'];

		 
	

		$query = pg_query($con, "insert into invoice values($new_invoice_no,'$b',$c,'$d',$e,$f,$g,$h,$sg,'$j')");
		$r3 = pg_fetch_array($query);
		echo $r3;
		if($query){	
			echo " data insert succesfully";
			header('location: invoice.php');
		}
		else{
			echo "Some thing Went Wrong";
			
		}
		
		
	}
?>