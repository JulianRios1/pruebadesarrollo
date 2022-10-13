$(document).ready(function () {
    var productos, idprod;
    idprod = 0;
    productos = [];
    $('#records_table').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "responsive": true,
    });
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    })
    $('.textarea').summernote();
    $('#dsfechainicial').datetimepicker({
        format: 'YYYY/MM/DD'
    });
    $('#dsfechafinal').datetimepicker({
        format: 'YYYY/MM/DD'
    });
    $(document).on('click', '[data-toggle="lightbox"]', function (event) {
        event.preventDefault();
        $(this).ekkoLightbox({
            alwaysShowClose: true
        });
    });
    $("[data-id]").click(function () {
        // proceso los datos del registro
        var json = $(this).data('json');
        $("#ed_nombre").val(json["nombre"]);
        $("#idcategoria").val(json["id"]);
        $("#ed_descripcion").val(json["descripcion"]);
        $("#ed_estado option[value='" + json["estado"] + "']").attr("selected", true);
    });
    $("#btnEditCategoria").click(function () {
        var tipo = 'success';
        var $inputs = $('#FormEditCategoria').find('div').children().find(':input.requerido[type="text"]') //INPUTS
        var $selects = $('#FormEditCategoria').find('div').children().find('select.requerido') //SELECTS
        var contadorerror = 0;
        $inputs.each(function (index, element) {
            if ($(element).val() == 0) {
                $(element).addClass('is-invalid');
                contadorerror = contadorerror + 1;
            } else
                $(element).addClass('is-valid');
        });

        $selects.each(function (index, element) {
            if ($(element).val() == 0) {
                $(element).addClass('is-invalid');
                contadorerror = contadorerror + 1;
            } else
                $(element).addClass('is-valid');
        });
        console.log(contadorerror)
        if (contadorerror === 0) {
            var DataUsu = new FormData(document.getElementById("FormEditCategoria"));
            $.ajax({
                type: "post",
                url: "/Categorias/Editar",
                data: DataUsu,
                dataType: "json",
                processData: false,
                contentType: false,
                success: function (resp) {
                    if (resp.status === false) {
                        tipo = 'error'
                    } else {
                        $("#EditModal").modal('toggle');
                        $("#FormEditCategoria")[0].reset()
                        setTimeout("location.reload()", 1500)
                    }
                    alertas(resp.msj, tipo);
                }
            });
        }
    });
    $("#btnAddCategoria").click(function () {
        var tipo = 'success';
        var $inputs = $('#FormAdd').find('div').children().find(':input.requerido[type="text"]') //INPUTS
        var $selects = $('#FormAdd').find('div').children().find('select.requerido') //SELECTS
        var contadorerror = 0;
        $inputs.each(function (index, element) {
            if ($(element).val() == 0) {
                $(element).addClass('is-invalid');
                contadorerror = contadorerror + 1;
            } else
                $(element).addClass('is-valid');
        });

        $selects.each(function (index, element) {
            if ($(element).val() == 0) {
                $(element).addClass('is-invalid');
                contadorerror = contadorerror + 1;
            } else
                $(element).addClass('is-valid');
        });
        console.log(contadorerror)
        if (contadorerror === 0) {
            var DataUsu = new FormData(document.getElementById("FormAdd"));
            $.ajax({
                type: "post",
                url: "/Categorias/crear",
                data: DataUsu,
                dataType: "json",
                processData: false,
                contentType: false,
                success: function (resp) {
                    if (resp.status === false) {
                        tipo = 'error'
                    } else {
                        $("#new_item").modal('toggle');
                        $("#FormAdd")[0].reset()
                        setTimeout("location.reload()", 1500)
                    }
                    alertas(resp.msj, tipo);
                }
            });
        }
    });
    // PRODUCTOS
    $("[data-producto]").click(function () {
        // proceso los datos del registro
        var json = $(this).data('json');
        console.log(json)
        var categorias_id = $(this).data('categorias');
        $("#ed_nombre").val(json["nombre"]);
        $("#idproducto").val(json["id"]);
        $("#ed_referencia").val(json["referencia"]);
        $("#ed_precio").val(json["precio"]);
        $("#ed_peso").val(json["peso"]);
        $("#ed_stock").val(json["stock"]);

        $("#ed_estado option[value='" + json["estado"] + "']").attr("selected", true);

        categorias_id.forEach(el => {
            $("#ed_categoria_id option[value='" + el + "']").attr("selected", true);
        });
        $("#ed_categoria_id").select2({
            theme: 'bootstrap4'
        });
    });
    $("#btnEditProducto").click(function () {
        var tipo = 'success';
        var $inputs = $('#FormEditProducto').find('div').children().find(':input.requerido[type="text"],:input.requerido[type="number"]') //INPUTS
        var $selects = $('#FormEditProducto').find('div').children().find('select.requerido') //SELECTS
        var contadorerror = 0;
        $inputs.each(function (index, element) {
            if ($(element).val() == 0) {
                $(element).addClass('is-invalid');
                contadorerror = contadorerror + 1;
            } else
                $(element).addClass('is-valid');
        });

        $selects.each(function (index, element) {
            if ($(element).val() == 0) {
                $(element).addClass('is-invalid');
                contadorerror = contadorerror + 1;
            } else
                $(element).addClass('is-valid');
        });
        console.log(contadorerror)
        if (contadorerror === 0) {
            var DataUsu = new FormData(document.getElementById("FormEditProducto"));
            $.ajax({
                type: "post",
                url: "/Productos/Editar",
                data: DataUsu,
                dataType: "json",
                processData: false,
                contentType: false,
                success: function (resp) {
                    if (resp.status === false) {
                        tipo = 'error'
                    } else {
                        $("#EditModal").modal('toggle');
                        $("#FormEditProducto")[0].reset()
                        setTimeout("location.reload()", 1500)
                    }
                    alertas(resp.msj, tipo);
                }
            });
        }
    });
    $("#btnAddProducto").click(function () {
        var tipo = 'success';
        var $inputs = $('#FormAdd').find('div').children().find(':input.requerido[type="text"] , :input.requerido[type="number"] ') //INPUTS
        var $selects = $('#FormAdd').find('div').children().find('select.requerido') //SELECTS
        var contadorerror = 0;
        $inputs.each(function (index, element) {
            if ($(element).val() == 0) {
                $(element).addClass('is-invalid');
                contadorerror = contadorerror + 1;
            } else
                $(element).addClass('is-valid');
        });

        $selects.each(function (index, element) {
            if ($(element).val() == 0) {
                $(element).addClass('is-invalid');
                contadorerror = contadorerror + 1;
            } else
                $(element).addClass('is-valid');
        });
        console.log(contadorerror)
        if (contadorerror === 0) {
            var DataUsu = new FormData(document.getElementById("FormAdd"));
            $.ajax({
                type: "post",
                url: "/Productos/crear",
                data: DataUsu,
                dataType: "json",
                processData: false,
                contentType: false,
                success: function (resp) {
                    if (resp.status === false) {
                        tipo = 'error'
                    } else {
                        $("#new_item").modal('toggle');
                        $("#FormAdd")[0].reset()
                        setTimeout("location.reload()", 1500)
                    }
                    alertas(resp.msj, tipo);
                }
            });
        }
    });
    $("#aggProducto").click(function () {
        var linea_producto = []
        var producto_id = $("#producto_id option:selected").val();
        var json = $("#producto_id").children("option:selected").data('json');
        var cantidad = $("#cantidad").val();
        var stock = json['stock'];
        var precio = $("#precio").val();

        if (parseInt(producto_id) == 0) {
            toastr.error('Seleccione un producto');
            return false;
        }
        if (parseInt(cantidad) == 0 || parseInt(cantidad) <= 0) {
            toastr.error('La Cantidad debe ser mayor o igual a 1');
            return false;
        }
        if (parseInt(cantidad) > parseInt(stock)) {
            toastr.error(`Producto no cuenta con la unidades indicada, Stock : ${stock}`);
            return false;
        }
        linea_producto.producto_id = producto_id;
        linea_producto.cantidad = cantidad;
        linea_producto.precio = precio;
        linea_producto.referencia = json['referencia'];
        linea_producto.nombre_producto = json['nombre']
        productos[idprod] = linea_producto;
        guardar_producto(productos);
        idprod++;
        toastr.success('Guardar producto');
        $("#producto_id option[value='0']").attr("selected", true);
        $("#precio").val('');
        $("#cantidad").val('')
        $("#subtotal").val('');
        $("#producto_id").select2({
            theme: 'bootstrap4'
        });
    })
    $("#btnAddPedido").click(function () {
        if (productos.length == 0) {
            toastr.error(`Debe seleccionar minimo un producto.`);
            return false;
        }
        var tipo = 'success';
        var $inputs = $('#FormAdd').find('div').children().find(':input.requerido[type="text"] , :input.requerido[type="number"] ') //INPUTS
        var $selects = $('#FormAdd').find('div').children().find('select.requerido') //SELECTS
        var contadorerror = 0;
        $inputs.each(function (index, element) {
            if ($(element).val() == 0) {
                $(element).addClass('is-invalid');
                contadorerror = contadorerror + 1;
            } else
                $(element).addClass('is-valid');
        });

        $selects.each(function (index, element) {
            if ($(element).val() == 0) {
                $(element).addClass('is-invalid');
                contadorerror = contadorerror + 1;
            } else
                $(element).addClass('is-valid');
        });
        console.log(contadorerror)
        if (contadorerror === 0) {
            var DataUsu = new FormData(document.getElementById("FormAdd"));
            $.each(productos, function (i, producto) {
                DataUsu.append('producto_id[]', producto.producto_id)
                DataUsu.append('cantidad[]', producto.cantidad)
                DataUsu.append('precio[]', producto.precio)
            });
            $.ajax({
                type: "post",
                url: "/Pedidos/crear",
                data: DataUsu,
                dataType: "json",
                processData: false,
                contentType: false,
                success: function (resp) {
                    if (resp.status === false) {
                        tipo = 'error'
                    } else {
                        $("#new_item").modal('toggle');
                        $("#FormAdd")[0].reset()
                        setTimeout("location.reload()", 1500)
                    }
                    alertas(resp.msj, tipo);
                }
            });
        }
    });
    $("[data-pedido]").click(function(){
        total = 0;
        var json = $(this).data('json');
        let pedido_id = json['id'];
        $("#usuario_name").html(`${json['usuario']}`)
        $("#tercero_name").html(`${json['tercero']}`)
        $("#fecha_creacion").html(`${json['fecha_creacion']}`)
        $("#imprimirLabel").html(`Pedido # ${pedido_id}`)
        var fd = new FormData();
        fd.append('pedido_id', pedido_id);
        $.ajax({
            type: "post",
            url: "/Pedidos/detallepedido",
            data: fd,
            dataType: "json",
            processData: false,
            contentType: false,
            success: function (productos) {
                $("#tproductosimpresion tr").remove();
                $.each(productos, function (i, producto) {
                    if (producto != undefined) {
                        $("#tproductosimpresion").append(`
                        <tr>
                        <td>${producto.id}</td>
                        <td>${producto.nombre}</td>
                        <td>${producto.referencia}</td>
                        <td>${producto.cantidad}</td>
                        <td>${producto.precio * producto.cantidad}</td>
                        </tr>`)
                        total = total + (parseInt(producto.precio) * parseInt(producto.cantidad))
                       
                    }
                });

                $("#tproductosimpresion").append(`<tr><td colspan=4>Total:</td><td>${total}</td></tr>`)
            }
        });
        
    });

})

