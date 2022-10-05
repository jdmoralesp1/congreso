function limpiaru() {
    document.formu.reset();
    document.formu.id_u.focus(); //despues de limpiar enfocar el formulario en la casilla id
}

function limpiarc() {
    document.formc.reset();
    document.formc.id_confer.focus(); //despues de limpiar enfocar el formulario en la casilla id
}

function limpiarconfer() {
    document.formconfer.reset();
    document.formconfer.id_conf.focus(); //despues de limpiar enfocar el formulario en la casilla id
}
//validar campos vacios usuario
function validaru() {
    var form = document.formu;
    if (form.id_u.value == 0) {
        Swal.fire({
            title: "ERROR",
            text: "Digite su documento",
            icon: "error"
        });
        form.id_u.value = "";
        form.id_u.focus();
        return false;
    }
    if (form.id_u.value < 10000 || form.id_u.value > 900000000000000) {
        Swal.fire({
            title: "ERROR",
            text: "Digite numero valido",
            icon: "error"
        });
        form.id_u.value = "";
        form.id_u.focus();
        return false;
    }
    if (form.nomb_u.value == 0) {
        Swal.fire({
            title: "ERROR",
            text: "Digite el Nombre",
            icon: "error"
        });
        form.nomb_u.value = "";
        form.nomb_u.focus();
        return false;
    }
    if (form.apel_u.value == 0) {
        Swal.fire({
            title: "ERROR",
            text: "Digite el apellido",
            icon: "error"
        });
        form.apel_u.value = "";
        form.apel_u.focus();
        return false;
    }
    if (form.univ_u.value == 0) {
        Swal.fire({
            title: "ERROR",
            text: "Digite universidad o institución",
            icon: "error"
        });
        form.univ_u.value = "";
        form.univ_u.focus();
        return false;
    }
    if (form.correo_u.value == 0) {
        Swal.fire({
            title: "ERROR",
            text: "Digite el correo",
            icon: "error"
        });
        form.correo_u.value = "";
        form.correo_u.focus();
        return false;
    }
    if (form.tel_u.value == 0) {
        Swal.fire({
            title: "ERROR",
            text: "Digite el telefono",
            icon: "error"
        });
        form.correo_u.value = "";
        form.correo_u.focus();
        return false;
    }
    if (form.tel_u.value < 999999 || form.tel_u.value > 4000000000) {
        Swal.fire({
            title: "ERROR",
            text: "Numero de telefono invalido",
            icon: "error"
        });
        form.correo_u.value = "";
        form.correo_u.focus();
        return false;
    }
    if (form.clave_u.value == 0) {
        Swal.fire({
            title: "ERROR",
            text: "Digite la clave",
            icon: "error"
        });
        form.clave_u.value = "";
        form.clave_u.focus();
        return false;
    }
    
    if (form.clave_u.value == 0) {
        Swal.fire({
            title: "ERROR",
            text: "Clave en rango 4-100 carcacteres",
            icon: "error"
        });
        form.clave_u.value = "";
        form.clave_u.focus();
        return false;
    }
    //ejecutar el evento submit del usuario
    form.submit();
}

function validarc() {
    var form = document.formc;
    if (form.nomb_c.value == 0) {
        Swal.fire({
            title: "ERROR",
            text: "Digite el nombre de la conferencia",
            icon: "error"
        });
        form.nomb_c.value = "";
        form.nomb_c.focus();
        return false;
    }
    if (form.fecha_c.value == 0) {
        Swal.fire({
            title: "ERROR",
            text: "Digite la fecha de la conferencia",
            icon: "error"
        });
        form.fecha_c.value = "";
        form.fecha_c.focus();
        return false;
    }
    if (form.hora_c.value == 0) {
        Swal.fire({
            title: "ERROR",
            text: "Digite la hora de la conferencia",
            icon: "error"
        });
        form.hora_c.value = "";
        form.hora_c.focus();
        return false;
    }
    if (form.link_c.value == 0) {
        Swal.fire({
            title: "ERROR",
            text: "Digite el link de la conferencia",
            icon: "error"
        });
        form.link_c.value = "";
        form.link_c.focus();
        return false;
    }
    if (form.id_conferencista.value == 0) {
        Swal.fire({
            title: "ERROR",
            text: "Digite el id del conferencista",
            icon: "error"
        });
        form.id_conferencista.value = "";
        form.id_conferencista.focus();
        return false;
    }
    form.submit();
}

function validarconfer() {
    var form = document.formconfer;
    if (form.id_conf.value == 0) {
        Swal.fire({
            title: "ERROR",
            text: "Digite documento",
            icon: "error"
        });
        form.id_conf.value = "";
        form.id_conf.focus();
        return false;
    }
    if (form.nomb_conf.value == 0) {
        Swal.fire({
            title: "ERROR",
            text: "Digite nombre",
            icon: "error"
        });
        form.nomb_conf.value = "";
        form.nomb_conf.focus();
        return false;
    }
    if (form.correo_c.value == 0) {
        Swal.fire({
            title: "ERROR",
            text: "Digite correo",
            icon: "error"
        });
        form.correo_c.value = "";
        form.correo_c.focus();
        return false;
    }
    form.submit();
}

function validarlog() {
    var form = document.formlogin;
    if (form.user.value == 0) {
        Swal.fire({
            title: "ERROR",
            text: "Digite correo",
            icon: "error"
        });
        form.id_conf.value = "";
        form.id_conf.focus();
        return false;
    }
    if (form.pass.value == 0) {
        Swal.fire({
            title: "ERROR",
            text: "Digite clave",
            icon: "error"
        });
        form.id_conf.value = "";
        form.id_conf.focus();
        return false;
    }
    form.submit();
}

function eliminar(url) {
    Swal.fire({
        title: '¿Esta seguro?',
        text: 'No se puede reversar la accion',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#0C84DE',
        cancelButtonColor: '#DE190C',
        confirmButtonText: 'Si, Eliminar Registro'
    }).then((result) => {
        if (result.value) {
            window.location = url;
        }
    });

}