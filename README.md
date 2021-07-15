<h1 align="center"> PHP - Simple TODO List - REST API </h1>
<p>
  <img alt="Version" src="https://img.shields.io/badge/version-1.0.0-blue.svg?cacheSeconds=2592000" />
  <a href="https://github.com/cagilceren/PHP-Simple-TODO-List-REST-API/blob/main/README.md" target="_blank">
    <img alt="Documentation" src="https://img.shields.io/badge/documentation-yes-brightgreen.svg" />
  </a>
  <a href="https://github.com/cagilceren/PHP-Simple-TODO-List-REST-API/graphs/commit-activity" target="_blank">
    <img alt="Maintenance" src="https://img.shields.io/badge/Maintained%3F-yes-green.svg" />
  </a>
</p>
<p>

 </p>

<br>

This project is created as a part of self-learning. 

In this project, I have created REST API Service for a TODO App.  

## Build With

- PHP
- MySQL
- MySQLi (MySQL Improved Extension)

## Tools & Technologies
- Postman
- Json
- Rest API

## Highlights

During the project I have returned all data as json format, so that it could be used directly in future web and mobile applications.

The connect function has been created seperately as "[connection.php](https://github.com/cagilceren/PHP-Simple-TODO-List-REST-API/blob/main/connection.php)" and inclueded to "[reminder.php](https://github.com/cagilceren/PHP-Simple-TODO-List-REST-API/blob/main/reminder.php)" for the efficiancy and readability.

In this project 4 different functions created after CRUD based on [RESTful web API design](https://docs.microsoft.com/en-us/azure/architecture/best-practices/api-design). 

Namely

- to **Create** a new reminder to the database "post()",
	
- to **Read** a existing reminder in the database "get()",
	
- to **Update** an existing reminder in the database "put()",
	
- to **Delete** an existing reminder from the database "delete()".


Additionally, i have created a "getAll()" function in order to get all the existing reminders in the database.

Moreover, i have used PHP Prepared Statements to prevent the MySQL Injection. (See: [Prepared Statements](https://www.php.net/manual/en/mysqli.quickstart.prepared-statements.php)).

In the functions I have checked the possible error resources and throwed a related Exception. Later on i catched these Exceptions globally to show a structured error message for applications repository layer. Successfull requests return "HTTP 200 OK" while unsuccessfull ones return "HTTP 500 Internal Server Error!".


## Usage

> 1) Clone the repository to your local machine

```sh
$ git clone https://github.com/cagilceren/PHP-Simple-TODO-List-REST-API.git
```

> 2) Install MySQL Workbench and MySQL Server. Import the file "[reminder.sql](https://github.com/cagilceren/PHP-Simple-TODO-List-REST-API/blob/main/reminder.sql)".

> [Download MySQL Workbench](https://dev.mysql.com/downloads/workbench/)

> 3) Install Postman and import the file "[reminder.postman_collection.json](https://github.com/cagilceren/PHP-Simple-TODO-List-REST-API/blob/main/reminder.postman_collection.json)".

> [Download Postman](https://www.postman.com/downloads/)

> 4) Open the file "[reminder.php](https://github.com/cagilceren/PHP-Simple-TODO-List-REST-API/blob/main/reminder.php)" and "[connection.php](https://github.com/cagilceren/PHP-Simple-TODO-List-REST-API/blob/main/connection.php)" in your favorite editor to be able to check and update the code as your credential.

> 5) Go to the repository folder and run php

```sh
$ cd ./PHP-Simple-TODO-List-REST-API
$ php -S localhost:8000

```

## Authors

<img src="https://avatars.githubusercontent.com/u/45261915?v=2" width="25" height="25"> **Cagil Ceren Aslan**




- Github: [@cagilceren](https://github.com/cagilceren)

## Contributing

I am happy to have some improvement ideas for my project :)

