<script setup>
import Menu from './Menu.vue'
</script>
<template>
    <div class="w-full   italic flex flex-row justify-between">
        <div class="m-2  flex flex-col h-30">
            <span class="tracking-wider leading-tight ml-2 text-xl w-20">Refuge</span>
            <div class="inline-flex">
                <span class="leading-tight text-xs ml-2">des </span>
                <span  class="tracking-wider leading-tight text-xl ml-1">Mille Pattes</span>
            </div>
            
        </div>
        <Menu />
    </div>
    <div class="mt-3 h-40">
        <img class="object-cover w-full h-40" src="../../images/header_cat_and_dog.jpg" />
    </div>
</template>