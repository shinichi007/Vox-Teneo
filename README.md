# Vox Teneo

Vox Teneo Technical Test.

Current features:
- Banner
- Content News
- Content Event

## Requirements
- PHP 8.0
- MYSQL 8.x
- NGINX / APACHE 2.7

## Features

- Manage Banner
- Manage Content News
- Manage Content Event

## Installation
```
$ composer install
```

## Usage
Run the server
```
$ npm run dev

> gm-billing-system@1.0.0 dev billing-system
> cross-env NODE_ENV=development nodemon src/index.js

[nodemon] 2.0.9
[nodemon] to restart at any time, enter `rs`
[nodemon] watching path(s): *.*
[nodemon] watching extensions: js,mjs,json
[nodemon] starting `node src/index.js`
{"moduleName":"index.js","message":"Connected to MongoDB","level":"info","timestamp":"2021-11-11 19:29:17"}
{"moduleName":"index.js","message":"Listening to port 3000","level":"info","timestamp":"2021-11-11 19:29:17"}
```

### API docs
We are using [Swagger](https://swagger.io/) for our API documentation.
Go to [http://localhost:3000/api/v1/docs](http://localhost:3000/api/v1/docs)
   - Create an administrator user on `/auth/register`
   - Copy-paste this into `Request body` and hit 'Execute' button:
      ```json
      {
        "name": "administrator",
        "email": "admin@example.com",
        "password": "password1",
        "role": "admin"
      }
      ```
      *Feel free to change `name`, `email`, or `password`*

[Staging](https://staging-billingsystem.gramedia.com/api/v1/docs) - `admin@example.com:Admin123`
   >🪧 You can use [dashboard page](https://staging-billingsystem.gramedia.com) on Staging
