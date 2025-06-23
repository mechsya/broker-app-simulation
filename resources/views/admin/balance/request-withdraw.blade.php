@extends('_layout.main')

@section('content')
    @include('components.page-indicator', [
        'page' => 'Permintaan Penarikan',
        'path' => ['Beranda', 'Permintaan Penarikan'],
    ])

    <section class="w-full overflow-hidden rounded-lg text-white/80">
        <div class="w-full mt-6 rounded-lg overflow-hidden bg-black">
            <div class="p-6 text-white/70 border-b border-white/25">
                <p>Permintaan Penarikan</p>
            </div>

            <div class="p-4 lg:p-6 overflow-x-scroll">

                <div class="w-[900px] lg:w-auto">
                    <table id="container-table" class="w-full table-border">
                        <thead>
                            <tr class="table-border">
                                <td class="table-border">Tanggal</td>
                                <td class="table-border">Jumlah</td>
                                <td class="table-border">Penarikan ke</td>
                                <td class="table-border">Nama</td>
                                <td class="table-border">No Rekening</td>
                                <td class="table-border">Catatan</td>
                                <td class="table-border">Status</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($withdraws as $withdraw)
                                <tr class="table-border">
                                    <td class="table-border">{{ $withdraw->created_at }}</td>
                                    <td class="table-border">@money($withdraw->amount)</td>
                                    <td class="table-border">{{ $withdraw->bank->bank }}</td>
                                    <td class="table-border">{{ $withdraw->bank->name }}</td>
                                    <td class="table-border">{{ $withdraw->bank->noRekening }}</td>
                                    <td class="table-border">{{ $withdraw->note }}</td>
                                    <td class="table-border">
                                        <button
                                            class="{{ $withdraw->status == 'success' ? 'bg-green' : 'bg-red-500' }} first-letter:uppercase px-2 py-1 rounded">{{ $withdraw->status }}</button>
                                    </td>
                                    <td class="table-border">
                                        <div class="flex justify-evenly">
                                            <button onclick="approveHandle(event)" data-id="{{ $withdraw->id }}"
                                                class="bg-green font-semibold h-10 w-10 rounded flex justify-center items-center">
                                                <i class="fa-solid fa-circle-check text-lg text-white"></i>
                                            </button>

                                            <button onclick="rejectHandle(event)" data-id="{{ $withdraw->id }}"
                                                class="font-semibold h-10 rounded w-10 bg-red-500 flex justify-center items-center">
                                                <i class="fa-solid fa-x"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <script>
        function approveHandle(event) {
            event.preventDefault();

            const button = event.currentTarget;
            const id = button.dataset.id;

            Swal.fire({
                title: 'Berikan Alasan Penerimaan',
                html: `
        <form id="reject-form" class="flex flex-col gap-4 justify-center" method="POST"
            action="withdrawals/${id}/update/success">
            @csrf
            @method('PUT')
            <textarea name="reason_reject" rows="4" placeholder="Tulis alasan Penerimaan..." class="w-full border rounded p-2"></textarea>
            <button type="submit" class="font-semibold rounded py-2 px-4 text-white" style="background-color:green;">
                Terima Permintaan
            </button>
        </form>
    `,
                showConfirmButton: false,
            });
        }

        function rejectHandle(event) {
            event.preventDefault();

            const button = event.currentTarget;
            const id = button.dataset.id;

            Swal.fire({
                title: 'Berikan Alasan Penolakan',
                html: `
        <form id="reject-form" class="flex flex-col gap-4 justify-center" method="POST"
            action="withdrawals/${id}/update/reject">
            @csrf
            @method('PUT')
            <textarea name="reason_reject" rows="4" placeholder="Tulis alasan penolakan..." class="w-full border rounded p-2"></textarea>
            <button type="submit" class="font-semibold rounded py-2 px-4 text-white bg-red-500">
                Tolak Permintaan
            </button>
        </form>
    `,
                showConfirmButton: false,
            });
        }
    </script>
@endsection
