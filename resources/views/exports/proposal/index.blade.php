<table>
    <tr>
        <td colspan="11" style="text-align: left;">
            <img src="{{ public_path('img/unival.jpeg') }}" width="100" height="100" style="margin-bottom: 10px;">
        </td>
    </tr>
    <tr>
        <td colspan="11" style="text-align: left; font-weight: bold; font-size: 16px;">UNIVERSITAS AL-KHAIRIYAH</td>
    </tr>
    <tr>
        <td colspan="11" style="text-align: left;">Jalan Kh. Ahmad Dahlan Kel. Citangkil Kota Cilegon</td>
    </tr>
    <tr>
        <td colspan="11" style="text-align: left;">Website : www.unival-cilegon.ac.id / e-Mail :
            humas@unival-cilegon.ac.id / Telepon :</td>
    </tr>
    <tr>
        <td colspan="11"></td>
    </tr>
    <tr>
        <td colspan="11" style="text-align: center; font-weight: bold; font-size: 14px; border-top: 1px solid black;">
            DAFTAR
            PROPOSAL TUGAS AKHIR
        </td>
    </tr>
    <tr>
        <td colspan="11" style="text-align: center; font-weight: bold; font-size: 12px;">FAKULTAS ILMU KOMPUTER</td>
    </tr>
    <tr>
        <td colspan="11" style="text-align: center; font-weight: bold; font-size: 12px;">TAHUN AKADEMIK
            {{ $proposals->first()->academicCalendar->periode_year }}</td>
    </tr>
    <tr>
        <td colspan="11"></td>
    </tr>
    <thead>
        <tr>
            <th style="font-weight: bold; border: 1px solid black; text-align: center;">No</th>
            <th style="font-weight: bold; border: 1px solid black; text-align: center;">NIM</th>
            <th style="font-weight: bold; border: 1px solid black; text-align: center;">MAHASISWA</th>
            <th style="font-weight: bold; border: 1px solid black; text-align: center;">TANGGAL</th>
            <th style="font-weight: bold; border: 1px solid black; text-align: center;">WAKTU</th>
            <th style="font-weight: bold; border: 1px solid black; text-align: center;">RUANGAN</th>
            <th style="font-weight: bold; border: 1px solid black; text-align: center;">PEMBIMBING 1</th>
            <th style="font-weight: bold; border: 1px solid black; text-align: center;">PEMBIMBING 2</th>
            <th style="font-weight: bold; border: 1px solid black; text-align: center;">PENGUJI 1</th>
            <th style="font-weight: bold; border: 1px solid black; text-align: center;">PENGUJI 2</th>
            <th style="font-weight: bold; border: 1px solid black; text-align: center;">KETUA SIDANG</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($proposals as $proposal)
            <tr>
                <td style="border: 1px solid black; text-align: center;">{{ $loop->iteration }}</td>
                <td style="border: 1px solid black;">{{ $proposal->student->nim }}</td>
                <td style="border: 1px solid black;">{{ $proposal->student->name }}</td>
                <td style="border: 1px solid black;">{{ $proposal->session_date }}</td>
                <td style="border: 1px solid black;">{{ $proposal->session_time }}</td>
                <td style="border: 1px solid black;">{{ $proposal->room->name }}</td>
                <td style="border: 1px solid black;">
                    {{ $proposal->student->lecture1->nidn }}
                    -
                    {{ $proposal->student->lecture1->name }}
                </td>
                <td style="border: 1px solid black;">
                    {{ $proposal->student->lecture2->nidn }}
                    -
                    {{ $proposal->student->lecture2->name }}
                </td>
                <td style="border: 1px solid black;">
                    {{ $proposal->examiner1->nidn }}
                    -
                    {{ $proposal->examiner1->name }}</td>
                <td style="border: 1px solid black;">
                    {{ $proposal->examiner2->nidn }}
                    -
                    {{ $proposal->examiner2->name }}
                </td>
                <td style="border: 1px solid black;">
                    {{ $proposal->moderator->nidn }}
                    -
                    {{ $proposal->moderator->name }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
