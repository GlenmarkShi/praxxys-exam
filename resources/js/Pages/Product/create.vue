<script setup>
import Checkbox from "@/Components/Checkbox.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import useVuelidate from '@vuelidate/core';
import { required } from '@vuelidate/validators';
import { reactive } from "vue";

import { ref } from "vue";
const formStep = ref(1);

const form = useForm({
    name: "",
    category: "",
    description: "",
    date_time: "",
    image:"",
});
const rules = {
    name: { required},
    category: { required},
    description: { required},
    date_time: { required},
    image:{ required},
};

const v$ = useVuelidate(rules, form);

function nextStep() {
    formStep.value++;
}

function previousStep() {
    formStep.value--;
}

const submit = async() => {
  const result = await v$.value.$validate();
    form.post(route("product.store"));
};
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Add Product" />
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Add Products
            </h2>
        </template>

        <div class="container card mt-6 pb-8">
        <form @submit.prevent="submit" enctype="multipart/form-data">
            <div v-if="formStep == 1" class="pt-3">
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
                <div v-if="form.errors.name">{{ form.errors.name }}</div>
                <span v-for="error in v$.name.errors" :key="id" class="text-red-500">{{ error.name }}</span>
            </div>

            <div v-if="formStep == 1" class="pt-3">
                Category: {{ selected }}

                <select v-model="form.category" name="category">
                    <option disabled value="">Please select one</option>
                    <option value="1">Fruit</option>
                    <option value="2">Bevarages</option>
                    <option value="3">Food</option>
                </select>
            </div>

            <div v-if="formStep == 1">
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

              <div v-if="formStep == 2" class="mx-8">
                <InputLabel for="image" value="Image" />

                <input
                    id="image"
                    type="file" multiple
                    class="mt-1 block w-full"
                    name="image"
                    required
                    autofocus
                />
                <InputError class="mt-2" :message="form.errors.image" />
            </div>

            <div v-if="formStep == 3">
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
                <InputError class="mt-2" :message="form.errors.date_time" />
            </div>

            <div class="pt-2">
            <PrimaryButton
                class="ml-4" v-if="formStep == 2 || formStep == 3"  @click="previousStep">
                Previos
            </PrimaryButton>

            <PrimaryButton class="ml-4" v-if="formStep == 1 || formStep == 2"  @click.prevent="nextStep">
                Next
            </PrimaryButton>



            <PrimaryButton
                class="ml-4"
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
                v-if="formStep == 3" @click="submit"
            >
                Add Product
            </PrimaryButton>
          </div>
        </form>
      </div>
    </AuthenticatedLayout>
</template>
