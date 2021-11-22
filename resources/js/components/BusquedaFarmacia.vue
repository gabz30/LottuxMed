<template>
    <div>
        <div class="form-inline bg-dark my-2 py-2 px-2">
            <input
                type="text"
                placeholder="Buscar farmacia..."
                class="w-25 p-1 mr-1"
                v-on:keyup.enter="busqueda"
                v-model="txtbuscar"
            />
            <button
                type="button"
                class="btn btn-primary btn-md"
                @click="busqueda"
            >
                <i class="fas fa-search"></i>
            </button>
        </div>

        <div class="card">
            <div class="card-header">Farmacias</div>

            <table class="table table-dark">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Direccion</th>
                        <th scope="col">Telefono</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item in data" :key="item.id">
                        <td>{{ item.id }}</td>
                        <td>{{ item.nombre }}</td>
                        <td>{{ item.direccion }}</td>
                        <td>{{ item.telefono }}</td>
                        <td>
                            <button
                                type="button"
                                class="btn btn-success"
                                @click="enviarRecetar(item.id)"
                            >
                                <i class="far fa-share-square"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
<script>
export default {
    props: ["doctor"],
    mounted() {
        this.listar();
        this.doctor_id = this.doctor;
    },
    data() {
        return {
            data: [],
            txtbuscar: "",
            doctor_id: 0
        };
    },
    methods: {
        listar() {
            axios
                .get("/farmacias/create")
                .then(res => {
                    this.data = res.data;
                    console.log(this.data);
                })
                .catch(err => console.log(err));
        },
        async busqueda() {
            if (this.txtbuscar) {
                await axios
                    .get("/farmacias/" + this.txtbuscar)
                    .then(res => {
                        console.log(res.data);
                        this.data = res.data;
                    })
                    .catch(err => console.log(err));
            } else {
                this.$swal.fire({
                    // position: "top-end",
                    icon: "error",
                    title: "Especifique su busqueda.",
                    showConfirmButton: false,
                    timer: 1300
                });
            }
        },
        async enviarRecetar(farmacia) {
            const data = {
                farmacia_id: farmacia,
                doctor_id: this.doctor_id
            };

            await axios
                .post("/lottuxpharm", data)
                .then(res => {
                    console.log(res.data);
                    this.$swal.fire({
                        // position: "top-end",
                        icon: "success",
                        title: "Su receta se ha enviado.",
                        showConfirmButton: false,
                        timer: 1500
                    });

                    setTimeout(() => {
                        window.location.href = window.location.origin + "/home";
                    }, 1200);
                })
                .catch(err => {
                    console.log(err);
                    this.$swal.fire({
                        // position: "top-end",
                        icon: "error",
                        title: "Error al enviar la receta.",
                        showConfirmButton: false,
                        timer: 1500
                    });
                });
        }
    }
};
</script>
