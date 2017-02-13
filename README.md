# SimpleMVC
A lightweight MVC web application framework with URL routing.
\* SimpleMVC is in the middle of a complete rewrite (Woot! Simple routing and SEO friendly URLs!).  Consequently, not all funcionality has been implemented.  In its current state, SimpleMVC provides a complete MVC solution with routing, but has yet to implement its database funcitonality.  This means you will have to instantiate your own database object, sanitize your SQL, organize returned records, ect...

## Directory Structure
```
.
├── app
│   ├── controllers
│   │   └── index.php
│   ├── models
│   │   └── index.php
│   └── views
│       └── index.php
├── assets
│   ├── css
│   └── js
├── configs
│   ├── constants.php
│   ├── core.php
│   └── routes.php
├── index.php
├── libs
├── LICENSE
├── README.md
└── src
    ├── core
    │   ├── Config.php
    │   ├── ControllerFactory.php
    │   ├── Controller.php
    │   ├── Exceptions.php
    │   ├── Loader.php
    │   ├── Model.php
    │   ├── Router.php
    │   ├── SimpleMVC.php
    │   └── View.php
    └── database

12 directories, 20 files
```
