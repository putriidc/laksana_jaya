// Rupiah format
// buat variabel untuk semua elemen dengan class rupiah-format
const rupiahFormatElements = document.querySelectorAll(".rupiah-format");
// lakukan iterasi pada setiap elemen dan tambahkan event listener
rupiahFormatElements.forEach((element) => {
    element.addEventListener("input", function (e) {
        // hapus karakter yang bukan angka atau koma
        let value = this.value.replace(/[^,\d]/g, "").toString();
        // pisahkan antara angka dan koma
        let split = value.split(",");
        // format angka menjadi rupiah
        let sisa = split[0].length % 3;
        // ambil angka yang tidak termasuk dalam kelipatan 3
        let rupiah = split[0].substr(0, sisa);
        // ambil angka yang termasuk dalam kelipatan 3
        let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik sebagai pemisah ribuan
        if (ribuan) {
            let separator = sisa ? "." : "";
            rupiah += separator + ribuan.join(".");
        }

        // tambahkan kembali koma dan angka di belakangnya jika ada
        rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
        // tampilkan hasil format rupiah pada input
        this.value = rupiah ? "Rp. " + rupiah : "";
    });
});
// End Rupiah format

// string to number dan hilangkan format rupiah 'Rp. ' dan titik
function parseRupiahToNumber(rupiahString) {
    if (!rupiahString) return 0;
    return parseInt(rupiahString.replace(/[^0-9]/g, "")) || 0;
}
// End string to number

// number to rupiah format
function formatNumberToRupiah(number) {
    if (!number) return "";
    return "Rp. " + number.toLocaleString("id-ID");
}
// End number to rupiah format

// Pada saat submit form, hilangkan format rupiah pada input dengan class 'rupiah-format'
document.addEventListener("DOMContentLoaded", function () {
    // Pastikan ID form Anda sudah benar di HTML (misalnya: myForm)
    const form = document.getElementById("myForm");

    // Pastikan Anda juga memiliki listener 'input' dan fungsi formatRupiah()
    // ... (Kode untuk formatRupiah dan listener 'input' yang sudah ada di sini) ...

    if (form) {
        form.addEventListener("submit", function (e) {
            e.preventDefault();
            // 1. Cari semua input yang ditandai sebagai input Rupiah
            const rupiahInputs = form.querySelectorAll(".rupiah-format");

            rupiahInputs.forEach((input) => {
                let value = input.value;

                // 2. Bersihkan nilai: Hapus semua titik (.) dari nilai input
                // Ini mengubah "1.000.000" menjadi "1000000"
                let cleanValue = parseRupiahToNumber(value);

                // 3. (OPSIONAL TAPI BAIK) Konversi ke integer/float jika perlu,
                //    tapi umumnya cukup kirim string angka murni

                // 4. Ubah nilai input DOM SEMENTARA sebelum form dikirim
                input.value = cleanValue;

                // cek apakah di console log sudah bersih
                console.log(
                    `Input name: ${input.name}, Clean value: ${input.value}`
                );
            });

            // Form akan melanjutkan proses submit dengan nilai yang sudah bersih.
        });
    }
});

// ===============================================
// FORM FREELANCE ADD
// Hitung total salary, dari salary x day
const salaryInput = document.getElementById("salary");
const dayInput = document.getElementById("day");
const totalSalaryInput = document.getElementById("total-salary");
salaryInput.addEventListener("input", () => {
    // fungsi dispatchEvent untuk memicu event input pada dayInput agar perhitungan total salary juga terjadi saat salary diubah
    dayInput.dispatchEvent(new Event("input"));
    tambahanInput.dispatchEvent(new Event("input"));
    kasbonInput.dispatchEvent(new Event("input"));
});
dayInput.addEventListener("input", () => {
    const salary = parseRupiahToNumber(salaryInput.value);
    const day = parseInt(dayInput.value) || 0;
    const totalSalary = salary * day;
    totalSalaryInput.value = formatNumberToRupiah(totalSalary);
    tambahanInput.dispatchEvent(new Event("input"));
    kasbonInput.dispatchEvent(new Event("input"));
});
// End Hitung total salary

// Hitung Jumlah, total salary x tambahan
const tambahanInput = document.getElementById("tambahan");
const jumlahInput = document.getElementById("jumlah");
tambahanInput.addEventListener("input", () => {
    const totalSalary = parseRupiahToNumber(totalSalaryInput.value);
    const tambahan = parseRupiahToNumber(tambahanInput.value);
    const jumlah = totalSalary + tambahan;
    jumlahInput.value = formatNumberToRupiah(jumlah);
    kasbonInput.dispatchEvent(new Event("input"));
});
// End Hitung Jumlah

// Hitung total seluruh, jumlah - kasbon
const kasbonInput = document.getElementById("kasbon");
const totalSeluruhInput = document.getElementById("total-seluruh");
kasbonInput.addEventListener("input", () => {
    const jumlah = parseRupiahToNumber(jumlahInput.value);
    const kasbon = parseRupiahToNumber(kasbonInput.value);
    const totalSeluruh = jumlah - kasbon;
    totalSeluruhInput.value = formatNumberToRupiah(totalSeluruh);
});
// End Hitung total seluruh
// FORM FREELANCE ADD
// ===============================================
