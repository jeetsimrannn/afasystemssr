function get_nama(){
    $kota = $this->input->get('kota');

    $query = $this->db->query("SELECT id, nama FROM tb_sekolah WHERE kota = '{$kota}'");

    $data = array(
        'nama' => $query->result_array(),
        'success' => TRUE
    );

    print json_encode($data);

}