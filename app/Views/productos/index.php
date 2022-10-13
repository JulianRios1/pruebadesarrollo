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
                                        Nueva producto
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table  class="table table-hover ">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Referencia</th>
                                    <th>Stock</th>
                                    <th>Precio</th>
                                    <th>Peso</th>
                                    <th>Categorias</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                            if (isset($datos['productos']) && ($datos['productos'] != "")) {
                                foreach ($datos['productos'] as $valor){
                                ?>
                                <tr>
                                    <td><?php echo $valor['id']?></td>
                                    <td><?php echo $valor['nombre']?></td>
                                    <td><?php echo $valor['referencia']?></td>
                                    <td><?php echo $valor['stock']?></td>

                                    <td><?php echo $valor['precio']?></td>
                                    <td><?php echo $valor['peso']?></td>

                                    <td><?php echo $valor['categorias']?></td>
                                    <td><?php echo $valor['estado']==1?'<span class="badge badge-success">Activo</span>':'<span class="badge badge-danger">Inactivo</span>';?></td>
                                    <td>
                                        
                                        <i class="far fa fa-edit" 
                                        data-toggle="modal" 
                                        data-target="#EditModal"
                                        data-json='<?php echo json_encode($valor)?>'
                                        data-categorias='<?php echo json_encode(explode(',',$valor['categorias_id']))?>'
                                        data-producto='<?php echo $valor['id']?>'>
                                        </i> 
                                        <i class="far fa fa-trash-alt" 
                                        onclick="eliminarRegistro('Productos/delete',<?php echo $valor['id']?>)">
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
<div class="modal fade" id="new_item" tabindex="-1" role="dialog" aria-labelledby="new_itemLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="new_itemLabel">Añadir Producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <form role="form" enctype="multipart/form-data" id="FormAdd">
                            <div class="form-row">
                                <!-- text input -->
                                <div class="form-group col-sm-6">
                                    <label>Nombre de la Producto</label>
                                    <input type="text" name="nombre" class="form-control requerido"
                                        placeholder="Introduzca nombre de la Producto ...">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>Referencia <spam class="text-danger">*</spam></label>
                                    <input type="text" name="referencia" id="referencia" class="form-control requerido" onblur="validar_referencia()"
                                        placeholder="Introduzca la referencia del producto">
                                       
                                </div>
                                <div class="form-group col-sm-4">
                                    <label>Stock <spam class="text-danger">*</spam></label>
                                    <input type="number" min='0' name="stock" id="stock" class="form-control requerido"
                                        placeholder="Introduzca stock del producto ...">
                                </div>
                                <div class="form-group col-sm-4">
                                    <label>Precio <spam class="text-danger">*</spam></label>
                                    <input type="number" min='0' name="precio" id="precio" class="form-control requerido"
                                        placeholder="Introduzca precio del producto ...">
                                </div>
                                <div class="form-group col-sm-4">
                                    <label>Peso <spam class="text-danger">*</spam></label>
                                    <input type="number" min='0' name="peso" id="peso" class="form-control requerido"
                                        placeholder="Introduzca peso del producto ...">
                                </div>
                                
                                <div class="form-group col-sm-6">
                                    <label>Categorias <spam class="text-danger">*</spam></label>
                                    <select class="form-control requerido select2bs4" multiple="multiple" name="categoria_id[]" id="categoria_id">
                                    <?php
                                    foreach($datos['categorias'] as $categoria):
                                        echo '<option value="'.$categoria['id'].'">'.trim($categoria['nombre']).'</option>';
                                    endforeach;
                                    ?>
                                    </select>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>Activo</label>
                                    <select class="form-control requerido" name="estado" id="estado">
                                        <option value="1">SI</option>
                                        <option value="0">NO</option>
                                    </select>
                                </div>
                                
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id='btnAddProducto'>Añadir</button>
            </div>
        </div>
    </div>
</div>
<!--MODAL UPDATE-->
<div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="EditModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="EditModalLabel">Edicción Producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <form role="form" enctype="multipart/form-data" id="FormEditProducto">
                            <div class="form-row">
                                <!-- text input -->
                                <div class="form-group col-sm-6">
                                    <label>Nombre producto <spam class="text-danger">*</spam></label>
                                    <input type="text" name="ed_nombre" id="ed_nombre" class="form-control requerido"
                                        placeholder="Introduzca nombre producto ...">
                                       <input type="hidden" name="idproducto" id="idproducto">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>Referencia <spam class="text-danger">*</spam></label>
                                    <input type="text" name="ed_referencia" id="ed_referencia" class="form-control requerido" readonly='true'
                                        placeholder="Introduzca la referencia del producto">
                                       
                                </div>
                                <div class="form-group col-sm-4">
                                    <label>Stock <spam class="text-danger">*</spam></label>
                                    <input type="number" min='0' name="ed_stock" id="ed_stock" class="form-control requerido"
                                        placeholder="Introduzca precio del producto ...">
                                </div>
                                <div class="form-group col-sm-4">
                                    <label>Precio <spam class="text-danger">*</spam></label>
                                    <input type="number" min='0' name="ed_precio" id="ed_precio" class="form-control requerido"
                                        placeholder="Introduzca precio del producto ...">
                                </div>
                                <div class="form-group col-sm-4">
                                    <label>Peso <spam class="text-danger">*</spam></label>
                                    <input type="number" min='0' name="ed_peso" id="ed_peso" class="form-control requerido"
                                        placeholder="Introduzca peso del producto ...">
                                </div>
                                
                                <div class="form-group col-sm-6">
                                    <label>Categorias <spam class="text-danger">*</spam></label>
                                    <select class="form-control requerido select2bs4"  multiple="multiple" name="ed_categoria_id[]" id="ed_categoria_id">
                                    <?php
                                    foreach($datos['categorias'] as $categoria):
                                        echo '<option value="'.$categoria['id'].'">'.trim($categoria['nombre']).'</option>';
                                    endforeach;
                                    ?>
                                    </select>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>Activo <spam class="text-danger">*</spam></label>
                                    <select class="form-control requerido" name="ed_estado" id="ed_estado">
                                        <option value="1">SI</option>
                                        <option value="0">NO</option>
                                    </select>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id='btnEditProducto'>Actualizar</button>
            </div>
        </div>
    </div>
</div>