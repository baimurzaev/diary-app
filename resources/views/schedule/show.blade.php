

<x-app-layout>
    <div class="container">
        <nav class="navbar bg-blue">
            <div class="container-fluid">
                <a class="navbar-brand text-white" href="#">{{$schedule->name}}</a>
            </div>
        </nav>
    </div>


    <div class="container">
            <div class="bg-light p-4 rounded mt-3">
                <h4>{{$schedule->name}}</h4>
                <p></p>
                <button class="btn btn-sm btn-danger" onclick="schedule.delete({{$schedule->id}})" role="button"><i class="bi bi-trash"></i></button>
                <a class="btn btn-sm btn-secondary" href="/schedule/edit/id/{{$schedule->id}}" role="button"><i class="bi bi-pencil"></i></a>
            </div>

    </div>

    <script src="{{ asset('js/schedule.js') }}" defer></script>

</x-app-layout>
