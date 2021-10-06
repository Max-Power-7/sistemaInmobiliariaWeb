<template>
  <main class="main">
    <!-- Breadcrumb -->
    <div class="container-fluid">
      <!-- Ejemplo de tabla Listado -->
      <div class="card">
        <div class="card-header">
          <i class="fa fa-align-justify"></i> Usuario
          <button
            type="button"
            @click="abrirModal('usuario', 'registrar')"
            class="btn btn-secondary"
          >
            <i class="icon-plus"></i>&nbsp;Nuevo
          </button>
        </div>
        <div class="card-body">
          <div class="form-group row">
            <div class="col-md-6">
              <div class="input-group">
                <select class="form-control col-md-3" v-model="criterio">
                  <option value="login">Usuario</option>
                  <option value="tipo">Tipo</option>
                </select>
                <input
                  type="text"
                  v-model="buscar"
                  @keyup.enter="listarUsuario(1, buscar, criterio)"
                  class="form-control"
                  placeholder="Texto a buscar"
                />
                <button
                  type="submit"
                  @click="listarUsuario(1, buscar, criterio)"
                  class="btn btn-primary"
                >
                  <i class="fa fa-search"></i> Buscar
                </button>
              </div>
            </div>
          </div>
          <table class="table table-bordered table-sm">
            <thead>
              <tr>
                <th>Usuario</th>
                <th>Password</th>
                <th>Tipo</th>
                <!-- <th>Nombre</th>
                <th>Apellidos</th> -->
                <th>Estado</th>
                <th>Opciones</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="usuario in arrayUsuario" :key="usuario.id">
                <td v-text="usuario.login"></td>
                <!-- <td v-text="usuario.password"></td> -->
                <td v-text="usuario.tipo"></td>
                <!-- <td v-text="usuario.nombre"></td>
                <td v-text="usuario.apellidos"></td> -->
                <td>
                  <div v-if="usuario.estado == '1'">
                    <span class="badge badge-success">Activo</span>
                  </div>
                  <div v-else>
                    <span class="badge badge-danger">Desactivo</span>
                  </div>
                </td>
                <td>
                  <div class="dropdown">
                    <button
                      class="
                        btn btn-outline-dark
                        dropdown-toggle dropdown-toggle-split
                      "
                      type="button"
                      id="dropdownMenuButton"
                      data-toggle="dropdown"
                      aria-haspopup="true"
                      aria-expanded="false"
                    >
                      Accion
                    </button>
                    <div
                      class="dropdown-menu"
                      aria-labelledby="dropdownMenuButton"
                    >
                      <template v-if="usuario.estado == '1'">
                        <a
                          class="dropdown-item bg-light"
                          href="#"
                          @click="abrirModal('usuario', 'modificar', usuario)"
                          ><i class="icon-pencil text-warning"></i>Modificar</a
                        >
                        <a
                          class="dropdown-item bg-light"
                          href="#"
                          @click="desactivarUsuario(usuario.id)"
                          ><i class="fa fa-toggle-on text-success"></i
                          >Desactivar</a
                        >
                      </template>
                      <template v-else>
                        <a
                          class="dropdown-item bg-light"
                          href="#"
                          @click="activarUsuario(usuario.id)"
                          ><i class="fa fa-toggle-off text-danger"></i
                          >Activar</a
                        >
                      </template>
                    </div>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
          <nav>
            <ul class="pagination">
              <li class="page-item" v-if="pagination.current_page > 1">
                <a
                  class="page-link"
                  href="#"
                  @click.prevent="
                    cambiarPagina(pagination.current_page - 1, buscar, criterio)
                  "
                  >Ant</a
                >
              </li>
              <li
                class="page-item"
                v-for="page in pagesNumber"
                :key="page"
                :class="[page == isActived ? 'active' : '']"
              >
                <a
                  class="page-link"
                  href="#"
                  @click.prevent="cambiarPagina(page, buscar, criterio)"
                  v-text="page"
                  >1</a
                >
              </li>
              <li
                class="page-item"
                v-if="pagination.current_page < pagination.last_page"
              >
                <a
                  class="page-link"
                  href="#"
                  @click.prevent="
                    cambiarPagina(pagination.current_page + 1, buscar, criterio)
                  "
                  >Sig</a
                >
              </li>
            </ul>
          </nav>
        </div>
      </div>
      <!-- Fin ejemplo de tabla Listado -->
    </div>

    <!--Inicio del modal agregar/actualizar-->
    <div
      class="modal fade"
      id="modalNuevo"
      tabindex="-1"
      :class="{ mostrar: modal }"
      role="dialog"
      aria-labelledby="myModalLabel"
      style="display: none"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-primary modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" v-text="tituloModal"></h4>
            <button
              type="button"
              class="close"
              @click="cerrarModal()"
              aria-label="Close"
            >
              <span aria-hidden="true">×</span>
            </button>
          </div>

          <div class="modal-body">
            <form
              action=""
              method="post"
              enctype="multipart/form-data"
              class="form-horizontal"
            >
              <div class="form-group row">
                <label class="col-md-3 form-control-label" for="text-input"
                  >Usuario</label
                >
                <div class="col-md-9">
                  <input
                    type="text"
                    v-model="login"
                    class="form-control"
                    placeholder="Ingrese un nombre de Usuario"
                  />
                </div>
              </div>
              <div class="form-group row">
                <label class="col-md-3 form-control-label" for="text-input"
                  >Password</label
                >
                <div class="col-md-9">
                  <input
                    type="password"
                    v-model="password"
                    class="form-control"
                    placeholder="*******"
                  />
                </div>
              </div>
              <div class="form-group row">
                <label class="col-md-3 form-control-label" for="text-input"
                  >Tipo</label
                >
                <div class="col-md-9">
                  <select class="form-control" v-model="tipo">
                    <option value="0" disabled>Selecione</option>
                    <option value="Administrador">Administrador</option>
                    <option value="Vendedor">Vendedor</option>
                  </select>
                </div>
              </div>
              <!--
              <div class="form-group row">
                <label class="col-md-3 form-control-label" for="text-input"
                  >Empleados</label
                >
                <div class="col-md-9">
                  <select class="form-control" v-model="idEmpleado">
                    <option value="0" disabled>
                      Seleccione un Empleado
                    </option>
                    <option
                      v-for="empleado in arrayEmpleado"
                      :key="empleado.id"
                      :value="empleado.id"
                      v-text="empleado.nombre + ' ' + empleado.apellidos"
                    ></option>
                  </select>
                </div>
              </div> -->

              <div v-show="errorUsuario" class="form-group row div-error">
                <div class="text-center text-error">
                  <div
                    v-for="error in errorMostrarMsjUsuario"
                    :key="error"
                    v-text="error"
                  ></div>
                </div>
              </div>
            </form>
          </div>

          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              @click="cerrarModal()"
            >
              Cerrar
            </button>
            <button
              type="button"
              class="btn btn-primary"
              v-if="tipoAccion == 1"
              @click="guardar()"
            >
              Guardar
            </button>
            <button
              type="button"
              class="btn btn-primary"
              v-if="tipoAccion == 2"
              @click="actualizar()"
            >
              Actualizar
            </button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!--Fin del modal-->
  </main>
