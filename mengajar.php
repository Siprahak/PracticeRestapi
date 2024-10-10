<?php
require_once "koneksi.php";

$request_method = $_SERVER["REQUEST_METHOD"];

if ($request_method == 'POST') {
    insert_mengajar();
} elseif ($request_method == 'GET') {
    if (!empty($_GET["id_mengajar"])) {
        $id_mengajar = intval($_GET["id_mengajar"]);
        get_mengajar($id_mengajar);
    } else {
        get_all_mengajar();
    }
} elseif ($request_method == 'DELETE') {
    $id_mengajar = intval($_GET["id_mengajar"]);
    delete_mengajar($id_mengajar);
} else {
    header("HTTP/1.0 405 Method Not Allowed");
}

function insert_mengajar() {
    global $mysqli;
    $id_dosen = intval($_POST["id_dosen"]);
    $id_matakuliah = intval($_POST["id_matakuliah"]);
    $semester = $_POST["semester"];
    $tahun_ajaran = $_POST["tahun_ajaran"];

    $query = "INSERT INTO mengajar (id_dosen, id_matakuliah, semester, tahun_ajaran) VALUES ($id_dosen, $id_matakuliah, '$semester', '$tahun_ajaran')";
    if ($mysqli->query($query)) {
        $response = array(
            'status' => 1,
            'message' => 'Data Mengajar Added Successfully.'
        );
    } else {
        $response = array(
            'status' => 0,
            'message' => 'Data Mengajar Addition Failed.'
        );
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}

function get_all_mengajar() {
    global $mysqli;
    $query = "SELECT * FROM mengajar";
    $result = $mysqli->query($query);
    $data = array();
    while ($row = mysqli_fetch_object($result)) {
        $data[] = $row;
    }
    header('Content-Type: application/json');
    echo json_encode($data);
}

function get_mengajar($id_mengajar) {
    global $mysqli;
    $query = "SELECT * FROM mengajar WHERE id_mengajar = $id_mengajar LIMIT 1";
    $result = $mysqli->query($query);
    $data = array();
    if ($row = mysqli_fetch_object($result)) {
        $data = $row;
    }
    header('Content-Type: application/json');
    echo json_encode($data);
}

function delete_mengajar($id_mengajar) {
    global $mysqli;
    $query = "DELETE FROM mengajar WHERE id_mengajar = $id_mengajar";
    if ($mysqli->query($query)) {
        $response = array(
            'status' => 1,
            'message' => 'Data Mengajar Deleted Successfully.'
        );
    } else {
        $response = array(
            'status' => 0,
            'message' => 'Data Mengajar Deletion Failed.'
        );
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
