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

const tok = await getApiKey()

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


export const createPet = async (pet) => {
    try {
        const response = await fetch(`http://blog.test/pet/create`, {
            method: 'POST',
            mode:'no-cors',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(pet),
        });

        if (!response.ok) {
            throw new Error(`Error: ${response.statusText}`);
        }

        return await response.json();
    } catch (error) {
        console.error('Error en la solicitud de actualización', error);
        throw error;
    }
}

export const updatePet = async (pet, id) => {
    try {
        const response = await fetch(`http://blog.test/pet/actu/${id}`, {
            method: 'POST',
            mode:'no-cors',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(pet),
        });

        if (!response.ok) {
            throw new Error(`Error: ${response.statusText}`);
        }

        return await response.json();
    } catch (error) {
        console.error('Error en la solicitud de actualización', error);
        throw error;
    }
};

export const deletePet = async (id) => {
    try {
        const response = await fetch(`http://blog.test/pet/${id}`, {
            method: 'POST',
            mode:'no-cors',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(id),
        });

        if (!response.ok) {
            throw new Error(`Error: ${response.statusText}`);
        }

        return await response.json();
    } catch (error) {
        console.error('Error en la solicitud de actualización', error);
        throw error;
    }
};


