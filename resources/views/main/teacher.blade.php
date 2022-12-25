<x-app-layout>
    <div class="container">
        <nav class="navbar bg-blue">
            <div class="container-fluid">
                <a class="navbar-brand text-white" href="#">Расписания классов</a>
            </div>
        </nav>
    </div>

    <div class="container">
        <div class="bg-light p-4 rounded mt-4">
            <a class="btn btn-primary" href="/schedule/add" role="button">Создать расписание</a>
        </div>
    </div>

    <div class="container">
        <div class="bg-light p-4 rounded mt-3">
            <h3>5А класс</h3>
            <p class="lead">Учеников в классе: 21</p>
            <a class="btn btn-secondary" href="/" role="button">
                <i class="bi bi-pencil"></i> Редактировать</a>
        </div>
    </div>


</x-app-layout>
