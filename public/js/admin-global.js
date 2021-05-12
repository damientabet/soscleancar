$(document).ready(function(){
    if ($('.js-infos').length > 0) {
        displayFlashMessages();
    }

    $('.btn-delete-element').on('click', function(e){
        confirmAlert(e);
    })
})

function displayFlashMessages() {
    Swal.fire({
        toast: true,
        title: $('.js-infos').data('message'),
        icon: $('.js-infos').data('label'),
        position: 'top-end',
        showCancelButton: false,
        showConfirmButton: false,
        showCloseButton: false,
        timer: 2000,
        timerProgressBar: true,
    })
}

function confirmAlert(e) {
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
}