import { Injectable } from '@angular/core';

import { HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class CategoriasService {

  apiUrl = 'http://localhost:8000/api/categorias';

  constructor(private http: HttpClient) {}

  getCategorias() {
    return this.http.get(this.apiUrl);
  }

}