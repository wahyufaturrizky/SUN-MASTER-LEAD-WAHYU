<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> 
    <title>Document</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>kode_prop</th>
                <th>propinsi</th>
                <th>kode_kab_kota</th>
                <th>kabupaten_kota</th>
                <th>kode_kec</th>
                <th>kecamatan</th>
                <th>id</th>
                <th>npsn</th>
                <th>sekolah</th>
                <th>bentuk</th>
                <th>status</th>
                <th>alamat_jalan</th>
                <th>lintang</th>
                <th>bujur</th>
            </tr>
        <thead>
        <tbody>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        <tbody>
    </table>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $.ajax({
                url: 'http://jendela.data.kemdikbud.go.id/api/index.php/Csekolah/detailSekolahGET?mst_kode_wilayah=120200',
                success: function(data){
                    console.log(data);
                },
            });
        });
    </script>
</body>
</html>