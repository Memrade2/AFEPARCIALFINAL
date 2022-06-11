<template>
  <div class="container col-sm-4 col-lg-4 col-md-4 col-xl-4">
    <div class="show-form">
      <h1>Editar Empleado</h1>
      <font-awesome-icon :icon="icon_name" @click.prevent="showEdit()"
        :class="[show ? 'active' : 'inactive', 'plus data-show-icon']" />
    </div>

    <form v-show="!show">
      <div class="form-group">
        <label>Nombre</label>
        <input class="form-control form-control-sm" type="text" v-model="employee.employee_name"
          v-on:keyup="validateTextNumber()" />
        <div class="danger" v-if="messageErrorEmployeeName">Verificar datos</div>
      </div>
      <div class="form-group">
        <label>Edad</label>
        <input class="form-control form-control-sm" type="text" v-model="employee.age" v-mask="'##'" />
        <div class="danger" v-if="messageErrorEmployeeAge">Verificar datos</div>
      </div>
      <div class="form-group">
        <label>Sueldo Base</label>
        <input class="form-control form-control-sm" type="number" v-model="employee.base_salary" />
        <div class="danger" v-if="messageErrorEmployeeBaseSalary">Verificar datos</div>
      </div>
      <div class="form-group">
        <label>Direccion</label>
        <input class="form-control form-control-sm" type="text" v-model="employee.address"
          v-on:keyup="validateAddress()" />
        <div class="danger" v-if="messageErrorEmployeeAddress">Verificar datos</div>
      </div>
      <div class="form-group">
        <label>Foto</label>
        <input class="form-control form-control-sm" type="text" v-model="employee.photo" />
        <div class="danger" v-if="messageErrorEmployeePhoto">Verificar datos</div>
      </div>
      <div class="form-group">
        <label>Administrador</label>

        <select v-model="employee.administrator_id" class="form-control form-control-sm"
          v-on:change="validateSelectAdministrator()">
          <option value="0" selected>Seleccione</option>
          <option v-for="administrator in administrators" v-bind:key="administrator.id" :value="administrator.id">
            {{ administrator.administrator_name }}
          </option>
        </select>
        <div class="danger" v-if="messageErrorAdministrator">Verificar datos</div>
      </div>
      <div class="form-group">
        <label>Sucursal</label>

        <select v-model="employee.subsidiary_id" class="form-control form-control-sm"
          v-on:change="validateSelectSucursal()">
          <option value="0" selected>Seleccione</option>
          <option v-for="subsidiary in subsidiaries" v-bind:key="subsidiary.id" :value="subsidiary.id">
            {{ subsidiary.subsidiary_name }}
          </option>
        </select>
        <div class="danger" v-if="messageErrorSucursal">Verificar datos</div>
      </div>
      <font-awesome-icon icon="fa-file-pen" @click.prevent="editItem()" :class="[
        employee.employee_name &&
          employee.age &&
          employee.base_salary &&
          employee.address &&
          employee.photo &&
          employee.administrator_id &&
          employee.subsidiary_id
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
  props: ['employee'],
  data: function () {
    return {
      administrators: [],
      subsidiaries: [],
      show: true,
      icon_name: "arrow-down-short-wide",
      messageErrorEmployeeName: false,
      messageErrorEmployeeAge: false,
      messageErrorEmployeeBaseSalary: false,
      messageErrorEmployeeAddress: false,
      messageErrorEmployeePhoto: false,
      messageErrorAdministrator: false,
      messageErrorSucursal: false,
    };
  },
  methods: {
    editItem() {
      if (
        this.employee.employee_name == "" ||
        this.employee.age == 0 ||
        this.employee.base_salary == 0.0 ||
        this.employee.address == "" ||
        this.employee.photo == "" ||
        this.employee.administrator_id == 0 ||
        this.employee.subsidiary_id == 0 ||
        this.messageErrorEmployeeName ||
        this.messageErrorEmployeeAge ||
        this.messageErrorEmployeeBaseSalary ||
        this.messageErrorEmployeeAddress ||
        this.messageErrorEmployeePhoto ||
        this.messageErrorAdministrator ||
        this.messageErrorSucursal
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
            .put("api/employee/" + this.employee.id, {
              employee: this.employee,
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
    getAdministrators() {
      axios
        .get("api/administrator/list")
        .then((response) => {
          this.administrators = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    getSubsidiaries() {
      axios
        .get("api/subsidiary/list")
        .then((response) => {
          this.subsidiaries = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    validateTextNumber() {
      if (this.employee.employee_name.search(/^[a-zA-Z0-9\s]*$/)) {
        this.messageErrorEmployeeName = true;
      } else {
        this.messageErrorEmployeeName = false;
      }
    },
    validateAddress() {
      if (this.employee.address.search(/^[a-zA-Z0-9\s]*$/)) {
        this.messageErrorEmployeeAddress = true;
      } else {
        this.messageErrorEmployeeAddress = false;
      }
    },
    validateSelectAdministrator() {
      console.log(this.employee.administrator_id);
      if (this.employee.administrator_id == 0) {
        this.messageErrorAdministrator = true;
      } else {
        this.messageErrorAdministrator = false;
      }
    },
    validateSelectSucursal() {
      console.log(this.employee.subsidiary_id);
      if (this.employee.subsidiary_id == 0) {
        this.messageErrorSucursal = true;
      } else {
        this.messageErrorSucursal = false;
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
    this.getAdministrators();
    this.getSubsidiaries();
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