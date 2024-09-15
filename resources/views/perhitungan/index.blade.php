@include('layouts.header_admin')
<?php
\App\Models\PerhitunganModel::hapus_hasil();

//Matrix Keputusan
$matriks_n = array();
foreach($alternatifs as $alternatif):
    foreach($kriterias as $kriteria):

        $id_alternatif = $alternatif->id_alternatif;
        $id_kriteria = $kriteria->id_kriteria;

        $data_pencocokan = \App\Models\PerhitunganModel::data_nilai($id_alternatif, $id_kriteria);
        if(!empty($data_pencocokan['deskripsi'])){$nilai = $data_pencocokan['deskripsi'];}else{$nilai = 0;}

        $matriks_n[$id_kriteria][$id_alternatif] = $nilai;
    endforeach;
endforeach;

//Normmalisasi Keputusan (X)
$matriks_x = array();
foreach($alternatifs as $alternatif):
    foreach($kriterias as $kriteria):

        $id_alternatif = $alternatif->id_alternatif;
        $id_kriteria = $kriteria->id_kriteria;

        $data_pencocokan = \App\Models\PerhitunganModel::data_nilai($id_alternatif, $id_kriteria);
        if(!empty($data_pencocokan['nilai'])){$nilai = $data_pencocokan['nilai'];}else{$nilai = 0;}

        $matriks_x[$id_kriteria][$id_alternatif] = $nilai;
    endforeach;
endforeach;

$total_bobot = 0;
foreach($kriterias as $kriteria){
	$total_bobot += $kriteria->bobot;
}

//nilai utility 
$nilai_u = array();
$total_nilai = array();
foreach($alternatifs as $alternatif):

	$nilai_total = 0;
	$id_alternatif = $alternatif->id_alternatif;
    foreach($kriterias as $kriteria):

        $id_kriteria = $kriteria->id_kriteria;
        $bobot = $kriteria->bobot;

        $x = $matriks_x[$id_kriteria][$id_alternatif];
		$min = min($matriks_x[$id_kriteria]);
		$max = max($matriks_x[$id_kriteria]);

		$u = (100/100)*(($x-$min)/($max-$min));
		$nilai_u[$id_kriteria][$id_alternatif] = $u;
		$nilai_total += $bobot*$u;
    endforeach;
	$total_nilai[$id_alternatif] = $nilai_total;
endforeach;

?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-calculator"></i> Data Perhitungan Metode</h1>
</div>


