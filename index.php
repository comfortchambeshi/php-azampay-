<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:300,400,500">
     <title>Payment form</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway+Dots">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/Footer-Clean.css">
    <link rel="stylesheet" href="assets/css/Highlight-Blue.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Navigation-Clean.css">
    <link rel="stylesheet" href="assets/css/News-article-for-homepage-by-Ikbendiederiknl.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>

    <section class="highlight-blue" style="background: rgb(58,70,86);">
        <div class="container">
            <div class="intro">
                <h2 class="text-center">Payment form</h2>
            </div>
        </div>
    </section>
    <div class="news-block" style="padding-top: 0px;">
        <section class="login-clean">
            <form action="inc/submit.inc.php" method="post" style="max-width: 100%;">
                <input required="" type="text" class="form-control" name="first_name" placeholder="First name">
                <br>
                <input required="" type="text" class="form-control" name="last_name" placeholder="Last name">
                <br>
                <input required="" type="text" class="form-control" name="email" placeholder="Email address">
               <br>
             
              
              <select name="payment_method" class="form-control" required>
                    <option value="">Select payment method</option>
                    <option value="Airtel">Airtel</option>
                    <option value="Tigo">Tigo</option>
                    <option value="Halopesa">Halopesa</option>
                </select>
                <br>
                <input required="" type="number" class="form-control" name="amount" placeholder="Amount">

                 <br>
                <input required="" type="text" class="form-control" name="acc_id" placeholder="Account number">
                 <br>
                
                <button class="btn btn-primary" type="submit" name="donate_btn">PAY NOW</button>


            </form>
        </section>
    </div>
