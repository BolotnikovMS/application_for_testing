<?php

namespace App\Http\Controllers;

use App\Http\Requests\GroupRequest;
use App\Models\Group;

class GroupController extends Controller
{
    public function submit(GroupRequest $req)
    {
        $gropu = new Group();
        $gropu->name = $req->input('name');

        $gropu->save();

        return redirect()->route('group')->with('success', 'Группа была добавлена!');
    }

    public function allGroup()
    {
        $gropu = new Group();

        $countGroup = $gropu->count();
        $gropu = $gropu->get();

        return view('group', ['dataGroup' => $gropu, 'countGroup' => $countGroup]);
    }

    public function updateGroup($id)
    {
        $group = Group::find($id);

        return view('updategroup', compact('group'));
    }

    public function updateGroupSubmit($id, GroupRequest $req)
    {
        $gropu = Group::find($id);
        $gropu->name = $req->input('name');

        $gropu->save();

        return redirect()->route('group')->with('success', 'Название группы было изменено!');
    }

    public function deleteGroup($id)
    {
        Group::find($id)->delete();

        return redirect()->route('group')->with('success', 'Группа была удалена!');
    }
}
