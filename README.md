# Prueba Para TelePagos Backend

![Imagén de pokeAPI](pokeapi_256.png)
![Estaus](https://img.shields.io/badge/STATUS-Terminado-blue)
- En esta prueba es necesarioa tener instalado el programa **PostMan** para probarlo o a lo sumo algo similar para probar la API.
---

## :hammer: Como usar la API (PostMan)

- `Funcionalidad 1`: Se puede Listar los Entrenadores con la funcion **listarEntrenadores**, traerá todos los entrenadores en la base de datos
##### POST ['/listarEntrenadores']

- `Funcionalidad 2`: Se puede crear entrenador mediante la función crearEntrenador pasandole el **nombre del entrenador** en el **body**
##### POST ['/crearEntrenador']
> body { <p style='margin:0; margin-left:20px;'>Nombre: "nombre del entrenador"</p>}

- `Funcionalidad 3`: Se puede detallar entrenador usando la función **detallarEntrenador** pasandole como parametro el **id=id_del_entrenador**
##### POST ['/detallarEntrenador']
- Parametros
    1. id: "id_del_entrenador"
<br>

- `Funcionalidad 4`: Se puede crear Equipo con la función **crearEquipo** pasandole el **id_entrenadores=id_del_entrenador** y el **nombre=nombre_del_equipo** al **body**
##### POST ['/crearEquipo']
> body { <p style='margin:0; margin-left:20px;'>id_entrenadores: "id del entrenador", <br>nombre: "nombre_del_equipo" 
> </p>}
- `Funcionalidad 5`: Se puede listar los Equipos con la función **listarEquipo** pasandole como parametro **id=id_entrenador_que_se_busca**

##### POST ['/listarEquipo']

- Parametros
    1. id: "id_del_equipo"
<br>


- `Funcionalidad 6`: Se puede asociar los pokemones hacía un equipo y con determinado orden mediante la función **asociarAEquipo** pasandole **id_equipo=id_del_equipo**, **id_pokemones=id_del_pokemon**, **orden=numero_orden** todo esto en el **body**

##### POST ['/asociarAEquipo']
> body { <p style='margin:0; margin-left:20px;'>id_equipo: id_del_equipo, <br>id_pokemones: id_del_pokemon, <br>orden: numero_orden
> </p>}


- `Funcionalidad 7`: Esta funcionalidad es mayormente para llevar datos de pokemones hacía la base de datos, inicializando mediante la función **insertarPokemones**

##### POST ['/insertarPokemones']
