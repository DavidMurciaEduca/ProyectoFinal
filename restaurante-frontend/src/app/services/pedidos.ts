import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
@Injectable({
  providedIn: 'root',
})
export class Pedidos {
  apiUrl = 'https://restaurante-app-production-742f.up.railway.app/api';
   constructor(private http: HttpClient) {}
  crearPedido(data: any) {
      return this.http.post(
        'https://restaurante-app-production-742f.up.railway.app/api/pedidos',
        data
      );
    }
  getMisPedidos(usuarioId: number) {
    return this.http.get(
      `${this.apiUrl}/mis-pedidos/${usuarioId}`
    );
  }
  getPedido(id: number) {
    return this.http.get(
      `${this.apiUrl}/pedido/${id}`
    );

  }
  editarPedido(id: number, data: any) {

  return this.http.put(

    `${this.apiUrl}/pedidos/${id}`,

    data

  );

}
eliminarPedido(id: number) {
    return this.http.delete(`${this.apiUrl}/pedidos/${id}`);
  }
finalizarPedido(id: number) {

  return this.http.put(

    `${this.apiUrl}/pedidos/${id}/finalizar`,
    {}

  );

}
getPlatosListos(usuarioId: number) {

  return this.http.get(
    `${this.apiUrl}/${usuarioId}/platos-listos`
  );

}
servirPlato(id: number) {

  return this.http.put(
    `${this.apiUrl}/pedido/${id}/servir`,
    {}
  );

}
getPedidosCocina() {

  return this.http.get(
    `${this.apiUrl}/pedidos-cocina`
  );

}
actualizarEstado(id: number,estado: string) {

  return this.http.put(

    `${this.apiUrl}/pedidos/${id}/estado`,{estado}

  );

}


}
