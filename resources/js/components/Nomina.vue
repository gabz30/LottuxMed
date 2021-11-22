<template>
    <div>
        <div class="card shadow p-3 mb-5">
            <div class="form-group">
                <label for="">Secretaria</label>
                <select
                    class="form-control"
                    v-model="formulario.empleado_id"
                    @change="calcular(e)"
                >
                    <option
                        v-for="item in secretarias"
                        :key="item.id"
                        v-bind:value="item.id"
                        >{{ item.name }}
                        <div v-if="item.salario">
                            --> ${{ item.salario }}
                        </div></option
                    >
                </select>
            </div>
            <div class="form-group">
                <label for="">Monto</label>
                <input
                    type="text"
                    class="form-control"
                    placeholder="Ej. 5,000"
                    v-model="formulario.monto"
                />
            </div>

            <div class="card w-100 border-danger mb-3" style="margin-top:30px;">
                <div class="card-header" style="text-align:center;">
                    <h1>Retenciones</h1>
                </div>
                <div class="card-body text-center">
                    <div class="card-group">
                        <div class="card">
                            <div class="card-body">
                                <label for="afp">Descontar Seguro y AFP</label>
                                <input
                                    class="form-control"
                                    type="checkbox"
                                    placeholder=""
                                    id="descontar"
                                    @click="descontar"
                                />
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <label for="sfs">SFS/ 3.04%</label>
                                <input
                                    class="form-control text-center"
                                    type="text"
                                    v-model="sfs"
                                    readonly
                                />
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <label for="afp">AFP/ 2.87%</label>
                                <input
                                    class="form-control text-center"
                                    type="text"
                                    v-model="afp"
                                    readonly
                                />
                            </div>
                        </div>
                    </div>
                </div>
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
                        <th scope="col">Empleado</th>
                        <th scope="col">Monto</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Estatus</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item in data" :key="item.id">
                        <th>{{ item.user.name }}</th>
                        <th>{{ number_format(item.monto) }}</th>
                        <td>{{ arreglarFecha(item.created_at) }}</td>

                        <td role="button" @click="cambiarEstatus(item.id, item.estatus)">
                            <b
                                v-if="item.estatus === 1"
                                class="text-success font-weight-bold"
                            >
                                Pagado
                            </b>
                            <b v-else class="text-danger font-weight-bold">
                                Cancelado
                            </b>
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
        this.formulario.authLogin = this.user_id;

        this.listar();
        this.cargarSecretaria();
    },
    data() {
        return {
            secretarias: [],
            formulario: {
                empleado_id: 0,
                authLogin: 0,
                monto: 0,
                estatus: 1
            },
            data: [],
            mostrar: false,
            sfs: 0,
            afp: 0
        };
    },
    methods: {
        calcular() {
            const arreglo = this.secretarias;

            let persona = arreglo.find(
                elemento => elemento.id == this.formulario.empleado_id
            );

            this.sfs = (persona.salario * 3.04) / 100;
            this.afp = (persona.salario * 2.87) / 100;

            return (this.formulario.monto = persona.salario / 2);
        },
        descontar() {
            if (document.getElementById("descontar").checked) {
                this.formulario.monto =
                    this.formulario.monto - this.sfs - this.afp;
            } else {
                this.formulario.monto = this.calcular();
            }
        },
        async cargarSecretaria() {
            await axios
                .get("/secretarias")
                .then(res => {
                    // console.log(res.data);
                    this.secretarias = res.data;
                })
                .catch(err => console.log(err));
        },
        async listar() {
            await axios
                .get("/lista-nomina")
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
            if (this.formulario.monto) {
                await axios
                    .post("/nomina", this.formulario)
                    .then(res => {
                        console.log(res.data);

                        this.$swal.fire({
                            icon: "success",
                            title: "Registrado correctamento!",
                            // showConfirmButton: true,
                            timer: 1300
                        });

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
        async cambiarEstatus(id, estatus){

            if(estatus === 0){
                estatus = 1;
            }else{
                estatus = 0;
            }

            await axios.put('/nomina/' + id, {
                estatus: estatus
            })
            .then(res => {
                console.log(res.data);
                this.listar();
                
            })
            .catch(err => console.log(err))
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
