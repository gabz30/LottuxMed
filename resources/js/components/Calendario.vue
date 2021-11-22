<template>
    <div class="p-3">
        <div v-if="mostrar">
            <FullCalendar :options="calendarOptions" />
        </div>

        <div
            class="modal fade"
            id="evento"
            tabindex="-1"
            role="dialog"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            Agendar
                        </h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label"
                                    >Titulo:</label
                                >
                                <textarea
                                    class="form-control"
                                    id="message-text"
                                    v-model="title"
                                ></textarea>
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label"
                                    >Comentario:</label
                                >
                                <textarea
                                    class="form-control"
                                    id="message-text"
                                    v-model="description"
                                ></textarea>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label"
                                    >Fecha de inicio:</label
                                >
                                <input
                                    type="text"
                                    class="form-control"
                                    v-model="start"
                                />
                            </div>
                            <div class="form-group">
                                <label
                                    for="recipient-name"
                                    class="col-form-label"
                                    >Fecha final:</label
                                >
                                <input
                                    type="text"
                                    class="form-control"
                                    id="recipient-name"
                                    v-model="end"
                                />
                            </div>

                            <div class="form-group">
                                <label for="favcolor">Tipo de cita:</label>
                                <select class="form-control" id="color">
                                    <option value="#039be5" selected
                                        >Consulta</option
                                    >
                                    <option value="#33b679">Evento</option>
                                    <option value="#3f51b5">Operacion</option>
                                    <option value="#16D3A2">Tarea</option>
                                    <option value="#e4c441"
                                        >Recordatorio</option
                                    >
                                </select>
                                <!-- <input
                                            type="color"
                                            id="favcolor"
                                            name="favcolor"
                                            class="form-control"
                                            v-model="color"
                                        /> -->
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal"
                        >
                            Cerrar
                        </button>

                        <button
                            type="button"
                            class="btn btn-primary"
                            @click="guardar"
                        >
                            Guardar
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div
            class="modal fade"
            id="eventoEdit"
            tabindex="-1"
            role="dialog"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            Agendar
                        </h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div v-if="user_id">
                                <div class="form-group">
                                   
                                    <a class="btn btn-primary btn-lg" :href="'/pacientes/historia/' + user_id" target="_blank">{{ title }}<i class="fas fa-external-link-alt mx-1"></i></a>
                                </div>
                            </div>
                            <div v-else>
                                <div class="form-group">
                                    <label
                                        for="message-text"
                                        class="col-form-label"
                                        >Titulo</label
                                    >
                                    <textarea
                                        class="form-control"
                                        id="message-text"
                                        v-model="title"
                                    ></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label"
                                    >Comentario:</label
                                >
                                <textarea
                                    class="form-control"
                                    id="message-text"
                                    v-model="description"
                                ></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-danger"
                            @click="eliminar"
                        >
                            Eliminar
                        </button>

                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal"
                        >
                            Cerrar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import "@fullcalendar/core/vdom"; // solves problem with Vite
import FullCalendar from "@fullcalendar/vue";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import interactionPlugin from "@fullcalendar/interaction";
import esLocale from "@fullcalendar/core/locales/es";
const moment = require("moment");

