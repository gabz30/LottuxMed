<template>
    <div>
        <div v-if="code === '200'">
            <div
                class="container-fluid my-3"
                v-for="item in data"
                :key="item.id"
            >
                <div class="row justify-content-center">
                    <div class="col-md-4 col-lg-4 border shadow pb-3 bg-light">
                        <table class="table table-responsive">
                            <thead>
                                <tr>
                                    <!-- <th scope="col">#</th> -->
                                    <th scope="col"></th>
                                    <th scope="col">Para el dia:</th>
                                    <th scope="col">Paciente</th>
                                    <!-- <th scope="col">Titulo</th>
                                    <th scope="col">Descripcion</th> -->
                                    <th scope="col">Fecha</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <button
                                            class="btn btn-success btn-md"
                                            @click="
                                                showModal(
                                                    item.id, 
                                                    item.paciente[0].id,
                                                    item.paciente[0].name,
                                                    item.doctor_id
                                                )
                                            "
                                        >
                                            <i class="fas fa-check-circle"></i>
                                            Aprobar
                                        </button>
                                    </td>
                                    <td>{{ arreglarFecha(item.start) }}</td>
                                    <td>{{ item.paciente[0].name }}</td>
                                    <!-- <td>{{ item.title }}</td>
                                    <td>{{ item.description }}</td> -->
                                    <td>
                                        {{ arreglarFecha(item.created_at) }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <hr />
                    </div>
                </div>
            </div>

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
                                    <label
                                        for="message-text"
                                        class="col-form-label"
                                        >Paciente:
                                    </label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        :value="modal.userName"
                                        disabled
                                    />
                                </div>
                                <!-- <div class="form-group">
                                    <label
                                        for="message-text"
                                        class="col-form-label"
                                        >Titulo:</label
                                    >
                                    <textarea
                                        class="form-control"
                                        id="message-text"
                                        v-model="title"
                                    ></textarea>
                                </div>
                                <div class="form-group">
                                    <label
                                        for="message-text"
                                        class="col-form-label"
                                        >Comentario:</label
                                    >
                                    <textarea
                                        class="form-control"
                                        id="message-text"
                                        v-model="description"
                                    ></textarea>
                                </div> -->
                                <div class="form-group">
                                    <label class="col-form-label">Fecha:</label>
                                    <input
                                        type="datetime-local"
                                        class="form-control"
                                        v-model="modal.start"
                                    />
                                </div>
                                <!-- <div class="form-group">
                                    <label
                                        for="recipient-name"
                                        class="col-form-label"
                                        >Fecha final:</label
                                    >
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="recipient-name"
                                        v-model="end"
                                    />
                                </div> -->

                                <div class="form-group">
                                    <label for="favcolor">Tipo de cita:</label>
                                    <select class="form-control" id="color" v-model="modal.color">
                                        <option value="#039be5" selected
                                            >Consulta</option
                                        >
                                        <option value="#33b679">Evento</option>
                                        <option value="#3f51b5"
                                            >Operacion</option
                                        >
                                        <option value="#16D3A2">Tarea</option>
                                        <option value="#e4c441"
                                            >Recordatorio</option
                                        >
                                    </select>
                                    <!-- <input
                                            type="color"
                                            id="favcolor"
                                            name="favcolor"
                                            class="form-control"
                                            v-model="color"
                                        /> -->
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
                                @click="aprobar"
                            >
                                Guardar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-else class="container my-3 text-center">
            <div class="alert alert-success font-weight-bold" role="alert">
                No hay citas pendientes de aprobacion.
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
            consulta_id: 0,
            dataReceta: [],
            code: "",
            modal: {
                user_id: 0,
                userName: "",
                start: '',
                color: '',
                doctor_id: 0,
                citaPendienteId: 0,

            }
        };
    },

    methods: {
        listar() {
            axios
                .get("/citas-pendientes/index")
                .then(res => {
                    // console.log(res.data);
                    this.data = res.data.data;
                    this.code = res.data.code;
                    // this.consulta_id = res.data[0].consulta_id;
                })
                .catch(err => console.log(err));

            console.log(this.dataReceta);
        },
        showModal(citaPendienteId, userId, userName, doctorId) {
            this.modal.citaPendienteId = citaPendienteId
            this.modal.user_id = userId;
            this.modal.userName = userName;
            this.modal.doctor_id = doctorId;

            $(evento).modal("show");
        },
        async aprobar() {
            const datos = {
                title: this.modal.userName,
                description: '',
                user_id: this.modal.user_id,
                doctor_id: this.modal.doctor_id,
                start: this.modal.start,
                color: this.modal.color,
                estatus: 1
            };

            // alert( JSON.stringify( datos ))
            // return

            await axios
                .post(`/calendarios`, datos)
                .then(res => {
                    console.log(res.data);

                    axios
                        .put(`/citas-pendientes/${this.modal.citaPendienteId}`, {
                            estatus: 0
                        })
                        .then(res => {
                            console.log(res.data);

                            this.listar();

                            this.$swal.fire({
                                icon: "success",
                                title: "Cita realizada con exito!",
                                // showConfirmButton: true,
                                timer: 1300
                            });
                        })
                        .catch(err => console.log(err));
                })
                .catch(err => console.log(err));
        },
        cancelar(pedido_id) {
            axios
                .put("/lottuxpharm/" + pedido_id, {
                    estatus: 0
                })
                .then(res => {
                    console.log(res.data);

                    this.listar();

                    this.$swal.fire({
                        icon: "error",
                        title: "Pedido cancelado",
                        // showConfirmButton: true,
                        timer: 1300
                    });
                })
                .catch(err => console.log(err));
        },
        arreglarFecha(fecha) {
            return moment(fecha).format("DD MMMM YYYY hh:mm");
        }
    }
};
</script>
