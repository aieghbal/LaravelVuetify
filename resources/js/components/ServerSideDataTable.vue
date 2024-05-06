<template>
  <v-data-table-server
      v-model:items-per-page="itemsPerPage"
      :headers="headers"
      :items-length="totalItems"
      :items="serverItems"
      :loading="loading"
      :search="search"
      item-value="name"
      :items-per-page-text= '$t("items-per-page-text")'
      @update:options="loadItems"
  >
      <template #top>
          <v-toolbar
              flat
          >
              <v-toolbar-title>لیست کابران لاراول</v-toolbar-title>
              <v-divider
                  class="mx-4"
                  inset
                  vertical
              ></v-divider>
              <v-dialog
                  v-model="dialog"
                  :width="this.width"
                  :height="this.height"
                  :class="{ minimizeClass: minimize, resizeClass:resize }"
              >
                  <template v-slot:activator="{ props }">
                      <v-row>
                          <v-col cols="12" sm="8" md="8">
                              <v-text-field v-model="name" hide-details placeholder="جستجوی نام..." density="compact"></v-text-field>
                          </v-col>
                          <v-col cols="12" sm="2" md="2">
                              <v-btn
                                  color="primary"
                                  dark
                                  class="mb-2"
                                  v-bind="props"
                              >
                                  {{ $t("new") }}
                              </v-btn>
                          </v-col>
                          <v-col cols="12" sm="2" md="2">
                              <v-btn text @click="refreshData">به روز رسانی</v-btn>
                          </v-col>
                      </v-row>



                  </template>
                  <div ref="draggableContainer" id="draggable-container">
                      <div id="draggable-header" @mousedown="dragMouseDown">
                          <v-card>
                              <v-card-title>
                                  <v-icon color="red" @click="this.dialog = false" size="large">mdi-close</v-icon>
                                  <v-icon size="25" @click="resizeWindow">mdi-checkbox-blank-outline</v-icon>



                                  <v-icon size="25"
                                          @click="minimizeWindow"
                                          :class="{ maximizeClass: maximize }"
                                  >mdi-minus
                                  </v-icon>
                                  <v-icon
                                      @click="minimizeWindow"
                                      :class="{ minimizeClass: minimize }"
                                      style="display: none"
                                  >
                                      mdi-chevron-up
                                  </v-icon>
                              </v-card-title>
                              <v-card-text>
                                  <v-container>
                                      <v-row>
                                          <v-col
                                              cols="12"
                                              sm="12"
                                              md="12"
                                          >
                                              <v-text-field
                                                  v-model="editedItem.name"
                                                  label='نام'
                                              ></v-text-field>
                                          </v-col>
                                          <v-col
                                              cols="12"
                                              sm="12"
                                              md="12"
                                          >
                                              <v-text-field
                                                  v-model="editedItem.email"
                                                  label='ایمیل'
                                              ></v-text-field>
                                          </v-col>
                                      </v-row>
                                  </v-container>
                              </v-card-text>

                              <v-card-actions>
                                  <v-spacer></v-spacer>
                                  <v-btn
                                      color="blue-darken-1"
                                      variant="text"
                                      @click="close"
                                  >
                                      {{ $t("cancel") }}
                                  </v-btn>
                                  <v-btn
                                      color="blue-darken-1"
                                      variant="text"
                                      @click="save"
                                  >
                                      {{ $t("save") }}
                                  </v-btn>
                              </v-card-actions>
                          </v-card>
                      </div>
                  </div>

              </v-dialog>
              <v-dialog v-model="dialogDelete" max-width="500px">
                  <v-card>
                      <v-card-title class="text-h5">{{ $t("sure") }}</v-card-title>
                      <v-card-actions>
                          <v-spacer></v-spacer>
                          <v-btn color="blue-darken-1" variant="text" @click="closeDelete">خیر</v-btn>
                          <v-btn color="blue-darken-1" variant="text" @click="deleteItemConfirm">بله</v-btn>
                          <v-spacer></v-spacer>
                      </v-card-actions>
                  </v-card>
              </v-dialog>
          </v-toolbar>
      </template>

      <template v-slot:item.nameText="{ item }">
          <v-text-field
              v-model="item.name"
              :name= name[item.id]
              label='نام'
          ></v-text-field>
      </template>
      <template v-slot:item.actions="{ item }">

          <v-icon
              size="small"
              class="me-2"
              @click="editItem(item)"
          >
              mdi-pencil
          </v-icon>
          <v-icon
              size="small"
              @click="deleteItem(item)"
          >
              mdi-delete
          </v-icon>
      </template>
  </v-data-table-server>
