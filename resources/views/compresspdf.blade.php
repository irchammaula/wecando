{{-- <!DOCTYPE html>
<html>
<head>
    <title>Hasil Pemeriksaan Dokumen</title>
</head>
<body>
    <p>Halo {{ $customerName }},</p>
    <p>Hasil pemeriksaan dokumen Anda telah selesai. File dokumen hasil pemeriksaan dapat Anda temukan pada lampiran email ini.</p>
    <p>Terima kasih telah menggunakan layanan kami.</p>
    <p>Salam,</p>
    <p>Tim Wecan.do</p>
</body>
</html>
<body class="bg-red-100">
    <div class="container">
      <img class="my-6 w-16" src="" />
      <div class="space-y-4 mb-6">
        <h1 class="text-4xl fw-800">Terimakasih telah menggunakan Aplikasi kami, {{ $customerName }} </h1>
        <p>Hasil pemeriksaan dokumen Anda telah selesai. File dokumen hasil pemeriksaan dapat Anda temukan pada lampiran email ini.</p>
      </div>
      <div class="card rounded-3xl px-4 py-8 p-lg-10 mb-6">
        <h3 class="text-center">Bukti Cek Plagiarisme</h3>
        <p class="text-center text-muted">Receipt #ABCD-EFGH</p>
        <table class="p-2 w-full">
          <tbody>
            <tr>
              <td>Cool Sunglasses</td>
              <td class="text-right">$10.00</td>
            </tr>
            <tr>
              <td>Trucker Hat</td>
              <td class="text-right">$12.00</td>
            </tr>
            <tr>
              <td>Sunflower Seeds</td>
              <td class="text-right">$20.00</td>
            </tr>
            <tr>
              <td class="fw-700 border-top">Amount paid</td>
              <td class="fw-700 text-right border-top">$42.00</td>
            </tr>
          </tbody>
        </table>
        <hr class="my-6">
        <p>If you have any questions, contact us at <a href="https://bootstrapemail.com">HipCorp@example.com</a>.</p>
      </div>
    </div>
  </body> --}}
  <!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Pembelian Cek Plagiarisme</title>
    <style>
        /* CSS untuk responsif email */
        body, table, td, a {
            font-family: Arial, sans-serif;
        }
        table {
            border-spacing: 0;
            width: 100%;
        }
        img {
            max-width: 100%;
        }
        .email-container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .header {
            background-color: #4CAF50;
            color: white;
            padding: 10px 0;
            text-align: center;
            border-radius: 8px;
        }
        .content {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 5px rgba(0,0,0,0.1);
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
        }
        .footer {
            text-align: center;
            font-size: 12px;
            color: #999;
            margin-top: 20px;
        }
        .footer a {
            color: #007BFF;
            text-decoration: none;
        }
    </style>
</head>
<body>

    <div class="email-container">
        <div class="header">
            <h2>Konfirmasi Pembelian Layanan Cek Plagiarisme</h2>
        </div>
        
        <div class="content">
            <h3>Halo, {{ $userName }}!</h3>
            <p>Terima kasih telah menggunakan layanan cek plagiarisme kami. Berikut adalah rincian pesanan Anda:</p>

            <ul>
                <li><strong>Jenis Layanan:</strong> {{ $orderDetails['service'] }}</li>
                <li><strong>Jumlah Cek:</strong> {{ $orderDetails['quantity'] }}</li>
                <li><strong>Total Pembayaran:</strong> Rp {{ number_format($orderDetails['total'], 0, ',', '.') }}</li>
            </ul>
            
            <a href="{{ $orderDetails['link'] }}" class="btn">Lihat Rincian Pembayaran</a>
        </div>

        <div class="footer">
            <p>Jika Anda membutuhkan bantuan lebih lanjut, silakan <a href="mailto:support@wecan.do">hubungi kami</a>.</p>
            <p>&copy; 2024 wecan.do | Semua hak cipta dilindungi.</p>
        </div>
    </div>

</body>
</html>
