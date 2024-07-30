<script setup>
import { ref, onMounted } from 'vue'
import image from '../../image.png'
import { getCategories, updatePet, deletePet, createPet } from '../api';


const props = defineProps({
    pet: Object,
    required: true
})

const categories = ref([])

const isModal = ref(false)
const isEdit = ref(false)

const editName = ref('')
const category_i = ref('')
const status = ref('')

const fetchCategories = async () => {
    try {
        const res = await getCategories()
        categories.value = res
    } catch (error) {
        console.error('Error fetching pets:', error)
    }
}

onMounted(() => {
    fetchCategories()

})

const hanlderEdit = async () => {

    const categoryIsValid = Number.isInteger(category_i.value) && category_i.value > 0
    const nameIsValid = editName.value.trim().length > 0
    const statusIsValid = status.value.trim().length > 0

    console.log(categoryIsValid)

    if (!categoryIsValid || !nameIsValid || !statusIsValid) {
        alert("Los campos nos estan completos")
        return
    }

    try {
        const updatedPet = { ...props.pet, name: editName.value, status: status.value, category_id: category_i.value, photoUrls: ["http://example.com/photo1.jpg", "http://example.com/photo2.jpg"], tags: [{ "id": 1, "name": "cute" }, { "id": 2, "name": "dog" }] }
        await updatePet(updatedPet, props.pet.id)
        console.log('Mascota actualizada', updatedPet)
    } catch (error) {
        console.error('Error al actualizar la mascota', error)
    }

}

const handlerDelete = async (id) => {
    try {
        await deletePet(id); // Llama a la función de API para eliminar la mascota
        console.log('Mascota eliminada', id);
        window.location.reload(); // Recarga la página
    } catch (error) {
        window.location.reload(); // Recarga la página
        console.error('Error al eliminar la mascota', error);
    }
}

const hanlderCreate = async () => {

    // const categoryIsValid = Number.isInteger(category_i.value) && category_i.value > 0
    // const nameIsValid = editName.value.trim().length > 0
    // const statusIsValid = status.value.trim().length > 0

    // console.log(categoryIsValid)

    // if (!categoryIsValid || !nameIsValid || !statusIsValid) {
    //     alert("Los campos nos estan completos")
    //     return
    // }

    const pet = {
        "id": 3,
        "category_id": 1,
        "name": "desde el front",
        "photoUrls": [
            "http://example.com/photo1.jpg",
            "http://example.com/photo2.jpg"
        ],
        "tags": [
            {
                "id": 1,
                "name": "cute"
            },
            {
                "id": 2,
                "name": "dog"
            }
        ],
        "status": "pending",
        "created_at": "2024-07-28T23:39:04.000000Z",
        "updated_at": "2024-07-28T23:39:04.000000Z"
    }



    createPet(pet)

    // 

}



</script>

<template>
    <div class="flex flex-col items-center justify-center text-center bg-white p-4 w-1/4  rounded-xl  ">
        <div class=" rounded-xl overflow-hidden ">
            <img class="" src='../../image.png' alt="" srcset="">
        </div>
        <div class="px-2">
            <div class="flex flex-col items-center">
                <div>
                    <h1 class="text-purple-500 font-bold text-base">{{ pet.name }}</h1>
                </div>
                <div class="flex mb-1 mt-1 gap-2">
                    <p><span>{{ pet.category_id == 1 ? "Perro" : "Gato" }}</span></p>
                    <p class="text-red-600">{{ pet.status }}</p>
                </div>
            </div>
            <div class=" flex gap-2">
                <button @click="hanlderCreate"
                    class="px-5 py-1 bg-purple-600 rounded hover:bg-purple-500 text-white font-semibold">Add</button>
                <button @click="isEdit = true"
                    class="px-5 py-1 bg-purple-600 rounded hover:bg-purple-500 text-white font-semibold">Editar</button>
                <button @click="isModal = true"
                    class="px-5 py-1 bg-yellow-500 rounded hover:bg-purple-500 text-white font-semibold">Info</button>
                <button @click="() => { handlerDelete(pet.id) }"
                    class="px-5 py-1 bg-red-600 rounded hover:bg-purple-500 text-white font-semibold">Eliminar</button>
            </div>
        </div>
    </div>

    <dialog :open="isModal | isEdit">

        <div class=" w-3/5 bg-white rounded-lg  ">

            <div class="flex">
                <div class="overflow-y-hidden">
                    <img src="../../image.png" alt="">
                </div>
                <div class="flex flex-col w-full bg-neutral-300   ">
                    <div class="flex gap-2 p-2 bg-neutral-300 border-neutral-100">
                        <p class="text-purple-900 font-bold">Nombre:</p>
                        <span v-if="!isEdit" class="text-neutral-900">Roko Pet</span>
                        <input v-if="isEdit" v-model="editName" type="text" :placeholder="pet.name">
                    </div>
                    <div class="flex gap-2 p-2 bg-neutral-300 border-t-2 border-neutral-200">
                        <p class="text-purple-900 font-bold">Categoria:</p>
                        <span v-if="!isEdit">Perro</span>
                        <select v-if="isEdit" name="category_i" id="category_i" v-model="category_i">
                            <option v-for="categoria in categories" :value="categoria.id">{{ categoria.name }}</option>
                        </select>
                    </div>

                    <div class="flex gap-2 p-2 bg-neutral-300 border-t-2 border-neutral-200">
                        <p class="text-purple-900 font-bold">Tags:</p>
                        <span>Perro</span>
                        <span>mascotas</span>
                        <span>animales</span>
                    </div>
                    <div class="flex gap-2 p-2 bg-neutral-300 border-t-2 border-neutral-200">
                        <p class="text-purple-900 font-bold">Estado:</p>
                        <span v-if="!isEdit" class="text-red-600 font-semibold">Sold</span>
                        <select v-if="isEdit" name="status" id="status" v-model="status">
                            <option value="available">available</option>
                            <option value="pending">pending</option>
                            <option value="sold ">sold</option>
                        </select>
                    </div>
                    <div class="w-full p-2 flex items-center justify-center mt-5 gap-2">
                        <button @click="hanlderEdit"
                            class="px-5 py-1 bg-purple-600 rounded hover:bg-purple-500 text-white font-semibold">Guardar</button>
                        <button v-if="isModal" @click="isModal = false"
                            class="px-5 py-1 bg-yellow-500 rounded hover:bg-purple-500 text-white font-semibold">Close</button>
                        <button v-if="isEdit" @click="isEdit = false"
                            class="px-5 py-1 bg-yellow-500 rounded hover:bg-purple-500 text-white font-semibold">Close</button>
                        <button
                            class="px-5 py-1 bg-red-600 rounded hover:bg-purple-500 text-white font-semibold">Eliminar</button>
                    </div>
                </div>

            </div>

        </div>

    </dialog>

</template>

<style scoped>
dialog {

    position: fixed;
    /* Stay in place */
    z-index: 1;
    /* Sit on top */
    left: 0;
    top: 0;
    width: 100%;
    /* Full width */
    height: 100%;
    /* Full height */
    overflow: hidden;
    /* Enable scroll if needed */
    background-color: rgb(0, 0, 0);
    /* Fallback color */
    background-color: rgba(0, 0, 0, 0.7);
    /* Black w/ opacity */


}

dialog>div {
    margin: 5% auto;
    /* 15% from the top and centered */
}

dialog::backdrop {
    background: rgba(255, 255, 255, 0.9) !important;

}
</style>
