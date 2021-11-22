<template>
    <div>
        <div class="shadow p-3 mb-2 form-inline border text-center">
            <select class="form-control mr-3" v-model="tipoReporte">
                <option value="cajaChica">Caja chica</option>
                <option value="Nomina">Nomina</option>
                <option value="Consultas">Consultas</option>
            </select>
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

        <table class="table shadow p-3 mb-5" v-if="mostrarCaja">
            <thead>
                <tr>
                    <th scope="col">ID Caja</th>
                    <th scope="col">Secretaria</th>
                    <th scope="col">Total de pagos</th>
                    <th scope="col">Efectivo</th>
                    <th scope="col">Targeta</th>
                    <th scope="col">Seguro</th>
                    <th scope="col">Gastos</th>
                    <th scope="col">Apertura de caja</th>
                    <th scope="col">Total en caja</th>
                    <th scope="col">Fecha</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in dataCajaChica" :key="item.id">
                    <td>{{ item.caja_id }}</td>

                    <td>{{ item.Secretaria }}</td>
                    <td>
                        <p v-if="item.total_pagos">{{ number_format(item.total_pagos) }}</p>
                        <b v-else class="text-danger">N/A</b>
                    </td>
                    <td>
                        <p v-if="item.efectivo">{{ number_format(item.efectivo) }}</p>
                        <b v-else class="text-danger">N/A</b>
                    </td>
                    <td>
                        <p v-if="item.tarjeta">{{ number_format(item.tarjeta) }}</p>
                        <b v-else class="text-danger">N/A</b>
                    </td>
                    <td>
                        <p v-if="item.cubierto_seguro">
                            {{ number_format(item.cubierto_seguro) }}
                        </p>
                        <b v-else class="text-danger">N/A</b>
                    </td>
                    <td>
                        <p v-if="item.gastos">{{ number_format(item.gastos) }}</p>
                        <b v-else class="text-danger">N/A</b>
                    </td>
                    <td>
                        <p v-if="item.apertura_caja">
                            {{ number_format(item.apertura_caja) }}
                        </p>
                        <b v-else class="text-danger">N/A</b>
                    </td>
                    <td>
                        <p v-if="item.total_caja">{{ number_format(item.total_caja) }}</p>
                        <b v-else class="text-danger">N/A</b>
                    </td>
                    <td>{{ arreglarFecha(item.created_at) }}</td>
                </tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tbody>
        </table>

        <table class="table shadow p-3 mb-5" v-if="mostrarNomina">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Secretaria</th>
                    <th scope="col">Doctor</th>
                    <th scope="col">Monto</th>
                    <th scope="col">Estatus</th>
                    <th scope="col">Fecha</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in dataNomina" :key="item.id">
                    <td>{{ item.id }}</td>

                    <td>{{ item.user.name }}</td>

                    <td>{{ item.authLogin }}</td>

                    <td>{{ number_format(item.monto) }}</td>

                    <td>
                        <b v-if="item.estatus" class="text-success">Activo</b
                        ><b v-else class="text-danger">Inactivo</b>
                    </td>

                    <td>{{ arreglarFecha(item.created_at) }}</td>
                </tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tbody>
            <!-- <a href="{{ route('gastos.excel') }}" target="_blank" class="btn btn-success mx-4 mb-4"><i class="fas fa-file-excel"></i> Exportar a Excel</a> -->
        </table>

        <table class="table shadow p-3 mb-5" v-if="mostrarConsulta">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Fec. Sintomas</th>
                    <th scope="col">Sintomas</th>
                    <th scope="col">Paciente</th>
                    <th scope="col">Fecha</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in dataConsultas" :key="item.id">
                    <td>
                        <button
                            type="button"
                            class="btn btn-primary"
                            data-toggle="modal"
                            data-target="#exampleModal"
                            data-whatever="@mdo"
                            @click="cargarConsulta(item.id)"
                        >
                            {{ item.id }}
                        </button>
                    </td>

                    <td>{{ arreglarFecha(item.fecha_sintomas) }}</td>

                    <td>{{ item.sintomas }}</td>

                    <td>{{ item.paciente.name }}</td>

                    <td>{{ arreglarFecha(item.created_at) }}</td>
                </tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tbody>
            <!-- <a href="{{ route('gastos.excel') }}" target="_blank" class="btn btn-success mx-4 mb-4"><i class="fas fa-file-excel"></i> Exportar a Excel</a> -->
        </table>

        <div
            class="modal fade"
            id="exampleModal"
            tabindex="-1"
            role="dialog"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            Mensaje
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
                        <button type="button" class="btn btn-primary">
                            Send message
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
    props: ["user_id"],
    mounted() {
        this.formulario.user_id = this.user_id;
    },
    data() {
        return {
            formulario: {
                user_id: 0
            },
            busqueda: {
                fec_inicio: "",
                fec_final: ""
            },
            mostrarCaja: false,
            mostrarNomina: false,
            mostrarConsulta: false,
            dataCajaChica: [],
            dataNomina: [],
            dataConsultas: [],
            tipoReporte: "",
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
        async listar() {
            if (
                this.busqueda.fec_inicio != "" &&
                this.busqueda.fec_final != "" &&
                this.tipoReporte != ""
            ) {
                if (this.tipoReporte === "cajaChica") {
                    await axios
                        .post("/caja/cierre/busqueda", this.busqueda)
                        .then(res => {
                            this.dataCajaChica = res.data;
                            console.log(res.data);
                            if (Object.keys(res.data).length > 0) {
                                this.mostrarCaja = true;
                                this.mostrarNomina = false;
                                this.mostrarConsulta = false;
                                this.dataNomina = "";
                                this.dataConsultas = "";
                            }
                        })
                        .catch(err => console.log(err));
                } else if (this.tipoReporte === "Nomina") {
                    await axios
                        .post("/nomina/busqueda", this.busqueda)
                        .then(res => {
                            this.dataNomina = res.data;
                            console.log(res.data);
                            if (Object.keys(res.data).length > 0) {
                                this.mostrarNomina = true;
                                this.mostrarCaja = false;
                                this.mostrarConsulta = false;
                                this.dataCajaChica = "";
                                this.dataConsultas = "";
                            }
                        })
                        .catch(err => console.log(err));
                } else if (this.tipoReporte === "Consultas") {
                    await axios
                        .post("/consultas/reporte", this.busqueda)
                        .then(res => {
                            this.dataConsultas = res.data;
                            console.log(res.data);
                            if (Object.keys(res.data).length > 0) {
                                this.mostrarConsulta = true;
                                this.mostrarCaja = false;
                                this.mostrarNomina = false;
                                this.dataCajaChica = "";
                                this.dataNomina = "";
                            }
                        })
                        .catch(err => console.log(err));
                }
            } else {
                this.$swal.fire({
                    icon: "error",
                    title: "Debe llenar todos los campos de busqueda.",
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
