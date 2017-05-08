(function ($) {

    var base_url = window.location.origin;
    var counter = 1;
    var t = $('#table-produ').DataTable({'columnDefs': [{'targets': [0],
                'visible': false},
            {'targets': [1],
                'visible': false}]});
    var tv = $('#dt-lista-ventas').DataTable({'columnDefs': [{'targets': [0],
                'visible': false}]});
    var idDtVen = 0;
    var itemProdu = [];

    $('#add-btn').click(function () {
        window.location.replace(base_url + '/ventas/create');
    });

    $('#add-prod').on('click', function () {
        var id = $('#produ-id').val();
        var producto = $('#produ-code').val();
        var cantidad = $('#cantidad-id').val();

        t.row.add([
            id,
            null,
            producto,
            cantidad,
            moment().format("YYYY-MM-DD hh:mm")
        ]).draw(false);

        counter++;
        $('#produ-id').val('');
        $('#produ-code').val('');
        $('#cantidad-id').val('');
    });

    $('#btn-guardar-produ').click(function () {

        var id = $('#btn-guardar-produ').val();
        var oDtaTable = $('#table-produ').dataTable();
        var data = oDtaTable.fnGetData();
        var items = [];
        $.each(data, function (i) {
            if (data[i][1] === null) {
                var ventas = {Producto: data[i][0], Cantidad: data[i][3], Fecha: data[i][4]};
                items.push(ventas);
            }
        });
        $.ajax({
            method: 'POST',
            url: base_url + '/ventas/add/' + id,
            dataType: 'json',
            data: {items},
            success: (function () {
                alert("Felicitaciones, se guardo con éxito.");
                window.location.replace(base_url + '/ventas');
            }),
            error: (function (err) {
                alert('Mensaje: ' + err.statusText);
            })
        });
    });

    $('#btn-cancel-produ').click(function () {

    });

    $.getJSON(base_url + '/ventas/productos').done(function (result) {
        var items = [];
        var Productos = {label: null, value: null};
        $.each(result.Productos, function (i) {
            Productos.label = result.Productos[i].Codigo;
            Productos.value = result.Productos[i].Id;
            items.push(result.Productos[i].Codigo);
            itemProdu.push(Productos);
        });
        $('#produ-code').autocomplete({
            source: itemProdu,
            select: function (event, ui) {
                event.preventDefault();
                $("#produ-code").val(ui.item.label);
                $("#produ-id").val(ui.item.value);
            }

        });
        return items;
    });


    $.getJSON(base_url + '/ventas/listaVentas').done(function (result) {
        $.each(result.Ventas, function (i) {
            tv.row.add([
                result.Ventas[i].Id,
                result.Ventas[i].OrdenCompra,
                moment(result.Ventas[i].FechaCreacion).format('DD-MM-YYYY'),
                moment(result.Ventas[i].FechaCompra).format('DD-MM-YYYY'),
                moment(result.Ventas[i].FechaEntrega).format('DD-MM-YYYY'),
                "<a href='#'>linkCotizacion</a>"
            ]).draw(false);
        });
    });

    $.getJSON(base_url + '/ventas/listaDetalleVenta/' + getIdFromUrl()).done(function (result) {
        $.each(result.DetalleVenta, function (i) {
            t.row.add([
                result.DetalleVenta[i].Id,
                result.DetalleVenta[i].VentasId,
                result.DetalleVenta[i].Producto,
                result.DetalleVenta[i].Cantidad,
                moment(result.DetalleVenta[i].Fecha).format('DD-MM-YYYY hh:mm')
            ]).draw(false);
        });
    });

    function getIdFromUrl() {
        var query = window.location.href;
        var vars = query.split('/');
        var id = vars[vars.length - 1];
        return id;
    }

    tv.on('dblclick', 'tr', function () {
        var id = tv.row(this).data();
        window.location.replace(base_url + '/ventas/add/' + id[0]);
    });
    
    t.on('click', 'tr', function () {
        idDtVen = [];
        var row_index = t.row( this ).index();
        idDtVen = t.row(this).data();        
        idDtVen.push(row_index);
    });
    
    $('#delete-prod').click(function () {        
         $.ajax({
            method: 'PUT',
            url: base_url + '/ventas/delete/' + idDtVen[0],            
            success: (function () {
                alert("Se elimino con éxito.");
                var oDtaTable = $('#table-produ').dataTable();
                oDtaTable.fnDeleteRow(idDtVen[5]);                
            }),
            error: (function (err) {
                alert('Mensaje: ' + err.statusText);
            })
        }).done(function(){});

    });


})(jQuery);