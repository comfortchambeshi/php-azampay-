<?php 


if (isset($_GET['txn'])) {
 
include '../classes/db.php';
include '../classes/main.php';
include '../classes/azampay.php';


//Call AzamPay


$main = new main();


$query = $main->all_query_nolimit_s('transactions', 'ORDER BY 1 DESC LIMIT 1', 'reference', $_GET['txn']);

if($query[0] > 0)
{
    foreach($query[1] as $row )
    {
        $status = $row['status'];
        
    }


}else
{
   
}


echo $status;

}