<template>
    <div>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-9 border shadow pb-3 bg-light px-3 py-3">
                    <table class="table" v-if="mostrar">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Cedula</th>
                                <th scope="col">Celular</th>
                                <th scope="col">Telefono</th>
                                <th scope="col">Direccion</th>
                                <th scope="col">Clinica</th>
                                <th scope="col">Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="item in data" :key="item.id">
                                <td>{{ item.id }}</td>
                                <td>{{ item.name }}</td>
                                <td>{{ item.cedula }}</td>
                                <td>{{ item.celular }}</td>
                                <td>{{ item.telefono }}</td>
                                <td>{{ item.direccion }}</td>
                                <td>{{ item.clinica.nombre }}</td>
                                <td>{{ arreglarFecha(item.created_at) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
const moment = require("moment");

export default {
    mounted() {
        this.listar();
    },
    data() {
        return {
            data: [],
            mostrar: false
        };
    },
    methods: {
        async listar() {
            await axios
                .get("/admin/lista/doctor")
                .then(res => {
                    this.data = res.data;
                    console.log(res.data);
                    this.mostrar = true;
                })
                .catch(err => console.log(err));
        },
        arreglarFecha(fecha) {
            return moment(fecha).format("DD MMMM yyyy").toUpperCase();
        }
    }
};
</script>
