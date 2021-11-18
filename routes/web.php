<?php

use App\Http\Controllers\CacheStoreController;
use App\Http\Controllers\DataExportContoller;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\StudentController;
use App\Mail\MyTestMail;
use App\Mail\MyTestMailSecond;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use  Jenssegers\Agent\Agent;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\DropdownController;
/*
|--------------------------------------------------------------------------
| Web Routes
|----------------------------------\----------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('stripe', [StripePaymentController::class, 'stripe']);
Route::post('stripe', [StripePaymentController::class, 'stripePost'])->name('stripe.post');

Route::get('localization', [LocalizationController::class, 'index']);
Route::get('localization/change/lang', [LocalizationController::class, 'lang_change'])->name('LangChange');

Route::get('/', [StudentController::class, 'index']);
Route::get('/students/getStudents/', [StudentController::class, 'getStudents'])->name('students.getStudents');

//Web push notification web-api
Route::get('/notification', [NotificationController::class, 'index'])->name('notification.home');
Route::get('/save-token', [NotificationController::class, 'saveToken'])->name('notification.save-token');
Route::get('/send-notification', [NotificationController::class, 'sendNotification'])->name('notification.send');

//send mail using gmail smtp server api
Route::get('send/mail', function () {
    $details = [
        'title' => 'Mail From Jakhongir 😅',
        'body' => 'Test mail sent by using SMTP'
    ];
    Mail::to('bahodirovjahongirxoja@gmail.com')->send(new MyTestMailSecond($details));
    dd('Email is Send , please check your inbox');
});

Route::get('users', [UserController::class, 'index'])->name('users.index');

Route::post('/send-notification/ios', [NotificationController::class, 'sendIos'])->name('notification.ios');

// Route::resource('products', ProductController::class);

// Route::get('/products/{id}', [ProductController::class, 'show'])->where('id', '[0+9]+');


//recaptcha google
Route::get('recaptcha/register', [RegisterController::class, 'index']);
Route::post('recaptcha/register', [RegisterController::class, 'store']);

Route::get('cache/customers', [CacheStoreController::class, 'storeCustomers']);

//detect-connected-device-in-your-app
Route::get('detect-device', function () {
    //object
    $agent = new Agent();

    //laptop/desktop
    $isDesktop = $agent->isDesktop();

    //Detect Tablet
    $isTablet = $agent->isTablet();

    //Mobile
    $isMobile = $agent->isMobile();

    //Detect OS 
    $isWindows = $agent->is('Windows');

    $platform = $agent->platform();

    $version = $agent->version($platform);

    $languages = $agent->languages();

    return response()->json(
        [
            'data' => [
                'isMobile' => $isMobile,
                'isDesktop' => $isDesktop,
                'isTablet' => $isTablet,
                'isWindwos' => $isWindows,
                'device' => $agent->device(),
                'platform' => $platform,
                'version' => $version,
                'languages' => $languages,
                'browser' => $agent->browser(),
                'entered-from-web-browser' => [
                    'isGoogle' => $agent->isChrome(),
                    'isSafari' => $agent->isSafari(),
                    'isFirefox' => $agent->is('Firefox')
                ],
            ]
        ],
        200
    );
});



//Create Custom Log File
Route::get('create-log', function () {
    // Log::channel('my-custom-log')->info('This is info log level for testing');
    // Log::channel('my-custom-log')->warning('This is warning log level for testing');
    // Log::channel('my-custom-log')->error('This is error log level for testing');
    // Log::channel('my-custom-log')->alert('This is alert log level for testing');
    // Log::channel('my-custom-log')->emergency('This is emergency log level for testing');
    // Log::channel('my-custom-log')->notice('This is notice log level for testing');

    Log::emergency("message");
    Log::alert("message");
    Log::critical("message");
    Log::notice("message");
    Log::alert("message");
    Log::warning("message");

    return response()->json([
        'status' => true,
        'message' => 'your custom logs have been written successfully , you can see your logs in storage/logs/your-log-file-name.log folder'
    ], 200);
});


//excel exports routes

Route::get('excel/export', [DataExportContoller::class, 'export']);


//Dynamic searching using Ajax

Route::get('dropdown', [DropdownController::class, 'index']);
Route::get('getState', [DropdownController::class, 'getState'])->name('getState');
Route::get('getCity', [DropdownController::class, 'getCity'])->name('getCity');


//Notification api's
Route::get('/send-notification', [NotificationController::class, 'sendOfferNotification']);
