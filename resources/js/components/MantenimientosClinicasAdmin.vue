<template>
    <div>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-6 border shadow pb-3 bg-light px-3 py-3">
                    <label>Nombre de la clinica</label>
                    <input class="form-control" v-model="nombre" />
                    <label>Direccion de la clinica</label>
                    <input class="form-control" v-model="direccion" />
                    <label>Ciudad de la clinica</label>
                    <select v-model="ciudad" class="form-control">
                        <option v-bind:value="item.id" v-for="item in dataCiudades" :key="item.id">{{ item.nombre }}</option>
                    </select>
                    <button
                        class="btn btn-primary btn-block mt-2"
                        @click="guardar"
                    >
                        Guardar
                    </button>
                </div>
            </div>
        </div>

        <div v-if="mostrar" class="container-fluid mt-3">
            <div class="row justify-content-center">
                <div class="col-md-6 border shadow pb-3 bg-light px-3 py-3">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Ciudad</th>
                                <th scope="col">Direccion</th>
                                <th scope="col">Ciudad</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="item in data" :key="item.id">
                                <td>{{ item.id }}</td>
                                <td>{{ item.nombre }}</td>
                                <td>{{ item.direccion }}</td>
                                <td>{{ item.ciudad.nombre }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    mounted() {
        this.listar();
        this.cargarCiudades();
    },
    data() {
        return {
            data: [],
            dataCiudades: [],
            mostrar: false,
            nombre: "",
            direccion: "",
            ciudad:'',
        };
    },
    methods: {
        async cargarCiudades() {
            await axios
                .get("/admin/ciudades/get")
                .then(res => {
                    this.dataCiudades = res.data;
                })
                .catch(err => console.log(err));
        },
        async listar() {
            await axios
                .get("/admin/clinicas/get")
                .then(res => {
                    this.data = res.data;
                    console.log(res.data);
                    this.mostrar = true;
                })
                .catch(err => console.log(err));
        },
        async guardar() {

            if(this.nombre && this.direccion && this.ciudad){
            await axios
                .post("/admin/clinicas", {
                    ciudad_id: this.ciudad,
                    nombre: this.nombre,
                    direccion: this.direccion
                })
                .then(res => {
                    this.$swal.fire({
                        // position: "top-end",
                        icon: "success",
                        title: "Guardado correctamente!",
                        showConfirmButton: false,
                        timer: 1300
                    });
                    console.log(res.data);
                    this.listar();
                })
                .catch(err => console.log(err));
            }else{
                 this.$swal.fire({
                        // position: "top-end",
                        icon: "error",
                        title: "Debe llenar todos los campos!",
                        showConfirmButton: false,
                        timer: 1300
                    }); 
            }


        }
    }
};
</script>
