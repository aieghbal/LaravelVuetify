<!--
<template>
  <v-data-table
      :headers="headers"
      :items="users"
      :search="search"
      :loading="loading"
      :server-items-length="totalUsers"
      :items-per-page.sync="itemsPerPage"
      @update:page="getUsers"
      @update:items-per-page="getUsers"
      :footer-props="{
        itemsPerPageOptions: [5, 10, 15],
    }"
  >
    <template v-slot:no-data>
      No users found
    </template>
    <template v-slot:items="{ item }">
      <td>{{ item.id }}</td>
      <td>{{ item.name }}</td>
      <td>{{ item.email }}</td>
      <td>
        <v-btn text color="primary" @click="editUser(item)">
          Edit
        </v-btn>
        <v-btn text color="error" @click="deleteUser(item)">
          Delete
        </v-btn>
      </td>
    </template>
  </v-data-table>
</template>

<script>
import axios from 'axios';
import { VDataTable, VButton } from 'vuetify/lib';
export default {
  data() {
    return {
      headers: [
        { text: 'ID', value: 'id' },
        { text: 'Name', value: 'name' },
        { text: 'Email', value: 'email' }
      ],
      users: [],
      search: '',
      loading: false,
      totalUsers: 0,
      itemsPerPage: 10,
    };
  },
  created() {
    this.getUsers();
  },
  methods: {
    getUsers(page = 1) {
      this.loading = true;

      axios.post(`http://localhost:8000/api/users?page=${page}&perPage=${this.itemsPerPage}`)
          .then(response => {
            this.users = response.data;
            this.totalUsers = response.data.totalUsers;
            this.loading = false;
          })
          .catch(error => {
            console.log(error);
            this.loading = false;
          });
    },
    editUser(user) {

    },
    deleteUser(user) {
      // Implement your delete logic
    },
  },
};
</script>-->

<!--<template>
  <v-data-table
      :headers="headers"
      :items="items"
      :server-items-length="totalItems"
      :loading="loading"
      :loading-text="loadingText"
      :options.sync="options"
      :rows-per-page-items="[10, 20, 30]"
      :pagination.sync="pagination"
      :footer-props="{ itemsPerPageOptions: [10, 20, 30] }"
      item-key="id"
  >
    <template #top>
      <v-toolbar flat>
        <v-toolbar-title class="text-h5">لیست کاربران لاراول</v-toolbar-title>
        <v-spacer></v-spacer>
        <v-btn text @click="refreshData">به روز رسانی</v-btn>
      </v-toolbar>
    </template>

    <template #item.actions="{ item }">
      <v-container>
        <v-row>
          <v-col
              cols="12"
              sm="6"
          >
            <v-text-field
                v-model="name"
                :model-value=item.name
                clearable
                single-line
                persistent-clear
                variant="underlined"
                @click:clear="onClear"
            ></v-text-field>
          </v-col>
          <v-col
              cols="12"
              sm="6"
          >
            <v-btn small @click="handleAction(item)">عملیات</v-btn>
          </v-col>

        </v-row>
      </v-container>

    </template>
  </v-data-table>
</template>
<script>
import axios from 'axios';

export default {
  data() {
    return {
      headers: [
        { title: 'شناسه', value: 'id' },
        { title: 'نام', value: 'name' },
        { title: 'ایمیل', value: 'email' },
        { title: 'عملیات', value: 'actions', sortable: false },
      ],
      items: [],
      totalItems: 0,
      loading: false,
      loadingText: '',
      options: {},
      pagination: {},
      name : ''
    };
  },
  mounted() {
    this.loadData();
  },
  methods: {
    async loadData() {
      try {
        this.loading = true;
        this.loadingText = 'Loading...';
        const response = await axios.post('http://localhost:8000/api/users'); // Replace with your API endpoint
        this.totalItems = response.data.data.length;
        this.items = response.data.data;
        this.loading = false;
      } catch (error) {
        console.error('Error loading data:', error);
        this.loading = false;
      }
    },
    async refreshData() {
      this.pagination.page = 1;
      await this.loadData();
    },
    handleAction(item) {
      // Implement your action logic here
      console.log('Performing action on item:', item);
      console.log('Name:', this.name);
    },
  },
};
</script>-->

<template>
  <v-data-table-server
      v-model:items-per-page="itemsPerPage"
      :headers="headers"
      :items-length="totalItems"
      :items="serverItems"
      :loading="loading"
      :search="search"
      item-value="name"
      @update:options="loadItems"
  ></v-data-table-server>
</template>
<script>
import axios from 'axios';
const desserts = [
  {
    name: 'Frozen Yogurt',
    calories: 159,
    fat: 6.0,
    carbs: 24,
    protein: 4.0,
    iron: '1',
  },
  {
    name: 'Jelly bean',
    calories: 375,
    fat: 0.0,
    carbs: 94,
    protein: 0.0,
    iron: '0',
  },
  {
    name: 'KitKat',
    calories: 518,
    fat: 26.0,
    carbs: 65,
    protein: 7,
    iron: '6',
  },
  {
    name: 'Eclair',
    calories: 262,
    fat: 16.0,
    carbs: 23,
    protein: 6.0,
    iron: '7',
  },
  {
    name: 'Gingerbread',
    calories: 356,
    fat: 16.0,
    carbs: 49,
    protein: 3.9,
    iron: '16',
  },
  {
    name: 'Ice cream sandwich',
    calories: 237,
    fat: 9.0,
    carbs: 37,
    protein: 4.3,
    iron: '1',
  },
  {
    name: 'Lollipop',
    calories: 392,
    fat: 0.2,
    carbs: 98,
    protein: 0,
    iron: '2',
  },
  {
    name: 'Cupcake',
    calories: 305,
    fat: 3.7,
    carbs: 67,
    protein: 4.3,
    iron: '8',
  },
  {
    name: 'Honeycomb',
    calories: 408,
    fat: 3.2,
    carbs: 87,
    protein: 6.5,
    iron: '45',
  },
  {
    name: 'Donut',
    calories: 452,
    fat: 25.0,
    carbs: 51,
    protein: 4.9,
    iron: '22',
  },
]

const FakeAPI = {
  async fetch ({ page, itemsPerPage, sortBy }) {
    return new Promise(resolve => {
      setTimeout(() => {
        const start = (page - 1) * itemsPerPage
        const end = start + itemsPerPage
        const items = desserts.slice()

        const paginated = items.slice(start, end)



        resolve({ items: paginated, total: items.length })
      }, 500)
    })
  },
}

export default {
  data: () => ({
    itemsPerPage: 5,
    headers: [
      { title: 'Id', key: 'id', align: 'end' },
      { title: 'Name', key: 'name', align: 'end' },
      { title: 'Email', key: 'email', align: 'end' },
    ],
    search: '',
    serverItems: [],
    loading: true,
    totalItems: 0,
  }),
  methods: {
    loadItems ({ page, itemsPerPage, sortBy }) {
      this.loading = true
      const start = (page - 1) * itemsPerPage
      const end = start + itemsPerPage
      axios.post(`http://localhost:8000/api/users?page=${page}&perPage=${itemsPerPage}`)
          .then(response => {
            this.serverItems = response.data.data;
            this.totalItems = response.data.total;
            this.loading = false;
          })
          .catch(error => {
            console.log(error);
            this.loading = false;
          });
    },
  },
}
</script>