<x-app-layout>
    <div class="container">
        <nav class="navbar bg-blue">
            <div class="container-fluid">
                <a class="navbar-brand text-white" href="#">Создание группы</a>
            </div>
        </nav>
    </div>

    <main class="container">
        <form method="post" action="/groups/add">
            @csrf
            <div class="bg-light p-4 rounded mt-3">

                <div class="col-5">
                    <div class="form-floating mb-3">
                        <input type="text" name="name" class="form-control" id="floatingInput"
                               placeholder="Название класса">
                        <label for="floatingInput">Название группы</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-success" role="button">Создать</button>
            </div>
        </form>
    </main>

</x-app-layout>
