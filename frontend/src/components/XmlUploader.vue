<script setup>
import { ref } from 'vue';
import axios from 'axios';

const result = ref(null);
const loading = ref(false);

const uploadXml = async (event) => {
    const file = event.target.files[0];
    if (!file) return;

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
        console.log(response)

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
    }
    loading.value = false;
}   
</script>

<template>
    <main class="min-h-screen bg-gray-100 p-10">
        <div class="max-w-3xl mx-auto bg-white rounded-xl shadow-lg p-8">
            <h1 class="text-4xl font-bold mb-6 text-gray-800">CFDI Integrity Platform</h1>

            <input type="file" accept=".xml" @change="uploadXml"
                class="mb-6 block w-full border border-gray-300 rounded-lg p-3">

            <p v-if="loading" class="text-blue-600 font-semibold">Processing XML...</p>

            <div v-if="result" class="mt-6">
                <div class="p-4 rounded-lg mb-6" :class="result.valid
                    ? 'bg-green-100 text-green-800'
                    : 'bg-red-100 text-red-800'">
                    <h2 class="text-2xl font-bold">Status : {{ result.valid ? 'Valid XML' : 'Invalid XML' }}</h2>
                </div>
                <div v-if="result.metadata" class="bg-gray-50 border rounded-lg p-6">
                    <h3 class="text-xl font-semibold mb-4">CFDI Metadata</h3>
                    <ul class="space-y-2">
                        <li>
                            <strong>Version:</strong> {{ result.metadata.version }}
                        </li>
                        <li>
                            <strong>UUID:</strong> {{ result.metadata.uuid }}
                        </li>
                        <li>
                            <strong>Emisor RFC:</strong> {{ result.metadata.emisor }}
                        </li>
                        <li>
                            <strong>Receptor RFC:</strong> {{ result.metadata.receptor }}
                        </li>
                        <li>
                            <strong>Total:</strong> {{ result.metadata.total }}
                        </li>
                        <li>
                            <strong>Fecha:</strong> {{ result.metadata.fecha }}
                        </li>
                    </ul>
                </div>

                <div v-if="result.warnings && result.warnings.length"
                    class="mt-6 bg-yellow-50 border border-yellow-200 rounded-lg p-6">
                    <h3 class="text-xl font-semibold text-yellow-700 mb-4">
                        Warnings
                    </h3>

                    <ul class="space-y-2">
                        <li v-for="(warning, index) in result.warnings" :key="index" class="text-yellow-700">
                            {{ warning }}
                        </li>
                    </ul>
                </div>

                <div v-if="result.errors.length" class="mt-6 bg-red-50 border border-red-200 rounded-lg p-6">
                    <h3 class="text-xl font-semibold text-red-700 mb-4">Errors:</h3>
                    <ul class="space-y-2">
                        <li v-for="(error, index) in result.errors" :key="index" class="text-red-600">
                            {{ error.message }}
                            <span v-if="error.line">- Line {{ error.line }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </main>
</template>