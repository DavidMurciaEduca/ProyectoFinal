import { Component, OnInit,ChangeDetectorRef } from '@angular/core';
import { CommonModule } from '@angular/common';
import { Pedidos } from '../../services/pedidos';
import { FormsModule } from '@angular/forms';
import { MesasService } from '../../services/mesas';
import { ProductosService } from '../../services/productos';
import { CategoriasService } from '../../services/categorias';
@Component({
  selector: 'app-detalle-pedidos',
  standalone: true,
  imports: [CommonModule,FormsModule],
  templateUrl: './detalle-pedidos.html',
  styleUrl: './detalle-pedidos.css'
})
export class DetallePedidos implements OnInit {

  usuario: any = null;
  pedidos: any[] = [];
  totalFinalizados = 0;
  mostrarModal = false;
  pedidoSeleccionado: any = null;

  mostrarModalEditar = false;
  pedidoEditando: any = null;
  mesaEditando = null;
  productosEditando: any[] = [];
  mesas: any[] = [];

  mostrarModalEliminar = false;
  pedidoAEliminar: number | null = null;
  mostrarMensaje = false;
  mensajeExito ='';
  mensajeError='';
  mesaEditandoNumero=null;
  mostrarModalProductosEditar = false;
  productos: any[] = [];
  categorias: any[] = [];
  nombreBusqueda = '';
  categoriaSeleccionada = '';
  baseUrl =
    'http://localhost/restaurante_proyecto/restaurante-app/public/storage/';
  itemEditandoIndex: number | null = null;
  pedido: any[] = [];
  mostrarModalProductos = false;
  paginaActual = 1;
  productosPorPagina = 6;
  todoLosPedidos = false;
  constructor(
    private pedidosService: Pedidos,
    private mesasService: MesasService,
    private productosService: ProductosService,
    private categoriasService: CategoriasService,
    private cdr: ChangeDetectorRef
  ) {}

  ngOnInit() {

  setTimeout(() => {

    const usuarioGuardado =
      localStorage.getItem('usuario');

    if (usuarioGuardado) {

      this.usuario =
        JSON.parse(usuarioGuardado);

      this.cargarPedidos();
      this.cargarMesas();
      this.cdr.detectChanges();

    }

  }, 100);
  this.cargarProductos();
      this.cargarCategorias();
}
  cargarPedidos() {

  if (!this.usuario?.id) {

    return;

  }

  this.pedidosService
    .getMisPedidos(this.usuario.id)
    .subscribe({

      next: (res: any) => {

        this.pedidos = res.pedidos;

        this.totalFinalizados =
          res.total_finalizados;
        this.todoLosPedidos = true;
        this.cdr.detectChanges();

      },

      error: (err) => {

        console.log(err);

      }

    });

}
  verPedido(id: number) {

  // 🔥 abrir modal inmediatamente
  this.mostrarModal = true;

  // limpiar pedido anterior
  this.pedidoSeleccionado = null;

  // cargar pedido
  this.pedidosService
    .getPedido(id)
    .subscribe({

      next: (res: any) => {
        this.pedidoSeleccionado = res;
        this.cdr.detectChanges();

      },

      error: (err) => {

        console.log(err);

      }

    });

}
editarPedido(id: number) {
  this.mostrarModalEditar = true;

  this.pedidoEditando = null;

  this.pedidosService
    .getPedido(id)
    .subscribe({

      next: (res: any) => {

        this.pedidoEditando = res;
        // mesa
        this.mesaEditando= res.mesa_id;
        // productos
        this.productosEditando = res.items.map((item: any) => ({

          id: item.id,

          producto_id: item.producto_id,

          nombre: item.producto.nombre,

          cantidad: item.cantidad,

          notas: item.notas,

          precio: item.precio_unitario
          

        }));
        this.cdr.detectChanges();
      },

      error: (err) => {

        console.log(err);

      }

    });

}
cargarMesas() {

  this.mesasService
    .getMesasPorZona(this.usuario.zona_id)
    .subscribe({

      next: (res: any) => {
        console.log(res)
        this.mesas = res;

      },

      error: (err) => {

        console.log(err);

      }

    });

}
guardarEdicionPedido() {

  const data = {

    mesa_id: this.mesaEditando,

    productos: this.productosEditando

  };

  this.pedidosService
    .editarPedido(
      this.pedidoEditando.id,
      data
    )
    .subscribe({

      next: (res) => {
        
        this.mensajeExito =
          '🍽️ Pedido modificado correctamente';
        this.mostrarMensaje = true;
        

        this.cargarPedidos();

      },

      error: (err) => {
        this.mensajeError =
          '❌ Error al modificar pedido';

        this.mostrarMensaje = true;
        this.cdr.detectChanges();
        console.log(err);

      }

    });

}
abrirEliminar(id: number) {
  this.pedidoAEliminar = id;
  this.mostrarModalEliminar = true;
}
confirmarEliminar() {

  if (!this.pedidoAEliminar) return;

  this.pedidosService.eliminarPedido(this.pedidoAEliminar).subscribe({

    next: () => {

      // quitar de la lista
      this.pedidos = this.pedidos.filter(
        p => p.id !== this.pedidoAEliminar
      );

      // cerrar modal
      this.mostrarModalEliminar = false;
      this.pedidoAEliminar = null;

      // recalcular total
      this.totalFinalizados = this.pedidos
        .filter(p => p.estado === 'finalizado')
        .reduce((sum, p) => sum + Number(p.importe_total), 0);
      this.cdr.detectChanges();
    },

    error: (err) => {
      console.log(err);
    }

  });

}
servir(id: number){
   this.pedidosService
    .servirPlato(id)
    .subscribe({

      next: () => {
        const pedido = this.pedidos.find(
          p => p.id === id
        );
        if (pedido) {

          pedido.estado = 'servido';

        }
        this.cdr.detectChanges();
      },
      error: (err) => {
        console.log(err);
      }

    });
}
finalizarPedido(id: number) {

  this.pedidosService
    .finalizarPedido(id)
    .subscribe({

      next: () => {

        // actualizar pedido en tabla
        const pedido = this.pedidos.find(
          p => p.id === id
        );

        if (pedido) {

          pedido.estado = 'finalizado';

        }

        // recalcular total
        this.totalFinalizados = this.pedidos
          .filter(p => p.estado === 'finalizado')
          .reduce(
            (sum, p) =>
              sum + Number(p.importe_total),
            0
          );

        this.cdr.detectChanges();

      },

      error: (err) => {

        console.log(err);

      }

    });

}
cerrarMensaje() {

  this.mostrarMensaje = false;
  this.mensajeError='';
  this.mensajeExito='';
  this.mostrarModalEditar = false;

}
  cargarProductos() {

    this.productosService
      .getProductos()
      .subscribe({

        next: (data: any) => {

          this.productos = data;

        },

        error: (err) => {

          console.log(err);

        }

      });

  }
  cargarCategorias() {

    this.categoriasService
      .getCategorias()
      .subscribe({

        next: (data: any) => {

          this.categorias = data;

        },

        error: (err) => {

          console.log(err);

        }

      });

  }
   get productosFiltrados() {

    return this.productos.filter((p) => {

      // FILTRO NOMBRE
      const coincideNombre =
        p.nombre.toLowerCase()
        .includes(this.nombreBusqueda.toLowerCase());

      // FILTRO CATEGORÍA
      const coincideCategoria =

        this.categoriaSeleccionada === ''

        ||

        p.categoria_id == this.categoriaSeleccionada;

      return (

        coincideNombre

        &&

        coincideCategoria

      );

    });

  }
   get productosPaginados() {

    const inicio =

      (this.paginaActual - 1)

      *

      this.productosPorPagina;

    const fin =

      inicio + this.productosPorPagina;

    return this.productosFiltrados.slice(
      inicio,
      fin
    );

  }

