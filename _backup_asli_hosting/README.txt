FOLDER BACKUP FILE ORIGINAL HOSTING
====================================
Folder ini berisi salinan file asli sebelum disesuaikan untuk environment lokal.

Isi file:
1. ikutan/config.php     -> Konfigurasi database hosting live (user: iais9713_web, db: iais9713_pmb).
2. thema/cms-template.html -> Template asli dengan base href live.

PETUNJUK UPLOAD KE HOSTING:
- Saat upload perubahan tampilan ke hosting live, file ikutan/config.php di hosting JANGAN DITIMPA.
- Perubahan tampilan umumnya hanya ada di folder `thema/`, `css/`, `images/`, dan view `modul/`.
- File kompatibilitas PHP modern (ikutan/mysqli.php, ikutan/template.php, ikutan/statistik.inc.php, ikutan/fungsi.php) AMAN dan DIREKOMENDASIKAN di-upload ke hosting agar kompatibel dengan PHP 7.4 / 8.x di server.
