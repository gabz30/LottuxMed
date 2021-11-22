<template>
    <div>
      
        <div
            class="container-fluid my-3"
            v-for="(item, indice) in data"
            :key="item.id"
        >
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-7 border shadow pb-3 bg-light">
                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <!-- <th scope="col">#</th> -->
                                <th scope="col"></th>
                                <th scope="col">Paciente</th>
                                <th scope="col">Aseguradora</th>
                                <th scope="col"># afiliado</th>
                                <th scope="col">Plan</th>
                                <th scope="col">Doctor</th>
                                <th scope="col">Fecha</th>
                                <th scope="col">Estatus</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <!-- <th>{{ item.id }}</th> -->
                                <td>
                                    <div v-if="item.estatus === 1">
                                        <button
                                            class="btn btn-success btn-md mb-1 px-2 py-3"
                                            @click="despachar(item.id)"
                                        >
                                            <i class="fas fa-check-circle"></i>
                                            Despachar
                                        </button>

                                        <button
                                            class="btn btn-danger btn-md px-2"
                                            @click="cancelar(item.id)"
                                        >
                                            <i class="fas fa-window-close"></i>
                                            Cancelar
                                        </button>
                                    </div>
                                </td>
                                <td>{{ item.paciente.name }}</td>
                                <td>{{ item.paciente.aseguradora.nombre }}</td>
                                <td>{{ item.paciente.seguro_afiliado }}</td>
                                <td>{{ item.paciente.seguro_plan }}</td>
                                <td>{{ item.doctor.name }}</td>
                                <td>{{ arreglarFecha(item.created_at) }}</td>
                                <td>
                                    <div
                                        v-if="item.estatus === 1"
                                        class="text-danger font-weight-bold"
                                    >
                                        Sin despachar
                                    </div>
                                    <div v-else class="text-success">
                                        Despachado
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <hr />

                    <div class="list-group mb-3">
                        <b
                            class="list-group-item list-group-item-action list-group-item-primary"
                            v-for="item in dataReceta[indice]"
                            :key="item.id"
                        >
                            {{ item.medicamentos.descripcion }} -
                            {{ item.prescripcion }}
                        </b>
                    </div>
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
            mostrar: false,
            consulta_id: 0,
            dataReceta: []
        };
    },

    methods: {
        listar() {
            axios
                .get("/get/lottuxpharm")
                .then(res => {
                    // console.log(res.data);
                    this.data = res.data;
                    // this.consulta_id = res.data[0].consulta_id;
                    this.data.forEach((value, index) => {
                        // this.consulta_id = value

                        // alert(value.consulta_id);

                        this.consulta_id = value.consulta_id;
                        this.Receta();
                    });
                })
                .catch(err => console.log(err));

            console.log(this.dataReceta);
        },
        async Receta() {
            await axios
                .get("/consulta/recetas/" + this.consulta_id)
                .then(res => {
                    this.dataReceta.push(res.data);
                })
                .catch(err => console.log(err));
        },
        despachar(pedido_id) {
            axios
                .put("/lottuxpharm/" + pedido_id, {
                    estatus: 2
                })
                .then(res => {
                    console.log(res.data);

                    this.listar();

                    this.$swal.fire({
                        icon: "success",
                        title: "Pedido despachado con exito!",
                        // showConfirmButton: true,
                        timer: 1300
                    });
                })
                .catch(err => console.log(err));
        },
        cancelar(pedido_id) {
            axios
                .put("/lottuxpharm/" + pedido_id, {
                    estatus: 0
                })
                .then(res => {
                    console.log(res.data);

                    this.listar();

                    this.$swal.fire({
                        icon: "error",
                        title: "Pedido cancelado",
                        // showConfirmButton: true,
                        timer: 1300
                    });
                })
                .catch(err => console.log(err));
        },
        arreglarFecha(fecha) {
            return moment(fecha).format("DD MMMM YYYY hh:mm:ss");
        }
    }
};
</script>
