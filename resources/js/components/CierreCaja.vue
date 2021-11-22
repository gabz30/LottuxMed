<template>
    <div>
        <div class="card shadow p-3 mb-5">
            <div class="row">
                <div
                    class="col-md-6 bg-light border border-top-0 border-left-0"
                >
                    <div class="alert alert-info mt-2" role="alert">
                        Resumen de caja
                    </div>

                    <div class="form-group row ml-2">
                        <label class="col-md-7 col-form-label texto-success"
                            >Total de pagos:</label
                        >
                        <div class="col-sm-4">
                            <input
                                type="text"
                                class="form-control-plaintext bg-success pr-2"
                                v-model="suma_total"
                                disabled
                            />
                        </div>
                    </div>
                    <div class="form-group row ml-2">
                        <label class="col-md-7 col-form-label">Efectivo:</label>
                        <div class="col-sm-4">
                            <input
                                type="text"
                                class="form-control-plaintext text-center pr-2"
                                v-model="suma_efectivo"
                                disabled
                            />
                        </div>
                    </div>
                    <div class="form-group row ml-2">
                        <label class="col-md-7 col-form-label">Tarjetas:</label>
                        <div class="col-sm-4">
                            <input
                                type="text"
                                class="form-control-plaintext text-center pr-2"
                                v-model="suma_tarjeta"
                                disabled
                            />
                        </div>
                    </div>
                    <hr />
                    <div class="form-group row ml-2">
                        <label class="col-sm-7 col-form-label"
                            >Apertura de caja:</label
                        >
                        <div class="col-sm-4">
                            <input
                                type="text"
                                class="form-control-plaintext text-center pr-2"
                                v-model="apertura_caja"
                                disabled
                            />
                        </div>
                    </div>
                    <hr />
                    <div class="form-group row ml-2">
                        <label class="col-sm-7 col-form-label"
                            >Cubierto por el seguro:</label
                        >
                        <div class="col-sm-4">
                            <input
                                type="text"
                                class="form-control-plaintext text-center pr-2 bg-danger-span"
                                v-model="suma_seguro"
                                disabled
                            />
                        </div>
                    </div>
                    <div class="form-group row ml-2">
                        <label class="col-md-7 col-form-label">Gastos:</label>
                        <div class="col-sm-4">
                            <input
                                type="text"
                                class="form-control-plaintext text-center pr-2 bg-danger"
                                v-model="gastos"
                                disabled
                            />
                        </div>
                    </div>
                    <div class="form-group row ml-2">
                        <label class="col-md-7 col-form-label texto-info"
                            >Total en Caja:</label
                        >
                        <div class="col-sm-4">
                            <input
                                type="text"
                                class="form-control-plaintext bg-info pr-2"
                                v-model="total_en_caja"
                                disabled
                            />
                        </div>
                    </div>
                </div>
                <div class="col-md-6 bg-light">
                    <div class="alert alert-info mt-2" role="alert">
                        Arqueo - Corte de caja
                    </div>

                    <div class="row">
                        <div class="col-md-11">
                            <div class="form-group row ml-2">
                                <label class="col-md-4 col-form-label"
                                    >$ 2,000</label
                                >
                                <div class="col-md-3">
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="monedas.dosmil"
                                    />
                                </div>
                                <div class="col-md-4">
                                    <input
                                        type="text"
                                        class="form-control-plaintext text-center"
                                        v-model="importe.dosmil"
                                        disabled
                                    />
                                </div>
                            </div>
                            <div class="form-group row ml-2">
                                <label class="col-md-4 col-form-label"
                                    >$ 1,000</label
                                >
                                <div class="col-md-3">
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="monedas.mil"
                                    />
                                </div>
                                <div class="col-md-4">
                                    <input
                                        type="text"
                                        class="form-control-plaintext text-center"
                                        v-model="importe.mil"
                                        disabled
                                    />
                                </div>
                            </div>
                            <div class="form-group row ml-2">
                                <label class="col-md-4 col-form-label"
                                    >$ 500</label
                                >
                                <div class="col-md-3">
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="monedas.quinientos"
                                    />
                                </div>
                                <div class="col-md-4">
                                    <input
                                        type="text"
                                        class="form-control-plaintext text-center"
                                        v-model="importe.quinientos"
                                        disabled
                                    />
                                </div>
                            </div>
                            <div class="form-group row ml-2">
                                <label class="col-md-4 col-form-label"
                                    >$ 200</label
                                >
                                <div class="col-md-3">
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="monedas.doscientos"
                                    />
                                </div>
                                <div class="col-md-4">
                                    <input
                                        type="text"
                                        class="form-control-plaintext text-center"
                                        v-model="importe.doscientos"
                                        disabled
                                    />
                                </div>
                            </div>

                            <div class="form-group row ml-2">
                                <label class="col-md-4 col-form-label"
                                    >$ 100</label
                                >
                                <div class="col-md-3">
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="monedas.cien"
                                    />
                                </div>
                                <div class="col-md-4">
                                    <input
                                        type="text"
                                        class="form-control-plaintext text-center"
                                        v-model="importe.cien"
                                        disabled
                                    />
                                </div>
                            </div>
                            <div class="form-group row ml-2">
                                <label class="col-md-4 col-form-label"
                                    >$ 50</label
                                >
                                <div class="col-md-3">
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="monedas.cincuenta"
                                    />
                                </div>
                                <div class="col-md-4">
                                    <input
                                        type="text"
                                        class="form-control-plaintext text-center"
                                        v-model="importe.cincuenta"
                                        disabled
                                    />
                                </div>
                            </div>

                            <div class="form-group row ml-2">
                                <label class="col-md-4 col-form-label"
                                    >$ 25</label
                                >
                                <div class="col-md-3">
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="monedas.veinticinco"
                                    />
                                </div>
                                <div class="col-md-4">
                                    <input
                                        type="text"
                                        class="form-control-plaintext text-center"
                                        v-model="importe.veinticinco"
                                        disabled
                                    />
                                </div>
                            </div>
                            <div class="form-group row ml-2">
                                <label class="col-md-4 col-form-label"
                                    >$ 10</label
                                >
                                <div class="col-md-3">
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="monedas.diez"
                                    />
                                </div>
                                <div class="col-md-4">
                                    <input
                                        type="text"
                                        class="form-control-plaintext text-center"
                                        v-model="importe.diez"
                                        disabled
                                    />
                                </div>
                            </div>
                            <div class="form-group row ml-2">
                                <label class="col-md-4 col-form-label"
                                    >$ 5</label
                                >
                                <div class="col-md-3">
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="monedas.cinco"
                                    />
                                </div>
                                <div class="col-md-4">
                                    <input
                                        type="text"
                                        class="form-control-plaintext text-center"
                                        v-model="importe.cinco"
                                        disabled
                                    />
                                </div>
                            </div>
                            <div class="form-group row ml-2">
                                <label class="col-md-4 col-form-label"
                                    >$ 1</label
                                >
                                <div class="col-md-3">
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="monedas.uno"
                                    />
                                </div>
                                <div class="col-md-4">
                                    <input
                                        type="text"
                                        class="form-control-plaintext text-center"
                                        v-model="importe.uno"
                                        disabled
                                    />
                                </div>
                            </div>

                            <hr />

                            <div class="form-group row ml-2">
                                <label class="col-md-4 col-form-label"></label>
                                <div class="col-md-3">
                                    <input
                                        type="text"
                                        class="form-control-plaintext bg-success pr-2"
                                        value="Total:"
                                        disabled
                                    />
                                </div>
                                <div class="col-md-4">
                                    <input
                                        type="text"
                                        class="form-control-plaintext text-center"
                                        v-model="importe.suma_total"
                                        disabled
                                    />
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr />

                    <a class="btn btn-success btn-block" @click="calcular"
                        ><i class="fas fa-calculator"></i> Calcular</a
                    >
                </div>
            </div>

            <hr />

            <button class="btn btn-primary btn-block" @click="cerrarCaja">
                <i class="fas fa-save"></i>
                Cerrar caja
            </button>
        </div>
    </div>