</template>
<script>
import axios from 'axios';
export default {
  data: () => ({
      positions: {
          clientX: undefined,
          clientY: undefined,
          movementX: 0,
          movementY: 0
      },
      width: 1024,
      height: 800,
      resize: false,
      minimize : false,
      maximize : false,
    itemsPerPage: 10,
    headers: [
      { title: 'شناسه', key: 'id', align: 'end' },
      { title: 'نام', key: 'name', align: 'end' },
      { title: 'ورودی نام', key: 'nameText', align: 'end' },
      { title: 'ایمیل', key: 'email', align: 'end' },
      { title: 'عملیات', value: 'actions', sortable: false, align: 'end' },
    ],
    dialog: false,
    dialogDelete: false,
    search: '',
    serverItems: [],
    loading: true,
    name : '',
    totalItems: 0,
      editedIndex: -1,
      editedItem: {
          name: '',
          email: '',
      },
      defaultItem: {
          name: '',
          email: '',
      },
  }),
    watch: {
        name () {
            this.search = String(Date.now())
        },
        dialog (val) {
            val || this.close()
        },
        dialogDelete (val) {
            val || this.closeDelete()
        },
    },
  methods: {
      resizeWindow(){
          switch (this.resize){
              case false:
                  this.resize = true;
                  break;
              case true:
                  this.resize = false;
                  break;
          }
      },
      minimizeWindow(){
          switch (this.minimize){
              case false:
                  this.minimize = true;
                  this.maximize = true;
                  break;
              case true:
                  this.minimize = false;
                  this.maximize = false;
                  break;
          }
      },
    loadItems ({ page = null, itemsPerPage = null }) {
      this.loading = true
      const start = (page - 1) * itemsPerPage
      const end = start + itemsPerPage
      axios.post(`http://localhost:8000/api/users?page=${page}&perPage=${itemsPerPage}&search=${this.name}`)
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
      async refreshData() {
          axios.post(`http://localhost:8000/api/users`).then(response => {
              this.serverItems = response.data.data;
              this.totalItems = response.data.total;
              this.loading = false;
          });
      },
      editItem (item) {
          this.editedItem = Object.assign({},item)
          this.dialog = true
      },

      deleteItem (item) {
          this.editedItem = Object.assign({},item)
          this.dialogDelete = true
      },

      deleteItemConfirm () {
          const data = {
              id: this.editedItem.id
          };
          axios.post(`http://localhost:8000/api/users/delete`,data)
              .then(response => {
                  this.closeDelete();
                  this.refreshData();
              })
              .catch(error => {
                  console.log(error);
              });
      },

      close () {
          this.dialog = false
          this.$nextTick(() => {
              this.editedItem = Object.assign({}, this.defaultItem)
              this.editedIndex = -1
          })
      },

      closeDelete () {
          this.dialogDelete = false
          this.$nextTick(() => {
              this.editedItem = Object.assign({}, this.defaultItem)
              this.editedIndex = -1
          })
      },

      save () {
          const data = {
              id: this.editedItem.id,
              name: this.editedItem.name,
              email: this.editedItem.email
          };
          //Edit item
          if (data.id){
              axios.post(`http://localhost:8000/api/users/edit`,data)
                  .then(response => {
                      this.close();
                      this.refreshData();
                  })
                  .catch(error => {
                      console.log(error);
                  });
          }
          else{ //add item
              axios.post(`http://localhost:8000/api/users/add`,data)
                  .then(response => {
                      this.close();
                      this.refreshData();
                  })
                  .catch(error => {
                      console.log(error);
                  });
          }

      },
      dragMouseDown: function (event) {
          event.preventDefault()
          // get the mouse cursor position at startup:
          this.positions.clientX = event.clientX
          this.positions.clientY = event.clientY
          document.onmousemove = this.elementDrag
          document.onmouseup = this.closeDragElement
      },
      elementDrag: function (event) {
          event.preventDefault()
          this.positions.movementX = this.positions.clientX - event.clientX
          this.positions.movementY = this.positions.clientY - event.clientY
          this.positions.clientX = event.clientX
          this.positions.clientY = event.clientY
          // set the element's new position:
          this.$refs.draggableContainer.style.top = (this.$refs.draggableContainer.offsetTop - this.positions.movementY) + 'px'
          this.$refs.draggableContainer.style.left = (this.$refs.draggableContainer.offsetLeft - this.positions.movementX) + 'px'
      },
      closeDragElement () {
          document.onmouseup = null
          document.onmousemove = null
      }
  },
}
</script>
<style>
.resizeClass .v-overlay__content,.resizeClass .v-overlay__content .v-card{
    width: 100%!important;
    height: 100%!important;
}
.minimizeClass{display: inline-block!important;}
.maximizeClass{display: none!important;}
.minimizeClass .v-overlay__content{
    width: 300px!important;
    height: 60px!important;
    position: absolute;
    bottom: 0;
    left: 0;
}
#draggable-container {
    position: absolute;
    z-index: 9;
    width: 100%;
    height: 100%;
}
#draggable-header {
    z-index: 10;
    width: 100%;
    height: 100%;
}
.v-card-actions{
    position: absolute;
    bottom: 3%;
    left: 3%;
}
</style>
