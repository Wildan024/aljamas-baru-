import os
from PIL import Image

brain_dir = r"C:\Users\LENOVO\.gemini\antigravity-ide\brain\3cb6d436-fa01-45e4-8e94-6f4de0a4536c"
target_dir1 = os.path.join(os.getcwd(), "storage", "app", "public", "products")
target_dir2 = os.path.join(os.getcwd(), "public", "storage", "products")

mappings = [
    ("kulit_dimsum_wrap_1788330425130.jpg", "kulit-dimsum-premium-special.webp"),
    ("kulit_pangsit_crisp_1788330449323.jpg", "kulit-pangsit-goreng-crispy.webp"),
    ("kulit_samosa_wrap_1788330475856.jpg", "kulit-samosa-segar.webp"),
    ("mie_basah_segar_1788330502589.jpg", "mie-basah-segar-spesial.webp"),
    ("kulit_pangsit_rebus_1788330529231.jpg", "kulit-pangsit-rebus-kuah.webp"),
    ("kulit_dimsum_warna_1788330557491.jpg", "kulit-dimsum-warna-alami.webp"),
]

for src_name, dest_name in mappings:
    src_path = os.path.join(brain_dir, src_name)
    if os.path.exists(src_path):
        img = Image.open(src_path)
        print(f"Converting {src_name} ({img.size}, {img.format}) -> {dest_name} (WEBP)")
        
        dest_path1 = os.path.join(target_dir1, dest_name)
        img.save(dest_path1, "WEBP", quality=92, method=6)
        
        dest_path2 = os.path.join(target_dir2, dest_name)
        img.save(dest_path2, "WEBP", quality=92, method=6)
        
        # Verify output
        out_img = Image.open(dest_path1)
        print(f"  Verified {dest_name}: format={out_img.format}, size={out_img.size}, bytes={os.path.getsize(dest_path1)}")
    else:
        print(f"ERROR: Source not found {src_path}")
