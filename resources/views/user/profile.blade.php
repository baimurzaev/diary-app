<x-app-layout>

    <div class="container">
        <nav class="navbar bg-blue">
            <div class="container-fluid">
                <a class="navbar-brand text-white" href="#">Профиль</a>
            </div>
        </nav>
    </div>


    <div class="container">
        <div class="bg-light p-4 rounded mt-3">
            <h4>{{$profile->name}} {{$profile->last_name}}</h4>
            <br>
            <p>Тип учетной записи: {{$accountType}}</p>
            <p>Почта: {{$profile->email}}</p>
        </div>
    </div>

</x-app-layout>
