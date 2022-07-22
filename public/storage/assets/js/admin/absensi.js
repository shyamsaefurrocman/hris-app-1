function handleShowAdmin(pegawais, id) {
    $("#showAdmin").modal("show");

    const isPegawais = JSON.parse(pegawais);
    const findPegawaisByID = isPegawais.find((pegawai) => pegawai.id_user === parseInt(id));

    Object.entries(findPegawaisByID)
        .filter(([key]) => !["id_user", "created_at", "updated_at", "password", "foto"].includes(key))
        .forEach(
            ([key, value]) =>
                (document.getElementById(`${key}_admin_show`).value = value)
        );
}

function handleShowPegawai(pegawais, id, foto) {
    $("#showPegawai").modal("show");

    console.log("hai",foto);

    const isPegawais = JSON.parse(pegawais);
    const findPegawaisByID = isPegawais.find((pegawai) => pegawai.id_user === parseInt(id));
    const fotoProfil = document.getElementById('foto_show');

    if (fotoProfil != "user.png") {
        fotoProfil.src = "http://103.129.222.7/~bluenpea/hrisapp/storage/foto/"+foto+"";
    } else {
        fotoProfil.src = "http://103.129.222.7/~bluenpea/hrisapp/storage/foto/user.png";
    }



    Object.entries(findPegawaisByID)
        .filter(([key]) => !["id_user", "created_at", "updated_at", "password", "foto"].includes(key))
        .forEach(
            ([key, value]) =>
                (document.getElementById(`${key}_show`).value = value)
        );
}

function handleEditAdmin(pegawais, id) {
    $("#editAdmin").modal("show");

    const isPegawais = JSON.parse(pegawais);
    const findPegawaisByID = isPegawais.find((pegawai) => pegawai.id_user === parseInt(id));

    Object.entries(findPegawaisByID)
        .filter(([key]) => !["created_at", "updated_at", "password", "foto"].includes(key))
        .forEach(
            ([key, value]) =>
                (document.getElementById(`${key}_admin_put`).value = value)
        );
}

function handleEditAbsensi(absensis, id) {
    $("#editAbsensi").modal("show");

    const isAbsensis = JSON.parse(absensis);
    const findAbsensisByID = isAbsensis.find((absensi) => absensi.id_absensi === parseInt(id));

    Object.entries(findAbsensisByID)
        .filter(([key]) => !["created_at", "updated_at", "id_user"].includes(key))
        .forEach(
            ([key, value]) =>
                (document.getElementById(`${key}_put`).value = value)
        );
}

function handleDeleteAbsensi(id) {
    $("#deleteAbsensi").modal("show");

    const idUser = document.getElementById("id_absensi_delete");
    idUser.value = id;

    const content = document.getElementById("content-delete");
    content.innerHTML = "<h6>Apakah anda yakin ingin menghapus Rekap Absensi ini?</h6>";
}

function handleEditAbsensiPegawai(absensis, id) {
    $("#editAbsensi").modal("show");

    const isAbsensis = JSON.parse(absensis);
    const findAbsensisByID = isAbsensis.find((absensi) => absensi.id_user_absen === parseInt(id));

    console.log(findAbsensisByID);

    Object.entries(findAbsensisByID)
        .filter(([key]) => !["alamat", "created_at", "email", "foto", "id_user", "nama", "nomor_telepon", "password", "role", "updated_at"].includes(key))
        .forEach(
            ([key, value]) =>
                (document.getElementById(`${key}_put`).value = value)
        );
}

function handlePresensi(idUserAbsen, idAbsen, keterangan) {
    $("#editAbsensi").modal("show");

    console.log(idUserAbsen, keterangan);

    document.getElementById('keterangan_put').value = keterangan;
    document.getElementById('id_user_absen_put').value = idUserAbsen;
    document.getElementById('id_absensi_put').value = idAbsen;

}

function handleRekapPresensi(idUserAbsen, idAbsen, keterangan) {
    $("#rekapAbsensi").modal("show");
}
