<script setup>
import Button from "@/Components/Button.vue";
import { router } from "@inertiajs/vue3";
import { useToast } from "vue-toastification";
import { Link } from "@inertiajs/vue3";
import CurrencyFormat from "../Shared/CurrencyFormat.vue";
import EditWallet from "../Wallet/EditWallet.vue";
import { ref, watch, reactive, defineProps } from "vue";

const toast = useToast();

const props = defineProps({
    wallet: {
        type: Object,
        default: {
            id: null,
            name: "",
            balance: null,
            currency: null,
            main: null,
            stopType: null,
        },
    },
});

const deleteWallet = (id) => {
    if (confirm("Deseja realmente deletar a carteira ?")) {
        router.delete(route("wallet.destroy", id), {
            onSuccess: () => {
                toast.success("Carteira deletada com sucesso!");
            },
            onError: () => {
                toast.error("Oops! Não foi possivel deletar a carteira.");
            },
        });
    }
};

//atualiza o componente currency format após atualizar os dados da carteira.
const refreshCurrencyFormat = ref(0);
const currencyFormatUpdated = () => {
    refreshCurrencyFormat.value++;
};
</script>

<template>
    <div
        class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700"
    >
        <div class="flex justify-end gap-3 px-4 pt-4">
            <Button
                @click="deleteWallet(props.wallet.id)"
                variant="secondary"
                class="items-center gap-2 max-w-xs flex justify-center"
            >
                <span>Deletar</span>
            </Button>

            <EditWallet
                @currency-format-update="currencyFormatUpdated"
                :wallet="props.wallet"
            />
        </div>
        <div class="flex flex-col items-center pb-10">
            <div class="w-30 h-30 mb-3 rounded-full shadow-lg">
                <img src="/img/app-wallet-passes.png" alt="Bonnie image" />
            </div>
            <h5
                class="mb-1 flex gap-2 text-xl font-medium text-gray-900 dark:text-white"
            >
                {{ props.wallet.name }}

                <svg
                    v-show="props.wallet.main"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-6 h-6 text-blue-500"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z"
                    />
                </svg>
            </h5>
            <span class="text-sm text-green-500 font-bold dark:text-green-400">
                <span>
                    <CurrencyFormat
                        :key="refreshCurrencyFormat"
                        :currency="props.wallet.currency"
                        :balance="props.wallet.balance"
                    />
                </span>
            </span>
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
