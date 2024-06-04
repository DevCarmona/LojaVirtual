<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produtos extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        
        //  Is there a function ? | Existe uma sessão ?
        if (!$this->ion_auth->logged_in()) {
            redirect('restrita/login');
        }        
    }

    public function index()
    {
        $data = array (
            'titulo' => 'Produtos cadastrados',

            'styles' => array (
                'bundles/datatables/datatables.min.css',
                'bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css',
            ),
            'scripts' => array (
                'bundles/datatables/datatables.min.js',
                'bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js',
                'bundles/jquery-ui/jquery-ui.min.js',
                'js/page/datatables.js',
            ),

            'produtos' => $this->produtos_model->get_all('produtos'),
        );

        //  Defining view loading / Definindo carregamento da view
        $this->load->view('restrita/layout/header', $data);
        $this->load->view('restrita/produtos/index');
        $this->load->view('restrita/layout/footer');
    }

    public function core($produto_id = NULL)
    {
        $produto_id = (int) $produto_id;

        if(!$produto_id) {
            //  Signing up / Cadastrando
        }else {
            if(!$produto = $this->core_model->get_by_id('produtos', array('produto_id' => $produto_id))){
                $this->session->set_flashdata('error', 'Esse produto não foi encontrado');
                redirect('restrita/produtos');
            }else {
                //  Editing product/ Editar produto
                // Validation / Validação
                $this->form_validation->set_rules('produto_nome', '<strong>Nome do produto</strong>', 'trim|required|min_length[2]|max_length[40]|callback_valida_nome_produto');
                $this->form_validation->set_rules('produto_categoria_id', '<strong>Categoria do produto</strong>', 'trim|required');
                $this->form_validation->set_rules('produto_marca_id', '<strong>Marca do produto</strong>', 'trim|required');
                $this->form_validation->set_rules('produto_valor', '<strong>Valor do produto</strong>', 'trim|required');
                $this->form_validation->set_rules('produto_peso', '<strong>Peso do produto</strong>', 'trim|required|integer');
                $this->form_validation->set_rules('produto_altura', '<strong>Altura do produto</strong>', 'trim|required|integer');
                $this->form_validation->set_rules('produto_largura', '<strong>Largura do produto</strong>', 'trim|required|integer');
                $this->form_validation->set_rules('produto_comprimento', '<strong>Comprimento do produto</strong>', 'trim|required|integer');
                $this->form_validation->set_rules('produto_quantidade_estoque', '<strong>Quantidade em estoque</strong>', 'trim|required|integer');
                $this->form_validation->set_rules('produto_descricao', '<strong>Descrição do produto</strong>', 'trim|required|min_length[10]|max_length[5000]');

                if($this->form_validation->run()) {
                    $data = elements(
                        array(
                            'produto_nome',
                            'produto_categoria_id',
                            'produto_marca_id',
                            'produto_valor',
                            'produto_peso',
                            'produto_altura',
                            'produto_largura',
                            'produto_comprimento',
                            'produto_quantidade_estoque',
                            'produto_ativo',
                            'produto_destaque',
                            'produto_controlar_estoque',
                            'produto_descricao',
                        ), $this->input->post()
                    );

                    //  Remove comma the value / Remova a virgula do valor
                    $data['produto_valor'] = str_replace(',','', $data['produto_valor']);

                    //  Create metalink the product / Criando metalink do produto
                    $data['produto_meta_link'] = url_amigavel($data['produto_nome']);

                    $data = html_escape($data);

                    //  Update product / Atualiza o produto
                    $this->core_model->update('produtos', $data, array('produto_id'=> $produto_id));

                    //  Delete old product image / Exclui imagens antigad do produto
                    $this->core_model->delete('produtos_fotos', array('foto_produto_id' => $produto_id));

                    //(Recover from post if photos came)Rules for delete photos / (Recuperar do post se veio fotos)Regras para excluir fotos
                    $fotos_produtos = $this->input->post('fotos_produtos');
                    
                    if($fotos_produtos) {
                        $total_fotos = count($fotos_produtos);

                        for($i = 0; $i < $total_fotos; $i++) {
                            $data = array(
                                'foto_produto_id' => $produto_id,
                                'foto_caminho' => $fotos_produtos[$i],
                            );
                            $this->core_model->insert('produtos_fotos', $data);
                        }
                    }
                    redirect('restrita/produtos');

                } else{
                    // Validation error / Erro de validação                   
                    $data = array (
                        'titulo' => 'Editar produto',
            
                        'styles' => array (
                            'jquery-upload-file/css/uploadfile.css',
                        ),
                        'scripts' => array (
                            'sweetalert2/sweetalert2.all.min.js',
                            'jquery-upload-file/js/jquery.uploadfile.min.js',
                            'jquery-upload-file/js/produtos.js',
                            'mask/jquery.mask.min.js',
                            'mask/custom.js',
                        ),
            
                        'produto' => $produto,
                        'fotos_produto' => $this->core_model->get_all('produtos_fotos', array('foto_produto_id' => $produto_id)),
                        'categorias' => $this->core_model->get_all('categorias', array('categoria_ativa' => 1)),
                        'marcas' => $this->core_model->get_all('marcas', array('marca_ativa' => 1))
                    );
            
                    //  Defining view loading / Definindo carregamento da view
                    $this->load->view('restrita/layout/header', $data);
                    $this->load->view('restrita/produtos/core');
                    $this->load->view('restrita/layout/footer');
                }
            }
        }
    }

    public function valida_nome_produto($produto_nome)
    {
        $produto_id = (int) $this->input->post('produto_id');

        if(!$produto_id) {
            //  sign in / Cadastrando
            if($this->core_model->get_by_id('produto', array('produto_nome' => $produto_nome))) {
                $this->form_validation->set_message('valida_nome_produto', 'Esse produto já existe.');
                return FALSE;
            }else {
                return TRUE;
            }
        }else {
            //  Editing / Editando
            if($this->core_model->get_by_id('produto_nome', array('produto_nome' => $produto_nome, 'produto_id !=' => $produto_id))) {
                $this->form_validation->set_message('valida_nome_produto', 'Esse produto já existe.');
                return FALSE;
            }else {
                return TRUE;
            }
        }
    }

    public function upload()
    {
        $config['upload_path'] = './uploads/produtos/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = 2048; //  Max 2mb
        $config['max_width'] = 1000;
        $config['max_height'] = 1000;
        $config['encrypt_name'] = TRUE;
        $config['max_filename'] = 200;
        $config['file_ext_tolower'] = TRUE;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('foto_produto')) {
            $data = array(
                'uploaded_data' => $this->upload->data(),
                'message' => 'Imagem enviada com sucesso!',
                'foto_caminho' => $this->upload->data('file_name'),
                'erro' => 0
            );
        } else{
            $data = array(
                'message' => $this->upload->display_errors(),
                'erro' => 5,
            );
        }
        echo json_encode($data);
    }

    public function deleteimg()
    {
        $file_name = $this->input->post('name');
        $file_path = './uploads/produtos/' . $file_name;

        if (file_exists($file_path)) {
            if (unlink($file_path)) {
                $data = array(
                    'message' => 'Imagem excluída com sucesso!',
                    'erro' => 0
                );
            } else {
                $data = array(
                    'message' => 'Erro ao tentar excluir a imagem.',
                    'erro' => 1
                );
            }
        } else {
            $data = array(
                'message' => 'Imagem não encontrada.',
                'erro' => 2
            );
        }

        echo json_encode($data);
    }

}