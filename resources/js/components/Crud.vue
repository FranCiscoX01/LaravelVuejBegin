<template>
    <div class="container container-task">
        <div class="row">
            <div class="col-md-6">
                <h2>Lista de tareas</h2>
                <table class="table text-center"><!--Creamos una tabla que mostrará todas las tareas-->
                        <thead>
                            <tr>
                                <th scope="col">Nombre</th>
                                <th scope="col">Descripcion</th>
                                <th scope="col">Contenido</th>
                                <th scope="col">Precio</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="task in arrayTasks" :key="task.id"> <!--Recorremos el array y cargamos nuestra tabla-->
                                <td v-text="task.name"></td>
                                <td v-text="task.description"></td>
                                <td v-text="task.content"></td>
                                <td v-text="task.price"></td>
                                <td>
                                    <!--Botón modificar, que carga los datos del formulario con la tarea seleccionada-->
                                    <button class="btn btn-info" @click="loadFieldsUpdate(task)"><i class="far fa-edit"></i></button>
                                    <!--Botón que borra la tarea que seleccionemos-->
                                    <button class="btn btn-danger" @click="deleteTask(task)"><i class="far fa-trash-alt"></i></button>
                                    <!--Botón que comprar con Openpay-->
                                    <div v-if="caca != undefined">
                                        <button class="btn btn-success"><i class="fas fa-cart-plus"></i></button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
            </div>
            <div class="col-md-6">
                <div class="form-group"><!-- Formulario para la creación o modificación de nuestras tareas-->
                    <label>Nombre</label>
                    <input v-model="name" type="text" class="form-control">

                    <label>Descripcion</label>
                    <input v-model="description" type="text" class="form-control">

                    <label>Contenido</label>
                    <input v-model="content" type="text" class="form-control">

                    <label>Precio</label>
                    <input v-model="price" type="text" class="form-control">
                </div>
                <div class="container-buttons">
                    <!-- Botón que añade los datos del formulario, solo se muestra si la variable update es igual a 0-->
                    <button v-if="update == 0" @click="saveTasks()" class="btn btn-success">Añadir</button>
                    <!-- Botón que modifica la tarea que anteriormente hemos seleccionado, solo se muestra si la variable update es diferente a 0-->
                    <button v-if="update != 0" @click="updateTasks()" class="btn btn-warning">Actualizar</button>
                    <!-- Botón que limpia el formulario y inicializa la variable a 0, solo se muestra si la variable update es diferente a 0-->
                    <button v-if="update != 0" @click="clearFields()" class="btn">Atrás</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { METHODS } from 'http';
export default {
    props:{
        user:Array,
    },
    data() {
        return {
            name:"", //Esta variable, mediante v-model esta relacionada con el input del formulario
            description:"", //Esta variable, mediante v-model esta relacionada con el input del formulario
            content:"", //Esta variable, mediante v-model esta relacionada con el input del formulario
            price:"",
            update:0, /*Esta variable contrarolará cuando es una nueva tarea o una modificación, si es 0 significará que no hemos seleccionado
                        ninguna tarea, pero si es diferente de 0 entonces tendrá el id de la tarea y no mostrará el boton guardar sino el modificar*/
            arrayTasks:[], //Este array contendrá las tareas de nuestra bd
        }
    },
    methods:{
        getTasks(){
                let me =this;
                let url = 'crud-vuejs-axios' //Ruta que hemos creado para que nos devuelva todas las tareas
                axios.get(url).then(function (response) {
                    //creamos un array y guardamos el contenido que nos devuelve el response
                    me.arrayTasks = response.data;
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
        },
        saveTasks(){
                let me =this;
                let url = 'crud-vuejs-axios' //Ruta que hemos creado para enviar una tarea y guardarla
                axios.post(url,{ //estas variables son las que enviaremos para que crear la tarea
                    'name':this.name,
                    'description':this.description,
                    'content':this.content,
                    'price':this.price,
                }).then(function (response) {
                    Swal.fire({
                        position: 'top-end',
                        type: 'success',
                        title: 'Se ha salvado correctamente!',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    me.getTasks();//llamamos al metodo getTask(); para que refresque nuestro array y muestro los nuevos datos
                    me.clearFields();//Limpiamos los campos e inicializamos la variable update a 0
                })
                .catch(function (error) {
                    console.log(error);
                });

        },
        updateTasks(){/*Esta funcion, es igual que la anterior, solo que tambien envia la variable update que contiene el id de la
                tarea que queremos modificar*/
                let me = this;
                axios.put('crud-vuejs-axios/'+this.update,{
                    'id':this.update,
                    'name':this.name,
                    'description':this.description,
                    'content':this.content,
                    'price':this.price,
                }).then(function (response) {

                    Swal.fire({
                        position: 'top-end',
                        type: 'success',
                        title: 'Cambios Guardados!',
                        showConfirmButton: false,
                        timer: 1500
                    })

                   me.getTasks();//llamamos al metodo getTask(); para que refresque nuestro array y muestro los nuevos datos
                   me.clearFields();//Limpiamos los campos e inicializamos la variable update a 0
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        loadFieldsUpdate(data){ //Esta función rellena los campos y la variable update, con la tarea que queremos modificar
                this.update = data.id
                let me =this;
                let url = 'crud-vuejs-axios-update/'+me.id;
                axios.get(url).then(function (response) {
                    me.name= data.name;
                    me.description= data.description;
                    me.content= data.content;
                    me.price= data.price;
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
        },
        deleteTask(data){//Esta nos abrirá un alert de javascript y si aceptamos borrará la tarea que hemos elegido
                let me =this;
                let task_id = data.id

                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                });
                swalWithBootstrapButtons.fire({
                    title: '¿Seguro que deseas borrar esta tarea?',
                    text: "No podras revertir cambios",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Si, borrarlo!',
                    cancelButtonText: 'No, cancelo!',
                    reverseButtons: true
                    }).then((result) => {
                    if (result.value) {
                        axios.delete('crud-vuejs-axios/'+task_id
                        ).then(function (response) {
                            me.getTasks();
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                        swalWithBootstrapButtons.fire(
                        'Eliminado!',
                        'La tarea fue eliminado.',
                        'success'
                        )
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        swalWithBootstrapButtons.fire(
                        'Cancelado',
                        'La tarea esta a salvo',
                        'error'
                        )
                    }
                })

        },
        clearFields(){/*Limpia los campos e inicializa la variable update a 0*/
                this.name = "";
                this.description = "";
                this.content = "";
                this.price = "";
                this.update = 0;
        },
        FormOpenpay(data){
            let me =this;
            let url = 'crud-vuejs-axios-update/'+me.id;
            axios.get(url).then(function (response) {
                axios.get('mount-openpay').then(function(response){ console.log(response) });
                console.log(data.price);
            })
            .catch(function (error) {
                console.log(error);
            });
        }
    },
    mounted() {
        this.getTasks();
    }
}
</script>
