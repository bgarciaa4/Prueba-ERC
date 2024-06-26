@include('layouts.parte_superior')
<!--INICIO DEL CONTENIDO PRINCIPAL-->

    <div class="container-fluid">
        <div class="card shadow mb-12">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="m-0 font-weight-bold text-primary">Actualizar Stock</h5>
                    </div>
                </div>
            </div>
            <div class="card-body">
      <div class="row">
        <form action="{{ route('categorias.actualizar') }}" method="post">
            @csrf
            <input type="hidden" value="{{$producto->id}}" name="id" id="id">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="">Categorias (Opcional)</label>
                            <select name="categoria" id="categoria" class="form-control" disabled>
                                <option value="">Seleccione una Categoria...</option>
                                @foreach($categorias as $categoria)
                                    <option value="{{ $categoria->id }}" {{$categoria->id == $producto->parent_id ? 'Selected' : ''}}>{{ $categoria->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="">Categoria</label>
                            <input type="text" class="form-control" id="subcategoria" name="subcategoria" value="{{$producto->nombre}}" disabled>
                        </div>
                        <div class="col-md-4">
                            <label for="">Descripcion</label>
                            <input type="text" class="form-control" id="descripcion" name="descripcion" value="{{$producto->descripcion}}" disabled>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="">Stock</label>
                            <input type="number" class="form-control" id="stock" name="stock" value="{{$producto->stock}}">
                        </div>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-success">Actualizar</button>
                    <a href="{{url()->previous()}}" class="btn btn-danger">Cancelar</a>
                </div>
            </div>

        </form>
    </div>
    </div>
</div>
</div>
<script>

</script>

    <!--FIN DEL CONTENIDO PRINCIPAL-->
    @include('layouts.parte_inferior')
