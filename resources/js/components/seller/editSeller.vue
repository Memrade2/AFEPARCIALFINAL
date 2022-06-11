<template>
  <div class="container col-sm-4 col-lg-4 col-md-4 col-xl-4">
    <div class="show-form">
      <h1>Editar Accesorios</h1>
      <font-awesome-icon :icon="icon_name" @click.prevent="showEdit()"
        :class="[show ? 'active' : 'inactive', 'plus data-show-icon']" />
    </div>

    <form v-show="!show">
      <div class="form-group">
        <label>Dui</label>
        <input class="form-control form-control-sm" type="text" v-model="seller.dui" v-mask="'########-#'" />
        <div class="danger" v-if="messageErrorSellerDui">Verificar datos</div>
      </div>
      <div class="form-group">
        <label>Direccion</label>
        <input class="form-control form-control-sm" type="text" v-model="seller.address"
          v-on:keyup="validateTextNumber()" />
        <div class="danger" v-if="messageErrorSellerAddress">Verificar datos</div>
      </div>
      <div class="form-group">
        <label>Nit</label>
        <input class="form-control form-control-sm" type="text" v-model="seller.nit" v-mask="'####-######-###-#'" />
        <div class="danger" v-if="messageErrorSellerNit">Verificar datos</div>
      </div>
      <div class="form-group">
        <label>Usuario</label>

        <select v-model="seller.user_id" class="form-control form-control-sm"
          v-on:change="validateSelectUser()">
          <option value="0" selected>Seleccione</option>
          <option v-for="user in users" v-bind:key="user.id" :value="user.id">
            {{ user.name }}
          </option>
        </select>
        <div class="danger" v-if="messageErrorUser">Verificar datos</div>
      </div>
      <font-awesome-icon icon="fa-file-pen" @click.prevent="editItem()" :class="[
        seller.dui &&
          seller.address &&
          seller.nit &&
          seller.user_id
          ? 'active'
          : 'inactive',
        'plus',
      ]" />
      <font-awesome-icon icon="circle-left" @click="cancel()" class="danger" />
    </form>
  </div>
</template>

<script>
export default {
  props: ['seller'],
  data: function () {
    return {
      users: [],
      show: true,
      icon_name: "arrow-down-short-wide",
      messageErrorSellerDui: false,
      messageErrorSellerAddress: false,
      messageErrorSellerNit: false,
      messageErrorUser: false,
    };
  },
  methods: {
    editItem() {
      if (
        this.seller.dui == "" ||
        this.seller.address == "" ||
        this.seller.nit == "" ||
        this.seller.user_id == 0 ||
        this.messageErrorSellerDui ||
        this.messageErrorSellerAddress  ||
        this.messageErrorSellerNit  ||
        this.messageErrorUser
      ) {
        swal("Alerta", "Los campos deben estar completos", "error");

        return;
      }

      swal({
        title: "Modificar",
        text: "¿Esta seguro de modificar el registro?",
        icon: "warning",
        //buttons: ["Cancelar","Continuar"]
        buttons: {
          cancel: "Cancelar",
          confirm: "Confirmar",
        },
        infoMode: true,
        closeOnClickOutside: false,
      }).then((willUpdate) => {
        if (willUpdate) {
          //delete action

          axios
            .put("api/seller/" + this.seller.id, {
              seller: this.seller,
            })
            .then((response) => {
              if (response.status == 200) {
                swal("Update", "El registro ha sido actualizado", "success");
                this.$emit("reloadlist");
                this.$emit("reloadedit", false);
              }
            })
            .catch((error) => {
              console.log(error);
            });
          //delete action
        }
      });

    }, //editItem
    getUsers() {
      axios
        .get("api/user/list")
        .then((response) => {
          this.users = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    validateTextNumber() {
      if (this.seller.address.search(/^[a-zA-Z0-9\s]*$/)) {
        this.messageErrorSellerAddress = true;
      } else {
        this.messageErrorSellerAddress = false;
      }
    },
    validateSelectUser() {
      console.log(this.seller.user_id);
      if (this.seller.user_id == 0) {
        this.messageErrorUser = true;
      } else {
        this.messageErrorUser = false;
      }
    },
    showEdit() {
      this.show = !this.show;
      if (this.show) {
        this.icon_name = "arrow-down-short-wide";
      } else {
        this.icon_name = "arrow-up-short-wide";
      }
      //console.log(this.icon_name);
    },
    cancel() {
      this.$emit("reloadlist");
      this.$emit("reloadedit", false);
    },//cancel
  },
  created() {
    this.getUsers();
    this.showEdit();
  },
};
</script>

<style scoped>
.plus {
  font-size: 30px;
}

.active {
  color: dodgerblue;
  cursor: pointer;
}

.inactive {
  color: #999999;
}

.danger {
  font-size: 30px;
  color: firebrick;
}

.show-form {
  display: flex;
}

.show-form .h1 {
  margin-right: 5px;
  padding-right: 5px;
}

.show-form .data-show-icon {
  margin-left: 5px;
  padding-left: 5px;
}
</style>