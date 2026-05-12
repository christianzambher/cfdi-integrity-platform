<script setup>
import { ref } from 'vue'

defineProps({
  loading: Boolean
})

const emit = defineEmits(['file-selected'])

const isDragging = ref(false)

const handleFile = (file) => {

  if (!file) return

  emit('file-selected', file)
}

const onInputChange = (event) => {

  const file = event.target.files[0]

  handleFile(file)
}

const onDrop = (event) => {

  event.preventDefault()

  isDragging.value = false

  const file = event.dataTransfer.files[0]

  handleFile(file)
}

const onDragOver = (event) => {

  event.preventDefault()

  isDragging.value = true
}

const onDragLeave = () => {

  isDragging.value = false
}
</script>

<template>

  <div
    @drop="onDrop"
    @dragover="onDragOver"
    @dragleave="onDragLeave"
    class="
      border-2
      border-dashed
      rounded-2xl
      p-10
      text-center
      bg-slate-900
      transition-all
      duration-300
    "
    :class="
      isDragging
        ? 'border-emerald-400 bg-slate-800'
        : 'border-slate-700'
    "
  >

    <input
      type="file"
      accept=".xml"
      @change="onInputChange"
      class="hidden"
      id="xml-upload"
    >

    <label
      for="xml-upload"
      class="cursor-pointer block"
    >

      <div class="space-y-4">

        <div
          class="
            text-emerald-400
            text-5xl
            transition-transform
            duration-300
          "
          :class="
            isDragging
              ? 'scale-125'
              : ''
          "
        >
          ↑
        </div>

        <h2 class="text-2xl font-semibold text-white">
          Upload CFDI XML
        </h2>

        <p class="text-slate-400">
          Drag and drop your XML file here
        </p>

        <p class="text-slate-500 text-sm">
          or click to browse
        </p>

        <div
          v-if="loading"
          class="
            flex
            justify-center
            items-center
            gap-3
            text-emerald-400
            font-semibold
            mt-4
          "
        >

          <div
            class="
              w-5
              h-5
              border-2
              border-emerald-400
              border-t-transparent
              rounded-full
              animate-spin
            "
          />

          <span>
            Processing XML...
          </span>

        </div>

      </div>

    </label>

  </div>

</template>