<template>
    <div>
        <div class="card shadow p-3 mb-5">
            <div class="form-group">
                <label for="">Monto de apertura</label>
                <input
                    type="text"
                    class="form-control"
                    placeholder="Ej. 5,000"
                    v-model="formulario.monto_apertura"
                />
            </div>

            <button class="btn btn-primary btn-block" @click="guardar">
                <i class="fas fa-save"></i>
                Registrar
            </button>
        </div>
        <div v-if="mostrar">
            <table class="table shadow p-3 mb-5">
                <thead>
                    <tr>
                        <th scope="col">Monto</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Estatus</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item in data" :key="item.id">
                        <th>{{ number_format(item.monto_apertura) }}</th>
                        <td>{{ arreglarFecha(item.created_at) }}</td>

                        <td
                            v-if="item.estatus === 1"
                            class="text-success font-weight-bold"
                        >
                            Abierto
                        </td>

                        <td v-else class="text-danger font-weight-bold">
                            Cerrado
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
<script>
const moment = require("moment");

export default {
    props: ["user_id"],
    mounted() {
        this.formulario.user_id = this.user_id;

        this.listar();
    },
    data() {
        return {
            formulario: {
                user_id: 0,
                monto_apertura: 0,
                estatus: 1
            },
            data: [],
            mostrar: false
        };
    },
    methods: {
        async listar() {
            await axios
                .get("/lista-cajas")
                .then(res => {
                    console.log(res.data);
                    this.data = res.data;

                    if (Object.keys(res.data).length > 0) {
                        this.mostrar = true;
                    }
                })
                .catch(err => console.log(err));
        },
        async guardar() {
            if (this.formulario.monto_apertura) {
                await axios
                    .post("/caja/apertura", this.formulario)
                    .then(res => {
                        console.log(res.data);

                        this.$swal.fire({
                            icon: "success",
                            title: "Registrado correctamento!",
                            // showConfirmButton: true,
                            timer: 1300
                        });

                        this.formulario.monto_apertura = 0;

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
        number_format(value) {
            const formatter = new Intl.NumberFormat("en");
            return "$" + formatter.format(value);
        }
    }
};
</script>
