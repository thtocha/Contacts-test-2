<script setup>
import { ref } from 'vue'
import PhoneInput from "./PhoneInput.vue";
import {useToast} from 'vue-toast-notification';

const firstname = ref('')
const lastname = ref('')
const phone = defineModel()
const $toast = useToast();

const additionalPhones = ref([])

const removeAdditionalPhoneInput = (index) => {
  additionalPhones.value.splice(index, 1)
}

const onSubmit = () => {
  let phones = [phone.value, ...additionalPhones.value]
  phones = phones.map(phone => phone.replace(/\s+/g, ''));

  axios.post('/contacts', {
      name: firstname.value,
      surname: lastname.value,
      phones: phones
  })
    .then(() => {
      firstname.value = ''
      lastname.value = ''
      phone.value = ''
      additionalPhones.value = []

      $toast.success('Contact added successfully!');
    })
    .catch((error) => {
      $toast.error('An error occurred while adding the contact!');
    })
}
</script>

<template>
<form
    class="add-contact-form"
    method="POST"
    action="/contacts"
    @submit.prevent="onSubmit"
>
  <label for="firstname_input" class="form-label">Name</label>
  <input
      v-model="firstname"
      id="firstname_input"
      name="firstname"
      type="text"
      class="form-control"
      placeholder="John"
      required
  >
  <label for="lastname_input" class="form-label mt-2">Surname</label>
  <input
      v-model="lastname"
      id="lastname_input"
      name="lastname"
      type="text"
      class="form-control"
      placeholder="Dou"
      required
  >
  <label for="phone_input" class="form-label mt-2">Phone</label>
  <vue-tel-input
      v-model="phone"
      name="phone"
      mode="international"
      :required=true
  ></vue-tel-input>
  <PhoneInput
      class="mt-2"
      v-for="(additionalPhone, index) in additionalPhones"
      :index="index"
      v-model="additionalPhones[index]"
      @remove-additional-phone-input="removeAdditionalPhoneInput"
  />
  <div class="submit-form">
    <button
        @click="additionalPhones.push('')"
        type="button"
        class="btn rounded-circle btn-success"
    ><i class="bi bi-plus"></i></button>
    <button
        type="submit"
        class="btn btn-primary ms-2"
    >
      Submit
    </button>
  </div>
</form>
</template>

<style scoped>
.add-contact-form {
  margin-top: 30px;
  padding: 30px;
  border: 1px solid rgba(0, 0, 0, 0.125);
  border-radius: 8px;
}
.submit-form {
  margin-top: 30px;
}
</style>