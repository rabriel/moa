import './bootstrap';
import 'bootstrap';
import $ from 'jquery';
import { Html5Qrcode } from 'html5-qrcode';

window.$ = $;
window.jQuery = $;

$(function () {
    document.documentElement.classList.add('app-is-ready');

    const scannerInput = document.getElementById('scannerInput');

    if (!scannerInput) {
        return;
    }

    const html5QrCode = new Html5Qrcode('scannerInputDecoder');

    const redirectToScan = (rawValue) => {
        if (!rawValue) {
            window.alert('That QR code could not be read. Please try again.');
            return;
        }

        try {
            const resolvedUrl = new URL(rawValue, window.location.origin);

            if (!resolvedUrl.pathname.includes('/scan/')) {
                window.alert('That QR code is not a valid store clue. Please try another code.');
                return;
            }

            window.location.assign(resolvedUrl.toString());
        } catch (error) {
            window.alert('That QR code link is invalid. Please try another code.');
        }
    };

    const handleScannerFile = async (file) => {
        if (!file) {
            return;
        }

        try {
            const decodedText = await html5QrCode.scanFile(file, true);
            redirectToScan(decodedText);
        } catch (error) {
            window.alert('We could not read that QR code clearly. Please retake the photo and make sure the QR code fills more of the screen.');
        } finally {
            scannerInput.value = '';
        }
    };

    $(document).on('click', '[data-open-scanner]', function (event) {
        event.preventDefault();
        scannerInput.click();
    });

    $(scannerInput).on('change', function (event) {
        const file = event.target.files && event.target.files[0] ? event.target.files[0] : null;
        handleScannerFile(file);
    });
});
