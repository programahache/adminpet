<script setup>
import { ref } from 'vue'



defineProps({
    msg: String,
})

const count = ref("AD")

</script>

<template>
    <form class="flex w-full gap-7 items-center bg-neutral-200 p-5 rounded">
        <div class="">
            <p>Nombre</p>
            <select name="" id="" class="py-2 px-3  rounded mx-w-50">
                <option value="">Nombre</option>
                <option value="">Pepe</option>
                <option value="">Juana la mata cabras</option>
            </select>
        </div>
        <div>
            ID
            <div class="header-list-pets " id="header-list-pets">
                <input type="number" class="p-2">
            </div>
        </div>

    </form>
</template>

<style scoped></style>