  get totalPaginas() {

    return Math.ceil(

      this.productosFiltrados.length

      /

      this.productosPorPagina

    );

  }

  paginaSiguiente() {

    if (this.paginaActual < this.totalPaginas) {

      this.paginaActual++;

    }

  }

  paginaAnterior() {

    if (this.paginaActual > 1) {

      this.paginaActual--;

    }

  }
    getImage(url: string) {

    return this.baseUrl + url;

  }
   agregarProducto(producto: any) {

  // =========================
  // 🔥 MODO EDICIÓN
  // =========================
  if (this.itemEditandoIndex !== null) {

    const item = this.pedido[this.itemEditandoIndex];

    item.producto_id = producto.id;
    item.nombre = producto.nombre;
    item.precio = producto.precio;

    // cerrar modal
    this.mostrarModalProductos = false;

    // reset modo edición
    this.itemEditandoIndex = null;

    return;
  }

  // =========================
  // ➕ MODO NORMAL (NUEVO)
  // =========================
  const existe = this.pedido.find(
    item => item.producto_id === producto.id
  );

  if (existe) {

    existe.cantidad++;

    this.mostrarModalProductos = false;

    return;
  }

  this.pedido.push({

    producto_id: producto.id,
    nombre: producto.nombre,
    cantidad: 1,
    notas: '',
    precio: producto.precio

  });

  this.mostrarModalProductos = false;
}
agregarProductoEdicion(producto: any) {

  const existe = this.productosEditando.find(
    p => p.producto_id === producto.id
  );

  if (existe) {

    existe.cantidad++;

  } else {

    this.productosEditando.push({
      producto_id: producto.id,
      nombre: producto.nombre,
      cantidad: 1,
      notas: ''
    });

  }

  this.mostrarModalProductosEditar = false;
}
cerrarModal() {
  this.mostrarModalProductos = false;
  this.itemEditandoIndex = null;
}
  resetFiltros() {

    this.nombreBusqueda = '';

    this.categoriaSeleccionada = '';

    this.paginaActual = 1;

  }
}
