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

                <div class="form-floating">
                    <select class="form-select mb-3" id="classroom">
                        <option selected></option>
                        @foreach($classrooms as $classroom)
                            <option value="{{$classroom->id}}">{{$classroom->name}}</option>
                        @endforeach
                    </select>
                    <label for="classroom">Выберите класс</label>
                </div>

                <div class="form-floating ">
                    <input type="text" class="form-control" value="08:30" id="time-start" placeholder="08:30">
                    <label for="time-start">Время начала первого урока</label>
                </div>
            </div>
        </div>
    </div>

    @foreach($weeks as $key => $week)
        <div class="container">
            <div class="bg-light p-4 rounded mt-3">
                <h4>{{$week}}</h4>
                <div class="row mb-3 mt-3">
                    <div class="col-4">Предметы</div>
                    <div class="col-1"></div>
                    <div class="col-2">Кол-во минут</div>
                </div>
                <div id="scheduleDay{{$key}}"></div>
                <div class="d-grid gap-2 d-md-block">
                    <button onclick="schedule.add({{$key}})" class="btn btn-primary" type="button">Добавить</button>
                </div>
            </div>
        </div>
    @endforeach

    <div class="container">
        <div class="bg-light p-4 rounded mt-3">
            <div class="spinner-border" style="display: none" id="loading-spinner" role="status">
                <span class="visually-hidden">Загружается...</span>
            </div>
            <button id="btn-save" class="btn btn-success" onclick="schedule.saveForm()" role="button">Сохранить
                расписание
            </button>
        </div>
    </div>

    <script>
        let subjects = [];
        @foreach($subjects as $subject)
            subjects[{{$subject->id}}] = {"name": "{{$subject->name}}", "amountTime": "{{$subject->amount_time}}"};
        @endforeach

        let schedule = (function () {
            return {
                add: function (id) {
                    $('#scheduleDay' + id).append(this.createForm());
                },
                remove: function (that) {
                    $(that).closest(".row").remove();
                },
                setTime: function (that) {
                    let $that = $(that);
                    let $selected = $that.find("option:selected");
                    $that.closest('.row').find('input[name="time"]').val($selected.attr('data-time'));
                    $that.closest('.row').find('input[name="name"]').val($selected.text());
                },
                saveForm: function () {
                    let schedule = {
                        name: $("#schedule-name").val(),
                        time: $("#time-start").val(),
                        classroom_id: $("#classroom").find("option:selected").val(),
                        weeks: []
                    }

                    if (!this.check(schedule)) {
                        return;
                    }

                    for (let i = 1; i <= 7; i++) {
                        let $schedule = $("#scheduleDay" + i);
                        $.each($schedule.find(".row"), function (a, obj) {
                            schedule.weeks.push({
                                day: i,
                                title: $(obj).find("input[name='name']").val(),
                                time: $(obj).find("input[name='time']").val()
                            });
                        });
                    }

                    $("#loading-spinner").show();
                    $("#btn-save").hide();
                    $.post("/schedule/add", schedule, function (res) {
                        $("#loading-spinner").hide();
                        $("#btn-save").show();
                        if (res.hasOwnProperty('status') && res.status === "ok") {
                            location.href = '/schedules';
                            return;
                        }
                    });
                },
                check: function (schedule) {
                    if (schedule.name.length < 2) {
                        alert('Пожалуйста, заполните поле "Название"');
                        $("#schedule-name").focus();
                        return false;
                    }

                    if (schedule.time.length < 5) {
                        alert('Пожалуйста, укажите время начала уроков в формате 08:00');
                        return false;
                    }

                    if (schedule.classroom_id <= 0 || !schedule.classroom_id) {
                        alert('Пожалуйста, выберите класс');
                        return false;
                    }
                },
                createSelectInput: function () {
                    let selectInput = '<select style="width: 10px" class="form-select form-control" onchange="schedule.setTime(this)">';
                    selectInput += '<option selected></option>';
                    for (let i in subjects) {
                        selectInput += "<option data-time='" + subjects[i].amountTime + "' value='" + i + "'>" + subjects[i].name + "</option>";
                    }
                    selectInput += '</select>';

                    return selectInput;
                },
                createForm: function () {
                    return '<div class="row mb-3 mt-3" >'
                        + '<div class="col-4"><input name="name" type="text" class="form-control" value=""/></div>'
                        + '<div class="col-1">' + this.createSelectInput() +
                        '</div>'
                        + '<div class="col-2"><input name="time" type="text" class="form-control" value=""/></div>'
                        + '<div class="col"><button onclick="schedule.remove(this)" type="button" class="btn btn-danger"><i class="bi bi-trash"></i></button></div>'
                        + '</div>';
                }
            }
        })();
    </script>

</x-app-layout>
