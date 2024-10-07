<?php
require_once "koneksi.php";

class Dosen {

    // Menampilkan semua data dosen
    public function get_all_dosen() {
        global $mysqli;
        $query = "SELECT * FROM dosen";
        $data = array();
        $result = $mysqli->query($query);
        while ($row = mysqli_fetch_object($result)) {
            $data[] = $row;
        }
        $response = array(
            'status' => 1,
            'message' =>'Get All List Dosen Successfully.',
            'data' => $data
        );
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    // Menampilkan satu data dosen
    public function get_dosen($id = 0) {
        global $mysqli;
        $query = "SELECT * FROM dosen";
        if ($id != 0) {
            $query .= " WHERE id_dosen = " . $id . " LIMIT 1";
        }
        $data = array();
        $result = $mysqli->query($query);
        while ($row = mysqli_fetch_object($result)) {
            $data[] = $row;
        }
        $response = array(
            'status' => 1,
            'message' =>'Get Dosen Successfully.',
            'data' => $data
        );
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    // Menambah data dosen
    public function insert_dosen() {
        global $mysqli;
        $arrcheckpost = array('nama_dosen' => '', 'nidn' => '', 'email' => '');
        $hitung = count(array_intersect_key($_POST, $arrcheckpost));
        if ($hitung == count($arrcheckpost)) {
            $result = mysqli_query($mysqli, "INSERT INTO dosen(nama_dosen, nidn, email) VALUES('$_POST[nama_dosen]', '$_POST[nidn]', '$_POST[email]')");
            if ($result) {
                $response = array(
                    'status' => 1,
                    'message' =>'Data Dosen Added Successfully.'
                );
            } else {
                $response = array(
                    'status' => 0,
                    'message' =>'Data Dosen Addition Failed.'
                );
            }
        } else {
            $response = array(
                'status' => 0,
                'message' =>'Parameter Do Not Match'
            );
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    // Menghapus data dosen
    public function delete_dosen($id) {
        global $mysqli;
        $query = "DELETE FROM dosen WHERE id_dosen = " . $id;
        if (mysqli_query($mysqli, $query)) {
            $response = array(
                'status' => 1,
                'message' =>'Data Dosen Deleted Successfully.'
            );
        } else {
            $response = array(
                'status' => 0,
                'message' =>'Data Dosen Deletion Failed.'
            );
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }
}
?>
