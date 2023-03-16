<?php 

class azampay

{   //Options are sandbox and production
  private static $environment = "sandbox";
	private static $appName = "Witlevels";
	private static $clientId = "51bb0d77-c007-4eb4-b181-542b73c41124";
	private static $clientSecret = "HdwG9OzKv7G+IVxua2DjFZJoGj90Ii6RUcOYG+Z2gVyzZYXjtzle4+db6IXwcISvvODpXc8DoQPu6xN8qifWjuJ2qLblISihZ6QAzsqEe8VtQcT+jzg4aPW14sM1RQai/l1FUzj1sMy569QNaYltKxILT32k/As5IX8oVNH+tVC6Ll2s/XSj6Db9vTQMJavo+eWOc1Aeb9etne2lJTDXm23HzAxWek+U2Jg/o1H0kGO/l3KEG2D7hJ9A3wp2QAoUm/2mlYIRA+CKa+ADN6QAsxZScrV7Wwfg66DnpG2BQpgDa7nIWI75mSEFRlaBq3OqQPSbEo9HROuleU8TwTHMF1btciVNYv3AchNZggcmS9jPuFzF9h68oU7hZwH1/sVEOYc6IyBrX2hNm55iVOFK3Dne3S9z1erZVfrlSffDXoaD4jNCdaqBV/ObkSrsEWmThQqVWrwib6nI7r4z/ruCEgy+rL51COiTUpdqncIk2GbNx6uj07lZdHqKLry3EocGAX+hq4VVoWovKHiiuwEfBUOQachBt4RtmqvArUmxhwHSCnUoE+nTYT63XHlwFFxp7gfcashgVmKd4SbK734LxaKY6jbfXN5haHLExmsuCEY0NXPhYWXOXqttZgTJTLKhznJnktzhgHzLbE1kZokbf9YfUCJ4rWsryvni2ORcWPU=";

	//Environment URLS
	public static function envUrls()
	{
		$auth_url = "https://authenticator-sandbox.azampay.co.tz";
		$checkout_url = "https://sandbox.azampay.co.tz";
        
        //Base URLs for production
		if (azampay::$environment == "production") {
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
              "appName": "'.azampay::$appName.'",
              "clientId": "'.azampay::$clientId.'",
              "clientSecret": "'.azampay::$clientSecret.'"
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
                CURLOPT_URL => ''.azampay::envUrls()["checkout_url"].'/azampay/mno/checkout',
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
                  'Authorization: Bearer '.azampay::authtoken()->data->accessToken.'',
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

