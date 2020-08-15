!function ($) {
		"use strict";
    var $frmCreate = $("#frmCreate"),
        $frmUpdate = $("#frmUpdate"),
        dataTable = ($.fn.dataTable !== undefined);

        if ($(".datatable").length > 0 && dataTable) {
            var dataTable = $('.datatable').DataTable( {
                "processing": true,
                "searching" : true,
                "paging": true,
                "order" : [],
                "ajax": {
                    "url": myLabel.users,
                    "type": 'POST',
                    "dataSrc": "data"
                },
                "oLanguage": {
                    "sEmptyTable": "Empty Table"
                },
                dom: 'lBfrtip',
                buttons: [
                'excel', 'csv', 'pdf'
                ],
                "columnDefs": [ {
                    "targets": 0,
                    "orderable": false
                },{
                    visible: false
                } ],
                "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ]
            }).on('click', '.edit', function (e) {
                var id = $(this).data('id');
                window.location.href = myLabel.edit + id;
            }).on('click', '.delete', function (e) {
                //var id = $(this).data('id');

                var arrayId = [];
                $('.datatable input[type=checkbox]').each(function () {
                    if ($(this).is(":checked")) {
                        var id = $(this).data('id');
                        if (id != undefined || id != 0 || id != '' || id != null) {
                            arrayId.push(id);
                        } 
                    }
                });
                //console.log(arrayId);
                if (arrayId.length > 0) {
                    swal({
                        title: "Confirm Delete",
                        text: "Are you want to delete this record?(Yes/No)",
                        type: "info",
                        showCancelButton: true,
                        closeOnConfirm: false,
                        showLoaderOnConfirm: true
                    }, function () {
                        /*
                    setTimeout(function () {
                        $.ajax({
                            type: "GET",
                            url: myLabel.baseUrl + '/artists/delete/' + id,
                            cache: false,
                            success: function (res) {
                                if (res.status === true) {
                                    swal(res.message);
                                } else {
                                    swal(res.message);
                                }

                                dataTable.ajax.reload();
                            }
                        });
                    }, 2000);
                        */
                    });
                } else {
                    swal("You must select one record");
                }

            }).on('click', '#checkAll', function () {
                $('.datatable input[type=checkbox]').prop('checked', this.checked);
            });
        }
      
        
        $(".alert").fadeTo(2000, 500).slideUp(500, function(){
            $(".alert").slideUp(500);
        });
        
        function loadDataTable(data = null) {
         var dataTable = $('.datatable').DataTable( {
                "processing": true,
                "searching" : true,
                "paging": true,
                "order" : [],
                "ajax": {
                    url: myLabel.users,
                    type : 'get',
                    data: {}
                },
                "oLanguage": {
                    "sEmptyTable": "Empty Table"
                },
                dom: 'lBfrtip',
                buttons: [
                'excel', 'csv', 'pdf'
                ],
                "columnDefs": [ {
                    "targets": 0,
                    "orderable": false
                },{
                    visible: false
                } ],
                "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ]
         });
        }
   
}(window.jQuery);

