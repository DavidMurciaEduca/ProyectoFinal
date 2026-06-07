import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class MesasService {

  apiUrl = 'http://localhost/restaurante_proyecto/restaurante-app/public/api';

  constructor(private http: HttpClient) {}

  getMesasPorZona(id: number) {

    return this.http.get(
      `${this.apiUrl}/mesas/zona/${id}`
    );

  }

}