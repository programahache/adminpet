const url = 'http://blog.test'; //LA PONGO AQUI SOLO PORQUE ES DE PRUEBA JAJA PERO OBVIO PONDRIA LAS URL EN  VARIABLES DE ENTORNOS 



export const getApiKey = async () => {
    try {
        const response = await fetch('http://blog.test/token') // Asegúrate de que la URL tenga el esquema correcto
        const key = await response.json()
        return key.csrf_token
    } catch (error) {
        console.log(error)
        throw error
    }
}



export const getPets = async () => {
    try {
        const response = await fetch('http://blog.test/pet') // Asegúrate de que la URL tenga el esquema correcto
        const pet = await response.json()
        return pet
    } catch (error) {
        console.log(error)
        throw error
    }
}

export const getCategories = async () => {
    try {
        const response = await fetch('http://blog.test/categories')
        const categories = await response.json()
        return categories
    } catch (error) {
        console.log(error)
        throw error
    }
}


export const updatePet = async (pet,id) => {
    try {
        const response = await fetch(`http://blog.test/pet/actu/${id}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(pet),
        });
        if (!response.ok) {
            throw new Error('Error al actualizar la mascota');
        }
        return await response.json();
    } catch (error) {
        console.error('Error en la solicitud de actualización', error);
        throw error;
    }
};

