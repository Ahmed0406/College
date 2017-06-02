Installation du projet
=========

.1) **update de repository**
 
1 ![Alt text](1.PNG)
 ---
 
2 ![Alt text](2.PNG)
---

.2) **update d'application**

Installer [composer](https://getcomposer.org/download/ "composer")

puis update projet:
```
composer install
```

.3) Update Base de Donnée

```
php bin/console doctrine:schema:drop --full-database --force 
```
```
php bin/console doctrine:schema:update --force
```

.4) Run application
```
php bin/console server:run
```
Visiter `http://127.0.0.1:8000/` 