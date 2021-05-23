@if($errors->any())
    <div class="errorMsg">
        <ul>
            @foreach($errors->all() as $error)
                <li class="errorLi">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(session('success'))
    <div class="messageSuccessfully">
        {{ session('success') }}
    </div>
@endif
