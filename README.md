# job-vacancies-api-example

## Backend Project Setup
```
* clone project repositroy
* cd into root directory
* RUN: docker-compose build
* RUN: docker-compose up
* RUN: php artisan migrate
* RUN: php artisan db:seed

```

### Test Backend API Requests
```
Make http requests using your choice of API tool (I tend to use Postman)
Endpoint: http://localhost:8082/api

* List Vacancies : http://localhost:8082/api/list_vacancies (Method GET)
* Add Vacancies: http://localhost:8082/api/add_vacancy?title=New Job&description=New Description&location=test location&salary=100000.00 (Method Post)
* Update Vacancies: http://localhost:8082/api/update_vacancy?id=31&title=Test Job&description=New Description&location=text 2&salary=20000.00 (Method POST)
* Delete Vacancies: http://localhost:8082/api/delete_vacancy?id=31 (Method POST)
* Search Vacancies: http://localhost:8082/api/search_vacancy?location=Rosebury (Method Post)

```


## Frontend Project setup
```
npm install
```

### Compiles Frontend and hot-reloads for development
```
npm run serve
```

### Compiles Frontend and minifies for production
```
npm run build
```

### Frontend lints and fixes files
```
npm run lint
```


