<script setup>
import { Modal, Input } from "flowbite-vue";
import { ref } from "vue";
import Button from "@/Components/Button.vue";
import ErrorValidation from "@/Components/ErrorValidation.vue";
import { useForm } from "@inertiajs/vue3";
import { Select, Toggle } from "flowbite-vue";
import { usePage } from "@inertiajs/vue3";
import { useToast } from "vue-toastification";

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
    { value: "USD", name: "Dólar" },
    { value: "EUR", name: "Euro" },
    { value: "LIB", name: "Libra" },
];

const stopTypes = [
    { value: 1, name: "Valor R$" },
    { value: 2, name: "Proporcional %" },
];

const form = useForm({
    name: "Minha carteira",
    currency: "BRL",
    balance: null,
    stopType: "",
    stop: null,
    take: null,
    main: true,
    status: true,
    checklist: true,
});

const submit = () => {
    form.post(route("wallet.store"), {
        onSuccess: () => {
            toast.success("Carteira criada com sucesso!");
            form.reset();
            closeModal();
        },
        onError: () => {
            toast.error(page.props.errors.error[0]);
        },
    });
};
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
                            placeholder="Minha carteira, Quotex, IQ Option"
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
                        <Input v-model="form.balance" label="Saldo inicial" />
                        <ErrorValidation :error="form.errors.balance" />
                    </div>
                </div>
                <div class="mb-6 grid grid-cols-3 gap-3">
                    <div>
                        <Select
                            v-model="form.stopType"
                            :options="stopTypes"
                            label="Tipo de stop"
                            placeholder="Escolha o tipo de stop"
                        />
                        <ErrorValidation :error="form.errors.stopType" />
                    </div>
                    <div>
                        <Input v-model="form.stop" label="Stop" />
                        <ErrorValidation :error="form.errors.stop" />
                    </div>
                    <div>
                        <Input v-model="form.take" label="Take" />
                        <ErrorValidation :error="form.errors.take" />
                    </div>
                </div>
                <div class="mt-10 flex justify-between">
                    <div>
                        <Toggle v-model="form.main" label="Principal" />
                        <ErrorValidation :error="form.errors.main" />
                    </div>
                    <div>
                        <Toggle v-model="form.status" label="Status" />
                        <ErrorValidation :error="form.errors.status" />
                    </div>
                    <div>
                        <Toggle v-model="form.checklist" label="Exibir checklist"/>
                        <ErrorValidation :error="form.errors.checklist" />
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
