<?php
class Solicitud_model extends CI_Model
{

  function __construct()
  {
    parent::__construct();
    $this->load->database('default');
  }

  public function getSolicitud($id = null)
  {

    if ($id === null) {
      $this->db->select('aa.id, aa.codigo, aa.descripcion, aa.resumen, bb.nombre AS empleado');
      $this->db->from('solicitud aa');
      $this->db->join('empleado bb', 'bb.id = aa.id_empleado');
      $consulta = $this->db->get();
      return $consulta->result_array();
    } else {
      $query = $this->db->get_where('solicitud', array('id' => $id));
      return $query->result_array();
    }
  }

  public function insertSolicitud($codigo, $descripcion, $resumen, $id_empleado)
  {

    $data = array(
      'codigo' => $codigo,
      'descripcion' => $descripcion,
      'resumen' => $resumen,
      'id_empleado' => $id_empleado
    );

    return $this->db->insert('solicitud', $data);
  }

  public function setSolicitud($id, $codigo, $descripcion, $resumen, $id_empleado)
  {

    $array = array(
      'codigo' => $codigo,
      'descripcion' => $descripcion,
      'resumen' => $resumen,
      'id_empleado' => $id_empleado
    );

    $this->db->set($array);
    $this->db->where('id', $id);
    return $this->db->update('solicitud');
  }

  public function deleteSolicitud($id)
  {
    $this->db->where('id', $id);
    return $this->db->delete('solicitud');
  }
}
