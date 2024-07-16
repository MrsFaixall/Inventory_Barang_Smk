const express = require('express');
const app = express();
const bodyParser = require('body-parser');
const mysql = require('mysql');

app.use(bodyParser.json());

const pool = mysql.createPool({
  connectionLimit: 10,
  host: 'localhost',
  user: 'root',
  password: '',
  database: 'inventory',
  port: 3306,
});

app.post('/search', async (req, res) => {
  const { query } = req.body;
  try {
    const results = await searchDatabase(query);
    res.json(results);
  } catch (err) {
    res.status(500).send(err.toString());
  }
});

async function searchDatabase(query) {
  const searchQuery = `
    SELECT 'aset_sekolah' as source, id_aset, nama_aset, CONCAT('/page1/', id_aset) as url FROM aset_sekolah WHERE nama_aset LIKE ?
    UNION ALL
    SELECT 'ruangpembelajaran' as source, id_ruang, nama_barang, CONCAT('/page2/', id_ruang) as url FROM ruangpembelajaran WHERE nama_barang LIKE ?
    UNION ALL
    SELECT 'alat_dapur' as source, id_dapur, nama_dapur, CONCAT('/page3/', id_dapur) as url FROM alat_dapur WHERE nama_dapur LIKE ?
    UNION ALL
    SELECT 'alat_dingin' as source, id_dingin, nama_dingin, CONCAT('/page3/', id_dingin) as url FROM alat_dingin WHERE nama_dingin LIKE ?
    UNION ALL
    SELECT 'alat_kantor' as source, id_alatkantor, nama_kantor, CONCAT('/page3/', id_alatkantor) as url FROM alat_kantor WHERE nama_kantor LIKE ?
    UNION ALL
    SELECT 'jaringan' as source, id_jaringan, nama_jaringan, CONCAT('/page3/', id_jaringan) as url FROM jaringan WHERE nama_jaringan LIKE ?
    UNION ALL
    SELECT 'kebersihan' as source, id_bersih, nama_bersih, CONCAT('/page3/', id_bersih) as url FROM kebersihan WHERE nama_bersih LIKE ?
    UNION ALL
    SELECT 'komunikasi' as source, id_komu, nama_komu, CONCAT('/page3/', id_komu) as url FROM komunikasi WHERE nama_komu LIKE ?
    UNION ALL
    SELECT 'mebe' as source, id_aset, nama_aset, CONCAT('/page3/', id_aset) as url FROM mebe WHERE nama_aset LIKE ?
    UNION ALL
    SELECT 'olahraga' as source, id_olahraga, nama_olahraga, CONCAT('/page3/', id_olahraga) as url FROM olahraga WHERE nama_olahraga LIKE ?
    UNION ALL
    SELECT 'penunjang' as source, id_penunjang, nama_barang, CONCAT('/page3/', id_penunjang) as url FROM penunjang WHERE nama_barang LIKE ?
    UNION ALL
    SELECT 'penyimpanan' as source, id_penyimpan, nama_penyimpan, CONCAT('/page3/', id_penyimpan) as url FROM penyimpanan WHERE nama_penyimpan LIKE ?
    UNION ALL
    SELECT 'tanaman' as source, id_tanaman, nama_tanaman, CONCAT('/page3/', id_tanaman) as url FROM tanaman WHERE nama_tanaman LIKE ?
    UNION ALL
    SELECT 'uks' as source, id_uks, nama_uks, CONCAT('/page3/', id_uks) as url FROM uks WHERE nama_uks LIKE ?
  `;

  const params = Array(15).fill(`%${query}%`);
  const queryResult = await new Promise((resolve, reject) => {
    pool.query(searchQuery, params, (err, rows) => {
      if (err) reject(err);
      else resolve(rows);
    });
  });

  return queryResult;
}

app.listen(3000, () => {
  console.log('Server is running on port 3000');
});
