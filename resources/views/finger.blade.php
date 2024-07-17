<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fingerprint Capture</title>
</head>
<body>
    <div id="app">
        <button id="captureBtn">Capture Fingerprint</button>
        <p id="status"></p>
        <p id="template"></p>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const captureBtn = document.getElementById('captureBtn');
            const statusElement = document.getElementById('status');
            const templateElement = document.getElementById('template');

            captureBtn.addEventListener('click', async function () {
                try {
                    statusElement.textContent = 'Capturing fingerprint...';

                    // Replace this function with actual fingerprint capture logic using SDK
                    const featureSet = await captureFingerprintFeatures();

                    const response = await fetch('/scanfinger', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({ finger: featureSet }),
                    });

                    const data = await response.json();

                    if (data.template) {
                        statusElement.textContent = 'Fingerprint captured successfully!';
                        templateElement.textContent = 'Fingerprint Template: ' + data.template;
                        console.log('Template:', data.template);
                    } else {
                        statusElement.textContent = 'Error capturing fingerprint';
                        console.error('Error:', data.error);
                    }
                } catch (error) {
                    statusElement.textContent = 'Error capturing fingerprint';
                    console.error('Error:', error);
                }
            });

            async function captureFingerprintFeatures() {
                // Replace this function with actual fingerprint capture logic using SDK
                return {
                    x: 50,
                    y: 60,
                    angle: 45,
                    type: 'ending',
                    timestamp: Date.now() // Example data, ensure no variable data included
                };
            }
        });
    </script>
</body>
</html>
