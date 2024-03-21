# backend_test_task - RESTful API сервис

В данном сервисе реализованы RESTful API операции для одной сущности - Post, который обладает атрибутами: ID, Заголовок, Дата публикации/обновления, Текст.

- Получение списка постов `GET /api/posts`
- Получение конкретного поста `GET /api/posts/{post}`
- Создание поста `POST /api/posts`
- Изменение поста `PUT /api/posts/{post}`
- Удаление поста `DELETE /api/posts/{post}`

# Установка
### Клонируйте репозиторий:
```
git clone git@github.com:frangon403/backend-test-task.git
cd backend-test-task
```

### .env

- Теперь скопируйте файл .env.example в .env:
```
cp .env.example .env
```

### Docker

- Установите [Docker](https://www.docker.com/).

- Запустите контейнеры Docker, из файла `docker-compose.yml`:
```
docker-compose up --build -d
```
- Запустите контейнер в режиме bash, так вы получите доступ к интерактивному терминалу внутри контейнера:
```
docker exec -it Laravel_php /bin/sh
``` 
- Внутри этого контейнера теперь вы можете запускать все команды так, как если бы вы находились в локальной среде:

Теперь ваш терминал должен выглядеть подобным образом:
```
/var/www/html # *some command here*
```
### Composer
- Установите зависимости composer:
 ```
composer install
 ```

### Laravel:
- Сгенерируйте новый ключ приложения:
```
php artisan key:generate
```
- Сгенерируйте JWT ключ:
```
php artisan jwt:secret
```

##### DB
- Примените миграции:
```
php artisan migrate
```
- Заполните таблицы данными:
```
php artisan db:seed
```

Теперь ты можешь зайти на [http://localhost:8000](http://localhost:8000) и увидеть сайт.

### Postman 

- Для отправки POST, PUT, DELETE запросов потребуется [Postman](https://www.postman.com/) или любой другой REST client.

### Token

По умолчанию доступ к API получаем через token, для простоты использования можете отключить это:
- Для этого перейдите в папку проекта backend-test-task/routes/api.php.
- В файле api.php на 41 строке удалите middleware: 'middleware' => 'jwt.auth'

Получение токена:

- Для получение токена нужно отправить `POST` запрос по адресу: 
```
http://127.0.0.1:8000/api/auth/login?email=User@gmail.com&password=password
```
- Скопируйте access_token
- В Postman перейдите во вкладку Authorization
- В Type выберите Bearer Token
- Вставте полученный access_token в поле Token, см. пример ниже:


![Posman-token](Posman-token.PNG)

Теперь вы можете отправять запросы к API.

Пример ответа:
```
{
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL2F1dGgvbG9naW4iLCJpYXQiOjE3MTA5NDg1MzIsImV4cCI6MTcxMDk1MjEzMiwibmJmIjoxNzEwOTQ4NTMyLCJqdGkiOiJjM0t3cjdPbEdibUZFQWFiIiwic3ViIjoiMSIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.6GE3Wh2FhrgwRNsi8cfPqZS4Dbx-LkCVOA_EGrkPueE",
    "token_type": "bearer",
    "expires_in": 3600
}
```



### Примеры для отправки запросов:
#### GET
- Получение списка постов: http://localhost:8000/api/posts/


```
        {
            "id": 1,
            "title": "Mr.",
            "updated_at": "2024-03-19T16:10:24.000000Z",
            "created_at": "2024-03-19T16:10:24.000000Z",
            "content": "Quasi illo ullam."
        },
        {
            "id": 2,
            "title": "Dr.",
            "updated_at": "2024-03-19T16:10:24.000000Z",
            "created_at": "2024-03-19T16:10:24.000000Z",
            "content": "Eveniet aut minus."
        },
        {
            "id": 3,
            "title": "Ms.",
            "updated_at": "2024-03-19T16:10:24.000000Z",
            "created_at": "2024-03-19T16:10:24.000000Z",
            "content": "Itaque fugiat."
        },
```

- Получение конкретного поста: http://localhost:8000/api/posts/1:

```
    {
        "id": 1,
        "title": "Mr.",
        "updated_at": "2024-03-19T16:10:24.000000Z",
        "created_at": "2024-03-19T16:10:24.000000Z",
        "content": "Quasi illo ullam."
    }

```
#### POST
- Создание поста: http://localhost:8000/api/posts/:
###### Тело запроса:
```
{
    "title": "New title",
    "content": "New content"
}
```
###### Тело ответа:
```
    {
        "id": 11,
        "title": "New title",
        "updated_at": "2024-03-19T16:22:55.000000Z",
        "created_at": "2024-03-19T16:22:55.000000Z",
        "content": "New content"
    }

```
#### PUT
- Изменение поста: http://localhost:8000/api/posts/11:
###### Тело запроса:
```
{
    "content": "Put content"
}
```
###### Тело ответа:
```
    {
        "id": 11,
        "title": "New title",
        "updated_at": "2024-03-19T16:25:09.000000Z",
        "created_at": "2024-03-19T16:22:55.000000Z",
        "content": "Put content"
    }

```
#### DELETE
- Удаление посла: http://localhost:8000/api/posts/11:

```
    {
        "id": 11,
        "title": "New title",
        "updated_at": "2024-03-19T16:25:09.000000Z",
        "created_at": "2024-03-19T16:22:55.000000Z",
        "content": "Put content"
    }

```






