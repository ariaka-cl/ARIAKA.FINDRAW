(function($) {

    var base_url = window.location.origin;
    var counter = 1;
    var t = $('#table-produ').DataTable();


    $('#add-btn').click(function() {
        window.location.replace(base_url + '/ventas/add');
    });




    $('#add-prod').on('click', function() {
        var producto = $('#heard option:selected').text();
        var cantidad = $('#cantidad-id').val();
        var reserva = '<input type="checkbox" name="hobbies[]" id="hobby2" value="run" class="flat" checked=""/>'

        t.row.add([
            producto,
            cantidad,
            moment().format("YYYY-MM-DD hh:mm"),
            reserva
        ]).draw(false);

        counter++;
    });

    $('#btn-guardar-produ').click(function() {

        $.ajax({
            method: 'POST',
            url: base_url + 'ventas/add',
            data: { name: '', algo: '' },
            success: (function(result) {
                alert(result);
            })
        });
    });

})(jQuery);