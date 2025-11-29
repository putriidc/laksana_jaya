// resources/js/notification.js

// Pastikan Swal diimpor di app.js dan tersedia (window.Swal = Swal;)
import Swal from "sweetalert2";

/**
 * Mendeteksi elemen flash message dan memicu SweetAlert2
 */
export function showFlashMessages() {
    const flashElement = document.getElementById("flash-message");

    if (flashElement) {
        const type = flashElement.dataset.type;
        const message = flashElement.dataset.message;

        // Konfigurasi default SweetAlert2
        const config = {
            title: "",
            text: message,
            showConfirmButton: false,
            timer: 3000,
        };

        if (type === "success") {
            config.icon = "success";
            config.title = "Berhasil!";
        } else if (type === "error") {
            config.icon = "error";
            config.title = "Gagal!";
            // Jika error, biasanya tidak auto-close
            config.timer = undefined;
            config.showConfirmButton = true;
        }

        // Panggil SweetAlert2 dengan konfigurasi yang sudah disesuaikan
        Swal.fire(config);

        // Opsional: Hapus elemen dari DOM agar tidak mengganggu
        flashElement.remove();
    }
}
