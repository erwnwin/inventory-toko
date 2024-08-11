<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_item extends CI_Model
{

    public function get($id = null)
    {
        $this->db->select('produk_item.*, produk_item.stock,  produk_category.nama_kategori as name_category, produk_unit.nama_unit as name_unit');
        $this->db->from('produk_item');
        $this->db->join('produk_category', 'produk_item.id_kategori = produk_category.id_kategori');
        $this->db->join('produk_unit', 'produk_item.id_unit = produk_unit.id_unit');
        if ($id != null) {
            $this->db->where('id_item', $id);
        }
        $this->db->order_by('barcode', 'ASC');
        $query = $this->db->get();
        return $query;
    }


    public function get_filter($id = null)
    {
        $this->db->select('produk_item.*, produk_item.stock, produk_category.nama_kategori as name_category, produk_unit.nama_unit as name_unit');
        $this->db->from('produk_item');
        $this->db->join('produk_category', 'produk_item.id_kategori = produk_category.id_kategori');
        $this->db->join('produk_unit', 'produk_item.id_unit = produk_unit.id_unit');
        if ($id != null) {
            $this->db->where('id_item', $id);
        }
        $this->db->order_by('barcode', 'ASC');
        $query = $this->db->get();
        return $query->result_array(); // Mengembalikan data sebagai array
    }

    public function get_filter2($id = null)
    {
        // Menentukan kolom yang akan diambil dari tabel
        $this->db->select('produk_item.*, produk_item.stock, produk_category.nama_kategori as name_category, produk_unit.nama_unit as name_unit');

        // Menentukan tabel utama
        $this->db->from('produk_item');

        // Menggabungkan tabel lain
        $this->db->join('produk_category', 'produk_item.id_kategori = produk_category.id_kategori');
        $this->db->join('produk_unit', 'produk_item.id_unit = produk_unit.id_unit');

        // Jika ID produk diterima, tambahkan kondisi WHERE
        if ($id != null) {
            $this->db->where('produk_item.id_item', $id); // Menentukan ID item dari tabel produk_item
        }

        // Mengurutkan data berdasarkan barcode
        $this->db->order_by('produk_item.barcode', 'ASC');

        // Menjalankan query dan mendapatkan hasil
        $query = $this->db->get();

        // Mengembalikan hasil query sebagai array
        return $query->result_array();
    }

    public function save_data($data)
    {
        return $this->db->insert('produk_item', $data);
    }

    public function insert_image($gambar, $barcode, $nama_produk, $id_kategori, $id_unit, $price)
    {
        $data = array(
            'gambar' => $gambar,
            'barcode' => $barcode,
            'nama_produk' => $nama_produk,
            'id_kategori' => $id_kategori,
            'id_unit' => $id_unit,
            'price' => $price,
            'created' => date('Y-m-d H:i:s')
        );
        $this->db->insert('produk_item', $data);
        return $this->db->insert_id();
    }

    // public function save($post)
    // {
    //     $data = [
    //         'barcode' => $post['barcode'],
    //         'nama_produk' => $post['nama_produk'],
    //         'id_kategori' => $post['id_kategori'],
    //         'id_unit' => $post['id_unit'],
    //         'price' => $post['price'],
    //         'gambar' => $post['gambar']
    //     ];

    //     $this->db->insert('produk_item', $data);
    // }

    // public function update($post)
    // {
    //     $data = [
    //         'barcode' => $post['barcode'],
    //         'name' => $post['nama_produk'],
    //         'id_kategori' => $post['category'],
    //         'id_unit' => $post['id_unit'],
    //         'price' => $post['price'],
    //         'gambar' => $post['gambar'],
    //         'updated' => date('Y-m-d H:i:s')
    //     ];

    //     $this->db->where('id_item', $this->input->post('id_item'));
    //     $this->db->update('produk_item', $data);
    // }

    public function cek_data($barcode)
    {
        $this->db->select();
        $this->db->from('produk_item');
        $this->db->where('barcode', $barcode);
        $query = $this->db->get();
        return $query;
    }

    public function delete($id)
    {
        $this->db->where('id_item', $id);
        $this->db->delete('produk_item');
    }

    public function update_stock_in($data)
    {
        $qty = $data['qty'];
        $id = $data['id_item'];
        $sql = "UPDATE produk_item SET stock = stock + '$qty' WHERE id_item = '$id'";
        $this->db->query($sql);
    }

    public function update_stock_out($data)
    {
        $qty = $data['qty'];
        $id = $data['id_item'];
        $sql = "UPDATE produk_item SET stock = stock - '$qty' WHERE id_item = '$id'";
        $this->db->query($sql);
    }

    // public function update_stock_out_new($data)
    // {
    //     $this->db->where('id_item', $data['id_item']);
    //     $this->db->update('produk_item', array('stock' => $data['qty']));

    //     // Return the number of affected rows
    //     return $this->db->affected_rows();
    // }


    // kode otomatis
    public function generate_product_code()
    {
        // Logic to generate product code (e.g., incrementing number)
        $query = $this->db->query("SELECT MAX(barcode) AS max_code FROM produk_item");
        $row = $query->row();
        $max_code = $row->max_code;

        if ($max_code) {
            $last_number = (int) substr($max_code, -4);
            $new_number = $last_number + 1;
            $new_code = 'OPFDH#' . sprintf('%04d', $new_number);
        } else {
            // If no existing product codes, start from PRD-0001
            $new_code = 'OPFDH#0001';
        }

        return $new_code;
    }

    public function get_stock($id_item)
    {
        $this->db->select('stock');
        $this->db->from('produk_item'); // Ganti dengan nama tabel item Anda
        $this->db->where('id_item', $id_item);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->stock; // Mengembalikan nilai stok
        } else {
            return 0; // Jika item tidak ditemukan, kembalikan 0
        }
    }

    // Mendapatkan item dengan detail dan join
    public function get_all_items($id = null)
    {
        $this->db->select('produk_item.*, produk_item.stock, produk_category.nama_kategori as name_category, produk_unit.nama_unit as name_unit');
        $this->db->from('produk_item');
        $this->db->join('produk_category', 'produk_item.id_kategori = produk_category.id_kategori');
        $this->db->join('produk_unit', 'produk_item.id_unit = produk_unit.id_unit');

        // Jika ID tidak null, tambahkan kondisi WHERE
        if ($id !== null) {
            $this->db->where('produk_item.id_item', $id);
        }

        $this->db->order_by('produk_item.barcode', 'ASC');
        $query = $this->db->get();

        // Jika ID disediakan, kembalikan baris tunggal, jika tidak kembalikan array hasil
        if ($id !== null) {
            return $query->row_array(); // Kembalikan data item yang spesifik
        } else {
            return $query->result_array(); // Kembalikan semua data item
        }
    }
}
