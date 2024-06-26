@include('layouts.parte_superior')
<!--INICIO DEL CONTENIDO PRINCIPAL-->

<div class="container-fluid">
    <div class="card shadow mb-12">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="m-0 font-weight-bold text-primary">Reporte de Stock</h5>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <table id="reporte" class="table table-bordered table-condensed table-striped"
                        width="100%">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th>Nivel</th>
                                <th>Descripcion</th>
                                <th>Stock</th>
                            </tr>
                        </thead>
                        <tbody>
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
        $('#reporte').DataTable({
            language: {
                "lengthMenu": "Mostrar _MENU_ registros",
                "zeroRecords": "No se encontraron resultados",
                "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sSearch": "Buscar:",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast":"Último",
                    "sNext":"Siguiente",
                    "sPrevious": "Anterior"
			     },
			     "sProcessing":"Procesando...",
            },
            dom: 'B<"float-right"f>tr<"float-left"li><"float-right"p><"clearfix">',
            autoWidth: true,
            responsive: false,
            processing: true,
            serverSide: true,
            destroy: true,

            ajax: {
                url: "{{ route('Reporte') }}",
                type: 'post',
                data:{
                    _token: "{{ csrf_token() }}"
                }
            },
            aoColumns:
            [
                { data: 'nivel' },
                { data: 'nombre' },
                { data: 'stock_acumulado' }
            ]
        });
    });

</script>
