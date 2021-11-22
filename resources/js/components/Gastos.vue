<template>
    <div>
        <div class="card shadow p-3 mb-5">
            <div class="form-group">
                <label for="">Monto</label>
                <input
                    type="text"
                    class="form-control"
                    placeholder="Ej. 5,000"
                    v-model="formulario.monto"
                />
            </div>

            <div class="form-group">
                <label for="">Concepto</label>
                <input
                    type="text"
                    class="form-control"
                    placeholder="Ej. pago de consultorio"
                    v-model="formulario.concepto"
                />
            </div>

            <div class="form-group">
                <label for="">Comentario</label>
                <textarea
                    rows="3"
                    class="form-control"
                    v-model="formulario.comentario"
                    placeholder="Escriba aqui un breve comentario..."
                />
            </div>

            <button class="btn btn-primary btn-block" @click="guardar"><i class="fas fa-save"></i>
                Registrar
            </button>
        </div>
        <div v-if="mostrar">
            <div class="shadow p-3 mb-2 form-inline border">
                <label for="">Fecha de inicio</label>
                <input
                    class="form-control mx-3"
                    type="date"
                    v-model="busqueda.fec_inicio"
                />
                <label for="">Fecha final</label>
                <input
                    class="form-control mx-3"
                    type="date"
                    v-model="busqueda.fec_final"
                />
                <button class="btn btn-success" @click="listar"><i class="fas fa-search"></i></button>
            </div>

            <table class="table shadow p-3 mb-5">
                <thead>
                    <tr>
                        <th scope="col">Monto</th>
                        <th scope="col">Concepto</th>
                        <th scope="col">Comentario</th>
                        <th scope="col">Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item in data" :key="item.id">
                        <th>{{ number_format(item.monto) }}</th>
                        <td>{{ item.concepto }}</td>
                        <td>{{ item.comentario }}</td>
                        <td>{{ arreglarFecha(item.created_at) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
<script>
const moment = require("moment");

export default {
    props: ["user_id","caja_id"],
    mounted() {
        this.formulario.user_id = this.user_id;
        this.formulario.caja_id = this.caja_id;

        this.listar();
    },
    data() {
        return {
            formulario: {
                user_id: 0,
                monto: 0,
                concepto: "",
                comentario: "",
                caja_id: 0
            },
            busqueda: {
                fec_inicio: "",
                fec_final: ""
            },
            data: [],
            mostrar: false
        };
    },
    methods: {
        async listar() {
            if (
                this.busqueda.fec_inicio != "" &&
                this.busqueda.fec_final != ""
            ) {
                await axios
                    .post("/gastos/buscar/", this.busqueda)
                    .then(res => {
                        this.data = res.data;
                        console.log(res.data);
                        if (Object.keys(res.data).length > 0) {
                            this.mostrar = true;
                        }
                    })
                    .catch(err => console.log(err));
            } else {
                await axios
                    .get("/lista-gastos")
                    .then(res => {
                        console.log(res.data);
                        this.data = res.data;

                        if (Object.keys(res.data).length > 0) {
                           this.mostrar = true;
                        }
                    })
                    .catch(err => console.log(err));
            }
        },
        async guardar() {
            if (
                this.formulario.monto &&
                this.formulario.concepto &&
                this.formulario.comentario
            ) {
                await axios
                    .post("/gastos", this.formulario)
                    .then(res => {
                        console.log(res.data);

                        this.$swal.fire({
                            icon: "success",
                            title: "Consulta guardada correctamento!",
                            // showConfirmButton: true,
                            timer: 1300
                        });

                        this.formulario.monto = 0;
                        this.formulario.concepto = "";
                        this.formulario.comentario = "";

                        this.listar();
                    })
                    .catch(err => console.log(err));
            } else {
                this.$swal.fire({
                    icon: "error",
                    title: "Debe llenar alguno de los campos.",
                    // showConfirmButton: true,
                    timer: 1300
                });
            }
        },
        arreglarFecha(fecha) {
            return moment(fecha).format("DD-MM-yyyy");
        },
        number_format(value){
            const formatter = new Intl.NumberFormat('en');
            return '$' + formatter.format(value);
        },
    }
};
</script>
