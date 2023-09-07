<script setup>
import AuthenticatedLayout from "@/Layouts/Authenticated.vue";
import Button from "@/Components/Button.vue";
import { GithubIcon } from "@/Components/Icons/brands";
import Wallet from "../Pages/Components/Wallet/Wallet.vue";
</script>

<template>
    <AuthenticatedLayout title="Carteiras">
        <template #header>
            <div
                class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between"
            >
                <h2 class="text-xl font-semibold leading-tight">Carteiras</h2>

                <Button
                    external
                    variant="success"
                    class="items-center gap-2 max-w-xs flex justify-center"
                >
                    <span>Nova carteira</span>
                </Button>
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
