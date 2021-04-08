$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
var table;

$(document).ready(function() {
  table = $('#tpTokens-table').DataTable({
              'ajax': {
              'url': "/getTpToken",
              'type':"POST",
              },
           'responsive'  : false,
           'autoWidth'   : true,
           'destroy'     : true,
           'deferRender' : true,
           'language': {
              "decimal": "",
              "emptyTable": "No hay registros para mostrar",
              "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
              "infoEmpty": "Mostrando 0 to 0 of 0 registros",
              "infoFiltered": "(Filtrado de _MAX_ total registros)",
              "infoPostFix": "",
              "thousands": ",",
              "lengthMenu": "Mostrar _MENU_ registros",
              "loadingRecords": "Cargando...",
              "processing": "Procesando...",
              "search": "Buscar:",
              "zeroRecords": "Sin resultados encontrados",
              "paginate": {
                  "first": "Primero",
                  "last": "Último",
                  "next": "Siguiente",
                  "previous": "Anterior"
              }
            },
            'columns'       : [
              {data:"id",
              "render": function (data, type, row) {
                return '<div class="btn-group">'+
                '<a href="/token/'+data+'"      class="btn btn-outline-blue btn-icon"><i class="fas fa-eye"></i></a>'+
                '<a href="/token/'+data+'/edit" class="btn btn-outline-blue btn-icon"><i class="fas fa-edit"></i></a>'+
                '</div>';

              }},
              {data:"descripcion",
              "render": function (data, type, row) {
               return (data) ? data : '-' ;
              }},
              {data:"status",
              "render": function (data, type, row) {
                return (data == true)? '<a onclick="estatusUpload('+row.id+', \'desactivar\')" class="btn btn-outline-green btn-icon"><i class="fas fa-unlock"></i><a>' :
                '<a onclick="estatusUpload('+row.id+', \'activar\')" class="btn btn-outline-red btn-icon"><i class="fa fa-lock"></i><a>';
              }},

          ],
        });
});

function estatusUpload(id, accion) {
  alertify.confirm('<div align="center">¡Aviso!</div>', '<div align="center">\t\t ¿Confirmas que deseas '+accion+' este token?</div>',
  function(){

    $.ajax({
      url: "/updateStatusTpToken", //ESTO VARIA
      type:"post",
      data:{
        id : id
      },
      beforeSend: function () {    },
    }).done( function(d) {
      if(d.object == 'success'){
        table.ajax.reload();
      }
    }).fail  ( function() { alert("No se logró actualizar el estado del registro, por favor contacte con el administrador. (Error: UPJSAPPToken)");
  }).always( function() {       });

  }
  , function(){}).set('labels', {ok:'Continuar', cancel:'Cancelar'});
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
