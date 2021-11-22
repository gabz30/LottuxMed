<template>
    <div>
        <!-- <input
            type="text"
            autocomplete="off"
            v-model="state"
            @input="filterStates"
            @focus="modal = true"
            class="form-control"
        />

        <div v-if="filteredStates && modal">
            <ul class="list-group mb-5">
                <li
                    v-for="item in filteredStates"
                    :key="item.id"
                    @click="setState(filteredStates)"
                    class="list-group-item list-group-item-success"
                >
                    {{ item }}
                </li>
            </ul>
        </div> -->

        <div class="form-row mt-5">
            <div class="form-group col-md-6">
                <label for="inputCity">Fecha de inicio de los sintomas</label>
                <input
                    type="date"
                    class="form-control"
                    v-model="formulario.fecha_inicio"
                />
            </div>
            <div class="form-group col-md-3 text-danger font-weight-bold">
                <label for="inputState">Tipo de consulta</label>

                <select
                    class="custom-select"
                    v-model="formulario.tipo_consulta_id"
                    @change="handleChange()"
                >
                    <option value="" disabled>Eliga una...</option>
                    <option value="1">Consulta</option>
                    <option value="2">Emergencia</option>
                    <option value="3">Internamiento Normal</option>
                    <option value="4">Internamiento Uci</option>
                </select>
            </div>
            <div class="form-group col-md-12 text-danger font-weight-bold">
                <label for="inputCity">Sintomas </label>
                <textarea
                    rows="3"
                    class="form-control"
                    v-model="formulario.sintomas"
                ></textarea>
            </div>
            <div class="form-group col-md-6">
                <label for="inputCity">Exploracion fisica</label>
                <textarea
                    rows="3"
                    class="form-control"
                    v-model="formulario.exploracion_fisica"
                ></textarea>
            </div>
            <div class="form-group col-md-6">
                <label for="inputCity">Estudios de laboratorio</label>
                <textarea
                    rows="3"
                    class="form-control"
                    v-model="formulario.estudios_lab"
                ></textarea>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="inputCity">Dr. que refiere</label>
                <input
                    type="text"
                    class="form-control"
                    v-model="formulario.drrefiere"
                />
            </div>

            <div class="form-group col-md-3">
                <label for="inputZip">Presion</label>
                <input
                    type="text"
                    class="form-control"
                    v-model="formulario.presion"
                />
            </div>
            <div class="form-group col-md-3">
                <label for="inputCity">Peso</label>
                <input
                    type="number"
                    class="form-control"
                    v-model="formulario.peso"
                />
            </div>
            <div class="form-group col-md-3">
                <label for="inputZip">Temperatura</label>
                <input
                    type="number"
                    min="34"
                    max="42"
                    class="form-control"
                    v-model="formulario.temperatura"
                />
            </div>
        </div>

        <div v-if="mostrar.medicamentos" class="card-body shadow border">
            <label for="">Medicamentos:</label>

            <div class="input-group row">
                <div class="col-md-4">
                    <select
                        class="custom-select"
                        id="inputGroupSelect04"
                        v-model="medicamentos.id"
                    >
                        <option
                            v-for="item in dataMedicamentos"
                            :key="item.id"
                            v-bind:value="item.id"
                            >{{ item.id }} - {{ item.descripcion }}
                        </option>
                    </select>
                </div>

                <div class="col-md-6">
                    <div class="input-group-append">
                        <input
                            v-model="medicamentos.prescripcion"
                            type="text"
                            class="form-control"
                            placeholder="Prescripcion"
                        />
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="input-group-append mb-3">
                        <button
                            class="btn btn-dark"
                            type="button"
                            @click="agregarMedicamento()"
                        >
                            <i class="far fa-arrow-alt-circle-down"></i>
                            Agregar
                        </button>
                    </div>
                </div>
            </div>

            <ul class="list-group">
                <li
                    v-for="item in medicamentosAgregados"
                    :key="item.id"
                    class="list-group-item list-group-item-primary"
                >
                    <button
                        class="btn btn-danger btn-sm text-right mr-2"
                        @click="eliminarDeReceta(item.medicamento_id)"
                    >
                        x
                    </button>
                    <span class="alert-link"> {{ item.medicamento_id }}</span>
                    - {{ item.prescripcion }}
                </li>

                <div v-if="medicamentosAgregados != ''">
                    <button class="btn btn-success btn-sm mt-2">
                        <i class="fas fa-print"></i> Imprimir receta
                    </button>
                </div>
            </ul>
        </div>

        <div class="card-body" v-if="mostrar.estudios">
            <label for="">Estudios interconsulta:</label>

            <div class="input-group">
                <select
                    class="custom-select"
                    id="inputGroupSelect04"
                    @change="someHandler"
                    v-model="estudios.interconsulta_id"
                >
                    <option
                        v-for="item in dataEstudios"
                        :key="item.id"
                        v-bind:value="item.id"
                        >{{ item.id }} - {{ item.descripcion }}
                    </option>
                </select>
                <div class="input-group-append">
                    <input
                        type="text"
                        class="form-control"
                        v-model="estudios.precio"
                    />
                </div>
                <div class="input-group-append mb-3">
                    <button
                        class="btn btn-info"
                        type="button"
                        @click="agregarEstudio"
                    >
                        <i class="far fa-arrow-alt-circle-down"></i>
                        Agregar
                    </button>
                </div>
            </div>

            <ul class="list-group">
                <li
                    v-for="item in estudiosAgregados"
                    :key="item.id"
                    class="list-group-item list-group-item-primary"
                >
                    <button
                        class="btn btn-danger btn-sm text-right mr-2"
                        @click="eliminarEstudio(item.interconsulta_id)"
                    >
                        x
                    </button>
                    <span class="alert-link"> {{ item.interconsulta_id }}</span>
                    - {{ item.precio }}
                </li>
            </ul>
        </div>

        <div
            v-if="mostrar.comentario"
            class="bg-success px-3 py-3 font-weight-bold"
        >
            <label for="">Comentario para la secretaria</label>
            <textarea
                class="form-control"
                v-model="formulario.comentario"
                cols="30"
                rows="4"
            ></textarea>
        </div>

        <hr />
        <button
            type="button"
            class="btn btn-primary btn-block mb-2"
            @click="guardar"
        >
            <i class="fas fa-save"></i> Guardar
        </button>
    </div>
