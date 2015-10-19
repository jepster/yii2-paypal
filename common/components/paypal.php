<?php
/**
 * File Paypal.php.
 *
 * @author Marcio Camello <marciocamello@outlook.com>
 * @see https://github.com/paypal/rest-api-sdk-php/blob/master/sample/
 * @see https://developer.paypal.com/webapps/developer/applications/accounts
 */

namespace common\components;

use Yii;
use yii\base\ErrorException;
use yii\helpers\ArrayHelper;
use yii\base\Component;

use PayPal\Api\Address;
use PayPal\Api\CreditCard;
use PayPal\Api\Amount;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\Transaction;
use PayPal\Api\FundingInstrument;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\RedirectUrls;
use PayPal\Rest\ApiContext;



class paypal extends Component
{

    public function teszt($amount,$description)
    {
        $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                'AYSq3RDGsmBLJE-otTkBtM-jBRd1TCQwFf9RGfwddNXWz0uFU9ztymylOhRS',     // ClientID
                'EGnHDxD_qRPdaLdZz8iCr8N7_MzF-YHPTkjs6NKYQvQSBngp4PTTVWkPZRbL'      // ClientSecret
            )
        );

//SAMPLE 1
// $card = new CreditCard();
// $card->setType("visa")
//     ->setNumber("4148529247832259")
//     ->setExpireMonth("11")
//     ->setExpireYear("2019")
//     ->setCvv2("012")
//     ->setFirstName("Joe")
//     ->setLastName("Shopper");

// // ### FundingInstrument
// // A resource representing a Payer's funding instrument.
// // For direct credit card payments, set the CreditCard
// // field on this object.
// $fi = new FundingInstrument();
// $fi->setCreditCard($card);

// // ### Payer
// // A resource representing a Payer that funds a payment
// // For direct credit card payments, set payment method
// // to 'credit_card' and add an array of funding instruments.
// $payer = new Payer();
// $payer->setPaymentMethod("credit_card")
//     ->setFundingInstruments(array($fi));

// // ### Itemized information
// // (Optional) Lets you specify item wise
// // information
// $item1 = new Item();
// $item1->setName('Ground Coffee 40 oz')
//     ->setDescription('Ground Coffee 40 oz')
//     ->setCurrency('USD')
//     ->setQuantity(1)
//     ->setTax(0.3)
//     ->setPrice(7.50);
// $item2 = new Item();
// $item2->setName('Granola bars')
//     ->setDescription('Granola Bars with Peanuts')
//     ->setCurrency('USD')
//     ->setQuantity(5)
//     ->setTax(0.2)
//     ->setPrice(2);

// $itemList = new ItemList();
// $itemList->setItems(array($item1, $item2));

// // ### Additional payment details
// // Use this optional field to set additional
// // payment information such as tax, shipping
// // charges etc.
// $details = new Details();
// $details->setShipping(1.2)
//     ->setTax(1.3)
//     ->setSubtotal(17.5);

// // ### Amount
// // Lets you specify a payment amount.
// // You can also specify additional details
// // such as shipping, tax.
// $amount = new Amount();
// $amount->setCurrency("USD")
//     ->setTotal(20)
//     ->setDetails($details);

// // ### Transaction
// // A transaction defines the contract of a
// // payment - what is the payment for and who
// // is fulfilling it. 
// $transaction = new Transaction();
// $transaction->setAmount($amount)
//     ->setItemList($itemList)
//     ->setDescription("Payment description")
//     ->setInvoiceNumber(uniqid());

// // ### Payment
// // A Payment Resource; create one using
// // the above types and intent set to sale 'sale'
// $payment = new Payment();
// $payment->setIntent("sale")
//     ->setPayer($payer)
//     ->setTransactions(array($transaction));

// // For Sample Purposes Only.
// $request = clone $payment;

