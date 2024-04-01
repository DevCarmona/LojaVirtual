<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        
        //  Valid session? / Sessão válida ?
    }

    public function index()
    {
        $data = array (
            'titulo' => 'Usuários cadastrados',

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

            'usuarios' => $this->ion_auth->users()->result(), // Get all users / Pega todos os usuários
        );

        //  Defining view loading / Definindo carregamento da view
        $this->load->view('restrita/layout/header', $data);
        $this->load->view('restrita/usuarios/index');
        $this->load->view('restrita/layout/footer');
    }

    public function core($usuario_id = null)
    {
        //Checking if the user exists  / Verificando se o usuário existe
        if(!$usuario_id) {
            // Register / Cadastrar
            exit('Cadastrar usuario');
            
        }else {
            if(!$usuario = $this->ion_auth->user($usuario_id)->row()) {
                $this->session->set_flashdata('error', 'Usuário não foi encontrado!');
                redirect('restrita/usuarios');

            }else {
                //  users edit / Editar usuarios
                $this->form_validation->set_rules('first_name', 'Nome', 'trim|required');

                if($this->form_validation->run()) {
                    echo '<pre>';
                    print_r($this->input->post());
                    exit();
                }else {
                    // Validate error / Erro de validação
                    $data = array (
                        'titulo' => 'Editar usuário',
                        'usuario' => $usuario,
                        'perfil' => $this->ion_auth->get_users_groups($usuario_id)->row(),
                        'grupos' => $this->ion_auth->groups()->result(),
                    );
    
                    $this->load->view('restrita/layout/header', $data);
                    $this->load->view('restrita/usuarios/core');
                    $this->load->view('restrita/layout/footer');
                }

            }
        }
    }
}