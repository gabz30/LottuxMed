<template>
    <div class="col-md-5">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a
                    class="nav-link active"
                    id="home-tab"
                    data-toggle="tab"
                    href="#home"
                    role="tab"
                    aria-controls="home"
                    aria-selected="true"
                    >Registrar secretaria</a
                >
            </li>
            <li class="nav-item">
                <a
                    class="nav-link"
                    id="profile-tab"
                    data-toggle="tab"
                    href="#profile"
                    role="tab"
                    aria-controls="profile"
                    aria-selected="false"
                    >Registrar medicamento</a
                >
            </li>
            <li class="nav-item">
                <a
                    class="nav-link"
                    id="messages-tab"
                    data-toggle="tab"
                    href="#messages"
                    role="tab"
                    aria-controls="messages"
                    aria-selected="false"
                    >Registrar enfermedad</a
                >
            </li>
            <li class="nav-item">
                <a
                    class="nav-link"
                    id="settings-tab"
                    data-toggle="tab"
                    href="#settings"
                    role="tab"
                    aria-controls="settings"
                    aria-selected="false"
                    >Estudios Interconsulta</a
                >
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content py-3 px-3 bg-white border shadow">
            <div
                class="tab-pane active"
                id="home"
                role="tabpanel"
                aria-labelledby="home-tab"
            >
                <label for="" class="text-danger">Nombre</label>
                <input
                    type="text"
                    class="form-control mb-3"
                    placeholder="Nombre y apellido"
                    v-model="formulario.name"
                />

                <label for="" class="text-danger">Email</label>
                <input
                    type="email"
                    class="form-control mb-3"
                    placeholder="Email"
                    v-model="formulario.email"
                />

                <label for="">Cedula</label>
                <input
                    type="text"
                    class="form-control mb-3"
                    placeholder="Cedula"
                    v-model="formulario.cedula"
                />

                <label for="">Celular</label>
                <input
                    type="text"
                    class="form-control mb-3"
                    placeholder="Celular"
                    v-model="formulario.celular"
                />

                <label for="">Direccion</label>
                <textarea
                    class="form-control mb-3"
                    placeholder="Direccion"
                    rows="3"
                    v-model="formulario.direccion"
                ></textarea>

                <label for="">Salario</label>
                <input
                    type="number"
                    class="form-control mb-3"
                    placeholder="Salario"
                    v-model="formulario.salario"
                />

                <label for="" class="text-danger">Contraseña</label>
                <input
                    type="password"
                    class="form-control mb-3"
                    v-model="formulario.password"
                />

                <button class="btn btn-primary btn-block " @click="registrar">
                    Registrar
                </button>
            </div>
            <div
                class="tab-pane"
                id="profile"
                role="tabpanel"
                aria-labelledby="profile-tab"
            >
                <label for="" class="text-danger">Descripcion</label>
                <input
                    type="text"
                    class="form-control mb-3"
                    v-model="medicamento.descripcion"
                />

                <button
                    class="btn btn-primary btn-block "
                    @click="registrarMedicamento"
                >
                    Registrar
                </button>

                <!-- <div v-if="mostrarTablaMedicamentos"> -->
                <table class="table my-5">
                    <thead>
                        <tr>
                            <th scope="col">Medicamento</th>
                            <th scope="col">Fecha</th>
                            <!-- <th scope="col">Estatus</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="item in dataMedicamentos" :key="item.id">
                            <td>{{ item.descripcion }}</td>
                            <td>{{ arreglarFecha(item.created_at) }}</td>

                            <!-- <td
                                v-if="item.estatus === 1"
                                class="text-success font-weight-bold"
                                role="button"
                            >
                                Activo
                            </td>
                            <td
                                v-else
                                class="text-danger font-weight-bold"
                                role="button"
                            >
                                Inactivo
                            </td> -->
                        </tr>
                    </tbody>
                </table>
                <!-- </div> -->
            </div>
            <div
                class="tab-pane"
                id="messages"
                role="tabpanel"
                aria-labelledby="messages-tab"
            >
                <label for="" class="text-danger">Nombre</label>
                <input
                    type="text"
                    class="form-control mb-3"
                    v-model="enfermedad.nombre"
                />

                <button
                    class="btn btn-primary btn-block "
                    @click="registrarEnfermedad"
                >
                    Registrar
                </button>

                <!-- <div v-if="mostrarTablaMedicamentos"> -->
                <table class="table my-5">
                    <thead>
                        <tr>
                            <th scope="col">Enfermedad</th>
                            <th scope="col">Fecha</th>
                            <!-- <th scope="col">Estatus</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="item in dataEnfermedad" :key="item.id">
                            <td>{{ item.nombre }}</td>
                            <td>{{ arreglarFecha(item.created_at) }}</td>

                            <!-- <td
                                v-if="item.estatus === 1"
                                class="text-success font-weight-bold"
                                role="button"
                            >
                                Activo
                            </td>
                            <td
                                v-else
                                class="text-danger font-weight-bold"
                                role="button"
                            >
                                Inactivo
                            </td> -->
                        </tr>
                    </tbody>
                </table>
            </div>
            <div
                class="tab-pane"
                id="settings"
                role="tabpanel"
                aria-labelledby="settings-tab"
            >
                <label for="" class="text-danger">Nombre</label>
                <input
                    type="text"
                    class="form-control mb-3"
                    v-model="estudios.descripcion"
                />

                <label for="" class="text-danger">Precio</label>
                <input
                    type="text"
                    class="form-control mb-3"
                    v-model="estudios.precio"
                />

                <button
                    class="btn btn-primary btn-block "
                    @click="registrarEstudiosInterconsulta"
                >
                    Registrar
                </button>

                <!-- <div v-if="mostrarTablaMedicamentos"> -->
                <table class="table my-5">
                    <thead>
                        <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Estatus</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="item in dataEstudios" :key="item.id">
                            <td>{{ item.descripcion }}</td>
                            <td>{{ number_format(item.precio) }}</td>
                            <td>{{ arreglarFecha(item.created_at) }}</td>

                            <td role="button" @click="CambiarEstatus(item.id, item.estatus)">
                                <b
                                    v-if="item.estatus === 1"
                                    class="text-success font-weight-bold"
                                >
                                    Activo</b
                                >
                                <b v-else class="text-danger font-weight-bold">
                                    Inactivo</b
                                >
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
<script>
const moment = require("moment");

