@extends('admin.layouts.admin')

@section('content')

@include('admin._partials.messages')
<section class="content-header">
    <h1>Categorias</h1>
    <br>
</section>

<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12">   
            <div id="tree" style="display:none;">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="btn-toolbar" role="toolbar">
                                    <div id="admin-category" class="btn-group">
                                        <button id="btnEditCategory" type="button" class="btn btn-default" disabled>Editar</button>
                                        <button id="delete-category"  type="button" class="btn btn-default" disabled>Eliminar</button>
                                    </div>
                                    <div class="btn-group">
                                        <a href="{{ route('categories.create') }}" class="btn btn-primary">Agregar</a>
                                    </div>
                                </div>
                                <br/>
                                <strong>Cambiar orden: </strong> Arrastre y suelte las categorias.<br>
                                <strong>Para editar o eliminar:</strong> Seleccione la categoría y luego seleccione la acción.

                                <h4 class="page-header">Categorias:</h4>

                                <div id="display-tree"></div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- no Tree -->
            <div id="no-tree" style="display:none;">
                <div class="alert alert-info" role="alert">
                    Aún no ha agregado categorias.
                     <a href="#" class="btn btn-primary">Agregar</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal eliminar categoría -->
<div class="modal fade" id="delete-category-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" id="category-delete-form" action="#" method="post" accept-charset="utf-8">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
                    <h4 class="modal-title">¿Desea eliminar esta categoría?</h4>
                </div>

                <div class="modal-body">
                    <input type="hidden" id="delete-category-id" name="delete-category-id">
                    <h3 class="text-danger" id="delete-category-name" style="margin-top: 0;"></h3>
                    <div class="form-group">
                        <div class="checkbox">
                            <label>
                                <input id="delete-category-branch" type="checkbox"> Eliminar tambíen las subcategorias
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Aceptar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<form id="frmManage" action="{{ route($name  . '.manage') }}" method="POST">
@csrf
  <input id="id_manage" name="id" type="hidden" value="">  
  <input id="id_type" name="type" type="hidden" value="">  
</form>
@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('mng/jqtree/jqtree.css') }}">
@endpush

@push('js')
<script>
    var baseRoot = "{{ url('/')}}";
    var json_tree = '{!! $categories['categories'] !!}';
</script>
<script src="{{ asset('mng/jqtree/tree.jquery.js') }}"></script>
<script src="{{ asset('mng/js/categories.js') }}"></script>

@endpush
