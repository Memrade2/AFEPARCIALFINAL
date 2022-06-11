<template>
  <div class="container">
    <table class="table table-hover">
      <thead>
        <th scope="col">Id</th>
        <th scope="col">Nombre</th>
        <th scope="col">Edad</th>
        <th scope="col">Sueldo Base</th>
        <th scope="col">Dirección</th>
        <th scope="col">Foto</th>
        <th scope="col">Administrador</th>
        <th scope="col">Sucursal</th>
        <th scope="col">Acciones</th>
      </thead>
      <tbody>
        <tr v-for="(employee, index) in employees" :key="index">
          <td>{{ employee.id }}</td>
          <td>{{ employee.employee_name }}</td>
          <td>{{ employee.age }}</td>
          <td>{{ employee.base_salary }}</td>
          <td>{{ employee.address }}</td>
          <td>{{ employee.photo }}</td>
          <td>{{ employee.administrator!=null ? employee.administrator.administrator_name : 'Administrador eliminado código ' + employee.administrator_id }}</td>
          <td>{{ employee.subsidiary!=null ? employee.subsidiary.subsidiary_name : 'Sucursal eliminado código ' + employee.subsidiary_id }}</td>
          <td>
            <button @click="removeItem(employee.id)" class="trashcan">
              <font-awesome-icon icon="trash" />
            </button>
            <button @click="editItem(employee)" class="pentosquarecan">
              <font-awesome-icon icon="pen-to-square" />
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>

export default {
  props: ["employees"],
  components: {
    
  },
  methods: {
    removeItem(id) {
      swal({
        title: "Eliminar",
        text: "¿Esta seguro de eliminar el registro?",
        icon: "error",
        //buttons: ["Cancelar","Continuar"]
        buttons: {
          cancel: "Cancelar",
          confirm: "Confirmar",
        },
        infoMode: true,
        closeOnClickOutside: false,
      }).then((willDelete) => {
        if (willDelete) {
          //delete action
          axios
            .delete("api/employee/" + id)
            .then((response) => {
              if (response.status == 200) {
                swal("Eliminado", "El registro ha sido eliminado", "success");
                this.$emit("reloadlist");
              }
            })
            .catch((error) => {
              swal("Error", "Error al eliminar el registro", "error");
            });
          //delete action
        }
      });
    },
    editItem(employee) {
      //console.log("edit item");
      this.$emit("reloadedit", employee);
      //this.edit = true;
    },
  },
};
</script>

<style scoped>
.trashcan {
  background: transparent;
  border: none;
  color: #ff0000;
  outline: none;
}
.pentosquarecan {
  background: transparent;
  border: none;
  color: darkcyan;
  outline: none;
}
.listcheck{
  background: transparent;
  border: none;
  color: dodgerblue;
  outline: none;
}
.success {
  background-color: #aadbc7;
}
.info {
  background-color: #92d0eb;
}
.dangerstatus {
  background-color: #eea1a2;
}
</style>