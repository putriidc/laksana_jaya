import flatpickr from "flatpickr";
import "flatpickr/dist/flatpickr.min.css"; // CSS dasar Flatpickr

// Inisialisasi pada elemen
const flatpickr = require("flatpickr");
flatpickr("#tanggal_input", {
    dateFormat: "d-m-Y",
    allowInput: true,
});
