### Info
A test project for the bitpay laravel wrapper.

### Installation
Run composer install or follow installation and steps on a library [page](https://github.com/aimagician/bitpaymagic)
 
### Controllers
```
App\Http\Controllers\Bitpay
```

###Routes
```
Route::get( "bitpay/create-invoice", [ "uses" => "Bitpay\\CreateInvoiceController@createInvoice" ] );
Route::get( "bitpay/create-invoice-page", [ "uses" => "Bitpay\\CreateInvoiceController@createInvoicePage" ] );
```

###Views
```
\bitpay\invoice.blade.php
```

###Config
```
\config\bitpaymagic.php
```

###Keys
Bitpay keys are stored in storage/keys folder