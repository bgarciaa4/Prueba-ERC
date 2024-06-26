@include('layouts.parte_superior')
<!--INICIO DEL CONTENIDO PRINCIPAL-->

<div class="container-fluid">
    <div class="card shadow mb-12">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="m-0 font-weight-bold text-primary">Categorias</h5>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="">Categorias (Opcional)</label>
                            <select name="categoria" id="categoria" class="form-control">
                                <option value="">Seleccione una Categoria...</option>
                                @foreach($categorias as $categoria)
                                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="">(Sub-)Categoria</label>
                            <input type="text" class="form-control" id="subcategoria" name="subcategoria">
                        </div>
                        <div class="col-md-4">
                            <label for="">Descripcion</label>
                            <input type="text" class="form-control" id="descripcion" name="descripcion">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="">Stock</label>
                            <input type="number" class="form-control" id="stock" name="stock">
                        </div>
                    </div>
                    <br>
                    <button type="button" class="btn btn-success" onclick="store()">Guardar</button>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <table id="reporteCategorias" class="table table-bordered table-condensed table-striped"
                        width="100%">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th>ID</th>
                                <th>Categoria</th>
                                <th>Stock</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categoriasTable as $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->nombre}}</td>
                                    <td>{{$item->stock}}</td>
                                    <td>
                                        @if ($item->flag_editar == 1)
                                            <div class="form-group row justify-content-center">
                                                <form action="{{route('categorias.editar')}}" method="post" id="">
                                                @csrf
                                                    <input type="hidden" name="id" id="id" value="{{$item->id}}">
                                                    <button type="submit" class="btn btn-warning btn-sm">Editar</button>
                                                </form>

                                                <form action="{{route('categorias.eliminar')}}" method="post" id="">
                                                @csrf
                                                    <input type="hidden" name="id" id="id" value="{{$item->id}}">
                                                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                                </form>


                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!--FIN DEL CONTENIDO PRINCIPAL-->
@include('layouts.parte_inferior')

<script>
    $(document).ready(function() {

    });

    function store() {
        let categoria = $('#categoria').val();
        let subcategoria = $('#subcategoria').val();
        let descripcion = $('#descripcion').val();
        let stock = $('#stock').val();
        if (subcategoria == "" || descripcion == "" || stock == "") {
            alert('Por favor llene los campos necesarios');
            return;
        }
        if (stock <= 0) {
            alert('Stock no puede ser igual o menor a cero');
            return;
        }
        $.ajax({
            url: "{{route('categorias.store')}}",
            type: "post",
            data: {
                categoria: categoria,
                subcategoria: subcategoria,
                descripcion: descripcion,
                stock: stock,
                _token: "{{ csrf_token() }}"
            }
        }).done(function(res) {
            if (res == 'success') {
                if (!alert('Categoria Guardada Con Éxito.')) {
                    window.location.reload();
                }
            }
        });
    }

    function Editar(id)
    {
        $.ajax({
            url: "{{route('categorias.editar')}}",
            type: "post",
            data: {
                id: id,
                _token: "{{ csrf_token() }}"
            }
        }).done(function(res) {
            if (!alert('Da click en Actualizar para guardar la informacion!')) {
                let categoria = $('#categoria').val();
                let subcategoria = $('#subcategoria').val();
                let descripcion = $('#descripcion').val();
                let stock = $('#stock').val();
            }
        });
    }
</script>
