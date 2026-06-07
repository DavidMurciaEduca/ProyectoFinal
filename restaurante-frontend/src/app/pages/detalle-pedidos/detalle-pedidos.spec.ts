import { ComponentFixture, TestBed } from '@angular/core/testing';

import { DetallePedidos } from './detalle-pedidos';

describe('DetallePedidos', () => {
  let component: DetallePedidos;
  let fixture: ComponentFixture<DetallePedidos>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [DetallePedidos],
    }).compileComponents();

    fixture = TestBed.createComponent(DetallePedidos);
    component = fixture.componentInstance;
    await fixture.whenStable();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
