<script>
    var page = 1;
    var perPage = 10;
    var texto = '';
    let count = 1;
    let action = '';

    $(document).ready(function() {
        $('#patente, #fecha_inicial, #fecha_final').on('keydown', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault(); // Evitar la acción predeterminada
                $('#btn_buscar').click();
            }
        });
        console.log('inicia');
        loadData();
    });

    // Función para cargar datos utilizando AJAX
    function loadData() {
        $('#preload-spinner').css('display', 'block');
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        texto = $('#patente').val();
        var fecha_inicial = $('#fecha_inicial').val();
        var fecha_final = $('#fecha_final').val();
        var url = '{{ route('buscar-patente') }}';
        var data = {
            texto: texto,
            page: page,
            fecha_inicial: fecha_inicial,
            fecha_final: fecha_final,
            perPage: perPage
        };
        let d = GetDataAjax(url, 'post', data)
            .then(function(data) {
                count = (page - 1) * perPage + 1;
                $('#tbody').empty();
                $('#fecha_inicial').val(ordenarFechaHumano(data.data.fecha_inicial));
                $('#fecha_final').val(ordenarFechaHumano(data.data.fecha_final));
                console.log(ordenarFechaHumano(data.data.fecha_inicial));
                data.data.result.forEach(function(item) {
                    $('#tbody').append(`
                        <tr class="text-center">
                            <td>${count}</td>
                            <td>${item.patente}</td>
                            <td>${item.color}</td>
                            <td>${item.tipo}</td>
                            <td>${item.date}</td>
                            <td>${item.time}</td>
                        </tr>  `);
                    // if (action == 'left' && page > 1) {
                    //     count--;
                    // } else if (action == 'right') {
                    // }
                    count++;
                });
                $('#preload-spinner').css('display', 'none');
                // Actualiza los botones de paginación
                updatePaginationButtons(data.data.totalPages);
            })
            .catch(function(error) {
                console.log(error);
            });
    }

    // Función para actualizar los botones de paginación
    function updatePaginationButtons(resultLength) {
        // Agrega botones de página anterior
        $('#pagination-buttons').empty();
        if (page > 1) {
            $('#pagination-buttons').html('<button class="btn btn-primary" id="prevPage">Anterior</button>');
        }
        // Agrega el número de página actual
        $('#pagination-buttons').append('<span class="current-page pr-3 pl-3 pt-2">Página ' + page + '</span>');

        // Agrega botones de página siguiente
        if (resultLength >= perPage) {
            $('#pagination-buttons').append('<button class="btn btn-primary" id="nextPage">Siguiente</button>');
        }

        // Manejo de clic en botones de paginación
        $('#prevPage').on('click', function() {
            if (page > 1) {
                page--;
                if (page == 1) {
                    count = 1
                }
                action = 'left';
                loadData();
            }
        });

        $('#nextPage').on('click', function() {
            page++;
            action = 'right';
            loadData();
        });

        //$('#table-patentes').DataTable().destroy();
        InitDataTable('table-patentes');
    }

    // Carga inicial de datos

    function InitDataTable(table_id) {
        if (!$.fn.DataTable.isDataTable('#' + table_id)) {
            $('#' + table_id).DataTable({
                scrollCollapse: true,
                autoWidth: true,
                responsive: true,
                searching: true,
                bLengthChange: true,
                bPaginate: true,
                bInfo: true,
                columnDefs: [{
                    targets: "datatable-nosort",
                    orderable: false,
                }],
                order: [
                    [0, 'asc']
                ],
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "Todos"]
                ],
                "language": {
                    "info": "_START_-_END_ de _TOTAL_ Registros",
                    search: "Buscar",
                    searchPlaceholder: "Ingrese una o más letras",
                    paginate: {
                        next: '<i class="fa fa-chevron-right"></i>',
                        previous: '<i class="fa fa-chevron-left"></i>'
                    },
                    "sZeroRecords": "No existen registros a mostrar",
                    "sInfoEmpty": "Mostrando 0 al 0 de 0 registros",
                    "sInfoFiltered": "(filtrado de _MAX_ registros totales)",
                    "sLengthMenu": "Mostrar _MENU_ Registros",
                },
            });
        };

    }
</script>


<script type="text/javascript">
    $(document).ready(function() {
        $('#btn_buscar').click(function() {
            page = 1;
            count = 1;
            loadData();
        });
    });
</script>
