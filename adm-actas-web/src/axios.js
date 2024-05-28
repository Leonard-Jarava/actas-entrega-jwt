import Axios from 'axios';
import { useAuthStore } from './stores/auth';

const axios = Axios.create({
    baseURL: 'http://localhost:8000',
    headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
    }
});

axios.interceptors.request.use(
    (config) => {
        const token = localStorage.getItem('access_token');
        if (token) {
            config.headers.Authorization = `Bearer ${token}`;
        }
        return config;
    },
    (error) => {
        return Promise.reject(error);
    }
);

axios.interceptors.response.use(
    (response) => {
        return response;
    },
    async (error) => {
        const originalRequest = error.config;

        if (error.response.status === 401 && !originalRequest._retry) {

            originalRequest._retry = true;

            const authStore = useAuthStore();

            const refreshToken = authStore.refreshToken;

            try {

                const response = await axios.post('autenticacion/refresh', {
                    refresh_token: refreshToken
                });
                
                authStore.setToken(response.data.access_token);
                authStore.setRefreshToken(response.data.refresh_token);
                
                return axios(originalRequest);

            } catch (error) {
                return Promise.reject(error);
            }
        }
        return Promise.reject(error);
    }
);

export default axios;