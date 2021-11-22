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
                                    <th scope="col" class="text-center">Cantidad</th>
                                    <th scope="col">Consultas</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item in data" :key="item.id">
                                    <th class="text-center">{{ item.cantidad }}</th>
                                    <td>{{ item.nombre }}</td>
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
    },
    data() {
        return {
            fec_inicio: "",
            fec_final: "",
            data: [],
            mostrar: false,
        };
    },
    methods: {
        enviar() {
            const data = {
                fec_inicio: this.fec_inicio,
                fec_final: this.fec_final,
                ciudad: this.ciudad
            };

            axios
                .post("/admin/reportes/consultas", data)
                .then(res => {
                    console.log(res.data);
                    this.data = res.data;
                    this.mostrar = true;
                })
                .catch(err => console.log(err));
        },
    }
};
</script>
