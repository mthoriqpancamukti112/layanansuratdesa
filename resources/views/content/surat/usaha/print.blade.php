<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Surat Keterangan Usaha</title>
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
                position: absolute;
                bottom: 0;
                width: 100%;
                page-break-after: always;
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
                            {{ strtoupper($suratPenduduk->desa->kabupaten) }}</font>
                    </strong></td>
                <td rowspan="3" width="70"><img src="/img/beleka.png" width="70" height="80"></td>
            </tr>
            <tr>
                <td colspan="" align="center"><strong>
                        <font size=4 color="black">KECAMATAN {{ strtoupper($suratPenduduk->desa->kecamatan) }}</font>
                    </strong>
                </td>
            </tr>
            <tr>
                <td colspan="" align="center"><strong>
                        <font size=4 color="black">DESA {{ strtoupper($suratPenduduk->desa->nama_desa) }}</font>
                    </strong>
                </td>
            </tr>
            <tr>
                <td colspan="3" align="center">
                    <font size=3><em>{{ $suratPenduduk->desa->alamat_kantor }}</em>
                    </font>
                </td>
            </tr>
            <tr>
                <td colspan="3" align="center">
                    <font size=3><em>E-mail : {{ $suratPenduduk->desa->email }}</em>
                    </font>
                    <hr style="background-color: #ccc; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);" size="3">
                </td>
            </tr>
            <tr>
                <td colspan="3" align="center"><strong>
                        <font size=5 color="black"><br><u>SURAT KETERANGAN USAHA</u></font>
                    </strong><br>
                    <font size=3 color="black">Nomor : {{ $suratPenduduk->surat->no_surat }}</font>
                </td>
            </tr>
        </table>

        <br>
        <table style="width: 100%; border-collapse: collapse;">
            <br>
            <tr>
                <td colspan="3">Yang bertanda tangan dibawah ini : </td>
            </tr>
            <tr>
                <td style="padding-bottom: 5px"></td>
            </tr>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td>{{ $suratPenduduk->desa->sekdes }}</td>
            </tr>
            <tr>
                <td>Jabatan</td>
                <td>:</td>
                <td>Sekretaris Desa {{ $suratPenduduk->desa->nama_desa }}</td>
            </tr>
            <tr>
                <td colspan="3">&ensp;</td>
            </tr>
            <tr>
                <td colspan="3">Dengan ini menerangkan bahwa : </td>
            </tr>
            <tr>
                <td style="padding-bottom: 5px"></td>
            </tr>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td>{{ $suratPenduduk->user->username }}</td>
            </tr>
            <tr>
                <td>NIK</td>
                <td>:</td>
                <td>
                    @if (Auth::user()->role === 'admin')
                        {{ $suratPenduduk->user->admin->nik }}
                    @else
                        {{ $suratPenduduk->user->nik }}
                    @endif
                </td>
            </tr>
            <tr>
                <td>Tempat & Tanggal Lahir</td>
                <td>:</td>
                <td>
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
                <td>Jenis Kelamin</td>
                <td>:</td>
                <td>
                    @if (Auth::user()->role === 'admin')
                        {{ $suratPenduduk->user->admin->jk }}
                    @else
                        {{ $suratPenduduk->user->penduduk->jk }}
                    @endif
                </td>
            </tr>
            <tr>
                <td>Agama</td>
                <td>:</td>
                <td>
                    @if (Auth::user()->role === 'admin')
                        {{ $suratPenduduk->user->admin->agama }}
                    @else
                        {{ $suratPenduduk->user->penduduk->agama }}
                    @endif
                </td>
            </tr>
            <tr>
                <td>Status</td>
                <td>:</td>
                <td>
                    @if (Auth::user()->role === 'admin')
                        {{ $suratPenduduk->user->admin->status }}
                    @else
                        {{ $suratPenduduk->user->penduduk->status }}
                    @endif
                </td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td>
                    @if (Auth::user()->role === 'admin')
                        {{ $suratPenduduk->user->admin->alamat }}, Kec.
                        {{ $suratPenduduk->user->admin->kecamatan }}, Kab.
                        {{ $suratPenduduk->user->admin->kabupaten }}
                    @else
                        {{ $suratPenduduk->user->penduduk->alamat }}, Kec.
                        {{ $suratPenduduk->user->penduduk->kecamatan }}, Kab.
                        {{ $suratPenduduk->user->penduduk->kabupaten }}
                    @endif
                </td>
            </tr>
            <tr>
                <td colspan="3">&nbsp;</td>
            </tr>
        </table>
        <table style="width: 100%; border-collapse: collapse;">
            <tr>
                <td colspan="3">Keterangan : </td>
            </tr>
            <tr>
                <td class="number-cell">1.</td>
                <td class="text-cell">
                    @if (Auth::user()->role === 'admin')
                        Orang tersebut di atas benar-benar Penduduk Desa {{ $suratPenduduk->user->admin->desa }},
                        Kecamatan {{ $suratPenduduk->user->admin->kecamatan }},
                        Kabupaten/Kota {{ $suratPenduduk->user->admin->kabupaten }}.
                    @else
                        Orang tersebut di atas benar-benar Penduduk Desa {{ $suratPenduduk->user->penduduk->desa }},
                        Kecamatan {{ $suratPenduduk->user->penduduk->kecamatan }},
                        Kabupaten/Kota {{ $suratPenduduk->user->penduduk->kabupaten }}.
                    @endif
                </td>
            </tr>
            <tr>
                <td class="number-cell">2.</td>
                <td class="text-cell">Berdasarkan keterangannya, yang bersangkutan memiliki usaha
                    yang bergerak dalam bidang {{ $suratPenduduk->detailSurats->first()->bidang_usaha }} sejak
                    tanggal
                    {{ \Carbon\Carbon::parse($suratPenduduk->detailSurats->first()->berjalan_sejak)->locale('id_ID')->isoFormat('D MMMM YYYY') }}
                    yang berlokasi di {{ $suratPenduduk->detailSurats->first()->alamat_usaha }}.
                </td>
            </tr>
            <tr>
                <td class="number-cell">3.</td>
                <td class="text-cell">Surat keterangan ini diberikan kepadanya sebagai kelengkapan
                    persyaratan administrasi.
                </td>
            </tr>
            <tr>
                <td style="padding-bottom: 5px"></td>
            </tr>
            <tr>
                <td colspan="3">Demikian keterangan ini dibuat dengan sebenarnya untuk dapat
                    dipergunakan
                    sebagaimana mestinya. </td>
            </tr>
        </table>

        <table style="width: 100%; border-collapse: collapse;">
            <br>
            <tr>
                <td class="right">
                    <div id="tanggal" class="left-align"></div>
                    <div class="left-awal">a.n Kepala Desa {{ $suratPenduduk->desa->nama_desa }},
                        Sekretaris Desa</div>
                    <div class="left-align">
                        <br><br><br><u><b></b></u><br>{{ strtoupper($suratPenduduk->desa->sekdes) }}<br>NIP.
                        {{ $suratPenduduk->desa->nip_sekdes }}
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

        document.getElementById('tanggal').innerHTML = "{{ $suratPenduduk->desa->nama_desa }}, " + day + " " +
            monthNames[monthIndex] + " " + year;
    </script>
</body>

</html>
