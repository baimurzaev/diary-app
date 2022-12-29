<x-app-layout>
    <div class="container">
        <nav class="navbar bg-blue">
            <div class="container-fluid">
                <a class="navbar-brand text-white" href="#">Список расписаний</a>
            </div>
        </nav>
    </div>

    <div class="container">
        <div class="bg-light p-4 rounded mt-4">
            <a class="btn btn-primary" href="/schedule/add" role="button">Создать расписание</a>
        </div>
    </div>

    <div class="container">
        @foreach($schedules as $schedule)
            <div class="bg-light p-4 rounded mt-3">
                <h4>{{$schedule->name}}</h4>
                <p class="fs-6">Начало: {{$schedule->time_start}}</p>
{{--                <h4><a href="/schedule/show/id/{{$schedule->id}}">{{$schedule->name}}</a></h4>--}}

                <button class="btn btn-sm btn-danger" onclick="schedule.delete({{$schedule->id}})" role="button"><i class="bi bi-trash"></i></button>
                <a class="btn btn-sm btn-secondary" href="/schedule/edit/id/{{$schedule->id}}" role="button"><i class="bi bi-pencil"></i></a>
                <button class="btn btn-sm btn-secondary" onclick="schedule.double({{$schedule->id}})" role="button">Создать дубль</button>
            </div>
        @endforeach
    </div>

    <script src="{{ asset('js/schedule.js') }}" defer></script>

</x-app-layout>
