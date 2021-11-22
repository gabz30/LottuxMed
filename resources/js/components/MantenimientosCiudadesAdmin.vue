<template>
    <div>
    <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-4 border shadow pb-3 bg-light px-3 py-3">
                   
                    <label>Nombre de la ciudad</label>
                    <input class="form-control" v-model="ciudad"/>
                    <button class="btn btn-primary btn-block mt-1" @click="guardar">Guardar</button>
                </div>
            </div>
        </div>

 <div v-if="mostrar" class="container-fluid mt-3">
            <div class="row justify-content-center">
                <div class="col-md-4 border shadow pb-3 bg-light px-3 py-3">
                    <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Ciudad</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="item in data" :key="item.id">
                        <td>{{ item.id }}</td>
                        <td>{{ item.nombre }}</td>
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
    mounted(){
        this.listar();
    },
    data(){
        return {
            data: [],
            mostrar: false,
            ciudad: '',

        }
    },
    methods:{
         async listar(){
            await axios.get('/admin/ciudades/get')
            .then(res => {
                
                this.data = res.data;
                console.log(res.data);
                this.mostrar = true;
            })
            .catch(err => console.log(err))
        },
        async guardar(){
            await axios.post('/admin/ciudades', {
                nombre: this.ciudad,
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
            .catch(err => console.log(err))
        },
    }
}
</script>