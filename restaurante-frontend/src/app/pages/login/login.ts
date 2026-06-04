import { Component } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { CommonModule } from '@angular/common';
import { AuthService } from '../../services/auth';
import { Router } from '@angular/router';
@Component({
  selector: 'app-login',
  imports: [FormsModule,CommonModule],
  templateUrl: './login.html',
  styleUrl: './login.css',
})
export class Login {
  
  email = '';
  password = '';
  errorMessage = '';
  constructor(private authService: AuthService,private router: Router) {}

  login() {

  const data = {
    email: this.email,
    password: this.password
  };

  this.authService.login(data).subscribe({

    next: (response: any) => {

      this.errorMessage = '';
      // guardar token
      localStorage.setItem('token', response.token);

      // guardar usuario
      localStorage.setItem('usuario', JSON.stringify(response.usuario));

      // 🔥 REDIRECCIÓN
      this.router.navigate(['/dashboard']);
      window.location.reload();

    },

    error: (error) => {
      this.errorMessage = 'Credenciales incorrectas';
    }

  });
}
  }

