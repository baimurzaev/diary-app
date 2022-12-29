<x-guest-layout>
    <div class="text-center">
        <main class="form-register w-100 m-auto">
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')"/>

            <form method="POST" action="{{ route('register') }}">
                @csrf
                <img class="mb-4" src="/svg/logo.svg" alt="" width="90">
                <h1 class="h4 mb-3 fw-normal">Регистрация</h1>
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors"/>
                <!-- Name -->
                <div class="form-floating border-first">
                    <input type="text" name="name" class="form-control" id="userName" placeholder="Имя"/>
                    <label for="userName">Имя</label>
                </div>
                <!-- Name -->
                <div class="form-floating border-first">
                    <input type="text" name="last_name" class="form-control" id="userLastName" placeholder="Фамилия"/>
                    <label for="userLastName">Фамилия</label>
                </div>

                <!-- Email -->
                <div class="form-floating border-middle">
                    <input type="email" name="email" class="form-control" id="userEmail" placeholder="name@example.ru"/>
                    <label for="userEmail">Email</label>
                </div>
                <div class="form-floating border-middle">
                    <select name="group_id"  class="form-control"  id="accountType">
                        <option value="1" selected>Я учитель</option>
                        <option value="2">Я ученик</option>
                    </select>
                    <label for="accountType">Тип аккаунта</label>
                </div>
                <!-- Password -->
                <div class="form-floating border-middle">
                    <input type="password" class="form-control" name="password" id="password" placeholder="Пароль"/>
                    <label for="password">Пароль</label>
                </div>
                <!-- Confirm Password -->
                <div class="form-floating border-last">
                    <input type="password" name="password_confirmation" class="form-control"
                           id="passwordConfirmation" placeholder="Повторите пароль"/>
                    <label for="passwordConfirmation">Повторите пароль</label>
                </div>

                <button class="w-100 btn btn-lg btn-primary" type="submit">Зарегистрироваться</button>

                <div class="mt-3 mb-3 text-center"><a href="/login">Войти</a></div>

                <p class="mt-5 mb-3 text-muted">&copy; <?= date('Y') ?> Электронный дневник</p>
            </form>
        </main>
    </div>
</x-guest-layout>
