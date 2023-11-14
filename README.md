# Trabajo Práctico Especial Web 2 API REST

## Integrantes:
- Bedini Pia Maria pbedini@alumnos.exa.unicen.edu.ar

## API:
#### Sitio web de venta de accesorios para mujeres
API para modelar y manejar productos y sus comentarios, a la vez que se los categoriza

## Endpoints:

### PRODUCTOS

---

#### Obtener productos
`/api/products` se utiliza para obtener una lista de todos los productos

**Método HTTP:** `GET`

---

#### Obtener producto con ID
`/api/products/{id}` se utiliza para obtener información detallada de un producto especificando su `id_producto`.

**Método HTTP:** `GET`

---

#### Insertar producto
`/api/products` se utiliza para crear un nuevo producto. Es necesario especificar los campos a insertar en el body.

**Método HTTP:** `POST`

---

#### Actualizar producto con ID
`/api/products/{id}` se utiliza para actualizar todos o cualquiera de los datos de un producto. Para dicha operación es necesario especificar el `id_producto` del producto a modificar y los campos en el body.

**Método HTTP:** `PUT`

---

#### Eliminar producto con ID
`/api/products/{id}` se utiliza para eliminar el producto con el `id_producto` especificado.

**Método HTTP:** `DELETE`

---

### CATEGORIAS

---

#### Obtener categorias
`/api/categories` se utiliza para obtener una lista de todos las categorias.

**Método HTTP:** `GET`

---

#### Obtener categoria con ID
`/api/categories/{id}` se utiliza para obtener información detallada de una categoria especificando su `id_categoria`.

**Método HTTP:** `GET`

---

#### Insertar categoria
`/api/categories` se utiliza para crear una nueva categoria. Es necesario especificar los campos a insertar (el id y el nombre) en el body.

**Método HTTP:** `POST`

---

#### Actualizar categoria con ID
`/api/categories/{id}` se utiliza para actualizar los datos de una categoria. Para dicha operación es necesario especificar el `id_categoria` de la categoria a modificar y los campos en el body.

**Método HTTP:** `PUT`

---

#### Eliminar categoria con ID
`/api/categories/{id}` se utiliza para eliminar la categoria con el `id_categoria` especificado.

**Método HTTP:** `DELETE`

---

### COMENTARIOS

---

#### Obtener comentarios
`/api/comments` se utiliza para obtener una lista de todos los comentarios existentes para cada uno de los productos.

**Método HTTP:** `GET`

---

#### Obtener comentarios con ID
`/api/comments/{id}` se utiliza para obtener todos los comentarios pertenecientes a un producto, por lo que es necesario especificar el `id_producto`.

**Método HTTP:** `GET`

---

#### Obtener comentarios con Order y Sort
`/api/comments/{order}/{sort}` se utiliza para obtener una lista de todos los comentarios existentes ordenados según el campo especificado Order y de manera ascendente o descendentemente según lo indique Sort.

**Método HTTP:** `GET`

---

#### Insertar comentario
`/api/comments` se utiliza para agregar un nuevo comentario. Es necesario especificar los campos a insertar en el body.

**Método HTTP:** `POST`

---

#### Actualizar comentario con ID
`/api/comments/{id}` se utiliza para actualizar un comentario. Para dicha operación es necesario especificar el `id_comentario` del comentario a modificar y los campos en el body.

**Método HTTP:** `PUT`

---

#### Eliminar comentario con ID
`/api/comments/{id}` se utiliza para eliminar el comentario con el `id_comentario` especificado.

**Método HTTP:** `DELETE`

