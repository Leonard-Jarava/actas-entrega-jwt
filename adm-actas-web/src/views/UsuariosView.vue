<template>
  <main class="m-4">

    <h2 class="text-3xl font-bold text-sky-900 ">
      Listado de usuarios
    </h2>

    <form @submit.prevent="crear" class="flex justify-between space-x-4 my-4 ">
      <input v-model="form.nombre" type="text" class="border border-gray-200 rounded-lg px-4 py-2"
        placeholder="Nombre del usuario">
      <input v-model="form.apellido" type="text" class="border border-gray-200 rounded-lg px-4 py-2"
        placeholder="Apellido del usuario">
      <input v-model="form.email" type="email" class="border border-gray-200 rounded-lg px-4 py-2"
        placeholder="Correo electrónico">
      <input v-model="form.password" type="password" class="border border-gray-200 rounded-lg px-4 py-2"
        placeholder="Contraseña">
      <button type="submit"
        class="text-white bg-sky-900 hover:bg-sky-800 focus:ring-4 focus:ring-sky-300 font-medium rounded-lg text-sm px-5 py-2.5">
        {{ modoActualizar ? 'Actualizar' : 'Crear' }}
      </button>
    </form>

    <table class="min-w-full border divide-y divide-gray-200">
      <thead class="bg-gray-50">
        <tr>
          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Nombre
          </th>
          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Apellido
          </th>
          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Correo electrónico
          </th>
          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Contraseña
          </th>
          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Acciones
          </th>
        </tr>
      </thead>
      <tbody class="bg-white divide-y divide-gray-200">
        <tr v-for="usuario in usuarios">
          <td class="px-6 py-4 whitespace-nowrap">{{ usuario.nombre }}</td>
          <td class="px-6 py-4 whitespace-nowrap">{{ usuario.apellido }}</td>
          <td class="px-6 py-4 whitespace-nowrap">{{ usuario.email }}</td>
          <td class="px-6 py-4 whitespace-nowrap">{{ modoActualizar == true ? 'Oculto' : usuario.password }}</td>
          <td class="flex justify-start px-6 py-4 text-right text-sm font-medium">
            <button @click="seleccionar(usuario)" class="text-sky-600 hover:text-sky-800 mr-2">Editar</button>
            <button @click="eliminar(usuario.id)" href="#" class="text-sky-800 hover:text-sky-900">Eliminar</button>
          </td>
        </tr>
      </tbody>
    </table>
  </main>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from '@/axios';

const usuarios = ref([]);
const modoActualizar = ref(false);

const form = ref({
  id: -1,
  nombre: '',
  apellido: '',
  email: '',
  password: '',
});

const resetForm = () => {
  form.value = {
    id: -1,
    nombre: '',
    apellido: '',
    email: '',
    password: '',
  };
}

const leer = async () => {
  const response = await axios.get('usuarios/leer');
  usuarios.value = response.data.usuarios;
}

const crear = async () => {
  if (modoActualizar.value) {
    await axios.put(`usuarios/actualizar/${form.value.id}`, form.value);
    modoActualizar.value = false;
    resetForm();
  } else {
    await axios.post('usuarios/crear', form.value);
  }
  leer();
}

const seleccionar = (acta) => {
  modoActualizar.value = true;
  form.value = acta;
}

const eliminar = async (id) => {
  await axios.delete(`usuarios/eliminar/${id}`);
  leer();
}

onMounted(() => {
  leer();
});

</script>