export default {
    props: ['doctor_id'],
    components: {
        FullCalendar // make the <FullCalendar> tag available
    },
    data() {
        return {
            calendarOptions: {
                plugins: [dayGridPlugin, timeGridPlugin, interactionPlugin],

                initialView: "dayGridMonth",
                defaultView: "timeGridWeek",
                slotLabelFormat: {
                    hour: "2-digit",
                    minute: "2-digit",
                    // omitZeroMinute: false,
                    meridiem: "short",
                    hour12: true
                },
                // eventResize: function(event){
                //     alert('Cambiaste el tamano' + event.event.id);
                //     console.log(event);
                // },
                // timeFormat: "H:(mm)",
                locale: "es",
                locales: [esLocale],
                // editable: true,
                dateClick: this.handleDateClick,
                eventClick: this.editarClick,
                events: "/calendarios",

                // events: [
                //     // { title: "event 1", date: "2021-06-08", color: "#16D3A2" },
                //     {
                //         title: "event 2",
                //         start: "2021-06-19T15:00:40",
                //         color: "#F84B05",
                //         description: "This is a cool event"
                //     },
                //     {
                //         title: "event 2",
                //         start: "2021-06-20T10:30:40",
                //         end: "2021-06-20T15:00:40",
                //         color: "#0572E0",
                //         description: "This is a cool event"
                //     },
                //     {
                //         title: "event 1",
                //         start: "2021-06-08",
                //         end: "2021-06-08",
                //         color: "#16D3A2",
                //         description: "This is a cool event"
                //     }
                // ],
                headerToolbar: {
                    center: "title",
                    end:
                        "dayGridMonth, timeGridWeek, timeGridFourDay, timeGridDay",
                    start: "today prev,next"
                },
                views: {
                    timeGridFourDay: {
                        type: "timeGrid",
                        duration: { days: 4 },
                        buttonText: "4 dias"
                    }
                }
            },
            title: "",
            start: "",
            end: "",
            // color: "#039be5",
            description: "",
            mostrar: false,
            id: 0,
            user_id: 0,
          
        };
    },
    mounted() {

        axios
            .get("/calendarios")
            .then(res => {
                // console.log(res.data);

                this.events = res.data;

                // console.log(this.events);

                this.mostrarEvent();
            })
            .catch(err => console.log(err));

        this.start = moment().format("YYYY-MM-DD hh:mm:ss");
        this.end = moment().format("YYYY-MM-DD hh:mm:ss");
    },
    methods: {
        mostrarEvent() {
            this.title = "";
            this.mostrar = true;
        },
        ocultarEvent() {
            this.mostrar = false;
        },
        handleDateClick: function(arg) {
            // console.log(arg);

            this.showModal(arg);

            // const title = 'evento 404';

            // this.events.push({
            //   title: title,
            //   date: arg.dateStr
            // })
        },
        editarClick: function(info) {
            this.id = info.event.id;
            this.title = info.event.title;
            this.description = info.event.extendedProps.description;
            this.user_id = info.event.extendedProps.user_id;
            // this.start = info.event.start;
            // this.end = info.event.end;

            console.log(info.event);
            this.showModalEdit(info.event);

            // this.eliminar();
        },
        showModal(arg) {
            $(evento).modal("show");

            // console.log(arg);

            this.comentario = '';
            this.description = '';

            this.start = arg.dateStr;
            this.end = arg.dateStr;
        },
        showModalEdit(arg) {
            $(eventoEdit).modal("show");

            // console.log(arg);

            // this.start = arg.dateStr;
            // this.end = arg.dateStr;
        },
        eliminar() {
            this.ocultarEvent();

            this.$swal
                .fire({
                    title: "Esta seguro que desea eliminar la cita?",
                    // text: "You won't be able to revert this!",
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Eliminar"
                })
                .then(result => {
                    if (result.isConfirmed) {
                        axios
                            .delete("/calendario/" + this.id)
                            .then(res => {
                                console.log(res.data);
                                this.mostrarEvent();
                                $(eventoEdit).modal("hide");
                                this.$swal.fire({
                                    icon: "success",
                                    title: "Cita eliminada correctamente.",
                                    showConfirmButton: true,
                                    timer: 1300
                                });
                            })
                            .catch(err => console.log(err));
                    } else {
                        this.mostrarEvent();
                    }
                });
        },
        async guardar() {
            const datos = {
                title: this.title,
                start: this.start,
                end: this.end,
                color: document.getElementById("color").value,
                description: this.description,
                doctor_id: parseInt(this.doctor_id),
                estatus: 1
            };

            // console.log(this.arreglarFecha(datos.start))
            this.ocultarEvent();

            // console.log(this.color);

            await axios
                .post("/calendarios", datos)
                .then(res => console.log(res.data))
                .catch(err => console.log(err));

            this.mostrarEvent();
            $(evento).modal("hide");
        },

        arreglarFecha(fecha) {
            return moment(fecha).format("YYYY-MM-DD hh:mm:ss");
        }
    }
};
</script>
