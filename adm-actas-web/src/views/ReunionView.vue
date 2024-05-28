<template>

  <main class="m-4">

    <h2 class="text-3xl font-bold text-sky-900 ">
      Listado de reuniones
    </h2>

    <form @submit.prevent="crear" class="flex justify-between space-x-4 my-4 ">
      <input v-model="form.nombre" type="text" class="border border-gray-200 rounded-lg px-4 py-2"
        placeholder="Nombre de la reunion">
      <input v-model="form.fecha" type="date" class="border border-gray-200 rounded-lg px-4 py-2" placeholder="Fecha">
      <input v-model="form.hora" type="time" class="border border-gray-200 rounded-lg px-4 py-2" placeholder="Hora">
      <input v-model="form.lugar" type="text" class="border border-gray-200 rounded-lg px-4 py-2" placeholder="Lugar">
      <input v-model="form.descripcion" type="text" class="border border-gray-200 rounded-lg px-4 py-2"
        placeholder="Descripción">
      <button type="submit"
        class="text-white bg-sky-900 hover:bg-sky-800 focus:ring-4 focus:ring-sky-300 font-medium rounded-lg text-sm px-5 py-2.5">
        {{ modoActualizar ? 'Actualizar' : 'Crear' }}
      </button>
    </form>

    <table class="min-w-full border divide-y divide-gray-200">
      <thead class="bg-gray-50">
        <tr>
          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            ID
          </th>
          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Nombre
          </th>
          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Fecha
          </th>
          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Hora
          </th>
          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Lugar
          </th>
          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Descripción
          </th>
          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Acciones
          </th>
        </tr>
      </thead>
      <tbody class="bg-white divide-y divide-gray-200">
        <tr v-for="acta in actas">
          <td class="px-6 py-4 whitespace-nowrap">{{ acta.id }}</td>
          <td class="px-6 py-4 whitespace-nowrap">{{ acta.nombre }}</td>
          <td class="px-6 py-4 whitespace-nowrap">{{ acta.fecha }}</td>
          <td class="px-6 py-4 whitespace-nowrap">{{ acta.hora }}</td>
          <td class="px-6 py-4 whitespace-nowrap">{{ acta.lugar }}</td>
          <td class="px-6 py-4">{{ acta.descripcion }}</td>
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

const modoActualizar = ref(false);

const form = ref({
  id: -1,
  nombre: 'Nombre de la reunión',
  fecha: '2024-05-01',
  hora: '08:00:00',
  lugar: 'Lugar del reunión',
  descripcion: 'Descripcion del reunión',
});

const resetForm = () => {
  form.value = {
    id: -1,
    nombre: 'Nombre de la reunión',
    fecha: '2024-05-01',
    hora: '08:00:00',
    lugar: 'Lugar del reunión',
    descripcion: 'Descripcion del reunión',
  };
}

const leer = async () => {
  const response = await axios.get('reuniones/leer');
  actas.value = response.data.reuniones;
}

const crear = async () => {
  if (modoActualizar.value) {
    await axios.put(`reuniones/actualizar/${form.value.id}`, form.value);
    modoActualizar.value = false;
  } else {
    await axios.post('reuniones/crear', form.value);
  }
  resetForm();
  leer();
}

const seleccionar = (acta) => {
  modoActualizar.value = true;
  form.value = acta;
}

const eliminar = async (id) => {
  await axios.delete(`reuniones/eliminar/${id}`);
  leer();
}

onMounted(() => {
  leer();
});

</script>