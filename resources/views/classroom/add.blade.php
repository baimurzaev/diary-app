<x-app-layout>
    <div class="container">
        <nav class="navbar bg-blue">
            <div class="container-fluid">
                <a class="navbar-brand text-white" href="#">Добавление класса</a>
            </div>
        </nav>
    </div>

    <main class="container">
        <form method="post" action="/classroom/add">
            @csrf
            <div class="bg-light p-5 rounded mt-3">
                <div class="container">
                    <div class="col-5">
                        <div class="form-floating mb-3">
                            <input type="text" name="name" class="form-control" id="floatingInput" placeholder="Название класса">
                            <label for="floatingInput">Название класса</label>
                        </div>
                    </div>
                </div>

                <br>
                <a class="btn btn-primary" href="javascript:history.back()" role="button">&laquo; вернуться назад</a>
                <button type="submit" class="btn btn-success" role="button">Сохранить &raquo;</button>
            </div>
        </form>
    </main>

</x-app-layout>
