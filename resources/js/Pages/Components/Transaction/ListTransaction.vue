<script>



</script>

<template>
    <div  class="relative overflow-x-auto mt-5">

        <table  class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Data
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Descrição
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Tipo
                    </th>
                    <th v-show="false" scope="col" class="px-6 py-3">
                        Para
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Valor
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        22/10/2023
                    </th>
                    <td class="px-6 py-4">
                        Transferecia efetuada
                    </td>
                    <td class="px-6 py-4">
                        Transferecia
                    </td>
                    <td v-show="false" class="px-6 py-4">
                        IQ OPTION
                    </td>
                    <td class="px-6 py-4">
                        300
                    </td>
                </tr>

            </tbody>
        </table>
    </div>


</template>