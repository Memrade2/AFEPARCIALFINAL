<template>
  <div class="container">
    <table class="table table-hover">
      <thead>
        <th scope="col">Nombre</th>
        <th scope="col">Descripcion</th>
        <th scope="col">Precio Unitario</th>
        <th scope="col">Existencias</th>
        <th scope="col">Garantias</th>
        <th scope="col">Vendedor</th>
        <th scope="col">Acciones</th>
      </thead>
      <tbody>
        <tr v-for="(product, index) in products" :key="index">
          <td>{{ product.product_name }}</td>
          <td>{{ product.description }}</td>
          <td>{{ product.unitary_price }}</td>
          <td>{{ product.stocks }}</td>
          <td>{{ product.garanty }}</td>
          <td>{{ product.seller!=null ? product.seller.seller_name : 'Vendedor eliminado código ' + product.seller_id }}</td>
          <td>
            <button @click="removeItem(product.id)" class="trashcan">
              <font-awesome-icon icon="trash" />
            </button>
            <button @click="editItem(product)" class="pentosquarecan">
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
  props: ["products"],
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
            .delete("api/product/" + id)
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
    editItem(product) {
      //console.log("edit item");
      this.$emit("reloadedit", product);
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