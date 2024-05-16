import axios from 'axios'

export async function getProducts() {
    return axios.get('/api/product').then(({ data }) => {
        return data;
    }).catch(error => {
        console.log(error);
        throw new Error('Ошибка загрузки списка продуктов')
    })
}

export async function updateProducts(products, newProducts) {
    return axios.post('/api/product', {
        products,
        new_products: newProducts
    }).then(({ data }) => {
        return data;
    }).catch(error => {
        console.log(error);
        throw new Error('Ошибка сохранения списка продуктов')
    })
}
