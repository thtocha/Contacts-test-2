<template>
  <div class="list-contacts">
    <table class="table table-striped">
      <thead>
      <tr>
        <th scope="col">Name</th>
        <th scope="col">Surname</th>
        <th scope="col">Phones</th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="contact in contacts" :key="contact.id">
        <td>{{ contact.name }}</td>
        <td>{{ contact.surname }}</td>
        <td>
          <ul class="list-unstyled">
            <li
              v-for="(phone, index) in contact.phones"
              :key="index"
            >
              {{ phone.phone_number }}
            </li>
          </ul>
        </td>
      </tr>
      </tbody>
    </table>

    <nav aria-label="Page navigation example" class="d-flex justify-content-center mt-3">
      <ul class="pagination">
        <li class="page-item" :class="{ disabled: currentPage === 1 }">
          <a class="page-link" href="#" @click.prevent="changePage(currentPage - 1)">Previous</a>
        </li>
        <li class="page-item" :class="{ active: currentPage === page }" v-for="page in totalPages" :key="page">
          <a class="page-link" href="#" @click.prevent="changePage(page)">{{ page }}</a>
        </li>
        <li class="page-item" :class="{ disabled: currentPage === totalPages }">
          <a class="page-link" href="#" @click.prevent="changePage(currentPage + 1)">Next</a>
        </li>
      </ul>
    </nav>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'

const contacts = ref([])
const currentPage = ref(1)
const totalPages = ref(0)

const fetchContacts = async () => {
  const response = await axios.get(`/contacts?page=${currentPage.value}`)
  contacts.value = response.data.data
  totalPages.value = response.data.meta.last_page
}

const changePage = (page) => {
  if (page >= 1 && page <= totalPages.value) {
    currentPage.value = page
    fetchContacts()
  }
}

onMounted(fetchContacts)
</script>

<style scoped>
.list-contacts {
  margin-top: 30px;
  padding: 30px;
  border: 1px solid rgba(0, 0, 0, 0.125);
  border-radius: 8px;
}
</style>