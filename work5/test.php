<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Тест по основам веб-программирования</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 py-10">
  <div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-lg">
    <h1 class="text-2xl font-bold text-center mb-6">Тест по основам веб-программирования</h1>
    <form id="testForm" class="grid grid-cols-1 md:grid-cols-2 gap-8" onsubmit="return checkTest(event)">
      
      <!-- Вопрос 1: Радиокнопки -->
      <div>
        <p class="block text-lg font-medium text-gray-700">1. Как расшифровывается HTML?</p>
        <div class="mt-2 space-y-2">
          <label class="block">
            <input type="radio" name="q1" value="HyperText Markup Language" class="mr-2"> HyperText Markup Language
          </label>
          <label class="block">
            <input type="radio" name="q1" value="HighText Machine Language" class="mr-2"> HighText Machine Language
          </label>
          <label class="block">
            <input type="radio" name="q1" value="Hyperlink Text Manager" class="mr-2"> Hyperlink Text Manager
          </label>
        </div>
      </div>

      <!-- Вопрос 2: Выпадающий список -->
      <div>
        <label for="q2" class="block text-lg font-medium text-gray-700">2. Какой тег используется для создания ссылки?</label>
        <select id="q2" name="q2" 
          class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
          <option value="">Выберите ответ</option>
          <option value="a">&lt;a&gt;</option>
          <option value="link">&lt;link&gt;</option>
          <option value="href">&lt;href&gt;</option>
        </select>
      </div>

      <!-- Вопрос 3: Чекбоксы -->
      <div>
        <p class="block text-lg font-medium text-gray-700">3. Какие из перечисленных являются языками программирования?</p>
        <div class="mt-2 space-y-2">
          <label class="block">
            <input type="checkbox" name="q3[]" value="html" class="mr-2"> HTML
          </label>
          <label class="block">
            <input type="checkbox" name="q3[]" value="javascript" class="mr-2"> JavaScript
          </label>
          <label class="block">
            <input type="checkbox" name="q3[]" value="css" class="mr-2"> CSS
          </label>
          <label class="block">
            <input type="checkbox" name="q3[]" value="python" class="mr-2"> Python
          </label>
        </div>
      </div>

      <!-- Вопрос 4: Выпадающий список -->
      <div>
        <label for="q4" class="block text-lg font-medium text-gray-700">4. Какой HTTP-метод используется для отправки данных формы?</label>
        <select id="q4" name="q4" 
          class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
          <option value="">Выберите ответ</option>
          <option value="get">GET</option>
          <option value="post">POST</option>
          <option value="put">PUT</option>
          <option value="delete">DELETE</option>
        </select>
      </div>

      <!-- Вопрос 5: Радиокнопки -->
      <div>
        <p class="block text-lg font-medium text-gray-700">5. Какой язык используется для описания стилей?</p>
        <div class="mt-2 space-y-2">
          <label class="block">
            <input type="radio" name="q5" value="CSS" class="mr-2"> CSS
          </label>
          <label class="block">
            <input type="radio" name="q5" value="HTML" class="mr-2"> HTML
          </label>
          <label class="block">
            <input type="radio" name="q5" value="JavaScript" class="mr-2"> JavaScript
          </label>
        </div>
      </div>

      <!-- Вопрос 6: Радиокнопки -->
      <div>
        <p class="block text-lg font-medium text-gray-700">6. Какой порт используется по умолчанию для HTTP?</p>
        <div class="mt-2 space-y-2">
          <label class="block">
            <input type="radio" name="q6" value="80" class="mr-2"> 80
          </label>
          <label class="block">
            <input type="radio" name="q6" value="443" class="mr-2"> 443
          </label>
          <label class="block">
            <input type="radio" name="q6" value="21" class="mr-2"> 21
          </label>
        </div>
      </div>

      <!-- Кнопка отправки -->
      <div class="md:col-span-2 text-center">
        <button type="submit" 
          class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
          Отправить
        </button>
      </div>
    </form>

    <!-- Результаты -->
    <div id="results" class="hidden mt-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg"></div>
  </div>

  <script>
    function checkTest(event) {
      event.preventDefault();

      const correctAnswers = {
        q1: "HyperText Markup Language",
        q2: "a",
        q3: ["javascript", "python"],
        q4: "post",
        q5: "CSS",
        q6: "80"
      };

      const form = document.getElementById('testForm');
      const resultsDiv = document.getElementById('results');
      let correctCount = 0;
      let wrongCount = 0;
      let wrongAnswers = [];

      // Проверка радиокнопок и выпадающих списков
      for (let key of ["q1", "q2", "q4", "q5", "q6"]) {
        if (form[key].value === correctAnswers[key]) {
          correctCount++;
        } else {
          wrongCount++;
          wrongAnswers.push(key.slice(1));
        }
      }

      // Проверка чекбоксов
      const q3Checked = Array.from(form["q3[]"]).filter(input => input.checked).map(input => input.value);
      if (JSON.stringify(q3Checked.sort()) === JSON.stringify(correctAnswers.q3.sort())) {
        correctCount++;
      } else {
        wrongCount++;
        wrongAnswers.push("3");
      }

      // Вывод результатов
      resultsDiv.innerHTML = `
        <p>Правильных ответов: <strong>${correctCount}</strong></p>
        <p>Неправильных ответов: <strong>${wrongCount}</strong></p>
        <p>Ошибки в вопросах: <strong>${wrongAnswers.join(", ") || "Нет"}</strong></p>
      `;
      resultsDiv.classList.remove('hidden');
    }
  </script>
</body>
</html>
