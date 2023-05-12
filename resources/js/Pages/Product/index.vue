<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3'

import {onMounted, ref} from 'vue'
import axios from 'axios';

const props = defineProps({
products: Array
})

let products = ref([])

onMounted(async () =>{
    getProducts()
})

const getProducts = async () => {
    let response = await axios.get("/api/get_all_products")
    console.log('response', response)
    products.value = response.data.products
}
let searchProduct = ref([])

const search = async () => {
    let response = await axios.get('/api/search_product?s='+searchProduct.value)
    console.log('response', response.data.products)
    products.value = response.data.products
}

function destroy(id) {
    if (confirm("Are you sure you want to Delete")) {
        form.delete(route('product.delete', id));
    }
}

</script>

<template>


    <Head title="Products" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Products</h2>
            <Link :href="route('product.create')">
            <Button class="btn btn-dark" > Create Product</Button></Link>
            <input class="search-input" type="text" placeholder="Search product..."
            v-model="searchProduct" @keyup="search()">
        </template>

<div class="container flex justify-center mx-auto">
    <div class="flex flex-col">
        <div class="w-full">
            <div class="border-b border-gray-200 shadow">
                <table class="divide-y divide-gray-300 ">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-2 text-xs text-gray-500">
                                ID
                            </th>
                            <th class="px-6 py-2 text-xs text-gray-500">
                                Name
                            </th>
                            <th class="px-6 py-2 text-xs text-gray-500">
                                Category
                            </th>
                            <th class="px-6 py-2 text-xs text-gray-500">
                                Description
                            </th>
                            <th class="px-6 py-2 text-xs text-gray-500">
                                Date Time
                            </th>
                            <th class="px-6 py-2 text-xs text-gray-500">
                                Edit
                            </th>
                            <th class="px-6 py-2 text-xs text-gray-500">
                                Delete
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-300"> 
                        <tr class="whitespace-nowrap"  v-for="product in products"
                                        :key="product.id">
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900">
                                    {{ product.id }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-500">{{ product.name}}</div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                               {{product.categoryID}}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                               {{product.description}}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                               {{product.date_time}}
                            </td>
                            <td class="px-6 py-4">
                                <a :href="route('product.edit',product.id)" class="px-4 py-1 text-sm text-blue-600 bg-blue-200 rounded-full">Edit</a>
                            </td>
                            <td class="px-6 py-4">
                                <a href="#" method="delete" @click="destroy(product.id)" class="px-4 py-1 text-sm text-red-400 bg-red-200 rounded-full">Delete</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
    </AuthenticatedLayout>
</template>


