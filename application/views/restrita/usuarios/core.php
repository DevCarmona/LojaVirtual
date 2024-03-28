<?php $this->load->view('restrita/layout/navbar'); ?>
<?php $this->load->view('restrita/layout/sidebar'); ?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4><?php echo $titulo; ?></h4>
                        </div>

                        <form name="form_core">
                            <div class="card-body">

                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label>Nome</label>
                                        <input name="first_name" type="text" class="form-control" value="<?php echo (isset($usuario) ? $usuario->first_name : ''); ?>">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label>Sobrenome</label>
                                        <input name="last_name" type="text" class="form-control" value="<?php echo (isset($usuario) ? $usuario->last_name : '') ?>">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label>E-mail</label>
                                        <input name="email" type="email" class="form-control" value="<?php echo (isset($usuario) ? $usuario->email : '') ?>">
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label>Usuário</label>
                                        <input name="username" type="text" class="form-control" value="<?php echo (isset($usuario) ? $usuario->username : '') ?>">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label>Senha</label>
                                        <input name="password" type="password" class="form-control" value="<?php echo (isset($usuario) ? $usuario->password : '') ?>">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label>Confirmação da senha</label>
                                        <input name="confirma" type="password" class="form-control" value="<?php echo (isset($usuario) ? $usuario->password : '') ?>">
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="inputState">Situação</label>
                                        <select id="inputState" name="active" class="form-control">
                                            <option value="1" <?php echo ($usuario->active == 1 ? 'selected' : ''); ?>>Ativo</option>
                                            <option value="0" <?php echo ($usuario->active == 0 ? 'selected' : ''); ?>>Inativo</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="inputState">Perfil de acesso</label>
                                        <select id="inputState" name="group" class="form-control">
                                            <option>Cliente</option>
                                            <option>Admin</option>
                                        </select>
                                    </div>
                                </div>

                            </div>

                            <div class="card-footer">
                                <button class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php $this->load->view('restrita/layout/sidebar_settings'); ?>
</div>