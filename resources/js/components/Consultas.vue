<template>
    <div>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-9 pb-3 ">

                    
                    <div
                        class="alert alert-success my-3 shadow border"
                        role="alert"
                        v-for="item in pagination.data"
                        :key="item.id"
                    >
                        <h3>
                            <div class="row">
                                <div class="col-md-10">
                                    <span class="badge badge-danger shadow my-2"
                                        >{{ haceQueTiempo(item.created_at) }}
                                        <h6
                                            class="text-dark font-weight-bold mt-1"
                                        >
                                            {{ arreglarFecha(item.created_at) }}
                                        </h6></span
                                    >
                                    -
                                    <b v-if="item.user.sexo === 1">DR. </b>
                                    <b v-else>DRa. </b>
                                    <b>{{ item.user.name }}</b>
                                </div>

                                <div class="col-md-2 text-right">
                                    <span
                                        class="badge badge-danger shadow my-2"
                                        v-if="
                                            item.tipo_consulta_id === 3 ||
                                                item.tipo_consulta_id === 4
                                        "
                                    >
                                        Interno
                                    </span>
                                </div>
                            </div>
                        </h3>
                        <h4>
                            <b>Fecha de inicio de los sintomas: </b
                            ><span class="badge badge-warning"
                                >{{ arreglarFecha(item.fecha_sintomas) }}
                            </span>
                        </h4>
                        <hr />

                        <div v-if="item.sintomas">
                            <h4
                                class="alert-heading text-dark font-weight-bold"
                            >
                                Sintomas
                            </h4>
                            {{ item.sintomas }}

                            <hr />
                        </div>

                        <div v-if="item.drrefiere">
                            <h4
                                class="alert-heading text-dark font-weight-bold"
                            >
                                Dr. que refiere
                            </h4>
                            {{ item.drrefiere }}
                            <hr />
                        </div>

                        <div
                            v-if="
                                item.peso != 0 ||
                                    item.temperatura != 0 ||
                                    item.presion != 0
                            "
                        >
                            <h4
                                class="alert-heading text-dark font-weight-bold"
                            >
                                Signos vitales
                            </h4>
                            Presion: {{ item.presion }} || Peso:
                            {{ item.peso }} || Temperatura:
                            {{ item.temperatura }}
                            <hr />
                        </div>

                        <div v-if="item.estudios_lab">
                            <h4
                                class="alert-heading text-dark font-weight-bold"
                                
                            >
                                Estudios de laboratorio
                            </h4>
                            {{ item.estudios_lab }}
                            <hr />
                        </div>
                        <div v-if="item.estudios_realizados">
                            <h4
                                class="alert-heading text-dark font-weight-bold"
                            >
                                Estudios de interconsulta
                            </h4>
                            <div
                                v-for="elemento in item.estudios_realizados"
                                :key="elemento.id"
                            >
                                {{
                                    elemento.estudios_interconsulta.descripcion
                                }}
                            </div>
                            <hr />
                        </div>

                        <button
                            type="button"
                            class="btn btn-primary"
                            data-toggle="modal"
                            data-target="#exampleModalLong"
                            @click="mostrarRecetas(item.id)"
                        >
                            Mostrar <b>receta</b>
                        </button>

                        <button
                            class="btn btn-secondary"
                            @click="agregarAConsulta(item.id)"
                        >
                            <i class="fas fa-plus"></i> Agregar estudios /
                            receta
                        </button>

                        <hr />

                        <div >
                            <div
                                class="alert alert-primary shadow my-2"
                                role="alert"
                                v-for="extra in item.extra_consulta"
                                :key="extra.id"
                            >
                                <div class="badge badge-primary mb-2">
                                    {{ arreglarFecha(extra.created_at) }}
                                </div>
                                <h4 v-if="extra.exploracion_fisica">
                                    Exploracion fisica:
                                    {{ extra.exploracion_fisica }}
                                </h4>
                                <p v-if="extra.estudios_lab">
                                    Estudios de laboratorio:
                                    {{ extra.estudios_lab }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <pagination :data="pagination" @pagination-change-page="getResults"></pagination>

                </div>
            </div>
        </div>

        <div
            class="modal fade"
            id="modalAgregarAConsulta"
            tabindex="-1"
            role="dialog"
            aria-labelledby="exampleModalLongTitle"
            aria-hidden="true"
        >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            Agregar informacion a la consulta
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
                        <label for="">Estudios de laboratorio</label>
                        <textarea
                            class="form-control"
                            rows="4"
                            v-model="estudios_lab"
                        ></textarea>

                        <label class="mt-2">Exploracion fisica</label>
                        <textarea
                            class="form-control"
                            rows="2"
                            v-model="exploracion_fisica"
                        ></textarea>

                        <label class="mt-2">Medicamentos</label>

                        <div class="row col-md-12">
                            <div class="col-md-5">
                                <select
                                    class="custom-select"
                                    id="inputGroupSelect04"
                                    v-model="medicamentos.id"
                                >
                                    <option
                                        v-for="item in dataMedicamentos"
                                        :key="item.id"
                                        v-bind:value="item.id"
                                        >{{ item.id }} -
                                        {{ item.descripcion }}
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-5">
                                <input
                                    v-model="medicamentos.prescripcion"
                                    type="text"
                                    class="form-control"
                                    placeholder="Prescripcion"
                                />
                            </div>
                            <div class="col-md-2">
                                <button
                                    class="btn btn-dark"
                                    type="button"
                                    @click="agregarMedicamento()"
                                >
                                    <i class="far fa-arrow-alt-circle-down"></i>
                                </button>
                            </div>
                        </div>

                        <ul class="list-group mt-3">
                            <li
                                v-for="item in medicamentosAgregados"
                                :key="item.id"
                                class="list-group-item list-group-item-primary"
                            >
                                <button
                                    class="btn btn-danger btn-sm text-right mr-2"
                                    @click="
                                        eliminarDeReceta(item.medicamento_id)
                                    "
                                >
                                    x
                                </button>
                                <span class="alert-link">
                                    {{ item.medicamento_id }}</span
                                >
                                - {{ item.prescripcion }}
                            </li>
                        </ul>
                    </div>

                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary btn-md"
                            data-dismiss="modal"
                        >
                            Cerrar
                        </button>

                        <button
                            type="button"
                            class="btn btn-primary btn-md"
                            @click="guardarExtra"
                        >
                            <i class="fas fa-plus"></i> Agregar
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div
            class="modal fade"
            id="exampleModalLong"
            tabindex="-1"
            role="dialog"
            aria-labelledby="exampleModalLongTitle"
            aria-hidden="true"
        >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            Receta
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
                        <ul class="list-group">
                            <li
                                v-for="item in dataReceta"
                                :key="item.id"
                                class="list-group-item list-group-item-primary"
                            >
                                <span class="alert-link">{{
                                    item.medicamentos.descripcion
                                }}</span>
                                - {{ item.prescripcion }}
                            </li>
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary btn-md"
                            data-dismiss="modal"
                        >
                            Cerrar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
const moment = require("moment");
moment.locale("es");
export default {
    props: {
        user_id: String
    },
    // props: ["user_id"],["doctor"],
    mounted() {
        // console.log("Mounted");

        this.formulario.user_id = this.user_id;
        this.formulario.doctor = this.doctor;

        this.consultar();
        this.carga();
        this.cargarExtras();
    },

    data() {
        return {
            estudios_lab: "",
            exploracion_fisica: "",

            formulario: {
                user_id: 1,
                drrefiere: "",
                created_at: "",
                estudios_lab: "",
                exploracion_fisica: "",
                fecha_sintomas: "",
                consulta_id: "",
                peso: "",
                sintomas: "",
                temperatura: "",
                tipo_consulta_id: "",
                doctor: ""
            },
            dataMedicamentos: [],
            medicamentos: {
                id: 0,
                prescripcion: ""
            },
            medicamentosAgregados: [],
            data: [],
            id_consulta: 0,
            dataReceta: [],
            pagination: {}
        };
    },
    computed: {
        contarExtraConsulta()
        {
            // alert( this.array )
            // return this.array;
        }
    },
    methods: {
        async consultar() {
            this.getResults();
            // await axios
            //     .get("/consultas/" + this.user_id)
            //     .then(res => {
            //         this.data = res.data.data;

            //         console.log(this.data);
            //     })
            //     .catch(err => console.log(err));

            // // awai axios.get('/estudios-realizados/'+)
        },

        async getResults(page = 1) {
            axios
                .get(`/consultas/${this.user_id}?page=${page}`)
                .then(response => {
                    this.pagination = response.data;
                    console.log( response.data )
                });
        },
        async carga() {
            await axios
                .get("/medicamentos")
                .then(res => {
                    // console.log(res.data);
                    this.dataMedicamentos = res.data;
                    // this.states = res.data;
                    // console.log(this.state);
                })
                .catch(err => console.log(err));
        },

        mostrarRecetas(id_consulta) {
            // alert('consulta id: '+id_consulta);
            this.id_consulta = id_consulta;
            axios
                .get("/consulta/recetas/" + id_consulta)
                .then(res => {
                    console.log(res.data);
                    this.dataReceta = res.data;

                    // $('#modalMasInfo').modal('show');
                })
                .catch(err => console.log(err));
        },
        agregarAConsulta(IDconsulta) {
            // alert(IDconsulta);
            this.formulario.consulta_id = IDconsulta;
            // alert(this.formulario.consulta_id);
            $("#modalAgregarAConsulta").modal("show");
        },
        agregarMedicamento() {
            if (!this.medicamentos.prescripcion) {
                this.$swal.fire({
                    icon: "error",
                    title: "Debe completar todos los campos.",
                    showConfirmButton: false,
                    timer: 1300
                });
            } else {
                this.medicamentosAgregados.push({
                    // id: this.medicamentos.medicamentoId,
                    medicamento_id: this.medicamentos.id,
                    prescripcion: this.medicamentos.prescripcion
                });

                console.log(this.medicamentosAgregados);

                this.medicamentos.prescripcion = "";
            }

            // console.log(this.medicamentosAgregados);
        },
        eliminarDeReceta(variable) {
            let arr = this.medicamentosAgregados;
            this.medicamentosAgregados = [];

            arr.filter(item => {
                if (item.medicamento_id !== variable) {
                    this.medicamentosAgregados.push({
                        medicamento_id: item.medicamento_id,
                        prescripcion: item.prescripcion
                    });
                }
            });

            // console.log(result);
        },
        guardarExtra() {
            const extra = {
                consulta_id: this.formulario.consulta_id,
                estudios_lab: this.estudios_lab,
                exploracion_fisica: this.exploracion_fisica
            };

            axios
                .post("/extra-consultas", extra)
                .then(res => console.log(res.data))
                .catch(err => console.log(err));

            if (this.medicamentosAgregados) {
                this.medicamentosAgregados.forEach((value, index) => {
                    const datos = {
                        consulta_id: this.formulario.consulta_id,
                        user_id: this.formulario.user_id,
                        medicamento_id: value.medicamento_id,
                        prescripcion: value.prescripcion
                    };

                    console.log(datos);

                    axios.post("/recetas", datos).then(res => {
                        console.log(res);
                    });
                });

                this.$swal.fire({
                    icon: "success",
                    title: "Agregado con exito!",
                    showConfirmButton: false,
                    timer: 1300
                });
            }

            this.estudios_lab = "";
            this.exploracion_fisica = "";
            this.medicamentosAgregados = [];

            this.consultar();
            $("#modalAgregarAConsulta").modal("hide");
        },

        cargarExtras() {
            // axios.get('/extra-consultas')
        },
        arreglarFecha(fecha) {
            return moment(fecha).format("DD MMMM yyyy");
        },
        haceQueTiempo(fecha) {
            // fr.locale('en');
            // fr.localeData().months(moment([2012, 0])) // "January"

            // return moment([fecha]).format("MMM Do YY")

            return moment([fecha], "YYYYMMDD").fromNow();
        }
    }
};
</script>
