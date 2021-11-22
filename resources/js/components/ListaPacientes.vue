<template>
    <div>
        <div class="form-inline bg-dark my-2 py-2 px-2">
            <input
                type="text"
                placeholder="Buscar paciente..."
                class="w-25 p-1 mr-1"
                v-model="txtbuscar"
                @keyup.enter="buscar"
            />
            <button
                type="button"
                class="btn btn-primary btn-md"
                @click="buscar"
            >
                <i class="fas fa-search"></i>
            </button>

            <a class="btn btn-success btn-md ml-5" href="/pacientes/nuevo"
                ><i class="fas fa-plus-square"></i> Registrar nuevo paciente</a
            >
        </div>

        <div class="card">
            <div class="card-header">Pacientes</div>

            <table class="table table-dark">
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Email</th>
                        <th scope="col">Cedula</th>
                        <th scope="col">Celular</th>
                        <th scope="col">Telefono</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item in data" :key="item.id">
                        <td>{{ item.name }}</td>
                        <td>{{ item.email }}</td>
                        <td>{{ item.cedula }}</td>
                        <td>{{ item.celular }}</td>
                        <td>{{ item.telefono }}</td>
                        <td>
                            <button
                                type="button"
                                class="btn btn-success"
                                @click="verUsuario(item.id)"
                            >
                                <i class="fas fa-eye"></i>
                            </button>
                            <button
                                type="button"
                                class="btn btn-light"
                                @click="historiaClinica(item.id)"
                            >
                                Ver expediente
                            </button>
                            <button
                                type="button"
                                class="btn btn-primary"
                                data-toggle="modal"
                                data-target="#evento"
                                data-whatever="@mdo"
                                @click="obtenerUser(item.id, item.name)"
                            >
                                Agendar
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Modal Agenda -->
        <div
            class="modal fade"
            id="evento"
            tabindex="-1"
            role="dialog"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            Agendar
                        </h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label"
                                    >Paciente:</label
                                >
                                <input
                                    type="text"
                                    class="form-control"
                                    v-model="title"
                                />
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label"
                                    >Comentario:</label
                                >
                                <textarea
                                    class="form-control"
                                    id="message-text"
                                    v-model="description"
                                ></textarea>
                            </div>
                            <div class="form-group">
                                <label
                                    for="recipient-name"
                                    class="col-form-label"
                                    >Fecha y Hora:</label
                                >
                                <input
                                    type="datetime-local"
                                    class="form-control"
                                    id="recipient-name"
                                    v-model="start"
                                />
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal"
                        >
                            Cerrar
                        </button>
                        <button
                            type="button"
                            class="btn btn-primary"
                            @click="guardar"
                        >
                            Guardar
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal datos del usuario -->

        <div
            class="modal fade"
            id="modalUsuario"
            tabindex="-1"
            role="dialog"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            Datos del paciente
                        </h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label"
                                    >Nombre:</label
                                >
                                <input
                                    type="text"
                                    class="form-control"
                                    v-model="usuario.nombre"
                                    disabled
                                />
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label"
                                    >Cedula:</label
                                >
                                <input
                                    type="text"
                                    class="form-control"
                                    v-model="usuario.cedula"
                                    disabled
                                />
                            </div>

                            <div class="form-group" v-if="usuario.celular">
                                <label for="message-text" class="col-form-label"
                                    >Celular:</label
                                >
                                <input
                                    class="form-control"
                                    type="text"
                                    v-model="usuario.celular"
                                    disabled
                                />
                            </div>
                            <b v-else class="text-danger font-weight-bold"
                                >No tiene celular</b
                            ><br />
                            <div class="form-group" v-if="usuario.direccion">
                                <label for="message-text" class="col-form-label"
                                    >Direccion:</label
                                >
                                <textarea
                                    class="form-control"
                                    rows="3"
                                    v-model="usuario.direccion"
                                    disabled
                                ></textarea>
                            </div>
                            <b v-else class="text-danger font-weight-bold"
                                >No tiene direccion</b
                            ><br />

                            <div class="form-group">
                                <label for="message-text" class="col-form-label"
                                    >Seguro:</label
                                >
                                <input
                                    type="text"
                                    class="form-control"
                                    v-model="usuario.aseguradora"
                                    disabled
                                />
                            </div>

                            <div class="form-group">
                                <label for="message-text" class="col-form-label"
                                    ># Afiliado:</label
                                >
                                <input
                                    type="text"
                                    class="form-control"
                                    v-model="usuario.afiliado"
                                    disabled
                                />
                            </div>

                            <div class="form-group">
                                <label for="message-text" class="col-form-label"
                                    >Plan de seguro:</label
                                >
                                <input
                                    type="text"
                                    class="form-control"
                                    v-model="usuario.seguro_plan"
                                    disabled
                                />
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal"
                        >
                            Cerrar
                        </button>
                        <button
                            type="button"
                            class="btn btn-primary"
                            @click="lista"
                        >
                            <i class="fas fa-people-arrows"></i> Agregar a lista
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
const moment = require("moment");
export default {
    props: ["user_login"],
    mounted() {
        axios
            .get("/pacientes/create")
            .then(res => {
                this.data = res.data;
                console.log(this.data);
            })
            .catch(err => console.log(err));

        this.start = moment().format("YYYY-MM-DD hh:mm:ss");
        this.end = moment().format("YYYY-MM-DD hh:mm:ss");
        this.usuario.drID = this.user_login;
        // alert(this.usuario.authLogin)
    },
    data() {
        return {
            txtbuscar: "",
            data: [],
            title: "",
            start: "",
            end: "",
            color: "#039be5",
            user_id: 0,
            description: "",
            usuario: {
                nombre: "",
                cedula: "",
                direccion: "",
                celular: "",
                aseguradora: "",
                afiliado: "",
                seguro_plan: "",
                drID: 0
            }
        };
    },
    methods: {
        historiaClinica(id) {
            // alert("El id => "+id);
            window.location.href =
                window.location.origin + "/pacientes/historia/" + id;
        },
        async buscar() {
            if (this.txtbuscar !== "") {
                await axios
                    .get("/pacientes/" + this.txtbuscar)
                    .then(res => {
                        console.log(res.data);
                        this.data = res.data;
                    })
                    .catch(err => console.log(err));
            } else {
                this.$swal.fire({
                    // position: "top-end",
                    icon: "error",
                    title: "Especifique su busqueda.",
                    showConfirmButton: false,
                    timer: 1300
                });
            }
        },
        async lista() {
            const datos = {
                user_id: this.user_id,
                drID: this.usuario.drID,
                estatus: 1
            };
            axios
                .post("/lista-espera", datos)
                .then(res => {
                    console.log(res.data);
                    this.$swal.fire({
                        // position: "top-end",
                        icon: "success",
                        title: "Agregada a la lista",
                        showConfirmButton: false,
                        timer: 1300
                    });
                })
                .catch(err => console.log(err));
        },
        verUsuario(id) {
            this.user_id = id;
            $(modalUsuario).modal("show");

            axios
                .get("/pacientes/" + this.user_id)
                .then(res => {
                    console.log(res.data);
                    // this.usuario.data = res.data;
                    this.usuario.nombre = res.data[0].name;
                    this.usuario.cedula = res.data[0].cedula;
                    this.usuario.direccion = res.data[0].direccion;
                    this.usuario.celular = res.data[0].celular;
                    this.usuario.aseguradora = res.data[0].aseguradora.nombre;
                    this.usuario.afiliado = res.data[0].seguro_afiliado;
                    this.usuario.seguro_plan = res.data[0].seguro_plan;
                })
                .catch(err => console.log(err));
        },
        obtenerUser(id, name) {
            this.user_id = id;
            this.title = name;
        },
        async guardar() {
            const datos = {
                title: this.title,
                description: this.description,
                start: this.start,
                color: this.color,
                user_id: this.user_id,
                doctor_id: parseInt(this.usuario.drID),
                estatus: 1
            };

    
            await axios
                .post("/calendarios", datos)
                .then(res => {
                    console.log(res.data);
                    this.$swal.fire({
                        icon: "success",
                        title: "Cita agendada con exito!",
                        showConfirmButton: true,
                        timer: 1300
                    });
                })
                .catch(err => console.log(err));

            $(evento).modal("hide");
        },
        arreglarFecha(fecha) {
            return moment(fecha).format("YYYY-MM-DD hh:mm:ss");
        }
    }
};
</script>
