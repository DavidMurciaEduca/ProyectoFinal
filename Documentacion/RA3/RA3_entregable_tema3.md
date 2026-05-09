# Entregable RA3 — Planificación de la ejecución del proyecto

### Módulo: Proyecto de Desarrollo de Aplicaciones Web · Curso 2025-2026

---

## Datos del grupo

| Campo | Valor |
|---|---|
| Grupo DCK | |
| David Corbalán (1922743)| |
| Abdelkarim Salih (13452456)| |
| Curra Rodríguez (12493784) | |


---

## Continuidad con el RA2

> **Punto de partida obligatorio**: este entregable es la continuación directa del diseño que elaboraste en el RA2. Debes planificar la ejecución del **mismo proyecto** que diseñaste en el entregable anterior.
>
> Si tu grupo todavía no tiene un diseño de proyecto definitivo, o el entregable del RA2 quedó incompleto, elige **uno de los supuestos del fichero `ideas_de_proyectos.md`** y trabaja a partir de él, asumiendo que ya has completado el diseño (Brief, tabla de usuarios, viabilidad, MVP definido, backlog de historias de usuario). En ese caso, el entregable 2 del supuesto elegido debe estar resuelto o ser coherente con lo que aquí presentas.
>
> **Indica en los datos del grupo** qué proyecto estáis planificando: nombre del proyecto o supuesto elegido.

| Proyecto planificado | |
|---|---|
|`Aplicación web para la gestión integral de un restaurante` | |

---

## Distribución de tareas

> **Norma de obligado cumplimiento**: cada tarea debe tener **un único responsable** identificado por su NRE. No se acepta "todos", "el grupo" ni cualquier respuesta equivalente. La calificación es individual para cada alumno y el profesor evaluará cada tarea teniendo en cuenta quién la ha firmado.
>
> Conserva únicamente la tabla que corresponda al tamaño de tu grupo. Elimina las otras tres antes de entregar.

---




### Tabla C — Grupo de 3 miembros · reparto al 33 % (~3-4 tareas por miembro)

| N.º | Tarea | Responsable |
|:---:|---|---|
| 1 | Lista de tareas técnicas y dependencias | Karim |
| 2 | Plan de iteraciones | Karim |
| 3 | Tabla de recursos por tarea y logística | Karim |
| 4 | Asignación del trabajo (matriz RACI) | Karim |
| 5 | Tabla de permisos y autorizaciones | Curra |
| 6 | Acuerdos de trabajo y flujo con el repositorio | Curra |
| 7 | Definición de "hecho" (DoD) | Curra |
| 8 | Registro de riesgos y plan de prevención de riesgos laborales | David |
| 9 | Estimación de costes (desarrollo y producción) | David |
| 10 | Plan de despliegue | David |

> *Reparto propuesto: 4-3-3 tareas. La tarea 8 es la más extensa; dado que el Miembro 3 solo asume tres tareas, la carga está compensada. El grupo puede reorganizar el reparto para equilibrarlo, manteniendo siempre un único responsable por tarea.*

---




## Tarea 1 — Lista de tareas técnicas y dependencias

**Responsable:** *Karim*

**Criterio de evaluación:** CE3.1 — Se han secuenciado las tareas en función de las necesidades de implementación.

**Enunciado:**  
El backlog del RA2 lista las *funcionalidades* del MVP. Ahora debes descomponer cada funcionalidad en **tareas técnicas concretas**: acciones específicas que una persona puede empezar y terminar en pocas horas, y que producen algo tangible (una tabla en la base de datos, un formulario funcional, un endpoint probado, etc.).

Para cada funcionalidad del MVP completa la tabla indicando las tareas técnicas necesarias (entre 3 y 6) y el criterio de "terminado" de cada funcionalidad. Después, identifica las dependencias:

- Al menos **3 dependencias duras** entre tareas (qué no puede hacerse sin que otra esté lista).
- Al menos **2 tareas bloqueantes** (aquellas cuyo retraso paralizaría al resto).

Finalmente, dibuja o escribe el orden lógico de ejecución de las tareas siguiendo el esquema de la sección 2.2 del tema.

*Extensión orientativa: 1–2 páginas.*

---

**Entrega:**

### 1.1 Descomposición de funcionalidades en tareas técnicas

| Funcionalidad del MVP | Tareas técnicas necesarias (3–6) | Criterio de "terminado" |
|---|---|---|
| Registro e inicio de sesión por roles |- Crear tabla usuarios en la base de datos.<br> - Definir campos (nombre, email, contraseña, rol).<br> - Implementar formulario de login.<br> - Crear endpoint de autenticación.<br> - Implementar control de acceso según rol. |Un usuario puede iniciar sesión <br>correctamente y el sistema le redirige<br> a su interfaz correspondiente según<br> su rol (administrador, camarero o cocina). |
|Gestión de productos (administrador)|- Crear tabla productos en la base de datos.<br>- Crear modelo y migración.<br>- Crear endpoints CRUD de productos.<br>- Crear interfaz web para listar productos.<br>- Implementar formularios de crear, editar y eliminar.|El administrador puede crear, editar, visualizar y eliminar productos desde el panel de administración.
| Creación de comandas por camarero |- Crear tabla pedidos en la base de datos.<br>- Crear relación entre pedidos y productos.<br>- Implementar formulario para crear pedido.<br>- Crear endpoint para guardar pedidos.<br>- Mostrar confirmación de pedido registrado. | El camarero puede registrar una <br>comanda seleccionando productos <br>y el pedido queda guardado <br>correctamente en la base de datos.|
| Visualización y gestión de comandas en cocina | - Crear endpoint para obtener pedidos activos.<br>- Crear vista para el panel de cocina.<br>- Mostrar lista de pedidos pendientes.<br>- Implementar cambio de estado (pendiente, en preparación, listo).| El personal de cocina puede ver los pedidos y actualizar su estado correctamente.|
| Panel de administración básico | - Crear interfaz principal del panel admin.<br>- Añadir navegación entre secciones.<br>- Implementar control de acceso solo para administradores.<br>- Mostrar resumen básico (productos, pedidos).|El administrador puede acceder al panel y navegar por las secciones principales del sistema. |
| Despliegue en servidor de pruebas |- Configurar repositorio en GitHub.<br>- Configurar entorno del servidor.<br>- Subir proyecto al servidor.<br>- Configurar variables de entorno.<br>- Probar acceso a la aplicación desde navegador. | La aplicación funciona correctamente en el servidor de pruebas y es accesible desde un navegador.|



