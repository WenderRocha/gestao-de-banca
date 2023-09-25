<script setup>
import { Modal, Input } from "flowbite-vue";
import { ref, watch, reactive, defineProps } from "vue";
import Button from "@/Components/Button.vue";
import ErrorValidation from "@/Components/ErrorValidation.vue";
import { useForm } from "@inertiajs/vue3";
import { Select, Toggle, Range } from "flowbite-vue";
import { usePage } from "@inertiajs/vue3";
import { useToast } from "vue-toastification";
import CurrencyInput from "../Shared/CurrencyInput.vue";

const toast = useToast();

const page = usePage();

const isShowModal = ref(false);

function closeModal() {
    isShowModal.value = false;
}

function showModal() {
    isShowModal.value = true;
}

const currencys = [
    { value: "BRL", name: "Real" },
    { value: "USD", name: "Dolar" },
    { value: "EUR", name: "Euro" },
];

const form = useForm({
    name: "",
    currency: "BRL",
    balance: null,
    stop_type: 1,
    stop: null,
    take: null,
    main: true,
    status: true,
    show_checklist: true,
});

const stopTypes = [
    { value: 1, name: "Valor" },
    { value: 2, name: "Proporcional" },
];

const submit = () => {
    form.post(route("wallet.store"), {
        onSuccess: () => {
            toast.success("Carteira criada com sucesso!");
            form.reset();
            closeModal();
        },
        onError: () => {
            if (page.props.errors.error) {
                toast.error(page.props.errors.error[0]);
            }
        },
    });
};

const currency_input_reload = ref(0);

//recebe o evento do componente filho (CurrencyInput) com o novo simbolo de moeda
const updateCurrencySymbol = (newSymbol) => {
    //incrementa a variavel para recarregar o componente CurrencyInput
    currency_input_reload.value++;

    //atribui o novo simbolo
    form.currency = newSymbol;
};

const rangeValueStop = ref(0);
const stopTypeValue = ref(0);

const rangeValueTake = ref(0);
const takeTypeValue = ref(0);

const calValueStop = () => {
    let percetage = (rangeValueStop.value / 100) * form.balance;
    form.stop = rangeValueStop.value;
    stopTypeValue.value = percetage;
    currency_input_reload.value++;
};

const calValueTake = () => {
    let percetage = (rangeValueTake.value / 100) * form.balance;
    form.take = rangeValueTake.value;
    takeTypeValue.value = percetage;
    currency_input_reload.value++;
};

const cleanStopType = () => {
    form.stop = null;
    form.take = null;

    rangeValueTake.value = 0;
    takeTypeValue.value = 0;

    rangeValueStop.value = 0;
    stopTypeValue.value = 0;

    currency_input_reload.value++;
};

function updateBalance() {
    rangeValueTake.value = 0;
    takeTypeValue.value = 0;

    rangeValueStop.value = 0;
    stopTypeValue.value = 0;
}
</script>

<template>
    <Button
        @click="showModal"
        external
        variant="success"
        class="items-center gap-2 max-w-xs flex justify-center"
    >
        <span>Nova carteira</span>
    </Button>

    <Modal persistent v-if="isShowModal" @close="closeModal">
        <template #header>
            <div class="flex items-center text-lg">Nova carteira</div>
        </template>
        <template #body>
            <div>
                <div class="mb-6 grid grid-cols-3 gap-3">
                    <div>
                        <Input
                            v-model="form.name"
                            placeholder="Carteira, Quotex, IQ Option"
                            label="Nome"
                        />
                        <ErrorValidation :error="form.errors.name" />
                    </div>

                    <div>
                        <Select
                            v-model="form.currency"
                            placeholder="Selecione a moeda"
                            :options="currencys"
                            label="Moeda"
                        />
                        <ErrorValidation :error="form.errors.currency" />
                    </div>
                    <div>
                        <CurrencyInput
                            @keyup="updateBalance()"
                            v-model="form.balance"
                            label="Saldo inicial"
                            :currency="form.currency"
                            :key="currency_input_reload"
                            @updateCurrencySymbol="updateCurrencySymbol"
                        />

                        <!-- <Input v-model="form.balance" label="Saldo inicial" /> -->
                        <ErrorValidation :error="form.errors.balance" />
                    </div>
                </div>
                <div
                    v-show="form.balance !== null"
                    class="mb-6 grid grid-cols-3 gap-3"
                >
                    <div>
                        <Select
                            @change="cleanStopType()"
                            v-model="form.stop_type"
                            :options="stopTypes"
                            label="Tipo de stop"
                            placeholder="Escolha o tipo de stop"
                        />

                        <ErrorValidation :error="form.errors.stopType" />
                    </div>
                    <div>
                        <CurrencyInput
                            v-if="form.stop_type === 1"
                            :disabled="form.stop_type === ''"
                            v-model="form.stop"
                            label="Stop Loss"
                            :currency="form.currency"
                            :key="currency_input_reload"
                            @updateCurrencySymbol="updateCurrencySymbol"
                        />

                        <CurrencyInput
                            v-if="form.stop_type === 2"
                            :disabled="true"
                            v-model="stopTypeValue"
                            :label="`Stop Loss ${rangeValueStop}%`"
                            :currency="form.currency"
                            :key="currency_input_reload"
                            @updateCurrencySymbol="updateCurrencySymbol"
                        />

                        <input
                            v-if="form.stop_type === 2"
                            type="range"
                            v-model="rangeValueStop"
                            @change="calValueStop()"
                            class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-500"
                        />
                        <ErrorValidation :error="form.errors.stop" />
                    </div>
                    <div>
                        <CurrencyInput
                            v-if="form.stop_type === 1"
                            :disabled="form.stop_type === ''"
                            v-model="form.take"
                            label="Take profit"
                            :currency="form.currency"
                            :key="currency_input_reload"
                            @updateCurrencySymbol="updateCurrencySymbol"
                        />

                        <CurrencyInput
                            v-if="form.stop_type === 2"
                            :disabled="true"
                            v-model="takeTypeValue"
                            :label="`Take profit ${rangeValueTake}%`"
                            :currency="form.currency"
                            :key="currency_input_reload"
                            @updateCurrencySymbol="updateCurrencySymbol"
                        />

                        <input
                            v-if="form.stop_type === 2"
                            type="range"
                            v-model="rangeValueTake"
                            @change="calValueTake()"
                            class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-500"
                        />

                        <ErrorValidation :error="form.errors.take" />
                    </div>
                </div>
                <div class="mt-10 flex justify-between">
                    <div class="flex flex-col">
                        <Toggle v-model="form.main" label="Principal" />
                        <ErrorValidation :error="form.errors.main" />
                    </div>
                    <div>
                        <Toggle v-model="form.status" label="Ativo" />
                        <ErrorValidation :error="form.errors.status" />
                    </div>
                    <div>
                        <Toggle
                            v-model="form.show_checklist"
                            label="Exibir checklist"
                        />
                        <ErrorValidation :error="form.errors.show_checklist" />
                    </div>
                </div>
            </div>
        </template>
        <template #footer>
            <div class="flex justify-between">
                <Button
                    @click="closeModal"
                    variant="secondary"
                    class="items-center gap-2 max-w-xs flex justify-center"
                >
                    <span>Cancelar</span>
                </Button>
                <Button
                    @click="submit"
                    :disabled="form.processing"
                    variant="primary"
                    class="items-center gap-2 max-w-xs flex justify-center"
                >
                    <span v-show="!form.processing">Criar carteira</span>
                    <span v-show="form.processing">Aguarde...</span>
                </Button>
            </div>
        </template>
    </Modal>
</template>
