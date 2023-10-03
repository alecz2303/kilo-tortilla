@extends('voyager::master')

@section('page_header')
    <div class="container-fluid">
        <h1 class="page-title">
            <i class="voyager-wand"></i> Escanear Código QR
        </h1>
        
    </div>
@stop

@section('content')
<div class="page-content browse container-fluid">
    @include('voyager::alerts')
    <div class="row">
        <div class="col-md-12">
            <div class="page-content">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <div class="row-element-set row-element-set-QRScanner">
    <!-- RECOMMENDED if your web app will not function without JavaScript enabled -->
    <noscript>
      <div class="row-element-set error_message">
        Your web browser must have JavaScript enabled
        in order for this application to display correctly.
      </div>
    </noscript>
    <div class="row-element-set error_message" id="secure-connection-message" style="display: none;" hidden >
      You may need to serve this page over a secure connection (https) to run JsQRScanner correctly.
    </div>
    <script> 
    if (location.protocol != 'https:') { 
      document.getElementById('secure-connection-message').style='display: block';
      }
      </script>  

      <h1>JsQRScanner example</h1>
      <div class="row-element">
        <div class="FlexPanel detailsPanel QRScannerShort">
          <div class="FlexPanel shortInfoPanel">
            <div class="gwt-HTML">
              Point the webcam to a QR code.
            </div>
          </div>
        </div>
      </div>
      <br>
      <div class="row-element">
        <div class="qrscanner" id="scanner">
        </div>
      </div>
      <div class="row-element">
        <div class="form-field form-field-memo">
          <div class="form-field-caption-panel">
            <div class="gwt-Label form-field-caption">
              Scanned text
            </div>
          </div>
          <div class="FlexPanel form-field-input-panel">
            <textarea id="scannedTextMemo" class="textInput form-memo form-field-input textInput-readonly" rows="3" readonly>
            </textarea>
          </div>
        </div>
        <div class="form-field form-field-memo">
          <div class="form-field-caption-panel">
            <div class="gwt-Label form-field-caption">
              Scanned text history
            </div>
          </div>
          <div class="FlexPanel form-field-input-panel">
            <textarea id="scannedTextMemoHist" class="textInput form-memo form-field-input textInput-readonly" value="" rows="6" readonly>
            </textarea>
          </div>
        </div>
      </div>
      <br>
      <a style="font-weight: bold;" href="https://github.com/jbialobr/JsQRScanner">The source code is hosted on GitHub</a>
    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('javascript')

	<script type="text/javascript">
    function onQRCodeScanned(scannedText)
    {
    	var scannedTextMemo = document.getElementById("scannedTextMemo");
    	if(scannedTextMemo)
    	{
    		scannedTextMemo.value = scannedText;
    	}
    	alert (scannedText);
    	window.location.href = scannedText;
    	var scannedTextMemoHist = document.getElementById("scannedTextMemoHist");
    	if(scannedTextMemoHist)
    	{
    		scannedTextMemoHist.value = scannedTextMemoHist.value + '\n' + scannedText;
    	}
    }
    
    function provideVideo()
    {
        var n = navigator;

        if (n.mediaDevices && n.mediaDevices.getUserMedia)
        {
          return n.mediaDevices.getUserMedia({
            video: {
              facingMode: "environment"
            },
            audio: false
          });
        } 
        
        return Promise.reject('Your browser does not support getUserMedia');
    }

    function provideVideoQQ()
    {
        return navigator.mediaDevices.enumerateDevices()
        .then(function(devices) {
            var exCameras = [];
            devices.forEach(function(device) {
            if (device.kind === 'videoinput') {
              exCameras.push(device.deviceId)
            }
         });
            
            return Promise.resolve(exCameras);
        }).then(function(ids){
            if(ids.length === 0)
            {
              return Promise.reject('Could not find a webcam');
            }
            
            return navigator.mediaDevices.getUserMedia({
                video: {
                  'optional': [{
                    'sourceId': ids.length === 1 ? ids[0] : ids[1]//this way QQ browser opens the rear camera
                    }]
                }
            });        
        });                
    }
    
    //this function will be called when JsQRScanner is ready to use
    function JsQRScannerReady()
    {
        //create a new scanner passing to it a callback function that will be invoked when
        //the scanner succesfully scan a QR code
        var jbScanner = new JsQRScanner(onQRCodeScanned);
        //var jbScanner = new JsQRScanner(onQRCodeScanned, provideVideo);
        //reduce the size of analyzed image to increase performance on mobile devices
        jbScanner.setSnapImageMaxSize(300);
    	var scannerParentElement = document.getElementById("scanner");
    	if(scannerParentElement)
    	{
    	    //append the jbScanner to an existing DOM element
    		jbScanner.appendTo(scannerParentElement);
    	}        
    }
  </script>    

@stop

@section('head')

	<script type="text/javascript" src="js/jsqrscanner.nocache.js"></script>

@stop