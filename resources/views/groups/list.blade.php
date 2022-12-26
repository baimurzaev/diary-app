<x-app-layout>
    <div class="container">
        <nav class="navbar bg-blue">
            <div class="container-fluid">
                <a class="navbar-brand text-white" href="#">Список групп</a>
            </div>
        </nav>
    </div>

    <div class="container">
        <div class="bg-light p-4 rounded mt-4">
            <a class="btn btn-primary" href="/groups/add" role="button">Создать группу</a>
        </div>
    </div>

    {{--    @dd($groups);--}}
    @foreach($groups as $group)
        <div class="container">
            <div class="bg-light p-4 rounded mt-4">
                <h3>{{$group->name}}</h3>
                <p class="">Учеников в группе: {{$group->pupils_count}}</p>
                <a class="btn btn-danger" href="javascript:" onclick="group.delete({{$group->id}})"
                   role="button"><i class="bi bi-trash"></i></a>
                <a class="btn btn-secondary" href="/groups/edit/id/{{$group->id}}" role="button"><i
                        class="bi bi-pencil"></i></a>
            </div>
        </div>
    @endforeach

    <script>
        let group = (function () {
            let csrfToken = "{{ csrf_token() }}";
            return {
                delete: function (id) {
                    if (confirm("Эта группа будет удалена. Продолжить?")) {
                        $.post('/groups/delete', {id: id, '_token': csrfToken}, function (res) {
                            if (res.hasOwnProperty('status') && res.status === "ok") {
                                location.href = '/groups';
                            }
                        });
                    }
                }
            }
        })();

    </script>
</x-app-layout>
