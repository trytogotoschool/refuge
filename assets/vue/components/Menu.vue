<script setup>
import { ref } from 'vue'

const visible = ref(false)
</script>
<template>
        <div @click="visible = !visible" class="space-y-2 m-5">
            <div class="w-8 h-0.5 bg-gray-600"></div>
            <div class="w-8 h-0.5 bg-gray-600"></div>
            <div class="w-8 h-0.5 bg-gray-600"></div>
        </div>
        <div v-show="visible"  @click="visible = !visible"  class="absolute  bg-opacity-75 inset-x-0 top-0 h-full bg-gray-200">
            <div  class="burger-menu absolute top-3 right-0  w-60 bg-teal-50">
                <ul>
                    <li><a href="/qui">Qui sommes nous ?</a></li>
                    <li><a href="/qui">Animaux à l'adoption</a></li>
                    <li><a href="/qui">Vos obligations</a></li>
                    <li><a href="/qui">Nous aider</a></li>
                    <li><a href="/qui">Contact</a></li>
                    
                </ul>
            </div>
        </div>
   
</template>
<style>

</style>