function validar_referencia() {
    let referencia = $("#referencia").val()
    $("#referencia").removeClass('is-invalid');
    $("#referencia").removeClass('is-valid');
    if (referencia != '') {
        var formData = new FormData();
        formData.append("referencia", referencia);
        $.ajax({
            type: "post",
            url: "/Productos/validar_referencia",
            data: formData,
            dataType: "json",
            processData: false,
            contentType: false,
            success: function (resp, e) {
                if (resp.status == true) {
                    $("#referencia").focus()
                    toastr.error(resp.msj);
                    $("#referencia").addClass('is-invalid');
                } else {
                    $("#referencia").addClass('is-valid');
                }
            }
        });
    }
}

function proceso_producto() {
    var json = $("#producto_id").children("option:selected").data('json');

    $("#precio").val(json["precio"]);
    $("#subtotal").val(json["precio"]);
    $("#stock").val(json["stock"]);


}
function guardar_producto(productos) {
    total = 0;
    productos.sort();
    $("#tproductos tr").remove();
    $.each(productos, function (i, producto) {
        if (producto != undefined) {
            $("#tproductos").append(`
            <tr>
            <td>${producto.producto_id}</td>
            <td>${producto.nombre_producto}</td>
            <td>${producto.referencia}</td>
            <td>${producto.cantidad}</td>
            <td>${producto.precio * producto.cantidad}</td>
            </tr>`)
            total = total + (parseInt(producto.precio) * parseInt(producto.cantidad))
            console.log(total)
        }
    });
    $("#v_total").children("label").remove();
    $("#v_total").append(`<label>Total :$ ${total} </label>`)

}