@extends('owner.layout')
@section('content')
    <div>
        <div class="flex items-center justify-between mb-5">
            <h1 class="font-bold text-2xl uppercase">user management</h1>
            <button class="flex items-center gap-2 border-[#45D03E] border px-4 py-1 rounded-lg cursor-pointer"
                onclick="tambahUser()">
                <span class="text-[#45D03E]">Tambah Data</span>
                <img src="{{ asset('assets/plus-circle-green.png') }}" alt="add icon">
            </button>
        </div>
        <section>
            <div class="rounded-lg shadow-[1px_1px_10px_rgba(0,0,0,0.1)] pt-4 pb-6 max-[1200px]:overflow-x-auto">
                <table class="table-auto text-center text-sm w-full max-[1200px]:w-[1200px]">
                    <thead class="border-b-2 border-[#CCCCCC]">
                        <tr>
                            <th class="py-2 w-[20%]">Username</th>
                            <th class="py-2 w-[15%]">Role</th>
                            <th class="py-2 w-[20%]">Nama</th>
                            <th class="py-2 w-[20%]">Email</th>
                            <th class="py-2 w-[20%]">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="bg-white border-b-[1px] border-[#CCCCCC]">
                                <td class="py-2">{{ $user->username }}</td>
                                <td class="py-2">{{ $user->role }}</td>
                                <td class="py-2">{{ $user->name }}</td>
                                <td class="py-2">{{ $user->email }}</td>
                                <td class="py-2">
                                    <div class="flex items-center justify-center gap-x-2">
                                        {{-- Tombol Edit --}}
                                        <a href="javascript:void(0)"
                                            onclick="editUser('{{ $user->id }}', '{{ $user->username }}', '{{ $user->name }}', '{{ $user->role }}', '{{ $user->email }}')"
                                            class="btn btn-sm btn-primary">
                                            <img src="{{ asset('assets/more-circle.png') }}" alt="edit icon"
                                                class="w-[22px] cursor-pointer">
                                        </a>
                                        <span class="border-black border-l-[1px] h-[22px]"></span>
                                        {{-- Tombol Delete --}}
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                            class="h-[22px]">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Yakin hapus data ini?')">
                                                <img src="{{ asset('assets/close-circle.png') }}" alt="delete icon"
                                                    class="w-[22px] cursor-pointer">
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
        <script>
            function tambahUser() {
                Swal.fire({
                    html: `
                        <form action="{{ route('users.store') }}" method="POST">
                            @csrf
                            <h1 class="font-bold text-2xl text-start mb-10">Input User Management</h1>
                            <section class="flex flex-col gap-y-4">
                                <div class="flex items-center">
                                    <label class="w-[180px] font-medium text-start">Username</label>
                                    <input type="text" name="username" class="w-full outline-none bg-[#E9E9E9] rounded-lg px-4 py-2" placeholder="Username">
                                </div>
                                <div class="flex items-center">
                                    <label class="w-[180px] font-medium text-start">Password</label>
                                    <input type="text" name="password" class="w-full outline-none bg-[#E9E9E9] rounded-lg px-4 py-2" placeholder="Password">
                                </div>
                                <div class="flex items-center">
                                    <label class="w-[180px] font-medium text-start">Nama</label>
                                    <input type="text" name="name" class="w-full outline-none bg-[#E9E9E9] rounded-lg px-4 py-2" placeholder="Nama">
                                </div>
                                <div class="flex items-center">
                                    <label class="w-[180px] font-medium text-start">Role</label>
                                    <select name="role" id="" class="w-full outline-none bg-[#E9E9E9] rounded-lg px-4 py-2 appearance-none cursor-pointer">
                                        <option disabled selected>-Pilih Role-</option>
                                        <option value="Admin 1"> Admin 1 (ex. Novi) </option>
                                        <option value="Admin 2"> Admin 2 (ex. Siska)</option>
                                        <option value="Supervisor">Supervisor</option>
                                        <option value="Kepala Proyek">Kepala Proyek</option>
                                    </select>
                                </div>
                                <div class="flex items-center">
                                    <label class="w-[180px] font-medium text-start">Email</label>
                                    <input type="text" name="email" class="w-full outline-none bg-[#E9E9E9] rounded-lg px-4 py-2" placeholder="Email">
                                </div>
                                <div class="flex items-center">
                                    <label class="w-[130px]"></label>
                                    <button type="submit" class="border border-[#3E98D0] px-6 py-1 rounded-lg cursor-pointer flex items-center gap-x-2 mr-2">
                                     <span class="text-[#3E98D0]">Simpan</span>
                                     <img src="{{ asset('assets/plus-circle-blue.png') }}" alt="arrow right blue icon" class="w-[30px] mt-1">
                                    </button>
                                    <button type="button" onclick="Swal.close()" class="border border-[#DD4049] px-6 py-2 rounded-lg cursor-pointer flex items-center gap-x-2">
                                     <span class="text-[#DD4049]">Batal</span>
                                     <img src="{{ asset('assets/close-circle-red.png') }}" alt="arrow right blue icon" class="w-[22px] mt-1">
                                    </button>
                                </div>
                            </section>
                        </form>
                    `,
                    width: 600,
                    showCancelButton: false,
                    showConfirmButton: false,
                    showCloseButton: true,
                });
            }
        </script>

        <script>
            function editUser(id, username, name, role, email) {
                Swal.fire({
                    html: `
            <form action="/users/${id}" method="POST">
                @csrf
                @method('PUT')
                <h1 class="font-bold text-2xl text-start mb-10">Edit User Management</h1>
                <section class="flex flex-col gap-y-4">
                    <div class="flex items-center">
                        <label class="w-[180px] font-medium text-start">Username</label>
                        <input type="text" name="username" value="${username}"
                            class="w-full outline-none bg-[#E9E9E9] rounded-lg px-4 py-2" required>
                    </div>
                    <div class="flex items-center">
                        <label class="w-[180px] font-medium text-start">Password</label>
                        <input type="password" name="password"
                            class="w-full outline-none bg-[#E9E9E9] rounded-lg px-4 py-2"
                            placeholder="Kosongkan jika tidak diubah">
                    </div>
                    <div class="flex items-center">
                        <label class="w-[180px] font-medium text-start">Nama</label>
                        <input type="text" name="name" value="${name}"
                            class="w-full outline-none bg-[#E9E9E9] rounded-lg px-4 py-2" required>
                    </div>
                    <div class="flex items-center">
                        <label class="w-[180px] font-medium text-start">Role</label>
                        <select name="role" class="w-full outline-none bg-[#E9E9E9] rounded-lg px-4 py-2 appearance-none cursor-pointer" required>
                            <option disabled>-Pilih Role-</option>
                            <option value="Admin 1" ${role === 'Admin 1' ? 'selected' : ''}>Admin 1</option>
                            <option value="Admin 2" ${role === 'Admin 2' ? 'selected' : ''}>Admin 2</option>
                            <option value="Supervisor" ${role === 'Supervisor' ? 'selected' : ''}>Supervisor</option>
                            <option value="Kepala Proyek" ${role === 'Kepala Proyek' ? 'selected' : ''}>Kepala Proyek</option>
                        </select>
                    </div>
                    <div class="flex items-center">
                        <label class="w-[180px] font-medium text-start">Email</label>
                        <input type="email" name="email" value="${email}"
                            class="w-full outline-none bg-[#E9E9E9] rounded-lg px-4 py-2">
                    </div>
                    <div class="flex items-center">
                        <label class="w-[130px]"></label>
                        <button type="submit" class="border border-[#3E98D0] px-6 py-1 rounded-lg cursor-pointer flex items-center gap-x-2 mr-2">
                            <span class="text-[#3E98D0]">Update</span>
                            <img src="{{ asset('assets/more-circle.png') }}" alt="edit icon" class="w-[22px] mt-1">
                        </button>
                        <button type="button" onclick="Swal.close()" class="border border-[#DD4049] px-6 py-2 rounded-lg cursor-pointer flex items-center gap-x-2">
                            <span class="text-[#DD4049]">Batal</span>
                            <img src="{{ asset('assets/close-circle-red.png') }}" alt="close icon" class="w-[22px] mt-1">
                        </button>
                    </div>
                </section>
            </form>
        `,
                    width: 600,
                    showCancelButton: false,
                    showConfirmButton: false,
                    showCloseButton: true,
                });
            }
        </script>

    </div>
@endsection
