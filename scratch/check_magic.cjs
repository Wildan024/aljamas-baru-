const fs = require('fs');
const path = require('path');

const filePath = path.join(__dirname, '..', 'storage', 'app', 'public', 'products', 'kulit-dimsum-premium-special.webp');
const buf = fs.readFileSync(filePath);
console.log('First 16 bytes (hex):', buf.subarray(0, 16).toString('hex'));
console.log('First 16 bytes (ascii):', buf.subarray(0, 16).toString('ascii'));

// Check for JPEG magic: FF D8 FF
const isJpeg = buf[0] === 0xFF && buf[1] === 0xD8 && buf[2] === 0xFF;
// Check for RIFF/WEBP magic: 'RIFF' .... 'WEBP'
const isWebP = buf.subarray(0, 4).toString('ascii') === 'RIFF' && buf.subarray(8, 12).toString('ascii') === 'WEBP';

console.log('Is JPEG binary:', isJpeg);
console.log('Is WebP binary:', isWebP);
