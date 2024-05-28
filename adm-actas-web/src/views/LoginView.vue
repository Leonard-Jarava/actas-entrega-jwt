<template>
    <main class="m-4">

        <form class="flex flex-col max-w-md mx-auto bg-sky-950/95 p-8 rounded-xl" @submit.prevent="login">

            <h2 class="text-3xl font-bold text-white mb-8">
                Iniciar sesión
            </h2>

            <div v-if="errors" class="flex justify-between bg-red-600 rounded-md p-2 mb-4" >
                <p class="text-white" >
                    {{ errors  }}
                </p>

                <button @click="clearErrors" class="text-white font-bold p-1 rounded bg-red-400" >
                   Cerrar
                </button>
            </div>


            <div class="mb-4">
                <label class="block text-white">
                    Correo:
                </label>
                <input v-model="form.username" type="email" class="w-full border border-gray-200 rounded-lg px-4 py-2"
                    placeholder="Correo electrónico">
            </div>
            <div class="mb-8">
                <label class="block text-white">
                    Contraseña:
                </label>
                <input v-model="form.password" type="password"
                    class="w-full border border-gray-200 rounded-lg px-4 py-2" placeholder="Contraseña">
            </div>

            <input class="text-white font-bold bg-sky-500 p-2 rounded-lg hover:bg-sky-700" type="submit"
                value="Acceder">

        </form>
    </main>
</template>
<script setup>
import router from '@/router';
import { useAuthStore } from '@/stores/auth';
import { ref } from 'vue';

const form = ref({
    username: '',
    password: ''
})

const errors = ref(null);

const auth = useAuthStore();

const clearErrors = () => {
    errors.value = null;
}

const login = async () => {
    try {
        await auth.login(form.value);
        router.push({ name: 'reuniones' });
    } catch (error) {
        errors.value = error.response.data.message;
    }
}

</script>