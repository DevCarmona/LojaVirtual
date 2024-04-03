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

                        <?php

                            $atributos = array (
                                'name' => 'form_core',
                            );

                            if(isset($usuario)) {
                                $usuario_id = $usuario->id;
                            }else {
                                $usuario_id = '';
                            }
                        ?>

                        <?php echo form_open("restrita/usuarios/core/" . $usuario_id, $atributos); ?>

                        <div class="card-body">

                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label>Nome</label>
                                    <input name="first_name" type="text" class="form-control"
                                        value="<?php echo (isset($usuario) ? $usuario->first_name : set_value('first_name')); ?>">
                                        <?php echo form_error('first_name', '<div class="text-danger">', '</div>'); ?>
                                </div>

                                <div class="form-group col-md-4">
                                    <label>Sobrenome</label>
                                    <input name="last_name" type="text" class="form-control"
                                        value="<?php echo (isset($usuario) ? $usuario->last_name : set_value('last_name')); ?>">
                                        <?php echo form_error('last_name', '<div class="text-danger">', '</div>'); ?>
                                </div>

                                <div class="form-group col-md-4">
                                    <label>E-mail</label>
                                    <input name="email" type="email" class="form-control"
                                        value="<?php echo (isset($usuario) ? $usuario->email : set_value('email')); ?>">
                                        <?php echo form_error('email', '<div class="text-danger">', '</div>'); ?>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label>Usuário</label>
                                    <input name="username" type="text" class="form-control"
                                        value="<?php echo (isset($usuario) ? $usuario->username : set_value('username')); ?>">
                                        <?php echo form_error('username', '<div class="text-danger">', '</div>'); ?>
                                </div>

                                <div class="form-group col-md-4">
                                    <label>Senha</label>
                                    <input name="password" type="password" class="form-control">
                                    <?php echo form_error('password', '<div class="text-danger">', '</div>'); ?>
                                </div>

                                <div class="form-group col-md-4">
                                    <label>Confirmação da senha</label>
                                    <input name="confirma" type="password" class="form-control">
                                    <?php echo form_error('confirma', '<div class="text-danger">', '</div>'); ?>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="inputState">Situação</label>
                                    <select id="inputState" name="active" class="form-control">
                                        <?php if(isset($usuario)): ?>
                                        <option value="1" <?php echo ($usuario->active == 1 ? 'selected' : ''); ?>>Ativo
                                        </option>
                                        <option value="0" <?php echo ($usuario->active == 0 ? 'selected' : ''); ?>>
                                            Inativo</option>
                                        <?php else: ?>
                                        <option value="1">Ativo</option>
                                        <option value="0">Inativo</option>
                                        <?php endif; ?>

                                    </select>
                                </div>

                                <div class="form-group col-md-4">
                                    <label>Perfil de acesso</label>
                                    <select name="perfil" class="form-control">
                                        <?php foreach($grupos as $grupo): ?>
                                        <?php if(isset($usuario)): ?>
                                        <option value="<?php echo $grupo->id; ?>"
                                            <?php echo ($grupo->id == $perfil->id ? 'selected' : ''); ?>>
                                            <?php echo $grupo->name ?></option>
                                        <?php else: ?>
                                        <option value="<?php echo $grupo->id; ?>"><?php echo $grupo->name; ?></option>
                                        <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <?php if(isset($usuario)): ?>
                                <input type="hidden" name="usuario_id" value="<?php echo $usuario->id ?>">
                                <?php endif;?>

                            </div>

                        </div>

                        <div class="card-footer">
                            <button class="btn btn-primary mr-2">Salvar</button>
                            <a class="btn btn-dark" href="<?php echo base_url('restrita/usuarios'); ?>">Voltar</a>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php $this->load->view('restrita/layout/sidebar_settings'); ?>
</div>