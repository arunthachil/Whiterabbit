$('.delete_user').on('click', function(e) {
      let id = $(this).data('id');
      e.preventDefault();
      $('#confirm').modal({
          backdrop: 'static',
          keyboard: false
      })
      .on('click', '#delete', function(e) {
          $.ajax({
            type: "DELETE",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "http://localhost:8000/users/"+id,
            success: function(result) {
                location.reload();
            },
            error: function(result) {
                return false;
            }
          });

        //   $form.trigger('submit');
        });
      $("#cancel").on('click',function(e){
       e.preventDefault();
       $('#confirm').modal.model('hide');
      });
    });


    $('.delete_file').on('click', function(e) {
        let id = $(this).data('id');
        e.preventDefault();
        $('#confirm').modal({
            backdrop: 'static',
            keyboard: false
        })
        .on('click', '#delete', function(e) {
            $.ajax({
              type: "DELETE",
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              url: "http://localhost:8000/image-upload/"+id,
              success: function(result) {
                  location.reload();
              },
              error: function(result) {
                  return false;
              }
            });
  
          //   $form.trigger('submit');
          });
        $("#cancel").on('click',function(e){
         e.preventDefault();
         $('#confirm').modal.model('hide');
        });
      });