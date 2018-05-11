# Lumen PHP Framework

[![Build Status](https://travis-ci.org/laravel/lumen-framework.svg)](https://travis-ci.org/laravel/lumen-framework)
[![Total Downloads](https://poser.pugx.org/laravel/lumen-framework/d/total.svg)](https://packagist.org/packages/laravel/lumen-framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/lumen-framework/v/stable.svg)](https://packagist.org/packages/laravel/lumen-framework)
[![Latest Unstable Version](https://poser.pugx.org/laravel/lumen-framework/v/unstable.svg)](https://packagist.org/packages/laravel/lumen-framework)
[![License](https://poser.pugx.org/laravel/lumen-framework/license.svg)](https://packagist.org/packages/laravel/lumen-framework)

Laravel Lumen is a stunningly fast PHP micro-framework for building web applications with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Lumen attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as routing, database abstraction, queueing, and caching.

Documentation for the framework can be found on the [Lumen website](http://lumen.laravel.com/docs).

# Lumen User API Documentation

Lumen User API is example API application of User Management which built with Lumen.

## How to Run

```
$ composer install
$ php artisan migrate:refresh --seed
$ php artisan serve --host=localhost --port=8000
```

## API List

Note:
- `user_id` field is **required**, because it would be the value of `created_by` and `updated_by` fields.  

### Get All Users

```
Method      : GET

URL         : /user?page=1&name=&email=
Response    : 
{
    "current_page": 1,
    "data": [
        {
            "id": 1,
            "email": "admin@bpm.com",
            "name": "Administrator",
            "is_active": 1,
            "is_admin": 1
        },
        {
            "id": 6,
            "email": "admin2@bpm.com",
            "name": "Administrator",
            "is_active": 1,
            "is_admin": 0
        }
    ],
    "first_page_url": "http://localhost:8000/user?page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "http://localhost:8000/user?page=1",
    "next_page_url": null,
    "path": "http://localhost:8000/user",
    "per_page": 10,
    "prev_page_url": null,
    "to": 2,
    "total": 2
}
```

### Get User By ID
```
Method      : GET

URL         : /user/{id}
Response    : 
{
    "status": true,
    "messages": [],
    "data": {
        "id": 1,
        "email": "admin@bpm.com",
        "name": "Administrator",
        "is_active": 1,
        "is_admin": 1
    }
}
```

### Create User
```
Method      : POST

URL         : /user
Body        :
{
	"email": "admin2@bpm.com",
	"password": "bsp123!!",
	"name": "Administrator",
	"is_admin": false,
	"user_id": 1
}
Response    : 
{
    "status": true,
    "messages": []
}
```

### Update User By ID
```
Method      : PUT

URL         : /user/{id}
Body        :
{
	"email": "admin@bpm.com",
	"name": "Administrator",
	"is_admin": true,
	"user_id": 1
}
Response    : 
{
    "status": true,
    "messages": []
}
```

### Delete User By ID
```
Method      : DELETE

URL         : /user/{id}
Response    : 
{
    "status": true,
    "messages": []
}
```

### Get All Users As Array (For Combobox)
```
Method      : GET

URL         : /user/combo?q=
Response    : 
{
    "status": true,
    "messages": [],
    "data": [
        {
            "id": 1,
            "name": "Administrator"
        },
        {
            "id": 6,
            "name": "Administrator 6"
        }
    ]
}
```

### Block User By ID
```
Method      : PUT

URL         : /user/block/{id}
Response    : 
{
    "status": true,
    "messages": []
}
```

### Unblock User By ID
```
Method      : PUT

URL         : /user/block/{id}
Response    : 
{
    "status": true,
    "messages": []
}
```

### Change User Password By ID
```
Method      : PUT

URL         : /user/change-password/{id}
Response    :
{
	"password": "<your current password>",
	"new_password": "<your new password>",
	"confirm_password": "<your new password>",
	"user_id": 1
}
Response    : 
{
    "status": true,
    "messages": []
}
```