// // ### Create Payment
// // Create a payment by calling the payment->create() method
// // with a valid ApiContext (See bootstrap.php for more on `ApiContext`)
// // The return object contains the state.
// try {
//     $payment->create($apiContext);
// } catch (Exception $ex) {
//    // ResultPrinter::printError('Create Payment Using Credit Card. If 500 Exception, try creating a new Credit Card using <a href="https://ppmts.custhelp.com/app/answers/detail/a_id/750">Step 4, on this link</a>, and using it.', 'Payment', null, $request, $ex);
//     exit(1);
// }

//ResultPrinter::printResult('Create Payment Using Credit Card', 'Payment', $payment->getId(), $request, $payment);

//return $payment;

//END SAMPLE 1

//SAMPLE 2

        // $creditCard = new \PayPal\Api\CreditCard();
        // $creditCard->setType("visa")
        //     ->setNumber("4417119669820331")
        //     ->setExpireMonth("11")
        //     ->setExpireYear("2019")
        //     ->setCvv2("012")
        //     ->setFirstName("Joe")
        //     ->setLastName("Shopper");

        // try {
        //     $creditCard->create($apiContext);
        //     echo '<pre>';
        //     print_r($creditCard);
        // }
        // catch (\PayPal\Exception\PayPalConnectionException $ex) {
        //     echo $ex;
        // }

//END SAMPLE 2


//SAMPLE 3
$payer = new Payer();
$payer->setPaymentMethod("paypal");

// ### Itemized information
// (Optional) Lets you specify item wise
// information
$item1 = new Item();
$item1->setName('Ground Coffee 40 oz')
    ->setCurrency('USD')
    ->setQuantity(1)
    ->setPrice(7.5);
$item2 = new Item();
$item2->setName('Granola bars')
    ->setCurrency('USD')
    ->setQuantity(5)
    ->setPrice(2);

$itemList = new ItemList();
$itemList->setItems(array($item1, $item2));

// ### Additional payment details
// Use this optional field to set additional
// payment information such as tax, shipping
// charges etc.
$details = new Details();
$details->setShipping(1.2)
    ->setTax(1.3)
    ->setSubtotal(17.50);

// ### Amount
// Lets you specify a payment amount.
// You can also specify additional details
// such as shipping, tax.
$amount = new Amount();
$amount->setCurrency("USD")
    ->setTotal(20)
    ->setDetails($details);

// ### Transaction
// A transaction defines the contract of a
// payment - what is the payment for and who
// is fulfilling it. 
$transaction = new Transaction();
$transaction->setAmount($amount)
    ->setItemList($itemList)
    ->setDescription("Payment description")
    ->setInvoiceNumber(uniqid());

// ### Redirect urls
// Set the urls that the buyer must be redirected to after 
// payment approval/ cancellation.
//$baseUrl = getBaseUrl();
$redirectUrls = new RedirectUrls();
$redirectUrls->setReturnUrl("http://www.akarmi.ro/ExecutePayment.php?success=true")
    ->setCancelUrl("http://www.akarmi.ro/ExecutePayment.php?success=false");

// ### Payment
// A Payment Resource; create one using
// the above types and intent set to 'sale'
$payment = new Payment();
$payment->setIntent("sale")
    ->setPayer($payer)
    ->setRedirectUrls($redirectUrls)
    ->setTransactions(array($transaction));


// For Sample Purposes Only.
$request = clone $payment;

// ### Create Payment
// Create a payment by calling the 'create' method
// passing it a valid apiContext.
// (See bootstrap.php for more on `ApiContext`)
// The return object contains the state and the
// url to which the buyer must be redirected to
// for payment approval
try {
    $payment->create($apiContext);
} catch (Exception $ex) {
    ResultPrinter::printError("Created Payment Using PayPal. Please visit the URL to Approve.", "Payment", null, $request, $ex);
    exit(1);
}

// ### Get redirect url
// The API response provides the url that you must redirect
// the buyer to. Retrieve the url from the $payment->getApprovalLink()
// method
$approvalUrl = $payment->getApprovalLink();

// ResultPrinter::printResult("Created Payment Using PayPal. Please visit the URL to Approve.", "Payment", "<a href='$approvalUrl' >$approvalUrl</a>", $request, $payment);

return $payment;

//END SAMPLE 3
    }
  
}