</template>
<script>
export default {
    props: ["caja_id"],

    mounted() {
        this.caja.caja_id = this.caja_id;

        axios
            .get("/caja/Showcierre")
            .then(res => {
                console.log("Cierre de caja => ", res.data);

                this.suma_total = res.data.suma_total[0].suma_total;
                this.suma_efectivo = res.data.suma_efectivo[0].suma_efectivo;
                this.suma_tarjeta = res.data.suma_tarjeta[0].suma_tarjeta;
                this.apertura_caja = res.data.apertura_caja[0].apertura_caja;
                this.gastos = res.data.gastos[0].gastos;
                this.suma_seguro = res.data.suma_seguro[0].suma_seguro;

                if (!this.suma_efectivo) {
                    this.suma_efectivo = 0;
                }
                 if (!this.gastos) {
                    this.gastos = 0;
                }

                // console.log('efectivo => ' + this.suma_efectivo + ' apertura caja => ' + this.apertura_caja + ' gastos => ' + this.gastos);

                this.total_en_caja =
                    parseFloat(this.suma_efectivo) +
                    parseFloat(this.apertura_caja) - 
                    parseFloat(this.gastos);

                    // alert(this.gastos);
            })
            .catch(err => console.log(err));
    },
    data() {
        return {
            importe: {
                dosmil: 0,
                mil: 0,
                quinientos: 0,
                doscientos: 0,
                cien: 0,
                cincuenta: 0,
                veinticinco: 0,
                diez: 0,
                cinco: 0,
                uno: 0,
                suma_total: 0
            },
            monedas: {
                dosmil: 0,
                mil: 0,
                quinientos: 0,
                doscientos: 0,
                cien: 0,
                cincuenta: 0,
                veinticinco: 0,
                diez: 0,
                cinco: 0,
                uno: 0
            },
            suma_total: 0,
            suma_efectivo: 0,
            suma_tarjeta: 0,
            apertura_caja: 0,
            gastos: 0,
            suma_seguro: 0,
            total_en_caja: 0,
            caja: {
                caja_id: 0
            }
        };
    },

    methods: {
        calcular() {
            this.importe.dosmil = 2000 * Number(this.monedas.dosmil);
            this.importe.mil = 1000 * Number(this.monedas.mil);
            this.importe.quinientos = 500 * Number(this.monedas.quinientos);
            this.importe.doscientos = 200 * Number(this.monedas.doscientos);
            this.importe.cien = 100 * Number(this.monedas.cien);
            this.importe.cincuenta = 50 * Number(this.monedas.cincuenta);
            this.importe.veinticinco = 25 * Number(this.monedas.veinticinco);
            this.importe.diez = 10 * Number(this.monedas.diez);
            this.importe.cinco = 5 * Number(this.monedas.cinco);
            this.importe.uno = 1 * Number(this.monedas.uno);

            this.importe.suma_total =
                Number(this.importe.dosmil) +
                Number(this.importe.mil) +
                Number(this.importe.quinientos) +
                Number(this.importe.doscientos) +
                Number(this.importe.cien) +
                Number(this.importe.cincuenta) +
                Number(this.importe.veinticinco) +
                Number(this.importe.diez) +
                Number(this.importe.cinco) +
                Number(this.importe.uno);
        },
        formatoNumerico(value) {
            return new Intl.NumberFormat().format(value);
        },
        async cerrarCaja() {
            await axios
                .put("/caja/apertura/" + this.caja.caja_id, {
                    estatus: 0
                })

                .then(res => {
                    console.log(res.data);

                    const datos = {
                        caja_id: this.caja.caja_id,
                        total_pagos: this.suma_total,
                        efectivo: this.suma_efectivo,
                        tarjeta: this.suma_tarjeta,
                        apertura_caja: this.apertura_caja,
                        cubierto_seguro: this.suma_seguro,
                        gastos: this.gastos,
                        total_caja: this.total_en_caja
                    };

                    axios
                        .post("/caja/cierre", datos)
                        .then(res => {
                            console.log(res.data);

                            this.$swal.fire({
                                icon: "success",
                                title: "Caja cerrada con exito!",
                                // showConfirmButton: true,
                                timer: 1300
                            });
                        })
                        .catch(err => {
                            console.log(err);
                            this.$swal.fire({
                                icon: "error",
                                title: "La caja no pudo ser cerrada.",
                                // showConfirmButton: true,
                                timer: 1300
                            });
                        });
                })
                .catch(err => console.log(err));
        },
        number_format(value){
            const formatter = new Intl.NumberFormat('en');
            return '$' + formatter.format(value);
        },
    }
};
</script>
