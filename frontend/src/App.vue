<script setup>
  import { onMounted, ref } from 'vue';
  import axios from 'axios';

  const apiMessage = ref('Loading...');

  onMounted(async () => {
    try {
      const response = await axios.get('http://localhost:8080/api/health');
      apiMessage.value = response.data.message;
    } catch (error) {
      apiMessage.value = 'API Connection Failed';
      console.error(error);
    }
  });
</script>

<template>
  <main>
    <h1>CFDI Integrity Platform</h1>
    <p>{{ apiMessage }}</p>
  </main>
</template>

<style scoped></style>
