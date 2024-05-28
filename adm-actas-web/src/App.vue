<template>

  <header class="bg-sky-900 py-4 mb-8">

    <!-- Título -->
    <div class="container mx-auto flex items-center justify-between" >
      <h1 class="text-white text-2xl font-bold">SISTEMA DE GESTIÓN DE ACTAS</h1>
    </div>

    <!-- Enlaces -->
    <nav class=" container mx-auto mt-4">
      <ul class="flex space-x-4">
        <li>
          <RouterLink :to="{name: 'home'}" class="flex rounded p-2  text-white hover:underline" :class="{'bg-sky-600/45': route.name === 'home'}" >
            <svg class="mr-2" xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round" ><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 11m0 2a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2z" /><path d="M12 16m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /><path d="M8 11v-5a4 4 0 0 1 8 0" /></svg>
            login
          </RouterLink>
        </li>
        <li>
          <RouterLink :to="{name: 'reuniones'}" class="flex rounded p-2  text-white hover:underline" :class="{'bg-sky-600/45': route.name === 'reuniones'}" >
            
<!-- Uploaded to: SVG Repo, www.svgrepo.com, Generator: SVG Repo Mixer Tools -->
<svg class="size-6 mr-2" fill="currentColor" height="800px" width="800px" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 297 297" xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 297 297">
  <g>
    <path d="M148.5,71.388c19.49,0,35.346-15.857,35.346-35.346S167.99,0.696,148.5,0.696s-35.346,15.857-35.346,35.346   S129.01,71.388,148.5,71.388z M148.5,18.069c9.91,0,17.973,8.062,17.973,17.973S158.41,54.014,148.5,54.014   s-17.973-8.062-17.973-17.973S138.59,18.069,148.5,18.069z"/>
    <path d="m95.181,173.582h106.638c4.798,0 8.687-3.889 8.687-8.687v-52.116c0-15.095-9.621-28.444-23.942-33.216-0.066-0.022-9.605-2.95-9.605-2.95-4.419-1.358-9.127,0.987-10.71,5.329l-10.244,28.107c0,0-3.225-14.114-3.376-14.425l6.384-11.057c0.821-1.423 0.821-3.176 0-4.599-0.821-1.423-2.34-2.299-3.983-2.299h-13.06c-1.643,0-3.162,0.876-3.983,2.299-0.821,1.423-0.821,3.176 0,4.599l6.384,11.057c-0.15,0.312-3.376,14.425-3.376,14.425l-10.244-28.107c-1.584-4.342-6.291-6.69-10.71-5.329 0,0-9.539,2.928-9.605,2.95-14.321,4.773-23.942,18.121-23.942,33.216v52.116c-2.84217e-14,4.797 3.89,8.687 8.687,8.687zm84.567-77.942l1.411,.433c7.165,2.43 11.972,9.131 11.972,16.705v43.429h-35.459l22.076-60.567zm-75.88,17.138c0-7.574 4.808-14.275 11.972-16.705l1.411-.433 22.075,60.567h-35.459v-43.429z"/>
    <path d="m35.345,89.454c19.49,0 35.346-15.856 35.346-35.345s-15.856-35.346-35.346-35.346-35.345,15.857-35.345,35.346 15.856,35.345 35.345,35.345zm0-53.317c9.91,0 17.973,8.062 17.973,17.973 0,9.909-8.062,17.972-17.973,17.972-9.909,0-17.972-8.062-17.972-17.972 0.001-9.911 8.063-17.973 17.972-17.973z"/>
    <path d="m95.511,186.619h-28.152v-61.164c0-17.652-14.362-32.014-32.014-32.014s-32.013,14.361-32.013,32.013v81.094c-8.88178e-16,16.949 13.788,30.736 30.736,30.736h36.527v50.333c0,4.798 3.889,8.687 8.687,8.687h33.725c4.798,0 8.687-3.889 8.687-8.687v-74.814c0.001-14.438-11.745-26.184-26.183-26.184zm8.81,92.312h-16.352v-50.333c0-4.798-3.889-8.687-8.687-8.687h-45.213c-7.368,0-13.363-5.994-13.363-13.363v-81.094c0-8.072 6.567-14.64 14.639-14.64 8.073,0 14.64,6.568 14.64,14.64v69.851c0,4.798 3.889,8.687 8.687,8.687h36.838c4.858,0 8.811,3.952 8.811,8.811v66.128z"/>
    <path d="m261.655,89.454c19.49,0 35.345-15.856 35.345-35.345s-15.856-35.346-35.345-35.346c-19.49,0-35.346,15.857-35.346,35.346s15.856,35.345 35.346,35.345zm0-53.317c9.909,0 17.972,8.062 17.972,17.973 0,9.909-8.062,17.972-17.972,17.972-9.91,0-17.973-8.062-17.973-17.972 2.84217e-14-9.911 8.062-17.973 17.973-17.973z"/>
    <path d="m261.654,93.441c-17.652,0-32.013,14.362-32.013,32.014v61.164h-28.151c-14.439,0-26.184,11.746-26.184,26.184v74.814c0,4.798 3.889,8.687 8.687,8.687h33.725c4.798,0 8.687-3.889 8.687-8.687v-50.333h36.527c16.949,0 30.736-13.788 30.736-30.736v-81.094c0-17.652-14.362-32.013-32.014-32.013zm14.64,113.107c0,7.368-5.994,13.363-13.363,13.363h-45.214c-4.798,0-8.687,3.889-8.687,8.687v50.333h-16.352v-66.128c0-4.858 3.952-8.811 8.811-8.811h36.838c4.798,0 8.687-3.889 8.687-8.687v-69.851c0-8.072 6.567-14.64 14.64-14.64 8.072,0 14.639,6.568 14.639,14.64v81.094z"/>
  </g>
</svg>
            Reuniones
          </RouterLink>
        </li>
        <li>
          <RouterLink :to="{name: 'actas'}" class="flex rounded p-2  text-white hover:underline" :class="{'bg-sky-600/45': route.name === 'actas'}" >
            <svg class="mr-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
              <path d="M15 15m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
              <path d="M13 17.5v4.5l2 -1.5l2 1.5v-4.5" />
              <path d="M10 19h-5a2 2 0 0 1 -2 -2v-10c0 -1.1 .9 -2 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -1 1.73" />
              <path d="M6 9l12 0" />
              <path d="M6 12l3 0" />
              <path d="M6 15l2 0" />
            </svg>
            Actas
          </RouterLink>
        </li>
        <li>
          <RouterLink :to="{name: 'usuarios'}" class="flex rounded p-2  text-white hover:underline" :class="{'bg-sky-600/45': route.name === 'usuarios'}" >
            <svg class="mr-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
              <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
              <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
              <path d="M16 3.13a4 4 0 0 1 0 7.75" />
              <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
            </svg>

            Usuarios
          </RouterLink>
        </li>
        <li>
          <RouterLink :to="{name: 'asistencias'}" class="flex rounded p-2  text-white hover:underline" :class="{'bg-sky-600/45': route.name === 'asistencias'}" >
            <svg class="mr-1" xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9.615 20h-2.615a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v8" /><path d="M14 19l2 2l4 -4" /><path d="M9 8h4" /><path d="M9 12h2" /></svg>

            Asistencias
          </RouterLink>
        </li>

      </ul>
    </nav>

  </header>

  <main>
    <RouterView />
  </main>
</template>
<script setup>
import { RouterView } from 'vue-router'
import { useRoute } from 'vue-router';

const route = useRoute();

</script>
