<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Fingerprint Hash Calculation</title>
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>
</head>
<body>
<h1>Fingerprint Hash Calculation</h1>
<input type="file" id="fingerprintInput" accept="image/png">
<p id="output"></p>

<script>
document.getElementById('fingerprintInput').addEventListener('change', handleFileSelect, false);

function handleFileSelect(event) {
    const file = event.target.files[0];
    if (!file) {
        return;
    }

    const reader = new FileReader();
    reader.onload = function(e) {
        const arrayBuffer = e.target.result;
        const byteArray = new Uint8Array(arrayBuffer);

        // حساب التجزئة باستخدام CryptoJS SHA-256
        const hash = CryptoJS.SHA256(CryptoJS.lib.WordArray.create(byteArray));
        const hashHex = hash.toString(CryptoJS.enc.Hex);

        document.getElementById('output').innerText = 'SHA-256 Hash: ' + hashHex;
    };
    reader.readAsArrayBuffer(file);
}
</script>
</body>
</html>


<!-- <!DOCTYPE html>
<html>
<head>
    <title>Fingerprint Processing</title>
    <script src="https://unpkg.com/pica/dist/pica.min.js"></script>
</head>
<body>
    <h1>Fingerprint Processing</h1>
    <input type="file" id="fingerprintInput" accept="image/png">
    <p id="output"></p>
    <button id="submitBtn" disabled>Submit to Server</button>

    <script>
        document.getElementById('fingerprintInput').addEventListener('change', handleFileSelect, false);
        document.getElementById('submitBtn').addEventListener('click', submitToServer, false);

        let hashHex = '';

        function handleFileSelect(event) {
            const file = event.target.files[0];
            if (!file) {
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                const img = new Image();
                img.onload = function() {
                    const canvas = document.createElement('canvas');
                    const ctx = canvas.getContext('2d');
                    canvas.width = 256;
                    canvas.height = 256;
                    pica().resize(img, canvas)
                        .then(result => pica().toBlob(result, 'image/png', 0.90))
                        .then(blob => {
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                const arrayBuffer = e.target.result;
                                const byteArray = new Uint8Array(arrayBuffer);

                                // حساب تجزئة SHA-256
                                crypto.subtle.digest('SHA-256', byteArray).then(hashBuffer => {
                                    const hashArray = Array.from(new Uint8Array(hashBuffer));
                                    hashHex = hashArray.map(b => b.toString(16).padStart(2, '0')).join('');
                                    document.getElementById('output').innerText = 'Unique code: ' + hashHex;
                                    document.getElementById('submitBtn').disabled = false;
                                }).catch(err => {
                                    console.error('Error calculating hash:', err);
                                });
                            };
                            reader.readAsArrayBuffer(blob);
                        });
                };
                img.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }

        function submitToServer() {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', '/store-fingerprint', true);
            xhr.setRequestHeader('Content-Type', 'application/json;charset=UTF-8');
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    alert('Fingerprint hash stored successfully');
                }
            };
            xhr.send(JSON.stringify({ fingerprint_hash: hashHex }));
        }
    </script>
</body>
</html> -->


<!-- <!DOCTYPE html>
<html>
<head>
    <title>Fingerprint Processing</title>
</head>
<body>
    <h1>Fingerprint Processing</h1>
    <input type="file" id="fingerprintInput" accept="image/png">
    <p id="output"></p>

    <script>
        document.getElementById('fingerprintInput').addEventListener('change', handleFileSelect, false);

        function handleFileSelect(event) {
            const file = event.target.files[0];
            if (!file) {
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                const arrayBuffer = e.target.result;
                const byteArray = new Uint8Array(arrayBuffer);

                // حساب تجزئة SHA-256
                crypto.subtle.digest('SHA-256', byteArray).then(hashBuffer => {
                    const hashArray = Array.from(new Uint8Array(hashBuffer));
                    const hashHex = hashArray.map(b => b.toString(16).padStart(2, '0')).join('');
                    document.getElementById('output').innerText = 'Unique code: ' + hashHex;
                });
            };
            reader.readAsArrayBuffer(file);
        }
    </script>
</body>
</html> -->