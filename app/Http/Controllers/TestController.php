<?php

namespace App\Http\Controllers;

use App\Http\Requests\TestRequest;
use App\Models\Answers;
use App\Models\Disciplines;
use App\Models\Group;
use App\Models\Question;
use App\Models\Result;
use App\Models\Test_topics;
use App\Models\Test_users;
use App\Models\Tests;
use App\Models\Topics;
use App\Models\User;
use App\Models\Rating;
use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function submit(TestRequest $req)
    {
        $test = new Tests();
        $test->id_disc = $req->input('discipline');
        $test->name = $req->input('name');
        $test->author = $req->input('author');
        $test->status = $req->input('access');
        $test->number = $req->input('number');
        $test->testtime = $req->input('testtime');
        $test->id_group_test = $req->input('group');

        $test->save();

        $idTest = $test->max('id');
        $testTopic = new Test_topics();
        $testTopic->id_topic = $req->input('topic');
        $testTopic->id_test = $idTest;

        $testUsers = new Test_users();
        $testUsers->id_test = $idTest;
        $testUsers->id_group = $req->input('group');

        $testTopic->save();
        $testUsers->save();

        return redirect()->route('newtest')->with('success', 'Тест был добавлен!');
    }

    public function getAllInfo()
    {
        $disc = new Disciplines();
        $topic = new Topics();
        $group = new Group();

        $disc = $disc->orderBy('nameDisc', 'asc')->get();
        $topic = $topic->orderBy('name', 'asc')->get();
        $group = $group->orderBy('name', 'asc')->get();

        return view('newtest', ['dataDisc' => $disc, 'dataTopic' => $topic, 'dataGroup' => $group]);
    }

    public function getAllInfoTests()
    {
        $tests = new Tests();
        $topics = new Topics();
        $disc = new Disciplines();
        $testTopic = new Test_topics();

        $countTest = $tests->count();
        $tests = $tests->get();
        $topics = $topics->get();
        $disc = $disc->get();
        $testTopic = $testTopic->get();

        return view('tests', ['dataTests' => $tests, 'dataDisc' => $disc, 'dataTopic' => $topics, 'dataTopicsTests' => $testTopic, 'countTest' => $countTest]);
    }

    public function updateTest($id)
    {
        $disc = new Disciplines();
        $topics = new Topics();
        $group = new Group();
        $tests = new Tests();
        $testTopic = new Test_topics();
        $testUsers = new Test_users();

        $disc = $disc->get();
        $topics = $topics->get();
        $group = $group->get();
        $tests = $tests->get();
        $testTopic = $testTopic->get();
        $testUsers = $testUsers->get();

        return view('updatetest', ['dataTests' => $tests->find($id), 'dataDisc' => $disc, 'dataTopic' => $topics, 'dataTopicsTests' => $testTopic, 'dataGroup' => $group, 'dataTestUsers' => $testUsers]);
    }

    public function updateTestSubmit($id, TestRequest $req)
    {
        $test = Tests::find($id);
        $test->name = $req->input('name');
        $test->author = $req->input('author');
        $test->number = $req->input('number');
        $test->testtime = $req->input('testtime');
        $test->id_group_test = $req->input('group');
        $test->status = $req->input('access');
        $test->save();

        $testTopic = Test_topics::find($id);
        $testTopic->id_topic = $req->input('topic');

        $testUsers = Test_users::find($id);
        $testUsers->id_group = $req->input('group');

        $testTopic->save();
        $testUsers->save();

        return redirect()->route('tests')->with('success', 'Тест был изменен!');
    }

    public function deleteTest($id)
    {
        Tests::find($id)->delete();
        return redirect()->route('tests')->with('success', 'Тест был удален!');
    }

    public function getTestUser()
    {
        $tests = new Tests();
        $topics = new Topics();
        $disc = new Disciplines();
        $testTopic = new Test_topics();
        $testUser = new Test_users();
        $result = new Result();
        $answers = new Answers();
        $questions = new Question();

        $countTest = $tests->count();
        $tests = $tests->get();
        $topics = $topics->get();
        $disc = $disc->get();
        $testTopic = $testTopic->get();
        $testUser = $testUser->get();
        $result = $result->get();
        $answers = $answers->get();
        $questions = $questions->get();

        return view('testuser', ['dataTests' => $tests, 'dataDisc' => $disc, 'dataTopic' => $topics, 'dataTopicsTests' => $testTopic, 'dataTestUser' => $testUser, 'dataResult' => $result, 'dataQuestions' => $questions, 'dataAnswers' => $answers, 'countTests' => $countTest]);
    }

    public function userTestBegin($id)
    {
        $test = new Tests();
        $questions = new Question();
        $answers = new Answers();
        $testTopic = new Test_topics();

        $test = $test->get()->find($id);
        $questions = $questions->inRandomOrder()->get();
        $answers = $answers->get();
        $testTopic = $testTopic->get();

        if ($test->status == 0) {
            return redirect()->route('testuser')->with('success', 'Тест не доступен!');
        } else {
            return view('testbegin', ['dataTest' => $test, 'dataQuestions' => $questions, 'dataAnswers' => $answers, 'dataTestTopic' => $testTopic->where('id_test', '=', $id)]);
        }
    }

    public function sendingTest(Request $req)
    {
        foreach ($_POST['question'] as $question) {
            $result = new Result();

            $answers = '';

            if (isset($_POST['check_' . $question])) {
                foreach ($_POST['check_' . $question] as $quest) {
                    $answers .= $quest . '$';
                }
            } else {
                $answers .= '0$';
            }

            $result->id_user = Auth::user()->id;
            $result->id_test = $req->input('test');
            $result->id_question = $question;
            $result->id_topic = $req->input('topic');
            $result->id_answer = $answers;

            $result->save();
        }

        return redirect()->route('testuser')->with('success', 'Тест был пройден!');
    }

    /*
     *  Функция outputResult принимает 2 параметра $idUser - является не обязательным.
     */
    public function outputResult($idTest, $idUser = null)
    {
        $test = new Tests();
        $result = new Result();
        $questions = new Question();
        $answers = new Answers();
        $user = new User();
        $rating = new Rating();

        $test = $test->get()->find($idTest);
        $result = $result->get();
        $questions = $questions->get();
        $answers = $answers->get();

        if (!is_null($idUser)) {
            $resultsIdUser = $user->get()->find($idUser);
            $rating = $rating->where([
                ['id_user', '=', $idUser], ['id_test', '=', $idTest]
            ])->get();
        } else {
            $resultsIdUser = null;
        }

        return view('testresult', ['dataTest' => $test, 'dataResult' => $result, 'dataQuestions' => $questions, 'dataAnswers' => $answers, 'dataResultIdUser' => $resultsIdUser, 'dataRating' => $rating]);
    }

    public function outputGroupStatistics()
    {
        $group = new Group();

        $group = $group->get();

        return view('groupstatistics', ['dataGroup' => $group]);
    }

    public function outputListGroup($id)
    {
        $group = new Group();
        $users = new User();
        $testUsers = new Test_users();
        $tests = new Tests();
        $result = new Result();
        $questions = new Question();
        $answers = new Answers();

        $group = $group->get();
        $users = $users->get();
        $testUsers = $testUsers->get();
        $tests = $tests->get();
        $result = $result->get();
        $questions = $questions->get();
        $answers = $answers->get();

        return view('listgroup', ['dataGroup' => $group->find($id), 'dataUsers' => $users->where('id_group', '=', $id), 'dataTestUsers' => $testUsers->where('id_group', '=', $id), 'dataTest' => $tests->where('id_group_test', '=', $id), 'dataResult' => $result, 'dataQuestions' => $questions, 'dataAnswers' => $answers]);
    }

    public function saveRating(Request $req, $idGroup)
    {
        $rating = new Rating();

        date_default_timezone_set('Asia/Yekaterinburg');
        $rating->id_user = $req->input('user');
        $rating->id_test = $req->input('test');
        $rating->rating = $req->input('rating');

        $rating->save();

        return redirect()->route('listgroup', $idGroup)->with('success', 'Результат был сохранен!');
    }

    public function resetTest($idTest, $idUser, $idGroup)
    {
        $result = new Result();

        $result->where([
            ['id_user', '=', $idUser],
            ['id_test', '=', $idTest],
        ])->delete();

        return redirect()->route('listgroup', $idGroup)->with('success', 'Результат был сброшен!');
    }
}