### 1.2 Dependencias identificadas

| Tarea que depende | Depende de (tarea anterior) | Tipo (dura / blanda) | Justificación |
|---|---|---|---|
| Implementar login| Crear tabla usuarios| Dura| El sistema de autenticación necesita la tabla de usuarios para validar credenciales.|
|Crear pedidos | Crear tabla pedidos|Dura |No se pueden guardar pedidos sin tener definida la estructura en la base de datos. |
| Visualizar pedidos en cocina| Crear endpoint de pedidos| Dura| La interfaz necesita el endpoint para obtener los datos.|
|Panel de administración | Sistema de autenticación|Blanda | El panel puede diseñarse antes, pero necesita login para funcionar completamente.|
| Despliegue en servidor|Proyecto funcional | Dura| El despliegue requiere que el sistema esté implementado previamente.|




### 1.3 Tareas bloqueantes

| Tarea bloqueante | ¿Por qué bloquea al resto? | ¿Quién debe resolverla primero? |
|---|---|---|
| Configuración de base de datos| Todas las funcionalidades dependen de las tablas y relaciones de datos.| Desarrollador backend|
| Implementación del sistema de autenticación| Controla el acceso a las diferentes funcionalidades según rol.| Desarrollador backend|

### 1.4 Orden lógico de ejecución

*(Escribe o dibuja el esquema de dependencias. Puedes usar flechas en texto, como en el ejemplo del tema, o insertar una imagen.)*

```
[1. Configuración del repositorio y entorno de desarrollo]
        ↓
[2. Creación de la base de datos y tablas principales]
        ↓
[3. Implementación del sistema de registro y login]
        ↓
[4. Desarrollo de la gestión de productos]
        ↓
[5. Implementación del sistema de creación de comandas]
        ↓
[6. Desarrollo del panel de cocina para gestionar pedidos]
        ↓
[7. Desarrollo del panel de administración]
        ↓
[8. Pruebas del sistema]
        ↓
[9. Despliegue en servidor de pruebas]

```

---

## Tarea 2 — Plan de iteraciones

**Responsable:** *Karim*

**Criterio de evaluación:** CE3.1 — Se han secuenciado las tareas en función de las necesidades de implementación.

**Enunciado:**  
Divide el trabajo del proyecto en **iteraciones** (bloques de tiempo de 1–2 semanas, cada uno con un objetivo concreto). Cada iteración debe terminar con algo que funcione y se pueda demostrar. No basta con "estamos avanzando": al final de cada iteración debe haber un resultado real y visible.

Define un mínimo de 3 iteraciones y un máximo de 4. Para cada una, completa la tabla con:
- El objetivo (una frase corta y concreta).
- Las tareas técnicas que entran en esa iteración (referencia a las tareas definidas en la Tarea 1).
- El resultado demostrable al terminar (qué podrías mostrar a alguien externo).
- Un riesgo previsto que podría impedir completarla a tiempo.

*Extensión orientativa: 1 página.*

---

**Entrega:**

### Plan de iteraciones



| Iteración| Duración prevista | Objetivo (1 frase)| Tareas técnicas que entran| Resultado demostrable al terminar| Riesgo previsto |
| --- | --- | ---| --- | --- | --- |
| **Iteración 1** | 1<br> semana          | Implementar<br> la base del <br>sistema con autenticación<br> de usuarios.                      | - Configuración del repositorio.<br>- Creación de la base de datos.<br>- Crear tabla usuarios.<br>- Implementar formulario de login.<br>- Implementar autenticación por roles.                           | Un usuario puede<br> iniciar sesión en <br>el sistema y acceder<br> según su rol <br>(administrador, <br>camarero o cocina).                  | Problemas en la configuración <br>inicial del proyecto<br> o en la <br>autenticación.             |
| **Iteración 2** | 1 <br>semana          | Desarrollar la <br>gestión de<br> productos <br>desde el panel<br> de <br>administración.               | - Crear tabla productos.<br>- Crear modelo y migración.<br>- Implementar endpoints CRUD de productos.<br>- Crear interfaz para listar productos.<br>- Formularios de crear, editar y eliminar productos. | El administrador <br>puede acceder al <br>panel y gestionar<br> los productos del <br>sistema.                                            | Errores en la<br> conexión entre <br>la base de <br>datos y la <br>interfaz web.                      |
| **Iteración 3** | 1 <br>semana          | Implementar <br>el sistema de <br>creación de <br>comandas <br>por parte del camarero.              | - Crear tabla pedidos.<br>- Definir relación entre pedidos y productos.<br>- Crear formulario para registrar pedidos.<br>- Endpoint para guardar pedidos.<br>- Confirmación de pedido registrado.        | Un camarero puede <br>crear una comanda seleccionando <br>productos y<br> guardarla en el <br>sistema.                                    | Problemas en la <br>relación entre<br> pedidos y <br>productos en la <br>base de datos.               |
| **Iteración 4** | 1<br> semana          | Implementar<br> la vista de<br> cocina y<br> desplegar la aplicación en<br> un servidor <br>de pruebas. | - Endpoint para obtener pedidos activos.<br>- Crear panel de cocina.<br>- Implementar cambio de estado de pedidos.<br>- Configurar servidor de pruebas.<br>- Desplegar aplicación.                       | La cocina puede <br>visualizar los <br>pedidos y <br>actualizar su <br>estado, y la<br> aplicación está disponible en un servidor de<br> pruebas. | Problemas en el<br> despliegue o en<br> la comunicación <br>entre el servidor<br> y la base de <br>datos. |


