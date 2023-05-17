@extends('layouts.admin')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Apartamentos</li>
        </ol>
    </nav>
@endsection

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <button type="button" class="close" style="color: white;opacity: 1;" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            </div>
        </div>
    @endif
    @isset($messages)
        <div class="alert alert-success">  
            <button type="button" class="close" style="color: white;opacity: 1;" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div>
                {{$messages}}
            </div>
        </div>
    @endisset


    @if (session('messages'))
        <div class="alert alert-success">  
            <button type="button" class="close" style="color: white;opacity: 1;" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div>
                {{session('messages')}}
            </div>
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-11">
                    <h3 class="card-title"><strong>Lista de Apartamentos</strong> </h3>
                </div>
                <div class="col-1">
                    <button id="new_building" type="button" class="btn btn-primary" onclick="showModal('Nuevo')">Nuevo</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table id="example2" class="table table-bordered table-hover dataTable dtr-inline" aria-describedby="example2_info">
                <thead>
                    <tr>
                        <th class="sorting sorting_asc">ID</th>
                        <th class="sorting sorting_asc" tabindex="0" rowspan="1" colspan="1">Edificio</th>
                        <th class="sorting sorting_asc" tabindex="0" rowspan="1" colspan="1">Apartamento</th>
                        <th class="sorting sorting_asc" tabindex="0" rowspan="1" colspan="1">Acciones</th>
                        
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalBuilding" tabindex="-1" role="dialog" aria-labelledby="modalBuildingLabel" aria-hidden="true">
        <div class="modal-dialog" `role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalBuildingLabel">Nuevo Apartamento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <x-form_apartments/>
            </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../../plugins/jszip/jszip.min.js"></script>
<script src="../../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<script>
  $(function () {
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "responsive": true,
      ajax: '{{route('apartments')}}',
      columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {
                data: 'action', name: 'action', 
                render: function(data, type, row, meta) {
                    let checkbox = `<button class="btn btn-primary" onclick="showModal('Actualizar', ${row.id})">Editar</button>`;
                    return checkbox;
                },

            },
        ]
    });
  });
  
  $(document).ready(function(){
    $('#example2_length').parent().removeClass('col-md-6');
    $('#example2_filter').parent().removeClass('col-md-6');
    $('#example2_length').parent().addClass('col-md-10');
    $('#example2_filter').parent().addClass('col-md-2');

    
  });
  
</script>
@endsection