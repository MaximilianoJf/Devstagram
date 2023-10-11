import Dropzone from "dropzone";

Dropzone.autoDiscover = false;

  
const dropzone = new Dropzone(".dropzone", {
    dictDefaultMessage: "Sube aquí tu imagen",
    acceptedFiles: ".png,.jpg,.jpeg,.gif",
    addRemoveLinks: true,
    dictRemoveFile: "Borrar archivo",
    maxFiles: 1,
    uploadMultiple: false,

    //como recuperar el ultimo name y caratula de imagen para que no se pierda si el formularios es incorrecto
    //a la hora de presionar post (Recordar que en el formulario se mantiene el nombre con la funcion old)
    init: function() {
        //se ejecuta cuando dropzone es inicializado
        //trim elimina espacios vacios
        if(document.querySelector('[name="imagen"]').value.trim()){
            //crer un objeto
            const imagenPublicada = {};
            //asignar un tamaño ficticio
            imagenPublicada.size = 1234;
            //ASIGNAR EL NOMBRE DE LA IMAGEN AL VALUE ESCONDIDO DEL FORM
            imagenPublicada.name = document.querySelector('[name="imagen"]').value;

            this.options.addedfile.call(this,imagenPublicada);

            this.options.thumbnail.call(this, imagenPublicada, `/uploads/${imagenPublicada.name}`);

            imagenPublicada.previewElement.classList.add(
                "dz-success",
                "dz-complete"
            );
        }
    },
});

dropzone.on("removedfile", function(){
    document.querySelector('[name="imagen"]').value ="";
})

//callback
dropzone.on("uploadprogress",function(file,xhr,formData){
    let timerInterval
Swal.fire({
    title: 'Subiendo tu imagen',
    html: 'subiendo <b></b>',
    timer: 1000,
    timerProgressBar: true,
    didOpen: () => {
        Swal.showLoading()
        const b = Swal.getHtmlContainer().querySelector('b')
        timerInterval = setInterval(() => {
        b.textContent = Swal.getTimerLeft()
        }, 100)
    },
    willClose: () => {
        clearInterval(timerInterval)
    }
    }).then((result) => {
    /* Read more about handling dismissals below */
   
    })
});

dropzone.on("success", function (file,response){
    console.log(response.imagen);
    document.querySelector('[name="imagen"]').value = response.imagen;
});