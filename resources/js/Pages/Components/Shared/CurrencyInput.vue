<script>
import { useCurrencyInput } from "vue-currency-input";
import { Input } from "flowbite-vue";
import { ref, watch } from "vue";

export default {
    name: "CurrencyInput",
    components: {
        Input,
    },
    props: {
        modelValue: Number,
        label: String,
        currency: String,
    },

    setup(props) {
        const currencySymbol = ref(props.currency);

        const { inputRef } = useCurrencyInput({
            locale: "pt-BR",
            currency: currencySymbol.value,
            currencyDisplay: "symbol",
            precision: 2,
            hideCurrencySymbolOnFocus: false,
            hideGroupingSeparatorOnFocus: false,
            hideNegligibleDecimalDigitsOnFocus: false,
            autoDecimalDigits: true,
            useGrouping: true,
            accountingSign: false,
        });

        return { inputRef };
    },
    watch: {
        //caso mude a moeda selecionada
        currency(newCurrencySymbol) {
            // Emita um evento para informar ao pai sobre a nova seleção
            this.$emit("updateCurrencySymbol", newCurrencySymbol);
        },
    },
};
</script>

<template>
    <Input ref="inputRef" :label="label" />
</template>
