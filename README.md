# Prueba Para TelePagos Backend

![Imagén de pokeAPI](pokeapi_256.png)
![Estaus](https://img.shields.io/badge/STATUS-Terminado-blue)
- En esta prueba es necesarioa tener instalado el programa **PostMan** para probarlo o a lo sumo algo similar para probar la API.
---

## :hammer: Como usar la API (PostMan)

- `Funcionalidad 1`: Se puede Listar los Entrenadores con la funcion **listarEntrenadores**, traerá todos los entrenadores en la base de datos

- `Funcionalidad 2`: Se puede crear entrenador mediante la función crearEntrenador pasandole el **nombre del entrenador** en el **body**

- `Funcionalidad 3`: Se puede detallar entrenador usando la función **detallarEntrenador** pasandole como parametro el **id=id_del_entrenador**

- `Funcionalidad 4`: Se puede crear Equipo con la función **crearEquipo** pasandole el **id_entrenadores=id_del_entrenador** y el **nombre=nombre_del_equipo** al **body**

- `Funcionalidad 5`: Se puede listar los Equipos con la función **listarEquipo** pasandole como parametro **id=id_entrenador_que_se_busca**

- `Funcionalidad 6`: Se puede asociar los pokemones hacía un equipo y con determinado orden mediante la función **asociarAEquipo** pasandole **id_equipo=id_del_equipo**, **id_pokemones=id_del_pokemon**, **orden=numero_orden** todo esto en el **body**

- `Funcionalidad 7`: Esta funcionalidad es mayormente para llevar datos de pokemones hacía la base de datos, inicializando mediante la función **insertarPokemones**