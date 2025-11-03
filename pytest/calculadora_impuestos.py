class CalculadoraImpuestos:
    def __init__(self):
        self.tasas_impuesto = {
            'general': 0.16,
            'reducido': 0.07,
            'exento': 0.0
        }

    def calcular_iva(self, monto, tipo_impuesto='general'):
        """Calcula el IVA para un monto dado"""
        if monto < 0:
            raise ValueError("El monto no puede ser negativo")

        if tipo_impuesto not in self.tasas_impuesto:
            raise ValueError(f"Tipo de impuesto no válido: {tipo_impuesto}")

        tasa = self.tasas_impuesto[tipo_impuesto]
        iva = monto * tasa
        return round(iva, 2)

    def calcular_total(self, monto, tipo_impuesto='general'):
        """Calcula el total incluyendo IVA"""
        iva = self.calcular_iva(monto, tipo_impuesto)
        return round(monto + iva, 2)

    def agregar_tasa_impuesto(self, nombre, tasa):
        """Agrega una nueva tasa de impuesto"""
        if not isinstance(tasa, (int, float)) or tasa < 0:
            raise ValueError("La tasa debe ser un número no negativo")
        self.tasas_impuesto[nombre] = tasa