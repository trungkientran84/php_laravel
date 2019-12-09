@extends('layouts.user-master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h4>Profile</h4></div>
                <div class="card-body">
                    <div class="page-content container-fluid">
                        <form class="form-edit-add" role="form" action="http://127.0.0.1:8000/admin/users/2" method="POST" enctype="multipart/form-data" autocomplete="off">
                            <!-- PUT Method if we are editing -->
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="_token" value="5cYam7MyfBX9lKDLPL3REH9ctrB2zBIPrB5XTRTs">

                            <div class="row">
                                <div class="col-md-8">
                                    <div class="panel panel-bordered">


                                        <div class="panel-body">
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="Kien">
                                            </div>

                                            <div class="form-group">
                                                <label for="email">E-mail</label>
                                                <input type="email" class="form-control" id="email" name="email" placeholder="E-mail" value="trungkientran84@gmail.com">
                                            </div>

                                            <div class="form-group">
                                                <label for="password">Password</label>
                                                <br>
                                                <small>Leave empty to keep the same</small>
                                                <input type="password" class="form-control" id="password" name="password" value="" autocomplete="new-password">
                                            </div>

                                            <div class="form-group">
                                                <label for="locale">Locale</label>
                                                <select class="form-control select2 select2-hidden-accessible" id="locale" name="locale" data-select2-id="locale" tabindex="-1" aria-hidden="true">
                                                    <option value="al">al</option>
                                                    <option value="am">am</option>
                                                    <option value="ar">ar</option>
                                                    <option value="cs">cs</option>
                                                    <option value="de">de</option>
                                                    <option value="en" selected="" data-select2-id="2">en</option>
                                                    <option value="es">es</option>
                                                    <option value="fa">fa</option>
                                                    <option value="fi">fi</option>
                                                    <option value="fr">fr</option>
                                                    <option value="gl">gl</option>
                                                    <option value="id">id</option>
                                                    <option value="it">it</option>
                                                    <option value="ja">ja</option>
                                                    <option value="ku">ku</option>
                                                    <option value="nl">nl</option>
                                                    <option value="pl">pl</option>
                                                    <option value="pt">pt</option>
                                                    <option value="pt_br">pt_br</option>
                                                    <option value="ro">ro</option>
                                                    <option value="ru">ru</option>
                                                    <option value="sv">sv</option>
                                                    <option value="tr">tr</option>
                                                    <option value="uk">uk</option>
                                                    <option value="zh_CN">zh_CN</option>
                                                    <option value="zh_TW">zh_TW</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="panel panel panel-bordered panel-warning">
                                        <div class="panel-body">
                                            <div class="form-group">
                                                <img src="http://127.0.0.1:8000/storage/users/November2019/AsAVW372CmSts7kBavLo.jpg" style="width:200px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;">
                                                <input type="file" data-name="avatar" name="avatar">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary pull-right save">
                                Save
                            </button>
                        </form>

                        <iframe id="form_target" name="form_target" style="display:none"></iframe>
                        <form id="my_form" action="http://127.0.0.1:8000/admin/upload" target="form_target" method="post" enctype="multipart/form-data" style="width:0px;height:0;overflow:hidden">
                            <input type="hidden" name="_token" value="5cYam7MyfBX9lKDLPL3REH9ctrB2zBIPrB5XTRTs">
                            <input name="image" id="upload_file" type="file" onchange="$('#my_form').submit();this.value='';">
                            <input type="hidden" name="type_slug" id="type_slug" value="users">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
