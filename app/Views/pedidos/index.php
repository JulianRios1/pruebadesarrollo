<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title"><strong><?php echo $datos['titulo']?></strong></h2>
                        <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#new_item">
                                        Nueva pedido
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table class="table table-hover ">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Usuario</th>
                                    <th>Tercero</th>
                                    <th>Cantidad productos</th>
                                    <th>Total pedido</th>
                                    <th>Fecha de creación</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                            if (isset($datos['pedidos']) && ($datos['pedidos'] != "")) {
                                foreach ($datos['pedidos'] as $valor){
                                ?>
                                <tr>
                                    <td><?php echo $valor['id']?></td>
                                    <td><?php echo $valor['usuario']?></td>
                                    <td><?php echo $valor['tercero']?></td>
                                    <td><?php echo $valor['cant_productos']?></td>
                                    <td><?php echo $valor['total']?></td>
                                    <td><?php echo $valor['fecha_creacion']?></td>
                                    <td>

                                        <i class="far fa fa-print" data-toggle="modal" data-target="#imprimir"
                                            data-json='<?php echo json_encode($valor)?>'
                                            data-pedido='<?php echo $valor['id']?>'>
                                        </i>
                                    </td>
                                </tr>
                                <?php 
                                }
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
</section>
<!--MODAL INGRESO-->
<div class="modal fade" id="new_item" tabindex="-1" role="dialog" aria-labelledby="new_itemLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="new_itemLabel">Crear pedido</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <form role="form" enctype="multipart/form-data" id="FormAdd">
                            <div class="form-row">
                                <div class="form-group col-sm-12">
                                    <label>Tercero <spam class="text-danger">*</spam></label>
                                    <select class="form-control requerido select2bs4" name="tercero_id" id="tercero_id">
                                        <option value="0">Seleccione un tercero</option>
                                        <?php
                                    foreach($datos['terceros'] as $tercero):
                                        print_r($tercero);
                                        echo '<option value="'.$tercero['id'].'">'.trim($tercero['nombres'])."  ".trim($tercero['apellidos']).'</option>';
                                    endforeach;
                                    ?>
                                    </select>
                                </div>
                                <div class="form-group col-sm-5">
                                    <label>Producto <spam class="text-danger">*</spam></label>
                                    <select class="form-control select2bs4" name="producto_id" id="producto_id"
                                        onchange="proceso_producto()">
                                        <option value="0">Seleccione un producto</option>
                                        <?php
                                    foreach($datos['productos'] as $producto){
                                        ?>
                                        <option value="<?php echo $producto['id']?>"
                                            data-json='<?php echo json_encode($producto)?>'>
                                            <?php echo trim($producto['nombre'])." Ref:".trim($producto['referencia'])?>
                                        </option>
                                        <?php 
                                    }
                                    ?>
                                    </select>
                                </div>
                                <div class="form-group col-sm-2">
                                    <label>Cantidad <spam class="text-danger">*</spam></label>
                                    <input type="number" name="cantidad" id="cantidad" value="1" class="form-control">
                                </div>
                                <div class="form-group col-sm-2">
                                    <label>Precio <spam class="text-danger">*</spam></label>
                                    <input type="number" min='0' name="precio" id="precio" class="form-control"
                                        readonly>
                                </div>
                                <div class="form-group col-sm-2">
                                    <label>Subtotal<spam class="text-danger">*</spam></label>
                                    <input type="number" min='0' name="subtotal" id="subtotal" class="form-control"
                                        readonly>
                                </div>
                                <div class="form-group col-sm-1">
                                    <br>
                                    <button type="button" class="btn btn-success" id='aggProducto'><i
                                            class="far fa fa-save"></i></button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Producto</th>
                                    <th>Referencia</th>
                                    <th>Cantidad</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody id="tproductos">
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <h2 class="float-left" id='v_total'><label></label></h2>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id='btnAddPedido'>Añadir</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="imprimir" tabindex="-1" role="dialog" aria-labelledby="imprimirLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imprimirLabel">Pedido # 0</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-row">
                            <div class="form-group col-sm-4">
                                <label>Usuario :</label>
                                <p id="usuario_name">Usuario</p>
                            </div>
                            <div class="form-group col-sm-4">
                                <label>Tercero :</label>
                                <p id="tercero_name">Usuario</p>
                            </div>
                            <div class="form-group col-sm-4">
                                <label>Fecha creación :</label>
                                <p id="fecha_creacion">Usuario</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Producto</th>
                                    <th>Referencia</th>
                                    <th>Cantidad</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody id="tproductosimpresion">
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <h2 class="float-left" id='v_total'><label></label></h2>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>