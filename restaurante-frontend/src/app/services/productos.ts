import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class ProductosService {

  private apiUrl = 'https://restaurante-app-production-742f.up.railway.app/api';

  constructor(private http: HttpClient) {}

  getProductos() {
    return this.http.get(`${this.apiUrl}/productos`);
  }
}