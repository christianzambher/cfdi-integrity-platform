<script setup>
defineProps({
    metadata: Object
})
</script>

<template>
    <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6">
        <h3 class="text-xl font-bold text-white mb-6">
            CFDI Metadata
        </h3>
        <div class="grid md:grid-cols-2 gap-4">
            <div>
                <p class="text-slate-400 text-sm">Version</p>
                <p class="text-white font-semibold">
                    {{ metadata.version }}
                </p>
            </div>
            <div>
                <p class="text-slate-400 text-sm">UUID</p>
                <p class="text-white font-semibold break-all">
                    {{ metadata.uuid }}
                </p>
            </div>
            <div>
                <p class="text-slate-400 text-sm">Emisor RFC</p>
                <p class="text-white font-semibold">
                    {{ metadata.emisor }}
                </p>
            </div>
            <div>
                <p class="text-slate-400 text-sm">Receptor RFC</p>
                <p class="text-white font-semibold">
                    {{ metadata.receptor }}
                </p>
            </div>
            <div>
                <p class="text-slate-400 text-sm">Total</p>
                <p class="text-white font-semibold">
                    {{ metadata.total }}
                </p>
            </div>
            <div>
                <p class="text-slate-400 text-sm">Fecha</p>
                <p class="text-white font-semibold">
                    {{ metadata.fecha }}
                </p>
            </div>
        </div>
    </div>
</template>