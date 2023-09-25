<script setup>
import { defineProps } from "vue";
import CurrencyFormat from "./CurrencyFormat.vue";

const props = defineProps({
    title: {
        type: String,
        default: 'Title'
    },
    balance:  {
        type: Number,
        default: 100
    },
    currency: {
        type: String,
        default: 'BRL'
    },
});
</script>

<template>
    <a
        href="#"
        class="max-w-sm p-6 bg-purple-500 border border-gray-200 rounded-lg shadow dark:bg-purple-800 dark:border-gray-700 dark:hover:bg-purple-700 flex justify-between"
    >
        <div>
            <h5
                class="mb-2 text-1xl font-bold tracking-tight text-white dark:text-white uppercase"
            >
                {{ props.title }}
            </h5>
            <div class="flex items-center gap-1">
                <!-- <small class="font-bold text-white dark:text-gray-400"
                    >R$</small
                >
                <p class="font-bold text-2xl text-white dark:text-gray-400">
                    100,00
                </p> -->

                <p class="font-bold text-2xl text-white dark:text-gray-400">
                    <CurrencyFormat :currency="props.currency" :balance="props.balance"/>
                </p>

                
            </div>
        </div>
        <div>
            <slot name="icon">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-10 text-white"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M21 12a2.25 2.25 0 00-2.25-2.25H15a3 3 0 11-6 0H5.25A2.25 2.25 0 003 12m18 0v6a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 18v-6m18 0V9M3 12V9m18 0a2.25 2.25 0 00-2.25-2.25H5.25A2.25 2.25 0 003 9m18 0V6a2.25 2.25 0 00-2.25-2.25H5.25A2.25 2.25 0 003 6v3"
                    />
                </svg>
            </slot>
        </div>
    </a>
</template>
