<x-app-layout>
    <div class="container">
        <nav class="navbar bg-blue">
            <div class="container-fluid">
                <a class="navbar-brand text-white" href="#">Управление классом</a>
            </div>
        </nav>
    </div>

    <main class="container">
        <form method="post" action="/classroom/edit">
            <input type="hidden" name="id" value="{{$classroom->id}}">
            @csrf
            <div class="bg-light p-4 rounded mt-3">
                <div class="col-5">
                    <div class="form-floating mb-3">
                        <input type="text" name="name" class="form-control" id="classroomName"
                               value="{{$classroom->name}}">
                        <label for="classroomName">Название класса</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-success" role="button">Сохранить</button>
            </div>

        </form>
    </main>

    <div class="container">
        <div class="bg-light p-4 rounded mt-3">
            <div class="col-5">
                <div class="form-floating mb-3">
                    <input type="text" name="name" class="form-control" id="pupilNameSearch" value="">
                    <label for="pupilNameSearch">Введите Ф.И.О. для поиска</label>
                </div>
            </div>
            <div class="col">
                <button class="btn btn-primary float-end"
                        onclick="pupils.generate({{$classroom->id}},'{{ csrf_token() }}')"
                        role="button">Добавить учеников
                </button>
<div class="clearfix"></div>
            </div>
        </div>
        <div class="bg-light p-5 rounded mt-3">
            <div id="pupils-list"></div>
        </div>
        <br>
        <br>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            pupils.init({{$classroom->id}});
            pupils.loadPupilsList({{$classroom->id}});
        });
    </script>
</x-app-layout>
