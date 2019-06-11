<?php

/**
 * Pages
 */
Route::get( '/', 'PageController@index' );
Route::get( '/author', 'PageController@author' );
Route::get( '/book', 'PageController@book' );


/**
 * Author group
 */
Route::group( [ 'prefix' => 'author', 'namespace' => 'Author' ], function() {
    Route::get( '/get', 'AuthorController@get' );
    Route::post( '/create', 'AuthorController@create' );
    Route::post( '/edit/{id}', 'AuthorController@edit' );
    Route::delete( '/delete/{id}', 'AuthorController@delete' );
} );


/**
 * Book group
 */
Route::group( [ 'prefix' => 'book', 'namespace' => 'Book' ], function() {
    Route::get( '/get', 'BookController@get' );
    Route::post( '/create', 'BookController@create' );
    Route::post( '/edit/{id}', 'BookController@edit' );
    Route::delete( '/delete/{id}', 'BookController@delete' );
} );


/**
 * Books export
 */
Route::group( [ 'prefix' => 'books-export', 'namespace' => 'Book' ], function() {
    /**
     * Export to excel
     */
    Route::get( '/excel', 'ExportController@exportToExcel' );
} );