</template>

<script>
export default {
  data() {
    return {
      usuarioId: 0,
    //   idEmpleado: 0,
      login: "",
      password: "",
      tipo: "0",
      arrayUsuario: [],
      // arrayEmpleado:[],
      modal: 0,
      tituloModal: "",
      tipoAccion: 0,
      errorUsuario: 0,
      listadoTabla: 0,
      message: "",
      errorMostrarMsjUsuario: [],
      pagination: {
        total: 0,
        current_page: 0,
        per_page: 0,
        last_page: 0,
        from: 0,
        to: 0,
      },
      offset: 3,
      criterio: "login",
      buscar: "",
    };
  },
  computed: {
    isActived: function () {
      return this.pagination.current_page;
    },
    pagesNumber: function () {
      if (!this.pagination.to) {
        return [];
      }

      var from = this.pagination.current_page - this.offset;
      if (from < 1) {
        from = 1;
      }

      var to = from + this.offset * 2;
      if (to >= this.pagination.last_page) {
        to = this.pagination.last_page;
      }

      var pagesArray = [];
      while (from <= to) {
        pagesArray.push(from);
        from++;
      }
      return pagesArray;
    },
  },
  methods: {
    listarUsuario(page, buscar, criterio) {
      let me = this;
      var url =
        "/usuario?page=" + page + "&buscar=" + buscar + "&criterio=" + criterio;
      axios
        .get(url)
        .then(function (response) {
          me.arrayUsuario = response.data.data;
          me.pagination = {
            total: response.data.total,
            current_page: response.data.current_page,
            per_page: response.data.per_page,
            last_page: response.data.last_page,
            from: response.data.from,
            to: response.data.to,
          };
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    cambiarPagina(page, buscar, criterio) {
      let me = this;
      me.pagination.current_page = page;
      me.listarUsuario(page, buscar, criterio);
    },
    guardar() {
      if (this.validarUsuario()) {
        return;
      }
      let me = this;
      axios
        .post("/usuario/guardar", {
          login: this.login,
          password: this.password,
          tipo: this.tipo,
        //   idEmpleado: this.idEmpleado,
        })
        .then(function (response) {
          me.cerrarModal();
          me.listarUsuario(1, "", "login");
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    actualizar() {
      if (this.validarSucursal()) {
        return;
      }
      let me = this;
      axios
        .put("/usuario/modificar", {
          id: this.usuarioId,
          login: this.login,
          password: this.password,
          tipo: this.tipo,
        //   idEmpleado: this.idEmpleado,
        })
        .then(function (response) {
          me.cerrarModal();
          me.listarUsuario(1, "", "login");
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    desactivarUsuario(id) {
      swal({
        title: "Esta seguro de desactivar este usuario?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Aceptar!",
        cancelButtonText: "Cancelar",
        confirmButtonClass: "btn btn-success",
        cancelButtonClass: "btn btn-danger",
        buttonsStyling: false,
        reverseButtons: true,
      }).then((result) => {
        if (result.value) {
          let me = this;
          axios
            .put("/usuario/desactivar", { id: id })
            .then(function (response) {
              me.listarUsuario(1, "", "login");
              swal(
                "Desactivado!",
                "El registro ha sido desactivado con éxito.",
                "success"
              );
            })
            .catch(function (error) {
              console.log(error);
            });
        } else if (
          // Read more about handling dismissals
          result.dismiss === swal.DismissReason.cancel
        ) {
        }
      });
    },
    activarUsuario(id) {
      swal({
        title: "Esta seguro de activar este usuario?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Aceptar!",
        cancelButtonText: "Cancelar",
        confirmButtonClass: "btn btn-success",
        cancelButtonClass: "btn btn-danger",
        buttonsStyling: false,
        reverseButtons: true,
      }).then((result) => {
        if (result.value) {
          let me = this;
          axios
            .put("/usuario/activar", { id: id })
            .then(function (response) {
              me.listarUsuario(1, "", "login");
              swal(
                "Activado!",
                "El registro ha sido activado con éxito.",
                "success"
              );
            })
            .catch(function (error) {
              console.log(error);
            });
        } else if (
          // Read more about handling dismissals
          result.dismiss === swal.DismissReason.cancel
        ) {
        }
      });
    },
    validarUsuario() {
      this.errorUsuario = 0;
      this.errorMostrarMsjUsuario = [];

      if (!this.login)
        this.errorMostrarMsjUsuario.push("El Usario del Usuario esta vacio!");
      if (!this.password)
        this.errorMostrarMsjUsuario.push(
          "La Contraseña del Usuario esta vacio!"
        );
      if (!this.tipo) this.errorMostrarMsjUsuario.push("Seleccione un Tipo!");
      /* if (!this.idEmpleado)
        this.errorMostrarMsjUsuario.push("Seleccione un Empleado!"); */

      if (this.errorMostrarMsjUsuario.length) this.errorUsuario = 1;

      return this.errorUsuario;
    },
    cerrarModal() {
      this.modal = 0;
      this.tituloModal = "";
      this.login = "";
      this.password = "";
      this.tipo = "";
      //   this.idEmpleado = 0;
    },

    //Abre el modal del empleado en la sección de insertar nuevo usuario
    abrirModal(model, accion, data = []) {
    //   this.listarEmpleado();
      switch (model) {
        case "usuario": {
          switch (accion) {
            case "registrar": {
              this.modal = 1;
              this.tituloModal = "Registrar Usuario";
              this.login = "";
              this.password = "";
              this.tipo = "0";
              //   this.idEmpleado = 0;
              this.tipoAccion = 1;
              break;
            }
            case "modificar": {
              this.modal = 1;
              this.tituloModal = "Actualizar Usuario";
              this.tipoAccion = 2;
              this.usuarioId = data["id"];
              this.login = data["login"];
              this.password = data["password"];
              this.tipo = data["tipo"];
              //   this.idEmpleado = data["idEmpleado"];
            }
          }
        }
      }
    },
    /* listarEmpleado() {
      let me = this;
      var url = "/empleado/select";
      axios
        .get(url)
        .then(function (response) {
          me.arrayEmpleado = response.data;
          me.listadoTabla = 1;
        })
        .catch(function (error) {
          console.log(error);
        });
    }, */
  },
  mounted() {
    this.listarUsuario(1, "", "login");
  },
};
</script>
<style>
.modal-content {
  width: 100% !important;
  position: absolute !important;
}
.modal-content {
  width: 100% !important;
  position: absolute !important;
}
.mostrar {
  display: list-item !important;
  opacity: 1 !important;
  position: absolute !important;
  background-color: #3c29297a !important;
}
.mostrar {
  display: list-item !important;
  opacity: 1 !important;
  position: absolute !important;
  background-color: #3c29297a !important;
}
.div-error {
  display: flex;
  justify-content: center;
}
.text-error {
  color: red !important;
  font-weight: bold;
}
</style>