<div class="card shadow mb-4">
    <!-- /.card-header -->

    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Penilaian Matrix Keputusan [X]</h6>
    </div>

    {{-- batas --}}
    <div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" width="100%" cellspacing="0">
				<thead class="bg-success text-white">
					<tr align="center">
						<th width="5%" rowspan="2">No</th>
						<th>Nama Alternatif</th>
						<?php foreach ($kriterias as $kriteria): ?>
							<th><?= $kriteria->kode_kriteria ?></th>
						<?php endforeach ?>
					</tr>
				</thead>
				<tbody>
					<?php
						$no=1;
						foreach ($alternatifs as $alternatif): ?>
					<tr align="center">
						<td><?= $no; ?></td>
						<td align="left"><?= $alternatif->nama ?></td>
						<?php
						foreach ($kriterias as $kriteria):
							$id_alternatif = $alternatif->id_alternatif;
							$id_kriteria = $kriteria->id_kriteria;
							echo '<td>';
							echo $matriks_n[$id_kriteria][$id_alternatif];
							echo '</td>';
						endforeach
						?>
					</tr>
					<?php
						$no++;
						endforeach
					?>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
    {{-- batas bawah dari tabel matrix keputusan yes meong meong--}}

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Normalisasi Matrix Keputusan [X]</h6>
    </div>

    <div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" width="100%" cellspacing="0">
				<thead class="bg-success text-white">
					<tr align="center">
						<th width="5%" rowspan="2">No</th>
						<th>Nama Alternatif</th>
						<?php foreach ($kriterias as $kriteria): ?>
							<th><?= $kriteria->kode_kriteria ?></th>
						<?php endforeach ?>
					</tr>
				</thead>
				<tbody>
					<?php
						$no=1;
						foreach ($alternatifs as $alternatif): ?>
					<tr align="center">
						<td><?= $no; ?></td>
						<td align="left"><?= $alternatif->nama ?></td>
						<?php
						foreach ($kriterias as $kriteria):
							$id_alternatif = $alternatif->id_alternatif;
							$id_kriteria = $kriteria->id_kriteria;
							echo '<td>';
							echo $matriks_x[$id_kriteria][$id_alternatif];
							echo '</td>';
						endforeach
						?>
					</tr>
					<?php
						$no++;
						endforeach
					?>
					<tr align="center" class="bg-light">
						<th colspan="2">Max</th>
						<?php foreach ($kriterias as $kriteria): ?>
						<th>
						<?php
							$id_kriteria = $kriteria->id_kriteria;
							echo max($matriks_x[$id_kriteria]);
						?>
						</th>
						<?php endforeach ?>
					</tr>
					<tr align="center" class="bg-light">
						<th colspan="2">Min</th>
						<?php foreach ($kriterias as $kriteria): ?>
						<th>
						<?php
							$id_kriteria = $kriteria->id_kriteria;
							echo min($matriks_x[$id_kriteria]);
						?>
						</th>
						<?php endforeach ?>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Bobot Kriteria (W)</h6>
    </div>

    <div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" width="100%" cellspacing="0">
				<thead class="bg-success text-white">
					<tr align="center">
						<?php foreach ($kriterias as $kriteria): ?>
						<th><?= $kriteria->kode_kriteria ?></th>
						<?php endforeach ?>
					</tr>
				</thead>
				<tbody>
					<tr align="center">
						<?php foreach ($kriterias as $kriteria): ?>
						<td>
						<?php
						echo $kriteria->bobot;
						?>
						</td>
						<?php endforeach ?>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Nilai Utility (U)</h6>
    </div>

    <div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" width="100%" cellspacing="0">
				<thead class="bg-success text-white">
					<tr align="center">
						<th width="5%" rowspan="2">No</th>
						<th>Nama Alternatif</th>
						<?php foreach ($kriterias as $kriteria): ?>
							<th><?= $kriteria->kode_kriteria ?></th>
						<?php endforeach ?>
					</tr>
				</thead>
				<tbody>
					<?php
						$no=1;
						foreach ($alternatifs as $alternatif): ?>
					<tr align="center">
						<td><?= $no; ?></td>
						<td align="left"><?= $alternatif->nama ?></td>
						<?php
						foreach ($kriterias as $kriteria):
							$id_alternatif = $alternatif->id_alternatif;
							$id_kriteria = $kriteria->id_kriteria;
							echo '<td>';
							echo $nilai_u[$id_kriteria][$id_alternatif];
							echo '</td>';
						endforeach
						?>
					</tr>
					<?php
						$no++;
						endforeach
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>


<div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Perhitungan Nilai Akhir</h6>
    </div>

    <div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" width="100%" cellspacing="0">
				<thead class="bg-success text-white">
					<tr align="center">
						<th width="5%" rowspan="2">No</th>
						<th>Nama Alternatif</th>
						<th>Perhitungan</th>
						<th>Total Nilai</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$no=1;
						foreach ($alternatifs as $alternatif):
						$id_alternatif = $alternatif->id_alternatif;
						?>
					<tr align="center">
						<td><?= $no; ?></td>
						<td align="left"><?= $alternatif->nama ?></td>
						<td>SUM
						<?php
						foreach ($kriterias as $kriteria):
							$id_kriteria = $kriteria->id_kriteria;
							$bobot_normalisasi = $kriteria->bobot/$total_bobot;
							echo "(".$nilai_u[$id_kriteria][$id_alternatif]."x".$bobot_normalisasi.")";
						endforeach
						?>
						</td>
						<td><?= $total_nilai[$id_alternatif]; ?></td>
					</tr>
					<?php
						$no++;
						$hasil_akhir = [
							'id_alternatif' => $id_alternatif,
							'nilai' => $total_nilai[$id_alternatif],
						];

						DB::table('hasil')->insert($hasil_akhir);
					endforeach;
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>

@include('layouts.footer_admin')
