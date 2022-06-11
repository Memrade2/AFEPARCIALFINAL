<template>
  <div class="container col-sm-4 col-lg-4 col-md-4 col-xl-4">
    <div class="show-form">
      <h1>Editar Producto</h1>
      <font-awesome-icon :icon="icon_name" @click.prevent="showEdit()"
        :class="[show ? 'active' : 'inactive', 'plus data-show-icon']" />
    </div>

    <form v-show="!show">
      <div class="form-group">
        <label>Nombre</label>
        <input class="form-control form-control-sm" type="text" v-model="product.product_name"
          v-on:keyup="validateTextNumber()" />
        <div class="danger" v-if="messageErrorProductName">Verificar datos</div>
      </div>
      <div class="form-group">
        <label>Descripcion</label>
        <input class="form-control form-control-sm" type="text" v-model="product.description" 
        v-on:keyup="validateDescription()" />
        <div class="danger" v-if="messageErrorProductDescription">Verificar datos</div>
      </div>
      <div class="form-group">
        <label>Precio Unitario</label>
        <input class="form-control form-control-sm" type="text" v-model="product.unitary_price" v-mask="'##.##'" />
        <div class="danger" v-if="messageErrorProductUnitaryPrice">Verificar datos</div>
      </div>
      <div class="form-group">
        <label>Existencias</label>
        <input class="form-control form-control-sm" type="number" v-model="product.stocks" />
        <div class="danger" v-if="messageErrorProductStocks">Verificar datos</div>
      </div>
      <div class="form-group">
        <label>Garanias</label>
        <input class="form-control form-control-sm" type="text" v-model="product.garanty"
          v-on:keyup="validateGaranty()" />
        <div class="danger" v-if="messageErrorProductGaranty">Verificar datos</div>
      </div>
      <div class="form-group">
        <label>Usuario</label>

        <select v-model="product.seller_id" class="form-control form-control-sm"
          v-on:change="validateSelectSeller()">
          <option value="0" selected>Seleccione</option>
          <option v-for="seller in sellers" v-bind:key="seller.id" :value="seller.id">
            {{ seller.dui }}
          </option>
        </select>
        <div class="danger" v-if="messageErrorSeller">Verificar datos</div>
      </div>
      <font-awesome-icon icon="fa-file-pen" @click.prevent="editItem()" :class="[
        product.product_name &&
          product.description &&
          product.unitary_price &&
          product.stocks &&
          product.garanty &&
          product.seller_id
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
  props: ['product'],
  data: function () {
    return {
      sellers: [],
      show: true,
      icon_name: "arrow-down-short-wide",
      messageErrorProductName: false,
      messageErrorProductDescription: false,
      messageErrorProductUnitaryPrice: false,
      messageErrorProductStocks: false,
      messageErrorProductGaranty: false,
      messageErrorSeller: false,
    };
  },
  methods: {
    editItem() {
      if (
        this.product.product_name == "" ||
        this.product.description == "" ||
        this.product.unitary_price == 0.0 ||
        this.product.stocks == 0 ||
        this.product.garanty == "" ||
        this.product.seller_id == 0 ||
        this.messageErrorProductName ||
        this.messageErrorProductDescription  ||
        this.messageErrorProductUnitaryPrice  ||
        this.messageErrorProductStocks  ||
        this.messageErrorProductGaranty  ||
        this.messageErrorSeller
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
            .put("api/product/" + this.product.id, {
              product: this.product,
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
    getSellers() {
      axios
        .get("api/seller/list")
        .then((response) => {
          this.sellers = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    validateTextNumber() {
      if (this.product.product_name.search(/^[a-zA-Z0-9\s]*$/)) {
        this.messageErrorProductName = true;
      } else {
        this.messageErrorProductName = false;
      }
    },
    validateGaranty() {
      if (this.product.garanty.search(/^[a-zA-Z0-9\s]*$/)) {
        this.messageErrorProductGaranty = true;
      } else {
        this.messageErrorProductGaranty = false;
      }
    },
    validateDescription() {
      if (this.product.garanty.search(/^[a-zA-Z0-9\s]*$/)) {
        this.messageErrorProductGaranty = true;
      } else {
        this.messageErrorProductGaranty = false;
      }
    },
    validateSelectSeller() {
      console.log(this.product.seller_id);
      if (this.product.seller_id == 0) {
        this.messageErrorSeller = true;
      } else {
        this.messageErrorSeller = false;
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
    this.getSellers();
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