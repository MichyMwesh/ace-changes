<?php
if(isset($_POST['submit'])){
// INCLUDE THE ACCESS TOKEN FILE
include 'accessToken.php';
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'geeks');

  $db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Ensure this file includes your database connection details

// CONSTANTS
$processrequestUrl = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
$callbackurl = 'https://eminently-rare-pegasus.ngrok-free.app/Ace-cleaners/cleaning-services-website/darajaapi/clbk.php'; // Replace with your actual callback URL
$passkey = "bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919";
$BusinessShortCode = '174379';
$phone = $_POST['phone']; // phone number to receive the stk push
$money = $_POST['amount']; 
$orderid=$_POST['orderid'];
$PartyA = $phone;
$PartyB = '254708374149';
$AccountReference = 'UMESKIA SOFTWARES';
$TransactionDesc = 'stkpush test';
$Amount =1000;
// TIMESTAMP
$Timestamp = date('YmdHis');
date_default_timezone_set('Africa/Nairobi');

// ENCRYPT DATA TO GET PASSWORD
$Password = base64_encode($BusinessShortCode . $passkey . $Timestamp);

// INITIATE CURL
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $processrequestUrl);
curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type:application/json', 'Authorization:Bearer ' . $access_token]);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode([
    'BusinessShortCode' => $BusinessShortCode,
    'Password' => $Password,
    'Timestamp' => $Timestamp,
    'TransactionType' => 'CustomerPayBillOnline',
    'Amount' => 1,
    'PartyA' => $PartyA,
    'PartyB' => $BusinessShortCode,
    'PhoneNumber' => $PartyA,
    'CallBackURL' => $callbackurl,
    'AccountReference' => $AccountReference,
    'TransactionDesc' => $TransactionDesc,
]));

// EXECUTE CURL REQUEST
$curl_response = curl_exec($curl);

// HANDLE RESPONSE
$data = json_decode($curl_response);
$CheckoutRequestID = $data->CheckoutRequestID;
$ResponseCode = $data->ResponseCode;

// ECHO RESPONSE
if ($ResponseCode == "0") {
    $sql="update cart set status='confirmed' where id=$orderid";
    $query=mysqli_query($db,$sql);
    if(!$query)
    {
        echo mysqli_error($db);
    }
    ?>
    <script>
        alert("Submitted for progressing...");
        location.replace("mail.php")
    </script>
    <?php
} else {
    echo "Error: " . $ResponseCode . " - " . $data->errorMessage;
}

// CLOSE CURL
curl_close($curl);
}
?>
