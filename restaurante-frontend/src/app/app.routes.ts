import { Routes } from '@angular/router';
import { guestGuard } from './guards/guest-guard';
import { authGuard } from './guards/auth-guard';
import { Login } from './pages/login/login';
import { Dashboard } from './pages/dashboard/dashboard';
import { MenuComponent } from './pages/menu/menu';
import { CrearPedido } from './pages/crear-pedido/crear-pedido';
import { DetallePedidos } from './pages/detalle-pedidos/detalle-pedidos';
import { PreparacionPlatos } from './pages/preparacion-platos/preparacion-platos';
export const routes: Routes = [

  { path: '', redirectTo: 'login', pathMatch: 'full' },
  { path: 'login', component: Login,canActivate: [guestGuard] },
 // 3. GRUPO DE PÁGINAS PROTEGIDAS: Todas requieren que el AUTH guard devuelva true
  {
    path: '',
    canActivate: [authGuard], // El portero vigila la entrada a todo este bloque
    children: [
      { path: 'dashboard', component: Dashboard },
      { path: 'menu', component: MenuComponent },
      { path: 'crear-pedido', component: CrearPedido },
      { path: 'detalle-pedidos', component: DetallePedidos },
      {path: 'preparacion-platos',component: PreparacionPlatos}
    ]
  },

  // 4. Ruta Comodín: Si escriben cualquier tontería en la URL, los manda a /login
  // (Y si ya estaban logueados, el guestGuard de login los mandará automáticamente al dashboard)
  { path: '**', redirectTo: 'login' }

];
