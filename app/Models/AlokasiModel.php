<?php

namespace App\Models;

use CodeIgniter\Model;

class AlokasiModel extends Model
{
    protected $table      = 'alokasi';
    protected $primaryKey = 'id';
    protected $allowedFields = ['tahun', 'kegiatan_id', 'sobat_id', 'beban_kerja', 'posisi_id'];
    
    // Dates
    protected $useTimestamps = true;
    // protected $dateFormat    = 'datetime';
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // Validation
    // protected $validationRules      = [];
    // protected $validationMessages   = [];
    // protected $skipValidation       = false;
    // protected $cleanValidationRules = true;

    // Callbacks
    // protected $allowCallbacks = true;
    // protected $beforeInsert   = [];
    // protected $afterInsert    = [];
    // protected $beforeUpdate   = [];
    // protected $afterUpdate    = [];
    // protected $beforeFind     = [];
    // protected $afterFind      = [];
    // protected $beforeDelete   = [];
    // protected $afterDelete    = [];

    public function getAlokasiFull(){
        $builder = $this->db->table('alokasi');
        $builder->select('*');
        $builder->join('comments', 'comments.id = blogs.id');
        $query = $builder->get();
        /*
         * Produces:
         * SELECT * FROM blogs JOIN comments ON comments.id = blogs.id
         */
    }
}