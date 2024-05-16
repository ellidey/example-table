<script setup>
import { ref, onMounted } from 'vue'
import { getProducts, updateProducts } from '../helpers/products.js'

const loading = ref(true);
const products = ref([])
const newProducts = ref([])
const error = ref(null)

async function load() {
    loading.value = true

    try {
        products.value = await getProducts()
        error.value = null
    } catch (err) {
        error.value = err.message
    }

    newProducts.value = []
    loading.value = false
}

async function save() {
    loading.value = true

    try {
        products.value = await updateProducts(products.value, newProducts.value)
        error.value = null
    } catch (err) {
        error.value = err.message
    }

    loading.value = false
}

onMounted(async () => {
    await load()
})
</script>

<template>
    <div class="preloader" v-if="loading">
        <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
    </div>
    <div class="container">
        <div class="alert alert-danger mt-4 alert-dismissible fade show" role="alert" v-if="error">
            {{ error }}
            <button type="button" class="btn-close" @click="error = null"></button>
        </div>
        <h2 class="my-4">Список продуктов</h2>
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th scope="col">Наименование продукта</th>
                <th scope="col">Количество</th>
                <th scope="col">Стоимость продукта</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
                <tr v-if="products.length === 0 && newProducts.length === 0">
                    <td colspan="4" class="text-center">
                        Добавьте продукты
                    </td>
                </tr>
                <tr v-for="(product, index) in products" :key="product.id">
                    <th>
                        <input type="text" class="form-control" v-model="product.name">
                        <div class="text-danger fw-normal text-center" v-if="product.name === ''">
                            Укажите Наименование продукта
                        </div>
                    </th>
                    <td>
                        <input type="number" class="form-control" v-model="product.amount">
                        <div class="text-danger fw-normal text-center" v-if="product.amount === ''">
                            Укажите Количество
                        </div>
                    </td>
                    <td>
                        <input type="number" class="form-control" v-model="product.price">
                        <div class="text-danger fw-normal text-center" v-if="product.price === ''">
                            Укажите Стоимость продукта
                        </div>
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger" @click="products.splice(index, 1);">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
                            </svg>
                        </button>
                    </td>
                </tr>
                <tr v-for="(product, index) in newProducts" :key="index">
                    <th>
                        <input type="text" class="form-control" v-model="product.name">
                        <div class="text-danger fw-normal text-center" v-if="product.name === ''">
                            Укажите Наименование продукта
                        </div>
                    </th>
                    <td>
                        <input type="number" class="form-control" v-model="product.amount">
                        <div class="text-danger fw-normal text-center" v-if="product.amount === ''">
                            Укажите Количество
                        </div>
                    </td>
                    <td>
                        <input type="number" class="form-control" v-model="product.price">
                        <div class="text-danger fw-normal text-center" v-if="product.price === ''">
                            Укажите Стоимость продукта
                        </div>
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger" @click="newProducts.splice(index, 1);">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
                            </svg>
                        </button>
                    </td>
                </tr>
                <tr>
                   <td colspan="4" class="text-center">
                       <button type="button" class="btn btn-success" @click="newProducts.push({})">
                           Добавить
                       </button>
                   </td>
                </tr>
            </tbody>
        </table>
        <div class="d-flex gap-2">
            <button type="button" class="btn btn-secondary" @click="load()">
                Отмена
            </button>
            <button type="button" class="btn btn-success" @click="save()">
                Сохранить
            </button>
        </div>
    </div>
</template>
