<?php

namespace App\Models;

use CodeIgniter\Model;

class AlokasiModel extends Model
{
    protected $table      = 'alokasi';
    protected $primaryKey = 'id';
    protected $allowedFields = ['tahun', 'kegiatan_id', 'sobat_id', 'beban_kerja', 'posisi_id', 'bulan_bayar_mitra', 'honor'];
    
    // Dates
    protected $useTimestamps = true;
  

    public function getMitraSBML($tahun, $bulan_bayar, $mitra){
        $builder = $this->db->table('alokasi');
        $builder->where('tahun', $tahun);
        $builder->where('bulan_bayar_mitra', $bulan_bayar);
        $builder->where('sobat_id', $mitra);
        $builder->select('*');
        $builder->join('kegiatan', 'kegiatan.id = alokasi.kegiatan_id');
        $builder->join('jeniskegiatan', 'jeniskegiatan.id = kegiatan.jenis_kegiatan_id');
        // $builder->select('tahun', 'kegiatan_id', 'sobat_id', 'beban_kerja', 'posisi_id', 'bulan_bayar_mitra', 'honor', 'jeniskegiatan_id', 'sbml');
        $query = $builder->get()->getResultArray();

        return $query;
        /*
         * Produces:
         * SELECT * FROM blogs JOIN comments ON comments.id = blogs.id
         */
    }
}