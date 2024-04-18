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

                        <?php echo form_open("restrita/sistema/"); ?>

                        <div class="card-body">
            
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label>Razão Social</label>
                                    <input name="sistema_razao_social" type="text" class="form-control"
                                        value="<?php echo (isset($sistema) ? $sistema->sistema_razao_social : set_value('sistema_razao_social')); ?>">
                                    <?php echo form_error('sistema_razao_social', '<div class="text-danger">', '</div>'); ?>
                                </div>
                                
                                <div class="form-group col-md-3">
                                    <label>Nome Fantasia</label>
                                    <input name="sistema_nome_fantasia" type="text" class="form-control"
                                        value="<?php echo (isset($sistema) ? $sistema->sistema_nome_fantasia : set_value('sistema_nome_fantasia')); ?>">
                                    <?php echo form_error('sistema_nome_fantasia', '<div class="text-danger">', '</div>'); ?>
                                </div>

                                <div class="form-group col-md-3">
                                    <label>CNPJ</label>
                                    <input name="sistema_cnpj" type="text" class="form-control cnpj"
                                        value="<?php echo (isset($sistema) ? $sistema->sistema_cnpj : set_value('sistema_cnpj')); ?>">
                                    <?php echo form_error('sistema_cnpj', '<div class="text-danger">', '</div>'); ?>
                                </div>

                                <div class="form-group col-md-3">
                                    <label>Inscrição Estadual</label>
                                    <input name="sistema_ie" type="text" class="form-control"
                                        value="<?php echo (isset($sistema) ? $sistema->sistema_ie : set_value('sistema_ie')); ?>">
                                    <?php echo form_error('sistema_ie', '<div class="text-danger">', '</div>'); ?>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label>Telefone Fixo</label>
                                    <input name="sistema_telefone_fixo" type="text" class="form-control phone_with_ddd"
                                        value="<?php echo (isset($sistema) ? $sistema->sistema_telefone_fixo : set_value('sistema_telefone_fixo')); ?>">
                                    <?php echo form_error('sistema_telefone_fixo', '<div class="text-danger">', '</div>'); ?>
                                </div>
                                
                                <div class="form-group col-md-3">
                                    <label>Telefone Móvel</label>
                                    <input name="sistema_telefone_movel" type="text" class="form-control sp_celphones"
                                        value="<?php echo (isset($sistema) ? $sistema->sistema_telefone_movel : set_value('sistema_telefone_movel')); ?>">
                                    <?php echo form_error('sistema_telefone_movel', '<div class="text-danger">', '</div>'); ?>
                                </div>

                                <div class="form-group col-md-3">
                                    <label>E-mail</label>
                                    <input name="sistema_email" type="email" class="form-control"
                                        value="<?php echo (isset($sistema) ? $sistema->sistema_email : set_value('sistema_email')); ?>">
                                    <?php echo form_error('sistema_email', '<div class="text-danger">', '</div>'); ?>
                                </div>

                                <div class="form-group col-md-3">
                                    <label>URL do Site</label>
                                    <input name="sistema_site_url" type="url" class="form-control"
                                        value="<?php echo (isset($sistema) ? $sistema->sistema_site_url : set_value('sistema_site_url')); ?>">
                                    <?php echo form_error('sistema_site_url', '<div class="text-danger">', '</div>'); ?>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label>Cep</label>
                                    <input name="sistema_cep" type="text" class="form-control cep"
                                        value="<?php echo (isset($sistema) ? $sistema->sistema_cep : set_value('sistema_cep')); ?>">
                                    <?php echo form_error('sistema_cep', '<div class="text-danger">', '</div>'); ?>
                                </div>
                                
                                <div class="form-group col-md-4">
                                    <label>Endereço</label>
                                    <input name="sistema_endereco" type="text" class="form-control"
                                        value="<?php echo (isset($sistema) ? $sistema->sistema_endereco : set_value('sistema_endereco')); ?>">
                                    <?php echo form_error('sistema_endereco', '<div class="text-danger">', '</div>'); ?>
                                </div>

                                <div class="form-group col-md-2">
                                    <label>Número</label>
                                    <input name="sistema_numero" type="text" class="form-control"
                                        value="<?php echo (isset($sistema) ? $sistema->sistema_numero : set_value('sistema_numero')); ?>">
                                    <?php echo form_error('sistema_numero', '<div class="text-danger">', '</div>'); ?>
                                </div>

                                <div class="form-group col-md-2">
                                    <label>Cidade</label>
                                    <input name="sistema_cidade" type="text" class="form-control"
                                        value="<?php echo (isset($sistema) ? $sistema->sistema_cidade : set_value('sistema_cidade')); ?>">
                                    <?php echo form_error('sistema_cidade', '<div class="text-danger">', '</div>'); ?>
                                </div>

                                <div class="form-group col-md-2">
                                    <label>UF</label>
                                    <input name="sistema_estado" type="text" class="form-control uf"
                                        value="<?php echo (isset($sistema) ? $sistema->sistema_estado : set_value('sistema_estado')); ?>">
                                    <?php echo form_error('sistema_estado', '<div class="text-danger">', '</div>'); ?>
                                </div>
                            </div>

                            <div class="form-row">
                            <div class="form-group col-md-2">
                                    <label>Quantidade de produtos em destaque</label>
                                    <input name="sistema_produtos_destaques" type="number" class="form-control cep"
                                        value="<?php echo (isset($sistema) ? $sistema->sistema_produtos_destaques : set_value('sistema_produtos_destaques')); ?>">
                                    <?php echo form_error('sistema_produtos_destaques', '<div class="text-danger">', '</div>'); ?>
                                </div>
                            </div>

                        </div>

                        <div class="card-footer">
                            <button class="btn btn-primary mr-2">Salvar</button>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php $this->load->view('restrita/layout/sidebar_settings'); ?>
</div>