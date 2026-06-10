import { Injectable } from '@angular/core';

import { HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class CategoriasService {

  apiUrl = 'https://restaurante-app-production-742f.up.railway.app/api/categorias';

  constructor(private http: HttpClient) {}

  getCategorias() {
    return this.http.get(this.apiUrl);
  }

}