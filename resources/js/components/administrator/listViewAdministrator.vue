<template>
  <div class="container">
    <table class="table table-hover">
      <thead>
        <th scope="col">Id</th>
        <th scope="col">Nombre</th>
        <th scope="col">Dui</th>
        <th scope="col">Telefono</th>
      </thead>
      <tbody>
        <tr v-for="(administrator, index) in administrators" :key="index">
          <td>{{ administrator.id }}</td>
          <td>{{ administrator.administrator_name }}</td>
          <td>{{ administrator.dui }}</td>
          <td>{{ administrator.phone }}</td>
          <td>
            <button @click="removeItem(administrator.id)" class="trashcan">
              <font-awesome-icon icon="trash" />
            </button>  
            
            <a href="#" class="btn btn-info" @click="generateReport(administrator.id)">
              <i class="fa fa-doc"></i> Reporte</a
            >
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>

export default {
  props: ["administrators"],
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
            .delete("api/administrator/" + id)
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
    generateReport(id) {
      window.open("/generateRepByAdmin/" + id);
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