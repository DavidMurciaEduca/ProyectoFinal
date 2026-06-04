import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { ProductosService } from '../../services/productos';
import { ChangeDetectorRef } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { CategoriasService } from '../../services/categorias';
@Component({
  selector: 'app-menu',
  standalone: true,
  imports: [CommonModule,FormsModule],
  templateUrl: './menu.html',
  styleUrl: './menu.css'
})
export class MenuComponent implements OnInit {

  productos: any[] = [];
  baseUrl = 'http://localhost:8000/storage/';
  paginaActual = 1;
  productosPorPagina = 6;
  nombreBusqueda = '';
  categoriaSeleccionada = '';
  estadoSeleccionado = '';
  categorias: any[] = [];
  productoSeleccionado: any = null;
  modalAbierto = false;
  constructor(
    private productosService: ProductosService,
    private categoriasService: CategoriasService,
    private cdr: ChangeDetectorRef
  ) {}

  ngOnInit() {
    this.cargarProductos();
     this.cargarCategorias();
  }
  get productosPaginados() {

  const inicio =
    (this.paginaActual - 1)
    *
    this.productosPorPagina;

  const fin =
    inicio + this.productosPorPagina;

  return this.productosFiltrados.slice(inicio, fin);

}
cargarCategorias() {

  this.categoriasService.getCategorias().subscribe({

    next: (data: any) => {

      this.categorias = data;

    },

    error: (err) => {

      console.log(err);

    }

  });

}
abrirProducto(producto: any) {

  this.productoSeleccionado = producto;

  this.modalAbierto = true;

}
cerrarModal() {

  this.modalAbierto = false;

  this.productoSeleccionado = null;

}
get totalPaginas() {

  return Math.ceil(
    this.productosFiltrados.length / this.productosPorPagina
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
  cargarProductos() {

    this.productosService.getProductos().subscribe({

      next: (data: any) => {
        this.productos = data;
        this.cdr.detectChanges();
      },

      error: (err) => {
        console.log('Error cargando productos', err);
      }

    });

  }
  get productosFiltrados() {

    return this.productos.filter((p) => {

      // NOMBRE
      const coincideNombre =
        p.nombre.toLowerCase()
        .includes(this.nombreBusqueda.toLowerCase());

      // CATEGORÍA
      const coincideCategoria =
        this.categoriaSeleccionada === ''
        ||
        p.categoria_id == this.categoriaSeleccionada;

      // ESTADO
      const coincideEstado =
        this.estadoSeleccionado === ''
        ||
        p.activo == this.estadoSeleccionado;

      return (
        coincideNombre
        &&
        coincideCategoria
        &&
        coincideEstado
      );

  });

}
resetFiltros() {

  this.nombreBusqueda = '';

  this.categoriaSeleccionada = '';

  this.estadoSeleccionado = '';

  this.paginaActual = 1;

}
  getImage(url: string) {
    console.log(this.baseUrl + url)
    return this.baseUrl + url;
  }
}