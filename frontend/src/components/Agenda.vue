<template>
  <main class="custom-google-agenda">
    <!-- Botões para selecionar visualização -->
    <div class="custom-view-buttons">
      <button @click="viewMode = 'day'">Dia</button>
      <button @click="viewMode = 'week'">Semana</button>
    </div>

    <!-- Visualização por Dia -->
    <div v-if="viewMode === 'day'">
      <!-- Componente de Calendário -->
      <div class="custom-calendar">
        <h2>Selecione a data para agendar:</h2>
        <div class="custom-dates">
          <div class="custom-date" v-for="(date, index) in dates" :key="index" @click="selectDate(date)">
            <div class="custom-day">{{ formatDate(date, 'ddd') }}</div>
            <div class="custom-number">{{ formatDate(date, 'D') }}</div>
            <div class="custom-month">{{ formatDate(date, 'MMM') }}</div>
          </div>
        </div>
      </div>

      <!-- Tabela de Horários para o Dia Selecionado -->
      <div class="custom-schedule-table">
        <h2>Horários disponíveis em {{ formatDate(selectedDate, 'dddd, D MMMM') }}</h2>
        <table>
          <thead>
            <tr>
              <th>Hora</th>
              <th>Disponibilidade</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(time, timeIndex) in times" :key="timeIndex">
              <td>{{ time }}</td>
              <td
                @click="toggleAppointment(timeIndex)"
                :class="{ 'custom-selected': isSelected(timeIndex), 'custom-unavailable': isUnavailable(timeIndex) }"
              ></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Visualização por Semana -->
    <div v-if="viewMode === 'week'" class="custom-schedule-table">
      <h2>Agendamento para a Semana</h2>
      <table>
        <thead>
          <tr>
            <th>Hora / Dia</th>
            <th v-for="(date, index) in dates" :key="index">{{ formatDate(date, 'ddd D/MM') }}</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(time, timeIndex) in times" :key="timeIndex">
            <td>{{ time }}</td>
            <td
              v-for="(date, dateIndex) in dates"
              :key="dateIndex"
              :class="{ 'custom-selected': isAppointment(dateIndex, timeIndex) }"
            >
              <div v-if="isAppointment(dateIndex, timeIndex)">
                {{ getAppointmentInfo(dateIndex, timeIndex) }}
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Modal de Reserva -->
    <div v-if="selectedAppointment" class="custom-modal">
      <div class="custom-modal-content">
        <h2>Confirmar Agendamento</h2>
        <p>Data: {{ formatDate(selectedAppointment.date, 'dddd, D MMMM') }}</p>
        <p>Hora: {{ selectedAppointment.time }}</p>

        <label for="professional">Profissional:</label>
        <select v-model="selectedAppointment.professional">
          <option v-for="(professional, index) in professionals" :key="index" :value="professional">
            {{ professional }}
          </option>
        </select>

        <label for="service">Serviço:</label>
        <input type="text" v-model="selectedAppointment.service" placeholder="Digite o serviço">

        <div class="custom-buttons">
          <button @click="confirmAppointment">Confirmar</button>
          <button @click="cancelAppointment">Cancelar</button>
        </div>
      </div>
    </div>
  </main>
</template>

<script setup>
import { ref } from 'vue';

// Dados
const dates = ref([]);
const selectedDate = ref(null);
const professionals = ref(['Profissional 1', 'Profissional 2', 'Profissional 3']); // Lista de profissionais
const clients = ref(['Cliente 1', 'Cliente 2', 'Cliente 3']); // Lista de clientes
const times = ref(['09:00', '10:00', '11:00', '12:00']); // Horários disponíveis

// Estado para manter os agendamentos selecionados
const selectedAppointments = ref([]);

// Estado para detalhes do agendamento selecionado
const selectedAppointment = ref(null);

// Estado para controlar a visualização (dia ou semana)
let viewMode = ref('day');

// Funções
const formatDate = (date, format) => {
  return new Date(date).toLocaleDateString('pt-BR', { [format]: format });
};

const selectDate = (date) => {
  selectedDate.value = date;
};

const toggleAppointment = (timeIndex) => {
  if (isUnavailable(timeIndex)) return;

  const appointment = {
    date: selectedDate.value,
    time: times.value[timeIndex],
    professional: '',
    service: '',
  };

  selectedAppointment.value = appointment;
};

