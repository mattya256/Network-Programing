<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/index', function () {
    return view('index');
});
Route::post('/index', function () {
    return view('index');
});

////////////////////////////////////////////////////////////
// Sample: SQL Injection
Route::get('/sql/injection', function () {
    return view('sql/injection');
});
Route::post('/sql/injection', 'SQLController@injectionMySQLi');
// Route::post('/sql/injection', 'SQLController@noInjectionMySQLi');
// Route::post('/sql/injection', 'SQLController@injectionPDO');
// Route::post('/sql/injection', 'SQLController@noInjectionPDO');
// Route::post('/sql/injection', 'SQLController@injectionLaravelQueryBuilder');
// Route::post('/sql/injection', 'SQLController@noInjectionLaravelQueryBuilder');

////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////
// Sample: PHP Function for DB Search
Route::get('/sql/search_win', function () {
    return view('sql/search_win');
});
Route::post('/sql/search_win_results', 'SQLController@searchWinResults');
////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////
// World Cup Database Search, CGI Version.

// parameters via URL
Route::get('/ui/tournaments/{id?}', 'WCController@showTournaments');
Route::get('/ui/results/{tournament_id}', 'WCController@showResults');

// parameters via Form (POST)
Route::get('/ui/search', 'WCController@search');
Route::post('/ui/search_results', 'WCController@searchResults');
////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////
// Sample: VueJS
Route::get('/vuejs/hello_vuejs', function () {
    return view('vuejs/hello_vuejs', [
        'message' => "Hello VueJS!! from Server",
        'select_data' => [
            ['value' => "1", 'text' => "A"],
            ['value' => "2", 'text' => "B"],
            ['value' => "3", 'text' => "C"],
            ['value' => "4", 'text' => "D"],
            ['value' => "5", 'text' => "E"]
        ]
    ]);
});
////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////
// Sample: AJAX
Route::get('/ajax/hello_ajax', function () {
    return view('ajax/hello_ajax');
});
Route::get('/ajax/hello_ajax_message', function () {
    $data = [
        "message1" => "Welcome to Fantastic AJAX World!!",
        "message2" => "async/await is latest way for AJAX handling."
    ];
    return json_encode($data);
});
Route::post('/ajax/hello_ajax_message', function () {
    $data = [
        "message1" => "Welcome to Fantastic AJAX World!!",
        "message2" => "async/await is latest way for AJAX handling."
    ];
    return json_encode($data);
});
////////////////////////////////////////////////////////////

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

////////////////////////////////////////////////////////////
// Sample: SQL Injection
Route::get('/sql/injection', function () {
    return view('sql/injection');
});
Route::post('/sql/injection', 'SQLController@injectionMySQLi');
// Route::post('/sql/injection', 'SQLController@noInjectionMySQLi');
// Route::post('/sql/injection', 'SQLController@injectionPDO');
// Route::post('/sql/injection', 'SQLController@noInjectionPDO');
// Route::post('/sql/injection', 'SQLController@injectionLaravelQueryBuilder');
// Route::post('/sql/injection', 'SQLController@noInjectionLaravelQueryBuilder');

////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////
// Sample: PHP Function for DB Search
Route::get('/sql/search_win', function () {
    return view('sql/search_win');
});
Route::post('/sql/search_win_results', 'SQLController@searchWinResults');
////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////
// World Cup Database Search, CGI Version.

// parameters via URL
Route::get('/ui/tournaments/{id?}', 'WCController@showTournaments');
Route::get('/ui/results/{tournament_id}', 'WCController@showResults');

// parameters via Form (POST)
Route::get('/ui/search', 'WCController@search');
Route::post('/ui/search_results', 'WCController@searchResults');
////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////
// Sample: VueJS
Route::get('/vuejs/hello_vuejs', function () {
    return view('vuejs/hello_vuejs', [
        'message' => "Hello2 VueJS!! from Server",
        'select_data' => [
            ['value' => "1", 'text' => "A"],
            ['value' => "2", 'text' => "B"],
            ['value' => "3", 'text' => "C"],
            ['value' => "4", 'text' => "D"],
            ['value' => "5", 'text' => "E"]
        ]
    ]);
});
Route::get('/vuejs/wc_vuejs', function () {
    return view('vuejs/wc_vuejs', [
        'message' => "Hello VueJS!! from Server",
        'select_data' => [
            ['value' => "1", 'text' => "A"],
            ['value' => "2", 'text' => "B"],
            ['value' => "3", 'text' => "C"],
            ['value' => "4", 'text' => "D"],
            ['value' => "5", 'text' => "E"]
        ]
    ]);
});
////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////
// Sample: AJAX
Route::get('/ajax/hello_ajax', function () {
    return view('ajax/hello_ajax');
});
Route::get('/ajax/hello_ajax_message', function () {
    $data = [
        "message1" => "Welcome to Fantastic AJAX1 World!!",
        "message2" => "async/await is latest way1 for AJAX handling."
    ];
    return json_encode($data);
});
Route::post('/ajax/hello_ajax_message', function () {
    $data = [
        "message1" => "Welcome to Fantastic AJAX2 World!!",
        "message2" => "async/await is latest way2 for AJAX handling."
    ];
    return json_encode($data);
});
Route::get('/ajax/hello_ajax_message2', 'WCController_ajax@searchResults');
Route::post('/ajax/hello_ajax_message2', 'WCController_ajax@searchResults');
////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////
// Sample: GoogleMap
Route::get('/gmap/hello_gmap', function () {
    return view('gmap/hello_gmap');
});
////////////////////////////////////////////////////////////

Route::get('/ui/input', 'InController@input');
Route::post('/ui/input_results', 'InController@inputResults');

?>
