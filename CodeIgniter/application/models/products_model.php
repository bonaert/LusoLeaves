<?php

class Products_model extends CI_MODEL
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_products($id = FALSE)
    {
        if ($id === FALSE) {
            $query = $this->db->get('Product');
            return $query->result_array();
        }

        $query = $this->db->get_where('Product', array('id' => $id));
        return $query->row_array();
    }

    public function add_product()
    {

        $target_path = "products/";
        $target_path = $target_path . basename($_FILES['image']['name']);

        if (!move_uploaded_file($_FILES['image']['tmp_name'], $target_path)) {
            echo "There was an error uploading the file, please try again!";
        }

        $data = array(
            'name' => $this->input->post('name'),
            'image' => $target_path,
            'prixunite' => $this->input->post('prixunite'),
            'tpb' => $this->input->post('tpb'),
            'bpc' => $this->input->post('bpc'),
            'prixGrossiste' => $this->input->post('prixGrossiste'),
            'prixFloriste' => $this->input->post('prixFloriste')
        );

        $this->db->insert('Product', $data);
    }

    public function update_product($id)
    {

        $data = array(
            'name' => $this->input->post('name'),
            'prixunite' => $this->input->post('prixunite'),
            'tpb' => $this->input->post('tpb'),
            'bpc' => $this->input->post('bpc'),
            'prixGrossiste' => $this->input->post('prixGrossiste'),
            'prixFloriste' => $this->input->post('prixFloriste')
        );

        if ($this->input->post('image')) {
            $target_path = "products/";
            $target_path = $target_path . basename($_FILES['image']['name']);

            if (!move_uploaded_file($_FILES['image']['tmp_name'], $target_path)) {
                echo "There was an error uploading the file, please try again!";
            } else {
                $data['image'] = $target_path;
            }
        }

        $this->db->where('id', $id);
        $this->db->update('Product', $data);
    }

    public function delete_product($id)
    {

        $image = $this->db->select("image")->from('Product')->where('id', $id)->get();
        echo $image;
        unlink($image);

        $data = array(
            'id' => $id
        );

        $this->db->delete('Product', $data);
    }
}