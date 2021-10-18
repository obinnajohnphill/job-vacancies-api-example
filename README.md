# job-vacancies-api-example

## Project Setup
```
* clone project repositroy
```

### Backend  Setup
```
* cd into backend directory
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
* Filter Vacancies: http://localhost:8082/api/filter_vacancy?keyword=Rosebury (Method Post)

```


### Frontend Project setup
```
* cd into frontend directory
* RUN: npm install
```

### Compiles Frontend and hot-reloads for development
```
* RUN: npm run serve
* Navigate to url: http://localhost:8081/
```

### Compiles Frontend and minifies for production
```
* RUN: npm run build
* Copy files from dist directory onto your production server 

```



