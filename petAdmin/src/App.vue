<script setup>
import FiltersComponent from './components/FiltersComponent.vue';
import HelloWorld from './components/HelloWorld.vue'
import Nav from './components/Nav.vue';
import PetCard from './components/PetCard.vue';
import {  getPets } from './api';
import { ref, onMounted } from 'vue';


const pets = ref([])


const fetchPets = async () => {
  try {
    const res = await getPets()
    pets.value = res
  } catch (error) {
    console.error('Error fetching pets:', error)
  }
}

onMounted(() => {
  fetchPets()
})

</script>

<template>
  <!-- <div class="flex items-center justify-center w-100">
    <h1 class="text-red-600 text-4xl font-bold">Pets Controler </h1>
  </div> -->
  <Nav></Nav>
  <section class="flex flex-col gap-4 px-7 pb-5 mt-5">
    <FiltersComponent></FiltersComponent>
    <main class="w-full flex items-center justify-center gap-3 flex-wrap  ">
      <PetCard v-for="pet in pets" :key="pet.id" :pet="pet"/>

    </main>
  </section>
</template>

<style scoped></style>
