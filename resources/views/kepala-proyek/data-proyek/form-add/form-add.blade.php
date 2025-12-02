@extends('kepala-proyek.layout')
@section('content')
    <div>
        <h1 class="font-bold text-2xl mb-4">Form Input Data Proyek</h1>
        <div class="w-full p-8 shadow-[1px_1px_10px_rgba(0,0,0,0.1)] rounded-lg">
            <form action="" method="post" class="flex flex-col w-full gap-y-5">
                <div class="flex items-center gap-x-5">
                    <label for="" class="w-[200px]">Nama Paket</label>
                    <input type="text" name="" id="" class="bg-[#D9D9D9]/40 w-full py-2 px-5 rounded-lg outline-none" />
                </div>
                <div class="flex items-center gap-x-5">
                    <label for="" class="w-[200px]">Perusahaan</label>
                    <select name="" class="bg-[#D9D9D9]/40 w-full py-2 px-5 rounded-lg outline-none appearance-none cursor-pointer">
                        <option selected disabled>-Pilih Perusahaan-</option>
                        <option value="">perusahaan 1</option>
                        <option value="">perusahaan 2</option>
                        <option value="">perusahaan 3</option>
                    </select>
                </div>
                <div class="flex items-center gap-x-5">
                    <label for="" class="w-[200px]">Pengawas</label>
                    <select name="" class="bg-[#D9D9D9]/40 w-full py-2 px-5 rounded-lg outline-none appearance-none cursor-pointer">
                        <option selected disabled>-Pilih Pengawas-</option>
                        <option value="">perusahaan 1</option>
                        <option value="">perusahaan 2</option>
                        <option value="">perusahaan 3</option>
                    </select>
                </div>
                 <div class="flex items-center gap-x-5">
                    <label for="" class="w-[200px]">No Hp</label>
                    <input type="number" name="" id="" class="bg-[#D9D9D9]/40 w-full py-2 px-5 rounded-lg outline-none" />
                </div>
                 <div class="flex items-center gap-x-5">
                    <label for="" class="w-[200px]">MC 0</label>
                    <input type="date" name="" id="" class="bg-[#D9D9D9]/40 w-full py-2 px-5 rounded-lg outline-none" />
                </div>
                <div class="flex items-center gap-x-5">
                    <label for="" class="w-[200px]">Korlap</label>
                    <input type="text" name="" id="" class="bg-[#D9D9D9]/40 w-full py-2 px-5 rounded-lg outline-none" />
                </div>
                <div class="flex items-center gap-x-5">
                    <label for="" class="w-[200px]">Kontraktor</label>
                    <input type="text" name="" id="" class="bg-[#D9D9D9]/40 w-full py-2 px-5 rounded-lg outline-none" />
                </div>
                <div class="flex items-center gap-x-5">
                    <div class="w-[200px]"></div>
                    <span class="font-bold text-left text-lg w-full">Progress</span>
                </div>
                <div class="flex items-center gap-x-5">
                    <label for="" class="w-[200px]">Minggu</label>
                    <input type="number" name="" id="" class="bg-[#D9D9D9]/40 w-full py-2 px-5 rounded-lg outline-none" />
                </div>
                <div class="flex items-center gap-x-5">
                    <label for="" class="w-[200px]">Persentase</label>
                    <div class="flex w-full items-center">
                        <input type="number" name="" id="" class="bg-[#D9D9D9]/40 w-[95%] py-2 px-5 rounded-lg outline-none" />
                        <div class="px-2 text-xl">%</div>
                    </div>
                </div>
                <div class="flex items-center gap-x-5">
                    <label for="" class="w-[200px]">Tgl PHO</label>
                    <input type="date" name="" id="" class="bg-[#D9D9D9]/40 w-full py-2 px-5 rounded-lg outline-none" />
                </div>
                <div class="flex items-center gap-x-5">
                    <label for="" class="w-[200px]">Tgl Kontraktor Ambil</label>
                    <input type="date" name="" id="" class="bg-[#D9D9D9]/40 w-full py-2 px-5 rounded-lg outline-none" />
                </div>
                <div class="flex items-center gap-x-5">
                    <label for="" class="w-[200px]">Kendala</label>
                    <input type="text" name="" id="" class="bg-[#D9D9D9]/40 w-full py-2 px-5 rounded-lg outline-none" />
                </div>
                 <div class="flex items-center gap-x-5">
                    <div class="w-[200px]"></div>
                    <div class="w-full flex flex-wrap gap-8">
                        <div class="flex items-center gap-x-3">
                            <label for="" class="text-sm">PHO</label>
                            <input type="checkbox" name="" id="" class="w-[35px] h-[35px] bg-[#D9D9D9]/40 rounded-lg outline-none cursor-pointer focus:bg-[#D9D9D9]/40" />
                        </div>
                        <div class="flex items-center gap-x-3">
                            <label for="" class="flex flex-col text-sm">
                                <span>Progress Kontraktor</span>
                                <span>(Sudah di serahkan ke admin)</span>
                            </label>
                            <input type="checkbox" name="" id="" class="w-[35px] h-[35px] bg-[#D9D9D9]/40 rounded-lg outline-none cursor-pointer focus:bg-[#D9D9D9]/40" />
                        </div>
                        <div class="flex items-center gap-x-3">
                            <label for="" class="flex flex-col text-sm">
                                <span>Progress Kontraktor</span>
                                <span>(Sudah di ambil kontraktor)</span>
                            </label>
                            <input type="checkbox" name="" id="" class="w-[35px] h-[35px] bg-[#D9D9D9]/40 rounded-lg outline-none cursor-pointer focus:bg-[#D9D9D9]/40" />
                        </div>
                        <div class="flex items-center gap-x-3">
                            <label for="" class="flex flex-col text-sm">
                                <span>RAR Dokumen Konsultan</span>
                                <span>(Sudah di ambil kontraktor)</span>
                            </label>
                            <input type="checkbox" name="" id="" class="w-[35px] h-[35px] bg-[#D9D9D9]/40 rounded-lg outline-none cursor-pointer focus:bg-[#D9D9D9]/40" />
                        </div>
                        <div class="flex items-center gap-x-3">
                            <label for="" class="flex flex-col text-sm">
                                <span>Progress Pengawas </span>
                                <span>(Sudah di serahkan ke admin)</span>
                            </label>
                            <input type="checkbox" name="" id="" class="w-[35px] h-[35px] bg-[#D9D9D9]/40 rounded-lg outline-none cursor-pointer focus:bg-[#D9D9D9]/40" />
                        </div>
                    </div>
                </div>
                <div class="flex items-center gap-x-5 mt-8">
                    <div class="w-[200px]"></div>
                    <div class="w-full">
                        <div class="flex items-center gap-x-4">
                            <button type="submit" class="bg-white border border-[#3E98D0] py-1 px-3 rounded-lg flex items-center justify-center cursor-pointer text-[#3E98D0]">
                                <span>Simpan Data</span>
                                <img src="{{ asset('assets/plus-circle-blue.png') }}" alt="plus circle blue icon" class="inline-block ml-2" />
                            </button>
                            <button type="submit" class="bg-white border border-[#DD4049] py-2 px-3 rounded-lg flex items-center justify-center cursor-pointer text-[#DD4049]">
                                <span>Batal</span>
                                <img src="{{ asset('assets/close-circle-red.png') }}" alt="close circle red icon" class="inline-block ml-2" />
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <script>
            const addInputBtn = document.getElementById('add-input');
            const addInputSection = document.querySelector('.add-input-section');

            addInputBtn.addEventListener('click', function(e) {
                e.preventDefault();

                const newInput = document.createElement('div');
                newInput.classList.add('flex', 'items-center', 'gap-x-5', 'add-input-section');
                // kalo mau setting di sini.
                newInput.innerHTML = `
                    <label for="" class="w-[200px]">Minggu</label>
                    <div class="w-full flex items-center justify-between">
                        <input type="text" name="" id="" class="bg-[#D9D9D9]/40 w-[40%] py-2 px-5 rounded-lg outline-none" />
                        <div class="flex items-center w-[50%]">
                            <label for="" class="w-[150px]">Persentase</label>
                            <input type="number" name="" id="" class="bg-[#D9D9D9]/40 w-full py-2 px-5 rounded-lg outline-none" />
                            <div class="px-2">%</div>
                        </div>
                    </div>
                `;

                addInputSection.parentNode.insertBefore(newInput, addInputSection.nextSibling);
            });
        </script>
    </div>
@endsection