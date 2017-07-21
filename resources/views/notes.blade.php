@extends('layout')

  @section('content')

      <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <h1>Notas rapidas</h1>

                  
 
                    <table class="table table-striped">
                      <tr>
                          <th>Categoría</th>
                          <th>Nota</th>
                          <th width="50px">&nbsp;</th>
                      </tr>
                      <!-- Aquie esta toda la logica para mostrar todas las notas, esta usa el atributo is, el cual indica que esa fila tr, es del componente note-row, todo para escribir un html valido, dado que la tabla debe contener varias filas, pasamos la nota "note", y el listado completo de categorias-->
                      <tr v-for="note in notes" is="note-row" :note.sync="note" :categories="categories"></tr>
                      
                      <tr>
                          <!--Crear nueva nota. componente -->
                          <!-- Select que muestra el array de categories, de igual forma esta enlazado con la nueva nota en el boton.-->
                          <td><select-category :categories="categories" :id.sync="new_note.category_id"></select-category></td>
                          <td>

                            <input type="text" v-model="new_note.note" class="form-control">
                            <ul v-if="errors.length" class="text-danger"><!-- si hay errores mostrar esta lista-->
                               <li v-for="error in errors">@{{error}}  </li><!--importante colocar este arroba para que no salga un error de interpolacion de json y blade -->
                            </ul>

                          </td>
                          
                          <td>
                              <a href="#" @@click.prevent ="createNote()">
                                  <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                              </a>
                          </td>
                      </tr>
                    </table>
                    <pre>@{{ $data | json }}</pre><!-- muestra los datos en json. -->
                </div>
      </div>

  @endsection

  @section('scripts')
    @verbatim <!-- Etiqueta para blade lea json-->
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
                    <a href="#" @click.prevent="edit()"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
                    <a v-show="note.category_id !=3" href="#" @click.prevent="remove()">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </a>
                </td>
      </template>


            <template v-else>
                <td>
                <!-- Ejercicio del video anterior soluciando, utilizando filtro desde el JS-->
                <!--Con este se creo un componente. para mejorar el codigo. -->
                <!--se pasa por las propiedades la lista de categorias y el id de la notas -->
                    <select-category :categories="categories" :id.sync="draf.category_id"></select-category>
                </td>
                <td>
                  <input type="text" v-model="draf.note" class="form-control">
                  <ul v-if="errors.length" class="text-danger">
                       <li v-for="error in errors">{{error}}  </li>
                  </ul>

                </td>
                <td>

                  <a href="#" @click.prevent="update()">
                    <span class="glyphicon glyphicon-ok" aria-hidden="true">
                    </span>
                  </a>

                  <a href="#" @click.prevent="cancel()">
                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                    </a>

                </td>
            </template>
        </tr>
      </template> 
    @endverbatim
      
      <script src="http://code.jquery.com/jquery-2.2.4.js"
        integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI="
        crossorigin="anonymous"></script>
      <script src="{{ url('js/vue.js') }}"></script>

      <script src="https://cdnjs.cloudflare.com/ajax/libs/vue-resource/1.3.4/vue-resource.js"></script><!--componente mas liviano para usar ajax, con eso podemos quitar el scrip de jquery, para el ejemplo lo voy a dejar. -->
      <script src="{{ url('js/notes.js') }}"></script>

      <!--Si el proyecto ya usa la jquery ps, usamos esta forma, sino la otra que con un componente de vue -->

  @endsection
