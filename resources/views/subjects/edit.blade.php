<x-app-layout>
    <div class="container">
        <nav class="navbar bg-blue">
            <div class="container-fluid">
                <a class="navbar-brand text-white" href="#">Редактирование группы</a>
            </div>
        </nav>
    </div>

    <div class="container">
        <form method="post" action="/subject/edit/id/{{$subject->id}}">
            <input name="id" type="hidden" value="{{$subject->id}}">
            @csrf
            <div class="bg-light p-4 rounded mt-3">
                <div class="col-5">
                    <div class="form-floating mb-3">
                        <input type="text" name="name" class="form-control" id="subjectName"
                               value="{{$subject->name}}">
                        <label for="subjectName">Режим редактирования</label>
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-floating mb-3">
                        <input type="text" name="num_minutes" class="form-control" id="subjectMinutes"
                               placeholder="Название предмета" value="{{$subject->num_minutes}}">
                        <label for="subjectMinutes">Кол-во минут</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-success" role="button">Сохранить</button>
            </div>

        </form>
    </div>
</x-app-layout>
