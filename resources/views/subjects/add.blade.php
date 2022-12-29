<x-app-layout>
    <div class="container">
        <nav class="navbar bg-blue">
            <div class="container-fluid">
                <a class="navbar-brand text-white" href="#">Создание предмета</a>
            </div>
        </nav>
    </div>

    <main class="container">
        <form method="post" action="/subject/add">
            @csrf
            <div class="bg-light p-4 rounded mt-3">
                <div class="col-5">
                    <div class="form-floating mb-3">
                        <input type="text" name="name" class="form-control" id="subjectName"
                               placeholder="Название предмета">
                        <label for="subjectName">Название предмета</label>
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-floating mb-3">
                        <input type="text" name="num_minutes" class="form-control" id="subjectMinutes"
                               placeholder="Название предмета">
                        <label for="subjectMinutes">Кол-во минут</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-success" role="button">Создать</button>
            </div>
        </form>
    </main>

</x-app-layout>
