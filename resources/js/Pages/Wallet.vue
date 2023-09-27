<script setup>
import AuthenticatedLayout from "@/Layouts/Authenticated.vue";
import ListWallet from "../Pages/Components/Wallet/ListWallet.vue";
import CreateWallet from "../Pages/Components/Wallet/CreateWallet.vue";
import { Alert } from "flowbite-vue";
import { usePage } from '@inertiajs/vue3'
import { useToast } from "vue-toastification";


const toast = useToast();

const props = defineProps({
    wallets: Array,
});

const page = usePage()
if(page.props.errors.mainError) {
    toast.info(page.props.errors.mainError[0], {
        timeout: 3900
      });
}


</script>

<template>
    <AuthenticatedLayout title="Carteiras">
        <template #header>
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <h2 class="text-xl font-semibold leading-tight">Carteiras</h2>

                <CreateWallet />
            </div>
        </template>

        <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
            <Alert v-show="!props.wallets.length > 0" type="info" class="mb-2 w-full">Nenhuma carteira encontrada, crie sua
                carteira para iniciar o
                gerênciamento!</Alert>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                <ListWallet v-for="wallet in wallets" :key="wallet.id" :wallet="wallet" />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
