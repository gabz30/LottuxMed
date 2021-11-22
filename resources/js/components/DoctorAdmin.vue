<template>
    <div>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-4 border shadow pb-3 bg-light px-3 py-3">
                    <div class="alert alert-danger" role="alert">
                        Los campos en <b>Rojo</b> no deben quedarse en blanco.
                    </div>

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
                    <label for="">Telefono</label>
                    <input
                        type="text"
                        class="form-control mb-3"
                        placeholder="Celular"
                        v-model="formulario.telefono"
                    />

                    <label for="">Direccion</label>
                    <textarea
                        class="form-control mb-3"
                        placeholder="Direccion"
                        rows="3"
                        v-model="formulario.direccion"
                    ></textarea>

                    <label class="text-danger">Clinica</label>
                    <select
                        class="form-control mb-2"
                        v-model="formulario.clinica_id"
                    >
                        <option
                            v-for="item in dataClinicas"
                            :key="item.id"
                            v-bind:value="item.id"
                            >{{ item.nombre }} -
                            {{ item.ciudad.nombre }}</option
                        >
                    </select>

                    <label for="">Sexo</label>
                    <div class="mx-3">
                        <div class="custom-control custom-radio">
                            <input
                                type="radio"
                                id="customRadio1"
                                name="customRadio"
                                class="custom-control-input"
                                value="1"
                                v-model="formulario.sexo"
                            />
                            <label
                                class="custom-control-label"
                                for="customRadio1"
                                >Masculino</label
                            >
                        </div>
                        <div class="custom-control custom-radio">
                            <input
                                type="radio"
                                id="customRadio2"
                                name="customRadio"
                                class="custom-control-input"
                                value="2"
                                v-model="formulario.sexo"
                            />
                            <label
                                class="custom-control-label"
                                for="customRadio2"
                                >Femenino</label
                            >
                        </div>
                    </div>

                    <label for="" class="text-danger">Contraseña</label>
                    <input
                        type="password"
                        class="form-control mb-3"
                        v-model="formulario.password"
                    />

                    <button
                        class="btn btn-primary btn-block "
                        @click="registrar"
                    >
                        Registrar
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    mounted() {
        this.cargarClinicas();
    },
    data() {
        return {
            formulario: {
                name: "",
                cedula: "",
                celular: "",
                telefono: "",
                email: "",
                direccion: "",
                password: "",
                tipo_usuario_id: 2,
                estatus: 1,
                clinica_id: 0,
                sexo: 0,
            },
            data: [],
            dataClinicas: []
        };
    },
    methods: {
        async cargarClinicas() {
            await axios
                .get("/admin/clinicas/get")
                .then(res => (this.dataClinicas = res.data))
                .catch(err => console.log(err));
        },
        async registrar() {
            await axios
                .post("/admin/registrar/doctor", this.formulario)
                .then(res => {
                    this.data = res.data;
                    console.log(res.data);
                    this.$swal.fire({
                        icon: "success",
                        title: "Doctor registrado con exito!",
                        // showConfirmButton: true,
                        timer: 1300
                    });
                })
                .catch(err => console.log(err));
        }
    }
};
</script>
