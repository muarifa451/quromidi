function formatRupiah(angka, prefix = 'Rp. ') {
    if (isNaN(angka) || angka == null) return prefix + '0';

    var number_string = angka.toString().replace(/[^,\d]/g, ''),
        split    = number_string.split(','),
        sisa     = split[0].length % 3,
        rupiah   = split[0].substr(0, sisa),
        ribuan   = split[0].substr(sisa).match(/\d{3}/g);

    if (ribuan) {
        var separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix + rupiah;
}
