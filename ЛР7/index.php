<!doctype html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Агаев Арслан 241-353 ЛР-7 Вариант 1</title>
  <link rel="stylesheet" href="styles.css">
  <style>
    /* Дополнительные стили для формы */
    .input-group {
      display: flex;
      align-items: center;
      margin-bottom: 12px;
      gap: 10px;
      justify-content: center;
    }

    .element-number {
      font-weight: bold;
      min-width: 40px;
      color: #0a2f1f;
      text-align: right;
    }

    .array-input {
      padding: 8px 12px;
      border: 1px solid #cbdcd2;
      border-radius: 8px;
      font-size: 16px;
      width: 150px;
      text-align: center;
    }

    .array-input:focus {
      outline: 2px solid #0a2f1f;
      border-color: transparent;
    }

    .form-container {
      background: white;
      padding: 30px;
      border-radius: 25px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
      max-width: 500px;
      margin: 0 auto;
    }

    select {
      padding: 10px 15px;
      border-radius: 30px;
      border: 1px solid #0a2f1f;
      background: white;
      font-size: 16px;
      margin: 20px 0;
      width: 100%;
      cursor: pointer;
    }

    .btn {
      background: #0a2f1f;
      color: white;
      border: none;
      padding: 12px 24px;
      border-radius: 40px;
      font-size: 16px;
      font-weight: bold;
      cursor: pointer;
      margin: 8px 5px;
      transition: all 0.2s;
      border: 1px solid transparent;
    }

    .btn-secondary {
      background: white;
      color: #0a2f1f;
      border: 1px solid #0a2f1f;
    }

    .btn:hover {
      transform: scale(1.02);
      opacity: 0.9;
    }

    #arrayFields {
      margin: 25px 0;
    }
  </style>
</head>

<body>
  <header>
    <img src="./logo.png" alt="" width="90">
    <span>Агаев Арслан 241-353 ЛР-7 Вариант 1</span>
  </header>

  <main>
    <h1>⚙️ Сортировка массива</h1>
    <div class="form-container">
      <form id="sortForm" action="sort.php" method="POST" target="_blank">
        <div id="arrayFields">
          <!-- Начальное поле с номером 1 -->
          <div class="input-group">
            <span class="element-number">[1]</span>
            <input type="text" name="array[]" class="array-input" placeholder="Число" value="">
          </div>
        </div>

        <select name="algorithm" required>
          <option value="">-- Выберите алгоритм --</option>
          <option value="selection">Сортировка выбором</option>
          <option value="bubble">Пузырьковый алгоритм</option>
          <option value="shell">Алгоритм Шелла</option>
          <option value="gnome">Алгоритм садового гнома</option>
          <option value="quick">Быстрая сортировка</option>
          <option value="php">Встроенная функция PHP (sort)</option>
        </select>

        <div>
          <button type="button" class="btn btn-secondary" id="addFieldBtn">➕ Добавить элемент</button>
          <button type="submit" class="btn">🚀 Сортировать массив</button>
        </div>
      </form>
    </div>
  </main>

  <footer>@copyright 2026</footer>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const arrayFields = document.getElementById('arrayFields');
      const addButton = document.getElementById('addFieldBtn');

      // Функция для обновления номеров полей
      function updateFieldNumbers() {
        const groups = arrayFields.querySelectorAll('.input-group');
        groups.forEach((group, index) => {
          const numberSpan = group.querySelector('.element-number');
          if (numberSpan) {
            numberSpan.textContent = `[${index + 1}]`;
          }
        });
      }

      // Добавление нового поля
      addButton.addEventListener('click', function() {
        const currentCount = arrayFields.children.length;
        const newGroup = document.createElement('div');
        newGroup.className = 'input-group';
        newGroup.innerHTML = `
          <span class="element-number">[${currentCount + 1}]</span>
          <input type="text" name="array[]" class="array-input" placeholder="Число" value="">
        `;
        arrayFields.appendChild(newGroup);
      });

      // Валидация перед отправкой (опционально, но предупредим о пустых полях)
      document.getElementById('sortForm').addEventListener('submit', function(e) {
        const inputs = document.querySelectorAll('input[name="array[]"]');
        let hasValue = false;
        inputs.forEach(input => {
          if (input.value.trim() !== '') hasValue = true;
        });

        if (!hasValue) {
          if (!confirm('Вы не ввели ни одного числа. Продолжить (будет выведено предупреждение)?')) {
            e.preventDefault();
          }
        }
      });
    });
  </script>
</body>

</html>