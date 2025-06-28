<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Surat Keterangan Tidak Mampu</title>
    <style>
        .right {
            display: flex;
            flex-direction: column;
            justify-content: center;
            /* Vertically center the content */
            align-items: flex-end;
            /* Align the text to the right */
            height: 100%;
            text-align: right;
            /* Ensure text is right-aligned */
        }

        .content {
            width: 100%;
        }

        .left-align {
            margin-right: 150px;
        }

        .left-awal {
            margin-right: 80px;
        }

        .left {
            text-align: center;
        }

        .number-cell {
            text-align: center;
            vertical-align: top;
        }

        .text-cell {
            width: 95%;
            text-align: left;
            vertical-align: top;
        }

        .container {
            width: 1100px;
        }

        .footer {
            text-align: center;
            width: 100%;
            position: relative;
        }

        .footer hr {
            width: 100%;
            height: 3px;
            background-color: #ccc;
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        @media print {

            .print-text {
                font-size: 16pt;
            }

            .print-sekretariat {
                font-size: 15px;
            }

            .print-judul {
                font-size: 24px;
            }

            .print-utama {
                font-size: 26px;
            }

            .footer {
                position: absolute;
                bottom: 0;
                width: 100%;
                page-break-after: always;
            }
        }
    </style>
</head>

<body onLoad="window.print()">
    <table width="1100" align="center" border="0" cellspacing="1" cellpadding="4" class="table-print">
        <tr>
            <td rowspan="3" width="70"><img src="/img/lombok_barat.png" width="70" height="80"></td>
            <td colspan="" align="center"><strong>
                    <font size=2 color="black" class="print-judul">PEMERINTAH KABUPATEN
                        {{ strtoupper($suratPenduduk->desa->kabupaten) }}
                    </font>
                </strong></td>
            <td rowspan="3" width="70"><img src="/img/beleka.png" width="70" height="80"></td>
        </tr>
        <tr>
            <td colspan="" align="center"><strong>
                    <font size=3 color="black" class="print-judul">KECAMATAN
                        {{ strtoupper($suratPenduduk->desa->kecamatan) }}
                    </font>
                </strong></td>
            <td width="70"></td>
        </tr>
        <tr>
            <td colspan="" align="center"><strong>
                    <font size=5 color="black" class="print-judul">DESA
                        {{ strtoupper($suratPenduduk->desa->nama_desa) }}
                    </font>
                </strong></td>
            <td width="70"></td>
        </tr>
        <tr>
            <td colspan="3" align="center">
                <font size=2><i class="print-text">{{ $suratPenduduk->desa->alamat_kantor }}</i>
                </font>
            </td>
        </tr>
        <tr>
            <td colspan="3" align="center">
                <font size=2><i class="print-text">{{ $suratPenduduk->desa->email }}</i>
                </font>
                <hr style="background-color: #ccc; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);" size="3">
            </td>
        </tr>
        <tr>
            <td colspan="3" align="center"><strong>
                    <font size=5 color="black" class="print-utama"><u>SURAT KETERANGAN TIDAK MAMPU</u></font>
                </strong><br>
                <font size=3 color="black" class="print-text">Nomor : {{ $suratPenduduk->surat->no_surat }}</font>
            </td>
        </tr>
    </table>
    <br>
    <table width="1100" align="center" border="0" cellspacing="1" cellpadding="4" class="table-list">
        <tr>
            <td class="print-text" colspan="3">Yang bertanda tangan dibawah ini Kepala Desa
                {{ $suratPenduduk->desa->kades }} Kecamatan {{ $suratPenduduk->desa->kecamatan }} Kabupaten
                {{ $suratPenduduk->desa->kabupaten }} menerangkan dengan sebenarnnya bahwa : </td>
        </tr>
        <tr>
            <td colspan="3"></td>
        </tr>
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
            <td class="print-text">Tempat & Tanggal Lahir</td>
            <td>:</td>
            <td class="print-text">
                @if (Auth::user()->role === 'admin')
                    {{ $suratPenduduk->user->admin->tempat_lahir }},
                    {{ \Carbon\Carbon::parse($suratPenduduk->user->admin->tgl_lahir)->locale('id_ID')->isoFormat('D MMMM YYYY') }}
                @else
                    {{ $suratPenduduk->user->penduduk->tempat_lahir }},
                    {{ \Carbon\Carbon::parse($suratPenduduk->user->penduduk->tgl_lahir)->locale('id_ID')->isoFormat('D MMMM YYYY') }}
                @endif
            </td>
        </tr>
        <tr>
            <td class="print-text">Jenis Kelamin</td>
            <td>:</td>
            <td class="print-text">
                @if (Auth::user()->role === 'admin')
                    {{ $suratPenduduk->user->admin->jk }}
                @else
                    {{ $suratPenduduk->user->penduduk->jk }}
                @endif
            </td>
        </tr>
        <tr>
            <td class="print-text">Agama</td>
            <td>:</td>
            <td class="print-text">
                @if (Auth::user()->role === 'admin')
                    {{ $suratPenduduk->user->admin->agama }}
                @else
                    {{ $suratPenduduk->user->penduduk->agama }}
                @endif
            </td>
        </tr>
        <tr>
            <td class="print-text">Pekerjaan</td>
            <td>:</td>
            <td class="print-text">
                @if (Auth::user()->role === 'admin')
                    {{ $suratPenduduk->user->admin->pekerjaan }}
                @else
                    {{ $suratPenduduk->user->penduduk->pekerjaan }}
                @endif
            </td>
        </tr>
        <tr>
            <td class="print-text">Status Perkawinan</td>
            <td>:</td>
            <td class="print-text">
                @if (Auth::user()->role === 'admin')
                    {{ $suratPenduduk->user->admin->status }}
                @else
                    {{ $suratPenduduk->user->penduduk->status }}
                @endif
            </td>
        </tr>
        <tr>
            <td class="print-text">Alamat</td>
            <td>:</td>
            <td class="print-text">
                @if (Auth::user()->role === 'admin')
                    {{ $suratPenduduk->user->admin->alamat }} Desa {{ $suratPenduduk->user->admin->desa }}
                @else
                    {{ $suratPenduduk->user->penduduk->alamat }} Desa {{ $suratPenduduk->user->penduduk->desa }}
                @endif
            </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td class="print-text">
                @if (Auth::user()->role === 'admin')
                    Kec. {{ $suratPenduduk->user->admin->kecamatan }} Kab.
                    {{ $suratPenduduk->user->admin->kabupaten }}
                @else
                    Kec. {{ $suratPenduduk->user->penduduk->kecamatan }} Kab.
                    {{ $suratPenduduk->user->penduduk->kabupaten }}
                @endif
            </td>
        </tr>
        <tr>
            <td class="print-text">Memang benar</td>
            <td>:</td>
            <td class="print-text">Penduduk yang berdomisili dalam wilayah kami dengan alamat tersebut diatas
            </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td class="print-text"> dan
                yang
                bersangkutan tergolong <b>Keluarga Tidak Mampu</b></td>
        </tr>
        <tr>
            <td class="print-text">Keperluan</td>
            <td>:</td>
            <td class="print-text">{{ $suratPenduduk->detailSurats->first()->keperluan_tidakmampu }}</td>
        </tr>
        <tr>
            <td colspan="3">&nbsp;</td>
        </tr>
        <table width="1100" align="center" border="0" cellspacing="1" cellpadding="4" class="table-list">
            <tr>
                <td colspan="3" class="print-text">Berhubung keperluan yang bersangkutan diharapkan kepada pihak yang
                    berwenang memberikan bantuan serta fasilitas seperlunya. </td>
            </tr>
        </table>
        <tr>
            <td colspan="3">&nbsp;</td>
        </tr>
        <table width="1100" align="center" border="0" cellspacing="1" cellpadding="4" class="table-list">
            <tr>
                <td colspan="3" class="print-text">Demikian surat keterangan ini dibuat dengan sebenarnya untuk
                    dapat
                    dipergunakan sebagaimana mestinya. </td>
            </tr>
        </table>

        <table width="1100" align="center" border="0" cellspacing="1" cellpadding="4" class="table-list">
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td class="left print-text">
                    <span> Yang bersangkutan</span><br>
                    <img src="{{ asset('barcode/' . basename($path)) }}" alt="QR Code"><br>
                    <span> {{ $suratPenduduk->user->username }}</span>
                </td>
                <td class="right print-text">
                    <div class="content">
                        <div id="tanggal" class="left-align"></div>
                        <div class="left-awal">a.n Kepala Desa {{ $suratPenduduk->desa->nama_desa }}, Sekretaris Desa
                        </div>
                        <div class="left-align">
                            <br><br><br><u><b></b></u><br>{{ strtoupper($suratPenduduk->desa->kades) }}<br>NIP.
                            {{ $suratPenduduk->desa->nip_kades }}
                        </div>
                    </div>
                </td>
            </tr>
        </table>
        <div class="footer">
            <hr size="3">
            <span>Maju Desanya, Sejahtera Masyarakatnya</span>
        </div>
        <script>
            var today = new Date();

            // Daftar nama bulan
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
