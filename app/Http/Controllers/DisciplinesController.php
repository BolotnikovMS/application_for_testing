<?php

namespace App\Http\Controllers;

use App\Models\Disciplines;
use App\Models\Topics;
use App\Http\Requests\DisciplinesRequest;

class DisciplinesController extends Controller
{
    public function submit(DisciplinesRequest $req)
    {
        $discipline = new Disciplines();
        $discipline->nameDisc = strip_tags($req->input('name'));

        $discipline->save();

        return redirect()->route('newdisciplines')->with('success', 'Дисциплина была добавлена!');
    }

    public function allDisciplines()
    {
        $discipline = new Disciplines();
        $topic = new Topics();

        $countDisc = $discipline->count();
        $countTopic = $topic->count();
        $discipline = $discipline->get();
        $topic = $topic->get();

        return view('disciplines', ['dataDisc' => $discipline, 'dataTopic' => $topic, 'countDisc' => $countDisc, 'countTopic' => $countTopic]);
    }
}
