<?php

use Illuminate\Support\Facades\Route;

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
Route::view('/', 'pages/guest_view');
Route::post('/guset/issue_ticket', 'TicketsController@createTicket');
Route::get('/login', 'UserController@index');
Route::post('/checklogin', 'UserController@checklogin');
Route::get('/logout', 'UserController@logout');
Route::get('/support', 'TicketsController@index');
Route::get('resolve/{id}/remind/{problem}', [
    'as' => 'resolve', 'uses' => 'TicketsController@resolve'
]);
Route::post('/support/issue_solution', 'SupportController@issueSolution');
Route::view('/search_tickets', 'pages/search_tickets');
Route::post('/ticket_result', 'SupportController@ticketResult');
# Route::get('/search','TicketsController@search');

