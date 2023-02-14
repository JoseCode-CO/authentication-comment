

## About Test

## Prueba Jose David Diaz Lora

## Tecnologias
* Laravel Framework v - 9.51.0 
* PHP 8.2

## Pasos:
* Clonar repositorio
* Instalar dependencias con composer i
* Configurar .env
* Ejecutar migraciones y seeder: php artisan migrate:fresh --seed
* Ejecutar servidor con: php artisan server

## Project, rutas:
*http://127.0.0.1:8000/docs , Carga una vista con una documentacion de las apis

*http://127.0.0.1:8000/api/login , Nos permite loguearnos en el sistema:
{
   "email": "jose123@gmail.com",
   "password": "root",
}


*http://127.0.0.1:8000/api/login , Lista los post con el usuario que lo creo, los comentarios de dicho post y los archivos


*http://127.0.0.1:8000/api/v1/post , Crea un post
{
	 "title" : "La coche",
    "content" : "Publicacion sobre la noche en colombia"
}

*http://127.0.0.1:8000/api/v1/posts/3, Elimina un post

*http://127.0.0.1:8000/api/v1/messages , Crea un comentario, a un post y sube unos archivos

{	  
	"sender_id": 2,    
	"receiver_id":1,   
	"post_id" :2,    
	"message" : "Yakelin",  	
	"attachments": "test.mp3"  (DEBE SER TIPO ARCHIVO, UNA FOTO O UN AUDIO), SI NO SE MANDA DE IGUAL CREA EL COMENTARIO
}

*http://127.0.0.1:8000/api/v1/messages Muestra todos los comentarios con el post que pertenece, y los datos de los usuarios








