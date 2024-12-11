<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Регистрация участников</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
  <div class="container mx-auto py-8">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-lg mx-auto mb-8">
      <h1 class="text-2xl font-bold mb-6 text-center">Регистрация участников</h1>
      <form id="registrationForm" class="space-y-4">
        <div>
          <label for="fullName" class="block text-sm font-medium text-gray-700">Полное имя</label>
          <input 
            type="text" 
            id="fullName" 
            name="fullName" 
            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" 
            required 
            pattern="^[А-Яа-яЁё\s]+$" 
            placeholder="Иванов Иван Иванович"
          >
        </div>

        <div>
          <label for="phone" class="block text-sm font-medium text-gray-700">Контактный телефон</label>
          <input 
            type="tel" 
            id="phone" 
            name="phone" 
            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" 
            required 
            pattern="^\+7[0-9]{10}$" 
            placeholder="+71234567890"
          >
        </div>

        <div>
          <label for="email" class="block text-sm font-medium text-gray-700">Электронная почта</label>
          <input 
            type="email" 
            id="email" 
            name="email" 
            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" 
            required
          >
        </div>

        <div>
          <label for="section" class="block text-sm font-medium text-gray-700">Секция конференции</label>
          <select 
            id="section" 
            name="section" 
            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" 
            required
          >
            <option value="">Выберите секцию</option>
            <option value="math">Математика</option>
            <option value="physics">Физика</option>
            <option value="informatics">Информатика</option>
          </select>
        </div>

        <div>
          <label for="birthDate" class="block text-sm font-medium text-gray-700">Дата рождения</label>
          <input 
            type="date" 
            id="birthDate" 
            name="birthDate" 
            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
          >
        </div>

        <div class="flex items-center space-x-4">
          <label class="flex items-center">
            <input 
              type="checkbox" 
              id="hasReport" 
              name="hasReport" 
              class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
            >
            <span class="ml-2 text-sm text-gray-700">Доклад</span>
          </label>
        </div>

        <div id="reportTopicContainer" class="hidden">
          <label for="reportTopic" class="block text-sm font-medium text-gray-700">Тема доклада</label>
          <input 
            type="text" 
            id="reportTopic" 
            name="reportTopic" 
            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
            placeholder="Тема доклада"
          >
        </div>

        <button 
          type="submit" 
          class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg shadow-lg hover:bg-blue-700 focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
        >
          Отправить
        </button>
      </form>
    </div>

    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-3xl mx-auto">
      <h2 class="text-xl font-bold mb-4">Список участников</h2>
      <div class="overflow-x-auto">
        <table class="w-full table-auto border-collapse border border-gray-200">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-200 px-4 py-2 text-left">Полное имя</th>
                    <th class="border border-gray-200 px-4 py-2 text-left">Телефон</th>
                    <th class="border border-gray-200 px-4 py-2 text-left">Электронная почта</th>
                    <th class="border border-gray-200 px-4 py-2 text-left">Секция</th>
                    <th class="border border-gray-200 px-4 py-2 text-left">Доклад</th>
                </tr>
            </thead>
            <tbody id="participants-table-body">
                
            </tbody>
        </table>
      </div>
    </div>
  </div>

  <script>
    const form = document.getElementById('registrationForm');
    
    form.addEventListener('submit', async (event) => {
      event.preventDefault();

      const formData = new FormData(form);

      try {
        const response = await fetch('save_participant.php', {
          method: 'POST',
          body: formData,
        });

        if (response.ok) {
          fetchParticipants();
          form.reset();
        } else {
          alert('Произошла ошибка при регистрации участника.');
        }
      } catch (error) {
        console.error('Ошибка:', error);
        alert('Произошла ошибка. Попробуйте снова.');
      }
    });

    const hasReportCheckbox = document.getElementById('hasReport');
    const reportTopicContainer = document.getElementById('reportTopicContainer');

    hasReportCheckbox.addEventListener('change', () => {
      reportTopicContainer.classList.toggle('hidden', !hasReportCheckbox.checked);
    });

    function fetchParticipants() {
    fetch('get_participants.php')
      .then(response => response.json())
      .then(data => {
        const tbody = document.getElementById('participants-table-body');
        tbody.innerHTML = '';
        data.forEach(participant => {
          const row = document.createElement('tr');
          row.innerHTML = `
            <td class="border border-gray-200 px-4 py-2">${participant.fullName}</td>
            <td class="border border-gray-200 px-4 py-2">${participant.phone}</td>
            <td class="border border-gray-200 px-4 py-2">${participant.email}</td>
            <td class="border border-gray-200 px-4 py-2">${participant.section}</td>
            <td class="border border-gray-200 px-4 py-2">${participant.hasReport ? 'Да' : 'Нет'}</td>
          `;
          tbody.appendChild(row);
        });
      })
      .catch(error => console.error('Ошибка при загрузке участников:', error));
  }

  // Загружаем список участников при загрузке страницы
  document.addEventListener('DOMContentLoaded', fetchParticipants);
  </script>
</body>
</html>
