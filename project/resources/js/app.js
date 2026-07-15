import './bootstrap';
import 'bootstrap';
import $ from 'jquery';

window.$ = $;
window.jQuery = $;

$(function () {
    document.documentElement.classList.add('app-is-ready');

    const scannerModal = document.getElementById('scannerModal');
    const scannerVideo = document.getElementById('scannerVideo');
    const scannerStatus = document.getElementById('scannerStatus');

    if (!scannerModal || !scannerVideo || !scannerStatus) {
        return;
    }

    let scannerStream = null;
    let scannerDetector = null;
    let scannerFrameId = null;
    let scannerIsActive = false;

    const setScannerStatus = (message) => {
        scannerStatus.textContent = message;
    };

    const stopScanner = () => {
        scannerIsActive = false;

        if (scannerFrameId) {
            window.cancelAnimationFrame(scannerFrameId);
            scannerFrameId = null;
        }

        if (scannerStream) {
            scannerStream.getTracks().forEach((track) => track.stop());
            scannerStream = null;
        }

        scannerVideo.pause();
        scannerVideo.srcObject = null;
    };

    const closeScanner = () => {
        stopScanner();
        scannerModal.hidden = true;
        scannerModal.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('scanner-is-open');
        setScannerStatus('Allow camera access to start scanning.');
    };

    const redirectToScan = (rawValue) => {
        if (!rawValue) {
            setScannerStatus('That QR code could not be read. Try again.');
            return;
        }

        stopScanner();
        setScannerStatus('QR code found. Opening clue...');

        try {
            const resolvedUrl = new URL(rawValue, window.location.origin);

            if (!resolvedUrl.pathname.includes('/scan/')) {
                setScannerStatus('That QR code is not a valid store clue. Try another code.');
                return;
            }

            window.location.assign(resolvedUrl.toString());
        } catch (error) {
            setScannerStatus('That QR code link is invalid. Try another code.');
        }
    };

    const scanLoop = async () => {
        if (!scannerIsActive || !scannerDetector) {
            return;
        }

        if (scannerVideo.readyState >= HTMLMediaElement.HAVE_ENOUGH_DATA) {
            try {
                const barcodes = await scannerDetector.detect(scannerVideo);
                const qrCode = barcodes.find((barcode) => barcode.rawValue);

                if (qrCode) {
                    redirectToScan(qrCode.rawValue);
                    return;
                }
            } catch (error) {
                setScannerStatus('We could not read the QR code. Try moving closer and holding steady.');
            }
        }

        scannerFrameId = window.requestAnimationFrame(scanLoop);
    };

    const openScanner = async () => {
        scannerModal.hidden = false;
        scannerModal.setAttribute('aria-hidden', 'false');
        document.body.classList.add('scanner-is-open');

        if (!window.isSecureContext && window.location.hostname !== 'localhost' && window.location.hostname !== '127.0.0.1') {
            setScannerStatus('Camera scanning needs HTTPS on the live site. Please open the secure version of this page.');
            return;
        }

        if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
            setScannerStatus('This browser does not support in-page camera scanning. Please use your phone camera app to scan the QR code.');
            return;
        }

        if (!('BarcodeDetector' in window)) {
            setScannerStatus('This browser can open the camera, but it does not support in-page QR detection. Please use your phone camera app to scan the QR code.');
            return;
        }

        try {
            scannerDetector = new window.BarcodeDetector({ formats: ['qr_code'] });
        } catch (error) {
            setScannerStatus('QR scanning is not available on this browser. Please use your phone camera app to scan the QR code.');
            return;
        }

        try {
            scannerStream = await navigator.mediaDevices.getUserMedia({
                video: {
                    facingMode: { ideal: 'environment' },
                },
                audio: false,
            });

            scannerVideo.srcObject = scannerStream;
            await scannerVideo.play();
            scannerIsActive = true;
            setScannerStatus('Scanning for a store QR code...');
            scannerFrameId = window.requestAnimationFrame(scanLoop);
        } catch (error) {
            setScannerStatus('Camera access was denied or is unavailable. Please allow camera access and try again.');
        }
    };

    $(document).on('click', '[data-open-scanner]', function (event) {
        event.preventDefault();
        openScanner();
    });

    $(document).on('click', '[data-close-scanner]', function () {
        closeScanner();
    });

    $(document).on('keydown', function (event) {
        if (event.key === 'Escape' && !scannerModal.hidden) {
            closeScanner();
        }
    });
});
