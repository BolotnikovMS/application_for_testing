<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
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

Auth::routes([
    'register' => false,
    'reset' => false
]);

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', function () {
        return view('home');
    });

    // Admin routes
    Route::group(['prefix' => 'admin'], function () {
        Route::group(['middleware' => 'admin'], function () {
            Route::get('/', function () {
                return view('home');
            });
            //-----Users-----
            Route::get('/users', 'App\Http\Controllers\UserController@getAllUsers')->name('users');
            Route::get('/users/user/{user}/update', 'App\Http\Controllers\UserController@updateUser')->name('users-update');
            Route::post('/users/user/{user}/update', 'App\Http\Controllers\UserController@updateUserSubmit')->name('users-update-submit');
            Route::get('/users/user/{user}/delete', 'App\Http\Controllers\UserController@deleteUser')->name('users-delete');
            Route::get('/newuser', 'App\Http\Controllers\UserController@getGroupAndRole')->name('newuser');
            Route::post('/newuser/submit', 'App\Http\Controllers\UserController@submit')->name('form-user');
            //-----Users-----
        });
    });

    // Moderator routes
    Route::group(['middleware' => 'admin'], function () {
        // -----Discip-----
        Route::get('/newdisciplines', function () {
            return view('newdisciplines');
        })->name('newdisciplines');

        Route::get('/disciplines', 'App\Http\Controllers\DisciplinesController@allDisciplines')->name('disciplines');
        Route::post('/newdisciplines/submit', 'App\Http\Controllers\DisciplinesController@submit')->name('form-disciplines');
        // -----Discip-----
        //-----Group-----
        Route::get('group', 'App\Http\Controllers\GroupController@allGroup')->name('group');
        Route::group(['prefix' => 'group'], function () {
            Route::get('{group}/update', 'App\Http\Controllers\GroupController@updateGroup')->name('group-update');
            Route::post('{group}/update', 'App\Http\Controllers\GroupController@updateGroupSubmit')->name('group-update-submit');
            Route::get('{group}/delete', 'App\Http\Controllers\GroupController@deleteGroup')->name('group-delete');
            Route::post('submit', 'App\Http\Controllers\GroupController@submit')->name('form-group');
        });
        //-----Group-----

        // -----Questions-----
        Route::get('/question', 'App\Http\Controllers\QuestionController@getAllInfoQuestions')->name('question');
        Route::group(['prefix' => 'question'], function () {
            Route::get('new', 'App\Http\Controllers\QuestionController@getDiscTopic')->name('newquestion');
            Route::post('new/submit', 'App\Http\Controllers\QuestionController@submit')->name('form-question');
            Route::get('{question}/update', 'App\Http\Controllers\QuestionController@updateQuestion')->name('update-questions');
            Route::post('{question}/update/submit', 'App\Http\Controllers\QuestionController@updateQuestionSubmit')->name('update-questions-submit');
            Route::get('/{question}/delete', 'App\Http\Controllers\QuestionController@deleteQuestion')->name('question-delete');
            Route::get('updateanswer/{answer}/{question}/delete', 'App\Http\Controllers\QuestionController@deleteAnswer')->name('answer-delete');
            Route::post('/submit', 'App\Http\Controllers\QuestionController@addAnswerSubmit')->name('form-addAnswer');
        });
        // -----Test routes, loading questions
        Route::get('/newquestionsgroup', 'App\Http\Controllers\QuestionController@groupQuestions')->name('newquestionsgroup');
        Route::post('/newquestionsgroup/save', 'App\Http\Controllers\QuestionController@addGroupQuestions')->name('add-newquestionsgroup');
        Route::get('/addinganswers', 'App\Http\Controllers\QuestionController@groupQAnswers')->name('addinganswers');
        Route::post('/addinganswers/save', 'App\Http\Controllers\QuestionController@addGroupAnswers')->name('save-answers');
        // -----Questions-----

        // -----Test-----
        Route::get('/tests', 'App\Http\Controllers\TestController@getAllInfoTests')->name('tests');
        Route::group(['prefix' => 'tests'], function () {
            Route::get('{test}/update', 'App\Http\Controllers\TestController@updateTest')->name('test-update');
            Route::post('{test}/update/submit', 'App\Http\Controllers\TestController@updateTestSubmit')->name('test-update-submit');
            Route::get('{test}/delete', 'App\Http\Controllers\TestController@deleteTest')->name('test-delete');
            Route::get('{test}/{user}/{group}', 'App\Http\Controllers\TestController@resetTest')->name('test-reset');
            Route::get('new', 'App\Http\Controllers\TestController@getAllInfo')->name('newtest');
            Route::post('new/submit', 'App\Http\Controllers\TestController@submit')->name('form-test');
        });

        Route::group(['prefix' => 'statistics'], function () {
            Route::get('group', 'App\Http\Controllers\TestController@outputGroupStatistics')->name('groupstatistics');
            Route::get('listgroup/{group}', 'App\Http\Controllers\TestController@outputListGroup')->name('listgroup');
            Route::post('listgroup/{group}', 'App\Http\Controllers\TestController@saveRating')->name('form-save-rating');
        });
        // -----Test-----

        //-----Topic-----
        // AJAX
        Route::get('/topic', 'App\Http\Controllers\TopicController@getTopic')->name('topic');
        Route::group(['prefix' => 'topic'], function () {
            Route::get('newtopic', 'App\Http\Controllers\TopicController@getDisc')->name('newtopic');
            Route::post('newtopic/submit', 'App\Http\Controllers\TopicController@submit')->name('form-topic');
            Route::get('topic/{topic}/update', 'App\Http\Controllers\TopicController@updateTopic')->name('topic-update');
            Route::post('topic/{topic}/update', 'App\Http\Controllers\TopicController@updateTopicSubmit')->name('topic-update-submit');
            Route::get('topic/{topic}/delete', 'App\Http\Controllers\TopicController@deleteTopic')->name('topic-delete');
        });
        //-----Topic-----
    });

    //-----Test-----
    Route::group(['prefix' => 'opentest'], function () {
        Route::get('testuser', 'App\Http\Controllers\TestController@getTestUser')->name('testuser');
        Route::get('testbegin/{test}', 'App\Http\Controllers\TestController@userTestBegin')->name('test-begin');
        Route::post('testbegin/submit', 'App\Http\Controllers\TestController@sendingTest')->name('form-test-send');
    });
    Route::get('/testresult/{test}/user/{user?}', 'App\Http\Controllers\TestController@outputResult')->name('test-result');

    //-----Test-----
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