### Justificación del orden elegido

*(Explica en 3–5 líneas por qué has decidido estructurar las iteraciones así: qué va primero y por qué, qué queda para el final y por qué.)*
---
Las iteraciones siguen el orden lógico de desarrollo del sistema. En primer lugar, se implementa la base del sistema con autenticación, ya que todas las funcionalidades dependen del acceso por roles. En la segunda iteración se desarrolla la gestión de productos, necesaria para poder crear pedidos posteriormente. En la tercera iteración se crean las comandas, que constituyen la funcionalidad principal para el camarero. Finalmente, en la cuarta iteración se desarrolla el panel de cocina y el despliegue en servidor, permitiendo que el sistema completo pueda ser probado en un entorno real.


---

## Tarea 3 — Tabla de recursos por tarea y logística

**Responsable:** *Karim*

**Criterio de evaluación:** CE3.2 — Se han determinado los recursos y la logística necesaria para cada tarea.

**Enunciado:**  
Para cada una de las tareas técnicas de las iteraciones 1 y 2 (como mínimo), identifica qué recursos técnicos son necesarios para poder ejecutarla. Después, comprueba si esos recursos ya están disponibles o si hay que conseguirlos, y asigna un responsable con una fecha límite para cada recurso pendiente.

Incluye también una **nota de logística** para al menos 2 tareas donde la preparación del entorno o los datos de prueba sea relevante (por ejemplo: qué datos ficticios hay que cargar antes de poder hacer la demo, o desde qué dispositivo debe probarse la interfaz).

*Extensión orientativa: 1–2 páginas.*

---

**Entrega:**

### 3.1 Recursos por tarea

| Tarea | Recursos técnicos necesarios | ¿Disponibles ya? | Si no, ¿quién los consigue y cuándo? |
|---|---|---|---|
| Configurar repositorio y ramas | Cuenta de GitHub, repositorio del proyecto, Git instalado en los equipos de desarrollo|Sí |— |
| Crear estructura de base de datos |Sistema gestor de base de datos (MySQL), herramienta de gestión (phpMyAdmin), entorno de desarrollo local | Sí| —|
| Implementar autenticación y roles |Framework backend del proyecto (todavía por confirmar), base de datos configurada, editor de código (Visual Studio Code) |Sí | —|
| Crear tabla productos y modelo de datos |Base de datos configurada, sistema de migraciones del framework, documentación del modelo de datos | Sí| —|
| Crear interfaz de gestión de productos|Framework frontend, navegador web para pruebas, editor de código | Sí|— |
| Configurar entorno de despliegue | Servidor de pruebas, acceso SSH, repositorio Git del proyecto| No| Karim configurará el servidor y acceso antes del final de la Iteración 3|
| Preparar datos de prueba | Scripts de inserción de datos, base de datos del proyecto, lista de productos ficticios|No |Karim preparará los datos de prueba antes de la demo de la Iteración 3 |

> *Añade las filas que necesites para cubrir todas las tareas de al menos las dos primeras iteraciones.*

### 3.2 Notas de logística

*(Para al menos 2 tareas, describe la preparación concreta que hay que hacer antes de poder ejecutarlas: datos ficticios necesarios, dispositivos requeridos, condiciones de red, usuarios de prueba con cada rol, etc.)*

**Tarea — Implementar autenticación y roles:**<br>
Antes de realizar esta tarea es necesario preparar usuarios de prueba en la base de datos, cada uno con un rol diferente.
Se crearán al menos tres usuarios ficticios:

Usuario administrador

Usuario camarero

Usuario cocina

Esto permitirá comprobar que el sistema redirige correctamente a cada interfaz según el rol del usuario.

**Tarea — *Preparar datos de prueba*:**<br>
Antes de realizar las demostraciones del sistema es necesario cargar productos ficticios en la base de datos para poder crear los pedidos.

Los datos de prueba incluirán:

Bebidas (agua, refresco, cerveza)

Platos principales (hamburguesa, pizza, ensalada)

Postres (tarta, helado)



---

---

## Tarea 4 — Asignación del trabajo (matriz RACI)

**Responsable:** *Karim*

**Criterio de evaluación:** CE3.6 — Se ha planificado la asignación de recursos materiales y humanos según los tiempos de ejecución.

**Enunciado:**  
Usa la **matriz RACI** para asignar responsabilidades en las áreas principales del proyecto. Recuerda el significado de cada letra:

