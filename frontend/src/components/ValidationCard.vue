<script setup>
defineProps({
    validation: Object
})
</script>

<template>
    <div class="rounded-2xl p-6 border bg-slate-900" :class="validation.valid
        ? 'border-emerald-500'
        : 'border-red-500'
        ">
        <h3 class="text-xl font-bold text-white mb-4">
            Validation Status
        </h3>

        <div class="flex gap-3 flex-wrap">
            <span class="px-4 py-2 rounded-full text-sm font-semibold" :class="validation.valid
                ? 'bg-emerald-500/20 text-emerald-400'
                : 'bg-red-500/20 text-red-400'
                ">
                {{
                    validation.valid
                        ? 'VALID XML'
                        : 'INVALID XML'
                }}
            </span>

            <span v-if="validation.xsd_validation" class="px-4 py-2 rounded-full text-sm font-semibold" :class="validation.xsd_validation.valid
                ? 'bg-blue-500/20 text-blue-400'
                : 'bg-yellow-500/20 text-yellow-400'
                ">
                {{
                    validation.xsd_validation.valid
                        ? 'SAT COMPLIANT'
                        : 'SAT WARNINGS'
                }}
            </span>
        </div>
    </div>
</template>