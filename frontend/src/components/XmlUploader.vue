<script setup>
import { ref } from 'vue';
import axios from 'axios';

import UploadZone from './UploadZone.vue'
import ValidationCard from './ValidationCard.vue'
import MetadataCard from './MetadataCard.vue'
import WarningCard from './WarningCard.vue'
import ComplementCard from './ComplementCard.vue'
import XSDDetailsCard from './XSDDetailsCard.vue';

const result = ref(null);
const loading = ref(false);

const uploadXml = async (file) => {
    const formData = new FormData();
    formData.append('xmlFile', file);
    loading.value = true;

    try {
        const response = await axios.post(
            'http://localhost:8080/api/xml/validate',
            formData,
            {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }
        )
        result.value = response.data
    } catch (error) {
        console.error(error);
        result.value = {
            valid: false,
            errors: [
                {
                    message: 'Upload failed'
                }
            ]
        }
    } finally {
        loading.value = false;
    }
}   
</script>

<template>
    <main class="min-h-screen bg-slate-950 p-8">
        <div class="max-w-6xl mx-auto">
            <div class="mb-10">
                <h1 class="text-5xl font-bold text-white mb-4">
                    CFDI Integrity Platform
                </h1>
                <p class="text-slate-400 text-lg">
                    CFDI XML validation and sanitization platform
                </p>
            </div>

            <UploadZone :loading="loading" @file-selected="uploadXml" />

            <div v-if="result" class="grid gap-6 mt-8">
                <ValidationCard :validation="result" />

                <MetadataCard v-if="result.metadata" :metadata="result.metadata" />

                <ComplementCard v-if="result.detected_complements?.length" :complements="result.detected_complements" />

                <WarningCard v-if="result.warnings?.length" :warnings="result.warnings" />

                <XSDDetailsCard v-if="result.xsd_validation && result.xsd_validation.errors?.length" :errors="result.xsd_validation.errors" />
            </div>
        </div>
    </main>
</template>