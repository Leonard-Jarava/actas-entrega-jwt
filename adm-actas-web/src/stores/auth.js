import { defineStore } from "pinia";
import axios from "@/axios";
import { ref } from "vue";

export const useAuthStore = defineStore('auth', () => {

    const token = ref(localStorage.getItem('access_token') || null);
    const refreshToken = ref(localStorage.getItem('refresh_token') || null);

    const setToken = (newToken) => {
        token.value = newToken;
        localStorage.setItem('access_token', newToken);
    };

    const setRefreshToken = (newRefreshToken) => {
        refreshToken.value = newRefreshToken;
        localStorage.setItem('refresh_token', newRefreshToken);
    };

    const login = async (form) => {
        try {
            const response = await axios.post('autenticacion/login', form);
            setToken(response.data.access_token);
            setRefreshToken(response.data.refresh_token);
            return response;
        } catch (error) {
            throw error;
        }
    }


    const logout = async () => {
        //await axios.post('autenticacion/logout');
        token.value = null;
        refreshToken.value = null;
        localStorage.removeItem('access_token');
        localStorage.removeItem('refresh_token');
    };

    return {
        token,
        refreshToken,
        login,
        setToken,
        setRefreshToken,
    }
});