(function ($) {

    var base_url = window.location.origin;
    var counter = 1;
    var t = $('#table-produ').DataTable();
    var tv = $('#dt-lista-ventas').DataTable();

    $('#add-btn').click(function () {
        window.location.replace(base_url + '/ventas/add');
    });

    $('#add-prod').on('click', function () {
        var producto = $('#produ-code').val();
        var cantidad = $('#cantidad-id').val();
        var reserva = '<input type="checkbox" name="reservas[]" id="reserve" value="true" class="flat" checked=""/>'

        t.row.add([
            producto,
            cantidad,
            moment().format("YYYY-MM-DD hh:mm"),
            reserva
        ]).draw(false);

        counter++;
        $('#produ-code').val('');
        $('#cantidad-id').val('');
    });

    $('#btn-guardar-produ').click(function () {

        var oDtaTable = $('#table-produ').dataTable();
        var data = oDtaTable.fnGetData();

        $.ajax({
            method: 'POST',
            url: base_url + '/ventas/add',
            data: JSON.stringify(data),
            success: (function (result) {
                alert("Felicitaciones, se guardo con éxito.");
                window.location.replace(base_url + '/ventas');
            }),
            error: (function (err) {
                alert(err.statusText);
            })
        });
    });

    $('#btn-cancel-produ').click(function () {

    }); 
    
    $.getJSON(base_url + '/ventas/productos').done(function (result) {
        var items = [];
        $.each(result.Productos, function (i) {
            items.push(result.Productos[i].Codigo);
        });
        $('#produ-code').autocomplete({
            source: items
        });
        return items;
    });
              
    
    $.getJSON(base_url + '/ventas/listaVentas').done(function (result) {
        $.each(result.Ventas, function (i) {
            tv.row.add([
                result.Ventas[i].OrdenCompra,
                moment(result.Ventas[i].FechaCreacion).format('YYYY-DD-MM'),
                moment(result.Ventas[i].FechaCompra).format('YYYY-DD-MM'),
                moment(result.Ventas[i].FechaEntrega).format('YYYY-DD-MM'),
                "linkCotizacion"
            ]).draw(false);
        });
    });
    
     
})(jQuery);