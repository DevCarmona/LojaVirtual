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

                            if(isset($marca)) {
                                $marca_id = $marca->marca_id;
                            }else {
                                $marca_id = '';
                            }
                        ?>

						<?php echo form_open("restrita/marcas/core/" . $marca_id, $atributos); ?>
							<div class="card-body">
								<div class="form-row">
									<div class="form-group col-md-4">
										<label>Nome da marca</label>
										<input name="marca_nome" type="text" class="form-control" value="<?php echo (isset($marca) ? $marca->marca_nome : set_value('marca_nome')); ?>">
										<?php echo form_error('marca_nome', '<div class="text-danger">', '</div>'); ?>
									</div>

									<div class="form-group col-md-4">
										<label for="inputState">Situação</label>
										<select id="inputState" name="marca_ativa" class="form-control">
											<?php if(isset($marca)): ?>
												<option value="1" <?php echo ($marca->marca_ativa == 1 ? 'selected' : ''); ?>>Ativo</option>
												<option value="0" <?php echo ($marca->marca_ativa == 0 ? 'selected' : ''); ?>>Inativo</option>
											<?php else: ?>
												<option value="1">Ativo</option>
												<option value="0">Inativo</option>
											<?php endif; ?>
										</select>
									</div>

									<?php if(isset($marca)) : ?>
										<div class="form-group col-md-4">
											<label>Metalink da Marca</label>
											<input name="marca_meta_link" type="text" class="form-control border-0" value="<?php echo $marca->marca_meta_link?>" readonly onclick="this.blur();" style="background-color: #fOFOFO; cursor: not-allowed;">
										</div>
									<?php endif; ?>
								</div>

								<div class="form-row">
									<?php if(isset($marca)): ?>
										<input type="hidden" name="marca_id" value="<?php echo $marca->marca_id ?>">
									<?php endif;?>
								</div>
							</div>

							<div class="card-footer">
								<button class="btn btn-primary mr-2">Salvar</button>
								<a class="btn btn-dark" href="<?php echo base_url('restrita/marcas'); ?>">Voltar</a>
							</div>
						<?php echo form_close(); ?>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php $this->load->view('restrita/layout/sidebar_settings'); ?>
</div>