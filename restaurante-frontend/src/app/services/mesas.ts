import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class MesasService {

  apiUrl = 'https://restaurante-app-production-742f.up.railway.app/api';

  constructor(private http: HttpClient) {}

  getMesasPorZona(id: number) {

    return this.http.get(
      `${this.apiUrl}/mesas/zona/${id}`
    );

  }

}