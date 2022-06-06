<?php
class Model_email extends CI_Model
{
  public function getAll()
  {
    return $this->db->query(
      "SELECT
        *
      FROM smtp_mail
      "
    )->row();
  }
}
