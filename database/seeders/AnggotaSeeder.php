<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Anggota;

class AnggotaSeeder extends Seeder
{
    public function run()
    {
        $anggotas = [
            [
                'kode_wilayah' => 'GR',
                'nama_anggota' => 'ABI DADANG',
                'tempat_lahir' => 'BOGOR',
                'tanggal_lahir' => '1975-03-12',
                'alamat' => 'JL. Musalah',
                'kelurahan' => 'PENGASINAN',
                'kecamatan' => 'PENGASINAN',
                'kabupaten_kota' => 'DEPOK',
                'provinsi' => 'JAWA BARAT',
                'ranting' => 'PENGASINAN',
                'status' => 'GURU RANTING',
                'no_telpon' => '81295290941'
            ],
            [
                'kode_wilayah' => 'CISEENG',
                'nama_anggota' => 'ABDUL MAJID',
                'tempat_lahir' => 'TEGAL',
                'tanggal_lahir' => '1987-04-01',
                'alamat' => 'Bojongasari Sawangan Depok',
                'kelurahan' => 'BOJONG SARI',
                'kecamatan' => 'SAWANGAN',
                'kabupaten_kota' => 'DEPOK',
                'provinsi' => 'JAWA BARAT',
                'ranting' => 'PENGASINAN',
                'status' => 'ANGGOTA AKTIF',
                'no_telpon' => '85966349579'
            ],
            [
                'kode_wilayah' => 'OTISTA',
                'nama_anggota' => 'ALDIY ACHMAD',
                'tempat_lahir' => 'JAKARTA',
                'tanggal_lahir' => '2001-11-30',
                'alamat' => 'GG.pertama,RT004/002,No15',
                'kelurahan' => 'BIDARA CINA',
                'kecamatan' => 'JATINEGARA',
                'kabupaten_kota' => 'JAKARTA TIMUR',
                'provinsi' => 'DKI JAKARTA',
                'ranting' => 'PENGASINAN',
                'status' => 'ANGGOTA AKTIF',
                'no_telpon' => '85716271838'
            ],
            [
                'kode_wilayah' => 'CISEENG',
                'nama_anggota' => 'DEGOL SULEMAN',
                'tempat_lahir' => 'BOGOR',
                'tanggal_lahir' => '1986-05-16',
                'alamat' => 'Kape Kemang RT003/07',
                'kelurahan' => 'CIBINONG',
                'kecamatan' => 'GUNUNG SINDUR',
                'kabupaten_kota' => 'BOGOR',
                'provinsi' => 'JAWA BARAT',
                'ranting' => 'PENGASINAN',
                'status' => 'ANGGOTA AKTIF',
                'no_telpon' => '81212965474'
            ],
            [
                'kode_wilayah' => 'OTISTA',
                'nama_anggota' => 'DENIS AL-FIKRI',
                'tempat_lahir' => 'JAKARTA',
                'tanggal_lahir' => '2002-12-07',
                'alamat' => 'Bidara Cina, OTISTA, No 18',
                'kelurahan' => 'BIDARA CINA',
                'kecamatan' => 'JATINEGARA',
                'kabupaten_kota' => 'JAKARTA TIMUR',
                'provinsi' => 'DKI JAKARTA',
                'ranting' => 'PENGASINAN',
                'status' => 'ANGGOTA AKTIF',
                'no_telpon' => '83844855938'
            ],
            [
                'kode_wilayah' => 'PONDOK LABU',
                'nama_anggota' => 'DIMAS MUHAMMAD FAJAR',
                'tempat_lahir' => 'JAKARTA',
                'tanggal_lahir' => '1998-02-23',
                'alamat' => 'JL.Cemara',
                'kelurahan' => 'GROGOL',
                'kecamatan' => 'LIMPO',
                'kabupaten_kota' => 'DEPOK',
                'provinsi' => 'JAWA BARAT',
                'ranting' => 'PENGASINAN',
                'status' => 'ANGGOTA AKTIF',
                'no_telpon' => '83673698157'
            ],
            [
                'kode_wilayah' => 'CISEENG',
                'nama_anggota' => 'ENJANG JAMALUDIN',
                'tempat_lahir' => 'JAKARTA',
                'tanggal_lahir' => '1982-07-01',
                'alamat' => 'JL. Intan 1G.Hij Irom, RT003/002',
                'kelurahan' => 'CIDOOKOM',
                'kecamatan' => 'GUNUNG SINDUR',
                'kabupaten_kota' => 'BOGOR',
                'provinsi' => 'JAWA BARAT',
                'ranting' => 'PENGASINAN',
                'status' => 'ANGGOTA AKTIF',
                'no_telpon' => '81386043275'
            ],
            [
                'kode_wilayah' => 'CISEENG',
                'nama_anggota' => 'GURUH AMSORI PUTRA',
                'tempat_lahir' => 'BOGOR',
                'tanggal_lahir' => '1993-06-07',
                'alamat' => 'JL. Batu Tapak',
                'kelurahan' => 'CIDOOKOM',
                'kecamatan' => 'GUNUNG SINDUR',
                'kabupaten_kota' => 'BOGOR',
                'provinsi' => 'JAWA BARAT',
                'ranting' => 'PENGASINAN',
                'status' => 'ANGGOTA AKTIF',
                'no_telpon' => '81210670690'
            ],
            [
                'kode_wilayah' => 'OTISTA',
                'nama_anggota' => 'HARY AKBAR',
                'tempat_lahir' => 'JAKARTA',
                'tanggal_lahir' => '2000-12-27',
                'alamat' => 'Asmara Porli RT004/013',
                'kelurahan' => 'BIDARA CINA',
                'kecamatan' => 'JATINEGARA',
                'kabupaten_kota' => 'JAKARTA TIMUR',
                'provinsi' => 'DKI JAKARTA',
                'ranting' => 'PENGASINAN',
                'status' => 'ANGGOTA AKTIF',
                'no_telpon' => '85711702177'
            ],
            [
                'kode_wilayah' => 'CISEENG',
                'nama_anggota' => 'IRFAN SUPANDI',
                'tempat_lahir' => 'MALANG TENGAH',
                'tanggal_lahir' => '2007-08-17',
                'alamat' => 'Malang Tengah, RT002/002',
                'kelurahan' => 'CISEENG',
                'kecamatan' => 'CISEENG',
                'kabupaten_kota' => 'BOGOR',
                'provinsi' => 'JAWA BARAT',
                'ranting' => 'PENGASINAN',
                'status' => 'ANGGOTA AKTIF',
                'no_telpon' => '83159832604'
            ],
            [
                'kode_wilayah' => 'CISEENG',
                'nama_anggota' => 'MARSHA NOURFIMANSYAH',
                'tempat_lahir' => 'JAKARTA',
                'tanggal_lahir' => '1988-11-08',
                'alamat' => 'Perumahan Serpong Indah',
                'kelurahan' => 'CIBINONG',
                'kecamatan' => 'GUNUNG SINDUR',
                'kabupaten_kota' => 'BOGOR',
                'provinsi' => 'JAWA BARAT',
                'ranting' => 'PENGASINAN',
                'status' => 'ANGGOTA AKTIF',
                'no_telpon' => '81977712322'
            ],
            [
                'kode_wilayah' => 'CISEENG',
                'nama_anggota' => 'MUHAMMAD FAHMI ISMAIL',
                'tempat_lahir' => 'BOGOR',
                'tanggal_lahir' => '1989-10-23',
                'alamat' => 'Kp.Cibogo RT001/003',
                'kelurahan' => 'CISEENG',
                'kecamatan' => 'CISEENG',
                'kabupaten_kota' => 'BOGOR',
                'provinsi' => 'JAWA BARAT',
                'ranting' => 'PENGASINAN',
                'status' => 'ANGGOTA AKTIF',
                'no_telpon' => '81804926937'
            ],
            [
                'kode_wilayah' => 'PONDOK LABU',
                'nama_anggota' => 'MUHAMMAD ILHAM PERMANA',
                'tempat_lahir' => 'JAKARTA',
                'tanggal_lahir' => '2004-06-24',
                'alamat' => 'JL. Swakarya Bawah No.50',
                'kelurahan' => 'PONDOK LABU',
                'kecamatan' => 'CILANDAK',
                'kabupaten_kota' => 'JAKARTA SELATAN',
                'provinsi' => 'DKI JAKARTA',
                'ranting' => 'PENGASINAN',
                'status' => 'ANGGOTA AKTIF',
                'no_telpon' => '89603964712'
            ],
            [
                'kode_wilayah' => 'PONDOK LABU',
                'nama_anggota' => 'RICKY SEPTIANA',
                'tempat_lahir' => 'JAKARTA',
                'tanggal_lahir' => '1995-09-23',
                'alamat' => 'JL.H.Ali, No167,RT005/006',
                'kelurahan' => 'CIPETE SELATAN',
                'kecamatan' => 'CILANDAK',
                'kabupaten_kota' => 'JAKARTA SELATAN',
                'provinsi' => 'DKI JAKARTA',
                'ranting' => 'PENGASINAN',
                'status' => 'ANGGOTA AKTIF',
                'no_telpon' => '87885175454'
            ],
            [
                'kode_wilayah' => 'PONDOK LABU',
                'nama_anggota' => 'ZAID IBADUSSHALIH',
                'tempat_lahir' => 'JAKARTA',
                'tanggal_lahir' => '2002-09-19',
                'alamat' => 'JL.Pinang 2 Dalam,Pondok Labu',
                'kelurahan' => 'PONDOK LABU',
                'kecamatan' => 'CILANDAK',
                'kabupaten_kota' => 'JAKARTA SELATAN',
                'provinsi' => 'DKI JAKARTA',
                'ranting' => 'PENGASINAN',
                'status' => 'ANGGOTA AKTIF',
                'no_telpon' => '89663918862'
            ],
        ];

        foreach($anggotas as $anggota) {
            Anggota::create($anggota);
        }
    }
}
