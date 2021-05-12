$(document).ready(function(){
    $('.btn-delete-element').on('click', function(e){
        e.preventDefault();
        Swal.fire({
            title: 'Are you sure you want to delete the item ?',
            icon: "warning",
            showCancelButton: true,
            showConfirmButton: true,
            confirmButtonText: '<i class="fas fa-trash"></i> Delete',
            confirmButtonColor: '#d6303e',
            showCloseButton: false,
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = window.location.origin + $(this).attr('href');
            }
        })
    })
})