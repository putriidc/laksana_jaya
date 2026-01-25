@extends('owner.layout') @section('content')
    <div>
        <div class="flex flex-col mb-6">
            <section class="mb-10">
                <h1 class="font-bold text-2xl mb-4 text-[#C0C0C0] max-[500px]:text-xl">Form Pengajuan Pinjaman Karyawan</h1>
                <div class="rounded-lg shadow-[0px_0px_5px_rgba(0,0,0,0.1)] pt-4 pb-6 max-[1200px]:overflow-x-scroll max-[1200px]:overflow-x-scroll">
                    <table class="table-auto text-center text-sm w-full max-[1200px]:w-[1200px]">
                        <thead class="border-b-2 border-[#CCCCCC]">
                            <tr>
                                <th class="py-2 w-[10%]">Tgl Pengajuan</th>
                                <th class="py-2 w-[15%]">Nama Karyawan</th>
                                <th class="py-2 w-[15%]">Kontrak</th>
                                <th class="py-2 w-[10%]">Sumber Kas</th>
                                <th class="py-2 w-[20%]">Jumlah Pinjaman</th>
                                <th class="py-2 w-[10%]">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contentPinjams as $item)
                                <tr class="bg-white border-b border-[#CCCCCC]">
                                    <td class="py-2">{{ $item->tanggal }}</td>
                                    <td class="py-2">{{ $item->karyawanPinjaman->karyawan->nama }}</td>
                                    <td class="py-2">{{ $item->kontrak }}</td>
                                    <td class="py-2">{{ $item->kas->nama_akun ?? 'Tidak Ada Kas Bank' }}</td>
                                    <td class="py-2">{{ 'Rp. ' . number_format($item->bayar, 0, ',', '.') }}</td>
                                    <td class="py-2 flex justify-center items-center gap-2">
                                        <form action="{{ route('accowner.storePinjam', $item->id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id_tukang_content" value="{{ $item->id }}">
                                            <button class="bg-[#8CE987] px-4 py-2 rounded-lg cursor-pointer">Accept</button>
                                        </form>
                                        <button data-id="{{ $item->id }}"
                                            class="bg-[#DD4049] px-4 py-2 rounded-lg cursor-pointer text-white declinePinjam-btn">
                                            Decline
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </section>
            <section class="mb-10">
                <h1 class="font-bold text-2xl mb-4 text-[#C0C0C0] max-[500px]:text-xl">Form Pengajuan Kasbon Karyawan</h1>
                <div class="rounded-lg shadow-[0px_0px_5px_rgba(0,0,0,0.1)] pt-4 pb-6 max-[1200px]:overflow-x-scroll">
                    <table class="table-auto text-center text-sm w-full max-[1200px]:w-[1200px]">
                        <thead class="border-b-2 border-[#CCCCCC]">
                            <tr>
                                <th class="py-2 w-[10%]">Tgl Pengajuan</th>
                                <th class="py-2 w-[15%]">Nama Karyawan</th>
                                <th class="py-2 w-[15%]">Kontrak</th>
                                <th class="py-2 w-[10%]">Sumber Kas</th>
                                <th class="py-2 w-[20%]">Jumlah Pinjaman</th>
                                <th class="py-2 w-[10%]">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contentKasbons as $item)
                                <tr class="bg-white border-b border-[#CCCCCC]">
                                    <td class="py-2">{{ $item->tanggal }}</td>
                                    <td class="py-2">{{ $item->karyawanKasbon->karyawan->nama }}</td>
                                    <td class="py-2">{{ $item->kontrak }}</td>
                                    <td class="py-2">{{ $item->kas->nama_akun ?? 'Tidak Ada Kas Bank' }}</td>
                                    <td class="py-2">{{ 'Rp. ' . number_format($item->bayar, 0, ',', '.') }}</td>
                                    <td class="py-2 flex justify-center items-center gap-2">
                                        <form action="{{ route('accowner.storeKasbon', $item->id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id_tukang_content" value="{{ $item->id }}">
                                            <button class="bg-[#8CE987] px-4 py-2 rounded-lg cursor-pointer">Accept</button>
                                        </form>
                                        <button data-id="{{ $item->id }}"
                                            class="bg-[#DD4049] px-4 py-2 rounded-lg cursor-pointer text-white declineKasbon-btn">
                                            Decline
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </section>
            <section class="mb-5">
                <h1 class="font-bold text-2xl mb-4 text-[#C0C0C0] max-[500px]:text-xl">Data Persetujuan Pinjaman Karyawan</h1>
                <a target="_blank" href="{{ route('accownerPinjaman.print') }}"
                    class="px-4 py-2 border-2 border-[rgb(154,154,154)] rounded-lg w-fit flex items-center gap-x-2 mb-4">
                    <span class="text-[#72686B]">Cetak Laporan</span>
                    <img src="{{ asset('assets/printer.png') }}" alt="printer icon">
                </a>
                <div class="rounded-lg shadow-[0px_0px_5px_rgba(0,0,0,0.1)] pt-4 pb-6 max-[1200px]:overflow-x-scroll">
                    <table class="table-auto text-center text-sm w-full max-[1200px]:w-[1200px]">
                        <thead class="border-b-2 border-[#CCCCCC]">
                            <th class="py-2 w-[10%]">Tgl Pengajuan</th>
                            <th class="py-2 w-[15%]">Nama Karyawan</th>
                            <th class="py-2 w-[15%]">Kontrak</th>
                            <th class="py-2 w-[10%]">Sumber Kas</th>
                            <th class="py-2 w-[15%]">Ket Owner</th>
                            <th class="py-2 w-[20%]">Jumlah Pinjaman</th>
                            <th class="py-2 w-[10%]">Action</th>
                        </thead>
                        <tbody>
                            @foreach ($pinjamans as $item)
                                <tr class="bg-white border-b-[1px] border-[#CCCCCC]">
                                    <td class="py-2">{{ $item->tanggal }}</td>
                                    <td class="py-2">{{ $item->karyawanPinjaman->karyawan->nama }}</td>
                                    <td class="py-2">{{ $item->kontrak }}</td>
                                    <td class="py-2">{{ $item->kas->nama_akun ?? 'Tidak Ada Kas Bank' }}</td>
                                    <td class="py-2">{{ $item->ket_owner }}</td>
                                    <td class="py-2">{{ 'RP. ' . number_format($item->bayar, 0, ',', '.') }}</td>
                                    <td class="py-2 flex justify-center items-center gap-x-2">
                                        {{-- Status SPV --}}
                                        @if ($item->menunggu == true)
                                            <span
                                                class="bg-[#999999] px-4 py-2 rounded-lg cursor-pointer text-white/60">Pending
                                            </span>
                                        @elseif ($item->tolak == true)
                                            <span
                                                class="bg-[#DD4049] px-4 py-2 rounded-lg cursor-pointer text-white">Decline
                                            </span>
                                        @elseif ($item->setuju == true)
                                            <span class="bg-[#8CE987] px-4 py-2 rounded-lg cursor-pointer">Accept </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
            <section class="mb-5">
                <h1 class="font-bold text-2xl mb-4 text-[#C0C0C0] max-[500px]:text-xl">Data Persetujuan Kasbon Karyawan</h1>
                <a target="_blank" href="{{ route('accownerKasbon.print') }}"
                    class="px-4 py-2 border-2 border-[#9A9A9A] rounded-lg w-fit flex items-center gap-x-2 mb-4">
                    <span class="text-[#72686B]">Cetak Laporan</span>
                    <img src="{{ asset('assets/printer.png') }}" alt="printer icon">
                </a>
                <div class="rounded-lg shadow-[0px_0px_5px_rgba(0,0,0,0.1)] pt-4 pb-6 max-[1200px]:overflow-x-scroll">
                    <table class="table-auto text-center text-sm w-full max-[1200px]:w-[1200px]">
                        <thead class="border-b-2 border-[#CCCCCC]">
                            <th class="py-2 w-[10%]">Tgl Pengajuan</th>
                            <th class="py-2 w-[15%]">Nama Karyawan</th>
                            <th class="py-2 w-[15%]">Kontrak</th>
                            <th class="py-2 w-[10%]">Sumber Kas</th>
                            <th class="py-2 w-[15%]">Ket Owner</th>
                            <th class="py-2 w-[20%]">Jumlah Pinjaman</th>
                            <th class="py-2 w-[10%]">Action</th>
                        </thead>
                        <tbody>
                            @foreach ($kasbons as $item)
                                <tr class="bg-white border-b-[1px] border-[#CCCCCC]">
                                    <td class="py-2">{{ $item->tanggal }}</td>
                                    <td class="py-2">{{ $item->karyawanKasbon->karyawan->nama }}</td>
                                    <td class="py-2">{{ $item->kontrak }}</td>
                                    <td class="py-2">{{ $item->kas->nama_akun ?? 'Tidak Ada Kas Bank' }}</td>
                                    <td class="py-2">{{ $item->ket_owner }}</td>
                                    <td class="py-2">{{ 'RP. ' . number_format($item->bayar, 0, ',', '.') }}</td>
                                    <td class="py-2 flex justify-center items-center gap-x-2">
                                        {{-- Status SPV --}}
                                        @if ($item->menunggu == true)
                                            <span
                                                class="bg-[#999999] px-4 py-2 rounded-lg cursor-pointer text-white/60">Pending
                                            </span>
                                        @elseif ($item->tolak == true)
                                            <span
                                                class="bg-[#DD4049] px-4 py-2 rounded-lg cursor-pointer text-white">Decline
                                            </span>
                                        @elseif ($item->setuju == true)
                                            <span class="bg-[#8CE987] px-4 py-2 rounded-lg cursor-pointer">Accept </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
            <script>
                function modalDecline() {
                    Swal.fire({
                        html: `
                        <div class="flex gap-x-4 w-full justify-center items-center h-[100px]">
                            <form action="/owner-pinjaman-create"  id="form-tambah">
                                @csrf
                                <button type="submit" class="bg-[#8CE987] px-4 py-2 rounded-lg cursor-pointer">Ajukan Nominal Baru</button>
                            </form>
                                <button  type="submit" class="declinePinjam-btn bg-[#DD4049] px-4 py-2 rounded-lg cursor-pointer">Tolak Pengajuan</button>
                        </div>
                    `,
                        showCancelButton: false,
                        showCloseButton: false,
                        showConfirmButton: false,

                    })
                }
            </script>

            {{-- Tolak Tukang --}}
            <script>
                document.querySelectorAll('.decline-btn').forEach(btn => {
                    btn.addEventListener('click', function(e) {
                        e.preventDefault();
                        const id = this.dataset.id; // ambil ID dari data-id

                        Swal.fire({
                            title: 'Tolak Pengajuan',
                            input: 'textarea',
                            inputPlaceholder: 'Tuliskan alasan penolakan...',
                            showCancelButton: true,
                            confirmButtonText: 'Tolak',
                            cancelButtonText: 'Batal',
                            confirmButtonColor: '#DD4049',
                            preConfirm: (ket_owner) => {
                                if (!ket_owner) {
                                    Swal.showValidationMessage('Alasan wajib diisi');
                                }
                                return ket_owner;
                            }
                        }).then((result) => {
                            if (result.isConfirmed) {
                                fetch(`/pinjamanO/${id}/decline`, {
                                        method: "POST",
                                        headers: {
                                            "Content-Type": "application/json",
                                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                                        },
                                        body: JSON.stringify({
                                            status_owner: "decline",
                                            ket_owner: result.value
                                        })
                                    })
                                    .then(res => res.json())
                                    .then(data => {
                                        Swal.fire('Ditolak!', 'Pengajuan berhasil ditolak.', 'success');
                                        location.reload();
                                    })
                                    .catch(err => {
                                        Swal.fire('Error', 'Terjadi kesalahan.', 'error');
                                    });
                            }
                        });
                    });
                });
            </script>

            {{-- Tolak PinjamanKaryawan --}}
            <script>
                document.querySelectorAll('.declinePinjam-btn').forEach(btn => {
                    btn.addEventListener('click', function(e) {
                        e.preventDefault();
                        const id = this.dataset.id; // ambil ID dari tombol

                        Swal.fire({
                            title: 'Tolak Pengajuan Pinjaman',
                            html: `
                                    <textarea id="ket_owner" class="w-full border-gray-400 border-2 rounded-lg outline-none p-2" rows="6" placeholder="Tuliskan alasan penolakan..."></textarea>
                                    <div class="flex justify-center gap-4 max-[600px]:gap-0 max-[600px]:flex-wrap mt-4">
                                        <button id="btn-tolak" class="swal2-confirm swal2-styled" style="background:#DD4049">Tolak</button>
                                        <button id="btn-ajukan" class="swal2-deny swal2-styled" style="background:#8CE987">Ajukan Nominal Baru</button>
                                        <button id="btn-batal" class="swal2-cancel swal2-styled">Batal</button>
                                    </div>
                                `,
                            showConfirmButton: false,
                            showCancelButton: false,
                            showDenyButton: false,
                            didOpen: () => {
                                // tombol ajukan
                                document.getElementById('btn-ajukan').addEventListener('click', () => {
                                    window.location.href = `/create-pinjaman/${id}/edit`;
                                });

                                // tombol tolak
                                document.getElementById('btn-tolak').addEventListener('click', () => {
                                    const ket_owner = document.getElementById('ket_owner')
                                    .value;
                                    if (!ket_owner) {
                                        Swal.showValidationMessage('Alasan wajib diisi');
                                        return;
                                    }
                                    fetch(`/pinjamanKR/${id}/decline`, {
                                            method: "POST",
                                            headers: {
                                                "Content-Type": "application/json",
                                                "X-CSRF-TOKEN": "{{ csrf_token() }}"
                                            },
                                            body: JSON.stringify({
                                                status_owner: "decline",
                                                ket_owner: ket_owner
                                            })
                                        })
                                        .then(res => res.json())
                                        .then(data => {
                                            Swal.fire('Ditolak!',
                                                'Pengajuan berhasil ditolak.', 'success'
                                                );
                                            location.reload();
                                        })
                                        .catch(err => {
                                            Swal.fire('Error', 'Terjadi kesalahan.',
                                                'error');
                                        });
                                });

                                // tombol batal
                                document.getElementById('btn-batal').addEventListener('click', () => {
                                    Swal.close();
                                });
                            }
                        });
                    });
                });
            </script>

            {{-- Tolak KasbonKaryawan --}}
            <script>
                document.querySelectorAll('.declineKasbon-btn').forEach(btn => {
                    btn.addEventListener('click', function(e) {
                        e.preventDefault();
                        const id = this.dataset.id; // ambil ID dari tombol

                        Swal.fire({
                            title: 'Tolak Pengajuan Kasbon',
                            html: `
                                    <textarea id="ket_owner" class="w-full border-gray-400 border-2 rounded-lg outline-none p-2" rows="6" placeholder="Tuliskan alasan penolakan..."></textarea>
                                    <div class="flex justify-center gap-4 mt-4 max-[600px]:gap-0 max-[600px]:flex-wrap">
                                        <button id="btn-tolak" class="swal2-confirm swal2-styled" style="background:#DD4049">Tolak</button>
                                        <button id="btn-ajukan" class="swal2-deny swal2-styled" style="background:#8CE987">Ajukan Nominal Baru</button>
                                        <button id="btn-batal" class="swal2-cancel swal2-styled">Batal</button>
                                    </div>
                                `,
                            showConfirmButton: false,
                            showCancelButton: false,
                            showDenyButton: false,
                            didOpen: () => {
                                // tombol ajukan
                                document.getElementById('btn-ajukan').addEventListener('click', () => {
                                    window.location.href = `/create-kasbon/${id}/edit`;
                                });

                                // tombol tolak
                                document.getElementById('btn-tolak').addEventListener('click', () => {
                                    const ket_owner = document.getElementById('ket_owner')
                                    .value;
                                    if (!ket_owner) {
                                        Swal.showValidationMessage('Alasan wajib diisi');
                                        return;
                                    }
                                    fetch(`/pinjamanKS/${id}/decline`, {
                                            method: "POST",
                                            headers: {
                                                "Content-Type": "application/json",
                                                "X-CSRF-TOKEN": "{{ csrf_token() }}"
                                            },
                                            body: JSON.stringify({
                                                status_owner: "decline",
                                                ket_owner: ket_owner
                                            })
                                        })
                                        .then(res => res.json())
                                        .then(data => {
                                            Swal.fire('Ditolak!',
                                                'Pengajuan berhasil ditolak.', 'success'
                                                );
                                            location.reload();
                                        })
                                        .catch(err => {
                                            Swal.fire('Error', 'Terjadi kesalahan.',
                                                'error');
                                        });
                                });

                                // tombol batal
                                document.getElementById('btn-batal').addEventListener('click', () => {
                                    Swal.close();
                                });
                            }
                        });
                    });
                });
            </script>

        </div>
    @endsection
