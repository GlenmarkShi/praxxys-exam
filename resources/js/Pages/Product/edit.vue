<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    product: {
        type: Object,
        default: () => ({}),
    },
});

const form = useForm({
    name: props.product.name,
    category: props.product.category,
    description: props.product.description,
    date_time: props.product.date_time,
});

const submit = () => {
    form.put(route('product.update',  props.product.id));
};
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Add Product" />
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Products</h2>
        </template>
        

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="name" value="Name" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

<div>Category: {{ selected }}</div>

<select v-model="form.category" name="category" >
  <option disabled value="">Please select one</option>
  <option value="Fruits">Fruits</option>
  <option value="Bevarages">Bevarages</option>
  <option value="Food">Food</option>
</select>

            <div>
                <InputLabel for="description" value="Description" />

                <textarea
                    id="description"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.description"
                    required
                    autofocus
                    autocomplete="description"
                />

                <InputError class="mt-2" :message="form.errors.description" />
            </div>

            
                       <div>
                <InputLabel for="date_tme" value="Date and Time" />

                <input
                    id="date_time"
                    type="datetime-local"
                    class="mt-1 block w-full"
                    v-model="form.date_time"
                    required
                    autofocus
                    autocomplete="date_time"
                />

                <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Add Product
                </PrimaryButton>
            </div>
        </form>
    </AuthenticatedLayout>
</template>
