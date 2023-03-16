<?php 


if ($_GET['status'] == 'approved') {
   
    echo '<h1>Your transaction was approved</h1>';
}else
{
    echo '<h1>Transaction failed!</h4>';
}