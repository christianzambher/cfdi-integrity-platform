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
    <main>
        <h1>CFDI Integrity Platform</h1>

        <input type="file" accept=".xml" @change="uploadXml">

        <p v-if="loading">Processing XML...</p>

        <div v-if="result">
            <h2>Status : {{ result.valid ? 'Valid XML' : 'Invalid XML' }}</h2>

            <div v-if="result.errors.length">
                <h3>Errors:</h3>

                <ul>
                    <li v-for="(error, index) in result.errors" :key="index">
                        {{ error.message }}
                        <span v-if="error.line">- Line {{ error.line }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </main>
</template>