- **R** (*Responsible* – **Responsable**): quien ejecuta la tarea y produce el entregable.
- **A** (*Accountable* – **Aprueba**): quien revisa y da el visto bueno. En FP, puede ser otro miembro del equipo.
- **C** (*Consulted* – **Consultado**): quien aporta conocimiento durante la tarea pero no la ejecuta.
- **I** (*Informed* – **Informado**): quien debe conocer el resultado pero no participa en la tarea.

Completa la matriz para las 6 áreas de trabajo del proyecto y añade después un resumen del reparto total: cuántas tareas asume cada miembro del equipo.

> *Para trabajos individuales: asigna los roles a perfiles hipotéticos (p. ej., "Desarrollador backend", "Desarrollador frontend", "Admin de sistemas") como si fuera un equipo real. Indica qué perfil técnico serías tú.*

*Extensión orientativa: 1 página.*

---

**Entrega:**

### 4.1 Matriz RACI por área de trabajo

| Área de trabajo | Karim | David | Curra |
|---|---|---|---|
| Base de datos y migraciones | R  |C |A | 
| Backend y API (lógica del servidor) |R |C |A |
| Frontend e interfaz web | C| R| A| 
| Despliegue e infraestructura | R|A |I |
| Pruebas funcionales |C |A |R |
| Documentación técnica |A |I |R |

> *Escribe R, A, C o I en cada celda. Cada área debe tener exactamente un R y al menos un A.*

### 4.2 Resumen del reparto

| Miembro del equipo | Áreas donde es Responsable (R) | Número de áreas a su cargo |
|---|---|---|
|Karim | Base de datos y migraciones, Backend y API, Despliegue e infraestructura| 3|
| David| Frontend e interfaz web| 1|
| Curra|Pruebas funcionales, Documentación técnica | 2|

### 4.3 Comprobación de equilibrio

*(¿Está el trabajo repartido de forma equilibrada? Si no, ¿cómo lo habéis compensado? Escribe 2–3 líneas.)*

---

El reparto del trabajo se ha realizado teniendo en cuenta la experiencia técnica de cada miembro del equipo. Karim asume las áreas más críticas del desarrollo, como la base de datos, el backend y el despliegue, debido a su mayor experiencia. David y Curra se responsabilizan de otras áreas como el frontend, las pruebas y la documentación, lo que les permitirá aprender durante el desarrollo del proyecto. 


---

## Tarea 5 — Tabla de permisos y autorizaciones

**Responsable:** Curra

**Criterio de evaluación:** CE3.3 — Se han identificado las necesidades de permisos y autorizaciones para llevar a cabo las tareas.

**Enunciado:**  
Identifica todos los permisos y autorizaciones que el equipo necesita para poder ejecutar el proyecto. Ten en cuenta al menos estas categorías: accesos al repositorio, credenciales del entorno de despliegue, servicios externos que requieren cuenta o clave de acceso, y uso de datos (real o ficticio).

Para cada permiso identificado, completa la tabla indicando para qué tarea es necesario, quién lo concede, cuándo debe estar listo (en qué semana o antes de qué iteración) y su estado actual.

Debes identificar un **mínimo de 5 permisos o autorizaciones**. Si tu proyecto no usa servicios de pago ni correo, justifica qué alternativas usas y qué accesos siguen siendo necesarios.

*Extensión orientativa: 1 página.*

---

**Entrega:**

### Tabla de permisos y autorizaciones

| Permiso o autorización necesaria | ¿Para qué tarea? | ¿Quién lo concede? | Fecha límite | Estado actual |
|---|---|---|---|---|
| Acceso al repositorio con permisos de escritura para todos los miembros | Configuración inicial | Administrador del repo (Karim) | Semana 1 | Concedido|
| Acceso al gestor de base de datos (MySQL / phpMyAdmin) | Creación de tablas, migraciones y pruebas de base de datos| Karim| Semana 1|Concedido |
| Credenciales del entorno de despliegue | Despliegue demo | Profesor / AWS Academy | Antes de la iteración 3 | Pendiente|
| Acceso al servidor mediante SSH| Subida del proyecto y configuración del entorno de ejecución| Administrador del servidor (Karim)|Antes de la iteración 4 | Pendiente|
| Acceso a herramientas de desarrollo compartidas (Git, editor de código, gestor de dependencias) | Desarrollo del backend, frontend y control de versiones|Cada miembro del equipo configura su entorno | Semana 1|Concedido |
|Uso de datos ficticios para pruebas | Pruebas funcionales del sistema y demostraciones|Equipo del proyecto | Antes de la iteración 3|Pendiente |


### Posibles bloqueos por permisos

*(Señala cuál de los permisos anteriores representa mayor riesgo si no se consigue a tiempo, y qué alternativa tenéis si ese permiso falla. Escribe 2–4 líneas.)*

---

El permiso que representa mayor riesgo es el acceso al entorno de despliegue en el servidor de pruebas, ya que sin estas credenciales no se podría publicar la aplicación para su demostración final. En caso de no disponer de este acceso a tiempo, se utilizará un servidor local o un entorno de desarrollo local para realizar la demostración del funcionamiento del sistema.


---

## Tarea 6 — Acuerdos de trabajo y flujo con el repositorio

**Responsable:** Curra

**Criterio de evaluación:** CE3.4 — Se han determinado los procedimientos para la ejecución de las tareas.

**Enunciado:**  
Define los procedimientos de trabajo que el equipo seguirá durante la ejecución. Un equipo sin procedimientos acordados genera conflictos de código, trabajo duplicado y pérdida de tiempo.

Documenta los siguientes acuerdos:

