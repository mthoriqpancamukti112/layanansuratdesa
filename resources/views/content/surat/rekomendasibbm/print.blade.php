<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Surat Rekomendasi Pembelian BBM</title>
    <style>
        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            box-sizing: border-box;
        }

        .right {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-end;
            height: 100%;
            text-align: right;
        }

        .left-align {
            margin-right: 60px;
        }

        .left-awal {
            text-align: right;
        }

        .left {
            text-align: center;
        }

        .footer {
            font-size: 12px;
            text-align: center;
            bottom: 0;
            width: 100%;
            clear: both;
            position: relative;
            page-break-after: always;
        }

        @media print {
            .container {
                width: 100%;
                max-width: 100%;
                margin: 0 auto;
                padding: 10px;
                box-sizing: border-box;
            }

            body {
                font-size: 12pt;
            }

            .footer {
                position: fixed;
                bottom: 0;
                width: 100%;
                text-align: center;
                padding-top: 10px;
            }

            .page-break {
                page-break-after: always;
            }
        }
    </style>
</head>

<body onload="window.print()">
    <div class="container">
        <table style="width: 100%; border-collapse: collapse;">
            <tr>
                <td rowspan="3" width="70"><img src="/img/lombok_barat.png" width="70" height="80"></td>
                <td colspan="" align="center"><strong>
                        <font size=4 color="black">PEMERINTAH KABUPATEN
                            {{ strtoupper($suratPenduduk->desa->kabupaten) }}
                        </font>
                    </strong></td>
                <td rowspan="3" width="70"><img src="/img/beleka.png" width="70" height="80"></td>
            </tr>
            <tr>
                <td colspan="" align="center"><strong>
                        <font size=4 color="black">KECAMATAN {{ strtoupper($suratPenduduk->desa->kecamatan) }}
                        </font>
                    </strong>
                </td>
            </tr>
            <tr>
                <td colspan="" align="center"><strong>
                        <font size=5 color="black">DESA {{ strtoupper($suratPenduduk->desa->nama_desa) }}
                        </font>
                    </strong>
                </td>
            </tr>
            <tr>
                <td colspan="3" align="center">
                    <font size=2><i>{{ $suratPenduduk->desa->alamat_kantor }}</i>
                    </font>
                </td>
            </tr>
            <tr>
                <td colspan="3" align="center">
                    <font size=2><i>E-mail : {{ $suratPenduduk->desa->email }}</i>
                    </font>
                    <hr style="background-color: #ccc; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);" size="3">
                </td>
            </tr>
            <tr>
                <td colspan="3" align="center"><strong>
                        <font size=4 color="black"><br><u>SURAT REKOMENDASI PEMBELIAN BBM JENIS TERTENTU</u></font>
                    </strong><br>
                    <font size=3 color="black">Nomor : {{ $suratPenduduk->surat->no_surat }}</font>
                </td>
            </tr>
        </table>

        <br>
        <table style="width: 100%; border-collapse: collapse;">
            <br>
            <tr>
                <td>Dasar Hukum : </td>
            </tr>
        </table>
        <table style="width: 100%; border-collapse: collapse;">
            <tr>
                <td>1. </td>
                <td>Undang-undang Nomor 6 Tahun 2023 tentang penetapan peraturan pemerintah Pengganti
                </td>
            </tr>
            <tr>
                <td></td>
                <td>undang-undang no 2
                    tahun 2022 tentang Ciptaker menjadi undang-undang.</td>
            </tr>
            <tr>
                <td>2. </td>
                <td>Undang-undang Nomor 23 Tahun 2014 tentang pemerintah daerah sebagaimana telah diubah dengan
                </td>
            </tr>
            <tr>
                <td></td>
                <td> undang-undang Nomor 6 Tahun 2023 tentang penetapan peraturan pemerintah pengganti undang-undang no
                    2
                    tahun 2022 tentang Cipta Karya menjadi undang-undang.</td>
            </tr>
            <tr>
                <td>3. </td>
                <td>Peraturan presiden No 15 Tahun 2012 tentang Harga Jual Eceran dan Konsumen Pengguna Jasa Bahan </td>
            </tr>
            <tr>
                <td></td>
                <td>Bakar
                    Minyak sebagaimana telah beberapa kali diubah terakhir dengan peraturan Presiden Nomor 117 tahun
                    2021 tentang Perubahan Ketiga Atas Peraturan Presiden Nomor 191 Tahun 2014 tentang Penyediaan,
                    Pendistribusian dan Harga Jual Eceran Bahan Bakar Minyak.</td>
            </tr>
            <tr>
                <td>4. </td>
                <td>Peraturan BPH MIGAS Nomor 2 Tahun 2023 tentang Penerbitan Surat Rekomendasi untuk pembelian</td>
            </tr>
            <tr>
                <td></td>
                <td>Jenis Bahan Bakar Tertentu (JBT) dan Jenis Bbahan Bakar Minyak Khusus Penugasan (JBKP).</td>
            </tr>
        </table>
        <table style="width: 100%; border-collapse: collapse;">
            <br>
            <tr>
                <td>Berdasarkan keterangan yang bersangkutan sebagaimana tertulis di bawah ini, dengan ini memberikan
                    Rekomendasi kepada : </td>
            </tr>
        </table>
        <table style="width: 100%; border-collapse: collapse;">
            <tr>
                <td class="print-text">Nama</td>
                <td>:</td>
                <td class="print-text">{{ $suratPenduduk->user->username }}</td>
            </tr>
            <tr>
                <td class="print-text">NIK</td>
                <td>:</td>
                <td class="print-text">
                    @if (Auth::user()->role === 'admin')
                        {{ $suratPenduduk->user->admin->nik }}
                    @else
                        {{ $suratPenduduk->user->nik }}
                    @endif
                </td>
            </tr>
            <tr>
                <td class="print-text">Alamat</td>
                <td>:</td>
                <td class="print-text">
                    @if (Auth::user()->role === 'admin')
                        {{ $suratPenduduk->user->admin->desa }} Kec. {{ $suratPenduduk->user->admin->kecamatan }} Kab.
                        {{ $suratPenduduk->user->admin->kabupaten }}
                    @else
                        {{ $suratPenduduk->user->penduduk->desa }} Kec.
                        {{ $suratPenduduk->user->penduduk->kecamatan }} Kab.
                        {{ $suratPenduduk->user->penduduk->kabupaten }}
                    @endif
                </td>
            </tr>
            <tr>
                <td class="print-text">Nama Usaha</td>
                <td>:</td>
                <td class="print-text">{{ $suratPenduduk->detailSurats->first()->nama_usaha_rekomendasibbm }}</td>
            </tr>
            <tr>
                <td class="print-text">Konsumen Pengguna</td>
                <td>:</td>
                <td class="print-text">{{ $suratPenduduk->detailSurats->first()->konsumen_pengguna }}</td>
            </tr>
            <tr>
                <td class="print-text">Jenis Usaha</td>
                <td>:</td>
                <td class="print-text">{{ $suratPenduduk->detailSurats->first()->jenis_usaha }}</td>
            </tr>
            <tr>
                <td class="print-text">Berdasarkan hasil perhitungannya;</td>
            </tr>
        </table>
        <table style="width: 100%; border-collapse: collapse;">
            <br>
            <tr>
                <td>1. Kebutuhan jenis BBM tertentu yang digunakan untuk alat sebagai berikut : </td>
            </tr>
        </table>
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr>
                    <th style="border: 1px solid #000; padding: 8px; text-align: center;">Jenis Alat</th>
                    <th style="border: 1px solid #000; padding: 8px; text-align: center;">Fungsi</th>
                    <th style="border: 1px solid #000; padding: 8px; text-align: center;">
                        Jumlah Alat</th>
                    <th style="border: 1px solid #000; padding: 8px; text-align: center;">Daya Alat</th>
                    <th style="border: 1px solid #000; padding: 8px; text-align: center;">Lama Penggunaan Alat (jam
                        perhari)</th>
                    <th style="border: 1px solid #000; padding: 8px; text-align: center;">Lama Operasi Alat
                        (hari/minggu/bulan)</th>
                    <th style="border: 1px solid #000; padding: 8px; text-align: center;">Konsumsi JBT/JBKP (liter)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="border: 1px solid #000; padding: 8px; text-align: left;">
                        {{ $suratPenduduk->detailSurats->first()->jenis_alat }}</td>
                    <td style="border: 1px solid #000; padding: 8px; text-align: left;">
                        {{ $suratPenduduk->detailSurats->first()->fungsi }}</td>
                    <td style="border: 1px solid #000; padding: 8px; text-align: left;">
                        {{ $suratPenduduk->detailSurats->first()->jumlah_alat }}
                    </td>
                    <td style="border: 1px solid #000; padding: 8px; text-align: left;">
                        {{ $suratPenduduk->detailSurats->first()->daya_alat }}</td>
                    <td style="border: 1px solid #000; padding: 8px; text-align: left;">
                        {{ $suratPenduduk->detailSurats->first()->lama_penggunaan }}</td>
                    <td style="border: 1px solid #000; padding: 8px; text-align: left;">
                        {{ $suratPenduduk->detailSurats->first()->lama_operasi_alat }}</td>
                    <td style="border: 1px solid #000; padding: 8px; text-align: left;">
                        {{ $suratPenduduk->detailSurats->first()->konsumsi }}</td>
                </tr>
            </tbody>
        </table>
        <table style="width: 100%; border-collapse: collapse;">
            <br>
            <tr>
                <td>2. Diberikan jenis BBM tertentu jenis minyak Solar : </td>
            </tr>
        </table>
        <table style="width: 100%; border-collapse: collapse;">
            <tr>
                <td class="print-text">a. Alokasi Volume</td>
                <td>:</td>
                <td class="print-text">{{ $suratPenduduk->detailSurats->first()->konsumsi }}</td>
            </tr>
            <tr>
                <td class="print-text">b. Tempat Pengambilan</td>
                <td>:</td>
                <td class="print-text">SPBU {{ $suratPenduduk->desa->nama_desa }}</td>
            </tr>
            <tr class="page-break">
                <td class="print-text">c. Nomor Lembaga Penyalur</td>
                <td>:</td>
                <td class="print-text">SPBU 54.833.01</td>
            </tr>
            <tr>
                <td class="print-text">d. Alamat Penyalur</td>
                <td>:</td>
                <td class="print-text">Desa {{ $suratPenduduk->desa->nama_desa }}, Kec.
                    {{ $suratPenduduk->desa->kecamatan }}, Kab.
                    {{ $suratPenduduk->desa->kabupaten }}</td>
            </tr>
            <tr>
                <td class="print-text">e. Alat Pembelian Yang Digunakan</td>
                <td>:</td>
                <td class="print-text">{{ $suratPenduduk->detailSurats->first()->alat_pembelian_digunakan }}</td>
            </tr>
        </table>
        <table style="width: 100%; border-collapse: collapse;">
            <tr>
                <td>f. Penyalur SPBU/SPBKB/SPBN/SPBUN wajib mencatat riwayat pembelian konsumen pengguna dalam format
                    sebagaimana terlampir.</td>
            </tr>
            <tr>
                <td>g. Surat rekomendasi ini hanya berlaku untuk perorangan sesuai dengan identitas pemohon Surat
                    Rekomendasi.</td>
            </tr>
            <tr>
                <td>h. Surat rekomendasi ini dilarang untuk diberikan, dipindah tangankan atau dialihkan kepada pihak
                    lain.
                </td>
            </tr>
            <tr>
                <td>i. Jenis BBM tertentu atau BBM Khusus Penugasan yang diperoleh tidak untuk diperjualbelikan kembali.
                </td>
            </tr>
            <tr>
                <td>j. Apabila surat rekomendasi ini tidak dipergunakan sebagaimana mestinya dan tidak sesuai dengan
                    ketentuan ketentuan peraturan perundang-undangan, Surat Rekomendasi ini akan dicabut dan diproses
                    secara hukum sesuai dengan ketentuan peraturan perundang-undangan, tanpa melibatkan pihak yang
                    menerbitkan Rekomendasi.</td>
            </tr>
            <tr>
                <td>k. Surat Rekomendasi ini beserta lampirannya harus dilampirkan kembali saat perpanjangan atau
                    pengajuan
                    ulang permohonan surat rekomendasi.
                </td>
            </tr>
        </table>
        <table style="width: 100%; border-collapse: collapse;">
            <br>
            <tr>
                <td class="right">
                    <div id="tanggal" class="left-align"></div>
                    <div class="left-awal">a.n Kepala Desa {{ $suratPenduduk->desa->nama_desa }}, Sekretaris Desa</div>
                    <div class="left-align">
                        <br><br><br><u><b></b></u><br>{{ strtoupper($suratPenduduk->desa->kades) }}<br>NIP.
                        {{ $suratPenduduk->desa->nip_kades }}
                    </div>
                </td>
            </tr>
        </table>

        <div class="footer">
            <hr style="background-color: #ccc; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);" size="3">
            <span>Maju Desanya, Sejahtera Masyarakatnya</span>
        </div>
    </div>
    <script>
        var today = new Date();

        var monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni",
            "Juli", "Agustus", "September", "Oktober", "November", "Desember"
        ];

        var day = today.getDate();
        var monthIndex = today.getMonth();
        var year = today.getFullYear();

        document.getElementById('tanggal').innerHTML = "{{ $suratPenduduk->desa->nama_desa }}, " + day + " " + monthNames[
            monthIndex] + " " + year;
    </script>

</body>

</html>
