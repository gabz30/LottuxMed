<template>
    <div>
        <div
            class="alert alert-success alert-dismissible fade show"
            role="alert"
        >
            <strong>Historia</strong> familiar
            <button
                type="button"
                class="close"
                data-dismiss="alert"
                aria-label="Close"
            >
                <!-- <span aria-hidden="true"
                    ><a class="btn btn-dark btn-sm ">Editar</a></span
                > -->
            </button>
        </div>

        <div id="accordion">
            <div class="card">
                <div class="card-header" id="headingTwo">
                    <h5 class="mb-0">
                        <h3>
                            Antecedentes
                        </h3>
                    </h5>
                </div>
                <div
                    id="collapseTwo"
                    aria-labelledby="headingTwo"
                    data-parent="#accordion"
                >
                    <div class="card-body">
                        <label for="">Lista de enfermedades:</label>

                        <div class="input-group">
                            <select
                                class="custom-select"
                                id="inputGroupSelect04"
                                v-model="familiar.enfermedades"
                            >
                                <option
                                    v-for="item in dataEnfermedades"
                                    :key="item.id"
                                    v-bind:value="item.id"
                                    >{{ item.nombre }}
                                </option>
                            </select>
                            <div class="input-group-append">
                                <input
                                    type="text"
                                    class="form-control"
                                    v-model="familiar.parentesco"
                                    placeholder="Parentesco"
                                />
                            </div>
                            <div class="input-group-append mb-3">
                                <button
                                    class="btn btn-info"
                                    type="button"
                                    @click="listar"
                                >
                                    <i class="far fa-arrow-alt-circle-down"></i>
                                    Agregar
                                </button>
                            </div>
                        </div>

                        <ul class="list-group">
                            <li
                                v-for="item in dataEnfermedadesFamiliares"
                                :key="item.id"
                                class="list-group-item list-group-item-primary"
                            >
                                {{ item.enfermedades.nombre }}

                                -
                                <span class="alert-link" v-if="item.parentesco">
                                    {{ item.parentesco }}
                                </span>
                                <span class="alert-link" v-else>Paciente</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ["user_id"],
    mounted() {
        this.formulario.user_id = this.user_id;
        this.traerInfo();
        this.traerEnfermedades();
    },

    data() {
        return {
            formulario: {
                user_id: 1,
                POtras: "",
                PEnfermedades: [],
                guardo: 0
            },
            familiar: {
                enfermedades: 0,
                parentesco: ""
            },
            mostrarFamiliar: [
                {
                    enfer: "",
                    parent: ""
                }
            ],
            mostrar: [],
            dataEnfermedades: [],
            dataEnfermedadesFamiliares: []
        };
    },
    methods: {
        async traerEnfermedades() {
            await axios
                .get("/enfermedades")
                .then(res => {
                    // console.log(res.data);
                    this.dataEnfermedades = res.data;
                })
                .catch(err => console.log(err));
        },
        async traerInfo() {
            await axios
                .get("/antecedentes/familiares/ " + this.formulario.user_id)
                .then(res => {
                    // this.mostrarFamiliar.enfer = res.data.enfermedad;
                    // this.mostrarFamiliar.parent = res.data.parentesco;

                    this.dataEnfermedadesFamiliares = res.data;

                    this.mostrarFamiliar.push({
                        enfer: res.data.enfermedad,
                        parent: res.data.parentesco
                    });
                })
                .catch(err => console.log(err));
        },
        async listar() {
            if (this.familiar.enfermedades <= 0) {
                this.$swal.fire({
                    icon: "error",
                    title: "",
                    showConfirmButton: false,
                    timer: 700
                });

                this.familiar.parentesco = "";
            } else {
                this.mostrar.push({
                    efe: this.familiar.enfermedades,
                    pare: this.familiar.parentesco
                });

                // console.log(this.mostrar);

                const data = {
                    enfermedad_id: this.familiar.enfermedades,
                    user_id: this.formulario.user_id,
                    parentesco: this.familiar.parentesco
                };

                await axios
                    .post("/antecedentes/familiares", data)
                    .then(response => {
                        // console.log(response);
                        // // this.formulario.guardo = 1;

                        this.traerInfo();
                        this.familiar.parentesco = "";
                    })
                    .catch(err => console.log(err));
            }
        },
        async guardar() {
            // alert(JSON.stringify(this.formulario));

            this.formulario.PEnfermedades.forEach((value, index) => {
                //console.log(index +" "+value);

                const data = {
                    enfermedad: value,
                    user_id: this.formulario.user_id,
                    descripcion:
                        value === "Otras" ? this.formulario.POtras : "",
                    parentesco: "YO"
                };

                axios
                    .post("/pacientes", data)
                    .then(response => {
                        console.log(response);
                        this.formulario.guardo = 1;
                    })
                    .catch(err => console.log(err));
            });

            this.formulario.guardo === 0
                ? this.$swal.fire({
                      position: "top-end",
                      icon: "success",
                      title: "Guardado correctamento!",
                      showConfirmButton: false,
                      timer: 1300
                  })
                : console.log("no guardo");
        }
    }
};
</script>
