<?php
/**
 * Created by Decipher Lab.
 * User: Prabakar
 * Date: 19-Mar-18
 * Time: 8:49 PM
 */
//switch between language


Route::group(['middleware' => ['web']], function () {
    Route::get('lang/{lang}', ['as'=>'lang.switch', 'uses'=>'LanguageController@switchLang']);
    Route::get('translations','LanguageController@index');
    Route::get('translations/add','LanguageController@add');
    Route::post('translations/add','LanguageController@save');
    Route::post('translations/save','LanguageController@update');
    Route::get('translations/remove/{folder}','LanguageController@remove');
});
