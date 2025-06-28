<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Keterangan Pindah</title>
    <style>
        .right {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-end;
            height: 100%;
            text-align: right;
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

<body onload="window.print()">
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
                    <font size="3" color="black" class="print-judul">KECAMATAN
                        {{ strtoupper($suratPenduduk->desa->kecamatan) }}</font>
                </strong></td>
            <td width="70"></td>
        </tr>
        <tr>
            <td colspan="" align="center"><strong>
                    <font size="5" color="black" class="print-judul">DESA
                        {{ strtoupper($suratPenduduk->desa->nama_desa) }}</font>
                </strong></td>
            <td width="70"></td>
        </tr>
        <tr>
            <td colspan="3" align="center">
                <font size="2"><i class="print-text">{{ $suratPenduduk->desa->alamat_kantor }}</i></font>
            </td>
        </tr>
        <tr>
            <td colspan="3" align="center">
                <font size="2"><i class="print-text">E-mail : {{ $suratPenduduk->desa->email }}</i></font>
                <hr style="background-color: #ccc; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);" size="3">
            </td>
        </tr>
        <tr>
            <td colspan="3" align="center"><strong>
                    <font size="5" color="black" class="print-utama"><u>SURAT KETERANGAN PINDAH DATANG WNI</u>
                    </font>
                </strong><br>
                <font size="3" color="black" class="print-text">Nomor : {{ $suratPenduduk->surat->no_surat }}
                </font>
            </td>
        </tr>
    </table>
    <br>
    <table width="1100" align="center" border="0" cellspacing="1" cellpadding="4" class="table-list">
        <tr>
            <td class="print-text" colspan="3">DATA DAERAH ASAL</td>
        </tr>
        <tr>
            <td colspan="3"></td>
        </tr>
        <tr>
            <td class="print-text">Nomor Kartu Keluarga</td>
            <td>:</td>
            <td class="print-text">
                @if (Auth::user()->role === 'admin')
                    {{ $suratPenduduk->user->admin->no_kk }}
                @else
                    {{ $suratPenduduk->user->penduduk->no_kk }}
                @endif
            </td>
        </tr>
        <tr>
            <td class="print-text">Nama Kepala Keluarga</td>
            <td>:</td>
            <td class="print-text">{{ $suratPenduduk->user->username }}</td>
        </tr>
        <tr>
            <td class="print-text">Alamat</td>
            <td>:</td>
            <td class="print-text">
                @if (Auth::user()->role === 'admin')
                    {{ $suratPenduduk->user->admin->alamat }}
                @else
                    {{ $suratPenduduk->user->penduduk->alamat }}
                @endif
            </td>
        </tr>
        <tr>
            <td class="print-text">Desa / Kelurahan</td>
            <td>:</td>
            <td class="print-text">
                @if (Auth::user()->role === 'admin')
                    {{ $suratPenduduk->user->admin->desa }}
                @else
                    {{ $suratPenduduk->user->penduduk->desa }}
                @endif
            </td>
        </tr>
        <tr>
            <td class="print-text">Kecamatan</td>
            <td>:</td>
            <td class="print-text">
                @if (Auth::user()->role === 'admin')
                    {{ $suratPenduduk->user->admin->kecamatan }}
                @else
                    {{ $suratPenduduk->user->penduduk->kecamatan }}
                @endif
            </td>
        </tr>
        <tr>
            <td class="print-text">Kabupaten</td>
            <td>:</td>
            <td class="print-text">
                @if (Auth::user()->role === 'admin')
                    {{ $suratPenduduk->user->admin->kabupaten }}
                @else
                    {{ $suratPenduduk->user->penduduk->kabupaten }}
                @endif
            </td>
        </tr>
        <tr>
            <td class="print-text">Provinsi</td>
            <td>:</td>
            <td class="print-text">
                @if (Auth::user()->role === 'admin')
                    {{ $suratPenduduk->user->admin->provinsi }}
                @else
                    {{ $suratPenduduk->user->penduduk->provinsi }}
                @endif
            </td>
        </tr>
        <tr>
            <td class="print-text">Nomor Telp</td>
            <td>:</td>
            <td class="print-text">
                @if (Auth::user()->role === 'admin')
                    {{ $suratPenduduk->user->admin->no_hp }}
                @else
                    {{ $suratPenduduk->user->penduduk->desa }}
                @endif
            </td>
        </tr>
        <tr>
            <td colspan="3"></td>
        </tr>
        <tr>
            <td class="print-text" colspan="3">DATA KEPINDAHAN</td>
        </tr>
        <tr>
            <td colspan="3"></td>
        </tr>
        <tr>
            <td class="print-text">Alasan Pindah</td>
            <td>:</td>
            <td class="print-text">{{ $suratPenduduk->detailSurats->first()->alasan_pindah }}</td>
        </tr>
        <tr>
            <td class="print-text">Alamat Tujuan Pindah</td>
            <td>:</td>
            <td class="print-text">{{ $suratPenduduk->detailSurats->first()->alamat_tujuan_pindah }}, Desa
                {{ $suratPenduduk->detailSurats->first()->nama_desa_pindah }}, Kecamatan
                {{ $suratPenduduk->detailSurats->first()->kecamatan_pindah }}, Kab/Kota
                {{ $suratPenduduk->detailSurats->first()->kabupaten_pindah }}, Provinsi
                {{ $suratPenduduk->detailSurats->first()->provinsi_pindah }}, </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td class="print-text">RT
                {{ $suratPenduduk->detailSurats->first()->rt }}, RW {{ $suratPenduduk->detailSurats->first()->rw }},
                Kode Pos {{ $suratPenduduk->detailSurats->first()->kode_pos }}</td>
        </tr>
        <tr>
            <td class="print-text">Klasifikasi Pindah</td>
            <td>:</td>
            <td class="print-text">{{ $suratPenduduk->detailSurats->first()->klasifikasi_pindah }}</td>
        </tr>
        <tr>
            <td class="print-text">Jenis Perpindahan</td>
            <td>:</td>
            <td class="print-text">{{ $suratPenduduk->detailSurats->first()->jenis_perpindahan }}</td>
        </tr>
        <tr>
            <td class="print-text">Status Nomor KK Bagi Yang Tidak Pindah</td>
            <td>:</td>
            <td class="print-text">{{ $suratPenduduk->detailSurats->first()->status_no_kk_tidakpindah }}</td>
        </tr>
        <tr>
            <td class="print-text">Status Nomor KK Bagi Yang Pindah</td>
            <td>:</td>
            <td class="print-text">{{ $suratPenduduk->detailSurats->first()->status_no_kk_pindah }}</td>
        </tr>
        <tr>
            <td class="print-text">Rencana Tanggal Pindah</td>
            <td>:</td>
            <td class="print-text">
                {{ \Carbon\Carbon::parse($suratPenduduk->detailSurats->first()->rencana_tgl_pindah)->locale('id_ID')->isoFormat('D MMMM YYYY') }}
            </td>
        </tr>
        <tr>
            <td colspan="3"></td>
        </tr>
        <tr>
            <td colspan="3"></td>
        </tr>
        <tr>
            <td class="print-text">Keluarga Yang Pindah</td>
            <td>:</td>
            <td class="print-text"></td>
        </tr>
    </table>

    <table width="100%" align="center" border="1" cellspacing="0" cellpadding="4" class="table-list"
        style="border-collapse: collapse;">
        <thead>
            <tr>
                <th class="print-text" style="text-align: center; border: 1px solid #000; padding: 5px;">NIK</th>
                <th class="print-text" style="text-align: center; border: 1px solid #000; padding: 5px;">Nama</th>
                <th class="print-text" style="text-align: center; border: 1px solid #000; padding: 5px;">SHDK</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($suratPenduduk->anggotaKeluargaPindahs as $anggota)
                <tr>
                    <td style="border: 1px solid #000; padding: 5px;">{{ $anggota->nik }}</td>
                    <td style="border: 1px solid #000; padding: 5px;">{{ $anggota->nama }}</td>
                    <td style="border: 1px solid #000; padding: 5px;">{{ $anggota->shdk }}</td>
                </tr>
            @endforeach
        </tbody>
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
                        <br><br><br><u><b></b></u><br>{{ strtoupper($suratPenduduk->desa->sekdes) }}<br>NIP.
                        {{ $suratPenduduk->desa->nip_sekdes }}
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
