# Запуск приложения локально

1. Скопировать файл .env в .env.local. При необходимости изменить дефолтные значения
2. Выполнить make start
3. Подождать, пока отработает composer  (контейнер symfony_composer должен перейти в статус exit. Меньше минуты, но тем не менее)
4. При дефолтных настройках стартовая страница приложения будет доступна по адресу http://localhost:8005/
5. Выполнить make test