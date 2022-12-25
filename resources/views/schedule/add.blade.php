<x-app-layout>
    <div class="container">
        <nav class="navbar bg-blue">
            <div class="container-fluid">
                <a class="navbar-brand text-white" href="#">Создание нового расписания</a>
            </div>
        </nav>
    </div>

    <div class="container">
        <div class="bg-light p-4 rounded mt-3">
            <div class="col-5">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="floatingInput" placeholder="Название">
                    <label for="floatingInput">Название</label>
                </div>

                <div class="form-floating">
                    <select class="form-select mb-3" id="classroom">
                        <option selected></option>
                        @foreach($classrooms as $classroom)
                            <option value="{{$classroom->id}}">{{$classroom->name}}</option>
                        @endforeach
                    </select>
                    <label for="floatingSelect">Выберите класс</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" value="08:30" id="time-start" placeholder="08:30">
                    <label for="time-start">Время начала первого урока</label>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="bg-light p-4 rounded mt-3">
            <h4>Понедельник</h4>

            <div class="row mb-3 mt-3">
                <div class="col-4">Предметы</div>
                <div class="col-2">Кол-во минут</div>
            </div>

            <div class="row mb-3 mt-3" id="day1">
                <div class="col-4">
                    <input type="text" class="form-control" value=""/>
                </div>
                <div class="col-2">
                    <input type="text" class="form-control" value=""/>
                </div>
            </div>

            <div class="d-grid gap-2 d-md-block">
                <button class="btn btn-secondary" type="button">Добавить</button>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="bg-light p-4 rounded mt-3">
            <button class="btn btn-success" onclick="" role="button">Сохранить расписание</button>
        </div>
    </div>


</x-app-layout>
