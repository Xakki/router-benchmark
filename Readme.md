
## Результат тестов

Запущено в докере `make up`
* Ноутбук
* Процессор: 13th Gen Intel(R) Core(TM) i9-13980HX   2.40 GHz
* ОЗУ: 16,0 ГБ

Верхний график показывает сумму затраченного времени (1/млрд. часть секунды)
* requestTime9Sum - сумма времени затраченная на весь 1 запрос целиком
* phpTime9Sum - время затраченное на работу скрипта php
* requestTime9Avg - среднее вермя на весь 1 запрос целиком
* phpTime9Avg - среднее время на работу скрипта php

![Результат тестов](result/per1000request.png "По 1000 запросов")

## Виды тестов

* test#1 - Тестируем роутинг на массивах
* test#2 - роутинг на конструкции match
* test#3 - роутинг через библиотеку AltoRouter

## Запуск тестов локально

Для начала запустить `make up`

Открыть http://localhost:8080/index.php и нажать кнопку `Start`

На 8080 порту - FPM.  На 8081 порту - RoadRunner.


Через фаил test.http можно проверять запросы

## Memory usage

FPM Memory
* test#1 - 2097152
* test#2 - 2097152
* test#3 - 2118124

RoadRunner Memory
* test#1 - 2097152
* test#2 - 2097152
* test#3 - 4194304


## Используемые либы

Графики отсюда - https://www.chartjs.org/docs/latest/configuration/

ООП библиотека для роутинга - https://github.com/dannyvankooten/AltoRouter

