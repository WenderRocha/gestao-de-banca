<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import Button from '@/Components/Button.vue'
import { GithubIcon } from '@/Components/Icons/brands'
import ListTransaction from '../Pages/Components/Transaction/ListTransaction.vue'
</script>

<template>
    <AuthenticatedLayout title="Transaçoes">
        <template #header>
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <h2 class="text-xl font-semibold leading-tight">
                    Transações
                </h2>

                <Button  variant="primary" class="items-center gap-2 max-w-xs"
                    v-slot="{ iconSizeClasses }">
                    <span>Nova Transação</span>
                </Button>
            </div>
        </template>

        <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
            <div class=" mb-8 w-2/12">

                <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Selecione uma carteira</label>
                <select id="countries"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected>IQ OPTION</option>
                    <option value="US">QUEOTEX</option>
                    <option value="CA">Canada</option>
                    <option value="FR">France</option>
                    <option value="DE">Germany</option>
                </select>
            </div>
            <ListTransaction/>
        
        </div>
    </AuthenticatedLayout>
</template>
