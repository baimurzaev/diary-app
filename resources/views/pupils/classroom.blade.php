<div class="float-end">
    <div class="dropdown">
        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                aria-expanded="false">
            Выбрать расписание
        </button>
        <ul class="dropdown-menu">
            @foreach($schedules as $id=>$name)
                <li><a class="dropdown-item" href="javascript:" onclick="pupils.addSchedule({{$id}})">{{$name}}</a></li>
            @endforeach
        </ul>
    </div>
</div>
<h3>Ученики <sup>{{$count}}</sup></h3>
<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Ф.И.О.</th>
        <th scope="col">E-Mail</th>
        <th scope="col"></th>
        <th scope="col"></th>
        <th>Группа</th>
    </tr>
    <tr>
        <th scope="col"></th>
        <th scope="col"></th>
        <th scope="col"></th>
        <th scope="col"></th>
        <th scope="col"></th>
        <th><input type="checkbox" class="form-check-input" onclick="classroom.checkAll(this)"/></th>
    </tr>
    </thead>
    <tbody>
    @foreach($pupils as $key => $pupil)
        <tr>
            <th scope="row">{{++$key}}</th>
            <td>{{$pupil->last_name}} {{$pupil->name}} {{$pupil->middle_name}}</td>
            <td>{{$pupil->email}}</td>
            <td>
                @if($pupil->schedule_id>0)
                    <div class="border p-2" style="border-radius: 10px">{{$schedules[$pupil->schedule_id]}}</div>
                @endif
            </td>
            <td>
                <button class="btn btn-sm btn-danger"
                        onclick="pupils.unlink({{$pupil->user_id}},{{$pupil->classroom_id}})" role="button"><i
                        class="bi bi-trash"></i></button>
            </td>
            <td>
                <input class="userGroup form-check-input" type="checkbox" data-user-id="{{$pupil->id}}"/>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
