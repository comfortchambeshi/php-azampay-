<?php 

class azampay

{   //Options are sandbox and production
  private static $environment = "sandbox";
	private static $appName = "Witlevels";
	private static $clientId = "51bb0d77-c007-4eb4-b181-542b73c41124";
	private static $clientSecret = "IJtnxdiR5qN91qZVoJh46/R4DdV+p/A6L76uphFWnbwIEUvoKYpQNy7aobH6T05jQJX48GDAo16uPbEfequaugCp+w1fXyMMINxaiMNwmM0v1n0pWiqkjD+doW+UzSGyGB+42PnT2pnK743xXCBb8loCMJuqZtYtC0nbiGN1zW+1Fhh8Y+Q+g8j4Uh9tPfDUz12eqjo4TLtd2Xnc6FnonvsgQpDOEBpVPhoX3htY3Ijj/3E/87YPNPDEhA4ZE4aMWPxiwwzqyq5eRjitfut5C2mbQnSIfa2mvHat2j2G4ljZ2pOClIrW5G/1/0dZc/QHUFLceanrPBuHsox+cq8CcPflZxWg8pPWuqCqM6OhujJ8AIQqs8hyV20tB0Y8N5RQXIT1h1CgwpA1HF55NyCq3C1zYKamLNWtvehHsdLlCAMP0M8v9nZrRi/Q/Y4/RdFYJOzKb9K2Sx3wG5Ocgcjb+FRLcLHuQ1QIh5Ec3OHzfi4coPuGz0qeNfxABV3tkglBxZLvrtXJKZsZpZql5mL7InZprxNY9Zp4my8qvvtTOP2ILxFdWl33nmaXm5RZfsAatABKjdV9XhHhj0GiZi/5Q11hgUbmk1w/YiS+EB+Tz8eASjkxL9rAcNoVBIM8G+KnOj/ptqEL/doijJZ885HL4YUGutIfHU8PtrBmf47qkSk=";

	//Environment URLS
	public static function envUrls()
	{
		$auth_url = "https://authenticator-sandbox.azampay.co.tz";
		$checkout_url = "https://sandbox.azampay.co.tz";
        
        //Base URLs for production
		if (AzamPay::$environment == "production") {
			$auth_url = "https://authenticator.azampay.co.tz";
		    $checkout_url = "https://checkout.azampay.co.tz";
			
		}

		return ["auth_url"=>$auth_url, "checkout_url"=>$checkout_url ];

	}
	//Authorisation token
	public static function authtoken()
	{


            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => 'https://authenticator-sandbox.azampay.co.tz/AppRegistration/GenerateToken',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'POST',
              CURLOPT_POSTFIELDS =>'{
              "appName": "'.AzamPay::$appName.'",
              "clientId": "'.AzamPay::$clientId.'",
              "clientSecret": "'.AzamPay::$clientSecret.'"
              }',
                CURLOPT_HTTPHEADER => array(
                  'Content-Type: application/json'
                ),
              ));

              $response = curl_exec($curl);
              $result = json_decode($response);

              curl_close($curl);
              return $result;

	}

	//MNO checkout
	public static function mnocheckout($accountNumber, $amount,  $currency,$provider)
	{         //UUID ID generator
             $externalId = vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex(random_bytes(16)), 4));
		      $curl = curl_init();
              curl_setopt_array($curl, array(
                CURLOPT_URL => ''.AzamPay::envUrls()["checkout_url"].'/azampay/mno/checkout',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS =>'{
                "accountNumber": "'.$accountNumber.'",
                "additionalProperties": {
                  "property1": 878346737777,
                  "property2": 878346737777
                },
                "amount": "'.$amount.'",
                "currency": "'.$currency.'",
                "externalId": "'.$externalId.'",
                "provider": "'.$provider.'"
              }',
                CURLOPT_HTTPHEADER => array(
                  'Authorization: Bearer '.AzamPay::authtoken()->data->accessToken.'',
                  'Content-Type: application/json'
                ),
              ));

              $response = curl_exec($curl);
              $result = json_decode($response);
              curl_close($curl);
              
              //Return checkout link or json data
               return array($result, $externalId);
        }
	}
