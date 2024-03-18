<template>
  <div class="container">
    <h1 class="mb-4">Clients</h1>
    <button class="btn btn-sm btn-primary" style="float:right" @click="createClient()" data-toggle="modal"
      data-target="#exampleModal">Create</button><br/>
    

    <div class="row mb-3">
      <div class="col-md-6">
        <!-- <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Search clients..." v-model="searchQuery">
          <button class="input-group-text" type="button">
            <i class="bi bi-search"></i> </button>
        </div> -->
      </div>
    </div>
    <!-- <div class="row mb-4">
      <div class="col-md-6">
        <div class="d-flex align-items-center">
          <select class="form-select" v-model="filterByStatus">
            <option value="">All Statuses</option>
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
          </select>
        </div>
      </div>
    </div> -->

    <table class="table table-striped">
      <thead>
        <tr>
          <th>#</th>
          <th>Name</th>
          <th>Email</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(client, k) in clients.data" :key="client.id">
          <td>{{ client.id }}</td>
          <td>{{ client.name }}</td>
          <td>{{ client.email }}</td>
          <td>
            <button class="btn btn-sm btn-primary" @click="editClient(client)" style="margin-right:12px;"
              data-toggle="modal" data-target="#exampleModal">Edit</button>
            <button class="btn btn-sm btn-danger" @click="deleteClient( client.id)">Delete</button>
          </td>
        </tr>
      </tbody>
    </table>
    <Modal v-if="isEditModalOpen" :client="selectedClient" @close="handleModalClose" :intend="intend" />

  </div>
</template>

<script>
import { Link, useForm } from '@inertiajs/inertia-vue3';
import Modal from './Modal.vue';

export default {
  props: {
    clients: Object,
    message: String,
  },
  data() {
    return {
      searchQuery: '',
      filterByStatus: '',
      isEditModalOpen: false,
      selectedClient: null,
      intend: 'create'
      // ... other data properties
    };
  },
  computed: {
    filteredClients() {
      // Implement filtering logic based on searchQuery and filterByStatus
    },
  },
  methods: {
    editClient(client) {
      this.intend = 'Edit';
      this.isEditModalOpen = true;
      this.selectedClient = client;

    },
    createClient() {
      this.intend = 'Create';
      this.isEditModalOpen = true;
      this.selectedClient = {
        name: '',
        email: '',
        id:''
      };

    },
    deleteClient(id) {
         useForm().delete(`clients/${id}`);    
      },

    handleModalClose() {
      this.isEditModalOpen = false;
      this.selectedClient = null; // Clear selected client after closing modal
    },
  },
  components: {
    Modal,
    Link,
  },
};
</script>
