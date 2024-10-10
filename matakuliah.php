<?php
require_once "koneksi.php";

$request_method = $_SERVER["REQUEST_METHOD"];

if ($request_method == 'POST') {
    insert_matakuliah();
} elseif ($request_method == 'GET') {
    if (!empty($_GET["id_matakuliah"])) {
        $id_matakuliah = intval($_GET["id_matakuliah"]);
        get_matakuliah($id_matakuliah);
    } else {
        get_all_matakuliah();
    }
} elseif ($request_method == 'DELETE') {
    $id_matakuliah = intval($_GET["id_matakuliah"]);
    delete_matakuliah($id_matakuliah);
} else {
    header("HTTP/1.0 405 Method Not Allowed");
}

function insert_matakuliah() {
    global $mysqli;
    $nama_matakuliah = $_POST["nama_matakuliah"];
    $kode_matakuliah = $_POST["kode_matakuliah"];
    $sks = intval($_POST["sks"]);

    $query = "INSERT INTO matakuliah (nama_matakuliah, kode_matakuliah, sks) VALUES ('$nama_matakuliah', '$kode_matakuliah', $sks)";
    if ($mysqli->query($query)) {
        $response = array(
            'status' => 1,
            'message' => 'Data Matakuliah Added Successfully.'
        );
    } else {
        $response = array(
            'status' => 0,
            'message' => 'Data Matakuliah Addition Failed.'
        );
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}

function get_all_matakuliah() {
    global $mysqli;
    $query = "SELECT * FROM matakuliah";
    $result = $mysqli->query($query);
    $data = array();
    while ($row = mysqli_fetch_object($result)) {
        $data[] = $row;
    }
    header('Content-Type: application/json');
    echo json_encode($data);
}

function get_matakuliah($id_matakuliah) {
    global $mysqli;
    $query = "SELECT * FROM matakuliah WHERE id_matakuliah = $id_matakuliah LIMIT 1";
    $result = $mysqli->query($query);
    $data = array();
    if ($row = mysqli_fetch_object($result)) {
        $data = $row;
    }
    header('Content-Type: application/json');
    echo json_encode($data);
}

function delete_matakuliah($id_matakuliah) {
    global $mysqli;
    $query = "DELETE FROM matakuliah WHERE id_matakuliah = $id_matakuliah";
    if ($mysqli->query($query)) {
        $response = array(
            'status' => 1,
            'message' => 'Data Matakuliah Deleted Successfully.'
        );
    } else {
        $response = array(
            'status' => 0,
            'message' => 'Data Matakuliah Deletion Failed.'
        );
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
