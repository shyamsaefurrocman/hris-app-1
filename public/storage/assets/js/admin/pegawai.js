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

function handleEditPegawai(pegawais, id) {
    $("#editPegawai").modal("show");

    const isPegawais = JSON.parse(pegawais);
    const findPegawaisByID = isPegawais.find((pegawai) => pegawai.id_user === parseInt(id));

    Object.entries(findPegawaisByID)
        .filter(([key]) => !["created_at", "updated_at", "password", "foto"].includes(key))
        .forEach(
            ([key, value]) =>
                (document.getElementById(`${key}_put`).value = value)
        );
}

function handleDeletePegawai(id) {
    $("#deletePegawai").modal("show");

    const idUser = document.getElementById("id_user_delete");
    idUser.value = id;

    const content = document.getElementById("content-delete");
    content.innerHTML = "<h6>Apakah anda yakin ingin menghapus Pegawai ini?</h6>";
}
