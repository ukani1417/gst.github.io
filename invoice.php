<?php session_start();
if (empty($_SESSION['id'])) :
    header('Location:login.php');
endif;
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" href="navbar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Invoice</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="home.php">Goods And Services Tax</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="credit leadger.php">Credit Leadger</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="invoice.php">Invoice</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="return.php">Returns</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="product.php">Product</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="profile.php">Profile</a>
                </li>
            </ul>
            <ul>

            <a href="login.php" class="btn btn-primary btn-lg btn-block my-4">
                    <span class="glyphicon glyphicon-log-out"></span> Log out
                </a>
            </ul>
        </div>
    </nav>
    

                            <table class="table" style="font-size: 20px;">
                                <thead>
                                    <tr>
                                        <th scope="col">Invoice Number</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Buyer GSTIN</th>
                                        <th scope="col">Supplier GSTIN</th>
                                        <th scope="col">Place Of Supply</th>
                                        <th scope="col">Supplier State</th>
                                        <th scope="col">Product Id</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Tax Amount</th>
                                        <th scope="col">Total Amount</th>
                                        <th>#OPERATION</div></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    include('database connection.php');
                                    $query = pg_query($con, "select * from invoice where supplier_gstin='$_SESSION[username]'");

                                    while ($inx = pg_fetch_assoc($query)) {
                                    ?>
                                        <tr>
                                            <td> <?php echo $inx['invoice_no']; ?> </td>
                                            <td><?php echo $inx['date']; ?></td>
                                            <td><?php echo $inx['buyer_gstin']; ?></td>
                                            <td><?php echo $inx['supplier_gstin']; ?></td>
                                            <td><?php echo $inx['place_of_supply']; ?></td>
                                            <td><?php echo $inx['supplier_state']; ?></td>
                                            <td><?php echo $inx['product_id']; ?></td>
                                            <td><?php echo $inx['quantity']; ?></td>
                                            <td><?php echo $inx['tax_amount']; ?></td>
                                            <td><?php echo $inx['total_amount']; ?></td>
                                            <td><a href="update_invoice.php?id=<?php echo $inx['invoice_no'];?>" data-toggle="tootltip" data-placement="top" title = "UPDATE" ><i class="fa fa-edit" aria-hidden="true" style="font-size:45px;color:green;my "></i></a>
                                            <a href="delete_invoice.php?id=<?php echo $inx['invoice_no'];?>" data-toggle="tootltip" data-placement="top" title = DELETE> <i class="fa fa-trash" aria-hidden="true"  style="font-size:40px;color:red"></i></a></td>
    
                                        </tr>
                                    <?php
                                    }
                                    ?>


                                </tbody>
                            </table>
                      
                    <center><a href="insertin.php" data-toggle="tootltip" data-placement="top" title = "Add Invoice" ><i class="fa fa-plus" aria-hidden="true" style="font-size: 45px;"></i></a></center>

                

    



</body>

</html>