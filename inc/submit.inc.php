<?php 


if (isset($_POST['donate_btn'])) {
include '../classes/db.php';
include '../classes/main.php';
include '../classes/azampay.php';


//Call AzamPay

$azampay = new azampay();
$main = new main();






  //Form data
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $email = $_POST['email'];
  $amount = $_POST['amount'];
  $payment_method = $_POST['payment_method'];
  $acc_id = $_POST['acc_id'];

  $display = "";
  if ($payment_method == "Airtel" || $payment_method == "Tigo" || $payment_method == "Halopesa") {

    //Choose from these providers for MNO "Airtel" "Tigo" "Halopesa" "Azampesa"
  $pay = $azampay->mnocheckout($acc_id,  $amount, 'TZS', $payment_method);

  //Display
  $display =  $pay[0]->message;

      //Insert transaction into table
    $insert = $main->insertTransaction($first_name, $last_name, 'Product title here', $amount, "TZS", $pay[1], $pay[1], $payment_method, $email);
    //header("Location: ".$pay[0]->paymentUrl."");
  }


  
 
  

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:300,400,500">
     <title>Payment submit</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway+Dots">
    <link rel="stylesheet" href="../assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="../assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="../assets/css/Footer-Clean.css">
    <link rel="stylesheet" href="../assets/css/Highlight-Blue.css">
    <link rel="stylesheet" href="../assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="../assets/css/Navigation-Clean.css">
    <link rel="stylesheet" href="../assets/css/News-article-for-homepage-by-Ikbendiederiknl.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>

<body>

      <div class="news-block" style="padding-top: 0px;">
        <section class="login-clean">
            <form  action="inc/submit.inc.php" method="post" style="max-width: 100%;">
              <h3 class="text-center"><?php echo $display;?></h3>
            </form></section></div>




