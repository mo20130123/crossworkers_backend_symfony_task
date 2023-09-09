# How to install

Please follow the 

* First install the Packages
```
composer install
```
* then migrate the DataBase

```
 symfony console doctrine:migrations:migrate
```
* then Load the Data in the DataBase

```
 symfony console doctrine:fixtures:load
```
* finaly run the project

```
 symfony server:start
```

