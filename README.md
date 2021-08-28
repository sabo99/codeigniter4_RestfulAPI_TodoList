# API Specification

## Create User (Sign Up)

Request :

- Method : `POST`
- Endpoint : `/api/users`
- Header :
  - Content-Type : `application/json`
  - Accept : `application/json`
- Body :

```json
{
  "email": "string, unique",
  "password": "string, hash",
  "username": "string"
}
```

- Response :

```json
{
  "code": "number",
  "message": "string",
  "user": {
    "uid": "integer",
    "email": "string",
    "username": "string",
    "avatar": "string, isNull",
    "two_factor_auth": "integer",
    "create_at": "datetime"
  }
}
```

## Authentication (Sign In)

Request :

- Method : `POST`
- Endpoint : `/api/users/auth`
- Header :
  - Content-Type : `application/json`
  - Accept : `application/json`
- Body :

```json
{
  "emailOrUsername": "string, unique",
  "password": "string, hash"
}
```

- Response :

```json
{
  "code": "number",
  "message": "string",
  "user": {
    "uid": "integer",
    "email": "string",
    "username": "string",
    "avatar": "string, isNull",
    "two_factor_auth": "integer"
  }
}
```

## Forgot User Password

Request :

- Method : `GET`
- Endpoint : `/api/users/{email}/forgot`
- Header :
  - Content-Type : `application/json`
- Response :

```json
{
  "code": "number",
  "message": "string",
  "user": {
    "uid": "integer",
    "email": "string",
    "username": "string"
  }
}
```

## Get User

Request :

- Method : `GET`
- Endpoint : `/api/users/{uid}`
- Header :
  - Content-Type : `application/json`
- Response :

```json
{
  "code": "number",
  "message": "string",
  "user": {
    "email": "string",
    "username": "string",
    "two_factor_auth": "integer",
    "created_at": "datetime",
    "updated_at": "datetime"
  }
}
```

## Edit User

Request :

- Method : `GET`
- Endpoint : `/api/users/{uid}/edit`
- Header :
  - Content-Type : `application/json`
- Response :

```json
{
  "code": "number",
  "message": "string",
  "user": {
    "email": "string",
    "username": "string",
    "two_factor_auth": "integer",
    "create_at": "datetime",
    "update_at": "datetime"
  }
}
```

## Check Email User

Request :

- Method : `GET`
- Endpoint : `/api/users/{email}/check`
- Header :
  - Content-Type : `application/json`
- Response :

```json
{
  "code": "number",
  "message": "string"
}
```

## Update User

Request :

- Method : `PUT`
- Endpoint : `/api/users/{uid}`
- Header :
  - Content-Type : `application/json`
  - Accept : `application/json`
- Body :

```json
{
  "email": "string, unique",
  "password": "string, hash",
  "username": "string",
  "two_factor_auth": "integer"
}
```

- Response :

```json
{
  "code": "number",
  "message": "string",
  "user": {
    "uid": "integer",
    "email": "string",
    "password": "string",
    "username": "string",
    "two_factor_auth": "integer",
    "updated_at": "datetime"
  }
}
```

## Upload User Avatar

Request :

- Method : `POST`
- Endpoint : `/api/users/{uid}`
- Header :
  - Content-Type : `application/json`
  - Accept : `application/json`
- Body :

```json
{
  "uid": "integer, unique",
  "avatar": "string, multipart|file"
}
```

- Response :

```json
{
  "code": "number",
  "message": "string",
  "user": {
    "uid": "integer",
    "avatar": "string",
    "updated_at": "datetime"
  }
}
```

## Delete User

Request :

- Method : `DELETE`
- Endpoint : `/api/users/{uid}`
- Header :
  - Content-Type : `application/json`
- Response :

```json
{
  "code": "number",
  "message": "string"
}
```

## Create Todo

Request :

- Method : `POST`
- Endpoint : `/api/todolist`
- Header :
  - Content-Type : `application/json`
  - Accept : `application/json`
- Body :

```json
{
  "uid": "string",
  "title": "string",
  "desc": "string",
  "image": "string, file|multipart"
}
```

- Response :

```json
{
  "code": "number",
  "message": "string",
  "todo": {
    "uid": "string, unique",
    "title": "string",
    "desc": "string",
    "image": "string",
    "created_at": "datetime"
  }
}
```

## List Todo

Request :

- Method : `GET`
- Endpoint : `/api/todolist/{uid}`
- Header :
  - Content-Type : `application/json`
- Response :

```json
{
  "code": "number",
  "message": "string",
  "todoList": [
    {
      "uid": "string, unique",
      "title": "string",
      "desc": "string",
      "image": "string"
    },
    {
      "uid": "string, unique",
      "title": "string",
      "desc": "string",
      "image": "string"
    }
  ]
}
```

## Get Todo

