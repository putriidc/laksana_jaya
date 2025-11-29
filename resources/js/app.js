// resources/js/app.js

import "./bootstrap";
import Swal from "sweetalert2";
window.Swal = Swal; // Pastikan Swal tersedia secara global

// Import modul notifikasi yang baru dibuat
import { showFlashMessages } from "../../public/js/notification.js";

// Import library Flatpickr untuk Datepicker
import flatpickr from "flatpickr";
import "flatpickr/dist/flatpickr.min.css"; // CSS dasar Flatpickr
// Impor locale jika Anda menggunakannya (misalnya Bahasa Indonesia)
import { Indonesian } from "flatpickr/dist/l10n/id.js";

// Import file bootstrap Anda (jika ada, biasanya untuk setup Axios, dll.)
import "./bootstrap";

/**
 * 1. Fungsi Inisialisasi FLATPCKR
 * Menginisialisasi Flatpickr pada semua elemen <input> dengan atribut data-flatpickr.
 */
function initializeFlatpickr() {
    // Cari semua input yang ingin dijadikan datepicker (Anda bisa menggunakan ID atau atribut data)
    const dateInputs = document.querySelectorAll(
        'input[type="text"][data-flatpickr]'
    );

    dateInputs.forEach((inputElement) => {
        flatpickr(inputElement, {
            // Opsi Default:
            dateFormat: "Y-m-d",
            locale: Indonesian, // Aktifkan jika Anda mengimpor locale

            // Mengambil opsi tambahan dari atribut data HTML
            ...inputElement.dataset,
        });
    });
}
// Jalankan semua inisialisasi setelah DOM dimuat sepenuhnya
document.addEventListener("DOMContentLoaded", () => {
    initializeFlatpickr();
    showFlashMessages();
});
