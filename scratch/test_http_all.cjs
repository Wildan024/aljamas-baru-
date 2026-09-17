const http = require('http');

const images = [
    'kulit-dimsum-premium-special.webp',
    'kulit-pangsit-goreng-crispy.webp',
    'kulit-samosa-segar.webp',
    'mie-basah-segar-spesial.webp',
    'kulit-pangsit-rebus-kuah.webp',
    'kulit-dimsum-warna-alami.webp'
];

async function testUrl(filename) {
    return new Promise((resolve) => {
        const url = `http://127.0.0.1:8000/storage/products/${filename}`;
        http.get(url, (res) => {
            let data = [];
            res.on('data', chunk => data.push(chunk));
            res.on('end', () => {
                const buf = Buffer.concat(data);
                const isWebP = buf.subarray(0, 4).toString('ascii') === 'RIFF' && buf.subarray(8, 12).toString('ascii') === 'WEBP';
                console.log(`[${res.statusCode}] ${filename} | Size: ${buf.length} bytes | Content-Type: ${res.headers['content-type']} | Valid WebP Binary: ${isWebP}`);
                resolve(res.statusCode === 200 && isWebP);
            });
        }).on('error', err => {
            console.error(`Error on ${filename}:`, err.message);
            resolve(false);
        });
    });
}

(async () => {
    console.log('--- TESTING ALL 6 IMAGES OVER HTTP ---');
    for (const img of images) {
        await testUrl(img);
    }
})();
