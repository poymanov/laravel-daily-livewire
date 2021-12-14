# Laravel Daily - Livewire

Приложение для демонстрации использования функционала [Laravel Livewire](https://laravel-livewire.com/) в качестве быстрой замены решениям на JavaScript.

Подробности в [документации](docs/README.md).

### Установка

Для запуска приложения требуется **Docker** и **Docker Compose**.

Для инициализации приложения выполнить команду:

```
make init
```

Для наполнения тестовыми данными выполнить команду:

```
make backend-seed
```

### Управление

Запуск:

```
make up
```

Остановка приложения:

```
make down
```

### Интерфейсы

Приложение - http://localhost:8080

### Тесты

```
make backend-test
```

### Цель проекта

Код написан в образовательных целях в рамках курса [Practical Laravel Livewire from Scratch](https://laraveldaily.teachable.com/p/practical-laravel-livewire-from-scratch).
