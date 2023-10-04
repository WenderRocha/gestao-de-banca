<script setup>
import AuthenticatedLayout from "@/Layouts/Authenticated.vue";
import Button from "@/Components/Button.vue";
import { CalculatorIcon } from '@heroicons/vue/outline'
import ManagementCard from "../Pages/Components/Shared/ManagementCard.vue";
import CalcProfit from "../Pages/Components/Shared/CalcProfit.vue";
import { ref, reactive } from "vue"
import { isDark } from '@/Composables'
import { Bar, Doughnut } from 'vue-chartjs'
import {
    Chart as ChartJS,
    Title,
    ArcElement,
    Tooltip,
    Legend,
    BarElement,
    CategoryScale,
    LinearScale,
} from "chart.js";

ChartJS.register(Title, ArcElement, Tooltip, Legend, BarElement, CategoryScale, LinearScale)

const props = defineProps({
    wallet: Object
})

const takeTypeValue = ref(
    props.wallet.stop_type === 2 ? (props.wallet.take / 100) * props.wallet.balance : props.wallet.take
);
const stopTypeValue = ref(
    props.wallet.stop_type === 2 ? (props.wallet.stop / 100) * props.wallet.balance : props.wallet.stop
);

const attrs = ref([
  
    {
        key: "gray",
        highlight: "gray",
        dates: new Date(2023, 9, 1),
  
    },
    {
        key: "gray",
        highlight: "gray",
        dates: new Date(2023, 9, 2),

    },
    {
        key: "win",
        highlight: "green",
        dates: new Date(2023, 9, 3),
        popover: {
            label: "Win, 150.00 -> 180.40 = 30.40",
        },
    },
    {
        key: "win2",
        highlight: "green",
        dates: new Date(2023, 9, 4),
        popover: {
            label: "Win, 180.40 -> 217.30 = 36.90",
        },
    },

]);



const chartData = reactive({
    labels: [
        "Jan",
        "Feb",
        "Mar",
        "Abr",
        "Mai",
        "Jun",
        "Jul",
        "Ago",
        "Set",
        "Out",
        "Nov",
        "Dez",
    ],
    datasets: [
        {
            label: "Desempenho mensal",
            backgroundColor: "#a855f7",
            data: [40, 20, 12],
        },
    ],
});

const chartOptions = ref({
    responsive: true
})


const doughnutData = reactive({
    labels: ["Win", "Loss"],
    datasets: [
        {
            backgroundColor: ["#a855f7", "#3b0764"],
            data: [2, 0],
        },
    ],
});

const doughnutOptions = reactive({
    responsive: true,
    maintainAspectRatio: false,
});


//modal calc profit
const isShowCalcProfit = ref(false);

function showModalCalcProfit() {
    isShowCalcProfit.value = true
}
function closeModalCalcProfit() {
    isShowCalcProfit.value = false
}
</script>

<template>
    <AuthenticatedLayout title="Dashboard">
        <template #header>
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <div class="flex items-center gap-2">
                    <img class="w-10" :src="wallet.logo" :alt="wallet.name" :title="wallet.name">
                    <h2 class="text-xl font-semibold leading-tight">{{ wallet.name }}</h2>
                </div>

                <Button @click="showModalCalcProfit" variant="primary"  class="items-center gap-2 max-w-xs"
                    v-slot="{ iconSizeClasses }">
                    <CalculatorIcon aria-hidden="true" :class="iconSizeClasses" />
                </Button>
            </div>
        </template>

        <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">

            <div class="py-5 grid grid-cols-2 sm:grid-cols-4 gap-2">
                <ManagementCard title="Saldo inicial" :currency="wallet.currency" :balance="wallet.initial_balance" />
                <ManagementCard title="Saldo Atual" :currency="wallet.currency" :balance="wallet.balance">
                    <template #icon>

                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-10 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0012 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z" />
                        </svg>

                    </template>
                </ManagementCard>
                <ManagementCard title="Take profit" :currency="wallet.currency" :balance="takeTypeValue">
                    <template #icon>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-10 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" />
                        </svg>

                    </template>
                </ManagementCard>
                <ManagementCard title="Stop Loss" :currency="wallet.currency" :balance="stopTypeValue">
                    <template #icon>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-10 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                        </svg>
                    </template>
                </ManagementCard>
            </div>

            <div class="w-full py-5 border border-gray-200 rounded-lg dark:border-gray-700">
                <VCalendar :is-dark="isDark" :attributes='attrs' borderless expanded />
            </div>

            <div class="w-full py-5">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">

                    <a href="#"
                        class="w-full p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                        <Bar id="my-chart-id" :options="chartOptions" :data="chartData" />
                    </a>


                    <a href="#"
                        class="w-full p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                        <Doughnut :data="doughnutData" :options="doughnutOptions" />
                    </a>

                </div>
            </div>
        </div>

        <CalcProfit @close="closeModalCalcProfit" :is-show-modal="isShowCalcProfit" :currency="wallet.currency" :stop="stopTypeValue"/>
    </AuthenticatedLayout>
</template>