Request :

- Method : `GET`
- Endpoint : `/api/todolist/{id}/edit`
- Header :
  - Content-Type : `application/json`
- Response :

```json
{
  "code": "number",
  "message": "string",
  "todo": {
    "uid": "string, unique",
    "title": "string",
    "desc": "string",
    "image": "string"
  }
}
```

## Update Todo

Request :

- Method : `PUT`
- Endpoint : `/api/todolist/{uid}`
- Header :
  - Content-Type : `application/json`
  - Accept : `application/json`
- Body :

```json
{
  "title": "string",
  "desc": "string"
}
```

- Response :

```json
{
  "code": "number",
  "message": "string",
  "todo": {
    "title": "string",
    "desc": "string",
    "updated_at": "datetime"
  }
}
```

## Upload Todo Image

Request :

- Method : `POST`
- Endpoint : `/api/todolist/{id}`
- Header :
  - Content-Type : `application/json`
  - Accept : `application/json`
- Body :

```json
{
  "id": "integer",
  "image": "string, multipart|file"
}
```

- Response :

```json
{
  "code": "number",
  "message": "string",
  "todo": {
    "id": "integer",
    "image": "string",
    "updated_at": "datetime"
  }
}
```

## Delete Todo

Request :

- Method : `DELETE`
- Endpoint : `/api/todolist/{id}`
- Header :
  - Content-Type : `application/json`
- Response :

```json
{
  "code": "number",
  "message": "string"
}
```

## Delete All Todo

Request :

- Method : `DELETE`
- Endpoint : `/api/todolist/{id}/user`
- Header :
  - Content-Type : `application/json`
- Response :

```json
{
  "code": "number",
  "message": "string"
}
```

## Create Log User

Request :

- Method : `POST`
- Endpoint : `/api/loguser `
- Header :
  - Content-Type : `application/json`
- Body :

```json
{
  "uid": "integer",
  "ip_address": "string | getIPAddress_PHP",
  "mac_address": "string",
  "action": "string"
}
```

- Response :

```json
{
  "code": "number",
  "message": "string",
  "logusers": {
    "uid": "string, unique",
    "mac_address": "string",
    "ip_address": "string",
    "action": "string",
    "created_at": "datetime"
  }
}
```

## Get Log User

Request :

- Method : `GET`
- Endpoint : `/api/loguser/{uid}`
- Header :
  - Content-Type : `application/json`
- Response :

```json
{
  "code": "number",
  "message": "string",
  "logusers": {
    "uid": "string, unique",
    "mac_address": "string",
    "ip_address": "string",
    "action": "string",
    "created_at": "datetime"
  }
}
```

#

# CodeIgniter 4 Application Starter

## What is CodeIgniter?

CodeIgniter is a PHP full-stack web framework that is light, fast, flexible and secure.
More information can be found at the [official site](http://codeigniter.com).

This repository holds a composer-installable app starter.
It has been built from the
[development repository](https://github.com/codeigniter4/CodeIgniter4).

More information about the plans for version 4 can be found in [the announcement](http://forum.codeigniter.com/thread-62615.html) on the forums.

The user guide corresponding to this version of the framework can be found
[here](https://codeigniter4.github.io/userguide/).

## Installation & updates

`composer create-project codeigniter4/appstarter` then `composer update` whenever
there is a new release of the framework.

When updating, check the release notes to see if there are any changes you might need to apply
to your `app` folder. The affected files can be copied or merged from
`vendor/codeigniter4/framework/app`.

## Setup

Copy `env` to `.env` and tailor for your app, specifically the baseURL
and any database settings.

## Important Change with index.php

`index.php` is no longer in the root of the project! It has been moved inside the _public_ folder,
for better security and separation of components.

This means that you should configure your web server to "point" to your project's _public_ folder, and
not to the project root. A better practice would be to configure a virtual host to point there. A poor practice would be to point your web server to the project root and expect to enter _public/..._, as the rest of your logic and the
framework are exposed.

**Please** read the user guide for a better explanation of how CI4 works!

## Repository Management

We use Github issues, in our main repository, to track **BUGS** and to track approved **DEVELOPMENT** work packages.
We use our [forum](http://forum.codeigniter.com) to provide SUPPORT and to discuss
FEATURE REQUESTS.

This repository is a "distribution" one, built by our release preparation script.
Problems with it can be raised on our forum, or as issues in the main repository.

## Server Requirements

PHP version 7.3 or higher is required, with the following extensions installed:

- [intl](http://php.net/manual/en/intl.requirements.php)
- [libcurl](http://php.net/manual/en/curl.requirements.php) if you plan to use the HTTP\CURLRequest library

Additionally, make sure that the following extensions are enabled in your PHP:

- json (enabled by default - don't turn it off)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php)
- xml (enabled by default - don't turn it off)
