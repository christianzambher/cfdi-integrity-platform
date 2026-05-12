<script setup>
defineProps({
    warnings: Array
})
</script>

<template>
    <div class="bg-yellow-500/10 border border-yellow-500/30 rounded-2xl p-6">
        <h3 class="text-yellow-400 text-xl font-bold mb-4">
            Warnings
        </h3>
        <ul class="space-y-2">
            <li v-for="(warning, index) in warnings" :key="index" class="text-yellow-300">
                {{ warning }}
            </li>
        </ul>
    </div>
</template>