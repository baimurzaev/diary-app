<x-app-layout>
    <div class="container">
        <nav class="navbar bg-blue">
            <div class="container-fluid">
                <a class="navbar-brand text-white" href="#">Редактирование класса</a>
            </div>
        </nav>
    </div>

    <main class="container">
        <form method="post" action="/classroom/edit/id/{{$classroom->id}}">
            @csrf
            <div class="bg-light p-4 rounded mt-3">
                <div class="col-5">
                    <div class="form-floating mb-3">
                        <input type="text" name="name" class="form-control" id="floatingInput"
                               value="{{$classroom->name}}">
                        <label for="floatingInput">Режим редактирования</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-success" role="button">Сохранить</button>
            </div>

        </form>
    </main>

    <main class="container">
        <div class="bg-light p-4 rounded mt-3">
            <div class="col-5">
                <div class="form-floating mb-3">
                    <input type="text" name="name" class="form-control" id="floatingInput"
                           value="">
                    <label for="floatingInput">Введите Ф.И.О. для поиска</label>
                </div>
            </div>
            <div class="col">
                <button class="btn btn-primary float-end"
                        onclick="pupils.generatePupils({{$classroom->id}},'{{ csrf_token() }}')"
                        role="button">Добвить учеников
                </button>
                <button type="submit" class="btn btn-success" role="button">Добавить</button>
            </div>
        </div>
        <div class="bg-light p-5 rounded mt-3">
            <div id="pupils-list"></div>
        </div>
    </main>

    <script>
        let pupils = (function () {
            document.addEventListener("DOMContentLoaded", function () {
                pupils.loadPupilsList({{$classroom->id}});
            });

            return {
                generatePupils: function (id, token) {
                    if (!confirm("Сформировать класс?")) {
                        return;
                    }

                    $.post("/generate/classroom/pupils", {id: id, "_token": token}, function (res) {
                        if (res.hasOwnProperty('status') && res.status === "ok") {
                            pupils.loadPupilsList(id);
                        }
                    });
                },
                loadPupilsList: function (id) {
                    $("#pupils-list").html('<div class="spinner-border text-center" role="status"></div>');

                    $.get("/classroom/pupils/list/id/" + id, {}, function (html) {
                        $("#pupils-list").html(html);
                    });
                }
            }
        })();
    </script>

</x-app-layout>
