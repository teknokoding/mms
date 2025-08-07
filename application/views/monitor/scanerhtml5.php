<style>
#reader {
    width: 400px;
}

.row {
    display: flex;
}

#reader__scan_region {
    background: white;
}
</style>
<!-- QR SCANNER CODE BELOW  -->
<div class="row">
    <div class="col">
        <div id="reader"></div>
    </div>
</div>
<script src="<?= base_url();?>assets/dist/js/html5-qrcode.min.js"></script>
<script>
// When scan is successful fucntion will produce data
function onScanSuccess(qrCodeMessage) {
   alert('Berhasil membaca QR, klik OK untuk melanjutkan');
    window.location.href=qrCodeMessage;
}

// When scan is unsuccessful fucntion will produce error message
function onScanError(errorMessage) {
    // Handle Scan Error
}

// Setting up Qr Scanner properties
var html5QrCodeScanner = new Html5QrcodeScanner("reader", {
    fps: 10,
    qrbox: 250
});

// in
html5QrCodeScanner.render(onScanSuccess, onScanError);
</script>