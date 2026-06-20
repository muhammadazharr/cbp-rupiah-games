@extends('Dashboard.layout.app')
@section('content')
    <div class="card info-card sales-card">

        <div class="card-body">
            <h5 class="card-title">Data Pemain</h5>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-1"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover datatable">
                    <thead>
                        <tr>
                            <th class="text-center">No.</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">No. Telp</th>
                            <th class="text-center">Gender</th>
                            <th class="text-center">Tanggal Main</th>
                            <th class="text-center">Opsi</th>
                        </tr>
                    </thead>
                    <tbody class="">
                        @foreach ($pemain as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $item->name }}</td>
                                <td class="text-center">{{ $item->phone }}</td>
                                <td class="text-center">
                                    @if ($item->gender == 1)
                                        <span class="badge" style="background-color: #1a69e8">Pria</span>
                                    @else
                                        <span class="badge" style="background-color: #e81ac6">Wanita</span>
                                    @endif
                                </td>
                                @php
                                
                                switch ($item->created_at->format('l')) {
                                    case 'Monday':
                                        $hari = 'Senin';
                                        break;
                                    case 'Tuesday':
                                        $hari = 'Selasa';
                                        break;
                                    case 'Wednesday':
                                        $hari = 'Rabu';
                                        break;
                                    case 'Thursday':
                                        $hari = 'Kamis';
                                        break;
                                    case 'Friday':
                                        $hari = 'Jumat';
                                        break;
                                    case 'Saturday':
                                        $hari = 'Sabtu';
                                        break;
                                    case 'Sunday':
                                        $hari = 'Minggu';
                                        break;
                                    default:
                                        $hari = 'Hari Tidak Diketahui'; // Opsional, untuk menangani nilai yang tidak valid
                                        break;
                                }
                                
                                @endphp
                                <td class="text-center">{{$hari . $item->created_at->format(', d-m-Y') }}</td>
                                <td class="d-flex gap-2 justify-content-center\">
                                    <a href="{{ route('pemain.show', $item->id) }}"
                                    class="btn btn-sm btn-primary">
                                    <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('pemain.edit', $item->id) }}" class="btn btn-sm btn-warning text-white">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('pemain.destroy', $item->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div
        </div>

    </div>
@endsection
