

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="navbar.css">
    <title>Insertinvoice page</title>
</head>

<body>

    <?php
    include('database connection.php');
    $in_no = $_GET['id'];
    $query3 = pg_query($con,"select * from invoice where invoice_no = {$in_no}");
    $inx = pg_fetch_array($query3);
    if(isset($_POST['Ui'])){

        $query2 = pg_query($con, "select CAST((select invoice_no from invoice order by invoice_no desc limit 1) as integer)+1 as data");
		$row = pg_fetch_array($query2);
		$new_invoice_no = $row['data'];
		
		$b = $_POST['d'];
		$c = $_POST['bg'];
		$d = $_POST['pos'];
		$e = $_POST['pi'];
		$f = $_POST['q'];
        
		
		
		$j = $_POST['ss'];

        $q1 = pg_query($con,"select CAST((select gettax($e,$f)) as numeric) as data");
        $r1 = pg_fetch_array($q1);
        $g = $r1['data'];

        
        $q2 = pg_query($con,"select CAST((select getta($e,$f)) as numeric) as data");
        $r2 = pg_fetch_array($q2);
        $h  = $r2['data'];

        $q3 = pg_query($con,"select supplier_gstin from invoice where invoice_no={$in_no}");
        $r3 = pg_fetch_array($q3);
        $i  = $r3['supplier_gstin'];


        $qe = "UPDATE invoice
        SET date='$b', buyer_gstin=$c, place_of_supply='$d', product_id=$e, quantity=$f, tax_amount='$g', total_amount='$h', supplier_gstin=$i, supplier_state='$j'
        WHERE invoice_no =  $in_no;";
        $roww = pg_query($con,$qe);
        
        if($qe){
           
            echo "<script type='text/javascript'>alert('data updated');document.location='invoice.php'</script>";
        }
        else{
            echo $roww;
        }
        
    }
    ?>
    <form   method="post">

        <div class="form-row">

           
            <div class="form-group col-md-6">
                <label for="inputAddress">Date</label>
                <input type="text" class="form-control" id="inputAddress" placeholder="yyyy-mm-dd" name="d" value="<?php echo $inx['date']; ?>">
            </div>
        </div>
        <div class="form-row">

            <div class="form-group col-md-6">
                <label for="inputPassword4">Buyer GSTIN</label>
                <input type="text" class="form-control" id="inputPassword4" placeholder="GSTIN Number" name="bg" value="<?php echo $inx['buyer_gstin']; ?>">
            </div>
                   </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputAddress2">Place Of Supply</label>
                <input type="text" class="form-control" id="inputAddress2" placeholder="State Name" name="pos" value="<?php echo $inx['place_of_supply']; ?>">
            </div>
            <div class="form-group col-md-6">
                <label for="inputAddress2">Supplier State</label>
                <input type="text" class="form-control" id="inputAddress2" placeholder="State Name" name="ss" value="<?php echo $inx['supplier_state']; ?>">
            </div>
        </div>
        <div class="form-row ">
            <div class="form-group col-md-6">
                <label for="inputAddress2">Product Id</label>
                <input type="text" class="form-control" id="inputAddress2" placeholder="integer" name="pi" value="<?php echo $inx['product_id']; ?>">
            </div>
            <div class="form-group col-md-6">
                <label for="inputAddress2">Quantity</label>
                <input type="text" class="form-control" id="inputAddress2" placeholder="integer" name="q" value="<?php echo $inx['quantity']; ?>">
            </div>
        </div>
       
        <center><button type="submit" class="btn btn-primary btn-lg btn-block my-4" name="Ui">Update</button></center>
    </form>

</body>

</html>