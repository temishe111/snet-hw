# Запуск приложения локально

1. Скопировать файл .env в .env.local. При необходимости изменить дефолтные значения
2. Выполнить make start
3. Подождать, пока отработает composer  (контейнер symfony_composer должен перейти в статус exit. Меньше минуты, но тем не менее)
4. При дефолтных настройках стартовая страница приложения будет доступна по адресу http://localhost:8005/
5. Выполнить make test

Домашнее задание
Заготовка для социальной сети

Цель:
В результате выполнения ДЗ вы создадите базовый скелет социальной сети, который будет развиваться в дальнейших ДЗ.
В данном задании тренируются навыки:

декомпозиции предметной области;
построения элементарной архитектуры проекта

Описание/Пошаговая инструкция выполнения домашнего задания:
Требуется разработать создание и просмотр анкет в социальной сети.

Функциональные требования:

Простейшая авторизация пользователя.
Возможность создания пользователя, где указывается следующая информация:
Имя
Фамилия
Дата рождения
Пол
Интересы
Город
Страницы с анкетой.

Нефункциональные требования:

Любой язык программирования
В качестве базы данных использовать PostgreSQL (при желании и необходимости любую другую SQL БД)
Не использовать ORM
Программа должна представлять из себя монолитное приложение.
Не рекомендуется использовать следующие технологии:
Репликация
Шардирование
Индексы
Кэширование

Для удобства разработки и проверки задания можно воспользоваться этой спецификацией и реализовать в ней методы:
/login
/user/register
/user/get/{id}

Фронт опционален.

Сделать инструкцию по локальному запуску приложения, приложить Postman-коллекцию.

ДЗ принимается в виде исходного кода на github и Postman-коллекции.