1. **Flujo de trabajo con ramas**: cómo se crean las ramas, cómo se nombran y cuándo se fusionan al código principal.
2. **Formato de los commits**: cómo se redactan los mensajes de los "puntos de guardado" del código.
3. **Revisión de código**: quién revisa qué, y cómo se aprueba una pull request antes del merge.
4. **Herramienta de gestión de tareas**: dónde se lleva el tablero de trabajo (GitHub Projects, Trello, Notion, u otra).
5. **Frecuencia de despliegue**: cuándo se despliega al entorno de pruebas durante el proyecto.

Cada acuerdo debe estar escrito con suficiente detalle para que cualquier miembro del equipo pueda seguirlo sin preguntar.

> *Para trabajos individuales: documenta los convenios que seguirás tú solo, como si fueran las normas que aplicarías si hubiera más personas en el equipo.*

*Extensión orientativa: 1 página.*

---

**Entrega:**

### 6.1 Acuerdos de trabajo del equipo

| Acuerdo | Decisión del equipo |
|---|---|
| ¿Cómo se nombran las ramas? | Las ramas seguirán el formato feature/nombre-funcionalidad para nuevas funcionalidades, fix/descripcion-error para corrección de errores y docs/cambio-documentacion para cambios en la documentación.|
| ¿Cómo deben ser los mensajes de commit? | Los mensajes de commit deben usar un verbo en presente y una descripción clara de la acción realizada. Ejemplo: “Añade formulario de login”, “Corrige error en creación de pedidos”. |
| ¿Cuántas personas de deben revisar una pull request antes del merge? |Al menos una persona distinta al autor del cambio debe revisar la pull request antes de aprobarla. |
| ¿Quién puede hacer merge a la rama principal? |El merge a la rama main lo realizará Karim, ya que tiene más experiencia técnica y revisará que el código funcione correctame




nte. |
| ¿Con qué frecuencia se despliega al entorno de pruebas? | Se realizará un despliegue al entorno de pruebas al final de cada iteración o cuando se complete una funcionalidad importante del sistema.|
| ¿Dónde está el tablero de tareas / gestión de trabajo? |El equipo utilizará GitHub Projects para gestionar las tareas del proyecto, organizar el backlog y hacer seguimiento del progreso. |
| ¿Qué se hace si hay un conflicto de código? | El miembro que realiza el merge deberá resolver el conflicto revisando ambas versiones del código. Si el conflicto es complejo, se revisará conjuntamente con otro miembro del equipo antes de continuar.|

### 6.2 Flujo de trabajo paso a paso

*(Describe en tus propias palabras, con la secuencia numerada, cómo fluye el trabajo desde que alguien decide hacer una tarea hasta que esa tarea está integrada en el código principal y desplegada.)*

1. El equipo selecciona una tarea del backlog en el tablero de gestión del proyecto.

2. El miembro responsable crea una nueva rama a partir de la rama principal (main) utilizando el formato acordado.

3. El desarrollador implementa la funcionalidad realizando commits frecuentes con mensajes claros que describan los cambios realizados.

4. Cuando la tarea está terminada, el desarrollador crea una pull request para integrar su rama con la rama principal del proyecto.

5. Otro miembro del equipo revisa el código y comprueba que funciona correctamente antes de aprobar la pull request.

6. Una vez aprobada la revisión, Karim realiza el merge a la rama principal (main).

7. Tras integrar los cambios, se actualiza el tablero de tareas indicando que la tarea está completada.

8. Al finalizar cada iteración, se realiza un despliegue al entorno de pruebas para verificar el funcionamiento del sistema.






---

---

## Tarea 7 — Definición de "hecho" (DoD)

**Responsable:** Curra

**Criterio de evaluación:** CE3.4 — Se han determinado los procedimientos para la ejecución de las tareas.

**Enunciado:**  
Define la **lista de condiciones que cualquier tarea debe cumplir para considerarse terminada**. Esta lista —llamada Definición de "hecho" o DoD (del inglés *Definition of Done*)— evita que el equipo tenga criterios distintos sobre cuándo algo está acabado.

Redacta una DoD con un **mínimo de 6 condiciones**. Cada condición debe ser verificable: no vale "el código es de calidad", pero sí vale "el código se ejecuta sin errores y ha sido revisado por otro miembro". Para cada condición, indica también cómo se comprueba.

Después, aplica la DoD a una historia de usuario del MVP: identifica qué habría que hacer concretamente para que esa historia cumpla cada punto de la DoD.

*Extensión orientativa: 1 página.*

---

**Entrega:**

### 7.1 Definición de "hecho" del equipo

| Condición para dar una tarea por terminada | ¿Cómo se verifica? |
|---|---|
| El código se ejecuta sin errores | Revisión manual; no hay errores en los logs del servidor |
| El flujo funciona correctamente con datos de prueba | Prueba manual documentada (quién la hizo, qué hizo, qué resultado esperaba) |
| El código ha sido revisado por otro miembro del equipo | Revisión de la pull request por otro miembro del equipo antes del merge.|
| El código está subido al repositorio y fusionado con la rama principal |Comprobación en el repositorio de GitHub de que el código está integrado en la rama main. |
| La funcionalidad respeta los roles de usuario definidos (administrador, camarero, cocina) |Prueba manual iniciando sesión con diferentes usuarios de prueba para verificar los permisos. |
| La funcionalidad está probada en el entorno de desarrollo o de pruebas |Verificación de que la funcionalidad funciona correctamente tras desplegarla en el entorno de pruebas. |

