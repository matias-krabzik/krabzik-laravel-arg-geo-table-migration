# KRABZIK LARAVEL DB ARG. SEEDER

**Nombre del proyecto:** krabzik-laravel-arg-geo-table-migration. 

Este pequeño aporte lo hago para facilitar la carga de los datos de ciudades y provincias de Argentina. Con los siguientes pasos, uno podrá contar con el Seeder de la base de datos de Argentina. 

#### Modelos y Migraciones

Para poer ejecutar sin problemas la migración, hay que tener en cuenta que fue realizada utilizando migraciones y Modelos particulares. El aporte se encuentra en desarrollo, en un futuro cercano implementaré el tema de las capitales de las provincias y para más adelante ver la posibilidad de completar con mas metadatos y enriquecer aun mas las base de datos. 

#### Vamos a utilizarla

Lo primero que debemos hacer es descargar este repositorio en nuestra PC y luego seguir estas indicaciones. 

1. Copiar la carpeta **data** en el directorio raíz del proyecto de Laravel (Si se quiere cambiar la ubicación, luego se tendrá que editar el Seeder para que encuentre correctamente los archivos dentro de la misma).
2. Agregar el Seeder **GeoDataTableSeeder** en la carpeta **database/seeds**. 
3. Agregar el llamado al Seeder en el archivo **DatabaseSeeder.php** -> "$this->call(GeoDataTableSeeder::class);".
4. Ejecutar los siguientes comandos en la terminal:
  1. "**php artisan migrate**".
  2. "**php artisan db:seed**". 

#### Aclaraciones

Siéntete en libertad de modificar el código para que funcione en tu proyecto!!!

#### Ponte en contacto con migo

[Facebook](https://www.facebook.com/matias.krabzik)

[Twitter](https://twitter.com/MKrabzik)
