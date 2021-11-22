<template>
    <div>
        <div class="container-fluid mt-3">
            <div class="row justify-content-center">
                <div class="col-md-6 border shadow pb-3 bg-light px-3 py-3">
                    <label class="text-danger">Nombre</label>
                    <input
                        type="text"
                        class="form-control"
                        v-model="farmacia.nombre"
                    />
                    <label class="text-danger">Direccion</label>
                    <input
                        type="text"
                        class="form-control"
                        v-model="farmacia.direccion"
                    />

                    <label>Telefono</label>
                    <input
                        type="text"
                        class="form-control"
                        v-model="farmacia.telefono"
                    />
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">Usuario:</legend>
                        <label>E-mail</label>
                        <input
                            type="email"
                            class="form-control"
                            v-model="farmacia.email"
                        />
                        <label>Contraseña</label>
                        <input
                            type="password"
                            class="form-control"
                            v-model="farmacia.password"
                        />
                    </fieldset>

                    <button
                        class="btn btn-primary btn-block mt-3"
                        @click="registrar"
                    >
                        <i class="fas fa-save"></i>
                        Registrar
                    </button>
                </div>
            </div>
        </div>
        <div v-if="mostrar" class="container-fluid mt-3">
            <div class="row justify-content-center">
                <div class="col-md-6 border shadow pb-3 bg-light px-3 py-3">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Ciudad</th>
                                <th scope="col">Direccion</th>
                                <th scope="col">Telefono</th>
                                <th scope="col">Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="item in data" :key="item.id">
                                <td>{{ item.id }}</td>
                                <td>{{ item.nombre }}</td>
                                <td>{{ item.direccion }}</td>
                                <td>{{ item.telefono }}</td>
                                <td>{{ arreglarFecha(item.created_at) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
const moment = require("moment");

export default {
    mounted() {
        this.listar();
    },
    data() {
        return {
            data: [],
            mostrar: false,
            farmacia: {
                nombre: "",
                direccion: "",
                telefono: "",
                email: "",
                password: "",

            }
        };
    },
    methods: {
        async listar() {
            await axios
                .get("/farmacias/create")
                .then(res => {
                    this.data = res.data;
                    this.mostrar = true;
                })
                .catch(err => console.log(err));
        },
        async registrar() {
            if (this.farmacia.nombre && this.farmacia.direccion) {
                await axios
                    .post("/farmacias", this.farmacia)
                    .then(res => {
                        this.$swal.fire({
                            icon: "success",
                            title: "Farmacia registrada con exito!!!",
                            showConfirmButton: false,
                            timer: 1300
                        });
                        console.log(res.data);
                        this.listar();
                    })
                    .catch(err => console.log(err));
            } else {
                this.$swal.fire({
                    icon: "error",
                    title: "Debe llenar todos los campos en rojo.",
                    showConfirmButton: false,
                    timer: 1300
                });
            }
        },
        arreglarFecha(fecha) {
            return moment(fecha).format("DD-MM-yyyy");
        }
    }
};
</script>
