<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Surat Keterangan Ahli Waris</title>
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
                        <font size=4 color="black"><br><u>SURAT KETERANGAN AHLI WARIS</u></font>
                    </strong><br>
                    <font size=3 color="black">Nomor : {{ $suratPenduduk->surat->no_surat }}</font>
                </td>
            </tr>
        </table>

        <br>
        <table style="width: 100%; border-collapse: collapse;">
            <br>
            <tr>
                <td>Yang bertanda tangan dibawah ini Kepala Desa
                    {{ $suratPenduduk->desa->nama_desa }} Kecamatan {{ $suratPenduduk->desa->kecamatan }} Kabupaten
                    {{ $suratPenduduk->desa->kabupaten }} menerangkan dengan sebenarnnya bahwa : </td>
            </tr>
        </table>
        <table style="width: 100%; border-collapse: collapse;">
            <br>
            <thead>
                <tr>
                    <th style="border: 1px solid #000; padding: 8px; text-align: center;">No</th>
                    <th style="border: 1px solid #000; padding: 8px; text-align: center;">Nama</th>
                    <th style="border: 1px solid #000; padding: 8px; text-align: center;">NIK</th>
                    <th style="border: 1px solid #000; padding: 8px; text-align: center;">
                        Tempat/Tanggal Lahir</th>
                    <th style="border: 1px solid #000; padding: 8px; text-align: center;">Jenis
                        Kelamin</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($suratPenduduk->anggotaAhliwaris as $index => $ahliwaris)
                    <tr>
                        <td style="border: 1px solid #000; padding: 8px; text-align: left;">
                            {{ $loop->iteration }}</td>
                        <td style="border: 1px solid #000; padding: 8px; text-align: left;">
                            {{ $ahliwaris->nama }}</td>
                        <td style="border: 1px solid #000; padding: 8px; text-align: left;">
                            {{ $ahliwaris->nik }}</td>
                        <td style="border: 1px solid #000; padding: 8px; text-align: left;">
                            {{ $ahliwaris->tempat_lahir }},
                            {{ \Carbon\Carbon::parse($ahliwaris->tgl_lahir)->locale('id_ID')->isoFormat('D MMMM YYYY') }}
                        </td>
                        <td style="border: 1px solid #000; padding: 8px; text-align: left;">
                            {{ $ahliwaris->jk }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <table style="width: 100%; border-collapse: collapse;">
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td>Bahwa yang namanya tersebut diatas memang benar ahli waris dari
                    {{ strtoupper($suratPenduduk->user->username) }},
                    @if (Auth::user()->role === 'admin')
                        {{ $suratPenduduk->user->admin->nik }}
                    @else
                        {{ $suratPenduduk->user->nik }}.
                    @endif
                </td>
            </tr>
        </table>
        <table style="width: 100%; border-collapse: collapse;">
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td>Surat keterangan ini diberikan kepadanya
                    {{ $suratPenduduk->detailSurats->first()->keperluan_ahliwaris }}.
                </td>
            </tr>
        </table>
        <table style="width: 100%; border-collapse: collapse;">
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td>Demikian surat keterangan ini dibuat dengan sebenarnya untuk dapat
                    dipergunakan sebagaimana mestinya.</td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
        </table>

        <table style="width: 100%; border-collapse: collapse;">
            <tr>
                <td class="right">
                    <div id="tanggal" class="left-align"></div>
                    <div class="left-awal">Kepala Desa {{ $suratPenduduk->desa->nama_desa }}, Sekretaris Desa</div>
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
