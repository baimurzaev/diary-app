<x-app-layout>
    <div class="container">
        <nav class="navbar bg-blue">
            <div class="container-fluid">
                <a class="navbar-brand text-white" href="#">Список предметов</a>
            </div>
        </nav>
    </div>

    <div class="container">
        <div class="bg-light p-4 rounded mt-4">
            <a class="btn btn-primary" href="/subject/add" role="button">Создать предмет</a>
        </div>
    </div>

    <div class="container">
        <div class="bg-light p-4 rounded mt-4">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">#ID</th>
                    <th scope="col">Предмет</th>
                    <th scope="col">Кол-во минут</th>
                    <th scope="col">Управление</th>
                </tr>
                </thead>
                <tbody>
                @foreach($subjects as $subject)
                    <tr>
                        <th scope="row">{{$subject->id}}</th>
                        <td>{{$subject->name}}</td>
                        <td>{{$subject->num_minutes}}</td>
                        <td>
                            <a class="btn btn-sm btn-secondary" href="/subject/edit/id/{{$subject->id}}">
                                <i class="bi bi-pencil"></i>
                            </a>

                            <button class="btn btn-sm btn-danger" onclick="subject.delete({{$subject->id}})">
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
