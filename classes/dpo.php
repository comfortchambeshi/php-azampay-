<?php

class dpoPay
{
    private static $endpoint_url = "https://secure.3gdirectpay.com/API/v6/";

    private static $CompanyToken = "8D3DA73D-9D7F-4E09-96D4-3D44E7A83EA3";

    //Create a DPO token
    public  static function CreateChargeToken($RedirectURL, $BackURL, $ServiceDescription, $PaymentAmount, $PaymentCurrency)



    {
        $ServiceDate = date('Y-m-d H:i:s');
        $endpoint = dpoPay::$endpoint_url;
        $xmlData = "<?xml version=\"1.0\" encoding=\"utf-8\"?><API3G><CompanyToken>".dpoPay::$CompanyToken."</CompanyToken><Request>createToken</Request><Transaction><PaymentAmount>".$PaymentAmount."</PaymentAmount><PaymentCurrency>USD</PaymentCurrency><CompanyRef>49FKEOA</CompanyRef><RedirectURL>".$RedirectURL."</RedirectURL><BackURL>".$BackURL."</BackURL><CompanyRefUnique>0</CompanyRefUnique><PTL>5</PTL></Transaction><Services><Service><ServiceType>5525</ServiceType><ServiceDescription>".$ServiceDescription."</ServiceDescription><ServiceDate>".$ServiceDate."</ServiceDate></Service></Services></API3G>";

        $ch = curl_init();

        if (!$ch) {
            die("Couldn't initialize a cURL handle");
        }
        curl_setopt($ch, CURLOPT_URL, $endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlData);

        $result = curl_exec($ch);

        

        curl_close($ch);

        // Parse the XML response using SimpleXML 
       $response = simplexml_load_string($result);

        return $response;
    }

    //Charge with credit card(chargeTokenCreditCard)

    public  static function chargeTokenCreditCard($CreditCardNumber, $CreditCardExpiry, $CreditCardCVV, $CardHolderName, $amount, $PaymentCurrency)



    {

        //Generate a transaction token
        $transToken = dpoPay::CreateChargeToken("https://webhook.site/c2b49c9c-c70f-4408-a5ee-2b95abcf97dc", "https://webhook.site/c2b49c9c-c70f-4408-a5ee-2b95abcf97dc", "Pay product", $amount, $PaymentCurrency);
        if ($transToken->Result == 000) {
            $ServiceDate = date('Y-m-d H:i:s');
            $endpoint = dpoPay::$endpoint_url;
            $xmlData = '<?xml version="1.0" encoding="utf-8"?> <API3G> <CompanyToken>'.dpoPay::$CompanyToken.'</CompanyToken> <Request>chargeTokenCreditCard</Request> <TransactionToken>'.$transToken->TransToken.'</TransactionToken> <CreditCardNumber>'.$CreditCardNumber.'</CreditCardNumber> <CreditCardExpiry>'.$CreditCardExpiry.'</CreditCardExpiry> <CreditCardCVV>'.$CreditCardCVV.'</CreditCardCVV> <CardHolderName>'.$CardHolderName.'</CardHolderName> <ChargeType></ChargeType> <ThreeD> <Enrolled>Y</Enrolled> <Paresstatus>Y</Paresstatus> <Eci>05</Eci> <Xid>DYYVcrwnujRMnHDy1wlP1Ggz8w0=</Xid> <Cavv>mHyn+7YFi1EUAREAAAAvNUe6Hv8=</Cavv> <Signature>_</Signature> <Veres>AUTHENTICATION_SUCCESSFUL</Veres> <Pares>eAHNV1mzokgW/isVPY9GFSCL0EEZkeyg7</Pares> </ThreeD> </API3G>';

            $ch = curl_init();

            if (!$ch) {
                die("Couldn't initialize a cURL handle");
            }
            curl_setopt($ch, CURLOPT_URL, $endpoint);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 60);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml'));
            curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlData);

            $result = curl_exec($ch);

            

            curl_close($ch);

            // Parse the XML response using SimpleXML 
           $response = simplexml_load_string($result);
           if ($response->Code != 000) 
           {
            echo '<h1>Error, there was a problem fetching from our provider. Kndly try again after some seconds!</h1>';

           }
           return $response;

            
         }else
         {
            echo "Error, can not create Transaction token. Result: <b>".$transToken->ResultExplanation."</b>";
            exit();
         } 

        
    }
      
       


}




