{{-- Секция которая будет встраиваться в другие шаблоны --}}
@section('right-menu')

    <div class="rightMenu">
        <h3>Личный кабинет</h3>
        <input name="exitt" type="hidden" value="1">
        <div class="">Добро пожаловать! @php
                if (Auth::user() != NULL) {
                    echo Auth::user()->surname . ' '. Auth::user()->name ;
                }
            @endphp
        </div>

        <div>
            @php
                if (Auth::user() != NULL) {
                    $group = DB::table('groups')->where('id', '=', Auth::user()->id_group)->get();
                    foreach ($group as $elemGroup) {
                      echo 'Вы состоите в группе - ' . $elemGroup->name . '!';
                    }
                }
            @endphp
        </div>
        <div style="padding:5px; text-align:center;">
            <a class="greenBtn" href="{{ route('logout') }}"
               onclick="event.preventDefault();
               document.getElementById('logout-form').submit();">
                Выйти
            </a>
            <form action="{{ route('logout') }}" method="POST" id="logout-form">
                @csrf
            </form>
        </div>
    </div>

    <div class="rightMenu">
        <h3>Меню</h3>
        <ul>
            @if(Auth::user()->id_roles == 1 || Auth::user()->id_roles == 2)
                @if(Auth::user()->id_roles == 1)
                    <li>
                        <a href="{{route('users')}}">Пользователи</a>
                    </li>
                    <li style="padding-left: 25px;">
                        <a href="{{route('newuser')}}">Добавить пользователя</a>
                    </li>
                @endif
                <li>
                    <a href="{{route('group')}}">Добавить группу</a>
                </li>
                <li>
                    <a href="{{route('tests')}}">Тесты</a>
                </li>
                <li style="padding-left: 25px;">
                    <a href="{{route('newtest')}}">Добавить тест</a>
                </li>
                <li>
                    <a href="{{route('disciplines')}}">Дисциплины и темы</a>
                </li>
                <li style="padding-left: 25px;">
                    <a href="{{route('newdisciplines')}}">Добавить дисциплину</a>
                </li>
                <li style="padding-left: 25px;">
                    <a href="{{route('newtopic')}}">Добавить тему</a>
                </li>
                <li style="padding-left: 25px;">
                    <a href="{{route('question')}}">Вопросы</a>
                </li>
                <li style="padding-left: 25px;">
                    <a href="{{route('newquestionsgroup')}}">Добавить группу вопросов (тест)</a>
                </li>
                <li>
                    <a href="{{route('groupstatistics')}}">Просмотр результатов тестирования</a>
                </li>

            @endif
            <li>
                <a href="{{route('home')}}">На главную</a>
            </li>
            <li>
                <a href="{{route('testuser')}}">Тесты и результаты</a>
            </li>
        </ul>
    </div>

    <script src="/js/rightMenu.js"></script>
    {{--@endsection;--}}
