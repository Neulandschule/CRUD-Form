<?php
require 'vendor/autoload.php';
use Dompdf\Dompdf;

$pdf = new Dompdf();

$html = file_get_contents('page.html');

$pdf->loadHtml($html);
$pdf->setPaper('A4', 'portrait');
$pdf->render();

$pdf->stream('test', array("Attachment"=>0));
//$output = $pdf->output();
//file_put_contents("file.pdf", $output);

?>


<!--
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        h1 {
            background-color: yellow;
            color: red;
        }

        .page-break {
            page-break-before: always;
        }
    </style>
</head>

<body>
    <h1>Heading</h1>
    <p>Text</p>

    <table>
        <tr>
            <td>Emil</td>
            <td>Tobias</td>
            <td>Linus</td>
        </tr>
        <tr>
            <td>16</td>
            <td>14</td>
            <td>10</td>
        </tr>
    </table>

    <ul>
        <li>Coffee</li>
        <li>Tea</li>
        <li>Milk</li>
    </ul>

    <a href="https://google.com/">Google</a>

    <div class="page-break"></div>

    <p>Das ist Seite 2</p>

</body>

</html>



-->