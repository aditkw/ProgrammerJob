$(document).ready(function() {
        // Ajax for our form
        $('form.ajax').on('submit', function(event){
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

        $('form#create').on('submit', function(event){
            event.preventDefault();


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $(this).attr('csrf')
                }
            });

            var jobName        = $('input[name="name"]').val();
            var jobDescription = $('textarea[name="description"]').val();
            var jobSalary      = $('input[name="salary"]').val();
            var jobPhoto       = $('#photo')[0].files[0];

            var form = new FormData();
            form.append('name', jobName);
            form.append('description', jobDescription);
            form.append('salary', jobSalary);
            form.append('photo', jobPhoto);

            //var data = {name:jobName, description:jobDescription, salary:jobSalary, photo:jobPhoto};

            $.ajax({
                type     : "post",
                url      : $(this).attr('action'),
                data     : form,
                processData: false,
                contentType: false,

                success  : function(data) {
                    console.log(data);
                    //$('.container-fluid').html(data['view']);
                }
            });

            $('#pesan').addClass('alert alert-success').show();
            $('#pesan').find('#isi_pesan').html('sip berhasil menambah job!');
        });
    });
