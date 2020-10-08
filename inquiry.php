public function tesduitkusandbox(){
		$merchantCode = 'D6593'; // from duitku
	    $merchantKey = '2a5327e7c0ce13e7c60ba29fd92c288e'; // from duitku
	    $paymentAmount = 15000;
	    $paymentMethod = 'BK'; // VC = Credit Card
	    $merchantOrderId = 'TR.149.20201002.0031'; // from merchant, unique
	    $productDetails = 'Test Pay with duitku sandbox';
	    $email = 'bayunuriman14@gmail.com'; // your customer email
	    $phoneNumber = '087830977862'; // your customer phone number (optional)
	    $additionalParam = ''; // optional
	    $merchantUserInfo = ''; // optional
	    $customerVaName = 'Yoga'; // display name on bank confirmation display
	    $callbackUrl = 'https://soco.magicalladin.com/process'; // url for callback
	    $returnUrl = 'https://soco.magicalladin.com/return'; // url for redirect
	    $expiryPeriod = 60; // set the expired time in minutes
	    $signature = md5($merchantCode . $merchantOrderId . $paymentAmount . $merchantKey);

	    // Customer Detail
	    $firstName = "John";
	    $lastName = "Doe";

	    // Address
	    $alamat = "Jl. Bentengan Mas";
	    $city = "Jakarta";
	    $postalCode = "14350";
	    $countryCode = "ID";

	    $address = array(
	        'firstName' => $firstName,
	        'lastName' => $lastName,
	        'address' => $alamat,
	        'city' => $city,
	        'postalCode' => $postalCode,
	        'phone' => $phoneNumber,
	        'countryCode' => $countryCode
	    );

	    $customerDetail = array(
	        'firstName' => $firstName,
	        'lastName' => $lastName,
	        'email' => $email,
	        'phoneNumber' => $phoneNumber,
	        'billingAddress' => $address,
	        'shippingAddress' => $address
	    );


	    $item1 = array(
	        'name' => 'Test Item 1',
	        'price' => 5000,
	        'quantity' => 1);

	    $item2 = array(
	        'name' => 'Test Item 2',
	        'price' => 10000,
	        'quantity' => 2);

	    $itemDetails = array(
	        $item1, $item2
	    );

	    $params = array(
	        'merchantCode' => $merchantCode,
	        'paymentAmount' => $paymentAmount,
	        'paymentMethod' => $paymentMethod,
	        'merchantOrderId' => $merchantOrderId,
	        'productDetails' => $productDetails,
	        'additionalParam' => $additionalParam,
	        'merchantUserInfo' => $merchantUserInfo,
	        'customerVaName' => $customerVaName,
	        'email' => $email,
	        'phoneNumber' => $phoneNumber,
	        'itemDetails' => $itemDetails,
	        'customerDetail' => $customerDetail,
	        'callbackUrl' => $callbackUrl,
	        'returnUrl' => $returnUrl,
	        'signature' => $signature,
	        'expiryPeriod' => $expiryPeriod

	    );

	    $params_string = json_encode($params);
	    //echo $params_string;
	    $url = 'https://sandbox.duitku.com/webapi/api/merchant/v2/inquiry'; // Sandbox
	    // $url = 'https://passport.duitku.com/webapi/api/merchant/v2/inquiry'; // Production
	    $ch = curl_init();

	    curl_setopt($ch, CURLOPT_URL, $url); 
	    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $params_string);                                                                  
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
	    curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
	        'Content-Type: application/json',                                                                                
	        'Content-Length: ' . strlen($params_string))                                                                       
	    );   
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

	    //execute post
	    $request = curl_exec($ch);
	    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

	    if($httpCode == 200)
	    {
	        $result = json_decode($request, true);
	        //header('location: '. $result['paymentUrl']);
	        echo "paymentUrl :". $result['paymentUrl'] . "<br />";
	        echo "merchantCode :". $result['merchantCode'] . "<br />";
	        echo "reference :". $result['reference'] . "<br />";
	        echo "amount :". $result['amount'] . "<br />";
	        echo "vaNumber :". $result['vaNumber'] . "<br />";
	        echo "statusCode :". $result['statusCode'] . "<br />";
	        echo "statusMessage :". $result['statusMessage'] . "<br />";
	    }
	    else{
	        echo $httpCode;
	    }
	}
