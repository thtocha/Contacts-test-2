<script setup>
defineProps(['index'])
const phone = defineModel()
</script>

<template>
<div class="phone-input d-flex justify-content-between">
  <vue-tel-input class="me-2" v-model="phone" mode="international"></vue-tel-input>
  <button
      @click="$emit('removeAdditionalPhoneInput', index)"
      type="button"
      class="btn rounded-circle btn-danger"
  >
    <i class="bi bi-dash-lg"></i>
  </button>
</div>
</template>

<style scoped>
.phone-input {
  width: 100%;
}
</style>