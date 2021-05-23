<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsersRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Group;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function submit(UsersRequest $req)
    {
        function translit($value)
        {
            $converter = array(
                'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd',
                'е' => 'e', 'ё' => 'e', 'ж' => 'zh', 'з' => 'z', 'и' => 'i',
                'й' => 'y', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n',
                'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't',
                'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c', 'ч' => 'ch',
                'ш' => 'sh', 'щ' => 'sch', 'ь' => '', 'ы' => 'y', 'ъ' => '',
                'э' => 'e', 'ю' => 'yu', 'я' => 'ya',

                'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D',
                'Е' => 'E', 'Ё' => 'E', 'Ж' => 'Zh', 'З' => 'Z', 'И' => 'I',
                'Й' => 'Y', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N',
                'О' => 'O', 'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T',
                'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C', 'Ч' => 'Ch',
                'Ш' => 'Sh', 'Щ' => 'Sch', 'Ь' => '', 'Ы' => 'Y', 'Ъ' => '',
                'Э' => 'E', 'Ю' => 'Yu', 'Я' => 'Ya',
            );

            $value = strtr($value, $converter);

            return $value;
        }

        $user = new User();
        $login = $req->input('surname');
        $user->surname = $req->input('surname');
        $user->name = $req->input('name');
        $user->lastname = $req->input('lastname');
        $user->gender = $req->input('gender');
        $user->login = translit($login);
        $user->password = Hash::make($req->input('password'));
        $user->id_group = $req->input('group');
        $user->id_roles = $req->input('role');
        $user->id_group_electrical = $req->input('group_electrical');

        $user->save();

        return redirect()->route('newuser')->with('success', 'Пользователь был добавлен!');
    }

    public function getGroupAndRole()
    {
        $group = new Group();
        $role = new Role();

        $role = $role->get();
        $group = $group->orderBy('name', 'asc')->get();
        $countGroup = count($group);

        return view('newuser', ['dataGroup' => $group, 'countGroup' => $countGroup, 'dataRole' => $role]);
    }

    public function getAllUsers()
    {
        $users = new User();
        $group = new Group();

        $users = $users->orderBy('surname', 'desc')->get();
        $group = $group->orderBy('name', 'asc')->get();
        $countUsers = count($users);

        return view('users', ['dataUsers' => $users, 'dataGroup' => $group, 'countUsers' => $countUsers]);
    }

    public function updateUser($id)
    {
        $users = new User();
        $group = new Group();
        $roles = DB::table('roles')->get();

        $users = $users->orderBy('surname', 'desc')->get();
        $group = $group->orderBy('name', 'asc')->get();

        return view('updateusers', ['dataUsers' => $users->find($id), 'dataGroup' => $group, 'dataRoles' => $roles]);
    }

    public function updateUserSubmit($id, UsersRequest $req)
    {
        $user = User::find($id);
        $user->surname = $req->input('surname');
        $user->name = $req->input('name');
        $user->lastname = $req->input('lastname');
        $user->login = $req->input('login');
        $user->id_group = $req->input('group');
        $user->id_roles = $req->input('role');

        $user->save();

        return redirect()->route('users')->with('success', 'Данные пользователя были изменены!');
    }

    public function deleteUser($id)
    {
        User::find($id)->delete();

        return redirect()->route('users')->with('success', 'Пользователь был удален!');
    }
}
