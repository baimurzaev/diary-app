let pupils = (function () {
    let classroomId = 0;

    return {
        id: function () {
            return classroomId;
        },
        init: function (id) {
            classroomId = id

            $("#pupilNameSearch").devbridgeAutocomplete({
                serviceUrl: "/pupils/search/",
                dataType: "json",
                width: 600,
                minChars: 2,
                onSelect: function (d) {
                    $.post("/classroom/pupil/link/", {
                        _token: Token.csrf(),
                        user_id: d.data.id,
                        classroom_id: classroomId
                    }, function (res) {
                        $('#pupilNameSearch').val('');
                        if (res.hasOwnProperty('status') && res.status === "ok") {
                            pupils.loadPupilsList(classroomId);
                        }
                    });
                }
            });
        },
        addSchedule: function (scheduleId) {
            let users = [];

            $('.userGroup:checked').each(function (i, a) {
                users.push($(a).data('user-id'));
            });

            if (!users.length) {
                alert("Для выбора расписания необходимо отметить учеников галкой");
                return;
            }

            $.post("/pupils/add/schedule", {
                _token: Token.csrf(),
                users: users,
                schedule_id: scheduleId
            }, function (res) {
                if (res.hasOwnProperty('status') && res.status === "ok") {
                    pupils.loadPupilsList(classroomId);
                }
            });
        },
        generate: function (id, token) {
            if (!confirm("Сформировать класс?")) {
                return;
            }

            $.post("/generate/classroom/pupils", {id: id, "_token": token}, function (res) {
                if (res.hasOwnProperty('status') && res.status === "ok") {
                    pupils.loadPupilsList(id);
                }
            });
        },
        unlink: function (userId, classroomId) {
            $.post('/classroom/pupil/unlink/', {
                _token: Token.csrf(),
                user_id: userId,
                classroom_id: classroomId
            }, function (res) {
                if (res.hasOwnProperty('status') && res.status === "ok") {
                    pupils.loadPupilsList(classroomId);
                }
            });
        },
        loadPupilsList: function (id) {
            $("#pupils-list").html('<div class="spinner-border text-center" role="status"></div>');

            $.get("/pupils/list/classroom/id/" + id, {}, function (html) {
                $("#pupils-list").html(html);
            });
        }
    }
})();


let subject = (function () {
    return {
        delete: function (id) {
            if (confirm("Этот предмет будет удален. Продолжить?")) {
                $.post('/subject/delete', {id: id, _token: Token.csrf()}, function (res) {
                    if (res.hasOwnProperty('status') && res.status === "ok") {
                        location.href = '/subjects';
                    }
                });
            }
        }
    }
})();

let Token = (function () {
    let token = $('meta[name="csrf-token"]').attr('content');
    return {
        csrf: function () {
            return token;
        }
    }
})();

let classroom = (function () {
    return {
        checkAll: function (that) {
            $('.userGroup').prop('checked', $(that).is(':checked'));
        },
        delete: function (id) {
            if (confirm("Этот класс будет удален. Продолжить?")) {
                $.post('/classroom/delete', {id: id, _token: Token.csrf()}, function (res) {
                    if (res.hasOwnProperty('status') && res.status === "ok") {
                        location.href = '/classroom';
                    }
                });
            }
        }
    }
})();
