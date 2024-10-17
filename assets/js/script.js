// baca input type
function inputType() {
    var input = document.getElementsByTagName('input');
    for (i = 0; i < input.length; i++) {
        var idinput = document.getElementById(input[i].id);
        if (idinput) {
            idinput.setAttribute('autocomplete', 'off');
            var idtype = idinput.getAttribute('type');
            if (idtype == 'angka') {
                var idfunctionlain = idinput.getAttribute('functionlain');
                var idonkeyupmore = idinput.getAttribute('onkeyupmore');
                var namafunction = 'inputAngka("' + input[i].id + '")';
                if (idonkeyupmore) {
                    var namafunction = 'inputAngka("' + input[i].id + '")' + ';' + idonkeyupmore;
                }
                idinput.setAttribute('onkeyup', namafunction);
                idinput.setAttribute('onkeypress', namafunction);
                if (idfunctionlain) {
                    idinput.setAttribute('onchange', idfunctionlain);
                }
            }
            if (idtype == 'nominal') {
                var idfunctionlain = idinput.getAttribute('functionlain');
                var idonkeyupmore = idinput.getAttribute('onkeyupmore');
                var namafunctionkeyup = 'inputNominal("' + input[i].id + '")';
                var namafunctionkeypress = 'inputNominal("' + input[i].id + '")';
                var namafunctiononchange = 'numberFormat("' + input[i].id + '")';
                if (idfunctionlain) {
                    var namafunctiononchange = 'numberFormat("' + input[i].id + '")' + ';' + idfunctionlain;
                }
                if (idonkeyupmore) {
                    var namafunctionkeyup = 'inputNominal("' + input[i].id + '")' + ';' + idonkeyupmore;
                }
                idinput.setAttribute('onkeyup', namafunctionkeyup);
                idinput.setAttribute('onkeypress', namafunctionkeypress);
                idinput.setAttribute('onchange', namafunctiononchange);
            }
            if (idtype == 'persen') {
                var idminpersen = idinput.getAttribute('minpersen');
                var idmaxpersen = idinput.getAttribute('maxpersen');
                var idfunctionlain = idinput.getAttribute('functionlain');
                if (!idminpersen) {
                    idminpersen = 0;
                }
                if (!idmaxpersen) {
                    idmaxpersen = 100;
                }
                var namafunction1 = 'inputPersen("' + input[i].id + '")';
                var namafunction2 = 'minmaxPersen("' + input[i].id + '","' + idminpersen + '","' + idmaxpersen + '")';
                if (idfunctionlain) {
                    namafunction2 = 'minmaxPersen("' + input[i].id + '","' + idminpersen + '","' + idmaxpersen + '")' + ';' + idfunctionlain;
                }
                idinput.setAttribute('onkeyup', namafunction1);
                idinput.setAttribute('onkeypress', namafunction1);
                idinput.setAttribute('onchange', namafunction2);
            }
        }

    }
}

// baca hak user button atau link
function buttonLinkHakUser(leveluser) {
    // Button
    var button = document.getElementsByTagName('button');
    for (i = 0; i < button.length; i++) {
        var hakuser = button[i].getAttribute('hakuser');
        if (hakuser) {
            if (leveluser !== '0') {
                button[i].style.display = 'none';
            }
        }
    }
    // Link
    var link = document.getElementsByTagName('a');
    for (i = 0; i < link.length; i++) {
        var hakuser = link[i].getAttribute('hakuser');
        if (hakuser) {
            if (leveluser !== '0') {
                link[i].style.display = 'none';
            }
        }
    }
}

// type angka
function inputAngka(id) {
    var idinput = document.getElementById(id);
    var lastchar = idinput.value.charAt(idinput.selectionStart - 1);
    var minnilai = idinput.getAttribute('minnilai');
    var maxnilai = idinput.getAttribute('maxnilai');
    if (isNaN(lastchar)) {
        idinput.value = idinput.value.replace(lastchar, '');
        inputAngka(id);
    }
    if (minnilai && lastchar !== '') {
        if (Number(idinput.value) < minnilai) {
            idinput.value = minnilai;
        }
    }
    if (maxnilai && lastchar !== '') {
        if (Number(idinput.value) > maxnilai) {
            idinput.value = maxnilai;
        }
    }
}

// type nominal
function inputNominal(id) {
    var idinput = document.getElementById(id);
    var lastchar = idinput.value.charAt(idinput.selectionStart - 1);
    if (isNaN(lastchar) && lastchar !== ',' && lastchar !== '.') {
        idinput.value = idinput.value.replace(lastchar, '');
        inputNominal(id);
    }

    // -- autoFormatNumber --
    // var twofromlastchar = idinput.value.charAt(idinput.value.length - 2);
    // if ((lastchar == ',' && twofromlastchar == ',') || lastchar !== ',') {
    //     numberFormat(id);
    // }
}

