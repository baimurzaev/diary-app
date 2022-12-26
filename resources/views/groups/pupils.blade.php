<h3>Ученики <sup>{{$count}}</sup></h3>
<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Ф.И.О.</th>
        <th scope="col">E-Mail</th>
    </tr>
    </thead>
    <tbody>
    @foreach($pupils as $key => $pupil)
        <tr>
            <th scope="row">{{++$key}}</th>
            <td>{{$pupil->last_name}} {{$pupil->name}} {{$pupil->middle_name}}</td>
            <td>{{$pupil->email}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
