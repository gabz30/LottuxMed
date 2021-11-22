<template>
    <div>
        <div class="shadow p-3 mb-2 form-inline border text-center">
            <label for="">Fecha de inicio</label>
            <input
                class="form-control mx-3"
                type="date"
                v-model="busqueda.fec_inicio"
            />
            <label for="">Fecha final</label>
            <input
                class="form-control mx-3"
                type="date"
                v-model="busqueda.fec_final"
            />
            <button class="btn btn-success" @click="listar">
                <i class="fas fa-search"></i>
            </button>
        </div>

        <table class="table shadow p-3 mb-5" v-if="mostrar">
            <thead>
                <tr>
                    <th scope="col">ID Caja</th>
                    <th scope="col">ID Consulta</th>
                    <th scope="col">Paciente</th>
                    <th scope="col">Monto seguro</th>
                    <th scope="col">Aseguradora</th>
                    <th scope="col">Tipo de plan</th>
                    <th scope="col"># afiliado</th>
                    <th scope="col">Fecha</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in data" :key="item.id">
                    <th>{{ item.caja_id }}</th>
                    <td>
                        <button
                            type="button"
                            class="btn btn-primary"
                            data-toggle="modal"
                            data-target="#exampleModal1"
                            data-whatever="@mdo"
                            @click="cargarConsulta(item.consulta_id)"
                        >
                            {{ item.consulta_id }}
                        </button>
                    </td>

                    <td>{{ item.Paciente }}</td>
                    <td>{{ number_format(item.monto_seguro) }}</td>
                    <td>{{ item.aseguradora }}</td>
                    <td>{{ item.seguro_plan }}</td>
                    <td>{{ item.seguro_afiliado }}</td>
                    <td>{{ arreglarFecha(item.created_at) }}</td>
                    <td>
                        <button
                            class="btn btn-success"
                            @click="saldar(item.id)"
                        >
                            Saldar
                        </button>
                    </td>
                </tr>
                <th></th>
                <th></th>
                <th></th>
                <th>{{ number_format(suma_seguro) }}</th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tbody>
        </table>

        <div
            class="modal fade"
            id="exampleModal1"
            tabindex="-1"
            role="dialog"
            aria-labelledby="exampleModal1Label"
            aria-hidden="true"
        >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModal1Label">
                            Consulta
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
                        <div
                            class="alert alert-primary my-3 shadow"
                            role="alert"
                        >
                            <span class="badge badge-danger shadow py-2"
                                >{{ arreglarFecha(modal.fecha) }}
                            </span>

                            <div class="form-group">
                                <label class="col-form-label">Paciente:</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    v-model="modal.paciente"
                                    disabled
                                />
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label"
                                    >Sintomas:</label
                                >
                                <textarea
                                    class="form-control"
                                    id="message-text"
                                    v-model="modal.sintomas"
                                    disabled
                                ></textarea>
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label"
                                    >Estudios de laboratorio:</label
                                >
                                <textarea
                                    class="form-control"
                                    id="message-text"
                                    v-model="modal.estudios_lab"
                                    disabled
                                ></textarea>
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label"
                                    >Exploracion fisica:</label
                                >
                                <textarea
                                    class="form-control"
                                    id="message-text"
                                    v-model="modal.exploracion_fisica"
                                    disabled
                                ></textarea>
                            </div>

                            <div v-if="modal.estudios">
                                <h4
                                    class="alert-heading text-dark font-weight-bold"
                                >
                                    Estudios realizados
                                </h4>
                                <div
                                    v-for="elemento in modal.estudios"
                                    :key="elemento.id"
                                >
                                    {{
                                        elemento.estudios_interconsulta
                                            .descripcion
                                    }}
                                    -
                                    {{ elemento.estudios_interconsulta.precio }}
                                </div>
                                <hr />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal"
                        >
                            Close
                        </button>
                        <!-- <button type="button" class="btn btn-primary">Send message</button> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
const moment = require("moment");

export default {
    props: ["user_id"],
    mounted() {
        this.formulario.user_id = this.user_id;
    },
    data() {
        return {
            formulario: {
                user_id: 0,
                monto: 0,
                concepto: "",
                comentario: ""
            },
            busqueda: {
                fec_inicio: "",
                fec_final: ""
            },
            data: [],
            mostrar: false,
            suma_seguro: 0,
            modal: {
                paciente: "",
                fecha: "",
                sintomas: "",
                exploracion_fisica: "",
                estudios_lab: "",
                comentario: "",
                estudios: []
            }
        };
    },
    methods: {
        cargarConsulta(ConsultaID) {
            axios
                .get("/consulta/" + ConsultaID)
                .then(res => {
                    console.log(res.data);
                    this.modal.paciente = res.data[0].paciente.name;
                    this.modal.fecha = res.data[0].created_at;
                    this.modal.sintomas = res.data[0].sintomas;
                    this.modal.exploracion_fisica =
                        res.data[0].exploracion_fisica;
                    this.modal.estudios_lab = res.data[0].estudios_lab;
                    this.modal.comentario = res.data[0].comentario;

                    this.modal.estudios = res.data[0].estudios_realizados;
                })
                .catch(err => console.log(err));
        },
        async saldar(id) {
            await axios
                .put("/contabilidad/pago/" + id, {
                    estatus: 1
                })
                .then(res => {
                    console.log(res.data);
                    this.$swal.fire({
                        icon: "success",
                        title: "Cuenta saldada!",
                        // showConfirmButton: true,
                        timer: 1300
                    });

                    this.listar();
                })
                .catch(err => console.log(err));
        },
        async listar() {
            if (
                this.busqueda.fec_inicio != "" &&
                this.busqueda.fec_final != ""
            ) {
                await axios
                    .post("/contabilidad/buscar/cxc/", this.busqueda)
                    .then(res => {
                        this.data = res.data;
                        console.log(res.data);
                        if (Object.keys(res.data).length > 0) {
                            this.mostrar = true;

                            this.suma_seguro = 0;

                            this.data.forEach((value, index) => {
                                this.suma_seguro += value.monto_seguro;
                            });
                        }
                    })
                    .catch(err => console.log(err));
            } else {
                this.$swal.fire({
                    icon: "error",
                    title: "Ingrese una fecha valida.",
                    // showConfirmButton: true,
                    timer: 1300
                });
            }
        },

        arreglarFecha(fecha) {
            return moment(fecha).format("DD-MM-yyyy");
        },

        number_format(value){
            const formatter = new Intl.NumberFormat('en');
            return '$' + formatter.format(value);
        },
    }
};
</script>