> *Añade más condiciones si el equipo las considera necesarias para vuestro proyecto concreto.*

### 7.2 Aplicación de la DoD a una historia del MVP

**Historia elegida:** Como camarero, quiero registrar una comanda en el sistema para que la cocina pueda verla y prepararla.

| Condición de la DoD | ¿Qué habría que hacer concretamente para que esta historia la cumpla? |
|---|---|
| El código se ejecuta sin errores | Implementar el formulario de creación de pedidos y comprobar que no genera errores al ejecutarse.|
| El flujo funciona con datos de prueba |Crear productos ficticios en la base de datos y realizar una prueba registrando un pedido con ellos. |
| El código ha sido revisado por otro miembro del equipo | Otro miembro del equipo revisa la pull request antes de aprobar el merge en el repositorio.|
| El código está subido al repositorio y fusionado con la rama principal |Subir la funcionalidad a GitHub y comprobar que se ha integrado correctamente en la rama main. |
| La funcionalidad respeta los roles de usuario |Iniciar sesión con un usuario con rol de camarero y comprobar que puede crear pedidos, mientras que otros roles tienen accesos distintos. |
| La funcionalidad está probada en el entorno de pruebas| Desplegar la versión actualizada en el entorno de pruebas y verificar que el sistema registra correctamente los pedidos.|

---

---

## Tarea 8 — Registro de riesgos y plan de prevención de riesgos laborales

**Responsable:** David

**Criterio de evaluación:** CE3.5 — Se han identificado los riesgos inherentes a la ejecución del proyecto, definiendo el plan de prevención de riesgos y los medios necesarios.

**Enunciado:**  
Esta tarea tiene dos partes.

**Parte A — Registro de riesgos del proyecto:** Identifica y documenta un **mínimo de 6 riesgos** que podrían afectar a la ejecución del proyecto. Para cada riesgo indica su tipo, probabilidad, impacto, la señal que te avisaría de que está ocurriendo, la medida de mitigación (qué hacer para que no ocurra) y el plan B (qué hacer si ocurre igualmente).

Debes incluir obligatoriamente:
- Al menos **2 riesgos técnicos** específicos de vuestro proyecto (no genéricos).
- Al menos **1 riesgo de seguridad o privacidad de datos**.
- Al menos **1 riesgo de gestión del equipo** (ausencia, bloqueo, retraso de un miembro).
- Al menos **1 riesgo relacionado con un servicio externo** (entorno de despliegue, API, correo, etc.).

**Parte B — Plan de prevención de riesgos laborales:** Documenta los riesgos para la salud que conlleva el trabajo de desarrollo (trabajo prolongado frente a pantallas) y las medidas preventivas concretas que el equipo aplicará durante el proyecto. Incluye un **mínimo de 3 riesgos laborales** con su causa y medida preventiva.

*Extensión orientativa: 1–2 páginas.*

---

**Entrega:**

### Parte A — Registro de riesgos del proyecto

| Riesgo identificado | Tipo | Probabilidad (A/M/B) | Impacto (A/M/B) | Señal de que está ocurriendo | Medida de mitigación | Plan B |
|---|---|---|---|---|---|---|
| Error en la estructura de la base de datos que impida guardar correctamente los pedidos| Técnico | M| A|Los pedidos no se guardan correctamente o aparecen errores al consultar la base de datos |Diseñar el modelo de datos antes de implementarlo y revisar las migraciones |Corregir la estructura de la base de datos y realizar una migración que ajuste las tablas |
| Fallos en la comunicación entre backend y frontend al registrar pedidos| Técnico |M |M |El formulario de pedido se envía pero el sistema no registra la información |Probar los endpoints con herramientas de prueba y revisar la API durante el desarrollo |Simplificar el flujo de creación de pedidos o revisar las rutas de la API |
| Acceso no autorizado al sistema o exposición de credenciales| Seguridad | B|A | Intentos de acceso incorrectos o uso de credenciales no autorizadas| Implementar autenticación por roles y no compartir credenciales del sistema|Cambiar contraseñas y limitar el acceso a usuarios autorizados |
| Retraso en una tarea porque un miembro del equipo no puede continuar con el trabajo | Gestión |M |M |Una tarea permanece bloqueada durante varios días sin avances |Mantener comunicación frecuente y documentar el trabajo realizado | Redistribuir la tarea entre los otros miembros del equipo|
| Problemas con el servidor de despliegue o falta de acceso al entorno de pruebas| Externo | M|M | No se puede acceder al servidor o el despliegue falla|Preparar el entorno con antelación y probar el despliegue antes de la entrega | Realizar la demostración utilizando un entorno local|
| Conflictos frecuentes en el repositorio al integrar cambios de diferentes miembros | Técnico| M| B|Aparición frecuente de conflictos en las ramas al hacer merge | Usar ramas por funcionalidad y realizar commits frecuentes|Revisar los conflictos manualmente y coordinar los cambios entre los miembros del equipo |

> *Tipo puede ser: Técnico / Seguridad / Gestión / Externo / Datos / Económico / Otro.*

### Parte B — Plan de prevención de riesgos laborales

| Riesgo laboral | Causa habitual | Medida preventiva que aplicará el equipo |
|---|---|---|
| Fatiga visual|Uso prolongado de pantallas durante el desarrollo | Realizar pausas breves cada 45–60 minutos y ajustar el brillo de la pantalla|
| Dolor de espalda o cuello| Postura incorrecta al trabajar frente al ordenador durante muchas horas| Utilizar una postura adecuada y ajustar la altura de la silla y la pantalla|
| Estrés por sobrecarga de trabajo |Acumulación de tareas o plazos ajustados |Planificar el trabajo por iteraciones y repartir las tareas entre los miembros del equipo |

