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
                                        Nueva categoría
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
                                    <th>Descripción</th>
                                    <th>Fecha creación</th>
                                    <th>Activo</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                            if (isset($datos['categorias']) && ($datos['categorias'] != "")) {
                                foreach ($datos['categorias'] as $valor){
                                ?>
                                <tr>
                                    <td><?php echo $valor['id']?></td>
                                    <td><?php echo $valor['nombre']?></td>
                                    <td><?php echo $valor['descripcion']?></td>
                                    <td><?php echo $valor['fecha_creacion']?></td>
                                    <td><?php echo $valor['estado']==1?'<span class="badge badge-success">Activo</span>':'<span class="badge badge-danger">Inactivo</span>';?></td>
                                    <td><i class="far fa fa-edit" 
                                        data-toggle="modal" 
                                        data-target="#EditModal"
                                        data-json='<?php echo json_encode($valor)?>'
                                        data-id='<?php echo $valor['id']?>'>
                                        </i> 
                                        <i class="far fa fa-trash-alt" 
                                        onclick="eliminarRegistro('Categorias/delete',<?php echo $valor['id']?>)">
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
                <h5 class="modal-title" id="new_itemLabel">Añadir Categoría</h5>
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
                                    <label>Nombre de la Categoría</label>
                                    <input type="text" name="nombre" class="form-control requerido"
                                        placeholder="Introduzca nombre de la categoría ...">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label>Activo</label>
                                    <select class="form-control requerido" name="estado" id="estado">
                                        <option value="1">SI</option>
                                        <option value="0">NO</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-12">
                                    <label>Descripción</label>
                                    <textarea name="descripcion" id="descripcion" rows="5"
                                        class="form-control"></textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id='btnAddCategoria'>Añadir</button>
            </div>
        </div>
    </div>
</div>
<!--MODAL UPDATE-->
<div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="EditModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="EditModalLabel">Edicción Categoría</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <form role="form" enctype="multipart/form-data" id="FormEditCategoria">
                            <div class="form-row">
                                <!-- text input -->
                                <div class="form-group col-sm-6">
                                    <label>Nombre de la Categoría <spam class="text-danger">*</spam></label>
                                    <input type="text" name="ed_nombre" id="ed_nombre" class="form-control requerido"
                                        placeholder="Introduzca nombre de la categoría ...">
                                       <input type="hidden" name="idcategoria" id="idcategoria">
                                </div>
                                
                                <div class="form-group col-sm-6">
                                    <label>Activo <spam class="text-danger">*</spam></label>
                                    <select class="form-control requerido" name="ed_estado" id="ed_estado">
                                        <option value="1">SI</option>
                                        <option value="0">NO</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-12">
                                    <label>Descripción</label>
                                    <textarea name="ed_descripcion" id="ed_descripcion" rows="5"
                                        class="form-control"></textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id='btnEditCategoria'>Actualizar</button>
            </div>
        </div>
    </div>
</div>