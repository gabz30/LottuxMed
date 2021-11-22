<template>
    <div>
        <div class="my-2">
            <label class="text-center">Secretaria</label>
            <select class="form-control" v-model="secretaria">
                <option
                    v-for="item in formulario.data"
                    :key="item.id"
                    v-bind:value="item.id"
                    >{{ item.name }}</option
                >
            </select>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Seleccionar</th>
                    <th scope="col">Modulos</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input type="checkbox" /></td>
                    <td>Agenda</td>
                </tr>
                <tr>
                    <td><input type="checkbox" /></td>
                    <td>Consultas</td>
                </tr>
                <tr>
                    <td><input type="checkbox" /></td>
                    <td>Pacientes</td>
                </tr>
                <tr>
                    <td><input type="checkbox" /></td>
                    <td>Contabilidad</td>
                </tr>
                <tr>
                    <td><input type="checkbox" /></td>
                    <td>Caja</td>
                </tr>
                <tr>
                    <td><input type="checkbox" /></td>
                    <td>Reportes</td>
                </tr>
                <tr>
                    <td><input type="checkbox" /></td>
                    <td>Graficas</td>
                </tr>
                <tr>
                    <td><input type="checkbox" /></td>
                    <td>Configuracion</td>
                </tr>
            </tbody>
        </table>

        <hr />

        <button class="btn btn-primary btn-block mb-3" @click="guardar">
            Guardar
        </button>
        
    </div>
</template>
<script>
export default {
    props: ["user_id"],
    mounted() {
        this.formulario.authLogin = this.user_id;

        this.traerSecretarias();
    },
    data() {
        return {
            formulario: {
                authLogin: 0,
                data: []
            },
            secretaria: 0
        };
    },

    methods: {
        async traerSecretarias() {
            await axios
                .get("/secretarias")
                .then(res => {
                    this.formulario.data = res.data;
                })
                .catch(err => console.log(err));
        },
        guardar() {
            alert("Secretaria ID => " + this.secretaria);
        }
    }
};
</script>