### Compromiso del equipo

El equipo se compromete a aplicar las medidas de prevención indicadas, realizando pausas periódicas durante el trabajo frente al ordenador, manteniendo una postura adecuada y comunicando cualquier problema relacionado con la carga de trabajo para poder redistribuir 
las tareas cuando sea necesario.

---

---

## Tarea 9 — Estimación de costes (desarrollo y producción)

**Responsable:** David

**Criterio de evaluación:** CE3.7 — Se ha hecho la valoración económica que da respuesta a las condiciones de la ejecución del proyecto.

**Enunciado:**  
Elabora la estimación de costes del proyecto en dos momentos:

- **Durante el desarrollo**: qué recursos usa el equipo para construir el proyecto, qué alternativa gratuita o educativa se utilizará y cuál sería el coste real equivalente si fuera un proyecto profesional.
- **En producción**: qué costaría mantener el sistema en marcha durante un año si lo usaran clientes reales.

Para cada partida de la estimación en producción, **justifica la estimación con un argumento concreto** (número de usuarios previstos, volumen de datos, correos/mes estimados, etc.). No basta con poner un número: explica por qué crees que ese número es razonable.

Al terminar, responde: ¿sería el sistema sostenible económicamente para el cliente que identificaste en el RA1?

*Extensión orientativa: 1 página.*

---

**Entrega:**

### 9.1 Costes durante el desarrollo (fase de construcción)

| Recurso | Opción para el proyecto académico | Coste estimado | Alternativa real (si fuera un proyecto profesional) |
|---|---|---|---|
| Entorno de despliegue | Servidor de pruebas | 0 € (educativo) | Servidor VPS en proveedor cloud (AWS)|
| Base de datos | MySQL| 0 € | Servicio gestionado de base de datos en la nube|
| Repositorio de código |GitHub con repositorio privado | 0 € |GitHub Team |
| Herramientas de desarrollo | Visual Studio Code y herramientas gratuitas de desarrollo| 0 € |Licencias profesionales de IDEs o herramientas de desarrollo |
| Navegadores y herramientas de prueba |Navegadores web gratuitos y herramientas de desarrollo del navegador | 0 € |Herramientas profesionales de testing automatizado |
| Datos de prueba |Datos ficticios generados por el equipo |0 € |Generadores de datos o bases de datos de prueba comerciales |

### 9.2 Estimación de costes en producción (si el sistema se pusiera en marcha de verdad)

| Partida de coste | Descripción y justificación | Estimación mensual | Estimación anual |
|---|---|---|---|
| Servidor / hosting |Servidor VPS básico capaz de alojar la aplicación web y la base de datos. Un restaurante pequeño tendría pocos usuarios simultáneos (camareros y cocina), por lo que un servidor básico sería suficiente. |10 € | 120 €|
| Base de datos | Base de datos MySQL incluida en el servidor o en un servicio básico gestionado para aplicaciones pequeñas.|0–5 € | 0–60 €|
| Dominio web |Dominio para acceder al sistema desde el navegador (por ejemplo, restaurante-app.com). |— | 10 €|
| Certificado SSL/HTTPS | Certificado para garantizar conexiones seguras. Puede usarse un certificado gratuito como Let's Encrypt.| 0 €| 0 €|
| Correo y notificaciones  | En este proyecto no se prevé un uso intensivo de correos electrónicos, por lo que se podría utilizar un servicio gratuito para notificaciones básicas.|0–2 € |0–24 € |
| Copias de seguridad | Sistema de backup periódico de la base de datos para evitar pérdida de información.|2 € | 24 €|
| **Total estimado** |Coste aproximado de mantener el sistema funcionando para un restaurante pequeño. |≈12–17 € | ≈150–200 €|

### 9.3 Conclusión sobre sostenibilidad económica

El coste estimado para mantener el sistema en producción sería relativamente bajo, aproximadamente entre 150 y 200 € al año. Para un restaurante pequeño o mediano este coste sería asumible, especialmente si el sistema mejora la gestión de pedidos y la organización del trabajo entre camareros y cocina. Los costes podrían aumentar si el sistema creciera y tuviera que atender a muchos restaurantes o usuarios simultáneos, pero para el escenario planteado en el proyecto se considera económicamente sostenible.

---

---

## Tarea 10 — Plan de despliegue

**Responsable:** David

**Criterio de evaluación:** CE3.8 — Se ha definido y elaborado la documentación necesaria para la ejecución del proyecto.

**Enunciado:**  
Documenta el **plan de despliegue** del proyecto: los pasos que hay que seguir para poner el sistema en funcionamiento en un servidor desde cero. Este documento debe ser lo suficientemente completo como para que alguien del equipo que no ha trabajado en el despliegue pueda hacerlo siguiendo los pasos sin preguntar nada.

El plan debe cubrir: cómo obtener el código, cómo instalar las dependencias, cómo configurar las variables de entorno, cómo crear y poblar la base de datos, cómo arrancar el servidor y cómo verificar que el despliegue ha sido correcto.

Además, incluye una **lista de comprobación post-despliegue**: las verificaciones que debes hacer una vez el sistema está arriba para confirmar que todo funciona correctamente antes de darlo por válido.

*Extensión orientativa: 1–2 páginas.*

---

**Entrega:**

### 10.1 Plan de despliegue paso a paso

