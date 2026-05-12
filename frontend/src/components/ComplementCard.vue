<script setup>
defineProps({
    complements: Array
})
</script>

<template>
    <div class="bg-blue-500/10 border border-blue-500/30 rounded-2xl p-6">
        <h3 class="text-blue-400 text-xl font-bold mb-4">
            Detected Complements
        </h3>

        <div class="flex gap-3 flex-wrap">
            <span v-for="(complement, index) in complements" :key="index"
                class="px-4 py-2 rounded-full bg-blue-500/20 text-blue-300 text-sm font-semibold">
                {{ complement.name }}
            </span>
        </div>
    </div>
</template>