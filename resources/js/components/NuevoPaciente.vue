<template>
    <div>
        <h1 class="alert alert-primary mt-2" role="alert">
            Registro de nuevo paciente
        </h1>

        <div class="form-row mt-5">
            <div class="form-group col-md-6">
                <label for="inputCity">Nombre y Apellido</label>
                <input
                    type="text"
                    class="form-control"
                    v-model="formulario.name"
                />
            </div>

            <div class="form-group col-md-6">
                <label for="inputCity">Cedula</label>
                <input
                    type="text"
                    class="form-control"
                    v-model="formulario.cedula"
                />
            </div>

            <div class="form-group col-md-6">
                <label for="inputCity">Celular</label>
                <input
                    type="text"
                    class="form-control"
                    v-model="formulario.celular"
                />
            </div>

            <div class="form-group col-md-6">
                <label for="inputCity">Telefono</label>
                <input
                    type="text"
                    class="form-control"
                    v-model="formulario.telefono"
                />
            </div>

            <div class="form-group col-md-6">
                <label for="inputCity">Email</label>
                <input
                    type="text"
                    class="form-control"
                    v-model="formulario.email"
                />
            </div>

            <div class="form-group col-md-6">
                <label for="inputCity">Direccion</label>
                <input
                    type="text"
                    class="form-control"
                    v-model="formulario.direccion"
                />
            </div>

            <div class="form-group col-md-3">
                <label for="inputCity">Fecha de nacimiento</label>
                <input
                    type="date"
                    class="form-control"
                    v-model="formulario.fecha_nacimiento"
                />
            </div>

            <div class="form-group col-md-3">
                <label for="inputCity">Ocupacion</label>
                <select
                    name=""
                    id=""
                    class="form-control"
                    v-model="formulario.ocupacion_id"
                >
                    <option value="1">Estudiante</option>
                    <option value="2">Empleado</option>
                    <option value="3">Desempleado</option>
                    <option value="4">Comerciante</option>
                    <option value="5">Otros</option>
                </select>
            </div>

            <div class="form-group col-md-3">
                <label for="inputCity">Estado Civil</label>
                <select
                    name=""
                    id=""
                    class="form-control"
                    v-model="formulario.estado_civil_id"
                >
                    <option value="1">Solter0</option>
                    <option value="2">Comprometido</option>
                    <option value="3">Casado</option>
                    <option value="4">Union Libre</option>
                    <option value="5">Divorciado</option>
                    <option value="6">Viudo</option>
                </select>
            </div>
            <div class="form-group col-md-3">
                <label for="inputCity">Sexo</label>
                <select
                    name=""
                    id=""
                    class="form-control"
                    v-model="formulario.sexo"
                >
                    <option value="1">Masculino</option>
                    <option value="2">Femenino</option>
                </select>
            </div>

            <div
                class="border col-md-12 form-row my-3 border-right-0 border-left-0"
            >
                <div class="form-group col-md-2 my-3">
                    <label for="inputCity">Grupo sanguineo</label>
                    <select
                        name=""
                        id=""
                        class="form-control"
                        v-model="formulario.grupo_sanguineo_id"
                    >
                        <option value="1">A +</option>
                        <option value="2">B +</option>
                        <option value="3">O +</option>
                        <option value="4">AB +</option>
                        <option value="5">A -</option>
                        <option value="6">B -</option>
                        <option value="7">O -</option>
                        <option value="8">AB -</option>
                    </select>
                </div>

                <div class="form-group col-md-2 my-3">
                    <label for="inputCity">Estatura</label>
                    <input
                        type="text"
                        class="form-control"
                        v-model="formulario.estatura"
                    />
                </div>

                <div class="form-group col-md-5 my-3">
                    <label for="">Imagen</label>
                    <div class="custom-file">
                        <input
                            type="file"
                            class="custom-file-input"
                            id="validatedCustomFile"
                            required
                        />
                        <label
                            class="custom-file-label"
                            for="validatedCustomFile"
                            >Elije una imagen</label
                        >
                    </div>
                </div>
                <div class="form-group col-md-3 my-3">
                    <label for="">Es familiar de un Doctor?</label>
                    <input
                        type="checkbox"
                        class="form-control"
                        v-model="formulario.familiar_doctor"
                    />
                </div>
            </div>

            <div
                class="alert alert-success col-md-12 mt-3 shadow p-3 mb-5 rounded"
                role="alert"
            >
                <h2 class="alert-heading mb-2 text-center">
                    Datos de la aseguradora
                </h2>
                <hr />
                <div class="form-row">
                    <div class="form-group col-md-4 mt-2">
                        <label for="inputCity">Aseguradora</label>
                        <select
                            name=""
                            id=""
                            class="form-control"
                            v-model="formulario.aseguradora_id"
                        >
                            <option value="1">Maphre</option>
                            <option value="2">Popular</option>
                            <option value="3">ARS Humano</option>
                            <option value="4">Maphre</option>
                            <option value="5">Popular</option>
                        </select>
                    </div>

                    <div class="form-group col-md-4 mt-2">
                        <label for="inputCity">Plan</label>
                        <select
                            name=""
                            id=""
                            class="form-control"
                            v-model="formulario.seguro_plan"
                        >
                            <option value="1">Basico</option>
                            <option value="2">Familiar</option>
                            <option value="3">Max</option>
                        </select>
                    </div>

                    <div class="form-group col-md-4 mt-2">
                        <label for="inputCity"># afiliado</label>
                        <input
                            type="number"
                            min="1"
                            class="form-control"
                            v-model="formulario.seguro_afiliado"
                        />
                    </div>
                </div>
            </div>

            <button class="btn btn-primary btn-block mt-3" @click="guardar">
                <i class="fas fa-save"></i> Guardar
            </button>
        </div>
    </div>
</template>
<script>
export default {
    props: ["user_login"],
    mounted() {
        this.formulario.authLogin = this.user_login;
       
    },
    data() {
        return {
            formulario: {
                name: "",
                email: "",
                cedula: "",
                celular: "",
                telefono: "",
                sexo: 0,
                fecha_nacimiento: "",
                direccion: "",
                estado_civil_id: 0,
                ocupacion_id: 0,
                tipo_usuario_id: 4,
                grupo_sanguineo_id: 0,
                estatura: "",
                seguro_afiliado: "",
                seguro_plan: "",
                aseguradora_id: 0,
                familiar_doctor: false,
                image_path: "",
                estatus: 1,
                authLogin: 0
            },
            user_id: 0
        };
    },
    methods: {
        async guardar() {
            await axios
                .post("/pacientes", this.formulario)
                .then(res => {
                    console.log(res.data);

                    this.user_id = res.data.id;

                    this.$swal.fire({
                        icon: "success",
                        title: "Paciente registrado con exito!!!",
                        showConfirmButton: false,
                        timer: 1300
                    });

                    window.location.href =
                        window.location.origin +
                        "/pacientes/historia/" +
                        this.user_id;
                })
                .catch(err => console.log(err));
        }
    }
};
</script>
