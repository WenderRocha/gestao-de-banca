<script setup>
import Button from "@/Components/Button.vue";
import { router } from "@inertiajs/vue3";
import { useToast } from "vue-toastification";
import { Link } from "@inertiajs/vue3";

const toast = useToast();

const props = defineProps({
    id: {
        type: String,
        default: null,
    },
    name: {
        type: String,
        default: "Minha carteira",
    },
    balance: {
        type: String,
        default: 0,
    },
    currency: {
        type: String,
        default: "R$",
    },
});

const deleteWallet = (id) => {
    if (confirm("Deseja realmente deletar a carteira ?")) {
        router.delete(route("wallet.destroy", id), {
            onSuccess: (page) => {
                toast.success("Carteira deletada com sucesso!");
            },
            onError: (errors) => {
                toast.error("Oops! Não foi possivel deletar a carteira.");
            },
        });
    }
};
</script>

<template>
    <div
        class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700"
    >
        <div class="flex justify-end px-4 pt-4">
            <Link
                href=""
                @click="deleteWallet(props.id)"
                class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white"
                >Deletar</Link
            >
        </div>
        <div class="flex flex-col items-center pb-10">
            <div class="w-30 h-30 mb-3 rounded-full shadow-lg">
                <img src="/img/app-wallet-passes.png" alt="Bonnie image" />
            </div>
            <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">
                {{ props.name }}
            </h5>
            <span class="text-sm text-green-500 font-bold dark:text-gray-400"
                >{{ props.currency }} {{ props.balance }}</span
            >
            <div class="flex mt-4 space-x-3 md:mt-6">
                <Button variant="primary" class="items-center gap-2 max-w-xs">
                    <span>Gerênciar</span>
                </Button>
                <a
                    href="#"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-700 dark:focus:ring-gray-700"
                    >Transação</a
                >
            </div>
        </div>
    </div>
</template>

<style></style>
