 <?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mod_preventive extends CI_Model
{

    // BACA DATA CL MINGGUAN
    public function readday_mingguan($date)
    {
        $sql = "SELECT jadwal_cl.kode_cl,jadwal_cl.start_cl,jadwal_cl.stop_cl,mesin.nama_mesin,checklist.note_cl,jadwal_cl.done_cl,jadwal_cl.id_jadwal_cl,jadwal_cl.geser_cl,jadwal_cl.note_geser,jadwal_cl.acc,jadwal_cl.skip_cl
        FROM jadwal_cl,mesin,checklist 
        WHERE 
        jadwal_cl.id_sect='6'
        AND jadwal_cl.start_cl ='$date'
        AND jadwal_cl.id_mesin=mesin.id_mesin
        AND jadwal_cl.kode_cl=checklist.kode_cl
        AND TRIM(SUBSTRING_INDEX(jadwal_cl.kode_cl, '_', -1))<'E'
        ORDER BY jadwal_cl.start_cl ASC";
        return $this->db->query($sql)->result();
    }

    // BACA DATA CL BULANAN
    public function readday_bulanan($date)
    {
        $data_prevbulanan=[];
        $sql = "SELECT id_mesin FROM jadwal_cl WHERE TRIM(SUBSTRING_INDEX(jadwal_cl.kode_cl, '_', -1))<'E' AND start_cl='$date' AND id_sect='6' GROUP BY id_mesin";
        $data = $this->db->query($sql)->result();
        foreach ($data as $item) {
            $id_mesin = $item->id_mesin;
            $q_bulanan = "SELECT jadwal_cl.kode_cl,jadwal_cl.start_cl,jadwal_cl.stop_cl,mesin.nama_mesin,checklist.note_cl,jadwal_cl.done_cl,jadwal_cl.id_jadwal_cl,jadwal_cl.geser_cl,jadwal_cl.note_geser,jadwal_cl.acc,jadwal_cl.skip_cl
FROM jadwal_cl JOIN mesin ON jadwal_cl.id_mesin=mesin.id_mesin JOIN checklist ON jadwal_cl.kode_cl=checklist.kode_cl 
WHERE jadwal_cl.stop_cl>='$date' 
AND jadwal_cl.start_cl<='$date' 
AND mesin.id_mesin='$id_mesin' 
AND TRIM(SUBSTRING_INDEX(jadwal_cl.kode_cl, '_', -1))>'D' 
ORDER BY jadwal_cl.start_cl ASC";
            $data_bulanan = $this->db->query($q_bulanan)->result();
            // BUAT ARRAY sebagai objek stdClass
            foreach ($data_bulanan as $bulanan) {
                $data_prevbulanan[] = (object)[
        "kode_cl"=>$bulanan->kode_cl,
        "start_cl"=>$bulanan->start_cl,
        "stop_cl"=>$bulanan->stop_cl,
        "nama_mesin"=>$bulanan->nama_mesin,
        "note_cl"=>$bulanan->note_cl,
        "done_cl"=>$bulanan->done_cl,
        "id_jadwal_cl"=>$bulanan->id_jadwal_cl,
        "geser_cl"=>$bulanan->note_geser,
        "acc"=>$bulanan->acc,
        "skip_cl"=>$bulanan->skip_cl
    ];
            }
        }
        return $data_prevbulanan;
    }
	// BACA DATA CL INDEPENDEN
    public function read_independen($date)
    {
        $sql = "SELECT jadwal_cl.kode_cl,jadwal_cl.start_cl,jadwal_cl.stop_cl,mesin.nama_mesin,checklist.note_cl,jadwal_cl.done_cl,jadwal_cl.id_jadwal_cl,jadwal_cl.geser_cl,jadwal_cl.note_geser,jadwal_cl.acc,jadwal_cl.skip_cl
        FROM jadwal_cl,mesin,checklist 
        WHERE 
        jadwal_cl.id_sect='6'
        AND jadwal_cl.stop_cl>='$date' 
		AND jadwal_cl.start_cl<='$date' 
        AND jadwal_cl.id_mesin=mesin.id_mesin
        AND jadwal_cl.kode_cl=checklist.kode_cl
        AND jadwal_cl.independen='1'
        ORDER BY jadwal_cl.start_cl ASC";
        return $this->db->query($sql)->result();
    }

    // BACA DATA CL HARI INI UNTUK MME1 =======================
    public function readday($date)
    {
        $sql = "SELECT jadwal_cl.kode_cl,jadwal_cl.start_cl,jadwal_cl.stop_cl,mesin.nama_mesin,checklist.note_cl,jadwal_cl.done_cl,jadwal_cl.id_jadwal_cl,jadwal_cl.geser_cl,jadwal_cl.note_geser,jadwal_cl.acc,jadwal_cl.skip_cl
    FROM jadwal_cl,mesin,checklist 
    WHERE jadwal_cl.stop_cl>='$date' 
    AND  (jadwal_cl.start_cl='$date' AND jadwal_cl.geser_cl='0000-00-00')
    AND jadwal_cl.id_mesin=mesin.id_mesin 
    AND jadwal_cl.kode_cl=checklist.kode_cl 
    AND jadwal_cl.id_sect = '5'
    ORDER BY mesin.nama_mesin ASC";
        return $this->db->query($sql)->result();
    }

    public function readday_pass($date)
    {
        $sql = "SELECT jadwal_cl.kode_cl,jadwal_cl.start_cl,jadwal_cl.stop_cl,mesin.nama_mesin,checklist.note_cl,jadwal_cl.done_cl,jadwal_cl.id_jadwal_cl,jadwal_cl.geser_cl,jadwal_cl.note_geser,jadwal_cl.acc,jadwal_cl.skip_cl
    FROM jadwal_cl,mesin,checklist 
    WHERE jadwal_cl.stop_cl>='$date' 
    AND  (jadwal_cl.start_cl<'$date' AND jadwal_cl.done_cl='0000-00-00')
    AND jadwal_cl.skip_cl!='1'
    AND jadwal_cl.id_mesin=mesin.id_mesin 
    AND jadwal_cl.kode_cl=checklist.kode_cl 
    AND jadwal_cl.id_sect = '5'
    ORDER BY jadwal_cl.start_cl ASC";
        return $this->db->query($sql)->result();
    }


    // UNTUK KEPERLUAN QR CODE =======================
    public function readday_mesin($id_mesin, $date)
    {
        $sql = "SELECT jadwal_cl.kode_cl,jadwal_cl.start_cl,jadwal_cl.stop_cl,mesin.nama_mesin,checklist.note_cl,jadwal_cl.done_cl,jadwal_cl.id_jadwal_cl,jadwal_cl.geser_cl,jadwal_cl.note_geser,jadwal_cl.acc,jadwal_cl.skip_cl
    FROM jadwal_cl,mesin,checklist 
    WHERE jadwal_cl.stop_cl>='$date' 
    AND  (jadwal_cl.start_cl='$date' AND jadwal_cl.geser_cl='0000-00-00')
    AND jadwal_cl.id_mesin=mesin.id_mesin 
    AND jadwal_cl.kode_cl=checklist.kode_cl 
    AND jadwal_cl.id_mesin='$id_mesin'
    ORDER BY mesin.nama_mesin ASC";
        return $this->db->query($sql)->result();
    }

    public function readday_pass_mesin($id_mesin, $date)
    {
        $sql = "SELECT jadwal_cl.kode_cl,jadwal_cl.start_cl,jadwal_cl.stop_cl,mesin.nama_mesin,checklist.note_cl,jadwal_cl.done_cl,jadwal_cl.id_jadwal_cl,jadwal_cl.geser_cl,jadwal_cl.note_geser,jadwal_cl.acc,jadwal_cl.skip_cl
    FROM jadwal_cl,mesin,checklist 
    WHERE jadwal_cl.stop_cl>='$date' 
    AND  (jadwal_cl.start_cl<'$date' AND jadwal_cl.done_cl='0000-00-00')
    AND jadwal_cl.skip_cl!='1'
    AND jadwal_cl.id_mesin=mesin.id_mesin 
    AND jadwal_cl.kode_cl=checklist.kode_cl 
    AND jadwal_cl.id_mesin='$id_mesin'
    ORDER BY jadwal_cl.start_cl ASC";
        return $this->db->query($sql)->result();
    }

    public function readlast_mesin($id_mesin)
    {
        $data=[];
        $id_mesin_cl = $id_mesin."_";
        $q_cl = "SELECT  kode_cl FROM checklist WHERE kode_cl REGEXP '^$id_mesin_cl'";
        $cl = $this->db->query($q_cl)->result();
        foreach ($cl as $item) {
            $kode_cl = $item->kode_cl;
            $sql = "SELECT * from jadwal_cl JOIN mesin ON jadwal_cl.id_mesin=mesin.id_mesin JOIN checklist ON jadwal_cl.kode_cl=checklist.kode_cl JOIN durasi_cl ON checklist.kode_durasi=durasi_cl.kode_durasi WHERE jadwal_cl.done_cl!='0000-00-00' AND jadwal_cl.kode_cl='$kode_cl' ORDER BY jadwal_cl.id_jadwal_cl DESC LIMIT 1";
            $data[]=$this->db->query($sql)->result();
        }
        return $data;
    }
    // ============== QR CODE SQL END =====

    // BACA DATA CL MINGGUAN RANGE =======================
    public function readday_mingguan_range($start_cl, $stop_cl, $id_mesin)
    {
        if ($id_mesin=="ALL") {
            $sql = "SELECT jadwal_cl.kode_cl,jadwal_cl.start_cl,jadwal_cl.stop_cl,mesin.nama_mesin,checklist.note_cl,jadwal_cl.done_cl,jadwal_cl.id_jadwal_cl,jadwal_cl.geser_cl,jadwal_cl.note_geser,jadwal_cl.acc,jadwal_cl.skip_cl,jadwal_cl.note_skip
    FROM jadwal_cl,mesin,checklist 
    WHERE jadwal_cl.id_sect='6' 
    AND jadwal_cl.start_cl BETWEEN '$start_cl' AND '$stop_cl'
    AND jadwal_cl.kode_cl=checklist.kode_cl 
    AND jadwal_cl.id_mesin=mesin.id_mesin
    AND TRIM(SUBSTRING_INDEX(jadwal_cl.kode_cl, '_', -1))<'E' 
    ORDER BY jadwal_cl.start_cl ASC";
        } else {
            $sql = "SELECT jadwal_cl.kode_cl,jadwal_cl.start_cl,jadwal_cl.stop_cl,mesin.nama_mesin,checklist.note_cl,jadwal_cl.done_cl,jadwal_cl.id_jadwal_cl,jadwal_cl.geser_cl,jadwal_cl.note_geser,jadwal_cl.acc,jadwal_cl.skip_cl,jadwal_cl.note_skip
        FROM jadwal_cl,mesin,checklist 
        WHERE jadwal_cl.id_sect='6' 
        AND jadwal_cl.start_cl BETWEEN '$start_cl' AND '$stop_cl'
        AND jadwal_cl.kode_cl=checklist.kode_cl 
        AND jadwal_cl.id_mesin=mesin.id_mesin
        AND jadwal_cl.id_mesin='$id_mesin'
        AND TRIM(SUBSTRING_INDEX(jadwal_cl.kode_cl, '_', -1))<'E' 
        ORDER BY jadwal_cl.start_cl ASC";
        }
        return $this->db->query($sql)->result();
    }

    // BACA DATA CL BULANAN RANGE ===================
    public function readday_bulanan_range($start_cl, $stop_cl, $id_mesin)
    {
        $data_prevbulanan=[];
        if ($id_mesin=="ALL") {
            $sql = "SELECT id_mesin FROM jadwal_cl WHERE TRIM(SUBSTRING_INDEX(jadwal_cl.kode_cl, '_', -1))<'E' AND jadwal_cl.start_cl BETWEEN '$start_cl' AND '$stop_cl' AND jadwal_cl.id_sect='6' GROUP BY jadwal_cl.id_mesin";
        } else {
            $sql = "SELECT id_mesin FROM jadwal_cl WHERE TRIM(SUBSTRING_INDEX(jadwal_cl.kode_cl, '_', -1))<'E' AND jadwal_cl.start_cl BETWEEN '$start_cl' AND '$stop_cl' AND jadwal_cl.id_mesin='$id_mesin'  AND jadwal_cl.id_sect='6' GROUP BY jadwal_cl.id_mesin";
        }
    
        $data = $this->db->query($sql)->result();
        foreach ($data as $item) {
            $id_mesin_now = $item->id_mesin;
            $q_bulanan = "SELECT jadwal_cl.kode_cl,jadwal_cl.start_cl,jadwal_cl.stop_cl,mesin.nama_mesin,checklist.note_cl,jadwal_cl.done_cl,jadwal_cl.id_jadwal_cl,jadwal_cl.geser_cl,jadwal_cl.note_geser,jadwal_cl.acc,jadwal_cl.skip_cl,jadwal_cl.note_skip
FROM jadwal_cl JOIN mesin ON jadwal_cl.id_mesin=mesin.id_mesin JOIN checklist ON jadwal_cl.kode_cl=checklist.kode_cl 
WHERE jadwal_cl.stop_cl >='$start_cl' 
AND jadwal_cl.start_cl <='$stop_cl'
AND jadwal_cl.id_mesin='$id_mesin_now' 
AND TRIM(SUBSTRING_INDEX(jadwal_cl.kode_cl, '_', -1))>'D' 
ORDER BY jadwal_cl.start_cl ASC";
            $data_bulanan = $this->db->query($q_bulanan)->result();
            // BUAT ARRAY sebagai objek stdClass
            foreach ($data_bulanan as $bulanan) {
                $data_prevbulanan[] = (object)[
    "kode_cl"=>$bulanan->kode_cl,
    "start_cl"=>$bulanan->start_cl,
    "stop_cl"=>$bulanan->stop_cl,
    "nama_mesin"=>$bulanan->nama_mesin,
    "note_cl"=>$bulanan->note_cl,
    "done_cl"=>$bulanan->done_cl,
    "id_jadwal_cl"=>$bulanan->id_jadwal_cl,
    "geser_cl"=>$bulanan->note_geser,
    "acc"=>$bulanan->acc,
    "skip_cl"=>$bulanan->skip_cl,
	"note_skip"=>$bulanan->note_skip
];
            }
        }
        return $data_prevbulanan;
    }

// BACA DATA CL INDEPENDEN RANGE ===================
    public function read_independen_range($start_cl, $stop_cl, $id_mesin)
    {
        $data_previndependen=[];
        if ($id_mesin=="ALL") {
            $sql = "SELECT id_mesin FROM jadwal_cl WHERE jadwal_cl.start_cl BETWEEN '$start_cl' AND '$stop_cl' AND jadwal_cl.id_sect='6' AND jadwal_cl.independen='1' GROUP BY jadwal_cl.id_mesin";
        } else {
            $sql = "SELECT id_mesin FROM jadwal_cl WHERE jadwal_cl.start_cl BETWEEN '$start_cl' AND '$stop_cl' AND jadwal_cl.id_mesin='$id_mesin'  AND jadwal_cl.id_sect='6' AND jadwal_cl.independen='1' GROUP BY jadwal_cl.id_mesin";
        }
    
        $data = $this->db->query($sql)->result();
        foreach ($data as $item) {
            $id_mesin_now = $item->id_mesin;
            $q_independen = "SELECT jadwal_cl.kode_cl,jadwal_cl.start_cl,jadwal_cl.stop_cl,mesin.nama_mesin,checklist.note_cl,jadwal_cl.done_cl,jadwal_cl.id_jadwal_cl,jadwal_cl.geser_cl,jadwal_cl.note_geser,jadwal_cl.acc,jadwal_cl.skip_cl,jadwal_cl.note_skip
FROM jadwal_cl JOIN mesin ON jadwal_cl.id_mesin=mesin.id_mesin JOIN checklist ON jadwal_cl.kode_cl=checklist.kode_cl 
WHERE jadwal_cl.stop_cl >='$start_cl' 
AND jadwal_cl.start_cl <='$stop_cl'
AND jadwal_cl.id_mesin='$id_mesin_now'
ORDER BY jadwal_cl.start_cl ASC";
            $data_independen = $this->db->query($q_independen)->result();
            // BUAT ARRAY sebagai objek stdClass
            foreach ($data_independen as $independen) {
                $data_previndependen[] = (object)[
    "kode_cl"=>$independen->kode_cl,
    "start_cl"=>$independen->start_cl,
    "stop_cl"=>$independen->stop_cl,
    "nama_mesin"=>$independen->nama_mesin,
    "note_cl"=>$independen->note_cl,
    "done_cl"=>$independen->done_cl,
    "id_jadwal_cl"=>$independen->id_jadwal_cl,
    "geser_cl"=>$independen->note_geser,
    "acc"=>$independen->acc,
    "skip_cl"=>$independen->skip_cl,
	"note_skip"=>$bulanan->note_skip
];
            }
        }
        return $data_previndependen;
    }


    // BACA DATA CL MINGGUAN RANGE MME1 =======================
    public function readday_range($start_cl, $stop_cl, $id_mesin)
    {
        if ($id_mesin=="ALL") {
            $sql = "SELECT jadwal_cl.kode_cl,jadwal_cl.start_cl,jadwal_cl.stop_cl,mesin.nama_mesin,checklist.note_cl,jadwal_cl.done_cl,jadwal_cl.id_jadwal_cl,jadwal_cl.geser_cl,jadwal_cl.note_geser,jadwal_cl.acc,jadwal_cl.skip_cl,jadwal_cl.note_skip
    FROM jadwal_cl,mesin,checklist 
    WHERE jadwal_cl.id_sect='5' 
    AND jadwal_cl.start_cl BETWEEN '$start_cl' AND '$stop_cl'
    AND jadwal_cl.kode_cl=checklist.kode_cl 
    AND jadwal_cl.id_mesin=mesin.id_mesin
    ORDER BY jadwal_cl.start_cl ASC";
        } else {
            $sql = "SELECT jadwal_cl.kode_cl,jadwal_cl.start_cl,jadwal_cl.stop_cl,mesin.nama_mesin,checklist.note_cl,jadwal_cl.done_cl,jadwal_cl.id_jadwal_cl,jadwal_cl.geser_cl,jadwal_cl.note_geser,jadwal_cl.acc,jadwal_cl.skip_cl,jadwal_cl.note_skip
        FROM jadwal_cl,mesin,checklist 
        WHERE jadwal_cl.id_sect='5' 
        AND jadwal_cl.start_cl BETWEEN '$start_cl' AND '$stop_cl'
        AND jadwal_cl.kode_cl=checklist.kode_cl 
        AND jadwal_cl.id_mesin=mesin.id_mesin
        AND jadwal_cl.id_mesin='$id_mesin'
        ORDER BY jadwal_cl.start_cl ASC";
        }
        return $this->db->query($sql)->result();
    }

    // =================================== LIHAT CL PER ID JADWAL ===
    public function readbyid($id_jadwal_cl)
    {
        $this->db->select('*');
        $this->db->from('jadwal_cl');
        $this->db->join('mesin', 'jadwal_cl.id_mesin=mesin.id_mesin');
        $this->db->join('checklist', 'jadwal_cl.kode_cl=checklist.kode_cl');
        $this->db->join('durasi_cl', 'checklist.kode_durasi=durasi_cl.kode_durasi');
        $this->db->where('id_jadwal_cl', $id_jadwal_cl);
        $res = $this->db->get()->result();
        return $res;
    }

    // =================================== LIHAT CL PER ID MESIN DAN TANGGAL===
    public function readbymesindate($id_mesin, $start_cl)
    {
        $sql = "SELECT * FROM jadwal_cl JOIN mesin ON jadwal_cl.id_mesin=mesin.id_mesin JOIN checklist ON jadwal_cl.kode_cl=checklist.kode_cl JOIN durasi_cl ON checklist.kode_durasi=durasi_cl.kode_durasi WHERE jadwal_cl.id_mesin='$id_mesin' AND jadwal_cl.start_cl='$start_cl'";
        $res = $this->db->query($sql)->result();
        return $res;
    }

    //======= DONE ===
    public function done($id_jadwal_cl, $data)
    {
        $this->db->where("id_jadwal_cl", $id_jadwal_cl);
        $this->db->update("jadwal_cl", $data);
    }

    //======= NEXT CL GEDUNG AB ===
    public function next_cl($data_next)
    {
        $start_cl=$data_next["start_cl"];
        $kode_cl = $data_next["kode_cl"];
        $this->db->where('start_cl', $start_cl);
        $this->db->where('kode_cl', $kode_cl);
        if ($this->db->get('jadwal_cl')->num_rows()<1) {
            $this->db->insert("jadwal_cl", $data_next);
        }
    }

    //============ ACC ===========
    public function acc($id_jadwal_cl)
    {
        $data = array(
    'acc'=>$this->session->userdata('username')
    );
        $this->db->where("id_jadwal_cl", $id_jadwal_cl);
        $this->db->update("jadwal_cl", $data);
    }
    // =================== GESER CL ==================
    public function geser($id_jadwal_cl, $data)
    {
        $this->db->where("id_jadwal_cl", $id_jadwal_cl);
        $this->db->update("jadwal_cl", $data);
    }
    // ======================== HAPUS Cl ================
    public function hapus($id_jadwal_cl)
    {
        $this->db->where("id_jadwal_cl", $id_jadwal_cl);
        $this->db->delete("jadwal_cl");
    }

    //SKIP CL
    public function skip($id_jadwal_cl, $kode_cl, $start_cl, $note_skip, $data)
    {
        $sql = "SELECT * FROM jadwal_cl WHERE kode_cl='$kode_cl' AND start_cl='$start_cl'";
        $num  = $this->db->query($sql)->num_rows();
        if ($num<=0) {
            $this->db->where('id_jadwal_cl', $id_jadwal_cl);
            $this->db->update('jadwal_cl', array("skip_cl"=>"1","note_skip"=>$note_skip));
            $this->db->insert('jadwal_cl', $data);
        }
    }
    // SUBMIT
    public function create_cl($data)
    {
        $this->db->insert('jadwal_cl', $data);
    }


    // BACA DATA CL ALL RANGE =======================
    public function readall_range($start_cl, $stop_cl, $id_mesin)
    {
        $id_sect=$this->session->userdata('id_sect');
        if ($id_mesin=="ALL") {
            $sql = "SELECT jadwal_cl.skip_cl,jadwal_cl.kode_cl,jadwal_cl.start_cl,jadwal_cl.stop_cl,mesin.nama_mesin,checklist.note_cl,jadwal_cl.done_cl,jadwal_cl.id_jadwal_cl,jadwal_cl.geser_cl,jadwal_cl.note_geser,jadwal_cl.acc,jadwal_cl.skip_cl,jadwal_cl.pelaksana1,jadwal_cl.pelaksana2,jadwal_cl.pelaksana3,jadwal_cl.pelaksana4,jadwal_cl.pelaksana5,jadwal_cl.pelaksana6,jadwal_cl.uraian_cl,jadwal_cl.note_skip
    FROM jadwal_cl LEFT JOIN mesin ON jadwal_cl.id_mesin=mesin.id_mesin LEFT JOIN checklist ON  jadwal_cl.kode_cl=checklist.kode_cl
    WHERE jadwal_cl.id_sect='$id_sect' 
    AND jadwal_cl.start_cl BETWEEN '$start_cl' AND '$stop_cl'
    ORDER BY jadwal_cl.start_cl ASC";
        } else {
        $sql = "SELECT jadwal_cl.skip_cl,jadwal_cl.kode_cl,jadwal_cl.start_cl,jadwal_cl.stop_cl,mesin.nama_mesin,checklist.note_cl,jadwal_cl.done_cl,jadwal_cl.id_jadwal_cl,jadwal_cl.geser_cl,jadwal_cl.note_geser,jadwal_cl.acc,jadwal_cl.skip_cl,jadwal_cl.pelaksana1,jadwal_cl.pelaksana2,jadwal_cl.pelaksana3,jadwal_cl.pelaksana4,jadwal_cl.pelaksana5,jadwal_cl.pelaksana6,jadwal_cl.uraian_cl,jadwal_cl.note_skip
    FROM jadwal_cl LEFT JOIN mesin ON jadwal_cl.id_mesin=mesin.id_mesin LEFT JOIN checklist ON  jadwal_cl.kode_cl=checklist.kode_cl
    WHERE jadwal_cl.id_sect='$id_sect' 
    AND jadwal_cl.start_cl BETWEEN '$start_cl' AND '$stop_cl'
    AND jadwal_cl.id_mesin='$id_mesin'
    ORDER BY jadwal_cl.start_cl ASC";
        }
        return $this->db->query($sql)->result();
    }
	// ============= PENCAPAIAN =======================
	public function pencapaian($tahun)
    {
        //$data = array();
        
        //$tahun='2020';
        $idsect=$this->session->userdata('id_sect');
        for ($bulan=1;$bulan<=12;$bulan++) {
            if ($bulan<10) {
                $bulan ='0'.$bulan;
            }
            $periode = $tahun.'-'.$bulan;
            $sql = "SELECT (select COUNT(jadwal_cl.id_jadwal_cl) FROM jadwal_cl WHERE jadwal_cl.start_cl REGEXP '^$periode' AND jadwal_cl.id_sect='$idsect') as jumlah,(SELECT COUNT(jadwal_cl.id_jadwal_cl) FROM jadwal_cl WHERE jadwal_cl.start_cl REGEXP '^$periode' AND (jadwal_cl.done_cl!='0000-00-00' OR jadwal_cl.skip_cl='1') AND jadwal_cl.id_sect='$idsect') as terlaksana";
            $data[]=$this->db->query($sql)->result();
        }
        return $data;
    }
	
	// ============= PENCAPAIAN ASLI =======================
	public function pencapaianAsli($tahun)
    {
        //$data = array();
        
        //$tahun='2020';
        $idsect=$this->session->userdata('id_sect');
        for ($bulan=1;$bulan<=12;$bulan++) {
            if ($bulan<10) {
                $bulan ='0'.$bulan;
            }
            $periode = $tahun.'-'.$bulan;
            $sql = "SELECT (select COUNT(jadwal_cl.id_jadwal_cl) FROM jadwal_cl WHERE jadwal_cl.start_cl REGEXP '^$periode' AND jadwal_cl.id_sect='$idsect' AND jadwal_cl.skip_cl='0') as jumlah,(SELECT COUNT(jadwal_cl.id_jadwal_cl) FROM jadwal_cl WHERE jadwal_cl.start_cl REGEXP '^$periode' AND jadwal_cl.skip_cl=0 AND jadwal_cl.done_cl!='0000-00-00' AND jadwal_cl.id_sect='$idsect' AND jadwal_cl.skip_cl='0') as terlaksana";
            $data[]=$this->db->query($sql)->result();
        }
        return $data;
    }

    // ============= NOT DONE =======================
	public function notdone($periode)
    {
        $id_sect=$this->session->userdata('id_sect');
        $sql = "SELECT * FROM jadwal_cl JOIN mesin ON jadwal_cl.id_mesin=mesin.id_mesin JOIN checklist ON jadwal_cl.kode_cl=checklist.kode_cl JOIN durasi_cl ON checklist.kode_durasi=durasi_cl.kode_durasi WHERE jadwal_cl.id_sect='$id_sect' AND jadwal_cl.start_cl REGEXP '^$periode'";
        $res = $this->db->query($sql)->result();
        return $res;
    }
}
