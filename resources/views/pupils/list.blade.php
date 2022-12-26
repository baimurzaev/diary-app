<x-app-layout>

    <div class="container">
        <nav class="navbar bg-blue">
            <div class="container-fluid">
                <a class="navbar-brand text-white" href="#">Список учеников</a>
            </div>
        </nav>
    </div>

    <div class="container">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Ф.И.О.</th>
                <th scope="col">E-Mail</th>
            </tr>
            </thead>
            <tbody>
            @foreach($pupils as $pupil)
                <tr>
                    <th scope="row">{{$pupil->id}}</th>
                    <td>{{$pupil->last_name}} {{$pupil->name}} {{$pupil->middle_name}}</td>
                    <td>{{$pupil->email}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="container">
        <div class="p-4 rounded mt-4">
            {{$pupils->links()}}
        </div>
    </div>
</x-app-layout>
