import { Component } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { CommonModule } from '@angular/common';
import { AuthService } from '../../services/auth';
import { Router } from '@angular/router';
import { LoadingService } from '../../services/loading';
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
  constructor(private authService: AuthService,private router: Router,private loadingService: LoadingService) {}

  login() {

  const data = {
    email: this.email,
    password: this.password
  };
  this.loadingService.show();
  this.authService.login(data).subscribe({
     
    next: (response: any) => {
      this.loadingService.hide();

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
      this.loadingService.hide();
      this.errorMessage = 'Credenciales incorrectas';
    }

  });
}
  }

