<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Item extends MY_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_item');
        $this->load->model('m_kategori');
        $this->load->model('m_unit');
    }


    public function index()
    {
    }

    public function get_data()
    {
        $tabel = '';

        $data = $this->m_item->get()->result();

        foreach ($data as $row) {
            $tabel .= '<tr>';
            $tabel .= '<td>' . $row->barcode . '</td>';
            $tabel .= '<td>' . $row->nama_produk . '</td>';
            $tabel .= '<td style="text-align: center;">' . $row->name_unit . '</td>';
            $tabel .= '<td style="text-align: center;">' . indo_currency($row->price) . '</td>';
            $tabel .= '<td>' . $row->stock . '</label>';
            $tabel .= '<td style="text-align:center;">';
            $tabel .= '<button class="btn btn-xs btn-info" id="select" data-id="' . $row->id_item . '" data-barcode="' . $row->barcode . '" data-price="' . $row->price . '" data-stock="' . $row->stock . '"><i class="fa fa-check"></i> Select</button>';
            $tabel .= '</td>';
            $tabel .= '</tr>';
        }

        header('Content-Type: application/json');
        echo json_encode($tabel);
    }

    public function cek_barcode()
    {
        $barcode = $this->input->post('data');
        $cek_data = $this->m_item->cek_data($barcode)->row_array();
        $return_data = ($cek_data) ? "ADA" : "TIDAK ADA";

        header('Content-Type: application/json');
        echo json_encode($return_data);
    }

    public function save()
    {
        $post = $this->input->post();
        if (!empty($_FILES['gambar']['name'])) {
            $config['upload_path']   = './uploads/product/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size']      = 2 * 1024;
            $config['file_name']     = 'Product-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('gambar')) {
                $post['gambar'] =  $this->upload->data('file_name');

                $this->m_item->save($post);
                $this->session->set_flashdata('pesan', 'Data item berhasil ditambah.');
                redirect('item');
            } else {
                $error = array('error' => $this->upload->display_errors());
                $post['gambar'] = "";
                $this->session->set_flashdata('pesan', 'Gambar yang anda upload tidak sesuai, mohon ulangi.');
                redirect('item');
            }
        } else {
            $post['gambar'] = "default.png";
            $this->m_item->save($post);
            $this->session->set_flashdata('pesan', 'Data item berhasil ditambah.');
            redirect('item');
        }
    }

    public function edit()
    {
        $id = $this->input->post('id_item');
        $data = $this->m_item->get($id)->row_array();
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function update()
    {
        $post = $this->input->post();
        if (!empty($_FILES['gambar']['name'])) {
            $config['upload_path']   = './uploads/product/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size']      = 2 * 1024;
            $config['file_name']     = 'Product-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('gambar')) {
                $post['gambar'] =  $this->upload->data('file_name');
                $this->m_item->update($post);
                if ($post['gambar_lama'] != 'default.png') {
                    unlink('./uploads/product/' . $post['gambar_lama']);
                }
                $this->session->set_flashdata('pesan', 'Data item berhasil diupdate.');
                redirect('item');
            } else {
                $error = array('error' => $this->upload->display_errors());
                $post['gambar'] = "";
                $this->session->set_flashdata('error', 'Terjadi kesalahan saat mengupload foto, ulangi kembali');
                redirect('item');
            }
        } else {
            $post['gambar'] = "default.png";
            $this->m_item->update($post);
            $this->session->set_flashdata('pesan', 'Data item berhasil diupdate.');
            redirect('item');
        }
    }

    public function delete()
    {
        $id = $this->input->post('id_item');
        $item = $this->m_item->get($id)->row();

        if ($item->gambar != 'default.png') {
            unlink('./uploads/product/' . $item->gambar);
        }
        $this->m_item->delete($id);

        $this->session->set_flashdata('pesan', 'Data item berhasil di hapus!');
        redirect('item');
    }

    public function barcode_qrcode($id)
    {
        $data['item'] = $this->m_item->get($id)->row();
        $this->template->load('template', 'product/item/barcode_qrcode', $data);
    }

    public function barcode_print($id)
    {
        $data['item'] = $this->m_item->get($id)->row();
        $html = $this->load->view('product/item/barcode_print', $data, true);
        $this->fungsi->PdfGenerator($html, 'barcode-' . $data['item']->barcode, 'A4', 'landscape');
    }
    public function qrcode_print($id)
    {
        $data['item'] = $this->m_item->get($id)->row();
        $html = $this->load->view('product/item/qrcode_print', $data, true);
        // var_dump($html);
        // die();
        $this->fungsi->PdfGenerator($html, 'qrcode-' . $data['item']->barcode, 'A4', 'potrait');
    }
}

/* End of file Item.php */
