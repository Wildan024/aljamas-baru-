const fs = require('fs');
const path = require('path');
const http = require('http');

console.log('--- STORAGE INSPECTION ---');
const storageAppPublic = path.join(__dirname, '..', 'storage', 'app', 'public');
const publicStorage = path.join(__dirname, '..', 'public', 'storage');

console.log('storage/app/public exists:', fs.existsSync(storageAppPublic));
console.log('public/storage exists:', fs.existsSync(publicStorage));

try {
    const lstat = fs.lstatSync(publicStorage);
    console.log('public/storage isSymbolicLink:', lstat.isSymbolicLink());
    console.log('public/storage isDirectory:', lstat.isDirectory());
    if (lstat.isSymbolicLink()) {
        console.log('public/storage target:', fs.readlinkSync(publicStorage));
    }
} catch (e) {
    console.error('Error lstat public/storage:', e.message);
}

const productsDir1 = path.join(storageAppPublic, 'products');
const productsDir2 = path.join(publicStorage, 'products');

console.log('storage/app/public/products files:');
if (fs.existsSync(productsDir1)) {
    fs.readdirSync(productsDir1).forEach(f => {
        const stat = fs.statSync(path.join(productsDir1, f));
        console.log(`  - ${f} (${stat.size} bytes)`);
    });
} else {
    console.log('  NOT FOUND');
}

console.log('public/storage/products files:');
if (fs.existsSync(productsDir2)) {
    fs.readdirSync(productsDir2).forEach(f => {
        const stat = fs.statSync(path.join(productsDir2, f));
        console.log(`  - ${f} (${stat.size} bytes)`);
    });
} else {
    console.log('  NOT FOUND');
}

console.log('\n--- TESTING HTTP GET http://127.0.0.1:8000/storage/products/kulit-dimsum-premium-special.webp ---');
const req = http.get('http://127.0.0.1:8000/storage/products/kulit-dimsum-premium-special.webp', res => {
    console.log('HTTP Status Code:', res.statusCode);
    console.log('Headers:', res.headers);
    let data = [];
    res.on('data', chunk => data.push(chunk));
    res.on('end', () => {
        const buffer = Buffer.concat(data);
        console.log('Response body length:', buffer.length);
        if (res.statusCode !== 200) {
            console.log('Response body:', buffer.toString('utf8').substring(0, 300));
        }
    });
});
req.on('error', err => {
    console.error('HTTP Request Error:', err.message);
});
