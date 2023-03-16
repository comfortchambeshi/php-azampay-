<?php
//If request is not post the abort
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
   exit;
 }


include 'classes/db.php';
include 'classes/main.php';
include 'classes/mail.php';

$main = new main();


$payload = @file_get_contents('php://input');
$object = json_decode( $payload, TRUE );






//Query
$query = $main->all_query_nolimit_s('transactions', 'AND status="pending" LIMIT 1', 'reference', $object['utilityref']);



$status = 'rejected';
if($object['transactionstatus'] == "success")
{
    $status = "success";
}



if($query[0] > 0)
{
    foreach($query[1] as $row )
    {
        $dbEmail = $row['email'];
        $first_name = $row['first_name'];
    }


//Update status
    $update = $main->update_custom_o('transactions', 'status', $status, 'reference', $object['utilityref'], '');
    echo 'Updated successfully';
}else
{
    echo "Error processing!";
    exit();
}





