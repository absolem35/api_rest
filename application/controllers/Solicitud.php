<?php

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

class Solicitud extends REST_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model("Solicitud_model");
  }

  //saca todos los usuarios en json

  public function solicitud_get($id = null)
  {
    $solicitudes = $this->Solicitud_model->getSolicitud($id);

    if (!is_null($solicitudes)) {
      $this->response(array('data' => $solicitudes), 200);
    } else {
      $this->response(NULL);
    }
  }

  public function solicitud_post()
  {

    $codigo = $this->post('codigo');
    $descripcion = $this->post('descripcion');
    $resumen = $this->post('resumen');
    $id_empleado = $this->post('id_empleado');

    $result = $this->Solicitud_model->insertsolicitud($codigo, $descripcion, $resumen, $id_empleado);
    if ($result === FALSE) {
      $this->response(array('status' => 'failed'), 404);
    } else {
      $this->response(array('status' => 'success'), 201);
    }
  }

  public function solicitud_update_post($id)
  {
    $codigo = $this->post('codigo');
    $descripcion = $this->post('descripcion');
    $resumen = $this->post('resumen');
    $id_empleado = $this->post('id_empleado');

    $result = $this->Solicitud_model->setSolicitud($id, $codigo, $descripcion, $resumen, $id_empleado);
    if ($result === FALSE) {
      $this->response(array('status' => 'failed'), 404);
    } else {
      $this->response(array('status' => true, 'response' => 'ok'), 201);
    }
  }

  public function solicitud_delete($id)
  {
    if (!empty($id)) {

      $result = $this->Solicitud_model->deleteSolicitud($id);
      if ($result === FALSE) {
        $this->response(array('status' => 'failed'), 404);
      } else {
        $this->response(array('status' => true, 'response' => 'ok'), 200);
      }
    } else {
      $this->response(array(
        'status' => 'failed',
        'message' => 'Falta el parametro ID'
      ), 404);
    }
  }
}
