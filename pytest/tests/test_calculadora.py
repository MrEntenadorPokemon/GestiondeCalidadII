# test_calculadora.py
from calculadora_impuestos import CalculadoraImpuestos  # Importas tu clase


def test_calcular_iva_general():
    """Prueba que el IVA general (16%) se calcule correctamente."""
    # 1. Preparación (Arrange)
    calc = CalculadoraImpuestos()

    # 2. Acción (Act)
    resultado = calc.calcular_iva(100, tipo_impuesto='general')

    # 3. Afirmación (Assert)
    assert resultado == 16.0


def test_calcular_total_reducido():
    """Prueba que el total con IVA reducido (7%) sea correcto."""
    calc = CalculadoraImpuestos()
    resultado = calc.calcular_total(200, tipo_impuesto='reducido')
    assert resultado == 214.0


def test_agregar_nueva_tasa():
    """Prueba que se puede agregar y usar una nueva tasa de impuesto."""
    calc = CalculadoraImpuestos()
    calc.agregar_tasa_impuesto('especial', 0.10)  # 10%
    resultado = calc.calcular_iva(100, tipo_impuesto='especial')
    assert resultado == 10.0