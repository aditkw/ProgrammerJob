$(document).ready(function() {
        // Ajax for our form
        $('form').on('submit', function(event){
            event.preventDefault();


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $(this).attr('csrf')
                }
            });

            $(this).parents('tr').hide();
            $.ajax({
                type     : "delete",
                url      : $(this).attr('action'),

                success  : function(data) {
                    console.log(data);
                    //$('.container-fluid').html(data['view']);
                    $('#pesan').addClass('alert alert-success').show();
                    $('#pesan').find('#isi_pesan').html(data['pesan']);
                }
            });
        });

        $('a#block').on('click', function(event){
            event.preventDefault();

            $(this).parents('tr').hide();
            $.ajax({
                type     : "get",
                url      : $(this).attr('href'),

                success  : function(data) {
                    console.log(data);
                    //$('.container-fluid').html(data['view']);
                    $('#pesan').addClass('alert alert-success').show();
                    $('#pesan').find('#isi_pesan').html(data['pesan']);
                }
            });
        });

        $('a#unblock').on('click', function(event){
            event.preventDefault();


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $(this).attr('csrf')
                }
            });

            $(this).parents('tr').hide();
            $.ajax({
                type     : "get",
                url      : $(this).attr('href'),

                success  : function(data) {
                    console.log(data);
                    //$('.container-fluid').html(data['view']);
                    $('#pesan').addClass('alert alert-success').show();
                    $('#pesan').find('#isi_pesan').html(data['pesan']);
                }
            });
        });
    });
