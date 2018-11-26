<?php
class Painel extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('logar_model');
        $this->load->model('perfil_model');
        $this->load->model('cidade_model');
        $this->load->model('conf');
        $this->logar_model->protege();
    }



    public function index() {
        $dados['user'] = $this->perfil_model->retorna_dados_usuario();

        $this->load->view('include/header', $dados);
        $this->load->view('painel/home', $dados);
        $this->load->view('include/footer');
    }


    public function cidades($pag = null, $par = null) {
        $dados['user'] = $this->perfil_model->retorna_dados_usuario();
        $dados['crimes'] = $this->cidade_model->retorna_todas_cidades();

        $this->load->view('include/header', $dados);

        if($pag == null){
            $this->load->view('painel/crimes/home', $dados);  
        }


        if($pag == "inserir"){
            if($this->input->post('inserir') != null){
                $nome = $this->input->post('nome');
                $resultado = $this->cidade_model->inserir($nome);
                if($resultado){
                    $this->conf->set_alertas("success|Cidade inserida com sucesso!");
                }else{
                    $this->conf->set_alertas("danger|Houve um problema! Contate o administrador!");
                }
                redirect('painel/crimes');
            }
            $this->load->view('painel/crimes/inserir', $dados);  
        }


        if($pag == "alterar"){
            if($this->input->post('alterar') != null){
                $nome = $this->input->post('nome');
                $resultado = $this->cidade_model->alterar($par, $nome);
                if($resultado){
                    $this->conf->set_alertas("success|Cidade alterada com sucesso!");
                }else{
                    $this->conf->set_alertas("danger|Houve um problema! Contate o administrador!");
                }
                redirect('painel/crimes');
            }
            $dados['cidade'] = $this->cidade_model->ver($par);
            $this->load->view('painel/crimes/alterar', $dados);
        }


        if($pag == "apagar"){
            if($this->input->post('apagar') != null){
                $resultado = $this->cidade_model->apagar($par);
                if($resultado){
                    $this->conf->set_alertas("success|Cidade removida com sucesso!");
                }else{
                    $this->conf->set_alertas("danger|Houve um problema! Contate o administrador!");
                }
                redirect('painel/crimes');
            }
            $dados['cidade'] = $this->cidade_model->ver($par);
            $this->load->view('painel/crimes/apagar', $dados);
        }

        
        $this->load->view('include/footer');
    }








}