function inputPersen(id) {
    var idinput = document.getElementById(id);
    var lastchar = idinput.value.charAt(idinput.selectionStart - 1);
    if (isNaN(lastchar)) {
        idinput.value = idinput.value.replace(lastchar, '');
    }
}

// konfigurasi min max dalam persen
function minmaxPersen(id, min, max) {
    var idinput = document.getElementById(id);
    if (Number(idinput.value) < min) {
        idinput.value = min;
    }
    if (Number(idinput.value) > max) {
        idinput.value = max;
    }
}

// number format
function numberFormat(id) {
    var idinput = document.getElementById(id);
    if (idinput.value) {
        var numberReplace = idinput.value.replaceAll(',', '');
        var numberInt = Number(numberReplace);
        idinput.value = numberInt.toLocaleString('en-US', { style: "decimal" });
    }
}

// filter bulan dan periode
function gantiFilter(jenis) {
    if (jenis == 'bulan') {
        document.getElementById('divbulan').style.display = 'block';
        document.getElementById('divtglawal').style.display = 'none';
        document.getElementById('divtglakhir').style.display = 'none';
        document.getElementById('bulan').setAttribute('required', true);
        document.getElementById('tglawal').removeAttribute('required', true);
        document.getElementById('tglakhir').removeAttribute('required', true);
    } else if (jenis == 'periode') {
        document.getElementById('divbulan').style.display = 'none';
        document.getElementById('divtglawal').style.display = 'block';
        document.getElementById('divtglakhir').style.display = 'block';
        document.getElementById('bulan').removeAttribute('required', true);
        document.getElementById('tglawal').setAttribute('required', true);
        document.getElementById('tglakhir').setAttribute('required', true);
    }
}

function cekTanggal(jenis) {
    var tglawal = document.getElementById('tglawal');
    var tglakhir = document.getElementById('tglakhir');
    if (tglawal.value && tglakhir.value) {
        if (tglawal.value <= tglakhir.value) {
            var tglawalval = tglawal.value.split('-');
            var bulanawalval = tglawalval[1];
            tglawalval = tglawalval[2];

            var tglakhirval = tglakhir.value.split('-');
            var bulanakhirval = tglakhirval[1];
            tglakhirval = tglakhirval[2];

            if (jenis == '30hari') {
                if (Number(tglakhirval) > Number(tglawalval) && bulanawalval !== bulanakhirval) {
                    toastr.error('Maximal Range Tanggal adalah 30 Hari');
                    tglawal.value = '';
                } else if ((Number(bulanakhirval) - Number(bulanawalval)) > 1) {
                    toastr.error('Maximal Range Tanggal adalah 30 Hari');
                    tglawal.value = '';
                }
            }
        } else {
            toastr.error('Tanggal Akhir tidak boleh lebih kecil dari Tanggal Awal');
            tglawal.value = '';
        }
    }
}

// nomor urut
function nomorurut(length, number, posisi = 'L') {
    var lnum = number.length; // length number
    var nol = '';
    for (var i = 1; i <= length; i++) {
        if (i > lnum) {
            nol = nol + "0";
        }
    }
    if (posisi == 'L') {
        return nol + number;
    } else if (posisi == 'R') {
        return number + nol;
    }
}

function nomorabjad(abjad) {
    abjad = abjad.toUpperCase();
    return abjad.charCodeAt() - 64;
}

const formatDate = (date) => {
    let d = new Date(date);
    let month = (d.getMonth() + 1).toString();
    let day = d.getDate().toString();
    let year = d.getFullYear();
    if (month.length < 2) {
        month = '0' + month;
    }
    if (day.length < 2) {
        day = '0' + day;
    }
    return [year, month, day].join('-');
}

function formatkode(nama, kode) {
    var namainput = document.getElementById(nama);
    var kodeinput = document.getElementById(kode);

    var lastchar = kodeinput.value.charAt(kodeinput.selectionStart - 1);
    if (isNaN(lastchar)) {
        if (namainput.value['0'] == lastchar) {
            kodeinput.value = namainput.value[0] + kodeinput.value.replaceAll(lastchar, '');
        } else {
            kodeinput.value = kodeinput.value.replaceAll(lastchar, '');
        }
    }
    kodeinput.value = namainput.value[0] + kodeinput.value.substring(1, 4);
}
