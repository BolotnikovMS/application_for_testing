<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnswerRequest;
use App\Http\Requests\QuestionRequest;
use App\Models\Answers;
use App\Models\Disciplines;
use App\Models\Question;
use App\Models\Topics;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{
    public function submit(QuestionRequest $req)
    {
        $question = new Question();
        $question->description = $req->input('description');
        $question->id_topic = $req->input('topic');
        $question->group_electrical = $req->input('grelec');

        $question->save();

        $idQuestion = $question->max('id');
        $param = $req->request;

        $check = '';

        for ($i = 1; $i <= $_POST['count_data'];) {
            $answer = new Answers();

            $flag = 'check_' . $i;
            if (array_key_exists($flag, $_POST)) {
                $check = 1;
            } else {
                $check = 0;
            }

            $answer->id_question = $idQuestion;
            $answer->description_answer = $req->input('answer_' . $i);
            $answer->correct = $check;
            $answer->id_topic = $req->input('topic');

            $answer->save();
            $i++;
        }

        return redirect()->route('question')->with('success', 'Вопрос был добавлен!');
    }

    public function getDiscTopic()
    {
        $disc = new Disciplines();
        $topic = new Topics();

        $disc = $disc->orderBy('nameDisc', 'asc')->get();
        $topic = $topic->orderBy('name', 'asc')->get();

        return view('newquestion', ['dataDisc' => $disc, 'dataTopic' => $topic]);
    }

    public function getAllInfoQuestions()
    {
        $question = new Question();
        $disc = new Disciplines();
        $topic = new Topics();
        $answers = new Answers();

        $question = $question->get();
        $answers = $answers->get();
        $disc = $disc->get();
        $topic = $topic->get();
        $lengthArrQuestion = count($question);

        return view('question', ['dataQuestion' => $question, 'dataAnswers' => $answers, 'dataTopic' => $topic, 'dataDisc' => $disc, 'lengthArrQuestion' => $lengthArrQuestion]);
    }

    public function updateQuestion($id)
    {
        $disc = new Disciplines();
        $topic = new Topics();
        $question = new Question();
        $answer = new Answers();

        $question = $question->get();
        $answer = $answer->get();
        $disc = $disc->orderBy('nameDisc', 'asc')->get();
        $topic = $topic->orderBy('name', 'asc')->get();

        return view('updatequestion', ['dataQuestion' => $question->find($id), 'dataAnswers' => $answer->where('id_question', '=', $id), 'dataDisc' => $disc, 'dataTopic' => $topic]);
    }

    public function updateQuestionSubmit($id, QuestionRequest $req)
    {
        $question = Question::find($id);
        $question->description = $req->input('description');
        $question->id_topic = $req->input('topic');
        $question->save();

        DB::table('answers')->where('id_question', '=', $id)->delete();
        for ($i = 1; $i <= $_POST['count_data_new'];) {
            $answer = new Answers();

            $flag = 'check_' . $i;
            if (array_key_exists($flag, $_POST)) {
                $check = 1;
            } else {
                $check = 0;
            }

            $answer->id_question = $id;
            $answer->description_answer = $req->input('answer_' . $i);
            $answer->correct = $check;
            $answer->id_topic = $req->input('topic');

            $answer->save();
            $i++;
        }
        return redirect()->route('question')->with('success', 'Вопрос был изменен!');
    }

    public function deleteQuestion($id)
    {
        Question::find($id)->delete();

        return redirect()->route('question')->with('success', 'Вопрос был удален!');
    }

    public function deleteAnswer($idAnswer, $idQuestion)
    {
        Answers::find($idAnswer)->delete();

        return redirect()->route('update-questions', $idQuestion)->with('success', 'Ответ был удален!');
    }

    public function addAnswerSubmit(AnswerRequest $req)
    {
        $answer = new Answers();
        $flag = 'check';
        if (array_key_exists($flag, $_POST)) {
            $check = 1;
        } else {
            $check = 0;
        }

        $answer->id_question = $req->input('quest');
        $answer->description_answer = $req->input('answer');
        $answer->id_topic = $req->input('topic');
        $answer->correct = $check;

        $answer->save();
        return redirect()->route('question')->with('success', 'Ответ был добавлен!');
    }

    public function groupQuestions()
    {
        $disciplines = new Disciplines();
        $topics = new Topics();

        $disciplines = $disciplines->get();
        $topics = $topics->get();

        return view('newquestionsgroup', ['dataDisc' => $disciplines, 'dataTopics' => $topics]);
    }

    public function addGroupQuestions(Request $req)
    {
        $questArr = $req['data'];
        $idTopic = $req['topic'];
        $message = '';

        for ($i = 0; $i < count($questArr); $i++) {
            if (isset($questArr[$i][0]) && isset($idTopic)) {
                $questions = new Question();
                $questions->description = $questArr[$i][0];
                $questions->id_topic = $idTopic;
                $questions->group_electrical = $questArr[$i][1];

                $questions->save();
            }
        }

        return $message;
    }

    public function groupQAnswers()
    {
        return view('addinganswers');
    }

    public function addGroupAnswers(Request $req)
    {
        $answersArr = $req['data'];

        for ($i = 0; $i < count($answersArr); $i++) {
            if (isset($answersArr[$i][0]) && isset($answersArr[$i][1]) && isset($answersArr[$i][2])) {
                $answer = new Answers();
                $question = Question::find($answersArr[$i][0]);

                $answer->id_question = $answersArr[$i][0];
                $answer->description_answer = $answersArr[$i][1];
                $answer->correct = $answersArr[$i][2];
                $answer->id_topic = $question['id_topic'];

                $answer->save();
            }
        }
    }
}
