<?php

namespace App\Models;

use CodeIgniter\Model;

class KegiatanModel extends Model
{
    protected $table      = 'kegiatan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['kode_satker','kode_mata_anggaran', 'tahun_anggaran', 'uraian_detail_akun', 'jenis_kegiatan_id', 'satuan_kegiatan_id', 'volume', 'harga_satuan', 'subjectmatter_id', 'jadwal_mulai', 'jadwal_akhir', 'bulan_bayar'];

    // Dates
    protected $useTimestamps = true;
    
    public function getUniqueYear(){
        $builder = $this->db->table('kegiatan');
        $builder->select('tahun_anggaran');
        $builder->distinct();
        $query = $builder->get()->getResultArray();

        return $query;
    }

    public function getSBML($kegiatan_id){
        $builder = $this->db->table('kegiatan');
        $builder->where('kegiatan.id', $kegiatan_id);
        $builder->select('*');
        $builder->join('jeniskegiatan', 'jeniskegiatan.id = kegiatan.jenis_kegiatan_id');
        $query = $builder->get()->getResultArray();

        return $query;
    }

}