<template>
    <div>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-4 border shadow pb-3 bg-light px-3 py-3">
                    <label>Fecha de inicio</label>
                    <input
                        type="date"
                        name="fec_inicio"
                        v-model="fec_inicio"
                        class="form-control mb-3"
                    />

                    <label>Fecha Final</label>
                    <input
                        type="date"
                        name="fec_final"
                        v-model="fec_final"
                        class="form-control mb-3"
                    />
                    <label>Ciudad</label>
                    <select
                        class="form-control mb-3"
                        v-model="ciudad"
                        @change="handleCiudad(ciudad)"
                    >
                        <option
                            v-for="item in dataCuidades"
                            :key="item.id"
                            v-bind:value="item.id"
                            >{{ item.nombre }}</option
                        >
                    </select>

                    <div v-if="mostrarClinicas">
                        <label>Clinica</label>
                        <select
                            class="form-control mb-3"
                            v-model="clinica"
                            @change="handleChangeClinica(clinica)"
                        >
                            <option
                                v-for="item in dataClinicas"
                                :key="item.id"
                                v-bind:value="item.id"
                                >{{ item.nombre }}</option
                            >
                        </select>
                    </div>
                    <label>Especialidad</label>
                    <select class="form-control mb-3" v-model="especialidad">
                        <option
                            v-for="item in dataEspecialidad"
                            :key="item.id"
                            v-bind:value="item.id"
                            >{{ item.nombre }}</option
                        >
                    </select>
                    <div v-if="mostrarDoctores">
                        <label>Doctores</label>
                        <select class="form-control mb-3" v-model="drID">
                            <option
                                v-for="item in dataDoctores"
                                :key="item.id"
                                v-bind:value="item.id"
                                >{{ item.name }}</option
                            >
                        </select>
                    </div>

                   
                        <label>Sexo - <b>Pacientes</b></label>
                        <select class="form-control mb-3" v-model="sexo">
                            <option
                                value="1"
                                >Masculino</option
                            >
                             <option
                                value="2"
                                >Femenino</option
                            >
                        </select>
                    
                    <button
                        @click="enviar"
                        form="search-form"
                        class="btn btn-primary btn-block my-3"
                    >
                        Buscar
                    </button>
                </div>
            </div>
        </div>
        <div v-if="mostrar">
            <div class="container-fluid mt-4">
                <div class="row justify-content-center">
                    <div class="col-md-4 border shadow pb-3 bg-light">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center">
                                        Cantidad
                                    </th>
                                    <th scope="col">Medicamento</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item in data" :key="item.id">
                                    <th class="text-center">
                                        {{ item.cantidad }}
                                    </th>
                                    <td>{{ item.medicamento }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    mounted() {
        this.cargarCiudades();
        this.cargarEspecialidad();
    },
    data() {
        return {
            fec_inicio: "",
            fec_final: "",
            ciudad: 0,
            data: [],
            mostrar: false,
            mostrarClinicas: false,
            dataCuidades: [],
            dataClinicas: [],
            dataEspecialidad: [],
            dataDoctores: [],
            mostrarDoctores: false,
            drID: 0,
            clinica: 0,
            especialidad: 0,
            sexo: 0,
        };
    },
    methods: {
        enviar() {
            const data = {
                fec_inicio: this.fec_inicio,
                fec_final: this.fec_final,
                ciudad: this.ciudad,
                clinica: this.clinica,
                especialidad: this.especialidad,
                drID: this.drID,
                sexo: this.sexo,
            };

            axios
                .post("/admin/reportes/medicamentos", data)
                .then(res => {
                    console.log(res.data);
                    this.data = res.data;
                    this.mostrar = true;
                })
                .catch(err => console.log(err));
        },
        async cargarCiudades() {
            await axios
                .get("/admin/ciudades/get")
                .then(res => (this.dataCuidades = res.data))
                .catch(err => console.log(err));
        },
        async cargarEspecialidad() {
            await axios
                .get("/admin/especialidad/get")
                .then(res => (this.dataEspecialidad = res.data))
                .catch(err => console.log(err));
        },
        async cargarDoctores(value) {
            
            await axios
                .post("/admin/lista/doctor", {
                    clinica: value
                })
                .then(res => {
                    this.dataDoctores = res.data;
                    console.log(res.data)
                    this.mostrarDoctores = true;
                })
                .catch(err => console.log(err));
        },

        handleChangeClinica(value) {
            this.cargarDoctores(value);
        },
        async handleCiudad(value) {
            await axios
                .post("/admin/clinicas/show/" + value)
                .then(res => {
                    this.dataClinicas = res.data;
                    this.mostrarClinicas = true;
                })
                .catch(err => console.log(err));
        }
    }
};
</script>
