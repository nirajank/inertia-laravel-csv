<template>
    <div v-if="isOpen" class="modal fade" id="editClientModal" tabindex="-1" aria-labelledby="editClientModalLabel" aria-hidden="true">
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
    </div>
  </template>
  
  <script>
  export default {
    props: {
      client: Object, // Receive client data from parent component (Clients/Index.vue)
      isOpen: Boolean, // Receive isOpen flag to control modal visibility
    },
    methods: {
      close() {
        // Emit an event to signal closing the modal
        this.$emit('close');
      },
      submit() {
        // Handle form submission logic here, potentially using Inertia.put
        // You might want to display a success message or redirect after successful update
        console.log('Submitted edited client data:', this.client);
        // Implement your update logic using Inertia.put or a similar method here
      },
    },
  };
  </script>
  
  <
  