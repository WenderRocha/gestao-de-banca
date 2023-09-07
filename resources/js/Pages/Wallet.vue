<script setup>
import AuthenticatedLayout from "@/Layouts/Authenticated.vue";
import Button from "@/Components/Button.vue";
import { GithubIcon } from "@/Components/Icons/brands";
import Wallet from "../Pages/Components/Wallet/Wallet.vue";
import CreateWallet from "../Pages/Components/Wallet/CreateWallet.vue";
</script>

<template>
    <AuthenticatedLayout title="Carteiras">
        <template #header>
            <div
                class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between"
            >
                <h2 class="text-xl font-semibold leading-tight">Carteiras</h2>

                <CreateWallet/>
            </div>
        </template>

        <div
            class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1"
        >
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                <Wallet />
                <Wallet />
                <Wallet />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