</template>
<script>
const moment = require("moment");

export default {
    props: {
        doctor: String,
        user_id: String
    },

    mounted() {
        const fecha_actual = moment(new Date()).format("yyyy-MM-DD");

        this.formulario.user_id = this.user_id;
        this.formulario.drID = this.doctor;
        this.formulario.fecha_inicio = fecha_actual;
        this.fecha_actual = fecha_actual;

        // if (!this.drID) {
        //     this.formulario.drID = 1;
        // }

        // alert(this.user_id + " => " + this.doctor);

        this.getCarga();
    },
    data() {
        return {
            estudios: {
                id: 0,
                descripcion: "",
                interconsulta_id: 0,
                precio: 0
            },
            dataEnfermedades: [],
            dataEstudios: [],
            dataMedicamentos: [],
            medicamentos: {
                // medicamentoId: 0,
                descripcion: "",
                prescripcion: ""
            },
            medicamentosAgregados: [],
            estudiosAgregados: [],
            consultaId: 0,
            formulario: {
                user_id: 2,
                drrefiere: "",
                sintomas: "",
                exploracion_fisica: "",
                presion: 0,
                temperatura: 0,
                peso: 0,
                estudios_lab: "",
                comentario: "",
                fecha_inicio: "",
                tipo_consulta_id: 0,
                drID: 1
            },
            fecha_actual: "",
            mostrar: {
                comentario: true,
                medicamentos: true,
                estudios: true
            }
        };
    },
    methods: {
        async getCarga() {
            await axios
                .get("/enfermedades")
                .then(res => {
                    console.log(res.data);
                    this.dataEnfermedades = res.data;
                    // this.states = res.data;
                    // console.log(this.state);
                })
                .catch(err => console.log(err));

            await axios
                .get("/medicamentos")
                .then(res => {
                    console.log(res.data);
                    this.dataMedicamentos = res.data;
                    // this.states = res.data;
                    // console.log(this.state);
                })
                .catch(err => console.log(err));

            await axios
                .get("/estudios")
                .then(res => {
                    // console.log(res.data);
                    this.dataEstudios = res.data;
                    // this.states = res.data;
                    // console.log(this.state);
                })
                .catch(err => console.log(err));
        },
        async guardar() {
            // console.log(this.formulario);

            const data = {
                drID: this.formulario.drID,
                user_id: this.formulario.user_id,
                drrefiere: this.formulario.drrefiere,
                sintomas: this.formulario.sintomas,
                exploracion_fisica: this.formulario.exploracion_fisica,
                temperatura: this.formulario.temperatura,
                presion: this.formulario.presion,
                peso: this.formulario.peso,
                estudios_lab: this.formulario.estudios_lab,
                comentario: this.formulario.comentario,
                fecha_sintomas: this.formulario.fecha_inicio,
                tipo_consulta_id: this.formulario.tipo_consulta_id,
                estatus: 0
            };

            if (data.user_id && data.sintomas && data.tipo_consulta_id) {
                await axios
                    .post("/consultas", data)
                    .then(response => {
                        console.log(response);

                        this.$swal.fire({
                            icon: "success",
                            title: "Consulta guardada correctamente!",
                            showConfirmButton: false
                            // timer: 1300
                        });

                        this.consultaId = response.data.id;

                        // Cambiamos el estado de la lista de espera a 0

                        axios
                            .put("/lista-espera/" + this.formulario.user_id, {
                                estatus: 0
                            })
                            .then(res => {
                                console.log("La que estamos probando =>");
                                console.log(res.data);
                            })
                            .catch(err => console.log(err));
                    })
                    .catch(err => {
                        console.log(err);
                        this.$swal.fire({
                            icon: "error",
                            title: "Error. No se pudo guardar la informacion.",
                            showConfirmButton: false,
                            timer: 1300
                        });
                    });

                if (this.consultaId !== 0) {
                    //guardar la receta para este usuario
                    this.medicamentosAgregados.forEach((value, index) => {
                        const datos = {
                            consulta_id: this.consultaId,
                            user_id: this.formulario.user_id,
                            medicamento_id: value.medicamento_id,
                            prescripcion: value.prescripcion
                        };

                        axios.post("/recetas", datos).then(res => {
                            console.log(res);
                            // this.$swal.fire({
                            //     icon: "success",
                            //     title: "Consulta guardada correctamento!",
                            //     showConfirmButton: false,
                            //     timer: 1300
                            // });
                        });
                    });

                    this.estudiosAgregados.forEach((value, index) => {
                        const datos = {
                            consulta_id: this.consultaId,
                            // descripcion: value.descripcion,
                            interconsulta_id: value.interconsulta_id,
                            precio: value.precio
                        };

                        axios.post("/estudios-realizados", datos).then(res => {
                            console.log(res);
                            // this.$swal.fire({
                            //     icon: "success",
                            //     title: "Consulta guardada correctamento!",
                            //     showConfirmButton: false,
                            //     timer: 1300
                            // });
                        });
                    });
                } else {
                    console.log("Error al guardar la consutla");
                }

                //  window.location.href =
                //             window.location.origin +
                //             "/pacientes/historia/" +
                //             this.formulario.user_id;

                setTimeout(() => {
                    window.location.href =
                        window.location.origin + "/busqueda/farmacias";
                }, 1000);
            } else {
                this.$swal.fire({
                    icon: "error",
                    title: "Los campos marcados en rojo deben ser completados.",
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        },

        someHandler() {
            // alert("click en " + this.estudios.id);
            // console.log(this.dataEstudios)

            const arreglo = this.dataEstudios;
            // let persona = arreglo.find(
            //     elemento => elemento.descripcion == this.estudios.descripcion
            // );
            let persona = arreglo.find(
                elemento => elemento.id == this.estudios.interconsulta_id
            );

            console.log("persona => ");
            console.log(arreglo);
            this.estudios.precio = persona.precio;
            // alert(JSON.stringify(persona));
        },
        agregarEstudio() {
            if (!this.estudios.precio) {
                this.$swal.fire({
                    icon: "error",
                    title: "Debe completar todos los campos.",
                    showConfirmButton: false,
                    timer: 1300
                });
            } else {
                this.estudiosAgregados.push({
                    // id: this.medicamentos.medicamentoId,
                    // descripcion: this.estudios.descripcion,
                    interconsulta_id: this.estudios.interconsulta_id,
                    precio: this.estudios.precio
                });

                this.estudios.descripcion = "";
            }

            // console.log(this.medicamentosAgregados);
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
        eliminarEstudio(variable) {
            let arr = this.estudiosAgregados;
            this.estudiosAgregados = [];

            arr.filter(item => {
                if (item.interconsulta_id !== variable) {
                    this.estudiosAgregados.push({
                        // descripcion: item.descripcion,
                        // prescripcion: item.prescripcion
                        interconsulta_id: item.interconsulta_id,
                        precio: item.precio
                    });
                }
                // if (item.descripcion !== variable) {
                //     this.estudiosAgregados.push({
                //         descripcion: item.descripcion,
                //         prescripcion: item.prescripcion
                //     });
                // }
            });

            // console.log(result);
        },
        handleChange() {
            if (this.formulario.tipo_consulta_id == 3) {
                this.mostrar.medicamentos = false;
                this.mostrar.comentario = false;
                this.mostrar.estudios = false;
            } else {
                this.mostrar.medicamentos = true;
                this.mostrar.comentario = true;
                this.mostrar.estudios = true;
            }
        }
    }
};
</script>
