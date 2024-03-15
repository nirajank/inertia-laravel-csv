<template>
    <div>
      <h1>Clients</h1>
      <ul>
        <li v-for="client in clients" :key="client.id">
          <a :href="route('clients.show', client.id)">{{ client.name }}</a> ({{ client.email }})
          <button @click="editClient(client)">Edit</button>
          <button @click="$delete('clients', client.id)">Delete</button>
        </li>
      </ul>
      <ClientsEditModal v-if="isEditModalOpen" :client="selectedClient" @close="handleModalClose" />
    </div>
  </template>
  
  <script>
  import { Inertia } from '@inertiajs/inertia-vue3';
  import ClientsEditModal from './Clients/EditModal.vue';
  
  export default {
    props: {
      clients: Array, // Receive clients data from the server
    },
    data() {
      return {
        isEditModalOpen: false,
        selectedClient: null,
      };
    },
    methods: {
      editClient(client) {
        this.isEditModalOpen = true;
        this.selectedClient = client;
      },
      handleModalClose() {
        this.isEditModalOpen = false;
        this.selectedClient = null; // Clear selected client after closing modal
      },
    },
    components: {
      ClientsEditModal,
    },
  };
  </script>
  
  <style scoped>
  /* Add Bootstrap modal styling if needed */
  </style>
  