export default {
    props: ["user_id"],
    mounted() {
        this.formulario.authLogin = this.user_id;

        this.obtenerMedicamentos();
        this.obtenerEnfermedad();
        this.obtenerEstudiosInterconsulta();
    },
    data() {
        return {
            formulario: {
                authLogin: 0,
                name: "",
                cedula: "",
                celular: "",
                email: "",
                direccion: "",
                salario: "",
                password: "",
                tipo_usuario_id: 3
            },
            medicamento: {
                descripcion: ""
            },
            dataMedicamentos: [],
            mostrarTablaMedicamentos: false,

            enfermedad: {
                nombre: ""
            },
            dataEnfermedad: [],
            mostrarTablaEnfermedad: false,

            estudios: {
                descripcion: "",
                precio: 0
            },
            dataEstudios: [],
            mostrarTablaEstudios: false
        };
    },

    methods: {
        async registrarEstudiosInterconsulta() {
            if (this.estudios.descripcion && this.estudios.precio) {
                const data = {
                    doctor_id: this.formulario.authLogin,
                    descripcion: this.estudios.descripcion,
                    precio: this.estudios.precio,
                    estatus: 1
                };

                await axios
                    .post("/estudios", data)
                    .then(res => {
                        console.log(res.data);

                        this.estudios.descripcion = "";
                        this.estudios.precio = 0;

                        this.$swal.fire({
                            icon: "success",
                            title: "Registrado correctamento!",
                            // showConfirmButton: true,
                            timer: 1300
                        });

                        this.obtenerEstudiosInterconsulta();
                    })
                    .catch(err => console.log(err));
            } else {
                this.$swal.fire({
                    icon: "error",
                    title: "Debe llenar los campos en rojo.",
                    // showConfirmButton: true,
                    timer: 1300
                });
            }
        },

        async obtenerEstudiosInterconsulta() {
            await axios
                .get('/todos/estudios')
                .then(res => {
                    console.log('este es el resultado: ' + res.data);
                    this.dataEstudios = res.data;

                    if (Object.keys(res.data).length > 0) {
                        this.mostrarTablaEstudios = true;
                    }
                })
                .catch(err => console.log(err));
        },

        async registrarEnfermedad() {
            if (this.enfermedad.nombre) {
                const data = {
                    authLogin: this.formulario.authLogin,
                    nombre: this.enfermedad.nombre,
                    estatus: 1
                };

                await axios
                    .post("/enfermedades", data)
                    .then(res => {
                        console.log(res.data);

                        this.enfermedad.nombre = "";

                        this.$swal.fire({
                            icon: "success",
                            title: "Registrado correctamento!",
                            // showConfirmButton: true,
                            timer: 1300
                        });

                        this.obtenerEnfermedad();
                    })
                    .catch(err => console.log(err));
            } else {
                this.$swal.fire({
                    icon: "error",
                    title: "Debe llenar el campo de nombre!",
                    // showConfirmButton: true,
                    timer: 1300
                });
            }
        },

        async obtenerEnfermedad() {
            await axios
                .get("/enfermedades")
                .then(res => {
                    console.log(res.data);
                    this.dataEnfermedad = res.data;

                    if (Object.keys(res.data).length > 0) {
                        this.mostrarTablaEnfermedad = true;
                    }
                })
                .catch(err => console.log(err));
        },
        async registrarMedicamento() {
            if (this.medicamento.descripcion) {
                const data = {
                    authLogin: this.formulario.authLogin,
                    descripcion: this.medicamento.descripcion,
                    estatus: 1
                };

                await axios
                    .post("/medicamentos", data)
                    .then(res => {
                        console.log(res.data);

                        this.medicamento.descripcion = "";

                        this.$swal.fire({
                            icon: "success",
                            title: "Registrado correctamento!",
                            // showConfirmButton: true,
                            timer: 1300
                        });

                        this.obtenerMedicamentos();
                    })
                    .catch(err => console.log(err));
            } else {
                this.$swal.fire({
                    icon: "error",
                    title: "Debe llenar el campo de medicamento!",
                    // showConfirmButton: true,
                    timer: 1300
                });
            }
        },
        async obtenerMedicamentos() {
            await axios
                .get("/lista-medicamentos")
                .then(res => {
                    console.log(res.data);
                    this.dataMedicamentos = res.data;

                    if (Object.keys(res.data).length > 0) {
                        this.mostrarTablaMedicamentos = true;
                    }
                })
                .catch(err => console.log(err));
        },
        async registrar() {
            if (
                this.formulario.name &&
                this.formulario.email &&
                this.formulario.password
            ) {
                await axios
                    .post("/configuracion", this.formulario)
                    .then(res => {
                        console.log(res.data);
                        this.$swal.fire({
                            icon: "success",
                            title: "Registrado correctamento!",
                            // showConfirmButton: true,
                            timer: 1300
                        });
                    })
                    .catch(err => console.log(err));
            } else {
                this.$swal.fire({
                    icon: "error",
                    title: "Debe completar los campos en rojo!",
                    // showConfirmButton: true,
                    timer: 1300
                });
            }
        },
        async CambiarEstatus(id, estatus){

            if(estatus === 0){
                estatus = 1;
            }else{
                estatus = 0;
            }

            await axios.put('/configuracion/estudios/' + id, {
                estatus: estatus
            })
            .then(res => {
                console.log(res.data);
                this.obtenerEstudiosInterconsulta();
            })
            .catch(err => console.log(err))
        },
        arreglarFecha(fecha) {
            return moment(fecha).format("DD-MM-yyyy");
        },
        number_format(value) {
            const formatter = new Intl.NumberFormat("en");
            return "$" + formatter.format(value);
        }
    }
};
</script>
