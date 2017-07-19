function findById(items, id) {
    for (var i in items) {
        if (items[i].id == id) {
            return items[i];
        }
    }
 
    return null;
} 

Vue.filter('category', function (id) {
    var category = findById(this.categories, id);

    return category != null ? category.name : '';
});

//componente el cual esta usando para mostrar de una manera mas optimas las categorias, esta ligada a una template 
//llamada select_category_tpl
Vue.component('select-category', {
    template: "#select_category_tpl",
    props: ['categories', 'id']//propiedades la lista de categorias y el id que debemos seleccionar.
});

//aqui tenemos el pichu componente asociada a la template, la cual tiene toda la nota


Vue.component('note-row', {
    template: "#note_row_tpl",
    props: ['note', 'categories'],
    data: function() { 
        return {
            editing: false,
            errors:[]//array donde vasmo a guardar los errores de la edición.
        };
    },
    methods: {
        remove: function () {
            this.$parent.notes.$remove(this.note);
        },
        edit: function () {
            this.editing = true;
        },
        update: function () {

            this.errors =[];
            $.ajax({

                url:'/api/v1/notes/'+this.note.id,
                method:'PUT',
                dataType: 'json',
                data: this.note,
                success: function(data){

                    this.$parent.notes.$set(this.$parent.notes.indexOf(this.note),data.note);//tomamos el valor que tra el componente y lo pasamos  por data a la url
                    // que esta el propiedads con el valor set de vue, y usando js.
                    this.editing=false; //para quitar la edición solo si la guardad fue exitosa, y asi poder mostrar los errores de las validaciones.

                }.bind(this),//una funcion de vue para decir q todo es this.
                
                error:function(jqXHR){

                    this.errors=jqXHR.responseJSON.errors; // para guardar los errores en este array y mostrarlos en la edición.
                }.bind(this)
            });
            
        }
    }
});

var vm = new Vue({
    el: 'body',
    data: {
        new_note: {
            note: '',
            category_id: ''
        },
        notes: [],//AQUI VAMOS A TENER EL CONTENIDO DINAMICAMENTE, la vamos usar con jquery y un componente de Vue resuerce.
        errors:[],//propiedad donde vamos almacenar en cada iteracion del metodo de create note los errores de validación.
        categories: [
            {
                id: 1,
                name: 'Laravel'
            },
            {
                id: 2,
                name: 'Vue.js'
            },
            {
                id: 3,
                name: 'Publicidad'
            }
        ]
    },
    ready: function () {
        $.getJSON('/api/v1/notes',[], function (notes) {//llama la url y esta lee  asigna a esta variable
            
            vm.notes = notes; // vm hace referencia a la variable que contiene todo le Modelo de Vue.

        });
    },
    methods: {
        createNote: function () {

            this.errors = []; //limpiar el array de errores.

            $.ajax({ //peticion ajax para guardar la nota

                url: 'api/v1/notes', //se pasa la url, previamente creada en la route.php
                method: 'POST', //metodo post de guardar
                data: this.new_note,//data que voy a enviar al servidor
                dataType: 'json', //va recibir datos de tipo json
                success: function(data){// si se guarda exitosamente se ejecutara esta funcion que es la que guarda.

                    vm.notes.push(data.note) ; 
                },
                error: function(jqXHR){
                    vm.errors=jqXHR.responseJSON.errors;
                }

            });

           

            this.new_note = {note: '', category_id: ''};
        }
    },
    filters: {
    }
});



