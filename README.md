# SISTEMA DE COLEGIO INTCOMEX

Se realiza la prueba de intcomex donde se requiere un sistema de colegio con 3 roles (Admin, Docente, Estudiante)

## Los usuarios por defecto son:
    1. Admin
        - Usuario: admin@colint.com
        - Contraseña: 1234abcd
    2.  Docente
        - Usuario: docente@colint.com
        - Contraseña: 1234abcd
    3.  Estudiante
        - Usuario: estudiante@colint.com
        - Contraseña: 1234abcd

Esta es la vista inicial del sistema
![image](https://user-images.githubusercontent.com/53983396/158272494-6113e7a9-e744-4c40-935b-0fd98a767e8e.png)


## El paso a paso para instalar es el siguiente:

1. Abrimos la terminal o nuestro CMD si estamos en Windows
2. Validamos que tengamos las herramientas necesarias para realizar la instalacion correctamente
    ```
    php -v
    composer --version
    npm -v
    ```
    #### PHP
    ![image](https://user-images.githubusercontent.com/53983396/158273011-699d9e43-cc10-4846-8088-4bd609f0b78e.png)
    
    #### COMPOSER
    ![image](https://user-images.githubusercontent.com/53983396/158272971-5619dcb4-ea21-4885-9762-aa0df3cd957f.png)
    
    #### NPM
    ![image](https://user-images.githubusercontent.com/53983396/158273046-9b6d60bd-eecf-44a1-8564-47c199012c6d.png)

3.  Si tenemos todo correctamente nos dirigimos a la ruta donde deseamos instalar el proyecto, en mi caso lo instalare en c:\xampp\htdocs
    - Una vez en la carpeta ejecutamos el siguiente comando
    ```
    git clone https://github.com/manuel-garciag/colegio_intcomex
    ```
    ![image](https://user-images.githubusercontent.com/53983396/158273478-f4b61a2d-6d93-4350-84a6-375beba6a8d3.png)
    - Ingresamos al proyecto con
    ```
    cd colegio_intcomex
    ```
4. Una vez en la carpeta del proyecto ingresamos los siguientes comandos
    ```
    composer install
    npm install
    npm run dev
    ```
    #### composer install
    ![image](https://user-images.githubusercontent.com/53983396/158274084-721b1536-2548-49c2-bd87-28b02ffa73d4.png)
        
    #### npm install
    ![image](https://user-images.githubusercontent.com/53983396/158274263-661776f1-70a0-46a4-ac1b-9bd0100d4246.png)
        
    #### npm run dev
    ![image](https://user-images.githubusercontent.com/53983396/158274405-136fbc0d-e2b6-4e49-98c1-2812b841c736.png)

5.  Cuando tengamos todo listo nos dirigimos a localhost/phpmyadmin o creamos una base de datos en nuestro gestor de base preferido por ejemplo (dbeaver) y creamos una tabla preferiblemente con el nombre que deseen, cuando creemos la base de datos nos dirigimos a nuestro editor de codigo faorito y duplicamos el archivo .env.example con el nombre .env luego lo abrimos y en los campos
     - DB_DATABASE
     - DB_USERNAME
     - DB_PASSWORD

    Los editamos con los datos de nuestro servidor, 
6.  Cuando tengamos estos 3 datos configurados, en la misma terminal/CMD vamos a ingresar 
    ```
    php artisan migrate --path=/database/migrations/2022_03_13_183344_create_rols_table.php
    ```
    ![image](https://user-images.githubusercontent.com/53983396/158275659-04abe1eb-7009-4cd6-9286-55351b674f37.png)
    
    Despues ejecutaremos el siguiente comando
    ```
    php artisan migrate
    ```
    ![image](https://user-images.githubusercontent.com/53983396/158275728-ea00c0bb-af28-4a52-9a6c-e999c7d4a67f.png)

7.  Cuando ejecutemos las migraciones en la misma consola ejecutamos 
    ```
    php artisan key:generate
    ```
    ##### Esto para generar una key y que nuestro aplicativo funcione
    ![image](https://user-images.githubusercontent.com/53983396/158276062-437ebb1c-03d0-4c61-ac2a-ead245fe9af2.png)

    Despues
    ```
    php artisan serve
    ```
    ![image](https://user-images.githubusercontent.com/53983396/158275861-2c0ff319-8c3b-4805-8eb8-41f9b22e5b46.png)
    
    Ingresamos a la url que nos da la terminal/CMD
    en mi caso fue la http://127.0.0.1:8000 y por lo general es esta la misma para todos los proyectos en laravel
    
8.  Nos dirigimos al navegador y pegamos la url en la barra de busquedas y damos enter

9.  En la parte superior nos aparecera la opcion de logueo y registrar
    ![image](https://user-images.githubusercontent.com/53983396/158276170-77c5b21f-43dd-4e40-a8b5-c649ae4c2377.png)
