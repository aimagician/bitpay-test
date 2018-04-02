<?php namespace App\Http\Controllers\Bitpay;

use Aimagician\Bitpaymagic\Traits\BitpaymagicTrait;
use App\Http\Controllers\Controller;
use Bitpay\Buyer;
use Bitpay\Currency;
use Bitpay\Invoice;
use Bitpay\Item;
use Exception;
use View;

class CreateInvoiceController extends Controller {
	use BitpaymagicTrait;

	public function __construct() {
	}

	public function createInvoice() {

		$client = $this->initBitpaymagicClient();

		$invoice = new Invoice();
		$buyer   = new Buyer();
		$buyer->setEmail( 'buyeremail@test.com' );
		// Add the buyers info to invoice
		$invoice->setBuyer( $buyer );
		/**
		 * Item is used to keep track of a few things
		 */
		$item = new Item();
		$item->setCode( 'skuNumber' )
		     ->setDescription( 'General Description of Item' )
		     ->setPrice( '1.99' );
		$invoice->setItem( $item );
		/**
		 * BitPay supports multiple different currencies. Most shopping cart applications
		 * and applications in general have defined set of currencies that can be used.
		 * Setting this to one of the supported currencies will create an invoice using
		 * the exchange rate for that currency.
		 *
		 * @see https://test.bitpay.com/bitcoin-exchange-rates for supported currencies
		 */
		$invoice->setCurrency( new Currency( 'USD' ) );
		// Configure the rest of the invoice
		$invoice->setOrderId( 'OrderIdFromYourSystem' )
			// You will receive IPN's at this URL, should be HTTPS for security purposes!
			    ->setNotificationUrl( 'https://store.example.com/bitpay/callback' );
		/**
		 * Updates invoice with new information such as the invoice id and the URL where
		 * a customer can view the invoice.
		 */
		try {
			echo "Creating invoice at BitPay now.<br />";
			$client->createInvoice( $invoice );
		} catch ( Exception $e ) {
			echo "Exception occurred: " . $e->getMessage() . "<br />";
			$request  = $client->getRequest();
			$response = $client->getResponse();
			echo (string) $request . "<br />";
			echo (string) $response . "<br />";
			dd( "Exiting" );
		}
		echo 'Invoice "' . $invoice->getId() . '" created, see ' . $invoice->getUrl() . "<br />";
		echo "Verbose details.<br />";
		dd( $invoice );
	}


	public function createInvoicePage() {

		$client = $this->initBitpaymagicClient();

		$invoice    = new Invoice();
		$buyer      = new Buyer();
		$buyerEmail = "buyeremail@test.com";
		$buyer->setEmail( $buyerEmail );
		// Add the buyers info to invoice
		$invoice->setBuyer( $buyer );
		/**
		 * Item is used to keep track of a few things
		 */
		$item = new Item();
		$item->setCode( 'HelloSKU#123' )
		     ->setDescription( 'General Description of Item' )
		     ->setPrice( '1.99' );
		$invoice->setItem( $item );

		/**
		 * BitPay supports multiple different currencies. Most shopping cart applications
		 * and applications in general have defined set of currencies that can be used.
		 * Setting this to one of the supported currencies will create an invoice using
		 * the exchange rate for that currency.
		 *
		 * @see https://test.bitpay.com/bitcoin-exchange-rates for supported currencies
		 */
		$invoice->setCurrency( new Currency( 'USD' ) );
		// Configure the rest of the invoice
		$invoice->setOrderId( 'OrderIdFromYourSystem' )
			// You will receive IPN's at this URL, should be HTTPS for security purposes!
			    ->setNotificationUrl( 'https://store.example.com/bitpay/callback' );
		/**
		 * Updates invoice with new information such as the invoice id and the URL where
		 * a customer can view the invoice.
		 */

		try {
			$client->createInvoice( $invoice );
		} catch ( Exception $e ) {
			echo "Exception occurred: " . $e->getMessage() . "<br />";
			$request  = $client->getRequest();
			$response = $client->getResponse();
			echo (string) $request . "<br />";
			echo (string) $response . "<br />";
			dd( "Exiting" );
		}

		$data["invoice"] = $invoice;

		return View::make( "bitpay.invoice", $data );
	}
}
