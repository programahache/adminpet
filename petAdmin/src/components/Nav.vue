<script setup>
import { ref } from 'vue'

defineProps({
    msg: String,
})

const count = ref("AD")

</script>

<template>
    <nav class=" w-full py-2 px-5 flex justify-between items-center bg-purple-600 text-white  ">
        <div class="nav-info flex gap-7">
            <div>
                logo
            </div>
            <div>
                <p>Registros encontrados: <span>5 </span></p>
            </div>
        </div>
        <div class="nav-button">
            <button class="p-2 border-2 rounded font-bold hover:bg-purple-500 ">Crear Nuevo</button>
        </div>
    </nav>
</template>

<style scoped></style>
