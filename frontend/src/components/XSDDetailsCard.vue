<script setup>
defineProps({
    errors: Array
})
</script>

<template>
    <div class="bg-orange-500/10 border border-orange-500/30 rounded-2xl p-6">
        <h3 class="text-orange-400 text-xl font-bold mb-4">
            Errors XSD
        </h3>
        <ul class="space-y-2">
            <li v-for="(error, index) in errors" :key="index" class="text-orange-300 bg-orange-500/10 border border-orange-500/20 rounded-lg p-4">
                <p class="font-semibold">
                    Line {{ error.line }}
                </p>
                <p class="mt-1 text-sm">
                    {{ error.message }}
                </p>
            </li>
        </ul>
    </div>
</template>