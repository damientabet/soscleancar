$(document).ready(function(){
    if ($('.js-infos').length > 0) {
        displayFlashMessages();
    }

    $('.btn-delete-element').on('click', function(e){
        confirmAlert(e, $(this).attr('href'));
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

function confirmAlert(e, href) {
    e.preventDefault();
    Swal.fire({
        title: Translator.trans('Are you sure you want to delete the item ?', {} , 'messages'),
        icon: "warning",
        showCancelButton: true,
        showConfirmButton: true,
        confirmButtonText: '<i class="fas fa-trash"></i> ' + Translator.trans("Delete", {} , 'messages'),
        cancelButtonText: Translator.trans("Cancel", {} , 'messages'),
        confirmButtonColor: '#d6303e',
        showCloseButton: false,
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = window.location.origin + href;
        }
    })
}