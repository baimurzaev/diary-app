<x-guest-layout>
    <div class="text-center ">
        <main class="form-signin w-100 m-auto">
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')"/>

            <form action="{{ route('login') }}" method="post">
                @csrf
                <img class="mb-4" src="/svg/logo.svg" alt="" width="90">
                <h1 class="h4 mb-3 fw-normal">Вход в электронный дневник</h1>
                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors"/>
                <div class="form-floating border-first">
                    <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.ru">
                    <label for="floatingInput">Email</label>
                </div>
                <div class="form-floating border-last">
                    <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Пароль">
                    <label for="floatingPassword">Пароль</label>
                </div>

                <div class="checkbox mb-3">
                    <label>
                        <input type="checkbox" id="remember-me" value="remember-me" name="remember"> Запомнить меня
                    </label>
                </div>
                <button class="w-100 btn btn-lg btn-primary" type="submit">Войти</button>

                <div class="mt-3 mb-3 text-center"><a href="/register">Регистрация</a></div>

                <p class="mt-5 mb-3 text-muted">&copy; <?= date('Y') ?> Электронный дневник</p>
            </form>
        </main>
    </div>
</x-guest-layout>
