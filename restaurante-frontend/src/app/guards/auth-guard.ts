import { inject } from '@angular/core';
import { CanActivateFn, Router } from '@angular/router';
import { AuthService } from '../services/auth';

export const authGuard: CanActivateFn = (route, state) => {
 const router = inject(Router);
  const token = localStorage.getItem('token');

  // Si el usuario TIENE un token, le damos luz verde para pasar
  if (token) {
    return true;
  }

  // Si NO tiene token, lo redirigimos al login y bloqueamos el acceso
  router.navigate(['/login']);
  return false;
};
