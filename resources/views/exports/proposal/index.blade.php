<table>
    <tr>
        <th rowspan="4">
            <img src="{{ public_path('img/unival.jpeg') }}" width="100" height="100">
        </th>
        <th style="font-size: 14px; font-weight: bold; text-align: left;" colspan="10">
            UNIVERSITAS AL-KHAIRIYAH
        </th>
    </tr>
    <tr>
        <td>
            Website
        </td>
        <td colspan="14">
            : www.unival-cilegon.ac.id
        </td>
        <td style="font-size: 14px; font-weight: bold; text-align: right;" colspan="6">
            FAKULTAS ILMU KOMPUTER
        </td>
    </tr>
    <tr>
        <td>
            e-Mail
        </td>
        <td colspan="14">
            : humas@unival-cilegon.ac.id
        </td>
        <td style="font-size: 12px; font-weight: bold; text-align: right;" colspan="6">TEKNIK INFORMATIKA</td>
    </tr>
    <tr>
        <td>
            Alamat
        </td>
        <td colspan="8">
            : Jalan Kh. Ahmad Dahlan Kel. Citangkil Kota Cilegon
        </td>
        <td style="font-size: 12px; font-weight: bold; text-align: right;" colspan="12">MANAJEMEN INFORMATIKA</td>
    </tr>
</table>

<table>
    <tr>
        <td colspan="22" style="border-top: 2px double black;"></td>
    </tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr>
        <td colspan="22" style="text-align: center; font-weight: bold; font-size: 14px;">
            JADWAL SIDANG AKHIR SKRIPSI/TUGAS AKHIR
        </td>
    </tr>
    <tr>
        <td colspan="22" style="text-align: center; font-weight: bold; font-size: 12px;">TEKNIK INFORMATIKA &amp;
            MANAJEMEN INFORMATIKA</td>
    </tr>
    <tr>
        <td colspan="22" style="text-align: center; font-weight: bold; font-size: 12px;">TAHUN AKADEMIK
            {{ $proposals->first()->academicCalendar->periode_year }}</td>
    </tr>
    <tr></tr>
    <tr></tr>
</table>

<table>
    <thead>
        <tr>
            <th style="font-weight: bold; border: 1px solid black; text-align: center;">NO</th>
            <th style="font-weight: bold; border: 1px solid black; text-align: center;">NIM</th>
            <th style="font-weight: bold; border: 1px solid black; text-align: center;" colspan="2">
                MAHASISWA</th>
            <th style="font-weight: bold; border: 1px solid black; text-align: center;">TANGGAL</th>
            <th style="font-weight: bold; border: 1px solid black; text-align: center;">WAKTU</th>
            <th style="font-weight: bold; border: 1px solid black; text-align: center;">RUANGAN</th>
            <th style="font-weight: bold; border: 1px solid black; text-align: center;" colspan="3">
                PEMBIMBING 1</th>
            <th style="font-weight: bold; border: 1px solid black; text-align: center;" colspan="3">
                PEMBIMBING 2</th>
            <th style="font-weight: bold; border: 1px solid black; text-align: center;" colspan="3">
                PENGUJI 1</th>
            <th style="font-weight: bold; border: 1px solid black; text-align: center;" colspan="3">
                PENGUJI 2</th>
            <th style="font-weight: bold; border: 1px solid black; text-align: center;" colspan="3">
                KETUA SIDANG</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($proposals as $proposal)
            <tr>
                <td style="border: 1px solid black; text-align: center; vertical-align: middle;">
                    {{ $loop->iteration }}
                </td>
                <td style="border: 1px solid black; text-align: center; vertical-align: middle;">
                    {{ $proposal->student->nim }}</td>
                <td style="border: 1px solid black; text-align: center; vertical-align: middle;" colspan="2">
                    {{ $proposal->student->name }}</td>
                <td style="border: 1px solid black; text-align: center; vertical-align: middle;">
                    {{ $proposal->session_date }}</td>
                <td style="border: 1px solid black; text-align: center; vertical-align: middle;">
                    {{ $proposal->session_time }}</td>
                <td style="border: 1px solid black; text-align: center; vertical-align: middle;">
                    {{ $proposal->room->name }}</td>
                <td style="border: 1px solid black; text-align: center; vertical-align: middle;" colspan="3">
                    {{ $proposal->student->lecture1->nidn }} - {{ $proposal->student->lecture1->name }}</td>
                <td style="border: 1px solid black; text-align: center; vertical-align: middle;" colspan="3">
                    {{ $proposal->student->lecture2->nidn }} - {{ $proposal->student->lecture2->name }}</td>
                <td style="border: 1px solid black; text-align: center; vertical-align: middle;" colspan="3">
                    {{ $proposal->examiner1->nidn }} - {{ $proposal->examiner1->name }}</td>
                <td style="border: 1px solid black; text-align: center; vertical-align: middle;" colspan="3">
                    {{ $proposal->examiner2->nidn }} - {{ $proposal->examiner2->name }}</td>
                <td style="border: 1px solid black; text-align: center; vertical-align: middle;" colspan="3">
                    {{ $proposal->moderator->nidn }} - {{ $proposal->moderator->name }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
