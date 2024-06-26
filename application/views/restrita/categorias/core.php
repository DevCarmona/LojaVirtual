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

                            if(isset($categoria)) {
                                $categoria_id = $categoria->categoria_id;
                            }else {
                                $categoria_id = '';
                            }
                        ?>

						<?php echo form_open("restrita/categorias/core/" . $categoria_id, $atributos); ?>

						<div class="card-body">
							<div class="form-row">
								<div class="form-group col-md-3">
									<label>Nome da categoria</label>
									<input name="categoria_nome" type="text" class="form-control" value="<?php echo (isset($categoria) ? $categoria->categoria_nome : set_value('categoria_nome')); ?>">
									<?php echo form_error('categoria_nome', '<div class="text-danger">', '</div>'); ?>
								</div>

                                <div class="form-group col-md-3">
                                    <label for="inputState">Situação</label>
                                    <select id="inputState" name="categoria_ativa" class="form-control">
                                        <?php if(isset($categoria)): ?>
                                            <option value="1" <?php echo ($categoria->categoria_ativa == 1 ? 'selected' : ''); ?>>Ativo</option>
                                            <option value="0" <?php echo ($categoria->categoria_ativa == 0 ? 'selected' : ''); ?>>Inativo</option>
                                        <?php else: ?>
                                            <option value="1">Ativo</option>
                                            <option value="0">Inativo</option>
                                        <?php endif; ?>
                                    </select>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="inputState">Categoria pai</label>
                                    <select id="inputState" name="categoria_pai_id" class="form-control">
										<?php foreach($masters as $pai):?>

											<?php if(isset($categoria)): ?>
												<option value="<?php echo $pai->categoria_pai_id; ?>" <?php echo($pai->categoria_pai_id == $categoria->categoria_pai_id ? 'selected' : ''); ?>><?php echo $pai->categoria_pai_nome ?></option>
											<?php else: ?>
												<option value="<?php echo $pai->categoria_pai_id; ?>"><?php echo $pai->categoria_pai_nome ?></option>
											<?php endif; ?>

										<?php endforeach;?>
                                    </select>
                                </div>

                                <?php if(isset($categoria)) : ?>
                                    <div class="form-group col-md-3">
                                        <label>Metalink da categoria</label>
                                        <input name="categoria_meta_link" type="text" class="form-control border-0" value="<?php echo $categoria->categoria_meta_link?>" readonly onclick="this.blur();" style="background-color: #fOFOFO; cursor: not-allowed;">
                                    </div>
                                <?php endif; ?>
							</div>

							<div class="form-row">
								<?php if(isset($categoria)): ?>
								    <input type="hidden" name="categoria_id" value="<?php echo $categoria->categoria_id ?>">
								<?php endif;?>
							</div>
						</div>

						<div class="card-footer">
							<button class="btn btn-primary mr-2">Salvar</button>
							<a class="btn btn-dark" href="<?php echo base_url('restrita/categorias'); ?>">Voltar</a>
						</div>
						<?php echo form_close(); ?>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php $this->load->view('restrita/layout/sidebar_settings'); ?>
</div>