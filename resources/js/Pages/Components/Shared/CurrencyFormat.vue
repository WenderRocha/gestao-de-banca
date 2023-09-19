<script setup>
import { reactive, computed, defineProps, ref } from "vue";

const props = defineProps({
    currency: {
        type: String,
        default: "BRL",
    },
    balance: null,
});

// Converter a string para um número (float)
const balance = parseFloat(props.balance);

const currencySymbol = computed({
    // getter
    get() {
        switch (props.currency) {
            case "BRL":
                return balance.toLocaleString("pt-BR", {
                    style: "currency",
                    currency: "BRL",
                });
                break;

            case "USD":
                return balance.toLocaleString("en-US", {
                    style: "currency",
                    currency: "USD",
                });
                break;

            case "EUR":
                return balance.toLocaleString("de-DE", {
                    style: "currency",
                    currency: "EUR",
                });
                break;
            case "LIB":
                return balance.toLocaleString("en-GB", {
                    style: "currency",
                    currency: "GBP",
                });
                break;

            default:
                return balance.toLocaleString("pt-BR", {
                    style: "currency",
                    currency: "BRL",
                });
                break;
        }
    },
});
</script>

<template>
    {{ currencySymbol }}
</template>

<style></style>
