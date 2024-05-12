<!DOCTYPE html>
<html lang='fr'>

<head>
  <meta charset='UTF-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
  <!-- JS TAILWINDCSS -->
  <script src='https://cdn.tailwindcss.com'></script>
  <title>$titleMessageMail</title>
</head>

<body>
  <!-- component -->
  <link href='https://fonts.googleapis.com/css2?family=Patrick+Hand:wght@100;200;300;400;500;600;700;800;900&display=swap' rel='stylesheet' />

  <style>
    * {
      font-family: 'Patrick Hand';
    }
  </style>

  <div class='flex items-center justify-center min-h-screen min-w-screen'>
    <!-- HTML -->
    <div class='relative min-w-[400px] max-w-[400px] min-h-[500px] max-h-[500px] border border-black bg-gray-100 drop-shadow-2xl'>

      <!-- TITLE MESSAGE -->
      <h1 class='absolute top-2 text-[18px] font-bold tracking-wider inset-x-0 text-center'>$titleMessageMail</h1>
      <p class='absolute top-[54px] left-2 max-w-[380px] leading-[20.8px] break-all whitespace-break-spaces'>

        $messageMail
        <br />
        <br />
        TeaCoffee.test
      </p>
    </div>
    <!-- END HTML -->
  </div>
</body>

</html>