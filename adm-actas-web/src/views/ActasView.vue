<template>

  <main class="m-4">

    <h2 class="text-3xl font-bold text-sky-900 ">
      Listado de actas
    </h2>

    <div v-if="errores" class="p-4 mb-4 text-red-800 border border-red-300 rounded-lg bg-red-50 ">
  <div class="flex items-center">
    <svg class="flex-shrink-0 w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
      <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
    </svg>
    <span class="sr-only">Info</span>
    <h3 class="text-lg font-medium">{{ errores.message }}</h3>
  </div>
  <div class="mt-2 mb-4 text-sm">
    <p v-for="error in errores.errors">
      {{ error }}
    </p>
  </div>
  <div class="flex">
    <button @click="borrarErrores" type="button" class="text-white bg-red-800 hover:bg-red-900 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-xs px-3 py-1.5 me-2 text-center inline-flex items-center ">
      <svg class="me-2 h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 14">
        <path d="M10 0C4.612 0 0 5.336 0 7c0 1.742 3.546 7 10 7 6.454 0 10-5.258 10-7 0-1.664-4.612-7-10-7Zm0 10a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z"/>
      </svg>
     Ocultar
    </button>
    
  </div>
</div>

    <form @submit.prevent="crear">
      <div class="flex justify-between space-x-4 my-4 ">
        <input v-model="form.titulo" type="text" class="border border-gray-200 rounded-lg px-4 py-2"
          placeholder="Nombre de la acta">
        <input v-model="form.fecha" type="date" class="border border-gray-200 rounded-lg px-4 py-2" placeholder="Fecha">
        <input v-model="form.hora" type="time" class="border border-gray-200 rounded-lg px-4 py-2" placeholder="Hora">

        <select v-model="form.reunion_id" class="border border-gray-200 rounded-lg px-4 py-2">
          <option value="-1">Seleccionar reunión</option>
          <option v-for="reunion in reuniones" :value="reunion.id">{{ reunion.nombre }}</option>
        </select>
        <button type="submit"
          class="text-white bg-sky-900 hover:bg-sky-800 focus:ring-4 focus:ring-sky-300 font-medium rounded-lg text-sm px-5 py-2.5">
          {{ modoActualizar ? 'Actualizar' : 'Crear' }}
        </button>
      </div>
      <textarea v-model="form.compromisos" class="w-full border border-gray-200 rounded-lg px-4 py-2"
        placeholder="Compromisos">
        </textarea>
    </form>

    <table class="min-w-full border divide-y divide-gray-200">
      <thead class="bg-gray-50">
        <tr>
          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            titulo
          </th>
          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Fecha
          </th>
          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Hora
          </th>
          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Compromisos
          </th>
          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Reunion ID
          </th>
          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Acciones
          </th>
        </tr>
      </thead>
      <tbody class="bg-white divide-y divide-gray-200">
        <tr v-for="acta in actas">
          <td class="px-6 py-4 whitespace-nowrap">{{ acta.titulo }}</td>
          <td class="px-6 py-4 whitespace-nowrap">{{ acta.fecha }}</td>
          <td class="px-6 py-4 whitespace-nowrap">{{ acta.hora }}</td>
          <td class="px-6 py-4 whitespace-nowrap">{{ acta.compromisos }}</td>
          <td class="px-6 py-4 whitespace-nowrap">{{ acta.reunion_id }}</td>
          <td class="flex justify-start px-6 py-4 text-right text-sm font-medium">
            <button @click="seleccionar(acta)" class="text-sky-600 hover:text-sky-800 mr-2">Editar</button>
            <button @click="eliminar(acta.id)" href="#" class="text-sky-800 hover:text-sky-900">Eliminar</button>
          </td>
        </tr>
      </tbody>
    </table>

  </main>

</template>

<script setup>
import axios from '@/axios';
import { onMounted, ref } from 'vue';

const actas = ref([]);
const reuniones = ref([]);
const errores = ref(null);

const modoActualizar = ref(false);

const form = ref({
  id: -1,
  titulo: 'Nombre de la acta',
  fecha: '2024-05-01',
  hora: '08:00:00',
  reunion_id: -1,
  compromisos: 'compromisos',
});

const resetForm = () => {
  form.value = {
    id: -1,
    titulo: 'Nombre de la acta',
    fecha: '2024-05-01',
    hora: '08:00:00',
    reunion_id: -1,
    compromisos: 'compromisos',
  };
}

const borrarErrores = () => {
  errores.value = null;
}

const leer = async () => {
  const response = await axios.get('actas/leer');
  actas.value = response.data.actas;
}

const crear = async () => {
  try {

    if (modoActualizar.value) {
      await axios.put(`actas/actualizar/${form.value.id}`, form.value);
      modoActualizar.value = false;
    } else {
      await axios.post('actas/crear', form.value);
    }
    resetForm();
    leer();
  } catch (error) {
    errores.value = error.response.data;
  }
}

const leerReuniones = async () => {
  const response = await axios.get('reuniones/leer');
  reuniones.value = response.data.reuniones;
}

const seleccionar = (acta) => {
  modoActualizar.value = true;
  form.value = acta;
}

const eliminar = async (id) => {
  await axios.delete(`actas/eliminar/${id}`);
  leer();
}

onMounted(() => {
  leer();
  leerReuniones();
});

</script>