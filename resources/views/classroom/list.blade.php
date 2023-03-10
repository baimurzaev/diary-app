<x-app-layout>
    <div class="container">
        <nav class="navbar bg-blue">
            <div class="container-fluid">
                <a class="navbar-brand text-white" href="#">Список классов</a>
            </div>
        </nav>
    </div>

    <div class="container">
        <div class="bg-light p-4 rounded mt-4">
            <a class="btn btn-primary" href="/classroom/add" role="button">Создать класс</a>
        </div>
    </div>

    <div class="container">
        <div class="bg-light p-4 rounded mt-4">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#ID</th>
                    <th scope="col">Класс</th>
                    <th scope="col">Кол-во учеников</th>
                    <th scope="col">Управление</th>
                </tr>
                </thead>
                <tbody>
                @foreach($classrooms as $classroom)
                    <tr>
                        <th scope="row">{{$classroom->id}}</th>
                        <td><a href="/classroom/edit/id/{{$classroom->id}}">{{$classroom->name}}</td>
                        <td>{{$classroom->pupils_count}}</td>
                        <td>
                            <a class="btn btn-sm btn-secondary" href="/classroom/edit/id/{{$classroom->id}}">
                                <i class="bi bi-pencil"></i>
                            </a>

                            <button class="btn btn-sm btn-danger" onclick="classroom.delete({{$classroom->id}})">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>


