import './bootstrap';
import 'bootstrap';
import $ from 'jquery';
import { Html5Qrcode } from 'html5-qrcode';

window.$ = $;
window.jQuery = $;

$(function () {
    document.documentElement.classList.add('app-is-ready');

    const scannerModal = document.getElementById('scannerModal');
    const scannerReader = document.getElementById('scannerReader');
    const scannerStatus = document.getElementById('scannerStatus');

    if (!scannerModal || !scannerReader || !scannerStatus) {
        return;
    }

    let html5QrCode = null;
    let scannerIsActive = false;

    const setScannerStatus = (message) => {
        scannerStatus.textContent = message;
    };

    const stopScanner = async () => {
        scannerIsActive = false;

        if (html5QrCode) {
            try {
                if (html5QrCode.isScanning) {
                    await html5QrCode.stop();
                }
            } catch (error) {
                // If stop fails, continue cleanup so the user is not trapped in the modal.
            }

            try {
                await html5QrCode.clear();
            } catch (error) {
                // Ignore clear failures during teardown.
            }
        }
    };

    const closeScanner = async () => {
        await stopScanner();
        scannerModal.hidden = true;
        scannerModal.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('scanner-is-open');
        setScannerStatus('Allow camera access to start scanning.');
    };

    const redirectToScan = async (rawValue) => {
        if (!rawValue) {
            setScannerStatus('That QR code could not be read. Try again.');
            return;
        }

        try {
            const resolvedUrl = new URL(rawValue, window.location.origin);

            if (!resolvedUrl.pathname.includes('/scan/')) {
                setScannerStatus('That QR code is not a valid store clue. Try another code.');
                return;
            }

            await closeScanner();
            window.location.assign(resolvedUrl.toString());
        } catch (error) {
            setScannerStatus('That QR code link is invalid. Try another code.');
        }
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

        if (!html5QrCode) {
            html5QrCode = new Html5Qrcode('scannerReader');
        }

        try {
            scannerIsActive = true;
            setScannerStatus('Scanning for a store QR code...');

            await html5QrCode.start(
                { facingMode: 'environment' },
                {
                    fps: 10,
                    qrbox: { width: 220, height: 220 },
                    aspectRatio: 1,
                },
                (decodedText) => {
                    if (scannerIsActive) {
                        redirectToScan(decodedText);
                    }
                },
                () => {
                    if (scannerIsActive) {
                        setScannerStatus('Scanning for a store QR code...');
                    }
                }
            );
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
