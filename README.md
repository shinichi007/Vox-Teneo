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

## Before Installation
You need a web server with a database and PHP. The server could be your personal computer, or at an online web host.

## Installation
1. Get Code
```
$ git clone git@github.com:shinichi007/Vox-Teneo.git {project_name}
```
2. Go to project
```
$ cd {project_name}
```
3. Install dependencies with composer
```
$ composer install
```
4. Create Database
5. Configure Your Installation
6. Run the Installer


## Usage
1. Override Configuration [path_to_sql/db_vox_teneo.sql](https://github.com/shinichi007/Vox-Teneo/blob/main/db_vox_teneo.sql)
```
$ mysql -u root -p [database_name] < path_to_sql/db_vox_teneo.sql
```
2. Login as an administrator
```
$ [domain]/user/login
$ username : admin
$ pass     : 12345678
```
3. Setup Vox Setting
```
$ [domain]/admin/config/services/vox
```
4. Clear Cache
```
$ [domain]/admin/config/development/performance
```
5. Manage Content
```
$ [domain]/admin/content
```
