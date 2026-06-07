import { Component, OnInit,ChangeDetectorRef } from '@angular/core';
import { Pedidos } from '../../services/pedidos';
import { CommonModule } from '@angular/common';
@Component({
  selector: 'app-preparacion-platos',
  imports: [CommonModule],
  templateUrl: './preparacion-platos.html',
  styleUrl: './preparacion-platos.css',
})
export class PreparacionPlatos implements OnInit{
  pedidos: any[] = [];
  mostrarModal = false;
  pedidoSeleccionado: any = null;
  constructor(
    private pedidosService: Pedidos,
    private cdr: ChangeDetectorRef
  ) {}

  ngOnInit() {

    this.cargarPedidos();

  }

  cargarPedidos() {

    this.pedidosService
      .getPedidosCocina()
      .subscribe({

        next: (res: any) => {
          console.log(res);
          this.pedidos = res;
          this.cdr.detectChanges();
        }

      });

  }
  ponerEnPreparacion(id: number) {

  this.pedidosService
    .actualizarEstado(
      id,
      'en_preparacion'
    )
    .subscribe(() => {

      this.cargarPedidos();

    });
}
ponerListo(id: number) {

  this.pedidosService
    .actualizarEstado(
      id,
      'listo'
    )
    .subscribe(() => {

      this.cargarPedidos();

    });

}
verPedido(id: number) {

  this.mostrarModal = true;

  this.pedidoSeleccionado = null;

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
}
