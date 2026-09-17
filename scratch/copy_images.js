const fs = require('fs');
const path = require('path');

const brainDir = 'C:\\Users\\LENOVO\\.gemini\\antigravity-ide\\brain\\3cb6d436-fa01-45e4-8e94-6f4de0a4536c';
const targetDir1 = path.join(__dirname, 'storage', 'app', 'public', 'products');
const targetDir2 = path.join(__dirname, 'public', 'storage', 'products');

[targetDir1, targetDir2].forEach(dir => {
    if (!fs.existsSync(dir)) {
        fs.mkdirSync(dir, { recursive: true });
    }
});

const fileMappings = [
    { src: 'kulit_dimsum_wrap_1788330425130.jpg', dest: 'kulit-dimsum-premium-special.webp' },
    { src: 'kulit_dimsum_wrap_1788330425130.jpg', dest: 'kulit-dimsum-premium-special.jpg' },
    { src: 'kulit_pangsit_crisp_1788330449323.jpg', dest: 'kulit-pangsit-goreng-crispy.webp' },
    { src: 'kulit_pangsit_crisp_1788330449323.jpg', dest: 'kulit-pangsit-goreng-crispy.jpg' },
    { src: 'kulit_samosa_wrap_1788330475856.jpg', dest: 'kulit-samosa-segar.webp' },
    { src: 'kulit_samosa_wrap_1788330475856.jpg', dest: 'kulit-samosa-segar.jpg' },
    { src: 'mie_basah_segar_1788330502589.jpg', dest: 'mie-basah-segar-spesial.webp' },
    { src: 'mie_basah_segar_1788330502589.jpg', dest: 'mie-basah-segar-spesial.jpg' },
    { src: 'kulit_pangsit_rebus_1788330529231.jpg', dest: 'kulit-pangsit-rebus-kuah.webp' },
    { src: 'kulit_pangsit_rebus_1788330529231.jpg', dest: 'kulit-pangsit-rebus-kuah.jpg' },
    { src: 'kulit_dimsum_warna_1788330557491.jpg', dest: 'kulit-dimsum-warna-alami.webp' },
    { src: 'kulit_dimsum_warna_1788330557491.jpg', dest: 'kulit-dimsum-warna-alami.jpg' }
];

fileMappings.forEach(mapping => {
    const srcPath = path.join(brainDir, mapping.src);
    if (fs.existsSync(srcPath)) {
        const dest1 = path.join(targetDir1, mapping.dest);
        const dest2 = path.join(targetDir2, mapping.dest);
        fs.copyFileSync(srcPath, dest1);
        try { fs.copyFileSync(srcPath, dest2); } catch (e) {}
        console.log(`Copied ${mapping.src} -> ${mapping.dest}`);
    } else {
        console.error(`Source not found: ${srcPath}`);
    }
});
