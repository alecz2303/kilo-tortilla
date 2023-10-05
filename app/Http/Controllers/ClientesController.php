<?php

namespace App\Http\Controllers;

use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Http\Request;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Writer\ValidationException;

class ClientesController extends \TCG\Voyager\Http\Controllers\VoyagerBaseController
{
    public function show(Request $request, $id)
    {
        $hashId =Hashids::encode($id);
        $x = Hashids::encode(1);
        echo $hashId;
        echo "<br>".$x;

        $writer = new PngWriter();

        // Create QR code
        $qrCode = QrCode::create('Life is too short to be generating QR codes')
            ->setEncoding(new Encoding('UTF-8'))
            ->setErrorCorrectionLevel(ErrorCorrectionLevel::Low)
            ->setSize(300)
            ->setMargin(10)
            ->setRoundBlockSizeMode(RoundBlockSizeMode::Margin)
            ->setForegroundColor(new Color(0, 0, 0))
            ->setBackgroundColor(new Color(255, 255, 255));

        // Create generic logo
        $logo = Logo::create(__DIR__.'/assets/symfony.png')
            ->setResizeToWidth(50)
            ->setPunchoutBackground(true)
        ;

        // Create generic label
        $label = Label::create('Label')
            ->setTextColor(new Color(255, 0, 0));

        $result = $writer->write($qrCode, $logo, $label);

        // Validate the result
        $writer->validateResult($result, 'Life is too short to be generating QR codes');

        return $writer;


    }
}
