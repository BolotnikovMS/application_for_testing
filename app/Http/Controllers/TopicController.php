<?php

namespace App\Http\Controllers;

use App\Http\Requests\TopicRequest;
use App\Models\Answers;
use App\Models\Disciplines;
use App\Models\Question;
use App\Models\Topics;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    public function submit(TopicRequest $req)
    {
        $topic = new Topics();
        $topic->name = strip_tags($req->input('name'));
        $topic->description = strip_tags($req->input('description'));
        $topic->id_discipline = $req->input('discipline');

        $topic->save();

        return redirect()->route('newtopic')->with('success', 'Тема была добавлена!');
    }

    public function getDisc()
    {
        $disc = new Disciplines();
        $disc = $disc->get();

        return view('newtopic', compact('disc'));
    }

    public function getTopic()
    {
        $topic = new Topics();

        $idDisc = $_GET['data'];
        $topic = $topic->select('id', 'name', 'id_discipline')->where('id_discipline', '=', $idDisc)->get();

        return json_encode($topic, JSON_UNESCAPED_UNICODE);
    }

    public function updateTopic($id)
    {
        $disc = new Disciplines();
        $topic = new Topics();

        $disc = $disc->get();
        $topic = $topic->get();

        return view('updatetopic', ['dataDisc' => $disc, 'dataTopic' => $topic->find($id)]);
    }

    public function updateTopicSubmit($id, TopicRequest $req)
    {
        $topic = Topics::find($id);;
        $topic->name = strip_tags($req->input('name'));
        $topic->description = strip_tags($req->input('description'));
        $topic->id_discipline = $req->input('discipline');

        $topic->save();

        return redirect()->route('disciplines')->with('success', 'Тема была изменена!');
    }

    public function deleteTopic($id)
    {
        Topics::find($id)->delete();

        return redirect()->route('disciplines')->with('success', 'Тема была удалена!');
    }
}