const isSelected = (timeIndex) => {
  const appointment = { date: selectedDate.value, time: times.value[timeIndex] };
  return selectedAppointments.value.some(a => a.date === appointment.date && a.time === appointment.time);
};

const isUnavailable = (timeIndex) => {
  const appointment = { date: selectedDate.value, time: times.value[timeIndex] };
  return selectedAppointments.value.some(a => a.date === appointment.date && a.time === appointment.time);
};

const confirmAppointment = () => {
  selectedAppointments.value.push(selectedAppointment.value);
  selectedAppointment.value = null;
};

const cancelAppointment = () => {
  selectedAppointment.value = null;
};

const isAppointment = (dateIndex, timeIndex) => {
  const appointment = { date: dates.value[dateIndex], time: times.value[timeIndex] };
  return selectedAppointments.value.some(a => a.date === appointment.date && a.time === appointment.time);
};

const getAppointmentInfo = (dateIndex, timeIndex) => {
  const appointment = selectedAppointments.value.find(a => a.date === dates.value[dateIndex] && a.time === times.value[timeIndex]);
  if (appointment) {
    return `${appointment.professional}, ${appointment.service}`;
  }
  return '';
};

// Simulação de dados de datas disponíveis (substitua com dados reais do backend)
// Aqui, estou apenas gerando algumas datas para demonstração
for (let i = 0; i < 7; i++) { // Mostra apenas uma semana (7 dias)
  const date = new Date();
  date.setDate(date.getDate() + i);
  dates.value.push(date);
}
</script>

<style scoped>
/* Estilos CSS personalizados para evitar conflitos */
.custom-google-agenda {
  width: 75vw !important;
  margin: 0 15%;
  padding: 0;
}

.custom-view-buttons {
  display: flex;
  justify-content: center;
  margin-bottom: 20px;
}

.custom-view-buttons button {
  margin-right: 10px;
  padding: 8px 16px;
  font-size: 16px;
  cursor: pointer;
  border: none;
  border-radius: 4px;
  background-color: #4CAF50;
  color: white;
}

.custom-view-buttons button:hover {
  background-color: #45a049;
}

.custom-calendar {
  margin-bottom: 20px;
}

.custom-dates {
  display: flex;
  justify-content: center; /* Centraliza os dias horizontalmente */
  flex-wrap: wrap;
}

.custom-date {
  cursor: pointer;
  width: calc(100% / 7); /* Divide em 7 colunas para uma semana */
  text-align: center;
  padding: 10px;
}

.custom-date:hover {
  background-color: #f0f0f0;
}

.custom-day {
  font-size: 12px;
  font-weight: bold;
}

.custom-number {
  font-size: 20px;
  font-weight: bold;
  margin-top: 5px;
}

.custom-month {
  font-size: 12px;
}

.custom-schedule-table {
  margin-top: 20px;
}

.custom-schedule-table table {
  width: 100%;
  border-collapse: collapse;
}

.custom-schedule-table th,
.custom-schedule-table td {
  border: 1px solid #ccc;
  padding: 10px;
  text-align: center;
}

.custom-schedule-table th {
  background-color: #f0f0f0;
  font-weight: bold;
}

.custom-schedule-table td {
  cursor: pointer;
}

.custom-selected {
  background-color: #4CAF50; /* Cor de fundo para horário selecionado */
  color: white;
}

.custom-unavailable {
  background-color: #ccc; /* Cor de fundo para horário indisponível */
  color: #666;
}

.custom-modal {
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  background-color: white;
  padding: 20px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  z-index: 999;
}

.custom-modal-content {
  max-width: 400px;
  margin: 0 auto;
}

.custom-modal-content h2 {
  margin-bottom: 10px;
}

.custom-modal-content label {
  display: block;
  margin-bottom: 5px;
}

.custom-modal-content input,
.custom-modal-content select {
  width: 100%;
  padding: 8px;
  margin-bottom: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
}

.custom-modal-content .custom-buttons {
  text-align: center;
  margin-top: 10px;
}

.custom-modal-content button {
  padding: 10px 20px;
  margin-right: 10px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  background-color: #4CAF50;
  color: white;
}

.custom-modal-content button:hover {
  background-color: #45a049;
}

@media (max-width: 768px) {
  .custom-view-buttons {
    flex-direction: column;
  }

  .custom-view-buttons button {
    margin-bottom: 10px;
  }
}
</style>
