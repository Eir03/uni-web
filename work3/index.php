<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Авторизация и Регистрация</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
  <div id="formContainer" class="w-full max-w-md p-8 bg-white shadow-lg rounded-lg">
    <!-- Форма входа -->
    <form id="loginForm" class="space-y-4" method="POST" action="login.php">
      <h2 class="text-2xl font-bold mb-6 text-center">Вход</h2>
      <div>
        <label for="login" class="block text-sm font-medium text-gray-700">Логин</label>
        <input type="text" id="login" name="login" required
          class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
      </div>
      <div>
        <label for="password" class="block text-sm font-medium text-gray-700">Пароль</label>
        <input type="password" id="password" name="password" required
          class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
      </div>
      <div>
        <label class="flex items-center">
          <input type="checkbox" name="remember" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
          <span class="ml-2 text-sm text-gray-700">Запомнить меня</span>
        </label>
      </div>
      <button type="submit"
        class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg shadow-lg hover:bg-blue-700 focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
        Войти
      </button>
      <p class="text-sm text-center mt-4">
        Нет аккаунта? 
        <a href="#" id="switchToRegister" class="text-blue-600 hover:underline">Зарегистрироваться</a>
      </p>
    </form>

    <!-- Форма регистрации -->
    <form id="registerForm" class="space-y-4 hidden" method="POST" action="register.php">
      <h2 class="text-2xl font-bold mb-6 text-center">Регистрация</h2>
      <div>
        <label for="regLogin" class="block text-sm font-medium text-gray-700">Логин</label>
        <input type="text" id="regLogin" name="login" required
          class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
          pattern="^[a-zA-Z0-9_-]+$" title="Допустимы латинские буквы, цифры, подчеркивания и тире">
      </div>
      <div>
        <label for="regPassword" class="block text-sm font-medium text-gray-700">Пароль</label>
        <input type="password" id="regPassword" name="password" required
          class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
          minlength="6" title="Пароль должен быть не менее 6 символов">
      </div>
      <div>
        <label class="flex items-center">
          <input type="checkbox" name="saveData" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
          <span class="ml-2 text-sm text-gray-700">Сохранить данные</span>
        </label>
      </div>
      <button type="submit"
        class="w-full bg-green-600 text-white py-2 px-4 rounded-lg shadow-lg hover:bg-green-700 focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
        Зарегистрироваться
      </button>
      <p class="text-sm text-center mt-4">
        Уже есть аккаунт? 
        <a href="#" id="switchToLogin" class="text-blue-600 hover:underline">Войти</a>
      </p>
    </form>
  </div>

  <script>
    const loginForm = document.getElementById('loginForm');
    const registerForm = document.getElementById('registerForm');
    const switchToRegister = document.getElementById('switchToRegister');
    const switchToLogin = document.getElementById('switchToLogin');

    switchToRegister.addEventListener('click', (e) => {
      e.preventDefault();
      loginForm.classList.add('hidden');
      registerForm.classList.remove('hidden');
    });

    switchToLogin.addEventListener('click', (e) => {
      e.preventDefault();
      registerForm.classList.add('hidden');
      loginForm.classList.remove('hidden');
    });
  </script>
</body>
</html>
