<?php
session_start();
    include('database connection.php');
    $in_no = $_GET['idd'];
    $query3 = pg_query($con, "select * from invoice where invoice_no = {$in_no}");
    $inx = pg_fetch_array($query3);
    if (isset($_POST['Updateinvoice'])) {

        $b = $_POST['d'];
        $c = $_POST['bg'];
        $d = $_POST['pos'];
        $e = $_POST['pi'];
        $f = $_POST['q'];


        $j = $_POST['ss'];

        $q1 = (pg_query($con, "select CAST((select gettax($e,$f)) as numeric) as data;"));
        $q2 = (pg_query($con, "select CAST((select getta($e,$f)) as numeric) as data;"));

        $r1 = pg_fetch_array($q1);
        $r2 = pg_fetch_array($q2);

        $g = $r1['data'];
        $h = $r2['data'];
         
        echo $g ; 
        $qe = "UPDATE invoice
        SET date='$b', buyer_gstin=$c, place_of_supply='$d', product_id=$e, quantity=$f, tax_amount='$g', total_amount='$h', supplier_state='$j'
        WHERE invoice_no =  $in_no;";
        $roww = pg_query($con, $qe);
        if ($qe){
            echo "<script type='text/javascript'>alert('Data Updated Successfully');
            document.location='invoice.php'</script>";
        }
        else{
            echo "Something Went Wrong";
        }
    }
    ?>