import { ComponentFixture, TestBed } from '@angular/core/testing';

import { PreparacionPlatos } from './preparacion-platos';

describe('PreparacionPlatos', () => {
  let component: PreparacionPlatos;
  let fixture: ComponentFixture<PreparacionPlatos>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [PreparacionPlatos],
    }).compileComponents();

    fixture = TestBed.createComponent(PreparacionPlatos);
    component = fixture.componentInstance;
    await fixture.whenStable();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
