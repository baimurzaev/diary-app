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
                    <input type="text" class="form-control" id="schedule-name" placeholder="Название">
                    <label for="scheduleName">Название</label>
                </div>
                <div class="form-floating ">
                    <input type="text" class="form-control" value="08:30" id="time-start" placeholder="08:30">
                    <label for="time-start">Время начала первого урока</label>
                </div>
            </div>
        </div>
    </div>

    @foreach($weeks as $day => $weekDay)
        <div class="container">
            <div class="bg-light p-4 rounded mt-3">
                <h4>{{$weekDay}}</h4>
                <div class="row mb-3 mt-3">
                    <div class="col-4">Предметы</div>
                    <div class="col-1"></div>
                    <div class="col-2">Кол-во минут</div>
                </div>
                <div id="scheduleDay{{$day}}"></div>

                <div class="row row-cols-sm-auto g-3 float-start">
                    <div class="col-12">
                        <button onclick="schedule.add({{$day}})" class="btn btn-primary" type="button">Добавить</button>
                    </div>
                </div>

                <div class="row row-cols-sm-auto g-3 float-end">
                    <div class="col-12">
                        <input name="num_min" type="text" class="form-control" style="max-width: 55px" value="10">
                    </div>
                    <div class="col-12">
                        <button onclick="schedule.addRecess(this,{{$day}})" class="btn btn-primary"
                                type="button"><i class="bi bi-plus-circle"></i></button>
                    </div>
                    <div class="col-12">
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                            </button>
                            <ul class="dropdown-menu">
                                @foreach($weeks as $key => $value)
                                    @if($key!=$day)
                                        <li><a class="dropdown-item" onclick="schedule.clone({{$day}},{{$key}})"
                                               href="javascript:">{{$value}}</a></li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    @endforeach

    <div class="container">
        <div class="bg-light p-4 rounded mt-3">
            <div class="spinner-border" style="display: none" id="loading-spinner" role="status">
                <span class="visually-hidden">Загружается...</span>
            </div>
            <button id="btn-save" class="btn btn-success" onclick="schedule.create()" role="button">Создать расписание
            </button>
        </div>
    </div>

    <script>
        let subjects = [];
        @foreach($subjects as $subject)
            subjects[{{$subject->id}}] = {"name": "{{$subject->name}}", "num_minutes": "{{$subject->num_minutes}}"};
        @endforeach
    </script>

    <script src="{{ asset('js/schedule.js') }}" defer></script>

</x-app-layout>