| Paso | Descripción de la acción | Comando o acción concreta | ¿Cómo sé que ha funcionado? |
|---|---|---|---|
| 1. Obtener el código | Clonar el repositorio en el servidor | `git clone <url-del-repositorio>` | El directorio aparece con todos los ficheros del proyecto |
|2. Acceder al directorio del proyecto|Entrar en la carpeta donde se ha clonado el proyecto.|cd repositorio|El terminal muestra que estamos dentro del directorio del proyecto.|
| 3. Instalar dependencias |Instalar las dependencias necesarias para ejecutar la aplicación. |npm install o composer install | El gestor de paquetes descarga las dependencias sin errores.|
| 4. Configurar variables de entorno | Crear el archivo de configuración del entorno a partir del archivo de ejemplo.| cp .env.example .env| El archivo .env aparece en la carpeta del proyecto.|
|5. Configurar acceso a base de datos|Editar el archivo .env para introducir los datos de conexión a la base de datos.|Editar variables DB_HOST, DB_NAME, DB_USER, DB_PASSWORD|El archivo queda guardado con la configuración correcta.|
| 6. Crear la base de datos | Crear la base de datos en el servidor de base de datos (MySQL).|CREATE DATABASE nombre_proyecto; | La base de datos aparece en el listado de bases de datos del servidor.|
| 7. Ejecutar las migraciones |Crear las tablas necesarias en la base de datos a partir de las migraciones del proyecto. | php artisan migrate (si se usa Laravel) o script equivalente|Las tablas aparecen correctamente en la base de datos. |
| 8. Cargar datos iniciales  |Insertar datos iniciales necesarios para probar el sistema (usuarios de prueba, roles, etc.). | php artisan db:seed o script SQL| Los datos aparecen en las tablas correspondientes.|
| 9. Arrancar la aplicación | Iniciar el servidor de la aplicación para que el sistema esté accesible desde el navegador.|npm start o php artisan serve | El servidor indica que la aplicación está ejecutándose.|
| 10. Verificar funcionamiento | Acceder al sistema desde un navegador para comprobar que responde correctamente.|Abrir http://localhost:8000 o la URL del servidor |La página principal del sistema se carga correctamente. |

> *Adapta los pasos a la tecnología de tu proyecto. Si usas Docker, incluye los comandos docker-compose correspondientes. Si usas Laravel, incluye `php artisan migrate`. Si usas Node.js, incluye `npm install` y el script de inicio. Sé concreto: evita "instala las dependencias" sin especificar el comando exacto.*

### 10.2 Variables de entorno necesarias

*(Lista las variables de entorno que hay que configurar antes de arrancar el sistema. No escribas los valores reales; escribe el nombre de la variable y una descripción de qué contiene. Ejemplo: `DB_PASSWORD` — Contraseña de acceso a la base de datos.)*

| Variable de entorno | Descripción | ¿Dónde se obtiene? |
|---|---|---|
| `APP_ENV` | Entorno de ejecución (development / production) | Definido por el equipo |
| `DB_HOST` | Dirección del servidor de base de datos | Servicio de hosting elegido |
| `APP_URL`|Dirección base de la aplicación web. | Configuración del servidor|
| `DB_NAME` | Nombre de la base de datos utilizada por la aplicación.| Creada por el equipo|
| `DB_USER` | Usuario con permisos de acceso a la base de datos.| Configurado en el servidor|
| `DB_PASSWORD` | Contraseña del usuario de la base de datos.| Configurado en el servidor|


### 10.3 Lista de comprobación post-despliegue

*(Marca cada punto con ✅ cuando hayas verificado que funciona correctamente en el entorno desplegado.)*

- [ ] El sistema responde en la URL de producción sin errores de conexión.
- [ ] Es posible iniciar sesión con cada tipo de rol (prueba con un usuario de cada rol).
- [ ] El flujo principal del MVP funciona de principio a fin con datos de prueba.
- [ ] El control de acceso es correcto: cada rol solo ve y puede hacer lo que le corresponde.
- [ ] La comunicación usa HTTPS (el navegador muestra el candado).
- [ ] Es posible registrar un nuevo pedido o comanda desde la aplicación.
- [ ] Los pedidos registrados aparecen correctamente en la base de datos.

---

---

## Lista de comprobación antes de entregar

El responsable de cada tarea debe marcar la casilla confirmando que el contenido está completo y revisado.

| N.º | Tarea | Responsable | ¿Completada? |
|:---:|---|---|:---:|
| 1 | Lista de tareas técnicas y dependencias | Karim | ✅ |
| 2 | Plan de iteraciones | Karim| ✅ |
| 3 | Tabla de recursos por tarea y logística | Karim| ✅ |
| 4 | Asignación del trabajo (matriz RACI) | Karim| ✅|
| 5 | Tabla de permisos y autorizaciones | Curra| ✅ |
| 6 | Acuerdos de trabajo y flujo con el repositorio | Curra| ✅ |
| 7 | Definición de "hecho" (DoD) | Curra| ✅ |
| 8 | Registro de riesgos y plan de prevención de riesgos laborales |David | ✅ |
| 9 | Estimación de costes (desarrollo y producción) |David |✅ |
| 10 | Plan de despliegue | David| ✅ |

> *Antes de entregar: verificad que habéis eliminado las tablas de distribución que no corresponden a vuestro grupo, que todos los campos de responsable están rellenos con nombres reales, que ninguna respuesta dice "todos" o "el grupo" y que el campo "Proyecto planificado" al inicio del documento está cumplimentado.*
