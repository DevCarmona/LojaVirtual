<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Loja_model extends CI_Model {
    public function get_grandes_marcas()
    {
        $this->db->select([
            'marcas.*'
        ]);

        $this->db->where('marca_ativa', 1);

        $this->db->join('produtos', 'produtos.produto_marca_id = marcas.marca_id');

        $this->db->group_by('marca_nome');
        
        return $this->db->get('marcas') ->result();
    }

    //  Parenty categories navbar / Categoria pai navbar
    public function get_categorias_pai()
    {
        $this->db->select([
            'categorias_pai.*', //  .* = Bringing all fields / Trazendo todos os campos
            'produtos.produto_nome',
        ]);

        $this->db->where('categoria_pai_ativa', 1);
        $this->db->join('categorias', 'categorias.categoria_pai_id = categorias_pai.categoria_pai_id', 'LEFT');

        //  Returns only products with categories associated with them / Retorna apenas produtos com categorias associadas a eles
        $this->db->join('produtos', 'produtos.produto_categoria_id = categorias.categoria_id');

        $this->db->group_by('categorias.categoria_pai_nome');
        
        return $this->db->get('categorias_pai')->result();
    }

    //  Child categories navbar / Categorias filhas navbar
    public function get_categorias_filhas($categoria_pai_id = NULL)
    {
        $this->db->select([
            'categorias.*', //  .* = Bringing all fields / Trazendo todos os campos
            'produtos.produto_nome',
        ]);

        $this->db->where('categorias.categoria_pai_id', $categoria_pai_id);
        $this->db->where('categorias.categoria_pai_ativa', 1);

        //  Returns only products with categories associated with them / Retorna apenas produtos com categorias associadas a eles
        $this->db->join('produtos', 'produtos.produto_categoria_id = categorias.categoria_id');

        $this->db->group_by('categorias.categoria_nome');

        return $this->db->get('categorias')->result();
    }

}