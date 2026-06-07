import { Component } from '@angular/core';
import { RouterLink } from '@angular/router';
import { RouterOutlet, Router } from '@angular/router';
import { CommonModule } from '@angular/common';
@Component({
  selector: 'app-dashboard',
  imports: [RouterLink,CommonModule],  
  templateUrl: './dashboard.html',
  styleUrl: './dashboard.css',
})
export class Dashboard {
  usuario: any = null;
   constructor(private router: Router) {}
   ngOnInit() {

    const usuarioGuardado = localStorage.getItem('usuario');
    if (usuarioGuardado) {
      this.usuario = JSON.parse(usuarioGuardado);
    }
  }
}
