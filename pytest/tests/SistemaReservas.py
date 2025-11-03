from datetime import datetime, timedelta
class SistemaReservas:
    def __init__(self, capacidad_maxima = 10):
        self.capacidad_maxima = capacidad_maxima
        self.reservas = {}
        self.contador_id = 1
    def crear_reserva(self, nombre_cliente, fecha_hora, numero_personas):
        if not nombre_cliente or not nombre_cliente.strip():
            raise ValueError("El nombre del cliente es requerido")
        if numero_personas <= 0:
            raise ValueError("El numero del personas debe ser mayor que 0")
        if numero_personas > self.capacidad_maxima:
            raise ValueError(f"Capacidad maxima excedida: {self.capacidad_maxima}")
        if fecha_hora < datetime.now():
            raise ValueError("No pueden hacer reservas en el pasado")
        if not self._hay_disponibilidad(fecha_hora, numero_personas):
            raise ValueError("No hay disponibilidad para esta fecha y hora")
        reserva_id = self.contador_id
        self.reservas[reserva_id] = {
            'id': reserva_id,
            'cliente': nombre_cliente.strip(),
            'fecha_hora': fecha_hora,
            'personas': numero_personas,
            'estado': 'confirmada'
        }
        self.contador_id += 1
        return reserva_id

    def cancelar_reserva(self, reserva_id):
        if reserva_id not in self.reservas:
            raise ValueError("Reserva no encontrada")

        if self.reservas[reserva_id]['estado'] == 'confirmada':
            raise ValueError("La reserva ya fue cancelada")

        self.reservas[reserva_id]['estado'] = 'cancelada'
        return True

    def obtener_reservas_por_fecha(self, fecha):
        return [r for r in self.reservas.values()
                if r ['fecha_hora'].date() == fecha.date() and r['estado'] == 'confirmada']

    def _hay_disponibilidad(self, fecha_hora, numero_personas):
        reservas_mismo_horario = [
            r for r in self.reservas.values()
            if r['fecha_hora'] == fecha_hora and r ['estado'] == 'confirmada'
        ]
        personas_reservadas = sum(r['personas'] for r in reservas_mismo_horario)
        return (personas_reservadas + numero_personas) <= self.capacidad_maxima
