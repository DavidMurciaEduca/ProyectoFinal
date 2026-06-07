import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { ProductosService } from '../../services/productos';
import { MesasService } from '../../services/mesas';
import { CategoriasService } from '../../services/categorias';
import { Pedidos } from '../../services/pedidos';
import { ChangeDetectorRef } from '@angular/core';
@Component({
  selector: 'app-crear-pedido',
  standalone: true,
  imports: [
    CommonModule,
    FormsModule
  ],
  templateUrl: './crear-pedido.html',
  styleUrl: './crear-pedido.css'
})
export class CrearPedido implements OnInit {

  usuario: any = null;

  mesas: any[] = [];

  mesaSeleccionada = '';

  productos: any[] = [];

  categorias: any[] = [];

  baseUrl =
    'http://localhost/restaurante_proyecto/restaurante-app/public/storage/';



  nombreBusqueda = '';

  categoriaSeleccionada = '';


  mostrarModalProductos = false;

  pedido: any[] = [];

  paginaActual = 1;

  productosPorPagina = 6;
  cargandoMesas = true;
  itemEditandoIndex: number | null = null;
  mensajeExito = '';
  mensajeError='';
  mostrarMensaje = false;
  constructor(
    private productosService: ProductosService,
    private mesasService: MesasService,
    private categoriasService: CategoriasService,
    private pedidosService:Pedidos,
    private cdr: ChangeDetectorRef
  ) {}


  ngOnInit() {

    const usuarioGuardado =
      localStorage.getItem('usuario');

    if (usuarioGuardado) {

      this.usuario =
        JSON.parse(usuarioGuardado);

      // 🔥 TODO SE CARGA AL ENTRAR
      this.cargarMesas();
      this.cargarProductos();
      this.cargarCategorias();

    }

  }

  cargarMesas() {

  this.cargandoMesas = true;

  this.mesasService
    .getMesasPorZona(this.usuario.zona_id)
    .subscribe({

      next: (data: any) => {

        this.mesas = data;

        this.cargandoMesas = false;

      },

      error: (err) => {

        console.log(err);

        this.cargandoMesas = false;

      }

    });

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
  resetFiltros() {

    this.nombreBusqueda = '';

    this.categoriaSeleccionada = '';

    this.paginaActual = 1;

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
  eliminarProducto(index: number) {

    this.pedido.splice(index, 1);

  }
get totalPedido() {

  return this.pedido.reduce(

    (total, item) => {

      return total + (item.precio * item.cantidad);

    },

    0

  );

}
  abrirEditorProducto(index: number) {

  this.itemEditandoIndex = index;

  this.mostrarModalProductos = true;

}
cerrarModal() {
  this.mostrarModalProductos = false;
  this.itemEditandoIndex = null;
}
guardarPedido() {

  const pedidoFinal = {

    usuario_id: this.usuario.id,

    mesa_id: this.mesaSeleccionada,

    productos: this.pedido.map(item => ({
      producto_id: item.producto_id,
      cantidad: item.cantidad,
      notas: item.notas,
      precio: item.precio
    })),

    total: this.totalPedido

  };

  this.pedidosService
    .crearPedido(pedidoFinal)
    .subscribe({

      next: (res) => {

        // ✅ MENSAJE
        this.mensajeExito =
          '🍽️ Pedido creado correctamente';

        this.mostrarMensaje = true;
        // ✅ LIMPIAR FORMULARIO
        this.pedido = [];

        this.mesaSeleccionada = '';

        this.nombreBusqueda = '';

        this.categoriaSeleccionada = '';

        this.paginaActual = 1;

        this.mostrarModalProductos = false;
        this.cdr.detectChanges();
      

      },

      error: (err) => {
        this.mensajeError =
          '❌ Error al crear pedido';

        this.mostrarMensaje = true;
        this.cdr.detectChanges();
        setTimeout(() => {

          this.mostrarMensaje = false;

        }, 3000);

      }

    });

}
cerrarMensaje() {

  this.mostrarMensaje = false;
  this.mensajeError='';
  this.mensajeExito='';

}

}