<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_pegawai extends CI_Model
{

    public $table = 'tb_pegawai';
    public $id = 'nip';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by("create_on", $this->order);
        return $this->db->get($this->table)->result();
    }
    function get_where($where)
    {
        return $this->db->query('select * from tb_pegawai '.$where." ORDER BY create_on DESC")->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->join('tb_user', 'tb_pegawai.nip = tb_user.nip_user', 'left'); 
        $this->db->join('tb_bagian', 'tb_bagian.id_bagian = tb_pegawai.id_bagian_pegawai', 'left');  
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    // get total rows
    function total_rows() {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}