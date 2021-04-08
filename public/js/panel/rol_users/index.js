$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
var table;

$(document).ready(function() {
  table = $('#rolUsers-table').DataTable({
              'ajax': {
              'url': "/getRolUsers",
              'type':"POST",
              },
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
            },
            'columns'       : [
              {data:"id",
              "render": function (data, type, row) {
                return '<div class="btn-group">'+
                '<a href="/rol-usuarios/'+data+'"      class="btn btn-default btn-xs"><i class="glyphicon glyphicon-eye-open"></i></a>'+
                '<a href="/rol-usuarios/'+data+'/edit" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-edit"></i></a>'+
                '</div>';
              }},
              {data:"id_user",
              "render": function (data, type, row) {
               return (data) ? row.get_users.email : '-' ;
              }},
              {data:"id_tp_rol",
              "render": function (data, type, row) {
               return (data) ? row.get_tp_rol.descripcion : '-';
              }},
              {data:"status",
             "render": function (data, type, row) {
                return (data == true)? '<a onclick="estatusUpload('+row.id+')"><i class="glyphicon glyphicon-ok-circle"></i><a>' :
                '<a onclick="estatusUpload('+row.id+')"><i class="glyphicon glyphicon-ban-circle"></i><a>';
            }},
          ],
        });

});

function estatusUpload(id) {

  $.ajax({
    url: "/updateStatusRolUsers", //ESTO VARIA
    type:"post",
    data:{
      id : id
    },
    beforeSend: function () {    },
    }).done( function(d) {
      if(d.object == 'success'){
        table.ajax.reload();
      }
    }).fail  ( function() { alert("Ha ocurrido un error en la operación");
    }).always( function() {       });
}

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
