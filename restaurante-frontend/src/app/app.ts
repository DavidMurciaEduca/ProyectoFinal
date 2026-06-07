import { Component } from '@angular/core';
import { CommonModule } from '@angular/common';
import { RouterOutlet, Router } from '@angular/router';
import { RouterModule } from '@angular/router';
@Component({
  selector: 'app-root',
  standalone: true,
  imports: [
            CommonModule,
            RouterModule
          ],
  templateUrl: './app.html',
})
export class App {

  usuario: any = null;

  menuOpen = false;
  mobileMenuOpen = false;
  constructor(private router: Router) {}

  ngOnInit() {

    const usuarioGuardado = localStorage.getItem('usuario');
    if (usuarioGuardado) {
      this.usuario = JSON.parse(usuarioGuardado);
    }
  }

  toggleMenu() {
    this.menuOpen = !this.menuOpen;
  }

  logout() {
      localStorage.removeItem('token');
      localStorage.removeItem('usuario');
      this.usuario = null;
      this.menuOpen = false;
      this.router.navigate(['/login']);
      //window.location.reload();
  }
}