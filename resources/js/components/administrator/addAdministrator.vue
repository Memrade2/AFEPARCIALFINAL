<template>
  <div class="container col-sm-4 col-lg-4 col-md-4 col-xl-4">
    <div class="show-form">
      <h1>Agregar Administradosr</h1>

      <font-awesome-icon :icon="icon_name" @click.prevent="showAdd()"
        :class="[show ? 'active' : 'inactive', 'plus data-show-icon']" />
    </div>

    <form v-show="!show">
      <div class="form-group">
        <label>Nombre</label>
        <input class="form-control form-control-sm" type="text" v-model="administrator.administrator_name"
          v-on:keyup="validateTextNumber()" />
        <div class="danger" v-if="messageErrorAdministratorName">Verificar datos</div>
      </div>
      <div class="form-group">
        <label>DUI</label>
        <input class="form-control form-control-sm" type="text" v-model="administrator.dui" v-mask="'########-#'" />
        <div class="danger" v-if="messageErrorAdministratorDui">Verificar datos</div>
      </div>
      <div class="form-group">
        <label>Teléfono</label>
        <input class="form-control form-control-sm" type="text" v-model="administrator.phone" v-mask="'########'" />
        <div class="danger" v-if="messageErrorAdministratorPhone">Verificar datos</div>
      </div>

      <font-awesome-icon
        icon="plus-square"
        @click.prevent="addItem()"
        :class="[
          administrator.administrator_name &&
          administrator.dui &&
          administrator.phone 
            ? 'active'
            : 'inactive',
          'plus',
        ]"
      />
     
    </form>
    <a href="#" class="btn btn-info" @click="generateReport()"> Reporte General</a>
  </div>
</template>

<script>
export default {
  data: function () {
    return {
      administrator: {
        administrator_name: "",
        dui: "",
        phone: "",
      },
      show: false,
      icon_name: "arrow-down-short-wide",
      messageErrorAdministratorName: false,
      messageErrorAdministratorDui: false,
      messageErrorAdministratorPhone: false,
    };
  },
  methods: {
    addItem() {
      if (
        this.administrator.administrator_name == "" ||
        this.administrator.dui == "" ||
        this.administrator.phone == "" ||
        this.messageErrorAdministratorName ||
        this.messageErrorAdministratorDui ||
        this.messageErrorAdministratorPhone
      ) {
        swal("Alerta", "Los campos deben estar completos", "error");

        return;
      }
      axios
        .post("api/administrator/store", {
          administrator: this.administrator,
        })
        .then((response) => {
          if (response.status == 201) {
            
            swal("Guardado", "Registro guardado exitosamente", "success");
            this.administrator.administrator_name = "";
            (this.administrator.dui = ""),
            (this.administrator.phone = ""),
            (this.show = !this.show);
            this.$emit("reloadlist");
          }
        })
        .catch((error) => {
          console.log(error);
        });
    }, //addItem
    validateTextNumber() {
      if (this.administrator.administrator_name.search(/^[a-zA-Z0-9\s]*$/)) {
        this.messageErrorAdministratorName = true;
      } else {
        this.messageErrorAdministratorName = false;
      }
    },
    showAdd() {
      this.show = !this.show;
      if (this.show) {
        this.icon_name = "arrow-down-short-wide";
      } else {
        this.icon_name = "arrow-up-short-wide";
      }
      console.log(this.icon_name);
    },
    generateReport() {
      window.open("/generateRepAdmin");
    },
  },
  created() {
    this.showAdd();
  },
};
</script>

<style scoped>
.plus {
  font-size: 30px;
}

.active {
  color: #00ce25;
  cursor: pointer;
}

.inactive {
  color: #999999;
}

.danger {
  color: brown;
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