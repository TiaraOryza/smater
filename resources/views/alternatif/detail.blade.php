@include('layouts.header_admin')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-users"></i> Detail Data Member</h1>

    <div style="display: grid; grid-template-columns: auto auto auto; gap: 19px; align-items: center;">
        <a href="{{ url('Alternatif/edit') }}" class="btn btn-success" style="background-color: rgb(250, 121, 143);"> <i class="fa fa-edit"></i> Edit Data </a>
        <a href="{{ url('Alternatif/hapus') }}" class="btn btn-danger" style="background-color: rgb(255, 9, 50);"> <i class="fa fa-trash"></i> Hapus</a>

        <form id="import-form" action="{{ route('alternatif.import') }}" method="POST" enctype="multipart/form-data" style="display: none;">
            @csrf
            <input type="file" name="file" id="file-input" required style="display: none;">
            <button type="submit" style="display: none;"></button>
        </form>
    </div>
</div>

@if (session('message'))
    {!! session('message') !!}
@endif

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <tbody>
                    <tr align="center">
                        <td colspan="2" class="section-header"><b>INFORMASI PRIBADI</b></td>
                    </tr>
                    <tr>
                        <th scope="row" style="width: 200px;">NAMA</th>
                        <td>{{$listdet->nama}}</td>
                    </tr>
                    <tr>
                        <th scope="row">JENIS KELAMIN</th>
                        <td>{{$listdet->jenis_kelamin}}</td>
                    </tr>
                    <tr>
                        <th scope="row">UMUR</th>
                        <td>{{$listdet->umur}}</td>
                    </tr>
                    <tr>
                        <th scope="row">NO TELEPON</th>
                        <td>{{$listdet->telepon}}</td>
                    </tr>
                    <tr>
                        <th scope="row">EMAIL</th>
                        <td>{{$listdet->email}}</td>
                    </tr>
                    <tr>
                        <th scope="row">ALAMAT</th>
                        <td>{{$listdet->alamat}}</td>
                    </tr>
                    <tr align="center">
                        <td colspan="2" class="section-header"><b>INFORMASI KARTU</b></td>
                    </tr>
                    <tr>
                        <th scope="row">TANGGAL JOIN</th>
                        <td>{{$tanggalJoin->format('d-m-Y')}}</td>
                    </tr>
                    <tr>
                        <th scope="row">MASA BERLAKU</th>
                        <td>
                            {{ $masaBerlaku->format('d-m-Y') }}
                            @if($isExpired)
                                <span class="text-danger"> (Masa berlaku telah habis, silahkan perbarui kartu)</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">JUMLAH POIN</th>
                        <td>{{$listdet->poin}}</td>
                    </tr>
                    <tr align="center">
                        <td colspan="2" class="section-header"><b>E-KARTU</b></td>
                    </tr>
                    <tr align="center">
                        <td colspan="2">
                            <div id="cardMember" class="card-member">
                                <div class="e-kartu-header">E-KARTU MEMBER</div>
                                <div class="info"><b>Nama:</b> {{$listdet->nama}}</div>
                                <div class="info"><b>Jenis Kelamin:</b> {{$listdet->jenis_kelamin}}</div>
                                <div class="info"><b>No Telepon:</b> {{$listdet->telepon}}</div>
                                <div class="info"><b>Masa Berlaku:</b> {{$masaBerlaku->format('d-m-Y')}}</div>
                                @if($isExpired)
                                    <div class="info text-danger">(Masa berlaku telah habis)</div>
                                @endif
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                            <button id="downloadBtn" class="btn btn-primary">Download</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

@include('layouts.footer_admin')

<style>
    .card-member {
        width: 430px; /* Approx card size (85.60mm width) */
        height: 235px; /* Approx card size (53.98mm height) */
        border: 2px solid #d1d1d1;
        border-radius: 15px;
        padding: 20px;
        font-family: 'Montserrat', sans-serif;
        background-image: linear-gradient(135deg, #f5f5f5, #fff);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
        position: relative;
        overflow: hidden;
        display: flex;
        flex-direction: column; /* Flexbox untuk layout yang lebih baik */
    }

    .card-member .info {
        font-size: 16px; /* Ukuran font lebih besar untuk tampilan lebih baik */
        color: #333;
        font-weight: 500;
        margin-bottom: 8px;
        text-align: left; /* Rata kiri untuk informasi */
        margin-left: 20px;
    }

    .card-member .e-kartu-header {
        background-color: rgba(239, 58, 133, 0.9);
        color: #fff;
        padding: 10px;
        font-weight: bold;
        font-size: 20px; /* Ukuran font lebih besar */
        margin-bottom: 12px;
        border-radius: 10px;
        text-align: center; /* Rata tengah untuk header */
    }

    /* Optional design details */
    .card-member:before {
        content: '';
        position: absolute;
        top: -50px;
        left: -50px;
        width: 130px;
        height: 150px;
        background-color: rgba(239, 58, 133, 0.3);
        border-radius: 50%;
    }

    .card-member:after {
        content: '';
        position: absolute;
        bottom: -50px;
        right: -50px;
        width: 150px;
        height: 150px;
        background-color: rgba(239, 58, 133, 0.3);
        border-radius: 50%;
    }
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Trigger the download process on click
    document.getElementById('downloadBtn').addEventListener('click', function() {
        const cardElement = document.getElementById('cardMember');

        if (cardElement) {
            html2canvas(cardElement).then(function(canvas) {
                const imageData = canvas.toDataURL('image/png');
                const link = document.createElement('a');
                link.href = imageData;
                link.download = 'ekartu_member.png';

                // Append the link, trigger click, then remove link
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            }).catch(function(error) {
                console.error('Error capturing card: ', error);
            });
        } else {
            console.error('Element #cardMember not found!');
        }
    });
});

</script>
