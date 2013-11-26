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

    public function get_timestamp()
    {
        $this->db->select_max('modificationDate');
        $array =  $this->db->get('Product')->result();
        foreach ($array as $row) {
            return $row;
        }
    }

    public function add_product()
    {
        $image_path = $this->get_image_directory() . basename($_FILES['image']['name']);

        if (!move_uploaded_file($_FILES['image']['tmp_name'], $image_path)) {
            exit("There was an error uploading the file, please try again!");
        }

        $data = array(
            'name' => $this->input->post('name'),
            'imageSitePath' => $this->get_image_site_directory() . basename($_FILES['image']['name']),
            'imageFilePath' => $image_path,
            'tpb' => $this->input->post('tpb'),
            'bpc' => $this->input->post('bpc'),
            'prixGrossiste' => $this->input->post('prixGrossiste'),
            'prixFloriste' => $this->input->post('prixFloriste'),
            'isAvailable' => 1,
            'availabilityDate' => "",
        );

        $data = $this->security->xss_clean($data);

        $this->db->insert('Product', $data);
    }

    public function update_product($id)
    {

        $data = array(
            'name' => $this->input->post('name'),
            'tpb' => $this->input->post('tpb'),
            'bpc' => $this->input->post('bpc'),
            'prixGrossiste' => $this->input->post('prixGrossiste'),
            'prixFloriste' => $this->input->post('prixFloriste'),
            'isAvailable' => $this->input->post('isAvailable'),
            'availabilityDate' => $this->input->post('availabilityDate'),
        );

        $data = $this->security->xss_clean($data);

        if (isset($_FILES) && isset($_FILES['image'])) {
            $image_path = $this->get_image_directory() . basename($_FILES['image']['name']);

            if (!move_uploaded_file($_FILES['image']['tmp_name'], $image_path)) {
                echo "There was an error uploading the file, please try again!";
            } else {
                $data['imageFilePath'] = $image_path;
                $data['imageSitePath'] = $this->get_image_site_directory() . basename($_FILES['image']['name']);
            }
        }

        $this->db->where('id', $id);
        $this->db->update('Product', $data);
    }

    public function get_image_directory()
    {
        return "products/";
    }

    public function get_image_site_directory()
    {
        return base_url() . 'products/';
    }

    public function delete_product($id)
    {

        $image = $this->db->select("imageFilePath")->from('Product')->where('id', $id)->get();
        unlink($image);

        $data = array(
            'id' => $id
        );

        $this->db->delete('Product', $data);
    }
}
