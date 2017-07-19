<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Api CRUD VUE JS - LARAVEL 5.2 </title>
 
        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">        
    </head>
    <body>
    @yield('content')

      
      <!-- Categoria -->
      <template id="select_category_tpl">
        <select v-model="id" class="form-control"><!--se enlaza al id que se pasa por la etiqueta del componente -->
            <option value="">- Selecciona una categoría</option>
            <option v-for="category in categories" :value="category.id">
                {{ category.name }}
            </option>
        </select>
      </template>


      <template id="note_row_tpl"><!--Esta pichu template representa toda una nota, la cual va estar ligada al 
      componente este que va mejorar el codigo -->
        <tr>
            <template v-if="! editing">
                <td>{{ note.category_id | category }}</td>
                <td>{{ note.note }}</td>
                <td>
                    <a href="#" @click="edit()"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                    <a href="#" @click="remove()">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </a>
                </td>
      </template>


            <template v-else>
                <td>
                <!-- Ejercicio del video anterior soluciando, utilizando filtro desde el JS-->
                <!--Con este se creo un componente. para mejorar el codigo. -->
                <!--se pasa por las propiedades la lista de categorias y el id de la notas -->
                    <select-category :categories="categories" :id.sync="note.category_id"></select-category>
                </td>
                <td><input type="text" v-model="note.note" class="form-control"></td>
                <td><a href="#" @click="update()"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></a></td>
            </template>
        </tr>
      </template>

      <script src="vue.js"></script>
      <script src="main.js"></script>
    </body>
</html>