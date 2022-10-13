$(document).ready(function () {
	$("#menu_ocultar").click(function () {
		$("#sidebar").toggle("slow", function () {
			$(".main-panel").width("100%");
		});
	});
})

function mensajes(Data, capa) {
	if (Data.error == true) {
		$("." + capa).append(Data.msg);
		$("." + capa).show(1000);
	}
	else {
		$("." + capa).append(Data.msg);
		$("." + capa).show(1000);
		$('#articleModal').modal('hide');
		setTimeout("location.reload()", 1500);
	}
}

function _validForm(form) {
    let tipo = 'success';
    let contadorerror = 0;
    const $inputs = $(form).find('div').children().find(':input.requerido[type="text"]') //INPUTS
    const $inputsnumber = $(form).find('div').children().find(':input.requerido[type="number"]') //INPUTS
    const $selects = $(form).find('div').children().find('select.requerido') //SELECTS
    $inputs.each(function (_index, element) {
        if ($(element).val() == 0) {
            $(element).addClass('is-invalid');
            contadorerror = contadorerror + 1;
            console.log(element)
        } else
            $(element).addClass('is-valid');
    });
    $inputsnumber.each(function (index, element) {
        if ($(element).val() < 0 || $(element).val() === '') {
            $(element).addClass('is-invalid');
            contadorerror = contadorerror + 1;
            console.log(element)
        } else
            $(element).addClass('is-valid');
    });
    $selects.each(function (index, element) {
        if ($(element).val() == 0) {
            $(element).addClass('is-invalid');
            contadorerror = contadorerror + 1;
            console.log(element)
        } else
            $(element).addClass('is-valid');
    });
    return contadorerror;
}

function _msjLateral(resp) {
    if (resp) {
        toastr.success('Datos Actualizados.');
    } else
        toastr.error('Error al actalizar la información.');
}

function alertas(msj, tipo = 'success') {
    //Tipo de alerta success-error-warning-info-question
    Swal.fire(
        'Resultado de operación',
        msj,
        tipo
    );
}

function eliminarRegistro(url, id) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "¡No podrás revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si Eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value === true) {
            $.ajax({
                url: url,
                type: 'POST',
                data: { id: id },
                success: function (result) {
                    console.log(result)
                    Swal.fire(
                        'Eliminado!',
                        'Su registro ha sido eliminado..',
                        'success'
                    )
                }
            });
        }
    })
}