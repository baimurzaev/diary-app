<x-app-layout>
    <div class="container">
        <nav class="navbar bg-blue">
            <div class="container-fluid">
                <a class="navbar-brand text-white" href="#">Добавление расписания</a>
            </div>
        </nav>
    </div>

    <main class="container">
        <div class="bg-light p-5 rounded mt-3">

                <div class="col-5">
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="floatingInput" placeholder="Название">
                        <label for="floatingInput">Название</label>
                    </div>

                    <div class="form-floating">
                        <select class="form-select mb-3" id="floatingSelect" aria-label="Floating label select example">
                            <option selected></option>
                            @foreach($classrooms as $classroom)
                                <option value="{{$classroom->id}}">{{$classroom->name}}</option>
                            @endforeach
                        </select>
                        <label for="floatingSelect">Выберите класс</label>
                    </div>
                </div>

            <br>
            <a class="btn btn-success" href="/" role="button">Сохранить расписание &raquo;</a>
        </div>
    </main>

</x-app-layout>
