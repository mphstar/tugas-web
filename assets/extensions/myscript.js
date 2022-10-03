// tombol hapus

document.getElementById('tombol-hapus').addEventListener('click', (e) => {
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Something went wrong!',
        footer: '<a href>Why do I have this issue?</a>'
    })
})