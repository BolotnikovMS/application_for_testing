@extends('layouts.app')

@section('title-blog')Пользователи@endsection

@section('content')
    <h1>Пользователи</h1>
    <div style="padding:5px; text-align:center;">
        @if($countUsers > 0)
            <table style="width: 100%;">
                <tr>
                    <th>№</th>
                    <th>Группа</th>
                    <th>Ф.И.О.</th>
                    <th>Пол</th>
                    <th>Логин</th>
                    <th>Изменить/Удалить</th>
                </tr>
                @php $incUser = 1; @endphp
                @foreach($dataUsers as $elemUser)
                    <tr>
                        <td style="background-color: #E1F98C;"><b> {{ $incUser++ }}</b></td>
                        @foreach($dataGroup as $elemGroup)
                            @if($elemUser->id_group == $elemGroup->id)
                                <td style="background-color: #E1F98C;"><b> {{ $elemGroup->name }}</b></td>
                            @endif
                        @endforeach
                        <td style="background-color: #E1F98C;">
                            <b> {{ $elemUser->surname .' '. $elemUser->name .' '.$elemUser->lastname  }}</b></td>
                        <td style="background-color: #E1F98C;"><b> {{ $elemUser->gender }}</b></td>
                        <td style="background-color: #E1F98C;"><b> {{ $elemUser->login }}</b></td>
                        <td style="background-color: #E1F98C;">
                            <a href="{{ route('users-update', $elemUser->id) }}"><img
                                    src="{{ URL::asset('/img/edit.png') }}" alt="Изменить" class="editingImg"></a>
                            <a href="{{ route('users-delete', $elemUser->id) }}"><img
                                    src="{{ URL::asset('/img/delete.png') }}" alt="Удалить" class="editingImg"></a>
                        </td>
                    </tr>
                @endforeach
            </table>
        @else
            <p>Пока нет добавленных пользователей.</p>
        @endif
    </div>
@endsection
