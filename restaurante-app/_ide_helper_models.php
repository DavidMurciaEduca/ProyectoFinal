<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * @property int $id
 * @property string $nombre
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Producto> $productos
 * @property-read int|null $productos_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Categoria newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Categoria newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Categoria query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Categoria whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Categoria whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Categoria whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Categoria whereUpdatedAt($value)
 */
	class Categoria extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $numero
 * @property int $zona_id
 * @property int $capacidad
 * @property string $estado
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Zona $zona
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Mesa newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Mesa newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Mesa query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Mesa whereCapacidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Mesa whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Mesa whereEstado($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Mesa whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Mesa whereNumero($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Mesa whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Mesa whereZonaId($value)
 */
	class Mesa extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $mesa_id
 * @property int $camarero_id
 * @property string $estado
 * @property numeric $importe_total
 * @property string|null $fecha_inicio
 * @property string|null $fecha_preparado
 * @property string|null $fecha_finalizado
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $camarero
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PedidoItem> $items
 * @property-read int|null $items_count
 * @property-read \App\Models\Mesa $mesa
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pedido newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pedido newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pedido query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pedido whereCamareroId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pedido whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pedido whereEstado($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pedido whereFechaFinalizado($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pedido whereFechaInicio($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pedido whereFechaPreparado($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pedido whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pedido whereImporteTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pedido whereMesaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pedido whereUpdatedAt($value)
 */
	class Pedido extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $pedido_id
 * @property int $producto_id
 * @property int $cantidad
 * @property numeric $precio_unitario
 * @property string|null $notas
 * @property string $estado
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Pedido $pedido
 * @property-read \App\Models\Producto $producto
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PedidoItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PedidoItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PedidoItem query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PedidoItem whereCantidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PedidoItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PedidoItem whereEstado($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PedidoItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PedidoItem whereNotas($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PedidoItem wherePedidoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PedidoItem wherePrecioUnitario($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PedidoItem whereProductoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PedidoItem whereUpdatedAt($value)
 */
	class PedidoItem extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $nombre
 * @property string|null $descripcion
 * @property numeric $precio
 * @property int $categoria_id
 * @property int $activo
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $imagen
 * @property-read \App\Models\Categoria $categoria
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Producto newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Producto newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Producto query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Producto whereActivo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Producto whereCategoriaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Producto whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Producto whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Producto whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Producto whereImagen($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Producto whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Producto wherePrecio($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Producto whereUpdatedAt($value)
 */
	class Producto extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $nombre
 * @property string $email
 * @property string $password
 * @property string|null $tipo_usuario
 * @property int $activo
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereActivo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereTipoUsuario($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $nombre
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Mesa> $mesas
 * @property-read int|null $mesas_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Zona newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Zona newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Zona query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Zona whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Zona whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Zona whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Zona whereUpdatedAt($value)
 */
	class Zona extends \Eloquent {}
}

