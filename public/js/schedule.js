let schedule = (function () {
    let token = $('meta[name="csrf-token"]').attr('content');

    $("#classroom").on("change", function () {
        let name = $(this).find("option:selected").text();
        let $scheduleName = $("#schedule-name");

        if (!$scheduleName.val().length) {
            $scheduleName.val('Расписание ' + $.trim(name));
        }
    });

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
            $that.closest('.row').find('input[name="time"]').attr('value', $selected.attr('data-time'));
            $that.closest('.row').find('input[name="name"]').attr('value', $selected.text());
        },
        delete: function (id) {
            if (confirm("Внимание! Будет удалено расписание. Продолжить?")) {
                $.post("/schedule/delete/", {"id": id, "_token": token}, function (res) {
                    if (res.hasOwnProperty('status') && res.status === "ok") {
                        location.href = "/schedules";
                    }
                });
            }
        },
        double: function (id) {
            if (confirm("Будет создан дубль. Продолжить?")) {
                $.post("/schedule/double/", {"id": id, "_token": token}, function (res) {
                    if (res.hasOwnProperty('status') && res.status === "ok") {
                        location.href = "/schedules";
                    }
                });
            }
        },
        clone: function (from, to) {
            $("#scheduleDay" + to).html(
                $("#scheduleDay" + from).html()
            );
        },
        save: function () {
            this.schedule('save');
        },
        create: function () {
            this.schedule('create');
        },
        schedule: function (mode) {
            let schedule = this.getScheduleParams();
            if (mode === "save") {
                schedule.id = $('#schedule-id').data('id');
            }

            if (!this.check(schedule)) {
                return;
            }

            $("#loading-spinner").show();

            $.post("/schedule/" + mode, schedule, function (res) {
                console.log(res);
                $("#loading-spinner").hide();
                if (res.hasOwnProperty('status') && res.status === "ok") {
                    location.href = '/schedules';
                }
            });
        },
        getScheduleParams: function () {
            let schedule = {
                name: $("#schedule-name").val(),
                time_start: $("#time-start").val(),
                classroom_id: $("#classroom").find("option:selected").val(),
                _token: token,
                lessons: []
            };

            let lessons = [];
            for (let i = 1; i <= 7; i++) {
                $("#scheduleDay" + i).find(".row").each(function (a, obj) {
                    lessons.push({
                        day: i,
                        title: $(obj).find("input[name='name']").val(),
                        num_minutes: $(obj).find("input[name='time']").val(),
                    });
                });
            }

            schedule.lessons = lessons;

            return schedule;

        },
        check: function (schedule) {
            if (schedule.name.length < 2) {
                alert('Пожалуйста, заполните поле "Название"');
                $("#schedule-name").focus();
                return false;
            }

            if (schedule.time_start.length < 5) {
                alert('Пожалуйста, укажите время начала уроков в формате 08:00');
                return false;
            }

            return true;
        },
        createSelectInput: function () {
            let selectInput = '<select style="width: 10px" class="form-select form-control" onchange="schedule.setTime(this)">';
            selectInput += '<option selected></option>';
            for (let i in subjects) {
                selectInput += "<option data-time='" + subjects[i].num_minutes + "' value='" + i + "'>" + subjects[i].name + "</option>";
            }
            selectInput += '</select>';

            return selectInput;
        },
        createForm: function (min) {
            let recess = (min && min > 0) ? "Перемена" : "";
            let minutes = (min) ? min : '';

            return '<div class="row mb-3 mt-3" data-item-id="0">'
                + '<div class="col-4"><input name="name" type="text" class="form-control" value="' + recess + '"/></div>'
                + '<div class="col-1">' + this.createSelectInput() +
                '</div>'
                + '<div class="col-2"><input name="time" type="text" class="form-control" value="' + minutes + '"/></div>'
                + '<div class="col"><button onclick="schedule.remove(this)" type="button" class="btn btn-danger"><i class="bi bi-trash"></i></button></div>'
                + '</div>';
        },
        addRecess: function (that, day) {
            let minutes = $(that).closest('.row').find('input[name="num_min"]').val();
            let html = this.createForm(minutes);

            $('#scheduleDay' + day).find('.row:not(:last)').each(function (i, b) {
                $(b).after(html);
            });
        }
    }
})();
