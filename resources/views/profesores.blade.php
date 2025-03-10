<x-app-layout>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profesores') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container">
                    <div class="card mt-5">
                        <h3 class="card-header p-3">Profesores cargados en el sistema</h3>
                        <div class="card-body">
                            <table class="table table-bordered data-table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No. trabajador</th>
                                        <th>RFC</th>
                                        <th>Nombre</th>
                                        <th>Plantel</th>
                                        <th width="100px">Accion</th>
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
    </div>

    <script type="text/javascript">
        $(function () {

          var table = $('.data-table').DataTable({
              processing: true,
              serverSide: true,
              ajax: "{{ route('profesores.index') }}",
              columns: [
                  {data: 'id', name: 'id'},
                  {data: 'numero_trabajador', name: 'numero_trabajador'},
                  {data: 'rfc', name: 'rfc'},
                  {data: 'user.name', name: 'user.name'},
                  {data: 'plantel.nombre', name: 'plantel.nombre'},
                  {data: 'action', name: 'action', orderable: false, searchable: false},
              ]
          });

        });
    </script>
</x-app-layout>
