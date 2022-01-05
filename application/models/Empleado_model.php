<?php
class Empleado_model extends CI_Model
{

   function __construct()
   {
      parent::__construct();
      $this->load->database('default');
   }

   public function getEmpleado($id = null)
   {

      if ($id === null) {
         $consulta = $this->db->get('empleado');
         return $consulta->result_array();
      } else {
         $query = $this->db->get_where('empleado', array('id' => $id));
         return $query->result_array();
      }
   }

   public function insertEmpleado($fecha_ingreso, $nombre, $salario)
   {

      $data = array(
         'fecha_ingreso' => $fecha_ingreso,
         'nombre' => $nombre,
         'salario' => $salario
      );

      return $this->db->insert('empleado', $data);
   }

   public function setEmpleado($id, $nombre, $fecha_ingreso, $salario)
   {

      $array = array(
         'nombre' => $nombre,
         'fecha_ingreso' => $fecha_ingreso,
         'salario' => $salario
      );

      $this->db->set($array);
      $this->db->where('id', $id);
      return $this->db->update('empleado');
   }

   public function deleteEmpleado($id)
   {
      $this->db->where('id', $id);
      return $this->db->delete('empleado');
   }
}
