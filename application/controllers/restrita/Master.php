<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends CI_Controller {
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
            'titulo' => 'Categorias pai cadastradas',

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

            'master' => $this->core_model->get_all('categorias_pai'),
        );
        
        //  Defining view loading / Definindo carregamento da view
        $this->load->view('restrita/layout/header', $data);
        $this->load->view('restrita/master/index');
        $this->load->view('restrita/layout/footer');
    }    

    public function core($categoria_pai_id = NULL)
    {
        $categoria_pai_id = (int) $categoria_pai_id;

        if(!$categoria_pai_id) {
            //  Register / Cadastrar            
            $this->form_validation->set_rules('categoria_pai_nome','Nome da categoria pai','trim|required|min_length[4]|max_length[40]|callback_valida_categoria_nome');
            
            if($this->form_validation->run()) {
                //  Run validation / Rodou a validação

                $data = elements(
                    array(
                        'categoria_pai_nome',
                        'categoria_pai_ativa',
                    ), $this->input->post()
                );

                //  Defining metalink / Definindo metalink
                $data['categoria_pai_meta_link'] = url_amigavel($data['categoria_pai_nome']);

                $data = html_escape($data);
                $this->core_model->insert('categorias_pai', $data);
                redirect('restrita/master');

            } else {
                // Error validation / Erro de validação
                $data = array (
                    'titulo' => 'Cadastrar categoria pai',
                );
                
                //  Defining view loading / Definindo carregamento da view
                $this->load->view('restrita/layout/header', $data);
                $this->load->view('restrita/master/core');
                $this->load->view('restrita/layout/footer');
            }

        }else {
            if(!$master = $this->core_model->get_by_id('categorias_pai', array('categoria_pai_id' => $categoria_pai_id))) {
                $this->session->set_flashdata('error', 'A categoria pai não foi encontrada');
                redirect('restrita/master');

            }else {
                //  Edit / Editando
                $this->form_validation->set_rules('categoria_pai_nome','Nome da categoria pai','trim|required|min_length[4]|max_length[40]|callback_valida_categoria_nome');
                
                if($this->form_validation->run()) {
                    //  Run validation / Rodou a validação
                    if($this->input->post('categoria_pai_ativa') == 0) {
                        //  Set deactivation ban / Definir proibição de desativação
                        if($this->core_model->get_by_id('categorias', array('categoria_pai_id' => $categoria_pai_id))) {
                            $this->session->set_flashdata('error', 'Categoria pai não pode ser desativada, pois está vinculada a uma categoria filho');
                            redirect('restrita/master');
                        }
                    }

                    $data = elements(
                        array(
                            'categoria_pai_nome',
                            'categoria_pai_ativa',
                        ), $this->input->post()
                    );

                    //  Defining metalink / Definindo metalink
                    $data['categoria_pai_meta_link'] = url_amigavel($data['categoria_pai_nome']);

                    $data = html_escape($data);
                    $this->core_model->update('categorias_pai', $data, array('categoria_pai_id' => $categoria_pai_id));
                    redirect('restrita/master');

                } else {
                    // Error validation / Erro de validação
                    $data = array (
                        'titulo' => 'Editar categoria pai',            
                        'master' => $master,
                    );
                    
                    //  Defining view loading / Definindo carregamento da view
                    $this->load->view('restrita/layout/header', $data);
                    $this->load->view('restrita/master/core');
                    $this->load->view('restrita/layout/footer');
                }
            }
        }
    }

    public function valida_categoria_nome($categoria_pai_nome)
    {
        $categoria_pai_id = (int) $this->input->post('categoria_pai_id');

        if(!$categoria_pai_id) {
            //  sign in / Cadastrando

            if($this->core_model->get_by_id('categorias_pai', array('categoria_pai_nome' => $categoria_pai_nome))) {
                $this->form_validation->set_message('valida_nome_categoria', 'A categoria pai já existe.');
                return FALSE;
            }else {
                return TRUE;
            }
        }else {
            //  Editing / Editando
            if($this->core_model->get_by_id('categorias_pai', array('categoria_pai_nome' => $categoria_pai_nome, 'categoria_pai_id !=' => $categoria_pai_id))) {
                $this->form_validation->set_message('valida_nome_categoria', 'A categoria pai já existe.');
                return FALSE;
            }else {
                return TRUE;
            }
        }
    }

    public function delete($categoria_pai_id = NULL)
    {
        $categoria_pai_id = (int) $categoria_pai_id;

        if(!$categoria_pai_id || !$this->core_model->get_by_id('categorias_pai', array('categoria_pai_id' => $categoria_pai_id))) {
            $this->session->set_flashdata('error', 'A categoria pai não foi encontrada');
            redirect('restrita/master');
        }
        
        if($this->core_model->get_by_id('categorias_pai', array('categoria_pai_id' => $categoria_pai_id, 'categoria_pai_ativa' => 1))) {
            $this->session->set_flashdata('error', 'Não é permitido excluir uma categoria pai ativa.');
            redirect('restrita/master');
        }

        $this->core_model->delete('categorias_pai', array('categoria_pai_id' => $categoria_pai_id));
        redirect('restrita/master');
    }
}