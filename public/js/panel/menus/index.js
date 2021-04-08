$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
var table;

$(document).ready(function() {

  table = $('#menus-table').DataTable({
           'responsive'  : false,
           'autoWidth'   : true,
           'destroy'     : true,
           'deferRender' : true,
           'language': {
              "decimal": "",
              "emptyTable": "No hay información",
              "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
              "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
              "infoFiltered": "(Filtrado de _MAX_ total entradas)",
              "infoPostFix": "",
              "thousands": ",",
              "lengthMenu": "Mostrar _MENU_ Entradas",
              "loadingRecords": "Cargando...",
              "processing": "Procesando...",
              "search": "Buscar:",
              "zeroRecords": "Sin resultados encontrados",
              "paginate": {
                  "first": "Primero",
                  "last": "Ultimo",
                  "next": "Siguiente",
                  "previous": "Anterior"
              }
            }
          });

});


$("#search"  ).click(function() {
    var formulario = $("#formIndexMenus").serializeObject();

    table = $('#menus-table').removeAttr('width').DataTable({
            'ajax': {
              'url': "/getMenus",
              'type':"POST",
              'data' :{ formulario : formulario }
            },
            'responsive'    : false,
            'destroy'       : true,
            'language': {
               "decimal": "",
               "emptyTable": "No hay información",
               "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
               "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
               "infoFiltered": "(Filtrado de _MAX_ total entradas)",
               "infoPostFix": "",
               "thousands": ",",
               "lengthMenu": "Mostrar _MENU_ Entradas",
               "loadingRecords": "Cargando...",
               "processing": "Procesando...",
               "search": "Buscar:",
               "zeroRecords": "Sin resultados encontrados",
               "paginate": {
                   "first": "Primero",
                   "last": "Ultimo",
                   "next": "Siguiente",
                   "previous": "Anterior"
               }
             },
            'columns'       : [
              {data:"id",
              "render": function (data, type, row) {
                return '<div class="btn-group">'+
                '<a href="/menus/'+data+'"      class="btn btn-default btn-xs"><i class="glyphicon glyphicon-eye-open"></i></a>'+
                '<a href="/menus/'+data+'/edit" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-edit"></i></a>'+
                '</div>';
              }},
              {data:"menu",
              "render": function (data, type, row) {
               return (data) ? data : '-';
              }},
              {data:"section",
              "render": function (data, type, row) {
               return (data) ? data : '-';
              }},
              {data:"path",
              "render": function (data, type, row) {
               return (data) ? data : '-';
              }},
              {data:"icon",
              "render": function (data, type, row) {
               return (data) ? data : '-';
              }},
              {data:"note",
              "render": function (data, type, row) {
               return (data) ? data : '-';
              }},
              {data:"modified_by",
              "render": function (data, type, row) {
               return (data) ? data : '-';
              }},
            ],
          });
});

$("#clean"  ).click(function() {
//de acuerdo a los campos q quiero limpiar
  $('#menu'   ).val('').trigger('change');
  $('#section').val('').trigger('change');

});


//GET ARRAY FORM
$.fn.serializeObject = function(){
    var o = {};
    var a = this.serializeArray();
    $.each(a, function() {
        if (o[this.name]) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};
