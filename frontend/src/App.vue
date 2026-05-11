<script setup>
  // import { onMounted, ref } from 'vue';
  // import axios from 'axios';
  import XmlUploader from './components/XmlUploader.vue'

  // const apiMessage = ref('Loading...');

  // onMounted(async () => {
  //   try {
  //     const response = await axios.get('http://localhost:8080/api/health');
  //     apiMessage.value = response.data.message;
  //   } catch (error) {
  //     apiMessage.value = 'API Connection Failed';
  //     console.error(error);
  //   }
  // });
</script>

<template>
  <XmlUploader />
</template>

<style scoped></style>
