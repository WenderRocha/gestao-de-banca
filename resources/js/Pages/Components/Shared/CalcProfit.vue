<script setup>
import { Modal, Input } from 'flowbite-vue'
import { ref } from 'vue'
import ErrorValidation from "@/Components/ErrorValidation.vue";
import CurrencyInput from "../Shared/CurrencyInput.vue";
import CurrencyFormat from "./CurrencyFormat.vue";
import Button from "@/Components/Button.vue";
import { CheckCircleIcon, RefreshIcon } from '@heroicons/vue/outline'

const props = defineProps({
  isShowModal: {
    type: Boolean,
    default: false
  },
  currency: {
    type: String,
    default: 'BRL'
  },
  stop: {
    type: String,
    default: 0
  }
})

const emit = defineEmits(['close'])

const closeModal = () => {
  emit('close')
}

const payout = ref(82);
const investiment = ref(props.stop);
const profit = ref(0);
const reloadProfit = ref(0);

const calcProfit = () => {
  profit.value = (payout.value / 100) * investiment.value
  reloadProfit.value++
}


const sumProfit = ref(0);
let profits = [];

calcProfit()

const getTotalProfit = (profit) => {

  profits.push(profit)

  let total = 0;
  profits.forEach(element => {
    total += element
  });

  sumProfit.value = total
  reloadProfit.value++
}


const resetSumProfit = () => {
  sumProfit.value = 0
  profits = []

  reloadProfit.value++
}

</script>

<template>
  <Modal persistent v-if="isShowModal" @close="closeModal()">
    <template #header>
      <div class="flex items-center text-lg">
        Calcular lucro

        <Button @click="resetSumProfit" size="base" variant="secondary" class="ml-3 items-center gap-2 max-w-xs"
          v-slot="{ iconSizeClasses }">
          <RefreshIcon aria-hidden="true" :class="iconSizeClasses" />
        </Button>
      </div>
    </template>
    <template #body>
      <div class="grid grid-cols-3 gap-3">
        <div>
          <Input v-model="payout" @keyup="calcProfit" placeholder="82%" label="Payout" />
        </div>
        <div>
          <CurrencyInput v-model="investiment" @keyup="calcProfit" label="Investimento" :currency="currency" />
        </div>
        <div class="flex items-end justify-center">
          <CurrencyInput v-model="profit" :key="reloadProfit" disabled label="Lucro" :currency="currency" />

          <Button @click="getTotalProfit(profit)" size="base" variant="success" class="ml-3 items-center gap-2 max-w-xs"
            v-slot="{ iconSizeClasses }">
            <CheckCircleIcon aria-hidden="true" :class="iconSizeClasses" />
          </Button>


        </div>

        <div>

        </div>
      </div>

      <div class="py-5">
        <p class="mb-3">Soros:
          <span class="text-cyan-500 font-bold">
            <CurrencyFormat :key="reloadProfit" :currency="currency" :balance="investiment + profit" />
          </span>
        </p>
        <p>Lucro: <span class="text-green-500 font-bold">
            <CurrencyFormat :key="reloadProfit" :currency="currency" :balance="sumProfit" />
          </span>

        </p>

      </div>
    </template>
    <template #footer>
      <div class="flex justify-between">
        <button @click="closeModal" type="button"
          class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
          Fechar
        </button>
      </div>
    </template>

  </Modal>
</template>