# Welcome to Wit Azampay PHP SDK
This script covers everything required to collect payments using your Azampay APIS. 
Azampay involves two aspects, one for pushing a payment request and the other one for receiving callback of the transaction status.
This script has /inc/submit.inc.php file which pushes the request when submitted and /azampay_callback.php which receives the callbacks of the transaction from Azampay.

For this script, we have used a database file named database.sql which has only a transactions table. This will be used to compare transactions from the transactions that are received from the callbacks. So let's get started.

### Step 1:
- Configure your database from /classes/db.php and then import the database.sql file from the root folder /
```
<?php

class db{

private $dbname = "azampay";
private $dbhost = "localhost";
private $dbuser = "root";
private $dbpwd = "";

protected function connect(){

$dsn = 'mysql:host='.$this->dbhost.';dbname='.$this->dbname.'';
$pdo = new PDO($dsn, $this->dbuser, $this->dbpwd);

$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
return $pdo;

}




}


?>
```


### Step 2:
- Setup your Azampay application environment, client id and client secrete from /classes/azampay.php 
 ```
  //Options are sandbox and production
  private static $environment = "sandbox";
	private static $appName = "App_name";
	private static $clientId = "client_id";
	private static $clientSecret = "client_secrete_here";
  ```
  Note: On the environment values there are only two possible options(sanbox and production)
  
  
#### After completing the above steps then you are ready to test for Azampay
