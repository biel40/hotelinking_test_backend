# README: API Backend Prueba Hotelinking - Instalación en Local

En primer lugar, usaremos una Máquina Virtual Vagrant, en donde podremos configurar un entorno de desarrollo para Laravel, que será el framework de PHP que utilizaremos. La máquina virtual en cuestión es "Homestead".

Para configurar un entorno con dicha máquina en local, tendremos que seguir los siguientes pasos:
 <ul>
  <li>
     Descargamos <a href="https://www.vagrantup.com/downloads.html"> Vagrant </a>.
  </li>
  <li>
    Descargamos e instalamos <a href="https://www.virtualbox.org/wiki/Downloads"> VirtualBox</a>. En Windows quizá sea necessario activar la virtualizacion por hardware en la bios para que funcione VirtualBox. En el caso del desarrollo de esta prueba, se ha usado Ubuntu 18.04.
  </li>
</ul>

Añadiremos el paquete Homestead a nuestro paquete de Vagrant:

```bash
vagrant box add laravel/homestead
```

Nos aparecerá que proveedor queremos usar. En nuestro caso, tendremos que marcar la opción de <a href="https://www.virtualbox.org/wiki/Downloads"> VirtualBox. </a>

Posteriormente, clonaremos el repositorio para la instalación local de Homestead:

```bash
cd /home

git clone https://github.com/laravel/homestead.git Homestead

cd Homestead
```

Justo a continuación, ejecutaremos el scrpit de inicio de Homestead.

Para Ubuntu/Linux, ejecutaremos el siguiente comando:

```bash

bash init.sh

```

En el caso de usar Windows, el siguiente:

```bash

.\init.bat  

```

Posteriormente, tendremos que configurar la máquina Homestead. Tendremos que configurar una carpeta de nuestro equipo local para que esté sincronizada con la Máquina Virtual.

Esto se puede hacer con el fichero Homestead.yaml de nuestra carpeta Homestead.

Adjunto mi fichero homestead.yaml de configuración:

```bash

ADJUNTAR TEXTO DEL HOMESTEAD.YAML

```
En el apartado de <b> folders: </b> se define donde estará ubicado el directorio local y el remoto, que estarán sincronizados entre ellos. En <b> map: </b> se tiene que indicar dónde estará nuestra carpeta sinronizada en la máquina local. En mi caso, el directorio se ubica en el home de mi usuario. Para crear el directorio, se deben ejecutar lo siguiente:

```bash

cd /home

mkdir code

```

Una vez tengamo toda la configuración del fichero Homestead.yaml, deberemos generar el par de llaves <b> SSH </b> para poder conectarnos a nuestra máquina <b> Homestead </b>.

Para ello, tendremos que ejecutar el comando:

```bash

ssh-keygen -t rsa

```

Una vez ejecutado, nos pedirá que digamos donde queremos guardarla. Simplemente podemos dejar la que esta por defecto:

```bash

Enter file in which to save the key (/home/user/.ssh/id_rsa):

```

Y finalmente nos pedirá que introduzcamos contraseña para las claves. Por defecto, si no introducimos ninguna, quedará vacía:

```bash

Enter passphrase (empty for no passphrase):

```

Una vez hecho todo esto, ya podemos levantar nuestra Máquina Virtual de Vagrant Homestead:

```bash

vagrant up

```

Además de todo esto, deberemos añadir a nuestro fichero /etc/hosts la IP configurada en el archivo <b> "Homestead.yaml" </b> . En Ubuntu o MacOS, este fichero se encuentra en el directorio <b> /etc/hosts </b>. Por otra parte, en Windows, se puede encontrar en  <b> C:\Windows\System32\Drivers\etc </b>. Deberemos introducir en el archivo lo siguiente:

```bash

192.168.10.10 hotelinking.test

```

En donde <b> 192.168.10.10 </b> es la dirección IP que he configurado para la máquina Homestead en el fichero de configuración de <b> Homestead.yaml </b>.

Para acceder via ssh a la máquina virtual usaremos dentro del directorio donde hemos clonado el repositiorio de <b> Homestead </b>:

```bash

vagrant ssh 

```

Una vez dentro, generaremos la Base de Datos de la aplicación, para que pueda funcionar.

Para acceder a mysql, ponemos lo siguiente:

```bash

mysql -u root -p 

```

Contraseña de MySQL:

```bash

secret

```

Una vez hayamos entrado en MySQL, ejecutaremos las siguientes instrucciones SQL para generar los esquemas:

```bash

create schema ; -> NOMBRE DE MI BASE DE DATOS
create schema ; -> NOMBRE DE MI BASE DE DATOS
exit;

```

Finalmente, clonaremos este repositorio dentro de la máquina virtual y ejecutaremos lo siguiente:

```bash

cd /home/vagrant/code/ 
git clone https://github.com/biel40/hotelinking_test_backend.git
cd hotelinking_test_backend

```

Nos introducimos dentro de la carpeta e instalamos las dependencias:

```bash

composer install

```

```bash

cp .env.example .env

```

Después, generamos la APP_KEY:

```bash
 php artisan key:generate
```

Ahora tendremos que configurar la conexión de la base de datos. Modificaremos estos parámetros en el fichero <b> .env </b>

```bash

DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=hotelinkingDB
DB_USERNAME=root
DB_PASSWORD=secret

```

Ahora haremos las migraciones la Base de Datos.

Tendremos que instalar Laravel Passport, dado que en la API REst, se utiliza para hacer login con método OAuth:

```bash
php artisan migrate

php artisan passport:install
```
 
Ya esta la API REST funcionando. Ahora ya será solo necesario instalar la parte de Cliente de la Aplicación, que se podrá encontrar en otro repositorio: 

<a href="https://github.com/biel40/hotelinking_tech_test_client.git"> https://github.com/biel40/hotelinking_tech_test_client.git </a>

# README: Apartado de Testing



