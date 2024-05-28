<template>

    <main class="m-4">

        <h2 class="text-3xl font-bold text-sky-900 ">
            Listado de asistencias
        </h2>


        <div class="flex justify-between my-4">

            <select v-model="reunion" @change="leerAsistencias" class="border border-gray-200 rounded-lg px-4 py-2">
                <option value="-1">Seleccione una reunión</option>
                <option v-for="reunion in reuniones" :value="reunion.id">{{ reunion.nombre }}</option>
            </select>

            <div>


                <select v-model="usuario" class="mr-2 border border-gray-200 rounded-lg px-4 py-2">
                    <option value="-1">Seleccione un usuario</option>
                    <option v-for="usuario in usuarios" :value="usuario.id">{{ usuario.nombre }}</option>
                </select>

                <button @click="crear"
                    class="text-white bg-sky-900 hover:bg-sky-800 focus:ring-4 focus:ring-sky-300 font-medium rounded-lg text-sm px-5 py-2.5">
                    Registrar asistencia
                </button>
            </div>
        </div>


        <table class="min-w-full border divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>

                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        usuario
                    </th>

                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        hora_ingreso
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Acciones
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <tr v-for="asistencia in asistencias">
                    <td class="px-6 py-4 whitespace-nowrap">{{ asistencia.nombre + ' ' + asistencia.apellido }}</td>

                    <td class="px-6 py-4 whitespace-nowrap">{{ asistencia.hora_ingreso }}</td>

                    <td class="flex justify-start px-6 py-4 text-right text-sm font-medium">
                        <button @click="eliminar(asistencia)" class="text-sky-800 hover:text-sky-900">Eliminar</button>
                    </td>
                </tr>
            </tbody>
        </table>

    </main>
</template>
<script setup>
import { ref, onMounted } from 'vue'
import axios from '@/axios'

const reunion = ref(-1);
const usuario = ref(-1);

const usuarios = ref([])
const reuniones = ref([]);
const asistencias = ref([]);

const leer = async () => {
    const response = await axios.get('reuniones/leer');
    reuniones.value = response.data.reuniones;
}

const leerUsuarios = async () => {
    const response = await axios.get(`usuarios/leer`);
    usuarios.value = response.data.usuarios;
}

const leerAsistencias = async () => {
    const response = await axios.get(`asistencias/leer?id=${reunion.value}`);
    asistencias.value = response.data.asistencias;
}

const crear = async () => {

    if (reunion.value == -1 || usuario.value == -1) {
        alert('Seleccione una reunión y un usuario para registrar su asistencia');
        return;
    }

    try {
        await axios.post('asistencias/crear', {
            reunion_id: reunion.value,
            usuario_id: usuario.value
        });
        leerAsistencias();

    } catch (error) {
        alert('El usuario ya se encuentra registrado en la reunión');
    }

}

const eliminar = async (asistencia) => {
    await axios.delete(`asistencias/eliminar/?usuarioId=${asistencia.usuario_id}&reunionId=${asistencia.reunion_id}`);
    leerAsistencias();
}

onMounted(() => {
    leer();
    leerUsuarios();

})
</script>