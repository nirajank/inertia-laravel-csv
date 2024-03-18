<template>
  <!-- <div class="modal fade" id="editClientModal" tabindex="-1" aria-labelledby="editClientModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editClientModalLabel">Edit Client</h5>
          <button type="button" class="btn-close" @click="close"></button>
        </div>
        <div class="modal-body">
          <form @submit.prevent="submit">
            <div class="mb-3">
              <label for="name" class="form-label">Name</label>
              <input type="text" v-model="client.name" class="form-control" id="name" required>
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" v-model="client.email" class="form-control" id="email" required>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
          </form>
        </div>
      </div>
    </div>
  </div> -->
  <div>
    <!-- Button trigger modal -->

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">{{ intend }} Client</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="close" id="close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="submit">
            <div class="modal-body">

              <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" v-model="form.name" class="form-control" id="name" required>
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" v-model="form.email" class="form-control" id="email" required>
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Phome</label>
                <input type="text" v-model="form.phone" class="form-control"  required>
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Address</label>
                <input type="text" v-model="form.address" class="form-control" required>
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Nationality</label>
                <input type="text" v-model="form.nationality" class="form-control" required>
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Background</label>
                <input type="text" v-model="form.background" class="form-control" required>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="close">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";
import { defineProps, ref, watch } from 'vue'; // Import necessary functions from Vue

const props = defineProps({
  client: Object,
  isOpen: Boolean,
  intend: String,
});

const close = () => {
  document.getElementById('close').click();
};
const form = ref(props.client);
const submit = () => {
  if (props.intend == 'Create') {
    let formData = useForm(form.value);
    formData.post("/clients");
    close();

  }
  if (props.intend == 'Edit') {
    let formData = useForm(form.value);
    formData.post(`/clients/save/${form.value.id}`);
    close();
  }


};

watch(props, (newVal, oldVal) => {
  if (parseInt(form.id) != parseInt(newVal.client.id)) {
    form.value = { ...newVal.client };
  }
}, { deep: true });

</script>
