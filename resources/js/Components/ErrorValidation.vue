<script setup>

defineProps({
    error: null
})
</script>

<template>
    <span class="text-red-500 text-sm" v-show="error">{{ error }}</span>
</template>