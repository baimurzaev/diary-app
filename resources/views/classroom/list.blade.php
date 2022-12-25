<x-app-layout>
    <div class="container">
        <nav class="navbar bg-blue">
            <div class="container-fluid">
                <a class="navbar-brand text-white" href="#">Список классов</a>
            </div>
        </nav>
    </div>

    <main class="container">
        <div class="bg-light p-4 rounded mt-4">
            <a class="btn btn-success" href="/classroom/add" role="button">Добавить новый класс</a>
        </div>
    </main>

    @foreach($classrooms as $classroom)
        <main class="container">
            <div class="bg-light p-4 rounded mt-4">
                <h3>{{$classroom->name}}</h3>
                <p class="">Учеников в классе: {{$classroom->pupils_count}}</p>
                <a class="btn btn-danger" href="javascript:" onclick="classroom.delete({{$classroom->id}})"
                   role="button"><i class="bi bi-trash"></i> Удалить</a>
                <a class="btn btn-primary" href="/classroom/edit/id/{{$classroom->id}}" role="button"><i
                        class="bi bi-pencil"></i> Редактировать</a>
            </div>
        </main>
    @endforeach

    <script>
        let classroom = (function () {
            let csrfToken = "{{ csrf_token() }}";
            return {
                delete: function (id) {
                    if (confirm("Внимание! будет удален класс. Продолжить?")) {
                        $.post('/classroom/delete', {id: id, '_token': csrfToken}, function (res) {
                            if (res.hasOwnProperty('status') && res.status === "ok") {
                                location.href = '/classroom';
                            }
                        });
                    }
                }
            }
        })();

    </script>

</x-app-layout>


