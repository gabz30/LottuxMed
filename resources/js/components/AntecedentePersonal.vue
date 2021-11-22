<template>
    <div>
        <div
            class="alert alert-success alert-dismissible fade show"
            role="alert"
        >
            <strong>Informacion </strong> personal
        </div>

        <form>
            <div class="form-group">
                <label for="exampleInputEmail1"
                    ><i class="fas fa-info-circle"></i> Antecedentes</label
                >
                <textarea
                    type="text"
                    class="form-control"
                    rows="3"
                    v-model="resultado.antecedentes"
                ></textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1"
                    ><i class="fas fa-virus"></i> Alergias</label
                >
                <input
                    type="text"
                    class="form-control"
                    v-model="resultado.alergias"
                />
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1"
                    ><i class="fas fa-comments"></i> Obervaciones</label
                >
                <textarea
                    type="text"
                    class="form-control"
                    rows="5"
                    v-model="resultado.observaciones"
                ></textarea>
            </div>

            <div v-if="editar">
                <button
                    type="button"
                    class="btn btn-success btn-block"
                    @click="actualizar"
                >
                    <i class="fas fa-sync-alt"></i> Actualizar
                </button>
            </div>
            <div v-else>
                <button
                    type="button"
                    class="btn btn-primary btn-block"
                    @click="guardar"
                >
                    <i class="fas fa-save"></i> Guardar
                </button>
            </div>
        </form>
    </div>
</template>
<script>
export default {
    props: ["user_id"],
    data() {
        return {
            editar: false,
            formulario: [
                {
                    user_id: 1,
                    antecedentes: "",
                    alergias: "",
                    observaciones: ""
                }
            ],
            resultado: {
                antecedentes: "",
                alergias: "",
                observaciones: ""
            }
        };
    },
    methods: {
        guardar() {
            const data = {
                user_id: this.formulario.user_id,
                antecedentes: this.resultado.antecedentes,
                alergias: this.resultado.alergias,
                observaciones: this.resultado.observaciones
            };

            axios
                .post("/antecedentes", data)
                .then(response => {
                    console.log(response);

                    this.$swal.fire({
                        // position: "top-end",
                        icon: "success",
                        title: "Guardado correctamento!",
                        showConfirmButton: false,
                        timer: 1300
                    });
                })
                .catch(err => console.log(err));
        },

        actualizar() {
            const data = {
                user_id: this.formulario.user_id,
                antecedentes: this.resultado.antecedentes,
                alergias: this.resultado.alergias,
                observaciones: this.resultado.observaciones
            };

            if (data.antecedentes || data.alergias || data.observaciones) {

                console.log(data);
                axios
                    .put("/antecedentes/" + data.user_id, data)
                    .then(response => {
                        console.log(response);

                        this.$swal.fire({
                            icon: "success",
                            title: "Actualizado correctamento!",
                            showConfirmButton: false,
                            timer: 1200
                        });
                    })
                    .catch(err => console.log(err));
            }else{

                 this.$swal.fire({
                            // position: "top-end",
                            icon: "error",
                            title: "Error. Debes completar alguno de los campos.",
                            showConfirmButton: false,
                            timer: 1300
                        });

            }
        }
    },
    mounted() {
        this.formulario.user_id = this.user_id;

        axios
            .get("/antecedentes/" + this.formulario.user_id)
            .then(response => {
                console.log(response);

                this.resultado.antecedentes = response.data[0].antecedentes;
                this.resultado.alergias = response.data[0].alergias;
                this.resultado.observaciones = response.data[0].observaciones;

                console.log("Hay data");

                this.editar = true;
            })
            .catch(err => {
                console.log(err);

                console.log("No hay data");
                this.editar = false;
            });
    }
};
</script>
