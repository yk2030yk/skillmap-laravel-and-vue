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
Route::view('skillmap', 'index');
Route::view('skillmap/{path}', 'index')->where('path', '.*');

Route::prefix('front/skillmap')->group(function () {
    Route::get('',              'Front\SkillmapController@index');

    Route::prefix('form')->group(function() {
        Route::prefix('create')->group(function() {
            Route::get('member',                'Front\Skillmap\Form\CreateController@member');
            Route::get('skill',                 'Front\Skillmap\Form\CreateController@skill');
            Route::get('skillLargeCategory',    'Front\Skillmap\Form\CreateController@skillLargeCategory');
            Route::get('skillSmallCategory',    'Front\Skillmap\Form\CreateController@skillSmallCategory');
            Route::get('certification',         'Front\Skillmap\Form\CreateController@certification');
            Route::get('certificationCategory', 'Front\Skillmap\Form\CreateController@certificationCategory');
        });
    });
    Route::prefix('analytics')->group(function() {
        Route::get('skillLevel', 'Front\Skillmap\AnalyticsController@skillLevel');
    });
});

Route::prefix('api')->group(function() {
    Route::prefix('skillmap')->group(function() {
        Route::get('skill',         'Api\SkillmapController@skill');
        Route::get('certification', 'Api\SkillmapController@certification');
    });
    Route::prefix('annual')->group(function() {
        Route::get('search', 'Api\AnnualController@search');
    });

    Route::prefix('skillLargeCategory')->group(function() {
        Route::get('search', 'Api\SkillLargeCategoryController@search');
        Route::post('create', 'Api\SkillLargeCategoryController@create');
        Route::get('update', 'Api\SkillLargeCategoryController@update');
        Route::get('delete', 'Api\SkillLargeCategoryController@delete');
    });
    Route::prefix('skillSmallCategory')->group(function() {
        Route::get('search', 'Api\SkillSmallCategoryController@search');
        Route::post('create', 'Api\SkillSmallCategoryController@create');
        Route::get('update', 'Api\SkillSmallCategoryController@update');
        Route::get('delete', 'Api\SkillSmallCategoryController@delete');
    });
    Route::prefix('skill')->group(function() {
        Route::get('search', 'Api\SkillController@search');
        Route::post('create', 'Api\SkillController@create');
        Route::get('update', 'Api\SkillController@update');
        Route::get('delete', 'Api\SkillController@delete');
    });
    Route::prefix('certificationCategory')->group(function() {
        Route::get('search', 'Api\CertificationCategoryController@search');
        Route::post('create', 'Api\CertificationCategoryController@create');
        Route::get('update', 'Api\CertificationCategoryController@update');
        Route::get('delete', 'Api\CertificationCategoryController@delete');
    });
    Route::prefix('certification')->group(function() {
        Route::get('search', 'Api\CertificationController@search');
        Route::post('create', 'Api\CertificationController@create');
        Route::get('update', 'Api\CertificationController@update');
        Route::get('delete', 'Api\CertificationController@delete');
    });
    Route::prefix('member')->group(function() {
        Route::get('search', 'Api\MemberController@search');
        Route::post('create', 'Api\MemberController@create');
        Route::get('update', 'Api\MemberController@update');
        Route::get('delete', 'Api\MemberController@delete');
    });
    Route::prefix('team')->group(function() {
        Route::get('search', 'Api\TeamController@search');
        Route::post('create', 'Api\TeamController@create');
        Route::get('update', 'Api\TeamController@update');
        Route::get('delete', 'Api\TeamController@delete');
    });
});